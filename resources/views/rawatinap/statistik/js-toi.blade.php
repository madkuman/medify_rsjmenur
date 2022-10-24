
    var dataLine3    = [];
    @foreach($toi as $item)
    dataLine3.push([{{$item->date}}, {{$item->value}}]);
    @endforeach
    

    if ( flotLines3.length ) {
        jQuery.plot(flotLines3,
            [
            {
                label: 'TOI',
                data: dataLine3,
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
                    ticks: 3
                },
                xaxis: {
                    ticks: dataMonths,
                    tickColor: '#f5f5f5'
                }
            }
            );

        var previousPoint = null, ttlabel = null;
        flotLines3.bind('plothover', function(event, pos, item) {
            if (item) {
                if (previousPoint !== item.dataIndex) {
                    previousPoint = item.dataIndex;

                    jQuery('.js-flot-tooltip').remove();
                    var x = item.datapoint[0], y = item.datapoint[1];

                    if (item.seriesIndex === 0) {
                        ttlabel = '<strong>' + y + '</strong> Hari';
                    }

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