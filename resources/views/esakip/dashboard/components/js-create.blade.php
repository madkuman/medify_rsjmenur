<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click','#btn-modal-create', function () {
        $('#example-file-input').val('');
        $('#modal-create').modal('show');
        $('#title-modal').html('Upload file');
        $('#btnSubmit').show();

        $(".js-datepicker-year").datepicker( {
            format: "yyyy",
            startView: "years",
            minViewMode: "years"
        });

        // ADD Absensi
        $("#form-absensi").submit(function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var formData = new FormData(this);
            $('#btnSubmit').hide();
            $('#btnLoading').show();
            $.ajax({
                type:'POST',
                dataType: 'json',
                url: BASE_URL+'e-sakip/save',
                data:formData,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                if(data.number == 200){
                    $('#btnLoading').hide();
                    $('#btnSubmit').show();
                    $('#example').DataTable().destroy();
                    var tgl = $('#periode').val();
                    $('#modal-create').modal('hide');
                    swal("!Berhasil", "Data berhasil disimpan", "success");
                    dataTable(tgl);
                } else {
                    $('#btnSubmit').show();
                    $('#btnLoading').hide();
                    swal("Opps!", data.ket, "error");
                }
                    
                },
                error: function (data) {
                    $('#btnSubmit').show();
                    $('#btnLoading').hide();
                    swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                }
            });
        });
    });
    function changeKategori(e) {
        var kategori = $('#kategori-select2').val();
        if(kategori == 2){
            $('.triwulan').removeClass('d-none')
            $('#counter-select2').prop('disabled',false);
        }else{
            $('.triwulan').addClass('d-none')
            $('#counter-select2').prop('disabled',true);
        }
    }
</script>