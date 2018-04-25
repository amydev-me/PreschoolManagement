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
      axios.get('/admin/attendance/attend_chart/'+this.student_id).then(response => {

        new Chart('attendance-chart', {
          type: 'pie',
          data: {
            labels: ['Presence','Leave','Absence'],
            datasets: [
              {

                data: response.data,
                backgroundColor: ['rgb(5,155,255)','#FFC233','rgb(255,99,132)'],

                borderColor: ['rgb(5,155,255)','#FFC233','rgb(255,99,132)'],

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