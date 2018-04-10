const VuePagination = resolve => require(['../core/VuePagination'], resolve);
const CreateGuardian = resolve => require(['../guardian/action'], resolve);
let _getdata=route.urls.guardian.getdata;
let _detailview=route.urls.guardian.detailView;
module.exports= {
  components: {VuePagination, CreateGuardian},
  data: function () {
    return {

      isEdit: false,
      filterText: '',
      pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1,
        last_page: 1,
      },
      guardians: [],
    }
  },
  methods: {
    goDetailView (id) {
      return _detailview + id;
    },
    searchClick () {
      if (this.filterText == '') {
        this.getData(_getdata);
      }
      else {
        this.getAll(filterByName + this.filterText + '/?page=');
      }
    },
    showAddModal () {
      $('#guardian-modal').modal('show');
    },
    submitsuccess () {
      $('#guardian-modal').modal('hide');
      this.getData(_getdata);
    },
    getData (url) {
      axios.get(url + this.pagination.current_page).then(({data}) => {
        this.pagination = data;
        this.guardians = data.data;
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Error occured while loading data.');
        }
      });
    },
  },
  mounted () {
    this.getData(_getdata);
  }
}