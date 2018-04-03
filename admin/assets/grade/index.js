const VuePagination = resolve => require(['../core/VuePagination'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
const viewComponent = resolve => require(['./viewcomponent'], resolve);
let _getdata=route.urls.grade.getdata;
let _remove=route.urls.grade.remove;

module.exports= {
  components: {viewComponent, DeleteModal, VuePagination},
  data: function () {
    return {
      removeUrl: _remove,
      grades: [],
      grade_id: null,
      pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1,
        last_page: 1,
      }
    }
  },
  methods: {
    getData (url) {
      axios.get(url).then(({data}) => {
        this.pagination = data;
        this.grades = data.data;
      });
    },
    showDeleteModal (id) {
      this.grade_id = id;
      $('#deleteModal').modal('show');
    },
    successdelete () {
      $('#deleteModal').modal('hide');
      Notification.success('Success');
      this.getData(_getdata);
    },
  },
  mounted () {
    this.getData(_getdata);
  }
}