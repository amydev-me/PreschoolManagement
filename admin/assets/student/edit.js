const Datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);
let asyncurl=route.urls.academic.asyncget;
let _update=route.urls.student.update;
module.exports= {
 props:
   {
     isedit: {
       default: false
     },
   },

  components: {Datepicker},
  data: function () {
    return {
      academics:[],
      selected_academic: null,
      grades: [],
      selected_grade: null,
      countries: [],
      profile: null,
      edu_one: null,
      edu_two: null,
      medical_files: null,
      student: {
        id: null,
        academic_id: null,
        grade_id: null,
        profile: null,
        fullName: null,
        otherName: null,
        join_date: null,
        em_name: null,
        em_relation: null,
        em_contact: null,
        student_live: null
      },
      personal_info: {
        student_id: null,
        dateofbirth: null,
        gender: 'Male',
        placeofbirth: null,
        nationality: null,
        langhome: null,
        religion: null
      },
      education: {
        student_id: null,
        previous_one: null,
        one_date: null,
        one_file: null,
        previous_two: null,
        two_date: null,
        two_file: null,
      },
      sibling_info: {
        student_id: null,
        sb_one_name: null,
        sb_one_gender: null,
        sb_one_dob: null,
        sb_one_school: null,
        sb_two_name: null,
        sb_two_gender: null,
        sb_two_dob: null,
        sb_two_school: null,
        sb_three_name: null,
        sb_three_gender: null,
        sb_three_dob: null,
        sb_three_school: null,
      },
      medical: {
        student_id: null,
        asthma: false,
        asthma_remark: null,
        allergies: false,
        allergies_remark: null,
        diabetes: false,
        diabetes_remark: null,
        epilepsy: false,
        epilepsy_remark: null,
        tuberculosis: false,
        tuberculosis_remark: null,
        others: null,
        others_check:null,
        medication: null,
        immunized: null,
        immunized_remark: null,
        immunized_file: null,
        emotional: null,
        disabilities: null,
        behavioral: null,
      },
      guardian: {
        student_id: null,
        g_one_name: null,
        g_one_relation: null,
        g_one_email: null,
        g_one_occupation: null,
        g_one_address: null,
        g_one_mobile: null,
        g_one_home: null,
        g_one_work: null,

        g_two_name: null,
        g_two_relation: null,
        g_two_email: null,
        g_two_occupation: null,
        g_two_address: null,
        g_two_mobile: null,
        g_two_home: null,
        g_two_work: null,
      }
    }
  },

  methods: {
    selectedAcadmiceChange(value){
      if(value==null){this.selected_grade=null;this.grades=[];return;}
      axios.get('/admin/category/get-with-category-byacademic/'+value.id).then(({data}) => {
        this.grades = data;
      });
    },

    customLabel ({ academicName, active_year }) {
      return `${academicName}  ${active_year==1?'(Active)':''}`
    },
    edu_back(){
      $('#student_form a[href="#personal_tab"]').tab('show');
    },
    sib_back(){
      $('#student_form a[href="#background_tab"]').tab('show');
    },
    medican_back(){
      $('#student_form a[href="#sibling_tab"]').tab('show');
    },
    em_back(){
      $('#student_form a[href="#medical_tab"]').tab('show');
    },
    guardian_back(){
      $('#student_form a[href="#em_tab"]').tab('show');
    },
    inputFile (event,inputby) {
      let files = event.target.files;
      if (files.length) {
        if(inputby=='profile'){
          this.profile = files[0];
        }else if(inputby=='edu_one'){
          this.edu_one=files[0];
        }
        else if(inputby=='edu_two'){
          this.edu_two=files[0];
        }
        else if(inputby=='medical'){
          this.medical_files=files[0];
        }
      }
    },
    formatDate (date) {
      return Helper.formatDate(date);
    },

    getDetail () {
      axios.get('/admin/student/get-detail?student_id=' + this.student.id).then(({data}) => {
        let student = data.student;
        this.student.academic_id = student.academic_id;
        this.student.grade_id =student.grade_id;
        this.student.profile = student.profile;
        this.student.fullName = student.fullName;
        this.student.otherName = student.otherName;
        this.student.join_date = student.join_date;
        this.student.em_name = student.em_name;
        this.student.em_relation = student.em_relation;
        this.student.em_contact = student.em_contact;
        this.student.student_live = student.student_live;
        if(student.student_personal_information !=null)this.personal_info = student.student_personal_information;
        if(student.student_background !=null)this.education = student.student_background;
        if( student.sibling_information !=null)this.sibling_info = student.sibling_information;
        if(student.student_medical !=null)this.medical = student.student_medical;
        if(student.student_guardian !=null)this.guardian = student.student_guardian;

        this.selected_academic=student.academic;
        this.selected_grade=student.grade;
        axios.get('/admin/category/get-with-category-byacademic/'+student.academic.id).then(({data}) => {
          this.grades = data;
        });

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

    validateData (scope) {

      this.$validator.validateAll(scope).then(successsValidate => {
        if (successsValidate) {
          if(scope=='personal_info_form'){
            $('#student_form a[href="#background_tab"]').tab('show');
          }else if(scope=='background_form'){

            $('#student_form a[href="#sibling_tab"]').tab('show');
          }else if(scope=='sibling_form'){
            $('#student_form a[href="#medical_tab"]').tab('show');
          }
          else if(scope=='medical_form'){
            $('#student_form a[href="#em_tab"]').tab('show');
          }
          else if(scope=='emergency_form'){
            $('#student_form a[href="#guardian_tab"]').tab('show');
          }else{
            this.performAction();
          }
        }
      }).catch(error => {});
    },
    performAction () {
      this.student.academic_id=this.selected_academic.id;
      this.student.grade_id=this.selected_grade.id;
      let data = new FormData();
      data.set('student',JSON.stringify(this.student));
      data.set('personal_info', JSON.stringify(this.personal_info));
      data.set('education',JSON.stringify(this.education));
      data.set('sibling_info', JSON.stringify(this.sibling_info));
      data.set('medical', JSON.stringify(this.medical));
      data.set('guardian', JSON.stringify(this.guardian));
      data.append('profile', this.profile);
      data.append('edu_one', this.edu_one);
      data.append('edu_two', this.edu_two);
      data.append('medical_files', this.medical_files);

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
    asyncAcademicGet () {
      axios.get(asyncurl).then(({data}) => {
        this.academics = data;
      });
    },
  },
  mounted () {
    this.countries = Helper.countries();
    this.asyncAcademicGet();
    this.checkUrlParam();
  }
}