const VuePagination = resolve => require(['../core/VuePagination'], resolve);
module.exports= {
  components:{VuePagination},
  data: function () {
    return {
     payments:[],
      pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1,
        last_page: 1,
      },
    }
  },
  methods: {
    formatNumber(number){
      return parseInt( number ).toLocaleString();
    },
    formatDate (date) {
      return Helper.formatDate(date);
    },
    loaddata(){
      axios.get('/admin/payment/get-data?page='+this.pagination.current_page).then(({data})=>{
        this.payments=data.data;
        this.pagination=data;
      });
    }
  },
  mounted () {
    this.loaddata();
  }
}