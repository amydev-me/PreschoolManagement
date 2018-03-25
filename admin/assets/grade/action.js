const datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);
const NumericInput = resolve => require(['../core/NumericInput'], resolve);

module.exports= {
  components: {datepicker, NumericInput},
  data: function () {
    return {
      selected_academic: null,
      academics: [],
      categories: [],
      selected_category: null,
      formdata: {
        grade: {
          id: null,
          category_id: null,
          academic_id: null,
          gradeName: 'Kindergarten',
          description: '-',
        },
        first_term: {
          id: null,
          grade_id: null,
          termName: 'Term 1',
          start_date: null,
          end_date: null,
          term_type: 't1',
          full: {
            term_time: '8:00-9:00 AM',
            time_type: 'Full',
            amount: 0
          },
          half: {
            term_time: '8:00-9:00 AM',
            time_type: 'Half',
            amount: 0
          }

        },
        second_term: {
          id: null,
          grade_id: null,
          termName: 'Term 2',
          start_date: null,
          end_date: null,
          term_type: 't2',

          full: {
            term_time: '8:00-9:00 AM',
            time_type: 'Full',
            amount: 0
          },
          half: {
            term_time: '8:00-9:00 AM',
            time_type: 'Half',
            amount: 0
          }

        }
      },
    }
  },
  methods: {
    formatDate (date) {
      return Helper.formatDate(date);
    },
    getasyncdata () {
      axios.get('/get-academic-category').then(({data}) => {
        this.academics = data.academics;
        this.categories = data.categories;
        this.selected_academic = data.active;
      });
    },
    submitdata () {
      this.$validator.validateAll().then(successsValidate => {
        if (successsValidate) {
          this.performAction();
        }
      }).catch(error => {
        Notification.warning('Invalid data.');
      });
    },
    performAction () {
      var temp = Object.assign({}, this.formdata);
      var tc={};
      tc.grade=temp.grade;
      tc.grade.academic_id=this.selected_academic.id;
      tc.grade.category_id=this.selected_category.id;
      tc.firstfull_term={
        id:null,
        grade_id:null,
        termName:temp.first_term.termName,
        term_type:temp.first_term.term_type,
        start_date:temp.first_term.start_date,
        end_date:temp.first_term.end_date,
        time_type:temp.first_term.full.time_type,
        term_time:temp.first_term.full.term_time,
      };
      tc.firsthalf_term={
        id:null,
        grade_id:null,
        termName:temp.first_term.termName,
        term_type:temp.first_term.term_type,
        start_date:temp.first_term.start_date,
        end_date:temp.first_term.end_date,
        time_type:temp.first_term.half.time_type,
        term_time:temp.first_term.half.term_time,
      };
      tc.secondfull_term={
        id:null,
        grade_id:null,
        termName:temp.second_term.termName,
        term_type:temp.second_term.term_type,
        start_date:temp.second_term.start_date,
        end_date:temp.second_term.end_date,
        time_type:temp.second_term.full.time_type,
        term_time:temp.second_term.full.term_time,
      };
      tc.secondhalf_term={
        id:null,
        grade_id:null,
        termName:temp.second_term.termName,
        term_type:temp.second_term.term_type,
        start_date:temp.second_term.start_date,
        end_date:temp.second_term.end_date,
        time_type:temp.second_term.half.time_type,
        term_time:temp.second_term.half.term_time,
      };

      axios.post('/admin/grade/create', tc).then(({data}) => {
        if(data.success==true){
          window.location.href='/admin/grade';
        }else
        {
          Notification.warning('Opps!Something went wrong.');
        }
      }).catch(response=>{
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Opps!Something went wrong.');
        }
      });
    }
  },
  mounted () {
    this.formdata.first_term.start_date = this.formatDate(new Date());
    this.formdata.first_term.end_date = this.formatDate(new Date());
    this.formdata.second_term.start_date = this.formatDate(new Date());
    this.formdata.second_term.end_date = this.formatDate(new Date());
    this.getasyncdata();
  }
}