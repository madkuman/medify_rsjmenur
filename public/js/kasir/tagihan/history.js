$(document).on('click', '.remove', function(){
    var id = $(this).data("pk")			
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        input: 'textarea',
        inputAttributes: {
            autocapitalize: 'off'
        },
        inputPlaceholder: 'Masukkan Keterangan..',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        showLoaderOnConfirm: true,
        preConfirm: function(keterangan) {
            return new Promise(function(resolve) {
                $.ajax({
                    type: "POST",
                    url: API_URL + "/kasir/tagihan/delete",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id : id,
                        keterangan: keterangan
                    },
                    success: function (data) {
                        table.destroy();
                        callSwal(data.type,data.title,data.text,0);
                        draw();
                    },
                    error: function () {
                        callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                    }
                })
            });
        }
    })
});
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
            filter : "paid"
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
                data = '<a href="invoice/'+data+'" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail Transaksi">&nbsp;<i class="fa fa-search-plus"></i></a>&nbsp;<a href="edit/'+data+'" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">&nbsp;<i class="fa fa-edit"></i></a>&nbsp;<button class="btn btn-sm btn-alt-danger remove" id="remove" data-pk="'+data+'" data-toggle="tooltip" title="Delete Transaksi">&nbsp;<i class="fa fa-trash"></i></button>';
                
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