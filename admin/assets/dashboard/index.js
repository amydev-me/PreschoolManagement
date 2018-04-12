var Chart= require('chart.js');


module.exports= {


  data: function () {
    return {
      rf:null
    }
  },
  methods: {
    createChart () {
      axios.get('/yearlystudents').then(response => {

        new Chart('planet-chart', {
          type: 'bar',
          data: {
            labels: response.data.map(function (a) {return a.academicName;}),
            datasets: [
              {
                label: "# of Students",
                data: response.data.map(function (a) {return a.studentCount;}),
                backgroundColor: 'rgba(70, 190, 138, 0.7)',
                pointBackgroundColor: 'rgb(70, 190, 138)',
                pointHoverBackgroundColor: 'rgb(70, 190, 138)',
                borderColor: 'rgb(70, 190, 138)',
                pointBorderColor: '#fff',
                pointHoverBorderColor: 'rgb(70, 190, 138)',
                borderWidth: 1,
              }
            ]
          },
          options: {
            scales: {
              yAxes: [
                {
                  ticks: {
                    beginAtZero: true
                  }
                }
              ]
            }
          }
        });

      });
    },
    createLineChart () {
      axios.get('/yearlyincome').then(response => {

        new Chart('income-chart', {
          type: 'line',
          data: {
            labels: response.data.map(function (a) {return a.academicName;}),
            datasets: [
              {
                label: "# Income",
                data: response.data.map(function (a) {return a.income;}),
                backgroundColor: 'rgba(70, 190, 138, 0.7)',
                pointBackgroundColor: 'rgb(70, 190, 138)',
                pointHoverBackgroundColor: 'rgb(70, 190, 138)',
                borderColor: 'rgb(70, 190, 138)',
                pointBorderColor: '#fff',
                pointHoverBorderColor: 'rgb(70, 190, 138)',
                borderWidth: 1,
              }
            ]
          },
          options: {
            scales: {
              yAxes: [
                {
                  ticks: {
                    beginAtZero: true
                  }
                }
              ]
            }
          }
        });
      });
    },
    formatNumber(number){
      return parseInt( number ).toLocaleString();
    },
  },
  mounted(){
    this.createChart();
    this.createLineChart();
  },
}