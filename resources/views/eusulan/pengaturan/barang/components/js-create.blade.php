<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '#btn-modal-create', function () {
        $('#kode').val('');
        $('#nama').val('');
        $('#tipe').val('');
        $('#harga').val('');
        $('#satuan').val('');
        $('#kelompok').val('');
        $('.akun-rekening-select').val('').trigger('change');
        $('#modal-create').modal('show');
        $('#title-modal').html('Barang Baru');
        $('#btnSubmit').show();

        // ADD Absensi
        $("#form-absensi").submit(function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: BASE_URL + 'e-usulan/pengaturan/barang/save',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.number == 200) {
                        $('#example').DataTable().destroy();
                        $('.fa-spinner').addClass('d-none');
                        $('#modal-create').modal('hide');
                        swal("Berhasil!", data.ket, "success");
                        dataTable();
                    } else {
                        $('.fa-spinner').addClass('d-none');
                        $('#modal-create').modal('hide');
                        swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                    }

                },
                error: function (data) {
                    $('.fa-spinner').addClass('d-none');
                    $('#modal-create').modal('hide');
                    swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                }
            });
        });
    });
</script>