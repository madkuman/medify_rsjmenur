<script type="text/javascript">
    $(document).ready(function(){
        var oTable = $("#logbookTable").DataTable({
            scrollX:        true,
            scrollCollapse: true,
            dom: "t p r",
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL + '/k3/logbook/get',
            },
            language: {
                processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>'
            },
            columns: [
                { data: 'rownum', name: 'rownum', orderable: false, searchable: false, className: 'text-center'},
                // { data: 'id', name: 'id'},
                { data: 'lokasi', name: 'lokasi'},
                { data: 'tanggal', name: 'tanggal', className: 'text-center'},
                { data: 'kronologi', name: 'kronologi', orderable: false,},
                { data: 'fatality', name: 'fatality', className: 'text-center', orderable: false,},
                { data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false},
            ],
            order: []
        });

        $('#logbookSearch').on( 'keyup', function () {
            oTable.search( this.value ).draw();
        });

        
    });
</script>