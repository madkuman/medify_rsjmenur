<script type="text/javascript">

$('#kategori_date').on('select2:select', function (e) {
    var current_val = $("#kategori_date").val();
    if(current_val == 1)
    {
        $("#by-date-start").hide();
        $("#by-date-end").hide();
        $("#by-date-button").hide();
        document.getElementById('tanggaltransaksi_start').value="";
        document.getElementById('tanggaltransaksi_end').value="";
        table.destroy();
        draw(filter,null,null);
    }
    else if(current_val == 2){
        $("#by-date-start").show();
        $("#by-date-end").show();
        $("#by-date-button").show();
    }
});

$('#perusahaan_dropdown').on('change', function (e) {
        $("#by-date-start").hide();
        $("#by-date-end").hide();
        $("#by-date-button").hide();
        var tanggal_start = $("#tanggaltransaksi_start").val();
        var tanggal_end = $("#tanggaltransaksi_end").val();
        table.destroy();
        draw(filter,null,null);
});

$('#asal_dropdown').on('change', function (e) {
    asal_layanan = this.value;
    showFilterLokasi(asal_layanan);
});

$('#filter_lokasi').on('change', function (e) {
    lokasi_selected = this.value
    table.destroy();
    draw(filter,null,null);
});



function showFilterLokasi(departemen){
    if(departemen == dep_rj) {
        var data = lokasi_rj
        var value_all = 'all-rj';
    }
    else if(departemen == dep_ri) {
        var data = lokasi_ri
        var value_all = 'all-ri';
    }
    else {
        var data = []
        var value_all = 'all';
    }
    $("#filter_lokasi").html(""); 

    var newState = new Option("Semua", value_all, true, true);
    $("#filter_lokasi").append(newState);

    $.each(data, function( index, item ) {
        var id = item.id
        var nama = item.nama

        var newState = new Option(nama, id, true, true);
        $("#filter_lokasi").append(newState);
    });
    $("#filter_lokasi").val(value_all).trigger('change');
}

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
                    url: API_URL + "/keuangan/piutang/delete",
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

$("#filter_status_terbayar").change(function(e){
    var filter = $("#filter_status_terbayar").val();
    table.destroy();
    draw(filter,null,null);
})

$("#tanggaltransaksi_start").change(function(e){
    var tanggal_start = $("#tanggaltransaksi_start").val();
    var tanggal_end = $("#tanggaltransaksi_end").val();
    table.destroy();
    draw(filter,tanggal_start,tanggal_end);
})

$("#tanggaltransaksi_end").change(function(e){
    var tanggal_start = $("#tanggaltransaksi_start").val();
    var tanggal_end = $("#tanggaltransaksi_end").val();
    table.destroy();
    draw(filter,tanggal_start,tanggal_end);
})

$(document).ready(function() {
    filter="unpaid";
    draw(filter,null,null);
    $('#confirmPayment').on('shown.bs.modal', function () {
        $('#input-paid').focus()
    })
    var inputPayment = $('#input-paid')
    inputPayment.onkeyup = function(event){
        if (event.keyCode === 13) {
            $("#buttonPay").click();
        }
    }
} );

var table;
function draw(filter,tanggal_start,tanggal_end){
    // alert('draw')
    var today = $("#today").val();
    var perusahaan = $('#perusahaan_dropdown').val()
    // console.log(perusahaan);
    table = $('#transaksiTable').DataTable({
    processing: true,
    serverSide: true,
    language: {
        processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>'
    },
    ajax: {
        type: "GET",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            filter : filter,
            perusahaan : perusahaan,
            tanggal_start : tanggal_start,
            tanggal_end : tanggal_end,
            asal_layanan : lokasi_selected
        },
        url: API_URL + '/keuangan/piutang/getbyfilter',
    },
    columns: [
        { data: 'id', name: 'id', className: 'text-center' },
        { data: 'judul', name: 'judul' },
        { data: 'perusahaan', name: 'perusahaan' },
        { data: 'tanggal_transaksi', name: 'tanggal_transaksi', className: "text-center",
            render: function ( data ) {
                var date = new Date(data);
                return date.toShortFormat();
            } 
        },
        { data: 'lokasi', className: 'text-left'},
        { data: 'total_id', className: 'text-right', 
            render: function ( data ) {
                var res = data.split("-");
                var total = res[0];
                var id = res[1];
                data = '<input type="text" class="d-none" id="total'+id+'" value="'+total+'"> Rp '+numeral(total).format('0,0');'';
                return data;} 
        },
        { data: 'total_paid', name: 'total_paid',className: 'text-right', 
            render: function ( data ) {
            return "Rp "+numeral(data).format('0,0');} 
        },
        { data: 'id', name: 'id', className: 'text-center', 
            render: function(data, type, row, meta){
                data = '<a href="piutang/'+data+'" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Detail Transaksi">&nbsp;<i class="fa fa-search-plus"></i> Lihat</a>';
                
                return data;
            },
            searchable: false,
            sortable: false
        }
        ],
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
</script>