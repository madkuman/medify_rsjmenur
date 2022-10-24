
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
                    url: API_URL + "/keuangan/pengeluaran/delete",
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
    // var today = $("#today").val();
    var today = "all";
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
        url: API_URL + '/keuangan/pengeluaran/getbydate',
    },
    columns: [
        { data: 'no_bk', name: 'no_bk', className: 'text-center' },
        { data: 'tanggal_transaksi', name: 'tanggal_transaksi', className: "text-center",
            render: function ( data ) {
                var date = new Date(data);
                return date.toShortFormat();
            } 
        },
        { data: 'no_spp', className: 'text-center', searchable: true, },
        { data: 'no_pjk', className: 'text-center', searchable: true, },
        { data: 'total', name: 'total',className: 'text-right', 
            render: function ( data ) {
            return "Rp "+numeral(data).format('0,0');} },
        { data: 'rekanan', className: 'text-center', searchable: true, },
        { data: 'akun', className: 'text-center', searchable: true, },
        { data: 'id', name: 'id', className: 'text-center', 
            render: function(data, type, row, meta){
                data = '<a href="pengeluaran/edit/'+data+'" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit BK">&nbsp;<i class="fa fa-edit"></i></a>&nbsp;';
                
                return data;
            },
            searchable: false,
            sortable: false}
        ],
        order: [[ 0, "asc" ], [1, "desc"]]
    });
}

Date.prototype.toShortFormat = function() {

    var month_names =["Jan","Feb","Mar",
                      "Apr","Mei","Jun",
                      "Jul","Agt","Sep",
                      "Okt","Nov","Des"];
    
    var day = this.getDate();
    var month_index = this.getMonth();
    var year = this.getFullYear();
    
    return "" + day + " " + month_names[month_index] + " " + year;
  }