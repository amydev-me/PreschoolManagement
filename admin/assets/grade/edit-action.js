const AcademicSelect = resolve => require(['../select_components/AcademicSelect'], resolve);
const CategorySelect = resolve => require(['../select_components/CategorySelect'], resolve);
const NumericInput = resolve => require(['../core/NumericInput'], resolve);
let create=route.urls.grade.create;
let update=route.urls.grade.update;
let getby_category=route.urls.term.getby_category;

let _indexpage=route.urls.grade.indexpage;
module.exports= {
  components: {CategorySelect, AcademicSelect,NumericInput},
  data: function () {
    return {
      selected_academic: null,
      academics: [],
      categories: [],
      selected_category: null,
      terms: [],
      performdata: {
        id: null,
        category_id: null,
        academic_id: null,
        gradeName: null,
        description: null
      },
      grade_id: null,
      sections: []
    }
  },

  methods: {
    getDetail () {
      axios.get('/admin/grade/get-detail?grade_id=' + this.grade_id).then(({data}) => {
        let grade = data.grade;
        this.performdata.id = grade.id;
        this.performdata.category_id = grade.category_id;
        this.performdata.academic_id = grade.academic_id;
        this.performdata.gradeName = grade.gradeName;
        this.performdata.description = grade.description;
        this.sections = data.sections;
        this.selected_academic = grade.academic;
        this.selected_category = grade.category;
        axios.get(getby_category + this.selected_academic.id + '&category_id=' + this.selected_category.id).then(({data}) => {
          let _terms = data;
          let that = this;

          var result = _terms.map(function (el) {

            var section = that.sections.find(sec => sec.pivot.term_id == el.id);
            var o = Object.assign({}, el);
            if (section != null) {
              o.grade_id = section.pivot.grade_id;
              o.ischecked = true;
              o.amount = section.pivot.amount;
            } else {
              o.grade_id = null;
              o.ischecked = false;
              o.amount = 0;
            }

            return o;
          });
          this.terms = result;
        });

      });
    },
    checkedChanged (term, index) {
      if (term.ischecked) {
        this.terms[index].amount = 0;
      }
    },
    selectedCategoryChange (value) {
      this.selected_category = value;
      if (this.selected_academic == null) { return;}
      if (value == null) {return;}
      axios.get(getby_category + this.selected_academic.id + '&category_id=' + value.id).then(({data}) => {
        let _terms = data;
        var result = _terms.map(function (el) {
          var o = Object.assign({}, el);
          o.ischecked = false;
          o.amount = 0;
          return o;
        })
        this.terms = result;
      });
    },
    selectedAcadmiceChange (value) {
      this.selected_academic = value;
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
    checkUrlParam () {
      let grade_id = Helper.getUrlParameter('grade_id');
      if (grade_id != null) {
        this.grade_id = grade_id;
        this.getDetail();
      }
    },
    performAction () {
      this.performdata.academic_id = this.selected_academic.id;
      this.performdata.category_id = this.selected_category.id;

      var tc = new Object();
      tc.grade = new Object(this.performdata);
      var temp = [];
      this.terms.map((t) => {
        if (t.ischecked) {
          var g = {grade_id: this.performdata.id, term_id: t.id, amount: t.amount};
          temp.push(g);
        }
      });
      tc.terms = temp;
      axios.post(update, tc).then(({data}) => {
        if (data.success == false) {
          Notification.error('Opps!Something went wrong.');
        } else {
          window.location.href = _indexpage;
        }
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Opps!Something went wrong.');
        }
      });
    },
  },
  mounted () {
    this.checkUrlParam();
  }
}