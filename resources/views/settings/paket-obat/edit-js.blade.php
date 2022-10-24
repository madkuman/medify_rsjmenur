
<script type="text/javascript">
    var recordEditCount = 0;

    function resepEdit(id)
    {
        $('#resepModalEdit .daftar-obat').empty();
        element = $('#resepModalEdit');

        element.find(".obat-nama-generik").val('');
        element.find(".obat-jumlah").val('');
        element.find(".obat-aturan").val('');
        element.find(".obat-nama-racikan").val('');
        element.find(".obat-tipe-generik").val('');
        element.find(".obat-id-generik").val('');
        element.find('.button-tambah-obat').prop('disabled',true);
        element.parent().find('.submit-resep').prop('disabled',false);   

        $('#loading-top').fadeIn();
        $.ajax({
            url: API_URL + '/paket-obat/get/'+ id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#paketEditID').val(data.id);
                $('#paketEditNama').val(data.nama);
                details = data.detail
                $.each(details, function(i) {

                    recordEditCount++;
                    if(details[i].kategori == 'generik')
                        var nama_obat = details[i].item_detail.nama
                    else
                        var nama_obat = ''

                    var type = details[i].type
                    var obat = nama_obat
                    var racikan = details[i].racikan
                    var jumlah = details[i].jumlah
                    var aturan = details[i].aturan
                    var kategori = details[i].kategori
                    var obat_id = details[i].obat_id

                    var element_form_resep = $('#resepModalEdit').find('.form-resep');

                    if(kategori == 'generik')
                    {
                        var element_radio = element_form_resep.find('.kategori-radio-generik')
                        element_form_resep.find('.kategori-radio-generik').prop("checked", true).click();
                        element_form_resep.find('.obat-nama-generik').val(obat)
                        element_form_resep.find('.obat-tipe-generik').val(type)
                        element_form_resep.find('.obat-id-generik').val(obat_id)

                        toggleRacikanGenerik(element_radio,'generik',0)
                    }
                    else
                    {
                        var racikan_details = details[i].racikan_detail
                        var element_radio = element_form_resep.find('.kategori-radio-racikan')
                        toggleRacikanGenerik(element_radio,'racikan')
                        element_form_resep.find('.kategori-radio-racikan').prop("checked", true).click();
                        element_form_resep.find('.obat-tipe-racikan').val(type).trigger('change');
                        element_form_resep.find('.obat-nama-racikan').val(racikan)


                        var length = racikan_details.length;

                        var index;
                        element_form_resep.find(".racikan-detail-content-dynamic").empty()
                        for (index = 0; index < length; ++index) {
                            element_form_resep.find(".btn-add-racikan-detail").trigger( "click" );


                            var elements_racikan_obat_array = element_form_resep.find('.racikan-obat-items')
                            var elements_racikan_jumlah_array = element_form_resep.find('.racikan-obat-jumlahs')

                            var elements_racikan_obat = elements_racikan_obat_array[index]
                            var elements_racikan_jumlah = elements_racikan_jumlah_array[index]

                            var value_obat_id = racikan_details[index].obat_id
                            var value_obat_text = racikan_details[index].nama_obat

                            var $newOption = $("<option selected='selected'></option>").val(value_obat_id).text(value_obat_text)

                            $(elements_racikan_obat).append($newOption).trigger('change');

                            $(elements_racikan_jumlah).val(racikan_details[index].jumlah)

                        };
                    }  

                    element_form_resep.find('.obat-jumlah').val(jumlah)
                    element_form_resep.find('.obat-aturan').val(aturan)
                    element_form_resep.find('.button-tambah-obat').prop('disabled',false);



                    addToResepList(element_form_resep)
                    
                    var element_radio = element_form_resep.find('.kategori-radio-generik')
                    element_form_resep.find('.kategori-radio-generik').prop("checked", true).click();
                    toggleRacikanGenerik(element_radio,'generik',0)


                });


                $('#resepModalEdit').modal('show');
                $('#loading-top').hide();
            },
            error: function() {
                $('#loading-top').hide();
            },
        });
    }

    function resepDelete(id,farm)
    {
        $('#resepDeleteId').val(id)
        $('#resepDeleteFarm').val(farm)
        $('#resepModalDelete').modal('show');
    }

    function generateEditItem(index,type,obat,racikan,obat_string,jumlah,aturan,kategori,obat_id)
    {
        content = '<div class="col-12 resep-item-container" id="resepCreateItemContainer'+index+'">'
        content += '<div class="border p-15">'
        content += '<button type="button" class="float-right btn btn-sm btn-circle btn-alt-danger mr-5 mb-5 button-delete-item">'
        content += '<i class="fa fa-times"></i>'
        content += '</button>'
        content += '<span class="font-w400 text-muted" id="display-kategori-tipe-obat">'+type+'</span>'
        content += '<p class="font-w600 mb-5" id="display-nama-obat" style="white-space: pre;">'+obat_string+'</p>'
        content += '<span class="font-w400" id="display-jumlah-aturan-obat">Jumlah : '+jumlah+'</span>'
        content += '<input type="hidden" class="input-kategori-obat" name="kategori-obat[]" value="'+kategori+'">'
        content += '<input type="hidden" name="kategori-obat[]" value="'+kategori+'">'
        content += '<input type="hidden" name="tipe-obat[]" value="'+type+'">'
        content += '<input type="hidden" name="jumlah-obat[]" value="'+jumlah+'">'
        content += '<input type="hidden" name="nama-obat[]" value="'+obat+'">'
        content += '<input type="hidden" name="racikan[]" value="'+racikan+'">'
        content += '<input type="hidden" name="aturan-obat[]" value="'+aturan+'">'
        content += '<input type="hidden" name="id-obat[]" value="'+obat_id+'">'
        content += '</div>'
        content += '</div>'

        return content;
    }
</script>