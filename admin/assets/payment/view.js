module.exports={
  data:function () {
    return {
      currentdate:null,
      payment: {
        id: null,
        amount: 0,
        invoice: null,
        payment_date: null,
        status: "Not Paid",
        total: 0,
        fees: []
      },
      grade: {
        id: null,
        gradeName: null,
        description: null,
        academic: {
          id: null,
          academicName: null
        }
      },
      term: {
        id: null,
        termName: null,
        start_date: null,
        end_date: null,

      },
      student: {
        id: null,
        fullName: null,
        phone:null,
        address:null,

        student_guardian:{
          g_one_name:null,
          g_one_relation:null,
          g_one_email:null,
          g_one_occupation:null,
          g_one_address:null,
          g_one_mobile:null,
          g_one_home:null,
          g_one_work:null,

          g_two_name:null,
          g_two_relation:null,
          g_two_email:null,
          g_two_occupation:null,
          g_two_address:null,
          g_two_mobile:null,
          g_two_home:null,
          g_two_work:null,
        }
      },
      fees:[],
      parentData: this.$parent.info
    }
  },

  methods:{
    testFormat (date) {
      return Helper.testFormat(date);
    },
    getImage () {

      if(this.parentData.invoice_logo=='null') return;
      return '/image/business/' + this.parentData.invoice_logo;
    },
    checkUrlParam () {
      let payment_id = Helper.getUrlParameter('payment_id');
      if (payment_id != null) {

        this.payment.id = payment_id;
        this.getDetail();
      }
    },
    formatDate (date) {
      return Helper.formatDate(date);
    },
    getDetail () {
      axios.get('/admin/payment/get-detail?payment_id=' + this.payment.id).then(({data}) => {

        this.payment = data.payment;
        if(data.student){this.student=data.student;}
        if(data.fees){this.fees=data.fees;}
        if(data.term){this.term=data.term;}
        if(data.grade){this.grade=data.grade;}

      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = Helper.loginPage();
        } else {
          Notification.error('Error occured while loading data.');
        }
      });
    },
    print(){
      window.print();
    },
    formatNumber(number){
      return parseInt( number ).toLocaleString();
    }
  },
  mounted(){
    this.currentdate=this.formatDate(new Date());
    this.checkUrlParam();
  }
}


