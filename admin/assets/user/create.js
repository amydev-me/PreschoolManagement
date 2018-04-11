let create=route.urls.user.create;
let checkinguser=route.urls.checkuser;


module.exports= {
  data: function () {
    return {
      user: {
        username: null,
        password: null,
        access_id: null,
        type: 'admin'
      },
      password_confirmation: null,
    }
  },
  methods: {
    submitdata (scope) {
      this.$validator.validateAll(scope).then(successsValidate => {
        if (successsValidate) {
          axios.post(create, this.user).then(response => {
            if (response.data.success) {
             this.$emit('input');
             $('#usermodal').modal('hide');
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
      }).catch(error => {
        Notification.warning('Invalid data.');
      });
    },
    clearOnHidden () {
      this.user.username = null;
      this.user.password = null;
      this.user.type='admin';
      this.password_confirmation = null;
      this.errors.clear('userform');
    }
  },
  mounted () {
    $(this.$refs.usmodal).on("hidden.bs.modal", this.clearOnHidden);
    $(this.$refs.usmodal).on("shown.bs.modal", this.clearOnHidden);
  },
  created () {
    this.$validator.extend('verify_user', {
      getMessage: field => `Username already exists.`,
      validate: value => new Promise((resolve) => {

        // API call or database access.
        let validUser = true;
        axios.get(checkinguser + value).then(response => {

          validUser = response.data.valid;
        }).then(response => {
          setTimeout(() => {

            resolve({
              valid: validUser == true ? true : false
            });
          }, 200);
        });
      })
    });
  }
}