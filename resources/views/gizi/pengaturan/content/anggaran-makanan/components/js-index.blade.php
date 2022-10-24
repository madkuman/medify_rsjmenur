<script type="text/javascript">
    $(document).ready(function() {
        $('#anggaranMakananTable').DataTable({
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
                url  : API_URL+'/gizi/pengaturan/anggaran-makanan/getDataTable',
                type :'GET',

            },
            language: {
                processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
            },
            columns: [
                { data: 'DT_Row_Index' },
                { data: 'nama' },
                { data: 'satuan' },
                { data: 'jenis_makanan' },
                { data: 'kelas' },
                { data: 'bangsal' },
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
</script>