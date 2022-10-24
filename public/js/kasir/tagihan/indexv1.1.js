
var table = $('#transaksiTable').DataTable({
    "ordering": true,
    processing: true,
    serverSide: true,
    language: {
        processing: '<div class="panel panel-default"><i class="fa fa-4x fa-gear fa-spin text-info"></i></div>'
    },
    ajax: {
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            id : $('#idkasir').val(),
            filter : "unpaid"
        },
        url: API_URL + '/kasir/tagihan/getHistory',
    },
    columns: [
        { data: 'id', name: 'id', className: 'text-center' },
        { data: 'pasien', name: 'pasien' },
        { data: 'lokasi', className: 'text-center' },
        { data: 'judul', name:'judul', searchable: false },
        { data: 'total', name: 'total',className: 'text-right', 
            render: function ( data ) {
            return "Rp "+numeral(data).format('0,0');} },
        { data: 'created_at', name: 'created_at', className: "text-center",
            render: function ( data ) {
            var date = new Date(data);
            return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();} },
        { data: 'id', name: 'id', className: 'text-center', 
            render: function(data, type, row, meta){
                data = '<a href="transaksi/'+data+'" class="btn btn-primary">Bayar</a>';
                
                return data;
            },
            searchable: false,
            sortable: false}
        ],
        order: [[ 0, "desc" ]]
    });

$(document).ready(function() {
    table.draw();
}); 