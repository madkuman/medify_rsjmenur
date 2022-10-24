<script type="text/javascript">
function printContent(id){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(id).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
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
                    url: API_URL + "/keuangan/pjk/delete",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id : id
                    },
                    success: function (data) {
                        callSwal(data.type,data.title,data.text,data.url);
                    },
                    error: function () {
                        callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                    }
                })
            });
        }
    })
});

$('#submit').click(function() {
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
})

$('#buttonSubmit').click(function() {
    var id = $('#id_utang').val();
    var paid = $('#input-paid').val();
    var akun_id = $('#akun').val();
    if (paid <= 0 || paid == '')
        callSwal('warning','Transaksi Gagal','Masukkan Nominal Pembayaran',0);
    else if(akun_id == '')
		callSwal('warning','Transaksi Gagal','Akun Rekening Tidak Boleh Kosong',0);
    else{
        var bill = $("#bill").val();
        var sisa = bill - paid;
        var terbayar = paid;
        if(sisa <= 0){
            sisa = 0;
            terbayar = bill; 
            $('#submit').hide();
        }
        
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var today = new Date();
        $('#buttonSubmit').hide();
        $('#buttonLoading').show();
            
        $.ajax({
        type: "POST",
        url: API_URL + "/keuangan/utang/pay",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id : id,
            total_paid : terbayar,
            akun_id : akun_id
        },
        success: function (data) {
            callSwal(data.type,data.title,data.text,data.url);
            $('#buttonSubmit').show();
            $('#buttonLoading').hide();
            //$('#buttonLoading').fadeOut();
            $('#confirmPayment').modal('toggle');
            // document.getElementById('total_paid').innerHTML = "Rp "+numeral(bill-sisa).format('0,0');
            // $("#bill").val(0);
        },
        error: function () {
            callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
            $('#buttonSubmit').show();
            $('#buttonLoading').hide();
        }
        });
    }
});

$(document).ready(function() {
    $('#confirmPayment').on('shown.bs.modal', function () {
      $('#input-paid').focus()
    })
    var inputPayment = document.getElementById('input-paid');
    inputPayment.onkeyup = function(event){
        var paid = inputPayment.value;
        if(paid <= 0 || paid==''){
            document.getElementById("buttonSubmit").disabled = true;
        }
        else{
            document.getElementById("buttonSubmit").disabled = false;
        }
        if (event.keyCode === 13) {
            $("#buttonSubmit").click();
        }
    }
});
</script>