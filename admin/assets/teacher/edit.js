const Datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);

let update=route.urls.teacher.update;

module.exports= {
  components: {Datepicker},
  props: ['teacher'],
  data: function () {
    return {
      isedit:true,
      countries: []
    }
  },
  methods: {
    personal_back_click () {
      $('#teacher_form a[href="#account_detail"]').tab('show');
    },
    employee_back_click () {
      $('#teacher_form a[href="#personal_detail"]').tab('show');
    },
    contact_back () {
      $('#teacher_form a[href="#employee_detail"]').tab('show');
    },
    formatDate (date) {
      return Helper.formatDate(date);
    },
    newProfile (event) {
      let files = event.target.files;
      if (files.length) {
        this.teacher.profile = files[0];
      }
    },
    validateData (scope) {
      this.$validator.validateAll(scope).then(successsValidate => {
        if (successsValidate) {
          if (scope == 'account-form') {
            $('#teacher_form a[href="#personal_detail"]').tab('show');
          } else if (scope == 'personal_detail_form') {
            $('#teacher_form a[href="#employee_detail"]').tab('show');
          } else if (scope == 'employee_form') {
            $('#teacher_form a[href="#contact_info"]').tab('show');
          } else if (scope == 'contact_form') {
            this.performAction();
          }
        }
      });
    },

    performAction () {
      let data = new FormData();
      data.append('id', this.teacher.id);
      data.append('profile', this.teacher.profile);
      data.append('firstName', this.teacher.firstName);
      data.append('lastName', this.teacher.lastName);
      data.append('fullName', this.teacher.firstName+' '+this.teacher.lastName);
      data.append('phone', this.teacher.phone);
      data.append('personal_email', this.teacher.personal_email);
      data.append('gender', this.teacher.gender);
      data.append('dateofbirth', this.teacher.dateofbirth);
      data.append('nrc', this.teacher.nrc);
      data.append('nationality', this.teacher.nationality);
      data.append('address', this.teacher.address);
      data.append('biography', this.teacher.biography);
      data.append('position', this.teacher.position);
      data.append('degree', this.teacher.degree);
      data.append('salary', this.teacher.salary);
      data.append('benefit', this.teacher.benefit);
      data.append('join_date', this.teacher.join_date);
      data.append('contactFirstName', this.teacher.contactFirstName);
      data.append('contactLastName', this.teacher.contactLastName);
      data.append('contactEmail', this.teacher.contactEmail);
      data.append('contactphone', this.teacher.contactphone);
      data.append('contactrelation', this.teacher.contactrelation);

      const config = {headers: {'Content-Type': 'multipart/form-data'}};
      axios.post(update, data, config).then(response => {
        if (response.data.success == false) {
          Notification.error('Error occur while inserting data.');
        } else {
          Notification.success('Success');
          this.$emit('input', this.teacher);
        }
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else if (error.response.status == 422) {
          Notification.error('Invalid Data.');
        } else {
          if (error.response.data.message) {
            Notification.error(error.response.data.message);
            return;
          }
          Notification.error('Error occur while inserting data.');

        }
      });
    },
  },
  mounted () {
    this.countries = Helper.countries();
  }
}