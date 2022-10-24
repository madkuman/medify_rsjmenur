<script type="text/javascript">
    var BeCompCharts = function() {
        var initRandomEasyPieChart = function(){
            var flotLines = jQuery('.js-flot-lines');

            var transaksiLine = [];
            var transaksi = {!! json_encode($perBulan) !!};
            var months  = {1 :'Jan', 2 :'Feb', 3 :'Mar', 4 :'Apr', 5 :'May', 6 :'Jun', 7 :'Jul', 8 :'Aug', 9 :'Sep', 10 :'Oct', 11 :'Nov', 12 :'Dec'};
            var dataMonths = [];
            transaksi.forEach(function(trans, i){
                transaksiLine.push([i, trans.transaksi_count]);
                dataMonths.push([i, months[trans.month]])
            });

            var color = ['#1abc9c', '#ffca28', '#26c6da', '#9ccc65', '#e67e22', '#2c3e50', '#95a5a6', '#3498db', '#ecf0f1', '#c0392b', '#bdc3c7', '#8e44ad'];


            var dataWeek = [[1, 'Senin'], [2, 'Selasa'], [3, 'Rabu'], [4, 'Kamis'], [5, 'Jumat'], [6, 'Sabtu'], [7, 'Minggu']];

            if ( flotLines.length ) {
                jQuery.plot(flotLines,
                    [
                        {
                            label: 'Data 1',
                            data: transaksiLine,
                            lines: {
                                show: true,
                                fill: true,
                                fillColor: {
                                    colors: [{opacity: .7}, {opacity: .7}]
                                }
                            },
                            points: {
                                show: true,
                                radius: 5
                            }
                        }
                    ],
                    {
                        colors: color,
                        legend: {
                            show: true,
                            position: 'nw',
                            backgroundOpacity: 0
                        },
                        grid: {
                            borderWidth: 0,
                            hoverable: true,
                            clickable: true
                        },
                        yaxis: {
                            tickColor: '#ffffff',
                            ticks: 4
                        },
                        xaxis: {
                            ticks: dataMonths,
                            tickColor: '#f5f5f5'
                        }
                    }
                );

                // Creating and attaching a tooltip to the classic chart
                var previousPoint = null, ttlabel = null;
                flotLines.bind('plothover', function(event, pos, item) {
                    if (item) {
                        if (previousPoint !== item.dataIndex) {
                            previousPoint = item.dataIndex;

                            jQuery('.js-flot-tooltip').remove();
                            var x = item.datapoint[0], y = item.datapoint[1];

                            ttlabel = '<strong>' + y + '</strong> Data';
                        

                            jQuery('<div class="js-flot-tooltip flot-tooltip">' + ttlabel + '</div>')
                                .css({top: item.pageY - 45, left: item.pageX + 5}).appendTo("body").show();
                        }
                    }
                    else {
                        jQuery('.js-flot-tooltip').remove();
                        previousPoint = null;
                    }
                });
            }
        };
        return {
            init: function () {
                // Init Flot Charts
                initRandomEasyPieChart();
            }
        };
    }();
    jQuery(function(){ 
        BeCompCharts.init(); 
    });
</script>