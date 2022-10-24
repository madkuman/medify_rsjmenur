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
                    url: API_URL + "/keuangan/pengeluaran/delete",
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

$(document).ready(function() {
    draw();
} );

var table;
function draw(){
    var type = "all";
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
            type : type
        },
        url: API_URL + '/keuangan/pengeluaran/getbydate',
    },
    columns: [
        { data: 'id', name: 'id', className: 'text-center' },
        { data: 'tanggal_transaksi', name: 'tanggal_transaksi', className: "text-center",
            render: function ( data ) {
                var date = new Date(data);
                return date.toShortFormat();
            }
        },
        { data: 'spp.nomorpjk', name: 'spp.nomorpjk', className: 'text-center'},
        { data: 'total', name: 'total', className: 'text-right',
        render: function ( data ) {
            return "Rp "+numeral(data).format('0,0');}},
        { data: 'pengadaan_barang', name: 'pengadaan_barang', className: 'text-right',
        render: function ( data ) {
            return "Rp "+numeral(data).format('0,0');}},
        { data: 'bebas_ppn', name: 'bebas_ppn', className: 'text-right',
        render: function ( data ) {
            return "Rp "+numeral(data).format('0,0');}},
        { data: 'kena_ppn', name: 'kena_ppn', className: 'text-right',
        render: function ( data ) {
            return "Rp "+numeral(data).format('0,0');}},
        { data: 'jasa', name: 'jasa', className: 'text-right',
        render: function ( data ) {
            return "Rp "+numeral(data).format('0,0');}},
        { data: 'id', name: 'id', className: 'text-center', 
            render: function(data, type, row, meta){
            	if (row.spp.no_spp) {
            		data = '<a href="uji/edit/'+data+'" class="btn btn-sm btn-alt-warning mb-5" data-toggle="tooltip" title="Edit UJI">&nbsp;<i class="fa fa-edit"></i></a>&nbsp;<button class="btn btn-sm btn-alt-danger remove mb-5" id="remove" data-pk="'+data+'" data-toggle="tooltip" title="Hapus UJI">&nbsp;<i class="fa fa-trash"></i></button>&nbsp;<a href="uji/print/'+data+'" class="btn btn-sm btn-alt-secondary mb-5" data-toggle="tooltip" title="Print Struk UJI">&nbsp;<i class="fa fa-print"></i></a>';
            	} else {
            		data = `<a class="btn btn-sm btn-alt-primary mb-5" href="{{url('keuangan/spp/baru?utang_id=`+row.spp.id+`')}}" data-toggle="tooltip" title="Buat SPP">&nbsp;<i class="fa fa-paper-plane"></i></a>&nbsp;<a href="uji/edit/`+data+`" class="btn btn-sm btn-alt-warning mb-5" data-toggle="tooltip" title="Edit UJI">&nbsp;<i class="fa fa-edit"></i></a>&nbsp;<button class="btn btn-sm btn-alt-danger remove mb-5" id="remove" data-pk="`+data+`" data-toggle="tooltip" title="Hapus UJI">&nbsp;<i class="fa fa-trash"></i></button>&nbsp;<a href="uji/print/`+data+`" class="btn btn-sm btn-alt-secondary mb-5" data-toggle="tooltip" title="Print Struk UJI">&nbsp;<i class="fa fa-print"></i></a>`;
            	}
                
                return data;
            },
            searchable: false,
            sortable: false},
        ],
        order: [[ 0, "desc" ], [ 1, "desc" ]],
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