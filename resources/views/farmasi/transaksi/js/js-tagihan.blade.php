<script type="text/javascript">
 $(document).ready(function(){
    // $('#btnConfirm').attr('disabled', false)
    // $('#btn-kirim-kasir').hide();
    // $('#tujuan-pembayaran').hide();
    $('#tujuan-bayar input:radio').click(function() {
        if ($(this).val() === '0') {
            $('#btn-kirim-kasir').show();
            $('#btnConfirm').attr('disabled', true)
        } else {
            $('#btn-kirim-kasir').hide();
            if((flag == 0 || stok_kurang_confirm))
                $('#btnConfirm').attr('disabled', false)
        } 
        
    });

     if ({!! json_encode($transaksi->status_kasir) !!} == 1) {
        if ({!! json_encode($transaksi->status) !!} != 1) {
            if((flag == 0 || stok_kurang_confirm))
                $('#btnConfirm').attr('disabled', false);
        } else {
            $('#btnConfirm').attr('disabled', true);
        }
     } else {
        $('#btnConfirm').attr('disabled', true);
     }

    if({!! json_encode($metode_pembayaran) !!} === 'Tunai'){
        $('#btn-kirim-kasir').show();
        $('#tagihanKasir').prop("checked", true); 
        if((flag > 0 && !stok_kurang_confirm))
            $('#btnConfirm').attr('disabled', true)
    } else {
        $('#btn-kirim-kasir').hide();
        $('#tagihanKasus').prop("checked", true);
        if((flag == 0 || stok_kurang_confirm))
            $('#btnConfirm').attr('disabled', false)
    }
});

//Ter
$('#btn-kirim-kasir').on('click',function(){
    $(this).prepend('<i class="fa fa-spinner fa-spin mr-2"></i>');
    $(this).attr("disabled", true);
    $('#btn-kirim-kasir').attr('disabled', true)
        $.ajax({
            url: "{{url('farmasi/'.session('farmasi')->slug.'/transaksi/kirim-kasir')}}",
            type: "post",
            dataType: 'json',
            data: {
                "id": $("#id_transaksi").val(),
                "jumlah": "{{$transaksi->total_biaya_obat}}",
                "slug": "{{session('farmasi')->slug}}",
                "asal_pelayanan": "{{$transaksi->lokasi->nama}}",
                "embalase" : $("#embalase").val(),
                "laba" : ()=>{
                    var laba=[];
                    $(".input-diskon").each(function () {
                       laba.push($(this).val() ?? 0);
                    });
                    return laba;
                },
                "_token": "{{ csrf_token() }}",
            } ,
            success: function (response) {
                if(response.status == 1){
                    callSwal(response.type,response.title,response.message,response.url);
                    $(this).attr("disabled", true);
                    $(this).find(".btn-click-animate i").remove();
                    location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal('Gagal', 'Gagal dikirim ke kasir.', 'error');
                $("#btn-kirim-kasir").removeAttr("disabled");
               
           }
       });
});

$('#btnBatalKirimKasir').on('click',function(){
    $(this).prepend('<i class="fa fa-spinner fa-spin mr-2 btn-click-animate"></i>');
    $(this).attr("disabled", true);
    $('#btnBatalKirimKasir').attr('disabled', true)
        $.ajax({
            url: "{{url('farmasi/'.session('farmasi')->slug.'/transaksi/batal-kirim-kasir')}}",
            type: "POST",
            dataType: 'json',
            data: {
                "id": "{{$transaksi->piutang_id}}",
                "transaksi_id": "{{$transaksi->id}}",
                "_token": "{{ csrf_token() }}",
            } ,
            success: function (response) {
                callSwal(response.type,response.title,response.text,response.url);
                 $('#btnBatalKirimKasir').find(".btn-click-animate").remove();
                if(response.status == 1){
                     $('#btnBatalKirimKasir').attr("disabled", true);
                    location.reload();
                }else{
                    $("#btnBatalKirimKasir").removeAttr("disabled");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal('Gagal', 'Gagal Batalkan Transaksi Kasir.', 'error');
                $("#btnBatalKirimKasir").removeAttr("disabled");
               
           }
       });
});
</script>