var dataLine6 = [];
@foreach($ndr as $item)
dataLine6.push([{{$item->date}}, {{$item->value}}]);
@endforeach

if ( flotLines6.length ) {
    jQuery.plot(flotLines6,
        [
        {
            label: 'NDR',
            data: dataLine6,
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
            colors: ['#ffca28'],
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
    flotLines6.bind('plothover', function(event, pos, item) {
        if (item) {
            if (previousPoint !== item.dataIndex) {
                previousPoint = item.dataIndex;

                jQuery('.js-flot-tooltip').remove();
                var x = item.datapoint[0], y = item.datapoint[1];

                if (item.seriesIndex === 0) {
                    ttlabel = '<strong>' + y + '</strong> kali';
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