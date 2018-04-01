// const EditComponent=resolve => require(['./edit'], resolve);
// const TeacherInfo = resolve => require(['./info'], resolve);
// const TeacherGrade = resolve => require(['./teachergrade'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
let teacherImageUrl=route.urls.teacher_image;
let _getdetail=route.urls.teacher.details;
let _remove=route.urls.teacher.remove;
let _indexpage=route.urls.teacher.indexpage;
module.exports= {
  components: {

    DeleteModal
    // TeacherInfo, TeacherGrade,EditComponent
  },
  data: function () {
    return {
      destoryinfo:false,
      gradeclick:false,
      editclick:false,
      teacher: {
        id: null,
        profile: null,
        firstName:'',
        lastName:'',
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
      teacher_id:null,
      removeUrl:_remove,
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

    getDetail () {
      axios.get(_getdetail + this.teacher.id).then(response => {

        this.teacher=response.data;

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