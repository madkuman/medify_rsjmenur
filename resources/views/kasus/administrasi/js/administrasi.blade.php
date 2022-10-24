<script type="text/javascript">
    function tolakTransaksi(id){
        swal({
            title: 'Apa anda yakin?',
            input: 'text',
            text: "Mengapa anda membatalkan permintaan ini?",
            type: 'warning',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-outline-danger',
            showCancelButton: true,
            confirmButtonText: 'Batalkan Transaksi',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
            return !value && 'Masukan Alasan Penolakan!'
            }
        }).then((result) => {
            if (result.value) {
                console.log(result.value);
                $('#tolakKeterangan').val(result.value)            
                $('#tolakId').val(id)
                $('#formTolak').submit()
            }
        })



    }
    function tolakTransaksi2(id){
        swal({
            title: 'Apa anda yakin?',
            input: 'text',
            text: "Mengapa anda membatalkan permintaan ini?",
            type: 'warning',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-outline-danger',
            showCancelButton: true,
            confirmButtonText: 'Batalkan Transaksi',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
            return !value && 'Masukan Alasan Penolakan!'
            }
        }).then((result) => {
            if (result.value) {
                console.log(result.value);
                $('#tolakKeterangan2').val(result.value)            
                $('#tolakId2').val(id)
                $('#formTolak2').submit()
            }
        })



    }

    function printOpnameRiwayatRawatInap(transaksi_id)
    {
        popupwindow("{{url()->current()}}/rawatinap/print-permintaan-opname/"+transaksi_id,"Permintaan Opname","500","500");
    }
</script>