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
      selected_academic: null,
      grades: [],
      selected_grade: null,

    }
  },
  methods: {
    getGades () {
      axios.get('/admin/category/get-with-category').then(({data}) => {
        this.grades = data.grades;
        this.active_academic = data.active_academic;
      });
    },
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
        this.selected_academic = data.active_academic;
      });
    },
    selectedGradeChange () {
      if (this.selected_grade == null) {
        this.getDataByAcademic();
        return;
      }

      axios.get('/admin/student/get-studentby-grade?grade_id=' + this.selected_grade.id
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
    this.getGades();
    this.getDataByAcademic();
  }
}