const VuePagination = resolve => require(['../core/VuePagination'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
const ActionGrade = resolve => require(['../grade_teacher/action'], resolve);
let _getdata=route.urls.assign_teacher.getdata;
let _remove=route.urls.assign_teacher.remove;
let _getbycategorygrade=route.urls.assign_teacher.getbycategorygrade;

module.exports= {

  components: {
    ActionGrade,VuePagination,DeleteModal
  },

  data: function () {
    return {
      removeUrl:_remove,
      active_academic: null,
      isedit: false,
      pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1,
        last_page: 1,
      },
      grades:[],
      selected_grade:null,

      gradeteacher_id:null,
      grade_teachers: [],
      grade_teacher: {id: null, academic_id: null, grade_id: null, teacher_id: null, subject_id: null,academic:null,grade:null,subject:null,teacher:null},
    }
  },

  methods: {
    getGrades () {
      axios.get('/admin/category/get-with-category').then(({data}) => {
        this.grades = data.grades;
        this.active_academic = data.active_academic;
      });
    },
    selectedGradeChange(value){
      if(value==null){ this.getData(_getdata);return;}
        axios.get(_getbycategorygrade+'grade_id='+this.selected_grade.id).then(({data}) => {
          this.grade_teachers = data.data;
          this.pagination = data;
        });
    },
    getData(_url){
      axios.get(_url+this.pagination.current_page).then(({data})=>{
        this.pagination=data;
        this.grade_teachers=data.data;
      });
    },
    successperform(){
      this.getData(_getdata);
    },
    successdelete(){
      $('#deleteModal').modal('hide');
      this.gradeteacher_id=null;
      this.getData(_getdata);
    },
    showAddModal () {
      this.isedit = false;
    },
    showDeleteModal (id) {
      this.gradeteacher_id =id;
      $('#deleteModal').modal('show');
    },
    showEditModal(grade_teacher){
      this.isedit=true;

      var temp = Object.assign({}, grade_teacher);
      this.grade_teacher = temp;
      $('#courseteacher-modal').modal('show');
    },
  },

  mounted () {
    this.getGrades();
    this.getData(_getdata);
  }
}