const datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);
let get_fees=route.urls.fee.asyncget;
module.exports={
  components:{datepicker},
  data:function(){
    return{
      active_academic:null,
      grades:[],
      terms:[],
      selected_grade:null,
      selected_term:null,
      fees:[],
      students:[],
      selected_student:null,
      total:0,
      amount:0,
      performdata:{
        student_id:null,
        grade_id:null,
        term_id:null,
        payment_date:null,
        status:'Not Paid',
        invoice:null,
        amount:0,
        due_date:null

      }
    }
  },
  methods: {
    formatDate (date) {
      return Helper.formatDate(date);
    },

    getFees () {
      axios.get(get_fees).then(({data}) => {
        let _fees = data;
        let that = this;

        var result = _fees.map(function (el) {
          var o = Object.assign({}, el);
          o.ischecked = false;
          o.amount = el.amount;
          return o;
        });
        this.fees = result;
      });
    },

    asyncstudentbygrade(query){
      if(query ==null)return;
      axios.get('/admin/student/get-by-grade?grade_id='+this.selected_grade.id+'&fullName='+query).then(({data})=>{
        this.students=data;
      });
    },
    selectedTermChange(){
      if(this.selected_term ==null){

      }else{
        this.total=this.selected_term.pivot.amount;
        this.performdata.amount=this.selected_term.pivot.amount;
        var that=this;
        var result = this.fees.map(function (el) {
          if(el.ischecked){
            that.total+=el.amount;
          }
        });
      }
    },
    getGades () {
      axios.get('/admin/category/get-with-category').then(({data}) => {
        this.grades = data.grades;
        this.active_academic = data.active_academic;
      });
    },
    feeCheckedChanged ( index) {
      var _fee = this.fees[index];

      if(!_fee.ischecked){
        this.total +=_fee.amount;
      }  else{
        this.total -=_fee.amount;
      }
    },
    selectedGradeChange (value) {
      if(value==null){
        this.selected_student=null;
        this.terms=[];
        return;
      }
      axios.get('/admin/grade/get-terms?grade_id=' + value.id).then(({data}) => {
        this.terms = data;
      });
    },
    submitdata(){
      this.$validator.validateAll().then(successsValidate => {
        if (successsValidate) {

          this.performAction();
        }
      }).catch(error => {
        Notification.warning('Invalid data.');
      });

    },
    performAction(){
      this.performdata.student_id=this.selected_student.id;
      this.performdata.grade_id=this.selected_grade.id;
      this.performdata.term_id=this.selected_term.id;
      this.performdata.due_date=this.selected_term.due_date;
      var tc=new Object();
      tc.payment=new Object(this.performdata);
      var temp2=[];
      this.fees.map((t) => {
        if (t.ischecked) {
          var g = {payment_id: null, fee_id: t.id, amount: t.amount};
          temp2.push(g);
        }
      });
      tc.fees=temp2;

      axios.post('/admin/payment/create', tc).then(({data}) => {

        if(data.success==false) {
          Notification.error('Opps!Something went wrong.');
        }else{
          window.location.href='/admin/payment';
        }
      }).catch(error => {

        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Opps!Something went wrong.');
        }
      });
    }
  },

  mounted(){
      this.performdata.payment_date=this.formatDate(new Date());
      this.getGades();
      this.getFees();
  }
}