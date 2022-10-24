/*
 *  Document   : be_pages_dahboard.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Dashboard Page
 */

var BePagesDashboard = function() {
    // Chart.js Charts, for more examples you can check out http://www.chartjs.org/docs
    
    var initDashboardChartJS = function () {
        var jsonData = $.ajax({
            url: API_URL + "/keuangan/dashboard/pemasukan",
            dataType: "json",
        }).done(function (dat) {

            // Split timestamp and data into separate arrays
            // var labels = [], data=[];
            // dat["pemasukan"].forEach(function(pemasukan) {
            // labels.push(packet.day0);
            
            // });
            // alert('packet '+dat.pemasukan1);
            // Set Global Chart.js configuration
            Chart.defaults.global.defaultFontColor              = '#555555';
            Chart.defaults.scale.gridLines.color                = "transparent";
            Chart.defaults.scale.gridLines.zeroLineColor        = "transparent";
            Chart.defaults.scale.display                        = false;
            Chart.defaults.scale.ticks.beginAtZero              = true;
            Chart.defaults.global.elements.line.borderWidth     = 2;
            Chart.defaults.global.elements.point.radius         = 5;
            Chart.defaults.global.elements.point.hoverRadius    = 7;
            Chart.defaults.global.tooltips.cornerRadius         = 3;
            Chart.defaults.global.legend.display                = false;

            // Chart Containers
            var chartDashboardLinesCon  = jQuery('.js-chartjs-dashboard-lines');
            var chartDashboardLinesCon2 = jQuery('.js-chartjs-dashboard-lines2');

            // Chart Variables
            var chartDashboardLines, chartDashboardLines2;
            // Lines Charts Data         
            var chartDashboardLinesData = {
                labels: [dat.day6+' '+dat.date6,dat.day5+' '+dat.date5,dat.day4+' '+dat.date4,dat.day3+' '+dat.date3,dat.day2+' '+dat.date2,dat.day1+' '+dat.date1,dat.day0+' '+dat.date0],
                datasets: [
                    {
                        label: 'This Week',
                        fill: true,
                        backgroundColor: 'rgba(66,165,245,.25)',
                        borderColor: 'rgba(66,165,245,1)',
                        pointBackgroundColor: 'rgba(66,165,245,1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(66,165,245,1)',
                        data: [dat.pemasukan6,dat.pemasukan5,dat.pemasukan4,dat.pemasukan3,dat.pemasukan2,dat.pemasukan1,dat.pemasukan0]
                    }
                ]
            };

            var chartDashboardLinesOptions = {
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMax: 50
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return ' Rp ' + addCommas(tooltipItems.yLabel);
                        }
                    }
                }
            };
            
            var chartDashboardLinesData2 = {
                labels: [dat.day6+' '+dat.date6,dat.day5+' '+dat.date5,dat.day4+' '+dat.date4,dat.day3+' '+dat.date3,dat.day2+' '+dat.date2,dat.day1+' '+dat.date1,dat.day0+' '+dat.date0],
                datasets: [
                    {
                        label: 'This Week',
                        fill: true,
                        backgroundColor: 'rgba(156,204,101,.25)',
                        borderColor: 'rgba(156,204,101,1)',
                        pointBackgroundColor: 'rgba(156,204,101,1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(156,204,101,1)',
                        data: [dat.pengeluaran6,dat.pengeluaran5,dat.pengeluaran4,dat.pengeluaran3,dat.pengeluaran2,dat.pengeluaran1,dat.pengeluaran0]
                    }
                ]
            };

            var chartDashboardLinesOptions2 = {
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMax: 480
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return ' Rp ' + addCommas(tooltipItems.yLabel);
                        }
                    }
                }
            };
            function addCommas(nStr)
            {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
            // Init Charts
            if ( chartDashboardLinesCon.length ) {
                chartDashboardLines  = new Chart(chartDashboardLinesCon, { type: 'line', data: chartDashboardLinesData, options: chartDashboardLinesOptions });
            }

            if ( chartDashboardLinesCon2.length ) {
                chartDashboardLines2 = new Chart(chartDashboardLinesCon2, { type: 'line', data: chartDashboardLinesData2, options: chartDashboardLinesOptions2 });
            }
        });
    };
    
    return {
        init: function () {
            // Init Chart.js Charts
            initDashboardChartJS();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ BePagesDashboard.init(); });

