const Datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);
let checkinguser=route.urls.checkuser;
let create=route.urls.teacher.create;
let indexpage=route.urls.teacher.indexpage;
module.exports= {

  components:{Datepicker},

  data: function () {
    return {

      activeclass:'tab-pane active animated bounceInRight',
      inactiveclass:'tab-pane  animated bounceInRight',
      isedit:false,
      teacher: {
        id: null,
        profile: null,
        firstName:null,
        lastName:null,
        fullName:null,
        dateofbirth: null,
        gender: 'Male',
        phone: null,
        nrc: null,
        religion: null,
        nationality: null,
        address: null,
        degree: null,
        contactFirstName: null,
        contactLastName: null,
        contactEmail: null,
        contactphone: null,
        contactrelation: null,
        position:null,
        salary:0,
        benefit:null,
        join_date:null,
        biography:null,
        personal_email:null,
      },

      countries:[]
    }
  },

  methods: {
    handleTab() {
      $('.nav li').not('.active').addClass('disabled');
      $('.nav li').not('.active').find('a').removeAttr("data-toggle");

      $('button').click(function () {
        /*enable next tab*/
        $('.nav li.active').next('li').removeClass('disabled');
        $('.nav li.active').next('li').find('a').attr("data-toggle", "tab");
      });
    },

    employee_back_click(){
      $('#teacher_form a[href="#personal_detail"]').tab('show');
    },
    contact_back(){
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
           if(scope=='personal_detail_form'){
            $('#teacher_form a[href="#employee_detail"]').tab('show');
          }else if(scope=='employee_form'){
            $('#teacher_form a[href="#contact_info"]').tab('show');
          }else if(scope=='contact_form'){
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
      data.append('fullName',this.teacher.firstName+' '+this.teacher.lastName);
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

      const config = { headers: { 'Content-Type': 'multipart/form-data' } };
      axios.post(create, data,config).then(response => {
        console.log(response.data.success);
        if (response.data.success == false) {
          Notification.error('Error occur while inserting data.');
        } else {
          // window.location.href=indexpage;
        }
      }).catch(error => {
        if (error.response.status == 401 ||error.response.status==419) {
          window.location.href = route.urls.login;
        } else if (error.response.status == 422) {
          Notification.error('Invalid Data.');
        } else {
          Notification.error('Error occur while inserting data.');
        }
      });
    },
  },
  mounted () {
    this.teacher.dateofbirth = this.formatDate(new Date());
    this.teacher.join_date = this.formatDate(new Date());
    this.countries=Helper.countries();
    this.handleTab();
  }
}