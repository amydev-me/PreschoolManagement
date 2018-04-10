const VuePagination = resolve => require(['../core/VuePagination'], resolve);
const CategorySelect = resolve => require(['../select_components/CategorySelect'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
let _getdata=route.urls.grade.getdata;
let _remove=route.urls.grade.remove;

module.exports= {
  components: { DeleteModal, VuePagination,CategorySelect},
  data: function () {
    return {
      active_academic:null,
      filtertext:null,
      removeUrl: _remove,
      grade: null,
      grades: [],
      grade_id: null,
      pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1,
        last_page: 1,
      }
    }
  },
  methods: {
    showDeleteModal (id) {
      this.grade_id = id;
      $('#deleteModal').modal('show');
    },
    successdelete () {
      $('#deleteModal').modal('hide');
      Notification.success('Success');
      this.getData(_getdata);
    },
    selectedCategoryChange(value){
      if(value==null){
        this.getData(_getdata);
      }else{
        this.getData('/admin/grade/get-bycategory?category_id='+value.id);
      }

    },
    getData (url) {
      axios.get(url).then(({data}) => {

        this.grades = data.grades;
        this.active_academic = data.academic;
      });
    },

    successdelete () {
      $('#deleteModal').modal('hide');
      Notification.success('Success');
      this.getData(_getdata);
    },

    searchClick () {
      if(this.selected_category==null){
        this.getData(_getdata);
      }else{
        this.selectedCategoryChange(this.selected_category);
      }
    },

  },
  mounted () {
    this.getData(_getdata);
  }
}