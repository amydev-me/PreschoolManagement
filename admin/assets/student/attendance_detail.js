module.exports= {

  data: function () {
    return {
      student_id:null,
      attv:null,
      copyarr:null,
      originarr:[]
    }
  },
  methods: {
    checkUrlParam () {
      let student_id = Helper.getUrlParameter('student_id');
      if (student_id != null) {

        this.student_id = student_id;
       this.getData('/admin/attendance/detail?student_id='+student_id+'&status=P');
      }
    },
    getData(url){
      axios.get(url).then(({data}) => {
        let infos = data;
        this.orange=infos;
        this.attv=infos;

        for (var  termkey in infos) {
          if (infos.hasOwnProperty(termkey)) {
              var s={};
              var tmpArr=[];
            for (var yearkey in infos[termkey]) {


              for(var monthkey in infos[termkey][yearkey]){

                var d_day = {
                  monthname: monthkey,
                  d1: null, d2: null, d3: null, d4: null, d5: null,
                  d6: null, d7: null, d8: null, d9: null, d10: null,
                  d11: null, d12: null, d13: null, d14: null, d15: null,
                  d16: null, d17: null, d18: null, d19: null, d20: null,
                  d21: null, d22: null, d23: null, d24: null, d25: null,
                  d26: null, d27: null, d28: null, d29: null, d30: null, d31: null
                };
                infos[termkey][yearkey][monthkey].map(s=>{
                  d_day.monthname=yearkey+'\\'+monthkey;
                  switch (s.attendance_day) {
                    case 1:d_day.d1 = s.status;break;
                    case 2:d_day.d2 = s.status;break;
                    case 3:d_day.d3 = s.status;break;
                    case 4:d_day.d4 = s.status;break;
                    case 5:d_day.d5 = s.status;break;
                    case 6:d_day.d6 = s.status;break;
                    case 7:d_day.d7 = s.status;break;
                    case 8:d_day.d8 = s.status;break;
                    case 9:d_day.d9 = s.status;break;
                    case 10:d_day.d10 = s.status;break;
                    case 11:d_day.d11 = s.status;break;
                    case 12:d_day.d12 = s.status;break;
                    case 13:d_day.d13 = s.status;break;
                    case 14:d_day.d14 = s.status;break;
                    case 15:d_day.d15 = s.status;break;
                    case 16:d_day.d16 = s.status;break;
                    case 17:d_day.d17 = s.status;break;
                    case 18:d_day.d18 = s.status;break;
                    case 19:d_day.d19 = s.status;break;
                    case 20:d_day.d20 = s.status;break;
                    case 21:d_day.d21 = s.status;break;
                    case 22:d_day.d22 = s.status;break;
                    case 23:d_day.d23 = s.status;break;
                    case 24:d_day.d24 = s.status;break;
                    case 25:d_day.d25 = s.status;break;
                    case 26:d_day.d26 = s.status;break;
                    case 27:d_day.d27 = s.status;break;
                    case 28:d_day.d28 = s.status;break;
                    case 29:d_day.d29 = s.status;break;
                    case 30:d_day.d30 = s.status;break;
                    case 31:d_day.d31 = s.status;break;
                  }
                });
                tmpArr.push(d_day);
                // this.attendances.push(d_day);
              }
            }

            this.attv[termkey]=tmpArr;

          }
        }

      });
    },
    getStyle(status){
      console.log(status);
      if(status=='P'){
        return 'background-color:#059BFF;'
      }else if(status=='L'){
        return 'background-color:#FFC233;'
      }else if(status=='A'){
        return 'background-color:#FF6384;'
      }
    },
    checkboxchecked(status){
      this.getData('/admin/attendance/detail?student_id='+this.student_id+'&status='+status);
    }
  },
  mounted () {
    this.checkUrlParam();
  }
}