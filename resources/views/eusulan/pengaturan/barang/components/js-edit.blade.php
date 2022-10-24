<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token').attr('content')
        }
    });

    // GET DATA
    function editBarang(data) {
        var id = data.getAttribute("data-id");
        $.ajax({
            type:'GET',
            url:API_URL + '/e-usulan/pengaturan/barang/get/'+id,
            dataType: 'json',
            success:function(data){
                console.log(data)
                $('#edit-id').val(data.id);
                $('#edit-kode').val(data.kode);
                $('#edit-nama').val(data.nama);
                $('#edit-tipe').val(data.tipe);
                $('#edit-harga').val(data.harga);
                $('#edit-satuan').val(data.satuan);
                $('#edit-kelompok').val(data.kelompok);
                var akun_barang  = data.akun_barang;
                if(akun_barang.length == 0){
                    $('.akun-rekening-select').val('').trigger('change');
                }else{
                    $.each( akun_barang, function( key, value ) {
                        $(".akun-rekening-select").append(new Option(value.akun_rekening.kode+' - '+ value.akun_rekening.nama,value.akun_rekening_id, true, true));
                    });
                }
                $('#title-modal-edit').html('Edit Barang');
                $('#modal-edit').modal('show');
            },
            error:function(data){
                console.log(data);
            }
        });

        $("#form-edit").submit(function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: BASE_URL + 'e-usulan/pengaturan/barang/edit',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.number == 200) {
                        $('#example').DataTable().destroy();
                        $('.fa-spinner').addClass('d-none');
                        $('#modal-edit').modal('hide');
                        swal("Berhasil!", data.ket, "success");
                        dataTable();
                    } else {
                        $('.fa-spinner').addClass('d-none');
                        swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                    }

                },
                error: function (data) {
                    $('.fa-spinner').addClass('d-none');
                    swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                }
            });
        });
    };
</script>