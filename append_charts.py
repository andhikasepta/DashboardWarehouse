import sys

in_out_js = """
// Perangkat In Chart Example (Single Data Vertical Bar Chart)
var ctxIn = document.getElementById("perangkatInChart");
if (ctxIn) {
  new Chart(ctxIn, {
    type: 'bar',
    data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
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
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
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
"""

with open('c:/Users/User/Downloads/Dashboard/js/demo/chart-bar-demo.js', 'a', encoding='utf-8') as f:
    f.write(in_out_js)

aging_js = """
// Aging Perangkat Chart Example (Single Data Horizontal Bar Chart)
var ctxAging = document.getElementById("agingBarChart");
if (ctxAging) {
  new Chart(ctxAging, {
    type: 'horizontalBar',
    data: {
      labels: ["< 1 Year", "1-3 Years", "> 3 Years"],
      datasets: [{
        label: "Qty",
        backgroundColor: "#f6c23e",
        hoverBackgroundColor: "#dda20a",
        borderColor: "#f6c23e",
        data: [20, 35, 10],
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: { padding: { left: 10, right: 25, top: 25, bottom: 0 } },
      scales: {
        xAxes: [{ ticks: { min: 0, max: 50, maxTicksLimit: 5, padding: 10 }, gridLines: { color: "rgb(234, 236, 244)", zeroLineColor: "rgb(234, 236, 244)", drawBorder: false, borderDash: [2], zeroLineBorderDash: [2] } }],
        yAxes: [{ gridLines: { display: false, drawBorder: false }, ticks: { maxTicksLimit: 6 }, maxBarThickness: 25 }],
      },
      legend: { display: false },
      tooltips: {
        titleMarginBottom: 10, titleFontColor: '#6e707e', titleFontSize: 14, backgroundColor: "rgb(255,255,255)", bodyFontColor: "#858796", borderColor: '#dddfeb', borderWidth: 1, xPadding: 15, yPadding: 15, displayColors: false, caretPadding: 10
      },
    }
  });
}
"""

with open('c:/Users/User/Downloads/Dashboard/js/demo/chart-horizontal-bar-demo.js', 'a', encoding='utf-8') as f:
    f.write(aging_js)

print('Success')
