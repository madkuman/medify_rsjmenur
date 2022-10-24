<script type="text/javascript">
    $(document).ready(function() {
        draw();
    } );

    var table;
    function draw(){
        var today = $("#today").val();
        table = $('#transaksiTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: "GET",
            dataType: "json",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                tanggal : today
            },
            url: API_URL + '/keuangan/paket-pemasukan/getbydate',
        },
        columns: [
            { data: 'rownum', className: 'text-center', orderable: false },
            { data: 'judul', name: 'judul' },
            { data: 'tanggal_transaksi', className: 'text-center',
                render: function (data){
                    return data.substr(11,5);
                } 
            },
            { data: 'total', name: 'total',className: 'text-right', 
                render: function ( data ) {
                return "Rp "+numeral(data).format('0,0');} },
            { data: 'slug', name: 'slug', className: 'text-center', 
                render: function(data, type, row, meta){
                    data = '<a href="paket-pemasukan/'+data+'" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail Transaksi">&nbsp;<i class="fa fa-search-plus"></i></a>';
                    
                    return data;
                },
                searchable: false,
                sortable: false}
            ],
            order: [[ 0, "rownum" ]]
        });
    }
</script>