//Number of Units Sold chart:
var xValues = ["Sep 17","Sep 18","Sep 19","Sep 20","Sep 21","Sep 22"];
var yValues = [330,230,270,300,300,270];
new Chart("chart1", {
    type: "bar",
    data: {
      labels: xValues,
      datasets: [{
        data: yValues,
        backgroundColor: "#359CCE",
        borderColor: "#359CCE",
        borderWidth:1,
        maxBarThickness:12,
        borderRadius: 20,
        borderSkipped: false,
        barPecentage:0.5,
      }]
    },
    options: {
      maintainAspectRatio: false,
      legend: {display: false},
      scales: {
      yAxes: [{
          ticks: {min: 0, max:750, stepSize: 250},
      }],
      xAxes: [{
          gridLines:{display:false,}
      }]
  
      }
    }
  });


//Purchase Orders chart:
var xValues = ["Sep 17","Sep 18","Sep 19","Sep 20","Sep 21","Sep 22"];
var yValues = [330,230,270,300,300,270];

new Chart("chart2", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "#EC6666",
      borderColor: "#EC6666",
      borderWidth: 1,
      data: yValues
    }]
  },
  options: {
    maintainAspectRatio: false,
    responsive: true,
    legend: {display: false},
    scales: {
    yAxes: [{
        ticks: {min: 0, max:750, stepSize: 250},
    }],
    xAxes: [{
        gridLines:{display:false,}
    }]

    }
  }
});