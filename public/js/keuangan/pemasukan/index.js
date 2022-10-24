
$(document).on('click', '.remove', function(){
    var id = $(this).data("pk")		
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        showLoaderOnConfirm: true,
        preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: "POST",
                    url: API_URL + "/keuangan/pemasukan/delete",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id : id
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
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            tanggal : today
        },
        url: API_URL + '/keuangan/pemasukan/getbydate',
    },
    columns: [
        { data: 'id', name: 'id', className: 'text-center' },
        { data: 'judul', name: 'judul' },
        { data: 'pihak_ketiga', name: 'pihak_ketiga' },
        { data: 'tanggal_transaksi', className: 'text-center',
            render: function (data){
                return data.substr(11,5);
            } 
        },
        { data: 'kategori', className: 'text-center', searchable: true, },
        { data: 'total', name: 'total',className: 'text-right', 
            render: function ( data ) {
            return "Rp "+numeral(data).format('0,0');} },
        { data: 'id', name: 'id', className: 'text-center', 
            render: function(data, type, row, meta){
                data = '<a href="pemasukan/'+data+'" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail Transaksi">&nbsp;<i class="fa fa-search-plus"></i></a>&nbsp;<a href="pemasukan/edit/'+data+'" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">&nbsp;<i class="fa fa-edit"></i></a>&nbsp;<button class="btn btn-sm btn-alt-danger remove" id="remove" data-pk="'+data+'" data-toggle="tooltip" title="Delete Transaksi">&nbsp;<i class="fa fa-trash"></i></button>';
                
                return data;
            },
            searchable: false,
            sortable: false}
        ],
        order: [[ 0, "desc" ]]
    });
}