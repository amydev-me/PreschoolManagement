const EditComponent=resolve => require(['./edit'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
let _studentImage=route.urls.student_image;
let _remove=route.urls.student.remove;
let _indexpage=route.urls.student.indexpage;
module.exports={
  components:{EditComponent,DeleteModal},
  data:function () {
    return {
      student_id:null,
      removeUrl:_remove,
      gradeName:null,
      editview:false,
      student: {
        id: null,
        email: null,
        profile: null,
        firstName: '',
        lastName: '',
        fullName:'',
        studentCode: null,
        dateofbirth: null,
        gender: 'Male',
        phone: null,
        nrc: null,
        nationality: null,
        address: null,
        join_date: null,
        history: null,
      },
      guardian:{
        id:null,
        firstName: null,
        lastName: null,
        fullName:null,
        email: null,
        phone: null,
        relation: null,
        occupation: null,

        address: null
      },
      terms:[]
    }
  },
  methods: {
    checkUrlParam () {
      let student_id = Helper.getUrlParameter('student_id');
      if (student_id != null) {
        this.student.id = student_id;
        this.getDetail();
      }
    },
    formatDate (date) {
      return Helper.formatDate(date);
    },
    getHistory(history){
      if (history == null) return;
      return '/admin/student/get-file/' + history;
    },
    getImage (profile) {
      if (profile == null) return;
      console.log(_studentImage);
      return _studentImage + profile;
    },
    editSuccess (value) {
      if (value) {
        this.getDetail();
      }
    },
    showDeleteModal () {
      this.student_id = this.student.id;
      $('#deleteModal').modal('show');
    },
    successdelete () {
      $('#deleteModal').modal('hide');
      Notification.success('Success');
      window.location.href = _indexpage;
    },
    getDetail () {
      axios.get('/admin/student/get-detail?student_id=' + this.student.id).then(({data}) => {
        let student = data.student;
        this.student.id = student.id;
        this.student.studentCode = student.studentCode;
        this.student.email = student.email;
        this.student.profile = student.profile;
        this.student.firstName = student.firstName;
        this.student.lastName = student.lastName;
        this.student.fullName = student.fullName;
        this.student.dateofbirth = this.formatDate(student.dateofbirth);
        this.student.guardian_id = student.guardian_id;
        this.student.gender = student.gender;
        this.student.phone = student.phone;
        this.student.nrc = student.nrc;
        this.student.nationality = student.nationality;
        this.student.address = student.address;
        this.student.join_date = this.formatDate(student.join_date);
        this.student.meal_preferences = student.meal_preferences;
        this.student.allergies = student.allergies;
        this.student.history = student.history;
        if(student.guardian !=null) {
          this.guardian = student.guardian;
        }
        if(student.terms !=null) {
          this.terms = student.terms;
          this.gradeName=this.terms.length>0?this.terms[0].gradeName:null;
        }

      });
    }
  },
  mounted(){
    this.checkUrlParam();
  }
}