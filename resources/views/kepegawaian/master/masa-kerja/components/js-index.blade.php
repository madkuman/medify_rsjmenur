<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#masaKerjaTable').DataTable({
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
                url  : API_URL+'/kepegawaian/master/masa-kerja/getDataTable',
                type :'GET',
            },
            language: {
                processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
            },
            columns: [
                { data: 'DT_Row_Index' },
                { data: 'nama' },
                { data: 'awal' },
                { data: 'akhir' },
                { data: 'indek' },
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
    $('#masaKerjaTable').on('click', '.btn-edit', function(){
        var id = $(this).attr('id_data');
        $.ajax({
            type:'GET',
            url : API_URL+'/kepegawaian/master/masa-kerja/single',
            data:{ id : id },
            beforeSend:function() {
                $('#loading').removeClass('d-none');
                $('#edit-content').addClass('d-none');
            },
            success:function(data){
                var nama=data.nama;
                var awal=data.awal;
                var akhir=data.akhir;
                var indek=data.indek;
                $('#edit_nama').val(nama);
                $('#edit_awal').val(awal);
                $('#edit_akhir').val(akhir);
                $('#edit_indek').val(indek);
                $('#form-edit-masa-kerja').attr('action', 'masa-kerja/'+id+'/edit');
                $('#loading').addClass('d-none');
                $('#edit-content').removeClass('d-none');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest, textStatus, errorThrown);
            },
        });
        $('#modal-edit').modal('show');
    });
    $('#masaKerjaTable').on('click', '.btn-delete', function(){
        var id = $( this ).attr( 'id_data' );
        $('#form-delete-masa-kerja').attr('action', 'masa-kerja/'+id+'/delete');
        $('#modal-delete').modal('show');
    });
</script>
