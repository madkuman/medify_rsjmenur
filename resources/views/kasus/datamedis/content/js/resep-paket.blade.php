<script type="text/javascript">
    getDataPaket();
    function getDataPaket(){
        $('#loading-paket').show();
         $.ajax({
            url: API_URL + '/paket-obat/get/all',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#selectPaket').html('')
                var dataCount=0;
                var newOption = new Option("", "", false, false);
                $("#selectPaket").append(newOption).trigger('change');
                data.forEach(function(item) {
                    var nama = item.nama + ' - oleh : '+ item.creator.name
                    var newOption = new Option(nama, item.id, false, false);
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
        $('#loading-top').fadeIn();
        $.ajax({
            url: API_URL + '/paket-obat/get/'+ id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                details = data.detail
                
                var size = details.length-1
                seedFormResep(details,0,size)

                $('#loading-top').hide();
            },
            error: function() {
                $('#loading-top').hide();
            },
        });
    }

    function seedFormResep(details,i,size,transaksi_id = 0)
    {
        
        if(details[i] == undefined)
            return
        if (transaksi_id == 0) {
            if(details[i].kategori == 'generik')
                var nama_obat = details[i].item_detail.nama
            else
                var nama_obat = ''
        }

        var type = details[i].type
        var obat = transaksi_id != 0 ? details[i].obat_name : nama_obat
        console.log(obat)
        var racikan = details[i].racikan
        var jumlah = details[i].jumlah
        var aturan = details[i].aturan
        var kategori = details[i].kategori
        var obat_id = details[i].obat_id
        if(kategori == 'racikan')
            var racikan_details = details[i].racikan_detail

        var element_form_resep = transaksi_id != 0 ? $('#resepModalEdit').find('.form-resep') : $('#modal-create-resep').find('.form-resep');

        if(kategori == 'generik')
        {
            var element_radio = element_form_resep.find('.kategori-radio-generik')
            element_form_resep.find('.kategori-radio-generik').prop("checked", true).click();
            element_form_resep.find('.obat-nama-generik').text(obat)
            element_form_resep.find('.obat-tipe-generik').val(type)
            element_form_resep.find('.obat-id-generik').val(obat_id)

            toggleRacikanGenerik(element_radio,'generik',0)
        }
        else
        {
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

        var paket_data = [];
        paket_data["i"] = i;
        paket_data["size"] = size; 
        paket_data["details"] = details;
        checkPenggunaan(element_form_resep,1,paket_data,transaksi_id)
        

        var element_radio = element_form_resep.find('.kategori-radio-generik')
        element_form_resep.find('.kategori-radio-generik').prop("checked", true).click();
        toggleRacikanGenerik(element_radio,'generik',0)
    }
</script>