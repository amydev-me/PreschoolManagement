let update=route.urls.user.update;

module.exports= {
  props: ['userid'],
  data: function () {
    return {
      changepassword: {
        id: null,
        password: null,
      },
      chu_password: null,
    }
  },
  methods: {
    changesubmit (scope) {

      this.$validator.validateAll(scope).then(successsValidate => {
        if (successsValidate) {

          axios.post(update, this.changepassword).then(response => {
            if (response.data.success) {
              $('#passwordmodal').modal('hide');
              Notification.success('Success');
            } else {
              Notification.error('Invalid data.');
            }
          }).catch(error => {
            if (error.response.status == 401 || error.response.status == 419) {
              window.location.href = route.urls.login;
            } else {
              Notification.error('Invalid data.');
            }
          });
        }
      });
    },
    clearOnHidden () {
      this.changepassword.password = null;
      this.chu_password = null;
      this.errors.clear('userform');
    }
  },
  mounted () {
    this.changepassword.id=this.userid;
    $(this.$refs.usmodal).on("hidden.bs.modal", this.clearOnHidden);
    $(this.$refs.usmodal).on("shown.bs.modal", this.clearOnHidden);
  },
}