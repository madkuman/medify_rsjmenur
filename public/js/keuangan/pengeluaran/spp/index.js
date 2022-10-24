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
                    url: API_URL + "/keuangan/spp/edit",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id : id,
                        delete : 1
                    },
                    success: function (data) {
                        table.destroy();
                        callSwal(data.type,data.title,data.text,0);
                        filter="unpaid";
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

$(document).on('click', '.print', function(){
    var id = $(this).data("pk");
    $('#print-id').val(id);
});

$(document).ready(function() {
    filter="unpaid";
    draw(filter,null,null);
} );

var table;
function draw(filter,tanggal_start,tanggal_end){
    table = $('#indexTable').DataTable({
    processing: true,
    serverSide: true,
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
        url: API_URL + '/keuangan/utang/getbyfilterSPP',
    },
    columns: [
        { data: 'id', name: 'id', className: 'text-center' },
        { data: 'no_pjk', name: 'no_pjk', className: 'text-center' },
        { data: 'tanggal_spp', name: 'tanggal_spp', className: "text-center",
            render: function ( data ) {
                var date = new Date(data);
                return date.toShortFormat();
            } 
        },
        { data: 'perusahaan', className: 'text-center', searchable: true, },
        { data: 'total', name: 'total', className: 'text-right',
        render: function ( data ) {
            return "Rp "+numeral(data).format('0,0');}},
        { data: 'id', name: 'id', className: 'text-center', 
            render: function(data, type, row, meta){
                data = '<a href="spp/'+data+'" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail SPP">&nbsp;<i class="fa fa-search-plus"></i></a>&nbsp;<a href="spp/edit/'+data+'" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail SPP">&nbsp;<i class="fa fa-edit"></i></a>&nbsp;<button class="btn btn-sm btn-alt-danger remove" id="remove" data-pk="'+data+'" data-toggle="tooltip" title="Delete Transaksi">&nbsp;<i class="fa fa-trash"></i></button>&nbsp;<span class="print" data-toggle="modal" data-target="#print-spp" data-pk="'+data+'"><a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Print Laporan SPP Struk">&nbsp;<i class="fa fa-print"></i></a></span>&nbsp;';
                return data;
            },
            searchable: false,
            sortable: false},
        ],
        order: [[ 0, "desc" ]],  
    });
}

Date.prototype.toShortFormat = function() {

    var month_names =["January","February","March",
                      "April","May","June",
                      "July","August","September",
                      "October","November","December"];
    
    var day = this.getDate();
    var month_index = this.getMonth();
    var year = this.getFullYear();
    
    return "" + day + " " + month_names[month_index] + " " + year;
  }