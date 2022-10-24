<script type="text/javascript">
@if(session('status'))
    $(document).ready(function(){
        swal("{{session('title')}}",
            "{{session('message')}}",
            "{{session('status')}}")
    })
@endif
$("#kategori_date").select2();
var filter = "unpaid";
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

$(document).ready(function() {
    filter="unpaid";
    draw(filter,null,null);
    $('#buttonRefresh').click(function() {    
        var tanggal_start = $("#tanggaltransaksi_start").val();
        var tanggal_end = $("#tanggaltransaksi_end").val();
        table.destroy();
        draw(filter,tanggal_start,tanggal_end);
    });
    $('#confirmPayment').on('shown.bs.modal', function () {
        $('#input-paid').focus()
    })
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
        },
        url: API_URL + '/keuangan/penagihan/getbyfilter',
    },
    columns: [
        { data: 'id', name: 'id', className: 'text-center' },
        { data: 'judul', name: 'judul' },
        { data: 'created_at', className: "text-center",
            render: function ( data ) {
                var date = new Date(data);
                return date.toShortFormat();
            } 
        },
        { data: 'total', className: 'text-right', 
            render: function ( data ) {
                return parseFloat(data).toLocaleString('id-ID', {currency: 'IDR', style: 'currency'});
            }
        },
        { data: 'nomor_surat', className: 'text-center' },
        { data: 'slug', name: 'id', className: 'text-center', 
            render: function(data, type, row, meta){
                data = '<a href="penagihan/'+data+'" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail Transaksi">&nbsp;<i class="fa fa-search-plus"></i></a>&nbsp';
                
                return data;
            },
            searchable: false,
            sortable: false}
    ]
    });
}

function updateChecked(){
    var id = transaksiCollection.pluck("pk_id");
	// alert("mashok");

	$.each(id, function( index, value ) {
        var myEle = document.getElementById("centang"+value);
        if(myEle){
            myEle.checked = true;
        }
	});
}

function resetChecked(){
    var id = transaksiCollection.pluck("pk_id");
	// alert("mashok");

	$.each(id, function( index, value ) {
        var myEle = document.getElementById("centang"+value);
        if(myEle){
            myEle.checked = false;
        }
        backboneDeleteTransaksiDetail(value);
	});
}

$(document).on('click', '.centang', function(){
    // alert($(this).data("pk"))
    pk = $(this).data("pk");
    cb = document.getElementById("centang"+pk);
    var total = $("#total"+pk).val();
    var total_paid = $("#total_paid"+pk).val();
    // alert(total-total_paid);
    // alert(cb.checked)
    if(cb.checked == true)
        backboneAddTransaksiDetail(pk,total-total_paid)
    else
        backboneDeleteTransaksiDetail(pk)
})
$('#buttonSubmit').click(function() {
    if(transaksiCollection.length < 1)
        callSwal('warning','Transaksi kosong','Centang Transaksi untuk Bayar',0);
    else{
        $('#confirmPayment').modal('toggle');
        $.ajax({
            type: "GET",
            url: API_URL + "/keuangan/akun/get",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                var option = [];
                option.push({
                    id: '',
                    text: '',
                });
                console.log(data)
                // alert(data[0].tipe.name);
                for (i in data) {
                    option.push({
                        id: data[i].id,
                        text: data[i].no_rekening+' - '+data[i].nama,
                    });
                }
                $('#akun').select2({
                    data: option
                })
            }
        });
    }

})

$('#buttonSubmitRekap').click(function() {
    if(transaksiCollection.length < 1)
        callSwal('warning','Transaksi kosong','Centang Transaksi untuk Bayar',0);
    else{

        var transaksiModel;
        var transaksiId;
        var transaksiIdSerial;

        for(var i=0; i<transaksiCollection.length; i++) {
            transaksiModel = transaksiCollection.models[i];
            transaksiId = transaksiModel.get('pk_id')
            if(i == 0 ) transaksiIdSerial = transaksiId;
            else transaksiIdSerial = transaksiIdSerial + ',' + transaksiId
        }

        window.location.href = BASE_URL + 'keuangan/piutang/rekap-penagihan?id='+transaksiIdSerial;

    }

})

$('#buttonPay').click(function() {
    var paid = $('#input-paid').val();
    var akun_id = $('#akun').val();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var today = new Date();

    var transaksiCollectionJSON = JSON.stringify(transaksiCollection);
    console.log(transaksiCollectionJSON);
    console.log(globalTotal);
    if(paid == '' || paid <=0){
        callSwal('warning','Transaksi Gagal','Silahkan isi nilai pembayaran',0);
    }
    else if(paid != globalTotal){
        callSwal('warning','Transaksi Gagal','Jumlah pembayaran harus sama dengan total tagihan.',0);
    }
    else if(akun_id == '')
		callSwal('warning','Transaksi Gagal','Akun Rekening Tidak Boleh Kosong',0);
    else{
        $('#buttonPay').hide();
        $('#buttonLoading').show();
        $.ajax({
            type: "POST",
            url: API_URL + "/keuangan/piutang/multiplepay",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                total_paid: paid,
                total: globalTotal,
                akun_id : akun_id,
                transaksi: transaksiCollectionJSON
            },
            success: function (data) {
                table.destroy();
                filter="unpaid";
                draw(filter,null,null);
                callSwal(data.type,data.title,data.text,0);
                resetChecked();
                $('#buttonPay').show();
                $('#buttonLoading').hide();
                $('#confirmPayment').modal('toggle');
            },
            error: function () {
                callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonPay').show();
                $('#buttonLoading').hide();
            }
        });
    }
})
var TransaksiDetail = Backbone.Model.extend({
	defaults: {
        pk_id: "",
        total: 0
	},
	idAttribute: "id"
});

var Transaksi = Backbone.Collection.extend({
	model: TransaksiDetail,
	sort_key: 'pk_id'
});

var transaksiCollection = new Transaksi();

function backboneAddTransaksiDetail(id,total)
{
	if(transaksiCollection.length > 0)
	{
		var transaksidetail = transaksiCollection.findWhere({pk_id: id});
		if(typeof transaksidetail !== "undefined") var is_delete = 1;
		else var is_delete = 0; 
		if(is_delete)
		{
			transaksiCollection.remove(transaksidetail)
		}
	}
	var detail = new TransaksiDetail({ 
		pk_id:id,
		total:total
	});

    transaksiCollection.add(detail);
    updateAllTotal();
}

function backboneDeleteTransaksiDetail(id)
{
	if(transaksiCollection.length > 0)
	{
		var transaksidetail = transaksiCollection.findWhere({pk_id: id});
		if(typeof transaksidetail !== "undefined") var is_delete = 1;
		else var is_delete = 0; 
		if(is_delete)
		{
			transaksiCollection.remove(transaksidetail)
		}
    }
    updateAllTotal();
}

var globalTotal = 0;

function updateAllTotal()
{
	var subtotals = transaksiCollection.pluck("total");
	
	var allTotal = 0;

	$.each(subtotals, function( index, value ) {
		allTotal+= subtotals[index]
	});

	globalTotal = allTotal;

	var allTotalFormat = numeral(allTotal).format('0,0');
    // alert(allTotal);
	$('#allTotal').html(allTotalFormat);
	//console.log(transaksiCollection);
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