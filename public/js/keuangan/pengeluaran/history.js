$("#kategori").select2();

$('#kategori').on('select2:select', function (e) {
	var current_val = $("#kategori").val();
	if(current_val == 1)
	{
        $("#by-date").hide();
        $("#by-date-submit").hide();
        document.getElementById('tanggaltransaksi').value="";
        table.destroy();
        draw("all");
	}
	else
	{
        $("#by-date").show();
        $("#by-date-submit").show();
	}
});

$(document).ready(function() {
    draw("all");
    $('#buttonRefresh').click(function() {    
        var tanggal = $("#tanggaltransaksi").val();
        table.destroy();
        draw(tanggal);
    });
} );

var table;
function draw(tanggal){
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
            tanggal : tanggal
        },
        url: API_URL + '/keuangan/pengeluaran/getbydate',
    },
    columns: [
        { data: 'id', name: 'id', className: 'text-center' },
        { data: 'judul', name: 'judul' },
        { data: 'tanggal_transaksi', name: 'tanggal_transaksi', className: "text-center",
            render: function ( data ) {
                var date = new Date(data);
                return date.toShortFormat();
            } 
        },
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
                data = '<a href="'+data+'" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail Transaksi">&nbsp;<i class="fa fa-search-plus"></i></a>';
                
                return data;
            },
            searchable: false,
            sortable: false}
        ],
        order: [[ 0, "desc" ]]
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