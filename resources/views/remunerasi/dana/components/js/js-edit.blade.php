<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token').attr('content')
        }
    });

    // GET DATA
    function editDana(data){
        var id                = data.getAttribute("data-id")
        var bulan             = data.getAttribute("data-tanggal")
        var nominal           = data.getAttribute("data-jumlah")

        $('#id').val(id);
        $('#edit-nominal').val(nominal);
        $('#bulan').text(bulan)
        $('#modal-edit-dana').modal('show');

        $("#form-edit-dana").submit(function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var formData = new FormData(this);
            $('#btnSubmit').hide();
            $('#btnLoading').show();
            $.ajax({
                type:'POST',
                dataType: 'json',
                url: BASE_URL+'remunerasi/dana/edit',
                data:formData,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    if(data.number == 200){
                        $('#btnLoading').hide();
                        $('#btnSubmit').show();
                        swal("!Berhasil", "Data berhasil diubah", "success").then((result) => {
                            if (result.value) {
                                $('#example').DataTable().destroy();
                                var tgl = $('#date-dana').val();
                                dataTable(tgl);
                                $('#modal-edit-dana').modal('hide');
                            }
                        })
                    } else {
                        $('#btnSubmit').show();
                        $('#btnLoading').hide();
                        swal("Opps!", "Dana Tidak Tersedia", "error");
                    }

                },
                error: function (data) {
                    $('#btnSubmit').show();
                    $('#btnLoading').hide();
                    swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                }
            });
        });
    };
</script>