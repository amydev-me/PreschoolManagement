let create=route.urls.guardian.create;

module.exports= {
  data: function () {
    return {
      guardian: {
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


            this.performAction();

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

    clearData () {

      this.errors.clear('guardian_personal_detail_form');

      this.guardian.email = null;

      this.guardian.firstName = null;
      this.guardian.lastName = null;
      this.guardian.realation = null;
      this.guardian.occupation = null;
      this.guardian.phone = null;
      this.guardian.address = null;

    },
  },

  mounted () {
    $(this.$refs.thismodel).on("hidden.bs.modal", this.clearData);
    $(this.$refs.thismodel).on("shown.bs.modal", this.clearData);
  },
}