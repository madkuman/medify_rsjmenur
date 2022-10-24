<script type="text/javascript">
    function nextChar(c) {
        return String.fromCharCode(c.charCodeAt(0) + 1);
    }
    function prevChar(c) {
        return String.fromCharCode(c.charCodeAt(0) - 1);
    }

    // Pilihan Ganda
    function addPilihan(inputValue = '') {
        last_id = $('#addPilihanBtn').data('id');
        pemisah = Math.floor(last_id/2);
        netral = 0;
        if (last_id % 2 != 0) netral = pemisah + 1;
        console.log(last_id, pemisah, netral);
        $('div#isian-content div.jawab-pilgan div.col-lg-1:last-child').remove();
        $('div#isian-content div.jawab-pilgan div:last-child').removeClass('col-lg-9').addClass('col-lg-10');
        var huruf = $('#addPilihanBtn').data('huruf');
        var input = '<div class="form-group row jawab-pilgan">'
                    +'<label class="col-lg-2 col-form-label" for="val_pilihan_ganda">Pilihan '+huruf+'</label>'
                    +'<div class="col-lg-9">'
                    +'<input type="text" class="form-control" name="val_pilihan_ganda[]" data-id="'+last_id+'" placeholder="Isikan Pilihan Jawaban" value="'+inputValue+'" autocomplete="off">'
                    +'</div>'
                    +'</div>';
        if (huruf.charCodeAt(0) >= 90) {
            $('#addPilihanBtn').addClass('disabled');
        }
        $('#addPilihanBtn').data('huruf', nextChar(huruf));
        $('#addPilihanBtn').data('id', (last_id + 1));
        jQuery('#isian-pilgan-content').append(input);
        changeHolder(last_id, pemisah, netral) 
        $('div#isian-content div.jawab-pilgan:last-child').append('<div class="col-lg-1"><a url="" onclick="removePilihan()" class="btn btn-circle btn-alt-danger mr-5 mb-5"><i class="fa fa-times"></i></a></div>');
    }

    function removePilihan() {
        var huruf = $('#addPilihanBtn').data('huruf');
        if (huruf.charCodeAt(0) >= 70) {
            $('#addPilihanBtn').addClass('disabled');
        }
        if ((huruf.charCodeAt(0) - 2) < 70) {
            $('#addPilihanBtn').removeClass('disabled');
        }
        $('#addPilihanBtn').data('huruf', prevChar(huruf));
        $('div#isian-content div.jawab-pilgan:last-child').remove();
        $('div#isian-content div.jawab-pilgan:last-child div.col-lg-10:last-child').removeClass('col-lg-10').addClass('col-lg-9');
        $('div#isian-content div.jawab-pilgan:last-child').append('<div class="col-lg-1"><a url="" onclick="removePilihan()" class="btn btn-circle btn-alt-danger mr-5 mb-5"><i class="fa fa-times"></i></a></div>');
    }

    function changeHolder(last_id, pemisah, netral) {
        for (i = 0; i < last_id; i++) {
            posisi = i + 1;
            holder = "Negatif";
            if (pemisah > 0) {
                if (posisi <= pemisah) {
                    holder = "Negatif";
                } else if (posisi > pemisah) {
                    if (posisi == netral) {
                        holder = "";
                    }else {
                        holder = "Positif";
                    }
                }
            }
            elements = document.querySelectorAll('input[data-id="'+posisi+'"]');
            $(elements).attr("placeholder", holder);
        }
    }

    // Skala
    function showKeterangan(inputValue = null) {
        var batas = $('input[name=batas_skala]').val();
        jQuery('#show_skala').empty();
        if ($.isNumeric(batas) && batas <= 10) {
            var layouts = '';
            pemisah = Math.floor(batas/2);
            netral = 0;
            if (batas % 2 != 0) netral = pemisah + 1;
            for(var i = 0; i < batas; i++) {
                posisi = i + 1;
                holder = "Negatif";
                if (pemisah > 0) {
                    if (posisi <= pemisah) {
                        holder = "Negatif";
                    } else if (posisi > pemisah) {
                        if (posisi == netral) {
                            holder = "";
                        }else {
                            holder = "Positif";
                        }
                    }
                }
                layouts +=  '<div class="col-3">'
                            +'<div class="row" style="margin-bottom:10px">'
                            +'<div class="col-2 mt-10">'+(i+1)+'</div>';
                if (inputValue != null) {
                    layouts +=  '<input type="text" name="val_skala[]" class="form-control col-10" value="'+inputValue[i]+'" autocomplete="off" placeholder="'+holder+'">';
                } else {
                    layouts +=  '<input type="text" name="val_skala[]" class="form-control col-10" autocomplete="off" placeholder="'+holder+'">';
                }
                layouts +=  '</div>'
                            +'</div>';
            }
            jQuery('#show_skala').append(layouts);
        }
    }
</script>