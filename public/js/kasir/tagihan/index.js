var table;
function draw(){
    table = $('#transaksiTable').DataTable({
    processing: true,
    serverSide: true,
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
        { data: 'pasien', 
            render: function ( data ) {
                var res = data.split("-");
                var name = res[0];
                var rm = res[1];
                return name+'&nbsp;<br>&nbsp;<span class="badge badge-pill badge-primary">No. RM : '+rm+'</span>';},
                searchable: true },
        { data: 'lokasi', className: 'text-center',searchable: true },
        { data: 'judul',searchable: true },
        { data: 'total_bill', name: 'total_bill',className: 'text-right', 
            render: function ( data ) {
            return "Rp "+numeral(data).format('0,0');} },
        { data: 'created_at', name: 'created_at', className: "text-center",
            render: function ( data ) {
            var date = new Date(data);
            return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();} },
        { data: 'id', name: 'id', className: 'text-center', 
            render: function(data, type, row, meta){
                data = '<a href="transaksi/invoice/'+data+'" class="btn btn-primary">Bayar</a>';
                
                return data;
            },
            searchable: false,
            sortable: false}
        ],
        order: [[ 0, "desc" ]]
    });
}
$(document).ready(function() {
    draw();
}); 