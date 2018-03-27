let _getdata=route.urls.category.getdata;
let _remove=route.urls.category.remove;
let _filterbyname=route.urls.category.filter_name;
const VuePagination = resolve => require(['../core/VuePagination'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
const action = resolve => require(['./action'], resolve);
module.exports= {
  components: {VuePagination, DeleteModal,action},
  data: function () {
    return {
      removeUrl:_remove,
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
      category: {
        id: null,
        categoryName: null,
      },
      categories: [],
      category_id:null
    }
  },
  methods: {
    showAddModal () {
      this.category_id = null;
      this.isedit = false;
      $('#mymodal').modal('show');
    },
    showDeleteModal (id) {
      this.category_id = id;
      $('#deleteModal').modal('show');
    },
    showEditModal (category) {
      var temp = Object.assign({}, category);
      this.category.id = temp.id;
      this.category.categoryName = temp.categoryName;
      this.isedit = true;
    },
    successdelete () {
      $('#deleteModal').modal('hide');
      Notification.success('Success');
      this.getData(_getdata);
    },
    getData (url) {
      axios.get(url+this.pagination.current_page).then(({data}) => {
        this.pagination = data;
        this.categories = data.data;
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Error occured while loading data.');
        }
      });
    },

    performdelete () {
      axios.get(_remove + this.category_id).then(response => {
        this.getData(_getdata);
        this.category_id = null;
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