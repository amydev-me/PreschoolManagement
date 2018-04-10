
const AcademicSelect = resolve => require(['../select_components/AcademicSelect'], resolve);
const CategorySelect = resolve => require(['../select_components/CategorySelect'], resolve);

let update=route.urls.grade.update;

module.exports= {
  props:['grade','isedit'],
  components: { CategorySelect,AcademicSelect},

  data: function () {
    return {
      selected_academic: null,
      academics: [],
      categories: [],
      selected_category: null,
      performdata: {
        id: null,
        category_id: null,
        academic_id: null,
        gradeName: null,
        description: null

      }
    }
  },

  methods: {
    selectedCategoryChange(value){
      this.selected_category=value;
    },
    selectedAcadmiceChange(value){
      this.selected_academic=value;
    },

    submitdata () {
      this.$validator.validateAll().then(successsValidate => {
        if (successsValidate) {

          this.performAction(update);
        }
      }).catch(error => {
        Notification.warning('Invalid data.');
      });
    },

    performAction (url) {

      this.performdata.academic_id=this.selected_academic.id;
      this.performdata.category_id=this.selected_category.id;

      axios.post(url, this.performdata).then(({data}) => {
        if(data.success==true){
          this.$emit('success');
        }else{
          Notification.error('Opps!Something went wrong.');
        }
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Opps!Something went wrong.');
        }
      });
    },
    showModal(){

        this.performdata.id = this.grade.id;
        this.performdata.gradeName = this.grade.gradeName;
        this.performdata.academic_id = this.grade.academic.id;
        this.performdata.category_id = this.grade.category.id;
        this.performdata.description = this.grade.description;
        this.selected_academic=this.grade.academic;
        this.selected_category=this.grade.category;

    }
  },

  mounted () {
    $(this.$refs.thismodel).on("shown.bs.modal", this.showModal);
  }
}