
<script type="text/javascript">
    function permintaan_gizi(){
        window.open(
            "{{url('gizi')}}/pemesanan/baru?kasus_id={{$kasus->id}}","popUpWindow",
            "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");
    }

    function detail(id)
    {
        window.open(
            "{{url('gizi/pemesanan')}}/"+id,"popUpWindow",
            "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");
    }

    function sendidtomodal(id) {
        $.ajax({
            url: API_URL + '/gizi/pemesanan/getmutugizi/'+ id,
            type: 'GET',
            dataType: 'json',
            beforeSend:function() {
                $('#loading').removeClass('d-none');
                $('#modal-content').addClass('d-none');
            },
            success: function(data) {
                if(data.mutu_diet != null) {
                    $('select[name="diet"]').val(data.mutu_diet);
                    $('select[name="sisa"]').val(data.mutu_sisa);
                }else {
                    $('select[name="diet"]').val('');
                    $('select[name="sisa"]').val('');
                }

                $("#pemesananid").val(id);

                $('#loading').addClass('d-none');
                $('#modal-content').removeClass('d-none');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest, textStatus, errorThrown);
            },
        });
    }
    function modal_order_edit(id) {
        $.ajax({
            url: API_URL + '/gizi/pemesanan/edit/' + id,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                swal({
                    html: `<h4>Mengambil data...</h4><span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>`,
                    showCancelButton: false,
                    showConfirmButton: false
                });
            },
            success: function (data) {
                var makanan_tambahan = JSON.parse(data.makanan_tambahan_ids)
                console.log(data);
                swal.close();
                $("#select-jenismakanan").val(data.jenis_makanan_id).trigger('change');
                $("#select-diet").val(data.diet_id).trigger('change');
                $("#select-bentukmakanan").val(data.bentuk_makanan_id).trigger('change');
                $.each( makanan_tambahan, function( key, value ) {
                    $("#select-makanantambahan option[value=" + value + "]").attr('selected', 'selected');
                });
                $("#select-makanantambahan").trigger('change')
                $("#catatan-input").html(data.catatan);
                $("#pemesanan_detail_id").val(id);
                $('#loading-edit-order').hide();
                $('#content-edit-order').show();
                $("#modal-order-edit").modal('show');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                swal.close();
                console.log(XMLHttpRequest, textStatus, errorThrown);
            },
        });
    }

    function modal_order_delete(id){
        swal({
            title: "Hapus?",
            text: "Anda yakin ingin menghapus, lanjutkan?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "hapus",
            cancelButtonText: 'Batal',
        })
            .then((willDelete) => {
                if (willDelete.value) {
                    order_delete(id);
                }
            });
    }

    function order_delete(id) {
        $.ajax({
            type: "GET",
            url: API_URL + "/gizi/pemesanan/delete/"+id,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                swal({
                    html: `<h4>Menghapus data...</h4><span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>`,
                    showCancelButton: false,
                    showConfirmButton: false
                });
            },
            success: function (res) {
                swal.close();
                if(res != 200){
                    callSwal('warning', "Gagal menghapus, silahkan coba lagi.", 0, "");
                    return;
                }else{
                    callSwal('success', 'Berhasil dihapus', '', "");
                    window.location.reload();
                }
            },
            error: function (error) {
                swal.close();
                callSwal("warning", "Gagal menghapus, silahkan coba lagi.", 0, "");
                return;
            }
        });
    }

    function menuTambahan() {
        if($('#filter-vip').is(':checked')){
            $('#waktu-makan').css('display','inline');
            $('#config-jadwal-1').css('display','none');
            $('#config-jadwal-2').css('display','none');
        }else{
            $('#waktu-makan').css('display','none');
            $('#config-jadwal-1').css('display','inline');
            $('#config-jadwal-2').css('display','inline');
        }
    }

</script>