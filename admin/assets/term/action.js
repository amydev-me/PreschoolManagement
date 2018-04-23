const datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);
// const AcademicSelect = resolve => require(['../select_components/AcademicSelect'], resolve);
const CategorySelect = resolve => require(['../select_components/CategorySelect'], resolve);
let create=route.urls.term.create;
let update=route.urls.term.update;

module.exports={
  props:['term','isedit','academics'],
  components:{datepicker,CategorySelect},
  data:function () {
    return {
      selected_academic: null,
      selected_category:null,

      performdata: {
        id: null,
        termName: null,
        academic_id: null,
        category_id:null,
        start_date: null,
        end_date: null,
        due_date: null
      }
    }
  },
  methods: {
    customLabel ({ academicName, active_year }) {
      return `${academicName}  ${active_year==1?'(Active)':''}`
    },
    selectedCategoryChange(value){
      this.selected_category=value;
    },
    selectedAcadmiceChange(value){
      this.selected_academic=value;
    },
    formatDate (date) {
      return Helper.formatDate(date);
    },

    showModal(){
      if(this.isedit){
        this.performdata.id = this.term.id;
        this.performdata.termName = this.term.termName;
        this.performdata.academic_id = this.term.academic_id;
        this.performdata.category_id = this.term.category_id;
        this.performdata.start_date = this.formatDate(this.term.start_date);
        this.performdata.end_date = this.formatDate(this.term.end_date);
        this.performdata.due_date = this.formatDate(this.term.due_date);
        this.selected_academic=this.term.academic;
        this.selected_category=this.term.category;
      }else{
        this.performdata.id = null;
        this.performdata.termName = null;
        this.performdata.academic_id = null;
        this.performdata.start_date=this.formatDate(new Date());
        this.performdata.end_date=this.formatDate(new Date());
        this.performdata.due_date=this.formatDate(new Date());
        this.selected_academic=this.term==null?null:this.term;
        this.selected_category=null;
        this.$validator.reset();
      }
    },
    submitdata () {
      this.$validator.validateAll().then(successsValidate => {
        if (successsValidate) {
          let _url = this.isedit ? update : create;
          this.performAction(_url);
        }
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Opps!Something went wrong.');
        }
      });
    },

    performAction (url) {
      this.performdata.academic_id=this.selected_academic.id;
      this.performdata.category_id=this.selected_category.id;
      axios.post(url, this.performdata).then((data) => {

        if (data.data.success) {
          Notification.success('Success');
          this.$emit('success');
        } else {
          Notification.error('Failed.');
        }
      });
    },
  },
  mounted () {
    $(this.$refs.thismodel).on("shown.bs.modal", this.showModal);
  }
}