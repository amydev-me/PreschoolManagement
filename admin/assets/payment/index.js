const VuePagination = resolve => require(['../core/VuePagination'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
module.exports= {
  components:{VuePagination,DeleteModal},
  data: function () {
    return {
      status:'paid',
     payments:[],
      pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1,
        last_page: 1,
      },
      currentdate:null,
      payment_id:null,
      removeUrl:'/admin/payment/delete/'
    }
  },
  methods: {
    getpaidinvoice(){
      axios.get('/admin/payment/get-paid?page='+this.pagination.current_page).then(({data})=>{
        this.payments=data.data;
        this.pagination=data;
      });
    },
    getunpaidinvoice(){
      axios.get('/admin/payment/get-unpaid?page='+this.pagination.current_page).then(({data})=>{
        this.payments=data.data;
        this.pagination=data;
      });
    },
    getoverdueinvoice(){
      axios.get('/admin/payment/get-overdue?page='+this.pagination.current_page).then(({data})=>{
        this.payments=data.data;

        this.pagination=data;
      });
    },
    showDeleteModal (id) {
      this.payment_id = id;
      $('#deleteModal').modal('show');
    },
    successdelete(){
      $('#deleteModal').modal('hide');
      Notification.success('Success');
      this.loaddata();
    },
    formatNumber(number){
      return parseInt( number ).toLocaleString();
    },
    formatDate (date) {
      return Helper.formatDate(date);
    },
    loaddata(){
      console.log(this.status);
      if(this.status=='paid'){
        this.getpaidinvoice();
      }else if(this.status=='unpaid'){
        this.getunpaidinvoice();
      }
      else if(this.status=='overdue'){
        this.getoverdueinvoice();
      }
      // axios.get('/admin/payment/get-data?page='+this.pagination.current_page).then(({data})=>{
      //   this.payments=data.data;
      //   this.pagination=data;
      // });
    }
  },
  mounted () {
    this.currentdate=this.formatDate(new Date());
    this.loaddata();
  }
}