<script type="text/javascript">
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

$('#buttonRefresh').click(function() {    
    table.destroy();
    draw();
});


var table;
function draw(){
    var start_date = $("#tanggaltransaksi_start").val();
    var end_date = $("#tanggaltransaksi_end").val();
    table = $('#transaksiTable').DataTable({
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
            filter : "paid",
            start_date : start_date,
            end_date : end_date
        },
        url: API_URL + '/kasir/tagihan/getHistory',
    },
    columns: [
        { data: 'id', name: 'id', className: 'text-center' },
        { data: 'pasien', name: 'pasien' },
        { data: 'lokasi', className: 'text-center',searchable: true },
        { data: 'judul',searchable: false },
        { data: 'total', name: 'total',className: 'text-right', 
            render: function ( data ) {
            return "Rp "+numeral(data).format('0,0');} },
        { data: 'created_at', name: 'created_at', className: "text-center",
            render: function ( data ) {
            var date = new Date(data);
            return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();} },
        { data: 'id', name: 'id', className: 'text-center', 
            render: function(data, type, row, meta){
                data = '<a href="'+BASE_URL +'kasir/'+kasir_id+'/transaksi/'+data+'" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail Transaksi">Detail</a>'

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
</script>