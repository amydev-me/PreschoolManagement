const datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);
const NumericInput = resolve => require(['../core/NumericInput'], resolve);
let get_fees=route.urls.fee.asyncget;
module.exports={
  components:{datepicker,NumericInput},
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
        status:'UNPAID',
        invoice:null,
        amount:0,
        id:null,
        due_date:null,
        receipt_amount:0,
        fine:0,
        total:0,
        discount:0
      },
      payment_id:null
    }
  },
  methods: {
    formatDate (date) {
      return Helper.formatDate(date);
    },
    formatNumber(number){
      return parseInt( number ).toLocaleString();
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
      this.performdata.total=this.total;

      if(this.performdata.receipt_amount <this.total) {
        this.performdata.status="UNPAID";
      }else{
        this.performdata.status="PAID";
      }
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
          window.history.back();
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
        this.performdata.receipt_amount=data.payment.receipt_amount;
        this.performdata.fine=data.payment.fine;
        this.performdata.discount=data.payment.discount;
       if(data.grade) this.selected_grade=data.grade;
        if(data.student) this.selected_student={id:data.student.id,fullName:data.student.fullName};
        this.selected_term=data.term;
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
        }).catch(error => {

          if (error.response.status == 401 || error.response.status == 419) {
            window.location.href = route.urls.login;
          } else {
            Notification.error('Opps!Something went wrong.');
          }
        });;
      });
    }
  },
  computed: {
    totalvalue() {
      var _total = 0;
      var result = this.fees.map(function (el) {

        if (el.ischecked) {
          _total = parseInt(el.amount)+_total;
        }
      });
      _total =parseInt(this.performdata.fine)+_total;
      _total=   parseInt(this.performdata.amount)  +_total;
      return _total-this.performdata.discount;
    }
  },
  watch: {
    totalvalue (n, o) {
      this.total = n;
    }
  },

  mounted(){
    this.performdata.payment_date=this.formatDate(new Date());
    this. checkUrlParam ();
  },

}