const AcademicSelect = resolve => require(['../select_components/AcademicSelect'], resolve);
const CategorySelect = resolve => require(['../select_components/CategorySelect'], resolve);
const NumericInput = resolve => require(['../core/NumericInput'], resolve);
let create=route.urls.grade.create;
let getby_category=route.urls.term.getby_category;
let _indexpage=route.urls.grade.indexpage;
module.exports= {
  components: { CategorySelect,AcademicSelect,NumericInput},
  data: function () {
    return {
      selected_academic: null,
      academics: [],
      categories: [],
      selected_category: null,
      terms:[],
      performdata: {
        id: null,
        category_id: null,
        academic_id: null,
        gradeName: null,
        description: null
      },
      sections:[]
    }
  },

  methods: {
    checkedChanged(term,index){
      if(term.ischecked){
        this.terms[index].amount=0;
      }
    },
    selectedCategoryChange(value){
      this.selected_category=value;
      if(this.selected_academic==null){ return;}
      if(value==null) {return;}
      axios.get(getby_category+this.selected_academic.id+'&category_id='+value.id).then(({data})=>{
        let _terms=data;
        var result = _terms.map(function(el) {
          var o = Object.assign({}, el);
          o.ischecked = false;
          o.amount = 0;
          return o;
        })
        this.terms=result;
      });
    },
    selectedAcadmiceChange(value){
      this.selected_academic=value;
    },
    submitdata () {
      this.$validator.validateAll().then(successsValidate => {
        if (successsValidate) {

          this.performAction();
        }
      }).catch(error => {
        Notification.warning('Invalid data.');
      });
    },

    performAction (url) {
      this.performdata.academic_id=this.selected_academic.id;
      this.performdata.category_id=this.selected_category.id;


      var tc=new Object();
      tc.grade=new Object(this.performdata);

      var temp=[];
      this.terms.map((t) => {
        if (t.ischecked) {
          var g = {grade_id: null, term_id: t.id, amount: t.amount};
          temp.push(g);
        }
      });
      tc.terms=temp;

      axios.post(create, tc).then(({data}) => {

          if(data.success==false) {
            Notification.error('Opps!Something went wrong.');
          }else{
            window.location.href=_indexpage;
          }
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Opps!Something went wrong.');
        }
      });
    },
  }
}