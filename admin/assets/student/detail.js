const EditComponent=resolve => require(['./edit'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
const AttendanceChart=resolve => require(['./attendance'], resolve);
const AttendanceDetail=resolve => require(['./attendance_detail'], resolve);
const PaymentList=resolve => require(['./payment'], resolve);
let _studentImage=route.urls.student_image;
let _remove=route.urls.student.remove;
let _indexpage=route.urls.student.indexpage;
module.exports={
  components:{EditComponent,DeleteModal,AttendanceChart,AttendanceDetail,PaymentList},
  data:function () {
    return {
      student_id:null,
      removeUrl:_remove,
      gradeName:null,
      editview:false,
      student: {
        academic_id: null,
        grade_id: null,
        profile: null,
        studentCode: null,
        fullName: null,
        otherName: null,
        join_date: null,
        em_name: null,
        em_relation: null,
        em_contact: null,
        student_live: null,
        student_personal_information: {
          dateofbirth: null,
          gender: null,
          placeofbirth:null,
          nationality: null,
          langhome: null,
          religion: null
        },
        student_background: {
          previous_one: null,
          one_date: null,
          one_file: null,
          previous_two: null,
          two_date: null,
          two_file: null
        },
        sibling_information: {
          student_id: 1,
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
          sb_three_school: null
        },
        student_medical: {
          student_id: 1,
          asthma: 0,
          asthma_remark: null,
          allergies: 0,
          allergies_remark: null,
          diabetes: 0,
          diabetes_remark: null,
          epilepsy: 0,
          epilepsy_remark: null,
          tuberculosis: 0,
          tuberculosis_remark: null,
          others: null,
          medication: null,
          immunized: null,
          immunized_remark: null,
          immunized_file: null,
          emotional: null,
          disabilities: null,
          behavioral: null
        },
        student_guardian: {
          student_id: 1,
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
          g_two_work: null
        }
      },

      terms:[]
    }
  },
  methods: {
    checkUrlParam () {
      let student_id = Helper.getUrlParameter('student_id');
      if (student_id != null) {
        this.student_id=student_id;
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

      return _studentImage + profile;
    },
    editSuccess (value) {
      if (value) {
        this.getDetail();
      }
    },
    showDeleteModal () {

      $('#student_deletemodal').modal('show');
    },
    successdelete () {
      $('#student_deletemodal').modal('hide');
      Notification.success('Success');
      window.location.href = _indexpage;
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
        if(student.student_guardian !=null)this.student.student_guardian = student.student_guardian;
        if(student.grade !=null) {
          this.gradeName=student.grade.gradeName;
        }

      });
    }
  },
  mounted(){
    this.checkUrlParam();
  }
}