<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '#btn-modal-create', function () {
        $('#nama').val('');
        $('#kode').val('');
        $('#status').val('Ya').trigger('change');
        $('#modal-create').modal('show');
        $('#title-modal').html('Akun Rekening Baru');
        $('#btnSubmit').show();

        // ADD Absensi
        $("#form-absensi").submit(function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: BASE_URL + 'e-usulan/pengaturan/akun-rekening/save',
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