<script type="text/javascript">
    $('#btnAddItems').on('click', function(){
        str = `@include('eusulan.usulan.components.form-add',['index' => "\${counter}", 'row' => null])`;
        $('#newItem').append(str);
        $('#barang-select2-'+counter).select2();
        initAkunRekeningSelect2('#akun-rekening-select2-'+counter,counter);
        initFileInput('#file-'+counter,counter);
        removeItem()
        counter++;
    });

    function removeItem() {
        $('.btnRemove').on('click', function(){
            var wrapper = $(this).parents('.item-wrapper');
            wrapper.remove();
            updateTotal();
        });
    }

    function initBarangSelect2(element_name,index,edit = null) {
        var akun_rekening_id = $('#akun-rekening-select2-'+index).val();
        $.ajax({
            url: API_URL+"/e-usulan/pengaturan/barang/get-from-akun-rekening",
            dataType: 'json',
            data:{
              akun_rekening_id : akun_rekening_id
            },
            success: function(data){
                var option = [];
                if(!edit) {
                    option.push({
                        id: '',
                        text: 'Pilih Barang',
                    });
                }
                for (i in data) {
                    option.push({
                        id: data[i].id,
                        text: data[i].kode +' - '+data[i].nama,
                        harga: data[i].harga,
                        satuan: data[i].satuan,
                    });
                }
                if(edit){
                    $(element_name).select2({
                        data: option
                    })
                }else {
                    $(element_name).html('').select2({
                        data: option
                    })
                }
            }
        });
        $(element_name).on('select2:select', function (e) {
            var data = e.params.data;
            changeHarga(index, data.harga);
            changeSatuan(index, data.satuan);
            changeSubtotal(index);
        });
    }

    function initAkunRekeningSelect2(element_name,index) {
        $(element_name).select2({
            ajax: {
                url: API_URL+"/e-usulan/pengaturan/akun-rekening/search",
                dataType: 'json',
                delay: 250,
                data: function (params)
                {
                    return {
                        keyword: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari Akun Rekening",
            templateResult: formatAkunRekening,
            templateSelection: formatAkunRekeningSelection
        });
    }

    function formatAkunRekening (item) {
        if (item.loading) {
            return item.text;
        }
        var markup = item.kode+' - '+item.nama;

        return markup;
    }

    function formatAkunRekeningSelection (item) {
        if(item.nama) return item.kode+' - '+item.nama;
        else return item.text;
    }

    function changeHarga(index,harga) {
        $('#harga-'+index).val(harga);
    }

    function changeSatuan(index,satuan) {
        $('#satuan-'+index).val(satuan);
    }

    function changeSubtotal(index) {
        var jumlah = $('#jumlah-'+index).val();
        var harga = $('#harga-'+index).val();
        var subtotal = jumlah * harga
        $('#subtotal-'+index).val(subtotal);
        updateTotal();
    }

    function updateTotal() {
        var subtotals = $('.subtotal-group');
        var total = 0;
        for (var i = 0; i < subtotals.length; i++) {
            if(!isNaN(parseFloat($(subtotals[i]).children('.subtotal').val()))){
                total += parseFloat($(subtotals[i]).children('.subtotal').val());
            }
        }
        $('#total').text(total);
    }

    function changeBarang(index) {
        $('#barang-select2-'+index).val('').trigger('change')
        initBarangSelect2('#barang-select2-'+index,index);
    }

    function initFileInput(element_name,index) {
        $(element_name).change(function(e){
            var fileNames =  e.target.files;
            var fileName = '';
            $.each(fileNames,function (j,item) {
                fileName += item.name+' '
            });
            if (fileName.length > 13) {
                fileName = fileName.substring(0,13)+'..';
            }
            $(this).next().html(fileName);
        });
    }
</script>