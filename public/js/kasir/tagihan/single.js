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
var bill_before = $('#bill').val();
var deposit = $('#uang_deposit').val();
$('#deposit').change(function(){
  //console.log($('#deposit'));
  if(this.checked)
  {
    var bill_baru = bill_before - deposit;
    $('#deposit').val('on');
    console.log($('#deposit').val());
    console.log(bill_baru);
    $('#bill').val(bill_baru);
  }
  else
  {
    $('#bill').val(bill_before);
    $('#deposit').val('off');
    console.log($('#deposit').val());
  }
});

function printContent(id){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(id).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
var piutang = 0;
$('#buttonSubmit').click(function() {
  //console.log("abc");
  var id = $('#id_tagihan').val();
  var paid = $('#input-paid').val();
  var bill = $("#bill").val();
  var pasien_pembayaran_id = $("#pasien_pembayaran").val();
  var perusahaan_id = $("#perusahaan").val();
  var penanggungjawab = $("#penanggungjawab").val();
  var akun_id = $("#akun").val();
  var is_dp = $("#dp").val();
  var pakai_deposit = $('#deposit').val();
  var uang_deposit = $('#uang_deposit').val();
  console.log(pakai_deposit);
  var kembalian = 0;
  if(paid - bill >=0)
    kembalian = paid - bill;
  if(piutang > 0 && pasien_pembayaran_id == ''){
    callSwal('warning','Transaksi Gagal','Penanggungjawab belum diisi',0);
  }
  else if(paid > 0 && akun_id == ''){
    callSwal('warning','Transaksi Gagal','Akun Pembayaran belum diisi',0);
  }
  else{
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var today = new Date();
    $('#buttonSubmit').hide();
    $('#buttonLoading').show();
      $.ajax({
        type: "POST",
        url: API_URL + "/kasir/tagihan/pay",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          id : id,
          total_paid : paid,
          total_piutang :piutang,
          pasien_pembayaran_id :pasien_pembayaran_id,
          perusahaan_id : perusahaan_id,
          penanggungjawab : penanggungjawab,
          akun_id : akun_id,
          is_dp : is_dp,
          pakai_deposit : pakai_deposit,
          uang_deposit : uang_deposit
        },
        success: function (data) {
          callSwal(data.type,data.title,data.text,data.url);
          $('#buttonSubmit').show();
          $('#buttonLoading').hide();
          //$('#buttonLoading').fadeOut();
          $('#confirmPayment').modal('toggle');
          document.getElementById('total_paid').innerHTML = "Rp "+numeral(paid).format('0,0');
          document.getElementById('kembalian').innerHTML = "Rp "+numeral(kembalian).format('0,0');
          document.getElementById('text-kembalian').innerHTML = "Rp "+numeral(kembalian).format('0,0');
          document.getElementById('paid-date').innerHTML = today.toShortFormat();
          $('#paid_img').show();
          $('#option').show();
          // $('#total_paid-par').show();
          $('#kembalian-par').show();
          $('#submit').hide();
          $('#submitdiskon').hide();
          $('#paid').hide();
          $('#modal-kembalian').modal('toggle');
        },
        error: function () {
          callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
          $('#buttonSubmit').show();
          $('#buttonLoading').hide();
        }
      });
    }
});

$('#buttonSubmitDiskon').click(function() {
  var id = $('#id_tagihan').val();
  var disc = $('#input-diskon').val();
  if(disc == '' || disc <=0){
    callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
  }
  else{
    // alert(paid);
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#buttonSubmitDiskon').hide();
    $('#buttonLoadingDiskon').show();
      
    $.ajax({
      type: "POST",
      url: API_URL + "/kasir/tagihan/diskon",
      dataType: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        id : id,
        diskon : disc
      },
      success: function (data) {
        callSwal(data.type,data.title,data.text,data.url);
        $('#buttonSubmitDiskon').show();
        $('#buttonLoadingDiskon').hide();
        //$('#buttonLoading').fadeOut();
        $('#inputDiskon').modal('toggle');
      },
      error: function () {
        callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
        $('#buttonSubmitDiskon').show();
        $('#buttonLoadingDiskon').hide();
      }
    });
  }

});

$('#submit').click(function() {
  $('#confirmPayment').modal('toggle');
})
$('#submitdiskon').click(function() {
  $('#inputDiskon').modal('toggle');
})

$('#pasien_pembayaran').on('select2:select', function (e) {
	var data = e.params.data;
  document.getElementById("perusahaan").value = data.perusahaan_keuangan_id;
  document.getElementById("penanggungjawab").value = data.perusahaan_keuangan_nama;
})

$(document).ready(function() {
  var pasien_id = $('#pasien').val();
  $.ajax({
		type: "POST",
		url: API_URL + "/kasir/tagihan/getPasienPembayaran",
		dataType: "json",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		data: {
			id : pasien_id
		},
		success: function (data) {
			var option = [];
			option.push({
				id: '',
				text: '',
			});
			console.log(data)
			// alert(data[0].perusahaan.perusahaan_keuangan.nama);
			for (i in data) {
				option.push({
					id: data[i].id,
					text: data[i].perusahaan.nama,
          perusahaan_keuangan_id : data[i].perusahaan.perusahaan_keuangan_id,
          perusahaan_keuangan_nama : data[i].perusahaan.perusahaan_keuangan.nama
				});
			}
			$('#pasien_pembayaran').select2({
				data: option
			})
		}
  });
  
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

  $('#inputDiskon').on('shown.bs.modal', function () {
    $('#input-diskon').focus()
  })
  $('#confirmPayment').on('shown.bs.modal', function () {
    $('#input-paid').focus()
  })

  var inputPayment = document.getElementById('input-paid');
  var inputDiskon = document.getElementById('input-diskon');
  inputPayment.onkeyup = function(event){
    var bill = $("#bill").val();
    var paid = inputPayment.value;
    
    if (paid >= 0){
      document.getElementById("akun_par").style.display = "";
      document.getElementById("akun").disabled = false;
    }
    else{
      document.getElementById("akun_par").style.display = "none";
      document.getElementById("akun").disabled = true;
    }

    piutang = bill-paid;
    if(piutang > 0){
      document.getElementById("pasien_pembayaran_par").style.display = "";
      document.getElementById("pasien_pembayaran").disabled = false;
    }
    else{
      document.getElementById("pasien_pembayaran_par").style.display = "none";
      document.getElementById("pasien_pembayaran").disabled = true;
    }
    
    document.getElementById('paid-piutang').innerHTML = numeral(piutang).format('0,0');
    document.getElementById("buttonSubmit").disabled = false;
    
    if(paid-bill>=0){
      document.getElementById('paid-piutang').innerHTML = 0;
      piutang = 0;
    }

    if (event.keyCode === 13) {
      $("#buttonSubmit").click();
    }
  }
  inputDiskon.onkeyup = function(event){
    var disc = inputDiskon.value;
    if(disc>=0 && disc <=100){
      document.getElementById("buttonSubmitDiskon").disabled = false;
    }
    else{
      document.getElementById("buttonSubmitDiskon").disabled = true;
    }
    if (event.keyCode === 13) {
      $("#buttonSubmitDiskon").click();
    }
  }
});

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