<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#golonganPegawaiTable').DataTable({
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
                url  : API_URL+'/kepegawaian/master/golongan/getDataTable',
                type :'GET',
            },
            language: {
                processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
            },
            columns: [
                { data: 'DT_Row_Index' },
                { data: 'nama' },
                { data: 'indek' },
                { data: 'jp_dasar' },
                { data: 'pajak' },
                { data: 'aksi' },
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center",
                    "searchable":false,
                },
                {
                    "targets": 5,
                    "className": "text-center",
                    "searchable":false,
                }
            ],
        });
    });
    $('#golonganPegawaiTable').on('click', '.btn-edit', function(){
        var id = $(this).attr('id_data');
        $.ajax({
            type:'GET',
            url : API_URL+'/kepegawaian/master/golongan/single',
            data:{ id : id },
            beforeSend:function() {
                $('#loading').removeClass('d-none');
                $('#edit-content').addClass('d-none');
            },
            success:function(data){
                $('#edit_nama').val(data.nama);
                $('#edit_indek').val(data.indek);
                $('#edit_jp_dasar').val(data.jp_dasar);
                $('#edit_pajak').val(data.pajak);
                $('#form-edit-golongan').attr('action', 'golongan/'+id+'/edit');
                $('#loading').addClass('d-none');
                $('#edit-content').removeClass('d-none');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest, textStatus, errorThrown);
            },
        });
        $('#modal-edit').modal('show');
    });
    $('#golonganPegawaiTable').on('click', '.btn-delete', function(){
        var id = $( this ).attr( 'id_data' );
        $('#form-delete-golongan').attr('action', 'golongan/'+id+'/delete');
        $('#modal-delete').modal('show');
    });
</script>
