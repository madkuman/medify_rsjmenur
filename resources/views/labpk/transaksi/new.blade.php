@extends('layouts.main2')
@section('title')
Buat Transaksi Baru
@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Buat Permintaan Baru</h3>
        </div>
        <div class="block-content">
            @include('layouts.components2.lab.new-transaksi-form')
        </div>
        <input type="hidden" name="" id="departemenId" value="{{$departemen}}">
    </div>
</div>
@include('layouts.components2.lab.confirmation-modal-lab')
@include('labpk.components.footer')
@endsection
@section('js')
<script type="text/javascript">
    var layananUrl = "{{url('keuangan/tarif_master/get_lab')}}";
    var kelasWarning = $("#kelasWarn");
    var tipeWarning = $("#tipeWarn");
    var pasienWarning = $("#pasienWarn");
    var pembayaranWarning = $("#pembayaranWarn");

    var kelasForm = $("#kelasLayanan");
    var tipeForm = $("#tipeLayanan");
    var pembayaranForm = $("#pasien-pembayaran");
    var kasusForm = $("#kasus_dropdown");
</script>
@include('layouts.components2.lab.form-permintaan-js')
@include('layouts.components2.lab.new-transaksi-js')
<script type="text/javascript">

    getMikrobiologiSpesimen();
    $(document).on('click', '.single-layanan', function(){ 
        var count_mikrobiologi = 0;
        $('.single-layanan').each(function(i, obj) {
            obj = $(obj);
            var kategori_slug = obj.find('input').data('kategori-slug');
            var checked = obj.find('input').prop("checked");

            if(checked == true && kategori_slug == 'lab-pk-mikrobiologi')
                count_mikrobiologi++;
        });

        if(count_mikrobiologi > 0)
        {
            $('#spesimenContainer').css('display', 'block');
        }
        else
        {
            $('#spesimenContainer').hide()
        }
    })

    function getMikrobiologiSpesimen()
    {
        var targetUrl = "{{url('api/labpk/mikrobiologi-spesimen/get-all')}}";
        $.ajax({
            url: targetUrl,
            type: 'GET',
            dataType: 'json',
            beforeSend: function(){
                $('.loader').css('display', 'block');
            },
            success: function(response) {
                loadResponseSpesimenMikrobiologi(response);
            },
            complete: function(){
                $('.loader').css('display','none');
            },
            error: function() {
                $('#errorContainer').css('display', 'block');
            },
        });
    }

    function loadResponseSpesimenMikrobiologi(response)
    {
        let responseLength = Object.keys(response).length;
        if(responseLength){
            let formCode = '';

            response.forEach(function(kategori){
                formCode += `<div class="col-12"><h5 class="bg-info p-10 kategori-text" style="margin-bottom: 5px; margin-top: 20px;">${kategori.nama}</h5></div>`;

                var spesimens = kategori.spesimen;
                var offset = Math.floor(spesimens.length/2);
                let flag = true;
                let count = 0;
                formCode += `<div class="col-6">`;

                kategori.spesimen.forEach(function(spesimen){

                    if(count >= offset && flag){
                        formCode += `</div><div class="col-6">`;
                        flag = false;
                    }
                    formCode += `<div><label class="css-control css-control-primary css-checkbox spesimen-mk-item">
                    <input type="checkbox" name="spesimen_mikrobiologi[]" value="${spesimen.id}" class="css-control-input"  data-input-keterangan="${spesimen.input_keterangan}">
                    <span class="css-control-indicator"></span><span class="tarif-name"> ${spesimen.nama}</span>
                    </label>
                    `;

                    if(spesimen.input_keterangan == 1)
                    {
                        formCode+=
                        `
                        <div class="form-group spesimen-mk-item-input-keterangan" style="display:none">
                        <input type="text" class="form-control" name="spesimen_mikrobiologi_keterangan[${spesimen.id}]">
                        </div>
                        `
                    }
                    formCode+=`</div>`;

                    count++;
                });
                formCode += `</div>`;
            })
            $('#spesimenDiv').html(formCode);
        } else {
            $('#emptyContainerSpesimen').css('display', 'block');
        }
    }



$(document).on('click', '.spesimen-mk-item', function(){ 
    var obj = $(this);
    var input_keterangan = obj.find('input').data('input-keterangan');
    var checked = obj.find('input').prop("checked");


    if(checked == true && input_keterangan == '1')
    {
        alert('here')
        obj.parent().find('.spesimen-mk-item-input-keterangan').show();
    }
    else
    {
        obj.parent().find('.spesimen-mk-item-input-keterangan').hide();
    }
})
</script>
@endsection