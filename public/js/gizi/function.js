$(document).ready( function() {

    $('#select-diet').val(null);
    // $('#select-diet-detail').hide();
    // $('#select-sumber-energi').hide();
    // $('#label-sumber-energi').hide();
    // $('#label-diet-detail').hide();

    var url_diet_detail = "{{ URL::to('/nutrition/order/ajax_biasa') }}";
    $('#select-diet').change(function () {

        var optionSelected = $(this).find("option:selected");
        var valueSelected  = optionSelected.val();
        var textSelected   = optionSelected.text();

        console.log(textSelected);
        $('#hidden-diet').val(textSelected);

        console.log(valueSelected);
        $('#div-sumber-energi').hide();

        var hostname = window.location.hostname;
        var public = '/public';
        var dir = '/medifyhospital';
        var url_diet_detail = '/nutrition/order/ajax_biasa';
        var url_energy_source = '/nutrition/order/energy_source';

        $.ajax({
            url: dir + public + url_diet_detail +"/"+valueSelected,
            type: "GET",
            dataType: "json",
            success: function(data) {

                $('#select-diet-detail').html('');
                // console.log(data[0].diet_selection_id);

                $.each( data, function(key, value) {

                    $('#select-diet-detail').append($('<option>', {
                        value: value.id_diet_detail_selection,
                        text : value.diet_selection.name_diet_selection
                    }));

                })

                var key = data[0].id_diet_detail_selection;

                $.ajax({

                    url: dir + public + url_energy_source +"/"+key,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {



                        // console.log(data);

                        $('#select-sumber-energi').html('');

                        $.each(data, function ( key, value) {

                            $('#select-sumber-energi').append($('<option>', {
                                value: value.id_diet_detail_energy_sources,
                                text : value.energy_sources.name_energy_sources
                            }));

                        })

                        $('#select-sumber-energi').val(null);
                        $('#div-sumber-energi').show();

                    }

                })


                $('#select-diet-detail').val(null);

                if( data[0].diet_selection_id != 11 ) {


                    console.log('Diet Detail');
                    $('#div-diet-detail').hide();
                    $('#div-sumber-energi').hide();
                    $('#div-diet-detail').show();


                } else if ( data[0].diet_selection_id == 11 ) {

                    // console.log(data[0].id_diet_detail_selection);

                    console.log('Sumber Energi');
                    // $('#div-sumber-energi').hide();
                    $('#div-diet-detail').hide();
                    $('#div-sumber-energi').show();



                }


            }

        })

    });
});

function DietDetail() {

    var optionSelected = $('#select-diet-detail').find("option:selected");
    var valueSelected  = optionSelected.val();
    var textSelected   = optionSelected.text();

    console.log(textSelected);
    $('#hidden-diet-detail').val(textSelected);


    var hostname = window.location.hostname;
    var public = '/public';
    var dir = '/medifyhospital';
    var url_diet_detail = '/nutrition/order/ajax_biasa';
    var url_energy_source = '/nutrition/order/energy_source';

    var key = valueSelected;


    $.ajax({
        url: dir + public + url_energy_source +"/"+key,
        type: "GET",
        datatype: "json",
        success: function( data ) {

            $('#select-sumber-energi').html('');

            $.each(data, function ( key, value) {

                $('#select-sumber-energi').append($('<option>', {
                    value: value.id_diet_detail_energy_sources,
                    text : value.energy_sources.name_energy_sources
                }));

            })

        }

    })

    $('#div-sumber-energi').show();
    $('#select-sumber-energi').val(null);


}

function SumberEnergi() {

    var optionSelected = $('#select-sumber-energi').find("option:selected");
    var valueSelected  = optionSelected.val();
    var textSelected   = optionSelected.text();

    console.log(textSelected);
    $('#hidden-sumber-energi').val(textSelected);

    $('#div-keterangan').show();


}