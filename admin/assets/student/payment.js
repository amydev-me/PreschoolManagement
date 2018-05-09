const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
const NumericInput = resolve => require(['../core/NumericInput'], resolve);
const datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);
let get_fees=route.urls.fee.asyncget;
module.exports= {
  components:{DeleteModal,NumericInput,datepicker},
  data: function () {
    return {
      isedit:false,
      student_id:null,
      grade_id:null,
      payments:[],
      currentdate:null,
      payment_id:null,
      removeUrl:'/admin/payment/delete/',
      fees:[],
      terms:[],
      selected_term:null,
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
        due_date:null,
        receipt_amount:0,
        fine:0,
        total:0
      }
    }
  },
  methods: {
    showAddModal(){
      this.isedit = false;
      $('#courseteacher-modal').modal('show');
    },
    showDeleteModal (id) {
      this.payment_id = id;
      $('#payment_deletemodal').modal('show');
    },
    successdelete(){
      $('#payment_deletemodal').modal('hide');
      Notification.success('Success');
      this.getData();
    },
    formatDate (date) {
      return Helper.formatDate(date);
    },
    formatNumber(number){
      return parseInt( number ).toLocaleString();
    },
    feeCheckedChanged ( index) {
      var _fee = this.fees[index];

      if(!_fee.ischecked){
        this.total +=_fee.amount;
      }  else{
        this.total -=_fee.amount;
      }
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

    checkUrlParam () {
      let student_id = Helper.getUrlParameter('student_id');
      if (student_id != null) {
        this.student_id = student_id;
        this.getData();
        axios.get('/admin/student/get-student?student_id=' + student_id).then(({data}) => {
            this.terms = data.terms;
          this.grade_id = data.student.grade_id;
        });
      }
    },
    getData(){
      axios.get('/admin/payment/by_student?student_id='+this.student_id).then(({data})=>{
        this.payments=data;
      });
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
      this.performdata.student_id=this.student_id;
      this.performdata.grade_id=this.grade_id;
      this.performdata.term_id=this.selected_term.id;
      this.performdata.due_date=this.selected_term.due_date;
      this.performdata.total=this.total;
      if(this.total==this.performdata.receipt_amount) {

        this.performdata.status="PAID";
      }

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
          $('#courseteacher-modal').modal('hide');
          this.getData();
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
  mounted () {
    this.performdata.payment_date=this.formatDate(new Date());
    this.currentdate=this.formatDate(new Date());
    this.checkUrlParam();
    this.getFees();
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
      return _total;
    }
  },
  watch: {
    totalvalue (n, o) {

      this.total = n;
    }
  },
}