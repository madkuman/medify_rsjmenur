<script type="text/javascript">
var timer = null;
var total = 0;
var jasa = 0;
var kenaPPN = 0;

$('#bebasppn').keyup(function() {
    if (timer) {
        clearTimeout(timer);
    }
    timer = setTimeout(function() {
        fieldFill();
    }, 500);
});
$('#pengadaanbarang').keyup(function() {
    if (timer) {
        clearTimeout(timer);
    }
    timer = setTimeout(function() {
        fieldFill();
    }, 500);
});

function fieldFill(){
	jumlah = total;
	pengadaanBarang = $('#pengadaanbarang').val();
	bebasPPN = $('#bebasppn').val();

	jasa = jumlah-pengadaanBarang;
	kenaPPN = pengadaanBarang-bebasPPN;
	$('#jasa').val(numeral(jumlah-pengadaanBarang).format('0,0'));
	$('#kenappn').val(numeral(pengadaanBarang-bebasPPN).format('0,0'));
	$('#jasa-hidden').val(jasa);
	$('#kenappn-hidden').val(kenaPPN);
}
fieldFill();

$(document).ready(function() {
	total = $('#jumlah-hidden').val();
	jumlah = total;
	pengadaanBarang = $('#pengadaanbarang').val();
	jasa = jumlah-pengadaanBarang;
	$('#jasa').val(numeral(jumlah-pengadaanBarang).format('0,0'));
	$('#jasa-hidden').val(jasa);

	@if($single_utang == 1)
	@if(!empty($utang->po_id))
    $('.div-no-se').hide();
    $('#nose').prop('required',false);
    @endif
    @endif
} );

$('#idpjk').on('change', function() {
	var optionSelected = $("option:selected", this);
    var valueSelected = this.value;

	$.ajax({
		type: "GET",
		url: API_URL + "/keuangan/utang/" + valueSelected,
		dataType: "json",
		success: function (data) {
			total = data.total;
			$('#nopjk').val(data.nomorpjk);
			$('#perusahaan').append($('<option>', {
			    value: data.perusahaan_id,
			    text: data.perusahaan.nama
			}));
			if (data.po_id) {
				$('.div-no-se').hide();
    			$('#nose').prop('required',false);
			}
			else {
				$('.div-no-se').show();
    			$('#nose').prop('required',true);
			}
			$('#idtransaksi').val(data.id);
			$('#jumlah').val(numeral(data.total).format('0,0'));
			$('#jumlah-hidden').val(data.total);
			jumlah = data.total;
			pengadaanBarang = $('#pengadaanbarang').val();
			jasa = jumlah-pengadaanBarang;
			$('#jasa').val(numeral(jumlah-pengadaanBarang).format('0,0'));
			$('#jasa-hidden').val(jasa);
			$('#judul').val(data.judul);
			$('#judul-hidden').val(data.judul);
		},
		error: function () {
			callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
		}
	});
});

// $('#buttonSubmit').click(function() {
// 	$('#buttonSubmit').hide();
// 	$('#buttonLoading').show();
// });

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