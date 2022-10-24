<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $('#date-denda').combodate({
            customClass: 'js-select2 form-control',
            smartDays: true,
            maxYear: new Date().getFullYear() + 1
        });
        var tgl = $('#date-denda').val();
        dataTable(tgl);
    });
    
    $("#cariPeriode").submit(function(event) {
        event.preventDefault();
        $('#example').DataTable().destroy();
            var tgl = $('#date-denda').val();
        dataTable(tgl);
    });

    function dataTable(tgl){
        $('#example').dataTable( {
            lengthMenu: [[10, 15, 20 , 25], [10, 15, 20, 25]],
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            language: {
                processing: '<div class="panel panel-default"><i class="fa fa-4x fa-gear fa-spin text-info"></i></div>',
                searchPlaceholder: ""
            },
            "ajax": {
                "url": BASE_URL+"remunerasi/api/data-denda",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "{{ csrf_token() }}",
                    "bulan": tgl,
                }
            },
            "columns": [
                {"data": "nomer", "className": "text-center"},
                {"data": "bulan", "className": "text-center"},
                {"data": "absen"},
                {"data": "lupa_absen"},
                {"data": "telat"},
                {"data": "pulang"},
                {"data": "senam"},
                {"data": "action", "className": "text-center"}
            ],
        })
    };
</script>