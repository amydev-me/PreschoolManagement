const action = resolve => require(['./action'], resolve);
const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
const AcademicSelect = resolve => require(['../select_components/AcademicSelect'], resolve);
let _getdata=route.urls.term.getdata;
let _getbyacademic=route.urls.term.getby_academic;
let _remove=route.urls.term.remove;

module.exports= {
  components: { DeleteModal, action,AcademicSelect},
  data: function () {
    return {
      active_academic:null,
      isedit:false,
      removeUrl: _remove,
      terms: [],
      term_id: null,
      term:null,
    }
  },
  methods: {
    testFormat (date) {
      return Helper.testFormat(date);
    },
    formatDate (date) {
      return Helper.formatDate(date);
    },
    shortFormat (date) {
      return Helper.shortFormat(date);
    },
    selectedAcadmiceChange(value){
      if(value==null){
        this.getData(_getdata);
      }else{
        axios.get(_getbyacademic+value.id).then(({data}) => {
          this.terms = data;
        });
      }
    },
    getData (url) {
      axios.get(url).then(({data}) => {
        this.terms = data.terms;

        this.active_academic = data.academic;
      });
    },
    showAddModal(){
      this.isedit = false;
      if(this.active_academic !=null){
        this.term = Object.assign({}, this.active_academic);
      }


      $('#mymodal').modal('show');
    },
    showEditModal (term) {
      this.term = Object.assign({}, term);
      this.isedit = true;
      $('#mymodal').modal('show');
    },
    showDeleteModal (id) {
      this.term_id = id;
      $('#deleteModal').modal('show');
    },
    successdelete () {
      $('#deleteModal').modal('hide');
      Notification.success('Success');
      this.getData(_getdata);
    },
    successdata(){
      $('#mymodal').modal('hide');
      this.getData(_getdata);
    }
  },
  mounted () {
    this.getData(_getdata);
  }
}