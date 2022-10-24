<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token').attr('content')
        }
    });

    // GET DATA
    function editDokumen(data){
            var id = data.getAttribute("data-id")
            var pegawai = data.getAttribute("data-pegawai")
            var kategori = data.getAttribute("data-kategori")
            var tahun =  data.getAttribute("data-tahun")
                $('#edit-id').val(id);
                $('#edit-pegawai').html(pegawai);
                $('#edit-kategori').html(kategori);
                $('#edit-tahun').html(tahun);

        $(".js-datepicker-year").datepicker( {
            format: "yyyy",
            startView: "years",
            minViewMode: "years"
        });

            $('#modal-edit').modal('show');
            $('#title-modal-edit').html('Edit Dokumen');

            $("#form-edit").submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var formData = new FormData(this);
                $('#btnSubmitEdit').hide();
                $('#btnLoadingEdit').show();
                $.ajax({
                    type:'POST',
                    dataType: 'json',
                    url: BASE_URL+'e-sakip/edit',
                    data:formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data){
                    if(data.number == 200){
                        $('#btnLoadingEdit').hide();
                        $('#btnSubmitEdit').show();
                        $('#example').DataTable().destroy();
                        var tgl = $('#periode').val();
                        $('#modal-edit').modal('hide');
                        swal("!Berhasil", "Data berhasil disimpan", "success");
                        dataTable(tgl);
                    } else {
                        $('#btnSubmitEdit').show();
                        $('#btnLoadingEdit').hide();
                        swal("Opps!", data.ket, "error");
                    }
                        
                    },
                    error: function (data) {
                        $('#btnSubmitEdit').show();
                        $('#btnLoadingEdit').hide();
                        swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                    }
                });
            });
		};
</script>