let create=route.urls.guardian.create;
let checkinguser=route.urls.checkuser;
module.exports= {
  data: function () {
    return {
      guardian: {
        username: null,
        email: null,
        password: null,
        confirm_password: null,
        firstName: null,
        lastName: null,
        fullName:null,
        realation: null,
        occupation: null,
        phone: null,
        address: null
      }
    }
  },
  methods: {
    validateData (scope) {
      this.$validator.validateAll(scope).then(successsValidate => {
        if (successsValidate) {
          if (scope == 'guardian_account_form') {
            $('#guardian_form a[href="#guardian_personal_detail"]').tab('show');

          } else if (scope == 'guardian_personal_detail_form') {

            this.performAction();
          }
        }
      });
    },
    performAction () {
      this.guardian.fullName=this.guardian.firstName+' '+this.guardian.lastName;
      axios.post(create, this.guardian).then(response => {
        this.$emit('input', response.data);
        Notification.success('Success');
      })
        .catch(error => {
          if (error.response.status == 401 || error.response.status == 419) {
            window.location.href = route.urls.login;
          } else {
            Notification.error('Invalid data.');
          }
        });
    },
    personal_back_click () {
      $('#guardian_form a[href="#guardian_account_detail"]').tab('show');
    },
    clearData () {
      this.errors.clear('guardian_account_form');
      this.errors.clear('guardian_personal_detail_form');
      this.guardian.username = null;
      this.guardian.email = null;
      this.guardian.password = null;
      this.guardian.confirm_password = null;
      this.guardian.firstName = null;
      this.guardian.lastName = null;
      this.guardian.realation = null;
      this.guardian.occupation = null;
      this.guardian.phone = null;
      this.guardian.address = null;
      $('#guardian_form a[href="#guardian_account_detail"]').tab('show');
    },
  },

  mounted () {
    $(this.$refs.thismodel).on("hidden.bs.modal", this.clearData);
    $(this.$refs.thismodel).on("shown.bs.modal", this.clearData);
  },
  created () {
    this.$validator.extend('verify_user', {
      getMessage: field => `Username already exists.`,
      validate: value => new Promise((resolve) => {
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
  },
}