var Chart= require('chart.js');

module.exports= {
  template:`
        <div class="col-lg-12">
          
              <div class="col-lg-push-2  col-lg-8 col-lg-pull-2">
                    <canvas width="400" height="200" id="attendance-chart"></canvas>              
                </div>
           
              
                  
     
        </div>
  `,
  data: function () {
    return {
      student_id:null
    }
  },
  methods: {
    checkUrlParam () {
      let student_id = Helper.getUrlParameter('student_id');
      if (student_id != null) {

        this.student_id = student_id;
        this.createPieChart();
      }
    },
    createPieChart(){
      axios.get('/admin/attendance/attend_chart/'+this.student_id).then(({data}) => {

        var tmpdata=[];
        var tmplabels=[];
        var tmpcolors=[];

        if(data.present.total !=0){
          tmplabels.push('Presence');
          tmpcolors.push('rgb(5,155,255)');
          tmpdata.push(data.present.total);

        }else{
          tmplabels.push('Presence');
          tmpcolors.push('rgb(5,155,255)');
        }

        if(data.absence.total !=0){
          tmplabels.push('Absence');
          tmpcolors.push('rgb(255,99,132)');
          tmpdata.push(data.absence.total);

        }else{
          tmplabels.push('Absence');
          tmpcolors.push('rgb(255,99,132)');
        }

        if(data.leave.total !=0){
          tmplabels.push('Leave');
          tmpcolors.push('#FFC233');
          tmpdata.push(data.leave.total);

        }else{
          tmplabels.push('Leave');
          tmpcolors.push('#FFC233');
        }

        new Chart('attendance-chart', {
          type: 'pie',
          data: {
            labels: tmplabels,
            datasets: [
              {

                data: tmpdata,
                backgroundColor: tmpcolors,
                borderColor: tmpcolors,
                borderWidth: 1,
              }
            ]
          }
        });
      });
    }
  },
  mounted () {
    this.checkUrlParam();
  }
}