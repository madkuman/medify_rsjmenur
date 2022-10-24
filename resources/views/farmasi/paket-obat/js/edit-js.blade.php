
<script type="text/javascript">
    var recordEditCount = 0;

    function resepEdit(id)
    {
        $('#resepModalEdit .daftar-obat').empty();
        element = $('#resepModalEdit');

        element.find(".obat-nama-generik").val('');
        element.find(".obat-jumlah").val('');
        element.find(".obat-aturan").val('').trigger('change');
        element.find(".obat-satuan-penggunaan").val('').trigger('change');
        element.find(".obat-nama-racikan").val('');
        element.find(".obat-tipe-generik").val('');
        element.find(".obat-id-generik").val('');
        $(".obat-tipe-racikan").val('').trigger('change');
        $(".obat-barang-racikan").val('');
        $(".obat-jumlah-racikan").val('');
        $(".obat-harga-racikan").val('');
        $(".btnRemoveRacikan").each(function () {
            var remove_racikan = $(this).parents('.racikan-wrapper');
            remove_racikan.remove();
        });
        if (harian) {
            element.find(".obat-jumlah-hari-7").val('');
            element.find(".obat-jumlah-hari-23").val('');
            element.find(".obat-jumlah-dukungan-rs").val('');
        }
        element.find('.button-tambah-obat').prop('disabled',true);
        element.parent().find('.submit-resep').prop('disabled',false);
        racikan_id_count = 1;

        var load_id = "#loading-top-"+id;
        $(load_id).fadeIn();
        $.ajax({
            url: API_URL + '/farmasi/{{session('farmasi')->slug}}/paket-obat/get/'+ id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                $('#paketEditID').val(data.id);
                $('#paketEditNama').val(data.nama);
                details = data.detail
                $.each(details, function(i) {

                    var input = JSON.parse(details[i].json_format);
                    var element_form_resep = $('#resepModalEdit').find('.form-resep');
                    fillFormTambahObat(element_form_resep,input);

                    addToResepList(element_form_resep);

                });


                $('#resepModalEdit').modal('show');
                $('.loading').hide();
            },
            error: function() {
                $('.loading').hide();
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
        content += '<span class="font-w400" id="display-jumlah-aturan-obat">Jumlah : '+jumlah;
        content += '</span><br><span style="white-space:pre">Aturan : '+aturan+' '+satuan+'</span><br>'
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