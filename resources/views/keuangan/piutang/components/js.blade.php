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
                return data;} },
        { data: 'id', name: 'id', className: 'text-center', 
            render: function(data, type, row, meta){
                data = '<a href="piutang/'+data+'" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Detail Transaksi">&nbsp;<i class="fa fa-search-plus"></i> Lihat</a>';
                
                return data;
            },
            searchable: false,
            sortable: false},
        { data: 'bayar',className: 'text-center', 
            render: function(data, type, row, meta){
                var res = data.split("-");
                var status = res[0];
                var id = res[1];
                if (status == 'unpaid')
                    data = '<label class="css-control css-control-success css-checkbox">&nbsp;<input type="checkbox" data-pk="'+id+'" class="css-control-input centang" id="centang'+id+'">&nbsp;<span class="css-control-indicator"></span></label>';
                else
                    data = '<span class="badge badge-pill badge-primary">LUNAS</span>';
                return data;
            },
            searchable: false,
            sortable: false}
        ],
        order: [[ 0, "desc" ]],
        drawCallback: function(){
            updateChecked();
        },  
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

$('#buttonSubmitRekap').click(function() {
    if(transaksiCollection.length < 1)
        callSwal('warning','Transaksi kosong','Centang Transaksi untuk Bayar',0);
    else{

        var transaksiModel;
        var transaksiId;
        transaksiIdSerial;

        for(var i=0; i<transaksiCollection.length; i++) {
            transaksiModel = transaksiCollection.models[i];
            transaksiId = transaksiModel.get('pk_id')
            if(i == 0 ) transaksiIdSerial = transaksiId;
            else transaksiIdSerial = transaksiIdSerial + ',' + transaksiId
        }
        $("#modal_penagihan").modal('show');
        // window.location.href = BASE_URL + 'keuangan/piutang/rekap-penagihan?id='+transaksiIdSerial;

    }

})

$('#submit_penagihan').click(function() {
    var akun = $("#akun").val();
    window.location.href = BASE_URL + 'keuangan/piutang/rekap-penagihan?id='+transaksiIdSerial+"&akun="+akun;
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