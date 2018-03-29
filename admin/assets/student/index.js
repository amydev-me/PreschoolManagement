let _getgrade=route.urls.grade.getgrade;
module.exports= {
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
      return '';
    },
    getImage (profile) {
      if (profile == null) return;
      return '/image/student/' + profile;
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

    },
    searchClick () {
      if (this.filterValue == null) return;
      if (this.filterValue == '') return;
      axios.get('/admin/student/filter/' + this.filterValue+'/'+this.selected_academic.id).then(({data}) => {
        this.students = data.data;
        this.pagingType = data;
      });
    },
    selectedCategoryChange () {
      if (this.selected_category.id == null) return;
      axios.get(_getgrade + '?academic_id=' + this.selected_academic.id + '&' + 'category_id=' + this.selected_category.id).then(({data}) => {
        this.grades = data;
      });
    }
  },
  mounted () {
    this.getDataByAcademic();
  }
}