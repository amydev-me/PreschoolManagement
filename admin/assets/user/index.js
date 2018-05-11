const VuePagination = resolve => require(['../core/VuePagination'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
const createUser = resolve => require(['./create'], resolve);
const changePassword = resolve => require(['./changepassword'], resolve);

let remove=route.urls.user.delete;
module.exports= {
  components: {VuePagination, DeleteModal, createUser, changePassword},
  data: function () {
    return {
      removeUrl:remove,

      users: [],
      pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1,
        last_page: 1,
      },

      user_id: null
    }
  },
  methods: {
    showEditModal (user) {
      this.user_id = user.id;
      $('#passwordmodal').modal('show');
    },
    showDeleteModal (id) {
      this.user_id = id;
      $('#deleteModal').modal('show');
    },
    successdelete () {
      $('#deleteModal').modal('hide');
      Notification.success('Success');
      this.getUser();
    },

    getUser () {
      axios.get('/admin/user/getuser?page=' + this.pagination.current_page).then(response => {
        this.pagination = response.data;
        this.users = response.data.data;

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
    this.getUser();
  },
}