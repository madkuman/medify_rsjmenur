<script type="text/javascript">
    $(document).ready(function() {
        var anggaran_makanan_id ={{$anggaran_makanan->id}}
        $(".js-datepicker-year").datepicker( {
            format: "yyyy",
            startView: "years",
            minViewMode: "years"
        });
        $('#anggaranMakananDetailTable').DataTable({
            searching: true,
            ordering: false,
            processing: true,
            serverSide: true,
            bLengthChange: true,
            pageLength: 10,
            responsive: true,
            scrollY: "calc( 100% - 70px )",
            scrollCollapse: true,
            ajax: {
                data: {
                    id : anggaran_makanan_id
                },
                url  : API_URL+'/gizi/pengaturan/anggaran-makanan-detail/getDataTable',
                type :'GET',

            },
            language: {
                processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
            },
            columns: [
                { data: 'DT_Row_Index' },
                { data: 'tahun' },
                { data: 'jumlah' },
                { data: 'aksi' },
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center",
                    "searchable":false,
                },
                {
                    "targets": 3,
                    "className": "text-center",
                    "searchable":false,
                },
            ],
        });
    });
    $('.confirm-del').on('click', function(){
        var deleteSupp = $(this).parent().find('form');
        swal({
            title: 'Apa anda yakin?',
            text: 'Data yang telah terhapus tidak dapat dikembalikan lagi',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d26a5c',
            confirmButtonText: 'Hapus',
            html: false,
            preConfirm: function() {
                return new Promise(function (resolve) {
                    setTimeout(function () {
                        resolve();
                    }, 50);
                });
            }
        }).then(function(result){
            if (result.value) {
                deleteSupp.submit();
            } else if (result.dismiss === 'cancel') {
                swal('Batal', 'Hapus data dibatalkan.', 'error');
            }
        });
    });
    $('#anggaranMakananDetailTable').on('click', '.btn-delete', function(){
        var id = $( this ).attr( 'id_data' );

        $('#form-delete-anggaran-makanan-detail').attr('action', BASE_URL+'gizi/pengaturan/anggaran-makanan-detail/'+id+'/delete');
        $('#modal-delete').modal('show');
    });

    $('#anggaranMakananDetailTable').on('click', '.btn-edit', function(){
        var id = $(this).attr('id_data');
        console.log(id);

        $.ajax({
            type:'GET',
            url : API_URL+'/gizi/pengaturan/anggaran-makanan-detail/single-data',
            data:{ id : id },
            beforeSend:function() {
                $('#loading-detail').removeClass('d-none');
                $('#edit-content-detail').addClass('d-none');
            },
            success:function(data){
                $('#edit_detail_tahun').val(data.tahun);
                $('#edit_detail_jumlah').val(data.jumlah);

                $('#form-edit-anggaran-makanan-detail').attr('action', BASE_URL+'gizi/pengaturan/anggaran-makanan-detail/'+id+'/edit');

                $('#loading-detail').addClass('d-none');
                $('#edit-content-detail').removeClass('d-none');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest, textStatus, errorThrown);
            },
        });

        $('#modal-edit-detail').modal('show');
    });
</script>