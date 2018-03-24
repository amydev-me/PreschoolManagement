let _getdata=route.urls.academic.getdata;
let _remove=route.urls.academic.remove;
let _filterbyname=route.urls.academic.filter_name;
const VuePagination = resolve => require(['../core/VuePagination'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
const action = resolve => require(['./action'], resolve);
module.exports= {
  components: {VuePagination, action, DeleteModal},
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
      academic: {
        id: null,
        academicName: null,
        start_date: null,
        end_date: null,
        active_year: false
      },
      academics: [],
      academic_id: null
    }
  },
  methods: {
    formatDate (date) {
      return Helper.formatDate(date);
    },
    showAddModal () {
      this.academic_id = null;
      this.isedit = false;
      $('#mymodal').modal('show');
    },
    showDeleteModal (id) {
      this.academic_id = id;
      $('#deleteModal').modal('show');
    },
    showEditModal (academic) {
      var temp = Object.assign({}, academic);
      this.academic.id = temp.id;
      this.academic.academicName = temp.academicName;
      this.academic.start_date = this.formatDate(temp.start_date);
      this.academic.end_date = this.formatDate(temp.end_date);
      this.academic.active_year = temp.active_year;
      this.isedit = true;
    },

    getData (url) {
      axios.get(url+this.pagination.current_page).then(({data}) => {
        this.pagination = data;
        this.academics = data.data;
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Error occured while loading data.');
        }
      });
    },

    performdelete () {
      axios.get(_remove + this.academic_id).then(response => {
        this.getData(_getdata);
        this.academic_id = null;
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