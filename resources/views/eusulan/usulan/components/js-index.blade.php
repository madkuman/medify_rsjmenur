<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script  type="text/javascript">
    var filter_unit = '';
    var filter_periode ='';

    $(document).ready(function() {
        $(".js-datepicker-year").datepicker( {
            format: "yyyy",
            startView: "years",
            minViewMode: "years"
        });
        filter_periode = $('#filter-periode').val();
        filter_unit = $('#filter-unit').val();
        dataTable(filter_periode,filter_unit);
    });

    function dataTable(tgl,unit){
        $('#example').DataTable().destroy();
        $('#example').dataTable( {
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
                url  : API_URL+'/e-usulan',
                type :'GET',
                data: {
                    'tahun': tgl,
                    'unit' : unit,
                }
            },
            language: {
                processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
            },
            columns: [
                { data: 'DT_Row_Index' },
                { data: 'tahun' },
                { data: 'unit' },
                { data: 'nama' },
                { data: 'aksi' }
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center",
                    "searchable":false,
                },
                {
                    "targets": 4,
                    "className": "text-center",
                    "searchable":false,
                }
            ],
        })
    };

    $( document ).on('change', '#filter-periode', function(){
        filter_periode = $('#filter-periode').val();
        filter_unit = $('#filter-unit').val();
        dataTable(filter_periode,filter_unit);
    });

    $( document ).on('change', '#filter-unit', function(){
        filter_unit = $('#filter-unit').val();
        filter_periode = $('#filter-periode').val();
        dataTable(filter_periode,filter_unit);
    });

</script>