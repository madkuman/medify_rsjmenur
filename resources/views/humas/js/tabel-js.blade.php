<script type="text/javascript">
    $(document).ready(function(){
        var start = "{{$start.'sd'.$end}}";
        var oTable = $("#komplainTable").DataTable({
            scrollX:        true,
            scrollCollapse: true,
            dom: "t p r",
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL + '/humas/komplain/search/'+start,
            },
            language: {
                processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>'
            },
            columns: [
                { data: 'rownum', name: 'rownum', orderable: false, searchable: false},
                // { data: 'id', name: 'id'},
                { data: 'komplain_keterangan', name: 'komplain_keterangan'},
                { data: 'lokasi', name: 'lokasi'},
                { data: 'komplain_tanggal', name: 'komplain_tanggal', orderable: false,},
                { data: 'respon_tanggal', name: 'respon_tanggal', orderable: false,},
                { data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: []
        });

        $('#komplainSearch').on( 'keyup', function () {
            oTable.search( this.value ).draw();
        });
    });
</script>