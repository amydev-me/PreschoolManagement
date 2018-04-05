const VuePagination = resolve => require(['../core/VuePagination'], resolve);
const CategorySelect = resolve => require(['../select_components/CategorySelect'], resolve);

let _studentImage=route.urls.student_image;
module.exports= {
  components:{VuePagination,CategorySelect},
  data: function () {
    return {
      students: [],
      pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1,
        last_page: 1,
      },
      filterValue: null,
      academics: [],
      selected_academic: null,
      grades: [],
      selected_grade: null,
      categories: [],
      selected_category: null
    }
  },
  methods: {
    goDetailView (id) {
      return '/admin/student/detail-view?student_id='+id;
    },
    getImage (profile) {
      if (profile == null) return;
      return _studentImage + profile;
    },
    getDataByAcademic () {
      axios.get('/admin/student/get-by-academic?page=' + this.pagination.current_page).then(({data}) => {
        this.students = data.students.data;
        this.pagination = data.students;
        this.academics = data.academics;
        this.categories = data.categories;
        this.selected_academic = data.active_academic;
      });
    },
    selectedGradeChange () {
      if (this.selected_grade == null) return;

      axios.get('/admin/student/get-by-acg?academic_id='
        + this.selected_academic.id + '&category_id='
        + this.selected_category.id
        + '&grade_id=' + this.selected_grade.id
        + '&page=' + this.pagination.current_page)
        .then(({data}) => {
          this.students = data.data;
          this.pagination = data;
        });
    },
    searchClick () {

      this.pagination.current_page=1;
      if (this.filterValue == null) {this.getDataByAcademic();return;};
      if (this.filterValue == '') {this.getDataByAcademic();return;};
      axios.get('/admin/student/filter?param='
        + this.filterValue+'&academic_id='
        +this.selected_academic.id+'&page='
        +this.pagination.current_page)
        .then(({data}) => {
          this.students = data.data;
          this.pagination = data;
      });
    },
    selectedCategoryChange () {
      if (this.selected_category == null)  {this.getDataByAcademic();return;}
      this.selected_grade=null;
      axios.get('/admin/student/get-by-ac?academic_id=' + this.selected_academic.id + '&' + 'category_id=' + this.selected_category.id)
        .then(({data}) => {
        this.grades = data.grades;
        this.students = data.students.data;
        this.pagination = data.students;
      });
    },
    paginationdata(){
      if(this.selected_category!=null&&this.selected_category!=null){
        if(this.filterValue==null){
          this.selectedGradeChange();
        }else{
          this.searchClick();
        }
      }else{
        this.getDataByAcademic();
      }
    }
  },
  mounted () {
    this.getDataByAcademic();
  }
}