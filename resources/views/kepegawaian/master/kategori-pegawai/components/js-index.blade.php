<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#kategoriPegawaiTable').DataTable({
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
                url  : API_URL+'/kepegawaian/master/kategori-pegawai/getDataTable',
                type :'GET',
            },
            language: {
                processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
            },
            columns: [
                { data: 'DT_Row_Index' },
                { data: 'nama' },
                { data: 'pembagian_jaspel' },
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
                }
            ],
        });
    });
    $('#kategoriPegawaiTable').on('click', '.btn-edit', function(){
        var id = $(this).attr('id_data');
        $.ajax({
            type:'GET',
            url : API_URL+'/kepegawaian/master/kategori-pegawai/single',
            data:{ id : id },
            beforeSend:function() {
                $('#loading').removeClass('d-none');
                $('#edit-content').addClass('d-none');
            },
            success:function(data){
                var nama=data.nama;
                var pembagian_jaspel=data.pembagian_jaspel;
                $('#edit_nama').val(nama);
                $('#edit_pembagian_jaspel').val(pembagian_jaspel);
                $('#form-edit-kategori-pegawai').attr('action', 'kategori-pegawai/'+id+'/edit');
                $('#loading').addClass('d-none');
                $('#edit-content').removeClass('d-none');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest, textStatus, errorThrown);
            },
        });
        $('#modal-edit').modal('show');
    });
    $('#kategoriPegawaiTable').on('click', '.btn-delete', function(){
        var id = $( this ).attr( 'id_data' );
        $('#form-delete-kategori-pegawai').attr('action', 'kategori-pegawai/'+id+'/delete');
        $('#modal-delete').modal('show');
    });
</script>
