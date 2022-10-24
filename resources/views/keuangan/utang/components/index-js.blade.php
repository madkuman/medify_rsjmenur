<script type="text/javascript">
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
                    url: API_URL + "/keuangan/utang/delete",
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
                        filter="unprocessed";
                        draw(filter,null,null);
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
    filter="unprocessed";
    draw(filter,null,null);
} );

var table;
function draw(filter,tanggal_start,tanggal_end){
    table = $('#transaksiTable').DataTable({
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
            filter : filter,
            tanggal_start : tanggal_start,
            tanggal_end : tanggal_end,
        },
        url: API_URL + '/keuangan/utang/getbyfilterpenerimaan',
    },
    columns: [
        { data: 'no_faktur', name: 'no_faktur', className: 'text-center' },
        { data: 'judul', name: 'judul' },
        { data: 'tanggal_faktur', name: 'tanggal_faktur', className: "text-center",
            render: function ( data ) {
                var date = new Date(data);
                return date.toShortFormat();
            } 
        },
        { data: 'perusahaan.nama', name: 'perusahaan.nama', className: 'text-center' },
        { data: 'total', name: 'total', className: 'text-right',
        render: function ( data ) {
            return "Rp "+numeral(data).format('0,0');}},
        { data: 'id', name: 'id', className: 'text-center', 
            render: function(data, type, row, meta){
                data = '<a href="penerimaan/'+data+'" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail Transaksi">&nbsp;<i class="fa fa-search-plus"></i></a>&nbsp;<a href="penerimaan/edit/'+data+'" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">&nbsp;<i class="fa fa-edit"></i></a>&nbsp;<button class="btn btn-sm btn-alt-danger remove" id="remove" data-pk="'+data+'" data-toggle="tooltip" title="Delete Transaksi">&nbsp;<i class="fa fa-trash"></i></button>';
                
                return data;
            },
            searchable: false,
            sortable: false},
        ],
        order: [[ 2, "desc" ], [ 0, "desc" ]],  
    });
}

Date.prototype.toShortFormat = function() {

    var month_names =["Januari","Februari","Maret",
                      "April","Mei","Juni",
                      "Juli","Agustus","September",
                      "Oktober","November","Desember"];
    
    var day = this.getDate();
    var month_index = this.getMonth();
    var year = this.getFullYear();
    
    return "" + day + " " + month_names[month_index] + " " + year;
}
</script>