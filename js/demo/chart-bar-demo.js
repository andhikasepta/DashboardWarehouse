// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function (n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Fast Moving", "Slow Moving", "Re-Use"],
    datasets: [{
      label: "Qty (Unit)",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: [1001, 1050, 500, 1300],
    }, {
      label: "NBV (Rp)",
      backgroundColor: "#1cc88a",
      hoverBackgroundColor: "#17a673",
      borderColor: "#1cc88a",
      data: [500, 1100, 902],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 3
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 2000,
          maxTicksLimit: 5,
          padding: 10,
          callback: function (value, index, values) {
            return '' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: true,
      labels: {
        usePointStyle: true
      }
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function (tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          var val = number_format(tooltipItem.yLabel);
          if (datasetLabel === "Qty (Unit)") {
            return datasetLabel + ' : ' + val + ' Unit';
          } else if (datasetLabel === "NBV (Rp)") {
            return datasetLabel + ' : Rp ' + val;
          }
          return datasetLabel + ' : ' + val;
        }
      }
    },
  }
});

// Perangkat In Chart Example (Single Data Vertical Bar Chart)
var ctxIn = document.getElementById("perangkatInChart");
if (ctxIn) {
  new Chart(ctxIn, {
    type: 'bar',
    data: {
      labels: ["Fast Moving", "Slow Moving", "Re-Use"],
      datasets: [{
        label: "Perangkat In",
        backgroundColor: "#1cc88a",
        hoverBackgroundColor: "#17a673",
        borderColor: "#1cc88a",
        data: [10, 15, 20, 12, 25, 30],
      }],

    },
    options: {
      maintainAspectRatio: false,
      layout: { padding: { left: 10, right: 25, top: 25, bottom: 0 } },
      scales: {
        xAxes: [{ gridLines: { display: false, drawBorder: false }, ticks: { maxTicksLimit: 6 }, maxBarThickness: 25 }],
        yAxes: [{ ticks: { min: 0, max: 40, maxTicksLimit: 5, padding: 10 }, gridLines: { color: "rgb(234, 236, 244)", zeroLineColor: "rgb(234, 236, 244)", drawBorder: false, borderDash: [2], zeroLineBorderDash: [2] } }],
      },
      legend: { display: false },
      tooltips: {
        titleMarginBottom: 10, titleFontColor: '#6e707e', titleFontSize: 14, backgroundColor: "rgb(255,255,255)", bodyFontColor: "#858796", borderColor: '#dddfeb', borderWidth: 1, xPadding: 15, yPadding: 15, displayColors: false, caretPadding: 10
      },
    }
  });
}

// Perangkat Out Chart Example (Single Data Vertical Bar Chart)
var ctxOut = document.getElementById("perangkatOutChart");
if (ctxOut) {
  new Chart(ctxOut, {
    type: 'bar',
    data: {
      labels: ["Fast Moving", "Slow Moving", "Re-Use"],
      datasets: [{
        label: "Perangkat Out",
        backgroundColor: "#e74a3b",
        hoverBackgroundColor: "#be2617",
        borderColor: "#e74a3b",
        data: [5, 8, 12, 7, 15, 20],
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: { padding: { left: 10, right: 25, top: 25, bottom: 0 } },
      scales: {
        xAxes: [{ gridLines: { display: false, drawBorder: false }, ticks: { maxTicksLimit: 6 }, maxBarThickness: 25 }],
        yAxes: [{ ticks: { min: 0, max: 40, maxTicksLimit: 5, padding: 10 }, gridLines: { color: "rgb(234, 236, 244)", zeroLineColor: "rgb(234, 236, 244)", drawBorder: false, borderDash: [2], zeroLineBorderDash: [2] } }],
      },
      legend: { display: false },
      tooltips: {
        titleMarginBottom: 10, titleFontColor: '#6e707e', titleFontSize: 14, backgroundColor: "rgb(255,255,255)", bodyFontColor: "#858796", borderColor: '#dddfeb', borderWidth: 1, xPadding: 15, yPadding: 15, displayColors: false, caretPadding: 10
      },
    }
  });
}
