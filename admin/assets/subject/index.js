const VuePagination = resolve => require(['../core/VuePagination'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
const action = resolve => require(['./action'], resolve);

let _getdata=route.urls.subject.getdata;
let _remove=route.urls.subject.remove;
let _filterbyname=route.urls.subject.filter_name;

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
      subject: {
        id: null,
        subjectName: null,
        description:null
      },
      subjects: [],
      subject_id:null
    }
  },
  methods: {
    showAddModal () {
      this.subject_id = null;
      this.isedit = false;
      $('#mymodal').modal('show');
    },
    showDeleteModal (id) {
      this.subject_id = id;
      $('#deleteModal').modal('show');
    },
    showEditModal (subject) {
      var temp = Object.assign({}, subject);
      this.subject.id = temp.id;
      this.subject.subjectName = temp.subjectName;
      this.subject.description = temp.description;
      this.isedit = true;
    },
    successdata(){
      $('#mymodal').modal('hide');
      this.getData(_getdata);
    },
    successdelete () {
      $('#deleteModal').modal('hide');
      Notification.success('Success');
      this.getData(_getdata);
    },
    getData (url) {
      axios.get(url+this.pagination.current_page).then(({data}) => {
        this.pagination = data;
        this.subjects = data.data;
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Error occured while loading data.');
        }
      });
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