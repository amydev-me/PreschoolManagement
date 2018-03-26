const viewComponent = resolve => require(['./viewcomponent'], resolve);
module.exports= {
  components:{viewComponent},
  data: function () {
    return {
      grades: [],
      tmp: {

        start_date: null,
        end_date:null,
        term_time:null,
        amount: 0,
      }
    }
  },
  methods: {

    getdata(){
      axios.get('/admin/grade/get-data').then(({data})=>{
        this.grades=data;
      });
    },
    findvalueOfTable(terms){
      var r= terms.find(term=>term.term_type=='t1'&&term.time_type=='Full');

      this.tmp={start_date:r.start_date,end_date:r.end_date,term_time:r.term_time,amount:r.amount};


    }
  },
  mounted () {
    this.getdata();
  }
}