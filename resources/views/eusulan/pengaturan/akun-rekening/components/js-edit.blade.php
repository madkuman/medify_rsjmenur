<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token').attr('content')
        }
    });

    // GET DATA
    function editAkunRekening(data) {
        $('#edit-id').val(data.getAttribute("data-id"));
        $('#edit-nama').val(data.getAttribute("data-nama"));
        $('#edit-kode').val(data.getAttribute("data-kode"));
        $('#edit-status').val(data.getAttribute("data-status")).trigger('change');
        $('#title-modal-edit').html('Edit Akun Rekening');
        $('#modal-edit').modal('show');

        $("#form-edit").submit(function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: BASE_URL + 'e-usulan/pengaturan/akun-rekening/edit',
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