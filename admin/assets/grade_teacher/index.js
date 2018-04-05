const VuePagination = resolve => require(['../core/VuePagination'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
const CategorySelect = resolve => require(['../select_components/CategorySelect'], resolve);
const ActionGrade = resolve => require(['../grade_teacher/action'], resolve);
let _getdata=route.urls.assign_teacher.getdata;
let _remove=route.urls.assign_teacher.remove;
let _getbycategorygrade=route.urls.assign_teacher.getbycategorygrade;
let _getbycategory=route.urls.assign_teacher.getbycategory;

let _asynccategory=route.urls.get_active_category;
let _getgrade=route.urls.grade.getgrade;
module.exports= {

  components: {
    ActionGrade,VuePagination,DeleteModal,CategorySelect
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
      categories:[],
      subjects:[],
      selected_category:null,
      gradeteacher_id:null,
      grade_teachers: [],
      grade_teacher: {id: null, academic_id: null, grade_id: null, teacher_id: null, subject_id: null,academic:null,grade:null,subject:null,teacher:null},
    }
  },

  methods: {
    getGrade(){
      return axios.get(_getgrade + '?category_id=' + this.selected_category.id);
    },
    getByCategory(){
      return axios.get(_getbycategory+this.selected_category.id);
    },

    selectedGradeChange(){
      if (this.selected_grade == null) {
        this.getData(_getdata);
        return;
      }
      axios.get(_getbycategorygrade+'category_id='+this.selected_category.id+'&grade_id='+this.selected_grade.id).then(({data}) => {
        this.grade_teachers = data.data;
        this.pagination = data;
      });
    },
    selectedCategoryChange (value) {
      this.selected_grade = null;
      this.grades=[];
      this.selected_category=value;
      if (this.selected_category == null) {
        this.getData(_getdata);
        return;
      }

      axios.all([this.getGrade(), this.getByCategory()])
        .then(axios.spread((grades, teachers) => {
          this.grades = grades.data;
          this.pagination = teachers.data;
          this.grade_teachers = teachers.data.data;
        }));
    },
    getData(_url){
      axios.get(_url+this.pagination.current_page).then(({data})=>{
        this.pagination=data;
        this.grade_teachers=data.data;
      });
    },
    asyncCategory () {
      axios.get(_asynccategory).then(({data}) => {
        this.active_academic = data.active;
        this.categories = data.categories;
        this.subjects = data.subjects;
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
    this.asyncCategory();
    this.getData(_getdata);
  }
}