
                if ( flotPie1.length ) {
                    var array = [], item = {};
                    
                    item = {label:'IGD', data:{{$distribusi_rj}} }
                    array.push(item);
                    item = {label:'Rawat Jalan', data:{{$distribusi_igd}} }
                    array.push(item);
                    
                    jQuery.plot(flotPie1,
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