const CreateGuardian = resolve => require(['../guardian/action'], resolve);
const Datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);
let _create=route.urls.student.create;
let _asyncguardian=route.urls.guardian.asyncget;
let _getgrade=route.urls.grade.getgrade;
let checkinguser=route.urls.checkuser;
let getac=route.urls.get_ac;
let indexpage=route.urls.student.indexpage;
module.exports= {
  components: {Datepicker,CreateGuardian},
  data: function () {
    return {
      countries: [],
      selected_academic: null,
      guardians: [],
      selected_guardian: null,
      grades: [],
      selected_grade: null,

      student: {
        id: null,
        guardian_id: null,
        grade_id: null,
        academic_id: null,
        profile: null,
        email: null,
        firstName: null,
        lastName: null,
        fullName: null,
        dateofbirth: null,
        gender: 'Male',
        phone: null,
        nrc: null,
        nationality: null,
        join_date: null,
        benefit: ' ',
        meal_preferences: null,
        allergies: null,
        address: null,
        history: '',

      },
    }
  },
  methods: {
    getGades () {
      axios.get('/admin/category/get-with-category').then(({data}) => {
        this.grades = data.grades;
        this.selected_academic=data.active_academic;
      });
    },
    newProfile (event) {
      let files = event.target.files;
      if (files.length) {
        this.student.profile = files[0];
      }
    },
    newHistory (event) {
      let files = event.target.files;
      if (files.length) {
        this.student.history = files[0];
      }
    },
    formatDate (date) {
      return Helper.formatDate(date);
    },
    asyncFindGuardian (query) {
      if (query == '') {return;}
      if (query == undefined) {return;}
      axios.get(_asyncguardian + query).then(response => {
        this.guardians = response.data;
      });
    },
    getasyncdata () {
      axios.get(getac).then(({data}) => {
        this.academics = data.academics;
      });
    },

    asyncFindGuardian (query) {
      if (query == '') {return;}
      if (query == undefined) {return;}
      axios.get(_asyncguardian + query).then(response => {
        this.guardians = response.data;
      });
    },

    validateData (scope) {

      this.$validator.validateAll(scope).then(successsValidate => {
        if (successsValidate) {

            this.performAction();

        } else {
          Notification.error('Invalid data.');
        }
      }).catch(error => {
        Notification.error('Opps!Something went wrong.');
      });
    },
    performAction () {

      let data = new FormData();


      data.set('academic_id', this.selected_academic.id);
      data.set('guardian_id', this.selected_guardian.id);
      data.set('grade_id', this.selected_grade.id);
      data.append('profile', this.student.profile);
      data.set('firstName', this.student.firstName);
      data.set('lastName', this.student.lastName);
      data.set('fullName', this.student.firstName + ' ' + this.student.lastName);
      data.set('email', this.student.email);
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
      data.append('history', this.student.history);

      const config = {headers: {'Content-Type': 'multipart/form-data'}};
      axios.post(_create, data, config).then(response => {

        if (response.data.success == false) {
          Notification.error('Error occur while inserting data.');
        } else {
          window.location.href = indexpage;
        }
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else if (error.response.status == 422) {
          Notification.error('Invalid Data.');
        } else {
          Notification.error('Error occur while inserting data.');
        }
      });
    },
    submitsuccess (value) {
      this.selected_guardian = {id: value.id, fullName: value.fullName, email: value.email};
      $('#guardian-modal').modal('hide');
    },
  },
  mounted () {
    // this.handleTab();
    this.student.dateofbirth = this.formatDate(new Date());
    this.student.join_date = this.formatDate(new Date());
    this.countries = Helper.countries();
    this.getGades();
    // this.getasyncdata();
  },

}