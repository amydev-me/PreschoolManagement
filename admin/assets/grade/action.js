const datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);
const NumericInput = resolve => require(['../core/NumericInput'], resolve);
const CategorySelect = resolve => require(['../select_components/CategorySelect'], resolve);
let create=route.urls.grade.create;
let update=route.urls.grade.update;
let getdetailurl='/admin/grade/detail?grade_id=';
let getac=route.urls.get_ac;

module.exports= {
  components: {datepicker, NumericInput,CategorySelect},

  data: function () {
    return {
      isedit:false,
      selected_academic: null,
      academics: [],
      categories: [],
      selected_category: null,
      firstfull_id:null,
      firsthalf_id:null,
      secondfull_id:null,
      secondhalf_id:null,
      firstDate:{
        start_date: null,
        end_date: null,
      },
      secondDate:{
        start_date: null,
        end_date: null,
      },
      firstFull:{
        term_time: null,
        amount: 0
      },
      firstHalf:{
        term_time: null,
        amount: 0
      },
      secondFull:{
        term_time: null,
        amount: 0
      },
      secondHalf:{
        term_time: null,
        amount: 0
      },
      grade: {
        id: null,
        category_id: null,
        academic_id: null,
        gradeName: null,
        description: null,
      },
    }
  },

  methods: {
    selectedCategoryChange(value){
      this.selected_category=value;
    },
    formatDate (date) {
      return Helper.formatDate(date);
    },
    getDetail (grade_id) {

      return axios.get(getdetailurl + grade_id);
    },
    getasyncdata () {
      return axios.get(getac);
    },
    multiRequest(grade_id) {
      axios.all([this.getDetail(grade_id), this.getasyncdata()]).then(axios.spread((detail, asyncget) => {
        this.academics = asyncget.data.academics;
        this.categories = asyncget.data.categories;
        let temp = detail.data;
        this.grade = {
          id: temp.grade.id,
          category_id: temp.grade.category_id,
          academic_id: temp.grade.academic_id,
          gradeName: temp.grade.gradeName,
          description: temp.grade.description,
        };
        this.selected_academic = temp.grade.academic;
        this.selected_category = temp.grade.category;
        this.firstfull_id=temp.first_full.id;
        this.firsthalf_id=temp.first_half.id;
        this.firstDate.start_date=temp.first_full.start_date;
        this.firstDate.end_date=temp.first_full.end_date;
        this.firstFull.term_time=temp.first_full.term_time;
        this.firstFull.amount=temp.first_full.amount;
        this.firstHalf.term_time=temp.first_half.term_time;
        this.firstHalf.amount=temp.first_half.amount;

        this.secondfull_id=temp.second_full.id;
        this.secondhalf_id=temp.second_half.id;
        this.secondDate.start_date=temp.second_full.start_date;
        this.secondDate.end_date=temp.second_full.end_date;
        this.secondFull.term_time=temp.second_full.term_time;
        this.secondFull.amount=temp.second_full.amount;
        this.secondHalf.term_time=temp.second_half.term_time;
        this.secondHalf.amount=temp.second_half.amount;

      }));
    },

    submitdata () {
      this.$validator.validateAll().then(successsValidate => {
        if (successsValidate) {
          let _url = this.isedit ? update : create;
          this.performAction(_url);
        }
      }).catch(error => {
        Notification.warning('Invalid data.');
      });
    },

    performAction (url) {
      var tc=new Object(Object.prototype,{grade:{},first_full:{},first_half:{}});
      tc.grade ={id:this.grade.id,academic_id:this.selected_academic.id,category_id:this.selected_category.id,gradeName:this.grade.gradeName,description:this.grade.description};
      tc.first_full={
        id: this.firstfull_id,
        grade_id: grade.id,
        term_type: 't1',
        time_type: 'Full',
        termName: 'Term 1',
        start_date: this.firstDate.start_date,
        end_date: this.firstDate.end_date,
        term_time:this.firstFull.term_time,
        amount:this.firstFull.amount
      };
      tc.first_half={
        id: this.firsthalf_id,
        grade_id: grade.id,
        term_type: 't1',
        time_type: 'Half',
        termName: 'Term 1',
        start_date: this.firstDate.start_date,
        end_date: this.firstDate.end_date,
        term_time:this.firstHalf.term_time,
        amount:this.firstHalf.amount
      };
      tc.second_full={
        id: this.secondfull_id,
        grade_id: grade.id,
        term_type: 't2',
        time_type: 'Full',
        termName: 'Term 2',
        start_date: this.secondDate.start_date,
        end_date: this.secondDate.end_date,
        term_time:this.secondFull.term_time,
        amount:this.secondFull.amount
      };
      tc.second_half={
        id: this.secondhalf_id,
        grade_id: grade.id,
        term_type: 't2',
        time_type: 'Half',
        termName: 'Term 2',
        start_date: this.secondDate.start_date,
        end_date: this.secondDate.end_date,
        term_time:this.secondHalf.term_time,
        amount:this.secondHalf.amount
      };
      axios.post(url, tc).then(({data}) => {
          if(data.success==true){
            window.location.href='/admin/grade';
          }else{
            Notification.error('Opps!Something went wrong.');
          }
      }).catch(error => {

        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Opps!Something went wrong.');
        }
      });

    },

    checkUrlParam () {
      let grade_id = Helper.getUrlParameter('grade_id');
      if (grade_id != null) {
        this.isedit=true;
        this.multiRequest(grade_id);
      } else {
        this.isedit=false;
        this.getasyncdata().then(({data}) => {
          this.academics = data.academics;
          this.categories = data.categories;
          this.selected_academic = data.active;
        });
      }
    },
  },

  mounted () {
    this.firstDate.start_date = this.formatDate(new Date());
    this.firstDate.end_date = this.formatDate(new Date());
    this.secondDate.start_date = this.formatDate(new Date());
    this.secondDate.end_date = this.formatDate(new Date());
    this.checkUrlParam();
  }
}