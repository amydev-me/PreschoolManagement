const EditComponent=resolve => require(['./edit'], resolve);

const GradeTeacher = resolve => require(['./grade_teacher'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
let teacherImageUrl=route.urls.teacher_image;
let _getdetail=route.urls.teacher.details;
let _remove=route.urls.teacher.remove;
let _indexpage=route.urls.teacher.indexpage;
module.exports= {
  components: {
    DeleteModal,EditComponent,GradeTeacher
  },
  data: function () {
    return {
      gradeclick:false,
      editclick:false,
      teacher_id:null,
      removeUrl:_remove,
      teacher: {
        id: null,
        profile: null,
        firstName:'',
        lastName:'',
        fullName:'',
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
        position:'Lead Teacher',
        salary:0,
        benefit:null,
        biography:null,
        join_date:null,
        personal_email:null
      },
      edit_teacher:null
    }
  },

  methods: {
    checkUrlParam () {
      let teacher_id = Helper.getUrlParameter('teacher_id');
      if (teacher_id != null) {
        this.teacher.id = teacher_id;
        this.getDetail();
      }
    },

    formatDate (date) {
      return Helper.formatDate(date);
    },

    getImage (profile) {
      if(profile==null) return;
      return teacherImageUrl + profile;
    },
    showDeleteModal () {
      this.teacher_id = this.teacher.id;
      $('#deleteModal').modal('show');
    },
    successdelete () {
      $('#deleteModal').modal('hide');
      Notification.success('Success');
      window.location.href = _indexpage;
    },
    editSuccess (value) {
      if (value) {
        this.getDetail();
      }
    },
    getDetail () {
      axios.get(_getdetail + this.teacher.id).then(response => {

        this.teacher=response.data;
        this.teacher.dateofbirth=this.formatDate( this.teacher.dateofbirth);
        this.teacher.join_date=this.formatDate( this.teacher.join_date);
        this.edit_teacher = Object.assign({}, this.teacher);
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href =route.urls.login;
        } else {
          Notification.error('Error occured while loading data.');
        }
      });
    },

  },
  mounted () {
    this.checkUrlParam();
  }
}