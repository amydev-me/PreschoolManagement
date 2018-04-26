const Datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);

module.exports= {
  components:{Datepicker},
  data: function () {
    return {
      students: [],
      courses: [],
      selected_course: {
        id: null,
        batch_id: null,
        courseName: 'Select grade',
        fees: null,
        registration_fees: null,
        meal: null,
        uniform: null
      },
      active_batch: {},
      ischeck: false,
      filter_date:null,
      visiblechecked:false,
      editRowIndex:null,
      isleave:false,
      temp_remark:null,
      grades:[],
      selected_grade:null,
      terms:[],
      selected_term:null,
      active_academic:null
    }
  },
  methods: {

    selectedGradeChange(){
      this.terms=[];
      this.selected_term=null;
      this.students=[];
      if(this.selected_grade==null) {
          return;
      }
      axios.get('/admin/grade/get-terms?grade_id='+this.selected_grade.id).then(({data})=>{
        this.terms=data;
      });
      // axios.get('/admin/attendance/get-attendances?grade_id='+this.selected_grade.id+'&filter_date='+this.filter_date).then(({data})=>{
      //
      //   this.visiblechecked = data.assign;
      //   if(this.visiblechecked){
      //     this.students=data.attendances;
      //   }else{
      //     let f = data.attendances;
      //     f.map(function (obj) {
      //       obj.status ='P';
      //
      //       obj.remark=null;
      //     });
      //     this.students = f;
      //   }
      //
      //
      // });
    },
    getGades () {
      axios.get('/admin/category/get-with-category').then(({data}) => {
        this.grades = data.grades;
        this.active_academic = data.active_academic;
      });
    },
    selectedTermChange(){
      this.students=[];
      if(this.selected_term==null){
        return;
      }
      axios.get('/admin/attendance/get-attendances-bygrade?grade_id='+this.selected_grade.id+'&term_id='+this.selected_term.id+'&filter_date='+this.filter_date).then(({data})=>{

        this.visiblechecked = data.assign;
        if(this.visiblechecked){
          this.students=data.attendances;
        }else{
          let f = data.attendances;
          f.map(function (obj) {
            obj.status ='P';

            obj.remark=null;
          });
          this.students = f;
        }
      });
    },
    formatDate (date) {
      return Helper.formatDate(date);
    },
    getMonthName(date){
      return Helper.getMonthName(date);
    },
    getMounth (date) {
      return Helper.getMonths(date);
    },
    getFormatYear (date) {
      return Helper.getYears(date);
    },
    getDay (date) {
      return Helper.getDay(date);
    },

    selectAll (ischeck) {
      var that = this;

      this.students.map(function (obj) {
        obj.status = that.ischeck;
        obj.status_text = that.ischeck?'presence':'absence';
      });
    },

    checkboxchecked (index,status) {
      this.students[index].status=status;
      this.$set(this.students,index,this.students[index]);
    },
    save () {
      var temp = this.students;
      var that = this;
      temp.forEach(function (v) {
        delete v.fullName;

        v.student_id = v.id;
        v.grade_id = v.grade_id;
        v.term_id=that.selected_term.id;
        v.attend_date = that.filter_date;
        v.attendance_month = that.getMounth(that.filter_date);
        v.attendance_month_name=that.getMonthName(that.filter_date);
        v.attendance_day = that.getDay(that.filter_date);
        v.attendance_year=that.getFormatYear(that.filter_date);

        v.status=v.status;
        delete v.id;
      });

      axios.post('/admin/attendance/create', temp).then(response => {
        this.ischeck = false;
        this.selectedTermChange();
      });
    }
  },
  mounted () {
    this.filter_date=this.formatDate(new Date());
this.getGades();
  }
}