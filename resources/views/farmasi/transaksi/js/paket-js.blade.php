<script type="text/javascript">
    getDataPaket();
    function getDataPaket(){
        $('#loading-paket').show();
         $.ajax({
            url: API_URL + '/farmasi/{{session('farmasi')->slug}}/paket-obat/get/all',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#selectPaket').html('')
                var dataCount=0;
                var newOption = new Option("", "", false, false);
                $("#selectPaket").append(newOption).trigger('change');
                data.forEach(function(item) {
                    var newOption = new Option(item.nama, item.id, false, false);
                    $("#selectPaket").append(newOption).trigger('change');
                });
                $('#loading-paket').hide();
            },
            error: function() {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
                $('#loading-paket').hide();           
                return;
                
            },
        })
    }

    $('#selectPaket').on('select2:select', function (e) {
        var data = e.params.data;
        text = data.text;
        id = data.id
        selectPaket(id)
    });


    function selectPaket(id)
    {
        reseFields();
        $('#loading-paket').fadeIn();
        $.ajax({
            url: API_URL + '/farmasi/{{session('farmasi')->slug}}/paket-obat/get/'+ id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {

                details = data.detail
                $.each(details, function(i) {

                    var input = JSON.parse(details[i].json_format);

                    var element_form_resep = $('#modal-large').find('#resepForm');
                    fillFormTambahObat(element_form_resep,input);

                    checkPenggunaan();
                });
                $('#loading-paket').hide();
            },
            error: function() {
                $('#loading-paket').hide();
            },
        });
    }

    function fillFormTambahObat(element_form_resep,input_resep)
    {
        if(input_resep.kategori == 'generik')
        {
            var option = [];
            option.push({
                id:input_resep.idObat,
                text:input_resep.namaObat
            });
            element_form_resep.find('#namaObat').select2({
                data:option
            });
            element_form_resep.find('#obatGenerik').prop("checked", true).click();
            element_form_resep.find('#namaObat').val(input_resep.idObat).trigger('change');
            element_form_resep.find('#obat-generik').text(input_resep.namaObat);
            element_form_resep.find('#harga-generik').val(input_resep.hargaObat);
            tipeObatDb = input_resep.type;

            element_form_resep.find('#obatForGenerik').removeClass('d-none');
            $('#satuan-select2').parent().addClass('d-none');
            element_form_resep.find('#obatForRacikan').addClass('d-none');
        }
        else
        {
            element_form_resep.find('#racikan').prop("checked", true).click();
            element_form_resep.find('#satuan-select2').val(input_resep.type).trigger('change');
            element_form_resep.find('#textRacikan').val(input_resep.racikan);

            element_form_resep.find('#obatForGenerik').addClass('d-none');
            $('#satuan-select2').parent().removeClass('d-none');
            element_form_resep.find('#obatForRacikan').removeClass('d-none');

            // empty racikan field
            $(".text-racikan").empty();
            $(".jumlah-obat").val('');
            $(".harga-racikan").val('');
            $(".barang-racikan").val('').trigger('change');
            $(".btnRemoveRacikan").each(function () {
                var remove_racikan = $(this).parents('.racikan-obat-wrapper');
                remove_racikan.remove();
            });

            for (var i = 0; i < input_resep.namaObat.length; i++) {
                if (i > 0) {
                    element_form_resep.find('#btnAddRacikan').click();
                }
                var option = [];
                option.push({
                    id:input_resep.idObat[i],
                    text:input_resep.namaObat[i]
                });
                element_form_resep.find('.barang-racikan:last').select2({
                    data:option
                });
                element_form_resep.find('.barang-racikan:last').val(input_resep.idObat[i]).trigger('change');
                element_form_resep.find(".text-racikan:last").text(input_resep.namaObat[i]);
                element_form_resep.find(".jumlah-obat:last").val(input_resep.jumlahObat[i]);
                element_form_resep.find(".harga-racikan:last").val(input_resep.hargaObat[i]);
            }
        }
        
        if (harian) {
            element_form_resep.find("#jumlah-obat").val(input_resep.jumlah);
            element_form_resep.find("#hari-7").val(input_resep.jumlahHari7);
            element_form_resep.find("#hari-23").val(input_resep.jumlahHari23);
            element_form_resep.find("#dukungan-rs").val(input_resep.jumlahDukRS);
        }
        else {
            element_form_resep.find("#jumlahObat").val(input_resep.jumlah);
        }

        var newOption = new Option(input_resep.aturan, input_resep.aturan, true, true);
        $('#aturan-select2').append(newOption).trigger('change');
        // element_form_resep.find("#aturan-select2").val(input_resep.aturan).trigger('change');
        element_form_resep.find("#satuan-penggunaan-select2").val(input_resep.satuan).trigger('change');

    }
</script>