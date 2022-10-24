

<script src="{{asset('js/keuangan/piutang/singlev1.7.js')}}"></script>
<script type="text/javascript">

    var total_kurang = "{{$piutang->total - $piutang->total_paid}}}}"

    @if(!empty($piutang->pasien))
    var pasien_nama = "{{$piutang->pasien->name}}"
    @else
    var pasien_nama = ""
    @endif

    //PASIEN TUNAI
    $('#perusahaan').on('select2:select', function (e) {
        var value = $('#perusahaan').val();
        console.log(value);
        if(value == {{$perusahaan_tunai->id}})
            $('#split-piutang-bayar-tunai-notif').show()
        else 
            $('#split-piutang-bayar-tunai-notif').hide()
    });


    function splitPiutang() {
        $('#splitPiutang').modal('toggle');

        $.ajax({
            type: "GET",
            url: API_URL + "/keuangan/perusahaan/get",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                var option = [];
                option.push({
                    id: '',
                    text: '',
                });
                // alert(data[0].tipe.name);
                for (i in data) {
                    option.push({
                        id: data[i].id,
                        text: data[i].nama+' ('+data[i].direktur+')',
                    });
                }
                $('#perusahaan').select2({
                    data: option
                })
            }
        });
    }

    var split_count = 1;
    $('.split-add-button').click(function(){
        split_count++;
        content = `
        @include('keuangan.piutang.components-single.split-content-default')
        `
        $('#split-tambahan-container').append(content);
        $('.split-perusahaan').select2();
    })

    $('body').on('change.select2', '.split-perusahaan', function(e) {
        var data = $(this).select2('data')
        console.log(data);
        if(data[0].text == "Tunai") pj = pasien_nama;
        else pj = data[0].text;
        $(this).parent().parent().find('.split-pihak-ketiga').val(pj);
    });

    $('body').on('change', '.split-pasien-pembayaran', function(e) {
        var data = $(this).val();
        perusahaan_id = $(this).find(':selected').data('perusahaan-id');
        if(perusahaan_id != 0)
            $(this).parent().parent().find('.split-perusahaan').val(perusahaan_id).trigger('change');
    });

    
    $('body').on('click', '.split-remove-button', function(e) {
        $(this).parent().parent().remove();
    });


    function checkSplitTotal()
    {
        var total_all_split = parseInt(0);
        var total_piutang = parseInt(total_kurang);

        error_invalid_input = 0
        $(".split-total").each(function() {
            total_all_split += parseInt($(this).val());
            if($(this).val() == 0 || $(this).val() == '') {
                $(this).siblings('.text-invalid').show();
                error_invalid_input = 1;
            }
            else $(this).siblings('.text-invalid').hide();
            console.log($(this).val());
        });

        if(error_invalid_input){
            $('.split-error').html('Terdapat input tidak valid')
            return 0;
        }  
        console.log(total_all_split);

        if(total_piutang < total_all_split){
            $('.split-error').html('Total split melebihi total piutang')
            return 0;
        }
        else if(total_piutang > total_all_split)
        {
            $('.split-error').html('Total split kurang dari total piutang')
            return 0;
        }
        else{
            return 1;
        }

    }

    $('#submitSplit').click(function() {
        if(!checkSplitTotal()){
            $('.split-error').show();
            return;
        }
        $('.split-error').hide();
        $('#submitSplit').hide();
        $('#splitLoading').show();

        $('#formSplit').submit();
    });
</script>