<script type="text/javascript">

    var ItemObat = {};
    var typingTimer2;
    var doneTypingInterval2 = 2000;  
    $('.obatLoading').hide();   
    var currentSelectedItem;   
    var currentSelectedItemName;

    $(".input-rute").select2({
        dropdownParent: $("#modalFormObat")
    });

    function searchResep(search_url,suggestions,suggest, term)
    {   
        currentSelectedItem = '';
        $.ajax({
            url: search_url,
            type: 'GET',
            data: {
                keyword : term
            },
            dataType: 'json',
            success: function(response) {
                data = response.data
                for (i = 0; i < data.length; i++) {
                    var suggestword = data[i].nama;
                    suggestions.push(suggestword);
                    ItemObat[suggestword] = data[i];
                }
                suggest(suggestions);
                $('.obatLoading').hide();
            },
            error: function() {
            },
        });

    }
    $('.obat-autocomplete').autoComplete({
        minChars: 3,
        source: function(term, suggest){
            term = term.toLowerCase();
            var search_url = API_URL+"/farmasi/item/get"
            var suggestions    = [];
            $('.obatLoading').show();
            clearTimeout(typingTimer2); 
            typingTimer2 = setTimeout(searchResep(search_url,suggestions,suggest, term), doneTypingInterval2);
        },
        onSelect: function(event, term,item) {
            clearTimeout(typingTimer2); 
            var selected = ItemObat[term]
            currentSelectedItem = ItemObat[term].id;
            item.parent().parent().find('.obat-id').val(currentSelectedItem)
            currentSelectedItemName = term;  
        }
    });
    $('.obat-autocomplete').change(function (){
        if($(this).val() != currentSelectedItemName)
           $(this).parent().parent().find('.obat-id').val('')
        else
             $(this).parent().parent().find('.obat-id').val(currentSelectedItem)
    })

    $('.isiPemberianBtn').click(function()
    {
        var id = $(this).data("id")
        var method = $(this).data("method")
        var obat_nama = $(this).data("nama")

        $('#modalFormPemberianObat .input-id').val(id)
        if(method == 'create')
        {   
            $('#modalFormPemberianObat .deleteBtnPemberian').hide();
            var default_tanggal = "{{Carbon\Carbon::now()->format('d-m-Y')}}"
            var default_jam = "{{Carbon\Carbon::now()->format('H:i')}}"
            var date_start = moment(new Date()).subtract(30,'days').format('DD-MM-YYYY');
            var date_end = moment(new Date()).add(30,'days').format('DD-MM-YYYY');

            var obat_px_id = $(this).data("obat-px-id")
            $('#modalFormPemberianObat .input-id').val("")
            $('#modalFormPemberianObat .input-obat-px-id').val(obat_px_id)
            $('#modalFormPemberianObat .input-tanggal').val(default_tanggal)
            $('#modalFormPemberianObat .input-tanggal').attr('min',date_start);
            $('#modalFormPemberianObat .input-tanggal').attr('max',date_end);
            $('#modalFormPemberianObat .input-jam').val(default_jam)
            $('#modalFormPemberianObat .input-status').val("sukses")
            $('#modalFormPemberianObat .input-evaluasi').val("")
            $('#modalFormPemberianObat .input-obat-nama').val(obat_nama)
            $('#modalFormPemberianObat .deleteBtnPemberian').data('id',"");
        }
        else
        {
            $('#modalFormPemberianObat .deleteBtnPemberian').show();
            $('#riwayatModal').modal('hide')
            var content = $(this).data("content")
            var pemberian_at = moment(content.pemberian_at)
            var tanggal = pemberian_at.format('DD-MM-YYYY');
            var jam = pemberian_at.format('HH:mm');
            console.log(pemberian_at)
            var date_start = pemberian_at.subtract(30, 'days').format('DD-MM-YYYY');
            var date_end = pemberian_at.add(60, 'days').format('DD-MM-YYYY');


            $('#modalFormPemberianObat .input-id').val(id)
            $('#modalFormPemberianObat .input-obat-px-id').val(content.catatan_pengobatan_pasien_id)
            $('#modalFormPemberianObat .input-tanggal').val(tanggal)
            $('#modalFormPemberianObat .input-tanggal').attr('min',date_start);
            $('#modalFormPemberianObat .input-tanggal').attr('max',date_end);
            $('#modalFormPemberianObat .input-jumlah').val(content.jumlah)
            $('#modalFormPemberianObat .input-jam').val(jam)
            $('#modalFormPemberianObat .input-status').val(content.status)
            $('#modalFormPemberianObat .input-evaluasi').val(content.evaluasi)
            $('#modalFormPemberianObat .input-verified-by').val(content.verified_by).trigger('change');
            $('#modalFormPemberianObat .input-verified-by-2').val(content.verified_by_2).trigger('change');
            $('#modalFormPemberianObat .input-evaluasi').val(content.evaluasi)
            $('#modalFormPemberianObat .input-obat-nama').val(obat_nama)
            $('#modalFormPemberianObat .deleteBtnPemberian').data('id',id);
        }

        $('#modalFormPemberianObat').modal('show')

    });

    $('.deleteBtnPemberian').click(function()
    {
        id = $(this).data("id");
        $('#formDeletePemberian .input-id').val(id);
        swal({
            title: "Hapus",
            text: "Apakah anda yakin akan menghapus data ini?",
            showCancelButton: true,
            reverseButtons: true,
            type: 'warning',
            confirmButtonClass: "btn btn-danger",
            cancelButtonClass: "btn btn-default",
            confirmButtonText: "Hapus",
            cancelButtonText: "Kembali",
            closeOnConfirm: false
        }).then(function(result) {
            if(result.value)
            {
                $('#formDeletePemberian').submit();
            }
        });
    })

    $('.isiObatBtn').click(function()
    {
        var id = $(this).data("id")
        var method = $(this).data("method")

        $('#modalFormObat .input-id').val(id)
        if(method == 'create')
        {
            $('#modalFormObat .input-id').val("")
            $('#modalFormObat .input-nama').val("")
            $('#modalFormObat .input-rute').val("")
            $('#modalFormObat .input-keterangan').val("")
            $('#modalFormObat .input-aturan').val("")
            $('#modalFormObat .input-obat-id').val("")
        }
        else
        {
            var content = $(this).data("content")

            $('#modalFormObat .input-id').val(content.id)
            $('#modalFormObat .input-nama').val(content.nama_obat)
            $('#modalFormObat .input-rute').val(content.rute).trigger('change');
            $('#modalFormObat .input-keterangan').val(content.keterangan)
            $('#modalFormObat .input-aturan').val(content.aturan_pemakaian)
            $('#modalFormObat .input-obat-id').val(content.obat_id)

            if ($('#modalFormObat .input-rute').val() != content.rute) {
                var newOption = new Option(content.rute, content.rute, false, false);
                $('#modalFormObat .input-rute').append(newOption);
                $('#modalFormObat .input-rute').val(content.rute).trigger('change');
            }
        }

        $('#modalFormObat').modal('show')

    });

    $('#submit-pemberian').click(function()
    {
        $('#warning-tanggal-pemberian').addClass('d-none');
        $('#warning-jam-pemberian').addClass('d-none');
        $('#warning-jumlah-pemberian').addClass('d-none');
        var tanggal = $('#modalFormPemberianObat .input-tanggal').val();
        var min = $('#modalFormPemberianObat .input-tanggal').attr('min').split('-');
        var max = $('#modalFormPemberianObat .input-tanggal').attr('max').split('-');
        var jam = $('#modalFormPemberianObat .input-jam').val();
        var jumlah = $('#modalFormPemberianObat .input-jumlah').val();
        var valid = 0;
        if(!jumlah){
            $('#warning-jumlah-pemberian').removeClass('d-none');
            valid++;
        }
        if(tanggal){
            tanggal = tanggal.split('-');
            tanggal = tanggal[2]+''+tanggal[1]+''+tanggal[0];
            min = min[2]+''+min[1]+''+min[0];
            max = max[2]+''+max[1]+''+max[0];
            console.log(tanggal,min,max,tanggal>=min,tanggal<=max)
            if(tanggal >= min && tanggal <= max);
                else{
                $('#warning-tanggal-pemberian').removeClass('d-none');
                valid++;
            }
        }else{
            $('#warning-tanggal-pemberian').removeClass('d-none');
            valid++;
        }
        if(jam){
            jam = jam.split(':');
            if(jam[0] <= 23 && jam[1] <=59 && jam[0].length == 2 && jam[1].length == 2);
                else {
                $('#warning-jam-pemberian').removeClass('d-none');
                valid++;
            }
        }else{
            $('#warning-jam-pemberian').removeClass('d-none');
            valid++;
        }

        if(valid == 0){
            $('#form-pemberian').submit();
        }
    });

</script>