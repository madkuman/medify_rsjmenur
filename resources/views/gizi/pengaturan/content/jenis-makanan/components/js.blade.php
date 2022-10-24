<script type="text/javascript">
    $(document).ready(function() {
        $('#jenisMakananTable').DataTable({
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
                dataSrc: "data",
                url  : API_URL+'/gizi/pengaturan/jenis-makanan/getDataTable',
                type :'GET',

            },
            language: {
                processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
            },
            columns: [
                { data: 'DT_Row_Index' },
                { data: 'nama' },
                { data: 'jenis' },
                { data: 'aksi' },
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center",
                    "searchable":false,
                },
                {
                    "targets": 2,
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
        $('#btn-add').on('click', function(){
            $('#modal-create').modal('show');
        });
    });

    $('#jenisMakananTable').on('click', '.btn-edit', function(){
        var id = $(this).attr('id_data');

        $.ajax({
            type:'GET',
            url : API_URL+'/gizi/pengaturan/jenis-makanan/single-data',
            data:{ id : id },
            beforeSend:function() {
                $('#loading').removeClass('d-none');
                $('#edit-content').addClass('d-none');
            },
            success:function(data){
                $('#edit_nama').val(data.nama);
                $('#edit_utama').val(data.utama).trigger('change');
                $('#edit_diet').val(data.diet).trigger('change');

                $('#form-edit-jenis-makanan').attr('action', 'jenis-makanan/'+id+'/edit');

                $('#loading').addClass('d-none');
                $('#edit-content').removeClass('d-none');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest, textStatus, errorThrown);
            },
        });

        $('#modal-edit').modal('show');
    });

    $('#jenisMakananTable').on('click', '.btn-delete', function(){
        var id = $( this ).attr( 'id_data' );

        $('#form-delete-jenis-makanan').attr('action', 'jenis-makanan/'+id+'/delete');
        $('#modal-delete').modal('show');
    });

    function changeJenis(utama,diet_class,diet) {
        var utama_val = $(utama).val();
        if(utama_val == 1){
            $(diet_class).removeClass('d-none')
            $(diet).prop('disabled',false);
        }else{
            $(diet_class).addClass('d-none')
            $(diet).prop('disabled',true);
        }
    }

</script>