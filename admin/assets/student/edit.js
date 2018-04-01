const Datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);
let _asyncguardian=route.urls.guardian.asyncget;
let _update=route.urls.student.update;
module.exports= {
  components: {Datepicker},


  data: function () {
    return {
      countries: [],
      student: {
        id: null,
        academic_id:null,
        guardian_id:null,
        email: null,
        profile: null,
        firstName:'',
        lastName:'',
        studentCode: null,
        dateofbirth: null,
        gender: 'Male',
        phone: null,
        nrc: null,
        nationality: null,
        address: null,
        join_date:null,
        course_id:null,
        history:null,
      },
      guardians: [],
      selected_guardian: null,
    }
  },

  methods: {
    asyncFindGuardian (query) {
      if (query == '') {return;}
      if (query == undefined) {return;}
      axios.get(_asyncguardian + query).then(response => {
        this.guardians = response.data;
      });
    },
    getDetail () {
      axios.get('/admin/student/get-detail?student_id=' + this.student.id).then(({data}) => {
        let student = data.student;

        this.student.academic_id = student.academic_id;
        this.student.guardian_id = student.guardian_id;
        this.student.studentCode = student.studentCode;
        this.student.email = student.email;
        this.student.profile = student.profile;
        this.student.firstName = student.firstName;
        this.student.lastName = student.lastName;
        this.student.dateofbirth = this.formatDate(student.dateofbirth);
        this.student.gender = student.gender;
        this.student.phone = student.phone;
        this.student.nrc = student.nrc;
        this.student.nationality = student.nationality;
        this.student.address = student.address;
        this.student.join_date = this.formatDate(student.join_date);
        this.student.meal_preferences = student.meal_preferences;
        this.student.allergies = student.allergies;
        this.student.history = student.history;
        if (student.guardian != null) {
          let guardian = student.guardian;
          this.selected_guardian = {id: guardian.id, fullName: guardian.fullName, email: guardian.email};
        }
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Error occured while loading data.');
        }
      });
    },
    checkUrlParam () {
      let student_id = Helper.getUrlParameter('student_id');
      if (student_id != null) {

        this.student.id = student_id;
        this.getDetail();
      }
    },
    newHistory (event) {
      let files = event.target.files;
      if (files.length) {
        this.student.history = files[0];
      }
    },
    newProfile (event) {
      let files = event.target.files;
      if (files.length) {
        this.student.profile = files[0];
      }
    },
    formatDate (date) {
      return Helper.formatDate(date);
    },
    validateData (scope) {
      this.$validator.validateAll(scope).then(successsValidate => {
        if (successsValidate) {
          this.performAction();
        }
      }).catch(error => {});
    },
    performAction () {
      let data = new FormData();
      data.set('id', this.student.id);
      data.set('guardian_id', this.selected_guardian.id);
      data.set('email', this.student.email);
      data.append('profile', this.student.profile);
      data.set('firstName', this.student.firstName);
      data.set('lastName', this.student.lastName);
      data.set('fullName', this.student.firstName + ' ' + this.student.lastName);
      data.set('dateofbirth', this.student.dateofbirth);
      data.set('gender', this.student.gender);
      data.set('phone', this.student.phone);
      data.set('nrc', this.student.nrc);
      data.set('nationality', this.student.nationality);
      data.set('join_date', this.student.join_date);
      data.set('benefit', this.student.benefit);
      data.set('address', this.student.address);
      data.set('meal_preferences', this.student.meal_preferences);
      data.set('allergies', this.student.allergies);
      data.set('history', this.student.history);
      data.set('history', this.student.history);
      const config = {headers: {'Content-Type': 'multipart/form-data'}};
      axios.post(_update, data, config).then(response => {

        if (response.data.success == false) {
          Notification.error('Error occur while inserting data.');
        } else {
          Notification.success('Success');
          this.$emit('input', this.student);
        }
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          // window.location.href = route.urls.login;
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
    this.checkUrlParam();
  }
}