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
        invoice:'I-000001',
        amount:0,
        id:null,
        due_date:null
      },
      payment_id:null
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
      if(this.selected_term !=null){

        this.performdata.amount=this.selected_term.pivot.amount;
      }
    },
    getGades () {
      axios.get('/admin/category/get-with-category').then(({data}) => {
        this.grades = data.grades;
        this.active_academic = data.active_academic;
      });
    },
    // feeCheckedChanged ( index) {
    //   var _fee = this.fees[index];
    //
    //   if(!_fee.ischecked){
    //     this.total +=_fee.amount;
    //   }  else{
    //     this.total -=_fee.amount;
    //   }
    // },
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
      this.performdata.id=this.payment_id;
      this.performdata.due_date=this.selected_term.due_date;
      var tc=new Object();
      tc.payment=new Object(this.performdata);
      var temp2=[];
      var that=this;
      this.fees.map((t) => {
        if (t.ischecked) {
          var g = {payment_id: that.payment_id, fee_id: t.id, amount: t.amount};
          temp2.push(g);
        }
      });
      tc.fees=temp2;
      axios.post('/admin/payment/update', tc).then(({data}) => {

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
    },
    checkUrlParam () {
      let payment_id = Helper.getUrlParameter('payment_id');
      if (payment_id != null) {

        this.payment_id = payment_id;
        this.getDetail();
      }
    },
    getDetail(){
      axios.get('/admin/payment/get-detail?payment_id='+this.payment_id).then(({data})=>{
        this.performdata.student_id=data.payment.id;
        this.performdata.grade_id=data.payment.grade_id;
        this.performdata.term_id=data.payment.term_id;
        this.performdata.payment_date=this.formatDate(data.payment.payment_date);
        this.performdata.status=data.payment.status;
        this.performdata.invoice=data.payment.invoice;
        this.performdata.amount=data.payment.amount;
        this.performdata.due_date=this.formatDate(data.payment.due_date);
        this.selected_grade={id:data.grade.id,gradeName:data.grade.gradeName,academic_id:data.grade.academic_id,category_id:data.grade.category_id,description:data.grade.description}
        this.selected_student={id:data.student.id,fullName:data.student.fullName};
        axios.get('/admin/grade/get-terms?grade_id=' +  this.performdata.grade_id).then(response => {
          this.terms = response.data;
          var te=data.term;
          var t= this.terms.find(function (el) {
              return el.id==te.id;
          });
          this.selected_term=t;

        });
        var  _tempfees = data.fees;
        axios.get(get_fees).then(({data}) => {
          let _fees = data;

          var result = _fees.map(function (el) {

            var section = _tempfees.find(sec => sec.pivot.fee_id == el.id);
            var o = Object.assign({}, el);
            if (section != null) {
              o.fee_id = section.pivot.fee_id;
              o.ischecked = true;
              o.amount = section.pivot.amount;
            } else {
              o.fee_id = null;
              o.ischecked= false;
              o.amount = el.amount;
            }

            return o;
          });
          this.fees = result;

        });


        // academic_id:1
        // category_id:1
        // due_date:"2018-04-10 00:00:00"
        // end_date:"2018-04-10 00:00:00"
        // id:1
        // pivot:Object
        // start_date:"2018-04-10 00:00:00"
        // termName:"Term-1"


      });
    }
  },

  mounted(){
    this.performdata.payment_date=this.formatDate(new Date());
    this.getGades();

    this. checkUrlParam ();
  }
}