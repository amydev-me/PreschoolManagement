module.exports={
  props:['terms'],
  data:function () {
    return {

        fstart_date: null,
        fend_date: null,
        ffterm_time: null,
        ffamount: null,
        fhterm_time: null,
        fhamount: null,

        sstart_date: null,
        send_date: null,
        sfterm_time: null,
        sfamount: null,
        shterm_time: null,
        shamount: null,

    }
  },

  mounted(){
    var ffterm=this.terms.find(t=>t.term_type=='t1'&&t.time_type=='Full');
    this.fstart_date=ffterm.start_date;
    this.fend_date=ffterm.end_date;
    this.ffterm_time=ffterm.term_time;
    this.ffamount=ffterm.amount;

    var fhterm=this.terms.find(t=>t.term_type=='t1'&&t.time_type=='Half');
    this.fhterm_time=fhterm.term_time;
    this.fhamount=fhterm.amount;

    var sfterm=this.terms.find(t=>t.term_type=='t2'&&t.time_type=='Full');
    this.sstart_date=sfterm.start_date;
    this.send_date=sfterm.end_date;
    this.sfterm_time=sfterm.term_time;
    this.sfamount=sfterm.amount;
    var shterm=this.terms.find(t=>t.term_type=='t2'&&t.time_type=='Half');
    this.shterm_time=shterm.term_time;
    this.shamount=shterm.amount;
  }
}