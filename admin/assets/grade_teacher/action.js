const CategorySelect = resolve => require(['../select_components/CategorySelect'], resolve);
let _create=route.urls.assign_teacher.create;
let _update=route.urls.assign_teacher.update;
let _asyncteacher=route.urls.teacher.asyncget;


module.exports= {
  componets:{CategorySelect},
  props:['grade_teacher','isedit','grades','active_academic'],
  data: function () {
    return {
      subjects:[],

      grade_teachers: [],
      // selected_category: null,
      // grades: [],
      selected_grade: null,
      teachers: [],
      selected_teacher: null,
      selected_subject: null,
      performdata: {id: null, academic_id: null, grade_id: null, teacher_id: null, subject_id: null},
    }
  },
  methods: {
    asyncSubject(){
      axios.get('/admin/subject/async-get').then(({data})=>{
        this.subjects=data;
      })
    },
    asyncFindTeacher (query) {
      if (query == '') {return;}
      if (query == undefined) {return;}
      axios.get(_asyncteacher + query).then(response => {
        this.teachers = response.data;
      });
    },
    submitdata () {
      this.$validator.validateAll().then(successsValidate => {
        if (successsValidate) {
          let _url = this.isedit ? _update : _create;
          this.performAction(_url);
        }
      }).catch(error => {
        Notification.warning('Invalid data.');
      });
    },
    performAction (url) {
      this.performdata.id = this.grade_teacher.id;
      this.performdata.academic_id = this.active_academic.id;
      this.performdata.grade_id = this.selected_grade.id;
      this.performdata.subject_id = this.selected_subject.id;
      this.performdata.teacher_id = this.selected_teacher.id;

      axios.post(url, this.performdata).then(response => {
        Notification.success('Success');
        $('#courseteacher-modal').modal('hide');
        this.$emit('submit');
      }).catch(error => {
        if (error.response) {
          if (error.response.status == 401 || error.response.status == 419) {
            window.location.href = route.urls.login;
          } else {
            if (error.response.data.message) {
              Notification.error(error.response.data.message);
              return;
            }
            Notification.error('Invalid data.');
          }
        }
      });
    },
    showModal() {
      if (this.isedit) {
        this.selected_grade = this.grade_teacher.grade;
        this.selected_subject = this.grade_teacher.subject;
        this.selected_teacher = this.grade_teacher.teacher;
      }
    },
    clearOnHidden(){
      this.performdata.id = null;
      this.performdata.teacher_id = null;
      this.performdata.grade_id = null;
      this.performdata.subject_id = null;
      this.selected_grade = null;
      this.selected_teacher = null;
      this.$validator.reset();
    }
  },
  mounted () {
    this.asyncSubject();
    $(this.$refs.thismodel).on("hidden.bs.modal", this.clearOnHidden);
    $(this.$refs.thismodel).on("shown.bs.modal", this.showModal);
  }
}