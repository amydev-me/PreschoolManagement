const DeleteGrade = resolve => require(['../core/DeleteModal'], resolve);
let _create=route.urls.assign_teacher.create;
let _update=route.urls.assign_teacher.update;
let _remove=route.urls.assign_teacher.remove;
let _getbyteacher=route.urls.assign_teacher.getbyteacher;
module.exports= {
  components: {DeleteGrade},
  data: function () {
    return {
      removeUrl: _remove,
      isedit: false,
      teacher_id: null,
      assign_id: null,
      grade_teachers: [],

      active_academic: null,

      grades: [],
      selected_grade: null,

      subjects: [],
      selected_subject: null,
      performdata: {id: null, academic_id: null, grade_id: null, teacher_id: null, subject_id: null},
    }
  },
  methods: {
    asyncSubject () {
      axios.get('/admin/subject/async-get').then(({data}) => {
        this.subjects = data;
      })
    },
    getGrades () {
      axios.get('/admin/category/get-with-category').then(({data}) => {
        this.grades = data.grades;
        this.active_academic = data.active_academic;
      });
    },
    checkUrlParam () {
      let teacher_id = Helper.getUrlParameter('teacher_id');
      if (teacher_id != null) {
        this.teacher_id = teacher_id;
        this.getData();
        this.getGrades();
      }
    },
    getData () {
      axios.get(_getbyteacher + this.teacher_id).then(({data}) => {
        this.grade_teachers = data;
      });
    },

    showEditModal (grade_teacher) {
      this.isedit = true;
      var temp = Object.assign({}, grade_teacher);
      this.assign_id = temp.id;
      this.active_academic = temp.academic;
      this.selected_grade = temp.grade;
      this.selected_subject = temp.subject;

      this.selected_category = temp.grade.category;
      $('#courseteacher-modal').modal('show');
    },
    showAddModal () {
      this.isedit = false;
      $('#courseteacher-modal').modal('show');
    },
    showDeleteModal (id) {
      this.assign_id = id;
      $('#deletegrade_modal').modal('show');
    },
    successdelete () {
      $('#deletegrade_modal').modal('hide');
      this.assign_id = null;
      this.getData();
    },
    clearOnHidden () {
      this.performdata.id = null;
      this.performdata.grade_id = null;
      this.performdata.subject_id = null;
      this.selected_grade = null;
      this.selected_teacher = null;
      this.selected_subject = null;

      this.$validator.reset();
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
      this.performdata.id = this.assign_id;
      this.performdata.teacher_id = this.teacher_id;
      ;
      this.performdata.academic_id = this.active_academic.id;
      this.performdata.grade_id = this.selected_grade.id;
      this.performdata.subject_id = this.selected_subject.id;
      axios.post(url, this.performdata).then(response => {
        Notification.success('Success');
        $('#courseteacher-modal').modal('hide');
        this.getData();
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
  },
  mounted () {
    this.asyncSubject();
    this.checkUrlParam();
    $(this.$refs.thismodel).on("hidden.bs.modal", this.clearOnHidden);
  }
}