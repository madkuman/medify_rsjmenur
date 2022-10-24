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
    $('#confirmPayment').on('shown.bs.modal', function () {
        $('#input-paid').focus()
    })
    var inputPayment = document.getElementById('input-paid');
    inputPayment.onkeyup = function(event){
        var bill = globalTotal;
        var paid = inputPayment.value;
        if(paid-bill>=0){
            document.getElementById("buttonPay").disabled = false;
        }
        else{
            document.getElementById("buttonPay").disabled = true;
        }
        if (event.keyCode === 13) {
            $("#buttonPay").click();
        }
    }
} );

var table;
function draw(){
    var today = $("#today").val();
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
            filter : today
        },
        url: API_URL + '/keuangan/jasa-medis/get/index',
    },
    columns: [
    { data: 'id', name: 'id', className: 'text-center' },
    { data: 'created_at', className: 'text-center',  },
    { data: 'username', name: 'username' },
    { data: 'deskripsi', className: 'text-center', searchable: true, },
    { data: 'total', className: 'text-right', 
    render: function ( data, type, row, meta) {
        data = '<input type="text" class="d-none"  id="total'+row.id+'"  value="'+data+'"> Rp '+numeral(data).format('0,0');'';
        return data;} },
        
        
        { data: 'bayar',className: 'text-center', 
        render: function(data, type, row, meta){
            data = '<label class="css-control css-control-success css-checkbox">&nbsp;<input type="checkbox" data-pk="'+row.id+'" class="css-control-input centang" id="centang'+row.id+'">&nbsp;<span class="css-control-indicator"></span></label>';
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

$(document).on('click', '.centang', function(){
    pk = $(this).data("pk");
    cb = document.getElementById("centang"+pk);
    var total = $("#total"+pk).val();
    total = parseInt(total)
    if(cb.checked == true)
        backboneAddTransaksiDetail(pk,total)
    else
        backboneDeleteTransaksiDetail(pk)
})
$('#buttonSubmit').click(function() {
    if(transaksiCollection.length < 1)
        callSwal('warning','Transaksi kosong','Centang Transaksi untuk Bayar',0);
    else{
        $('#confirmPayment').modal('toggle');
    }

})

$('#buttonPay').click(function() {
    var paid = $('#input-paid').val();
    
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var today = new Date();
    $('#buttonPay').hide();
    $('#buttonLoading').show();
    var transaksiCollectionJSON = JSON.stringify(transaksiCollection);
    console.log(transaksiCollectionJSON);
    console.log(globalTotal);
    $.ajax({
        type: "POST",
        url: API_URL + "/keuangan/jasa-medis/multiplepay",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            total_paid: globalTotal,
            transaksi: transaksiCollectionJSON
        },
        success: function (data) {
            table.destroy();
            draw();
            callSwal(data.type,data.title,data.text,0);
            $('#buttonSubmit').show();
            $('#buttonLoading').hide();
            $('#confirmPayment').modal('toggle');
            $('#buttonPay').show();
        },
        error: function () {
            callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
            $('#buttonSubmit').show();
            $('#buttonLoading').hide();
            $('#buttonPay').show();
        }
    });
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
    console.log(transaksiCollection);
}