<script type="text/javascript">
    var BeCompCharts = function() {
        var initRandomEasyPieChart = function(){
            var flotLines = jQuery('.js-flot-lines');
            var flotPie1  = jQuery('.js-flot-pie1');
            var flotPie2  = jQuery('.js-flot-pie2');
            var flotPie3  = jQuery('.js-flot-pie3');
            var flotPie4  = jQuery('.js-flot-pie4');

            var distribusiLine = [];
            var farmasiLine = [];
            // var kategoriLine = [];
            // var supplierLine = [];
            var distribusi = <?php echo json_encode($perBulan) ?>;
            var farmasi = <?php echo json_encode($perFarmasi) ?>;

            var color = ['#1abc9c', '#ffca28', '#26c6da', '#9ccc65', '#e67e22', '#2c3e50', '#95a5a6', '#3498db', '#ecf0f1', '#c0392b', '#bdc3c7', '#8e44ad'];

            var dataMonths  = [[1, 'Jan'], [2, 'Feb'], [3, 'Mar'], [4, 'Apr'], [5, 'May'], [6, 'Jun'], [7, 'Jul'], [8, 'Aug'], [9, 'Sep'], [10, 'Oct'], [11, 'Nov'], [12, 'Dec']];

            var dataWeek = [[1, 'Senin'], [2, 'Selasa'], [3, 'Rabu'], [4, 'Kamis'], [5, 'Jumat'], [6, 'Sabtu'], [7, 'Minggu']];

            for(var i = 1; i <= 12; i++){
                var dis = distribusi[i];
                distribusiLine.push([dis.month, dis.transaksi_count]);
            }
            for(var j = 0; j < farmasi.length; j++){
                var arr = new Array();
                var far = farmasi[j];
                arr['data'] = far.transaksi_count;
                arr['label'] = far.farmasi;
                farmasiLine.push(arr);
            }
            // for(var k = 0; k < kategori.length; k++){
            //     var arr = new Array();
            //     var kate = kategori[k];
            //     arr['data'] = kate.kategori_count;
            //     arr['label'] = kate.nama;
            //     kategoriLine.push(arr);
            // }
            // for(var l = 0; l < supplier.length; l++){
            //     var arr = new Array();
            //     var supp = supplier[l];
            //     var strLabel;
            //     arr['data'] = supp.transaksi_count;
            //     strLabel = supp.supplier;
            //     console.log(strLabel.substr(0, 10));
            //     if (strLabel.length > 10) {
            //         arr['label'] = strLabel.substr(0, 15) + '...';
            //     } else {
            //         arr['label'] = supp.supplier;
            //     }
            //     supplierLine.push(arr);
            //     // supplierLine = [{label: 1, data: 1}, {label:2, data: 1}]
            // }
            // console.log(supplierLine);
            // console.log(farmasiLine);
            //tes_line = [[1,0], [2,0], [3,0], [4,5], [5,5], [6,8], [7,3], [8,0], [9,0], [10,0], [11,0], [12,0]];

            if ( flotLines.length ) {
                jQuery.plot(flotLines,
                    [
                        {
                            label: 'Data 1',
                            data: distribusiLine,
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

            if ( flotPie1.length ) {
                var array = [], item = {};
                jQuery.plot(flotPie1, kategoriLine,
                    {
                        colors: color,
                        legend: {show: false},
                        series: {
                            pie: {
                                show: true,
                                radius: 1,
                                label: {
                                    show: true,
                                    radius: 2/3,
                                    formatter: function(label, pieSeries) {
                                        return '<div class="flot-pie-label">' + label + '<br>' + Math.round(pieSeries.percent) + '%</div>';
                                    },
                                    background: {
                                        opacity: .75,
                                        color: '#000000'
                                    }
                                }
                            }
                        }
                    }
                );
            }

            if ( flotPie2.length ) {
                var array = [], item = {};
                //array = [{data: 27, label: 'tes1'},{data: 7, label: 'tes2'}, {data: 3, label: 'tes3'}]
                jQuery.plot(flotPie2, supplierLine,
                    {
                        colors: color,
                        legend: {show: false},
                        series: {
                            pie: {
                                show: true,
                                radius: 1,
                                label: {
                                    show: true,
                                    radius: 2/3,
                                    formatter: function(label, pieSeries) {
                                        return '<div class="flot-pie-label">' + label + '<br>' + Math.round(pieSeries.percent) + '%</div>';
                                    },
                                    background: {
                                        opacity: .75,
                                        color: '#000000'
                                    }
                                }
                            }
                        }
                    }
                );
            }

            if ( flotPie3.length ) {
                var array = [], item = {};
                array = [{data: 27, label: 'tes1'},{data: 7, label: 'tes2'}, {data: 3, label: 'tes3'}]
                jQuery.plot(flotPie3,
                    array,
                    {
                        colors: color,
                        legend: {show: false},
                        series: {
                            pie: {
                                show: true,
                                radius: 1,
                                label: {
                                    show: true,
                                    radius: 2/3,
                                    formatter: function(label, pieSeries) {
                                        return '<div class="flot-pie-label">' + label + '<br>' + Math.round(pieSeries.percent) + '%</div>';
                                    },
                                    background: {
                                        opacity: .75,
                                        color: '#000000'
                                    }
                                }
                            }
                        }
                    }
                );
            }

            if ( flotPie4.length ) {
                var array = [], item = {};		        	
                jQuery.plot(flotPie4, farmasiLine,
                    {
                        colors: color,
                        legend: {show: false},
                        series: {
                            pie: {
                                show: true,
                                radius: 1,
                                label: {
                                    show: true,
                                    radius: 2/3,
                                    formatter: function(label, pieSeries) {
                                        return '<div class="flot-pie-label">' + label + '<br>' + Math.round(pieSeries.percent) + '%</div>';
                                    },
                                    background: {
                                        opacity: .75,
                                        color: '#000000'
                                    }
                                }
                            }
                        }
                    }
                );
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