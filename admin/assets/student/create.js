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
      academics: [],
      selected_academic: null,
      categories: [],
      selected_category: null,
      guardians: [],
      selected_guardian: null,
      grades: [],
      selected_grade: null,

      student: {
        id: null,
        username: null,
        password: null,
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
      firstchecked: false,
      secondchecked: false,

      first_term: {term: 't1', t_time: 'Full'},
      second_term: {term: 't2', t_time: 'Full'},
    }
  },
  methods: {

    personal_back_click () {
      $('#student_form a[href="#account_detail"]').tab('show');
    },
    grade_back_click () {
      $('#student_form a[href="#personal_detail"]').tab('show');
    },
    handleTab () {
      $('.nav li').not('.active').addClass('disabled');
      $('.nav li').not('.active').find('a').removeAttr("data-toggle");
      $('button').click(function () {
        $('.nav li.active').next('li').removeClass('disabled');
        $('.nav li.active').next('li').find('a').attr("data-toggle", "tab");
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
        this.categories = data.categories;
        this.selected_academic = data.active;
      });
    },
    selectedGradeChange () {
      if (this.selected_academic.id == null) return;
      if (this.selected_category.id == null) return;

      this.selected_grade = null;
      axios.get(_getgrade + '?category_id=' + this.selected_category.id).then(({data}) => {
        this.grades = data;
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
          if (scope == 'account-form') {
            $('#student_form a[href="#personal_detail"]').tab('show');

          } else if (scope == 'personal_detail_form') {
            $('#student_form a[href="#grade_detail"]').tab('show');

          } else {
            this.performAction();
          }
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
      data.set('category_id', this.selected_category.id);
      data.set('guardian_id', this.selected_guardian.id);
      data.set('grade_id', this.selected_grade.id);
      data.set('username', this.student.username);
      data.set('password', this.student.password);
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
      data.append('firstterm', this.firstchecked);
      data.append('secondterm', this.secondchecked);
      if (this.firstchecked) {
        data.append('fterm_type', this.first_term.term);
        data.append('ftime_type', this.first_term.t_time);
      }
      if (this.secondchecked) {
        data.append('sterm_type', this.second_term.term);
        data.append('stime_type', this.second_term.t_time);
      }

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
    this.getasyncdata();
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

    const isUnique = value => new Promise((resolve) => {
      setTimeout(() => {
        if (this.firstchecked === false && this.secondchecked === false) {
          return resolve({
            valid: false,
            data: {
              message: `${value} is already taken.`
            }
          });
        }
        return resolve({
          valid: true
        });
      }, 200);
    });
    this.$validator.extend('verify_term', {
      validate: isUnique,
      getMessage: (field, params, data) => data.message
    });
  },
}