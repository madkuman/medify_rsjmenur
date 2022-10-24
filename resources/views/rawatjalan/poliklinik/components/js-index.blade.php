<script type="text/javascript">
var id = $('#selectPoli').val();
var dokter_id = $('#selectDokter').val();
var ruangan_id = '{{$ruangan_id}}';
$(document).ready(function() {
	$('#selectPoli').on("select2:select", function(e) { 
		id = $('#selectPoli').val()
		window.location.href = "{{url('rawatjalan/poliklinik?poli_id=')}}"+id;
	});

	$('#selectDokter').on("select2:select", function(e) { 
		dokter_id = $('#selectDokter').val()
		window.location.href = "{{url('rawatjalan/poliklinik?poli_id=')}}"+id+"&dokter_id="+dokter_id;
	});
});


$('input[type="text"]').keyup(function(){
	var that = this, $allListElements = $('.toSearch');
	$(".panel").toggle(true);
	var $matchingListElements = $allListElements.filter(function(i, li){
		var listItemText = $(li).text().toUpperCase(), 
		searchText = that.value.toUpperCase();
		return ~listItemText.indexOf(searchText);
	});
	$allListElements.hide();
	$matchingListElements.show();
});

function confirmSwalBatalkan(id)
{
	swal({
		title: 'Apa anda yakin?',
		input: 'text',
		text: "Mengapa anda membatalkan transaksi ini?",
		type: 'warning',
		confirmButtonClass: 'btn btn-primary',
		cancelButtonClass: 'btn btn-outline-danger',
		showCancelButton: true,
		confirmButtonText: 'Tolak Transaksi',
		cancelButtonText: 'Batal',
		inputValidator: (value) => {
			return !value && 'Masukan Alasan Pembatalan!'
		}
	}).then((result) => {
		if (result.value) {
			$('#cancel_keterangan').val(result.value)            
			$('#cancel_id').val(id)
			$('#formBatal').submit()
		}
	})
}

$(document).on('click', '.button-call-antrian', function(){ 
	var transaksi_id = $(this).data("transaksi");
    ruangan_id = $(this).data('ruangan');
	$.ajax({
		url: "{{url('')}}/api/rawatjalan/antrian-screen/call/"+transaksi_id+"/"+ruangan_id,
		dataType: 'json',
		cache: false,
		type: 'GET',
		success: function(data) {
			$.notify({
				icon: "fa fa-bullhorn",
				message: "Pasien telah dipanggil melalui Screen TV"
			},{
				type: "info"
			});

			data_transaksi = data.transaksi;
			layani_btn = '';
			if (data_transaksi.status > 0) {
				layani_btn = `<button class="btn btn-alt-success btn-hero" type="submit">Lihat Hasil Pemeriksaan</button>`;
			}else if(data_transaksi.status == -1) {
				layani_btn = `<button class="btn btn-alt-danger" disabled>Transaksi Dibatalkan</button>`;
			}
			if (layani_btn != '') {
				$('#btn_layani_'+data_transaksi.id).html('');
				$('#btn_layani_'+data_transaksi.id).append(layani_btn);
			}
		},
		error: function(){
			$.notify({
				icon: "fa fa-remove",
				message: "Terjadi kesalahan coba lagi" 
			},{
				type: "danger"
			});
		}
	});
}); 

$(document).on('click', '.button-call-antrian-next', function(){ 
	$.ajax({
		url: "{{url('')}}/api/rawatjalan/antrian-screen/call-next/{{$poli_id}}/"+ruangan_id,
		dataType: 'json',
		cache: false,
		type: 'GET',
		success: function(data) {
			$.notify({
				icon: "fa fa-bullhorn",
				message: "Pasien telah dipanggil melalui Screen TV"
			},{
				type: "info"
			});
		},
		error: function(){
			$.notify({
				icon: "fa fa-remove",
				message: "Terjadi kesalahan coba lagi" 
			},{
				type: "danger"
			});
		}
	});
});

function mod(id) {
    var page = "{{url('rawatjalan/videomod')}}/"+id;
    var myWindow = window.open(page, "_blank", "scrollbars=yes,width=700,height=700,top=300");
    myWindow.focus();
}
function end(id) {
    $('#end_transaksi_id').val(id);
    $('#formEndSession').submit();
}
function restore(id) {
    $('#restore_transaksi_id').val(id);
    $('#formRestoreSession').submit();
}
function pub(id) {
    var BASE_URL = "{{url('')}}/";
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData();
    formData.append('transaksi_id',id);
    $.ajax({
        type:'POST',
        url: BASE_URL  +"api/rawatjalan/video/connecting",
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:formData,
        success:function(data){
            console.log(data);
            if(data.failure){
                swal({
                    type: 'error',
                    title: data.failure,
                    html: 'Silahkan menghubungi moderator yang bersangkutan',
                    timer: 10000,
                });
            }
            else{

                var page = "{{url('rawatjalan/videowaiting')}}/"+id;
                var myWindow = window.open(page, "_blank", "scrollbars=yes,width=700,height=700,top=300");
                myWindow.focus();
            }
        }
    });
}
</script>