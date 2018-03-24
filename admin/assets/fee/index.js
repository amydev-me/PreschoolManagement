let _getdata=route.urls.fee.getdata;
let _remove=route.urls.fee.remove;
let _filterbyname=route.urls.fee.filter_name;
const VuePagination = resolve => require(['../core/VuePagination'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
const action = resolve => require(['./action'], resolve);
module.exports= {
  components: {VuePagination, DeleteModal,action},
  data: function () {
    return {
      isedit: false,
      filtertext:null,
      pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1,
        last_page: 1,
      },
      feetype: {
        id: null,
        feeName: null,
        description: null,
        amount:0
      },
      fee_types: [],
      fee_id:null
    }
  },
  methods: {
    formatNumber(number){
      return parseInt( number ).toLocaleString();
    },
    formatDate (date) {
      return Helper.formatDate(date);
    },
    showAddModal () {
      this.fee_id = null;
      this.isedit = false;
      $('#mymodal').modal('show');
    },
    showDeleteModal (id) {
      this.fee_id = id;
      $('#deleteModal').modal('show');
    },
    showEditModal (feetype) {
      var temp = Object.assign({}, feetype);
      this.feetype.id = temp.id;
      this.feetype.feeName = temp.feeName;
      this.feetype.description = temp.description;
      this.feetype.amount = temp.amount;
      this.isedit = true;
    },

    getData (url) {
      axios.get(url+this.pagination.current_page).then(({data}) => {
        this.pagination = data;
        this.fee_types = data.data;
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Error occured while loading data.');
        }
      });
    },

    performdelete () {
      axios.get(_remove + this.fee_id).then(response => {
        this.getData(_getdata);
        this.fee_id = null;
        if (response.data.success) {
          Notification.success('Success');
        } else {
          Notification.error('Invalid data.');
        }
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Error occured while deleting data.');
        }
      });
      $('#deleteModal').modal('hide');
    },

    successdata(){
      $('#mymodal').modal('hide');
      this.getData(_getdata);
    },

    searchClick () {
      if(this.filtertext==null ||this.filtertext==''){
        this.getData(_getdata);
      }
      else{
        this.getData(_filterbyname+this.filtertext+'?page=');
      }
    }
  },
  mounted () {
    this.getData(_getdata);
  }
}