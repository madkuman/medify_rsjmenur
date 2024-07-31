$("#kategori").select2();
$("#kategori_date").select2();
var filter = "all";
$('#kategori').on('select2:select', function (e) {
	var current_val = $("#kategori").val();
	if(current_val == 1)
	{
        document.getElementById('tanggaltransaksi_start').value="";
        document.getElementById('tanggaltransaksi_end').value="";
        $("#by-date-start").hide();
        $("#by-date-end").hide();
        $("#kategori_date").val("1").trigger("change");
        table.destroy();
        filter = "all";
        draw(filter,null,null);
    }
    else if(current_val == 2){
        document.getElementById('tanggaltransaksi_start').value="";
        document.getElementById('tanggaltransaksi_end').value="";
        $("#by-date-start").hide();
        $("#by-date-end").hide();
        $("#kategori_date").val("1").trigger("change");
        table.destroy();
        filter = "processed";
        draw(filter,null,null);
    }
    else if(current_val == 3){
        document.getElementById('tanggaltransaksi_start').value="";
        document.getElementById('tanggaltransaksi_end').value="";
        $("#by-date-start").hide();
        $("#by-date-end").hide();
        $("#kategori_date").val("1").trigger("change");
        table.destroy();
        filter = "unprocessed";
        draw(filter,null,null);
    }
});
$('#kategori_date').on('select2:select', function (e) {
	var current_val = $("#kategori_date").val();
	if(current_val == 1)
	{
        $("#by-date-start").hide();
        $("#by-date-end").hide();
        document.getElementById('tanggaltransaksi_start').value="";
        document.getElementById('tanggaltransaksi_end').value="";
        table.destroy();
        draw(filter,null,null);
    }
    else if(current_val == 2){
        $("#by-date-start").show();
        $("#by-date-end").show();
    }
});

$(document).ready(function() {
    filter="all";
    draw(filter,null,null);
    $('#buttonRefresh').click(function() {    
        var tanggal_start = $("#tanggaltransaksi_start").val();
        var tanggal_end = $("#tanggaltransaksi_end").val();
        table.destroy();
        draw(filter,tanggal_start,tanggal_end);
    });
} );

var table;
function draw(filter,tanggal_start,tanggal_end){
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
            filter : filter,
            tanggal_start: tanggal_start,
            tanggal_end: tanggal_end,
        },
        url: url = API_URL + '/keuangan/utang/getbyfilterPJK',
    },
    columns: [
        { data: 'no_pjk', name: 'no_pjk', className: 'text-center' },
        { data: 'judul', name: 'judul' },
        { data: 'tanggal_transaksi', name: 'tanggal_transaksi', className: "text-center",
            render: function ( data ) {
                var date = new Date(data);
                return date.toShortFormat();
            } 
        },
        { data: 'perusahaan', className: 'text-center', searchable: true, },
        { data: 'total', name: 'total', className: 'text-right',
        render: function ( data ) {
            return "Rp "+numeral(data).format('0,0');}},
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