@extends('igd.layouts.blank')

@section('title')
Check In - Pendaftaran Online
@endsection

@section('css')

<style type="text/css">
.bg-image {display: block;}
#boarding_pass {display: none;}
#lembar_sep {display: none;}
input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
	-webkit-appearance: none;
	margin: 0;
}

input[type="number"] {
	-moz-appearance: textfield;
}

@media print {
	.rumkital{
		background-color: #000066 !important;
		-webkit-print-color-adjust: exact; 
	}
	@page{
		/*SEP*/
		/*size: 205mm 107mm;*/

		/*BOARDING PASS*/
		size: 50mm 170mm;

		margin: 0px;
		padding: 0px;
	}
	html, body {
		background-color: white;
		margin: 0px;
		padding: 0px;
	}
	/*.bg-image {display: none;}*/


	/*SEP*/
	/*#boarding_pass {display: none;}*/
	/*#lembar_sep {display: block;}*/


	/*BOARDING PASS*/
	/*#boarding_pass {display: block;}*/
	/*#lembar_sep {display: none;}*/
}
.blue{
	background-color: #000066;
}
.page-content { 
	position: relative; 
	top: 200px;
	left: -255px;
	/*background-color: red;*/
	width: 800px; 
	height: 400px;
}
.rumkital{
	color: white;
	width: 340px;
	text-align: center;
	background-color: #000066; 
	font-size: 23px;
	font-family: sans-serif;
	padding: 8px;
}
.barcode{
	position: absolute;
	left: 50px;
	top: 852px;
	z-index: 1;
}
table .tabel-layout-sep{
	border-collapse: collapse;
	font-size: 14px;
	line-height: 150%;
	white-space: nowrap;
}
#logobpjspanjang{
	position: absolute;
	top: 10px;
	left: 30px;
}
</style>
@endsection
@section('content')
<div class="bg-image" style="background-image: url('{{ asset('assets/img/rsal.jpg') }}');">
	<div class="hero-static content content-full bg-white-op-95 invisible" data-toggle="appear" data-class="animated fadeIn">
		<!-- Avatar -->
		<div class="pt-0 pb-10 px-5 text-center">
			<!-- <img class="img-avatar w-30" src="{{url('assets/img')}}/rumkital.png" alt=""> -->
			<h2 class=" font-w700 my-10">Pendaftaran Online Pelayanan Rawat Jalan</h2>
			<h5 class=" font-w400 text-muted mb-5">Masukkan Nomor RM dan Kode Booking Anda</h5>
		</div>
		<!-- END Avatar -->

		<!-- Unlock Content -->
		<div class="row justify-content-center px-5">
			<div class="col-sm-8 col-md-6 col-xl-5">
				{!! csrf_field() !!}
				<div class="form-group row">
					<div class="col-12">
						<label for="lock-password" style="font-size: 1rem">Nomor RM</label>
						<input type="number" class="input-el form-control border-primary" style="height: 50px; font-size: 2rem;" name="no_rm" id="no_rm">
					</div>
					<div class="col-12 mt-5">
						<label for="lock-password" style="font-size: 1rem">Kode Booking</label>
						<input type="text" class="input-el form-control border-primary" style="height: 50px; font-size: 2rem;" name="kode_booking" id="kode_booking">
					</div>
				</div>
				<div class="form-group mt-5">
					<button type="button" class="btn btn-block btn-hero btn-noborder btn-primary" id="btn-cetak">
						<i class="fa fa-paper-plane mr-10"></i> Cetak
					</button>
				</div>
				<div class="alert alert-danger text-center" id="error-message" style="display: none">
				</div>
			</div>
		</div>
		<div class="row justify-content-center px-5 pt-20">
			<div class="col-sm-8 col-md-6 col-xl-5 row">
				<div class="col-3 text-center px-5">
					<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5" value="1" style="width: 100%">
						<b style="font-size: 30px;">1</b>
					</button>
				</div>
				<div class="col-3 text-center px-5">
					<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5" value="2" style="width: 100%">
						<b style="font-size: 30px;">2</b>
					</button>
				</div>
				<div class="col-3 text-center px-5">
					<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5" value="3" style="width: 100%">
						<b style="font-size: 30px;">3</b>
					</button>
				</div>
				<div class="col-3 text-center px-5">
					<button type="button" class="btn btn-hero btn-danger mr-5 mb-5 btn-delete" style="width: 100%">
						<i class="fa fa-chevron-left"></i>
					</button>
				</div>
				<div class="col-3 text-center px-5">
					<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5" value="4" style="width: 100%">
						<b style="font-size: 30px;">4</b>
					</button>
				</div>
				<div class="col-3 text-center px-5">
					<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5" value="5" style="width: 100%">
						<b style="font-size: 30px;">5</b>
					</button>
				</div>
				<div class="col-3 text-center px-5">
					<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5" value="6" style="width: 100%">
						<b style="font-size: 30px;">6</b>
					</button>
				</div>
				<div class="col-3 text-center px-5">
					<button type="button" class="btn btn-hero btn-danger mr-5 mb-5 btn-clear" style="width: 100%">
						CLEAR
					</button>
				</div>
				<div class="col-3 text-center px-5">
					<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5" value="7" style="width: 100%">
						<b style="font-size: 30px;">7</b>
					</button>
				</div>
				<div class="col-3 text-center px-5">
					<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5" value="8" style="width: 100%">
						<b style="font-size: 30px;">8</b>
					</button>
				</div>
				<div class="col-3 text-center px-5">
					<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5" value="9" style="width: 100%">
						<b style="font-size: 30px;">9</b>
					</button>
				</div>
				<div class="col-3 text-center">
				</div>
				<div class="col-3 text-center">
				</div>
				<div class="col-3 text-center px-5">
					<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5" value="0" style="width: 100%">
						<b style="font-size: 30px;">0</b>
					</button>
				</div>
				<div class="col-3 text-center">
				</div>
				<div class="col-3 text-center">
				</div>
			</div>
		</div>
		<!-- END Unlock Content -->
	</div>

	<div id="modal_print" class="modal fade" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="block-options">
					<button type="button" class="btn-block-option pull-right mr-10 mt-10" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-close fa-2x"></i>
					</button>
				</div>
				<div class="modal-body text-center pt-40">
					<h2>Pendaftaran Berhasil !</h2>
					<i class="fa fa-check-circle text-success fa-8x mb-20"></i>
					<h4>Silahkan Cetak Lembar SEP dan Boarding Pass dibawah ini</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-hero" id="btn_print_sep">
						<i class="fa fa-print mr-10"></i>Cetak Lembar SEP
					</button>
					<button type="button" class="btn btn-primary btn-hero" id="btn_print_boarding_pass">
						<i class="fa fa-print mr-10"></i>Cetak Boarding Pass
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END Page Container -->

<div id="boarding_pass" class="hide" style="font-weight: 900">
	<div class="rumkital">
		{{config('app.name')}}
	</div>
	<div class="barcode">
		<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMwAAAAeAQMAAABaGmOVAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAAC1JREFUKJFj+FNg/6D+B3Of/R8+dpk6hgf8xxkK2B/w/3j8gWFUalRqVAomBQAGfnPIxVCiNAAAAABJRU5ErkJggg==" alt="barcode">
	</div>
	<div class="page-content" style="transform: rotate(90deg); margin-right: 700px;">
		<table>
			<tr>
				<!-- <td width="5%" class="part blue" style=""></td> -->
				<td width="60%" class="part">
					<table style="margin-top: 15px;">
						<tr>
							<td class="pl-20" width="5%">
								<img src="http://localhost/medify/medifyhospital/public/assets/img/rumkital.png" height="55">
							</td>
							<td width="80%" class="title">
								POLI AKUPUNTUR
							</td>
						</tr>
					</table>
					<br>
					<table>
						<tr>
							<td class="pl-20 label" width="50%">NAMA PASIEN</td>
							<td class="label" width="50%">JENIS KELAMIN / USIA</td>
						</tr>
						<tr>
							<td class="pl-20 big" width="50%">DR ADISURIYANTO</td>
							<td class="big" width="50%">Laki laki, 54 th</td>
						</tr>
					</table>
					<br>
					<table>
						<tr>
							<td class="pl-20 label" width="50%">NO RM</td>
							<td class="label" width="50%">TTL</td>
						</tr>
						<tr>
							<td class="pl-20 big" width="50%">628836</td>
							<td class="big" width="50%">Surabaya, 1965-05-09</td>
						</tr>
					</table>
					<br>
					<table>
						<tr>
							<td class="pl-20 label" width="50%">JENIS PEMBAYARAN</td>
							<td class="label" width="50%">ESTIMASI PELAYANAN</td>
						</tr>
						<tr>
							<td class="pl-20 big" width="50%">Tunai</td>
							<td class="big" width="50%">23 September 2019, 14:34</td>
						</tr>
					</table>
				</td>
				<td width="35%" class="part grey">
					<table style="padding-top: 12px;">
						<tr>
							<td class="pl-20">TUJUAN SELANJUTNYA</td>
						</tr>
					</table>
					<br>
					<table>
						<tr>
							<td class="pl-20 label" width="60%">TUJUAN</td>
							<td class="label" width="40%">TANGGAL</td>
						</tr>
						<tr>
							<td class="pl-20 gap">_____________</td>
							<td class="gap">__________</td>
						</tr>
					</table>
					<br>
					<table>
						<tr>
							<td class="pl-20 label" width="60%">TUJUAN</td>
							<td class="label" width="40%">TANGGAL</td>
						</tr>
						<tr>
							<td class="pl-20 gap">_____________</td>
							<td class="gap">__________</td>
						</tr>
					</table>
					<br>
					<table>
						<tr>
							<td class="pl-20 label" width="60%">TUJUAN</td>
							<td class="label" width="40%">TANGGAL</td>
						</tr>
						<tr>
							<td class="pl-20 gap">_____________</td>
							<td class="gap">__________</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</div>

<div id="lembar_sep" class="hide" style="font-size: 20px;">
	<div style="transform: rotate(90deg);">
		<div style="" id="logobpjspanjang">
			<img src="{{url('assets/img')}}/logobpjspanjang.png" style="height: 30px">
		</div>
		<div style="" class="text-center">
			<span>SURAT ELEGIBILITAS PESERTA <br> {{config('app.name')}}</span>
		</div>

		<div class="row" style="font-family: sans-serif; margin-top: 25px; margin-left: 23px;">
			<div class="col-7" style="">
				<table class="tabel-layout-sep" style="width: 100%">
					<tr>
						<td class="" style="width: 29%">No.SEP</td>
						<td style="width: 1%" class="">:</td>
						<td style="width: 70%;">1301R0100819V013931</td>
					</tr>
					<tr>
						<td class="">Tgl.SEP</td>
						<td class="">:</td>
						<td>2019-12-12</td>
					</tr>
					<tr>
						<td class="">No.Kartu</td>
						<td class="">:</td>
						<td>0001720565875</td>
					</tr>
					<tr>
						<td class="">Nama Peserta</td>
						<td class="">:</td>
						<td>KEVIN ALIF FACHREZA</td>
					</tr>
					<tr>
						<td class="">Tgl Lahir</td>
						<td class="">:</td>
						<td>09-03-1997</td>
					</tr>
					<tr>
						<td class="">Jenis Kelamin</td>
						<td class="">:</td>
						<td>L</td>
					</tr>
					<tr>
						<td class="">Poli Tujuan</td>
						<td class="">:</td>
						<td>INSTALASI GAWAT DARURAT</td>
					</tr>
					<tr>
						<td class="">Diagnosa Awal</td>
						<td class="">:</td>
						<td>Total anomalous pulmonary venous connection</td>
					</tr>
					<tr>
						<td class="">Catatan</td>
						<td class="">:</td>
						<td>-</td>
					</tr>
					<tr>
						<td colspan="3" style="color: white; font-size: 6px;">.</td>
					</tr>
					<tr>
						<td class="" colspan="3" style="font-size: 10px;">*SEP bukan sebagai bukti penjamin peserta</td>
					</tr>
				</table>
			</div>
			<div class="col-5" style="">
				<table class="tabel-layout-sep" style="width: 100vw">
					<tr>
						<td class="" style="width: 25%">Jenis BPJS</td>
						<td style="width: 4%" class="">:</td>
						<td style="width: 71%">MANDIRI</td>
					</tr>
					<tr>
						<td class="">Jenis Rawat</td>
						<td class="">:</td>
						<td>Rawat Jalan</td>
					</tr>
					<tr>
						<td class="">Kelas Rawat</td>
						<td class="">:</td>
						<td>VIP</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

<!-- Codebase Core JS -->
@section('js')
<script type="text/javascript">
	var active_el = null;
	var myWindow = null;
	$('form').on('focus', 'input[type=number]', function(e) {
		$(this).on('wheel', function(e) {
			e.preventDefault();
		});
	});
	$('form').on('focus', 'input[type=number]', function(e) {
		$(this).on('wheel', function(e) {
			e.preventDefault();
		});
	});

	$(document).on('click', '.input-el', function(e){
		active_el = this;
	});

	$(document).on('click', '.btn-numpad', function(e){
		if(active_el == null)	return;
		var curr_val = active_el.value;
		active_el.value = curr_val+this.value;
	});

	$(document).on('click', '.btn-delete', function(e){
		var curr_val = active_el.value.toString();
		console.log(curr_val.slice(0, -1))
		active_el.value = curr_val.slice(0, -1);
	});

	$(document).on('click', '.btn-clear', function(e){
		active_el.value = '';
	});	

	$('#btn-cetak').on('click', function(e){
		$('#error-message').hide()
		e.preventDefault();
		$.ajax({
			url: "{{ url('rawatjalan/pendaftaran-online/check-in') }}",
			data: {
				'no_rm': $('#no_rm').val(),
				'kode_booking': $('#kode_booking').val()
			},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: "post",
			dataType: "json",
			beforeSend:function() {
				$('#btn-cetak').attr('disabled', true);
				$('#btn-cetak').html('Silahkan Tunggu...');
			},
			success:function(data) {
				if(data.status == 1){
					$("#modal_print").modal();
				}
				else
				{
					callSwal('warning','Mohon Maaf',data.message,'')
					$('.input-el').val("");
				}

				$('#btn-cetak').attr('disabled', false);
				$('#btn-cetak').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
			},
			error:function(data){
				this.tryCount++;
				if (this.tryCount <= this.retryLimit) {

					$.ajax(this);
					return;
				}else{
					var message = 'Terjadi kesalahan server, tidak dapat melakukan check-in. Silahkan coba lagi. Jika masih terjadi hubungi petugas IT';
					callSwal('error','Sorry',message,'')
					$('#btn-cetak').attr('disabled', false);
					$('#btn-cetak').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
				}  
			},



		});
	});

	$('#btn_print_boarding_pass').on('click', function(e){
		$('#error-message').hide()
		e.preventDefault();
		$.ajax({
			url: "{{ url('rawatjalan/pendaftaran-online/check-in') }}",
			data: {
				'no_rm': $('#no_rm').val(),
				'kode_booking': $('#kode_booking').val()
			},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: "post",
			dataType: "json",
			beforeSend:function() {
				$('#btn_print_boarding_pass').attr('disabled', true);
				$('#btn_print_boarding_pass').html('Silahkan Tunggu...');
			},
			success:function(data) {
				if(data.status == 1){
					var print_boarding_pass_url = BASE_URL + "rawatjalan/boarding-pass/print-light/"+ data.data.transaksi.id;
					
					// $(".bg-image").hide();
					// $("#boarding_pass").show();
					// window.print();
					// $(".bg-image").show();
					// $("#boarding_pass").hide();

					// popupwindow(print_boarding_pass_url, "Print Boarding Pass Pasien", 400, 1200);
					// console.log(document.domain)
					// document.domain = "http://localhost/medify/public"
					if(myWindow == null)
						myWindow = window.open(print_boarding_pass_url, '_blank', 'width=800,height=600');
					else
						myWindow.location = print_boarding_pass_url;

					myWindow.postMessage("I Feel , I feel so Special!", "http://localhost");
					myWindow.blur();
					// window.addEventListener("message", receiveMessage, false);

				}
				else
				{
					callSwal('warning','Sorry',data.message,'')
				}

				$('#btn_print_boarding_pass').attr('disabled', false);
				$('#btn_print_boarding_pass').html('<i class="fa fa-print mr-10"></i>Boarding Pass (Sudah dicetak)');
				$('#btn_print_boarding_pass').removeClass('btn-primary');
			},
			error:function(data){
				this.tryCount++;
				if (this.tryCount <= this.retryLimit) {

					$.ajax(this);
					return;
				}else{
					var message = 'Terjadi kesalahan server, tidak dapat melakukan check-in. Silahkan coba lagi. Jika masih terjadi hubungi petugas IT';
					callSwal('error','Sorry',message,'')
					$('#btn_print_boarding_pass').attr('disabled', false);
					$('#btn_print_boarding_pass').html('<i class="fa fa-print mr-10"></i>Boarding Pass (Sudah dicetak)');
					$('#btn_print_boarding_pass').removeClass('btn-primary');
				}  
			},



		});
	});

	$('#btn_print_sep').on('click', function(e){
		$('#error-message').hide()
		e.preventDefault();
		$.ajax({
			url: "{{ url('rawatjalan/pendaftaran-online/check-in') }}",
			data: {
				'no_rm': $('#no_rm').val(),
				'kode_booking': $('#kode_booking').val()
			},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: "post",
			dataType: "json",
			beforeSend:function() {
				$('#btn_print_sep').attr('disabled', true);
				$('#btn_print_sep').html('Silahkan Tunggu...');
			},
			success:function(data) {
				if(data.status == 1){
					var no_sep = data.data.transaksi.nomor_sep;
					var print_sep_url = BASE_URL + "bpjs/sep/"+ no_sep +"/print-potrait";

					if (no_sep !=null) {
						// $(".bg-image").hide();
						// $("#lembar_sep").show();
						// window.print();
						// $(".bg-image").show();
						// $("#lembar_sep").hide();
						if(myWindow == null)
							myWindow = window.open(print_sep_url, '_blank', 'width=800,height=600');
						else
							myWindow.location = print_sep_url;

						myWindow.blur();
						myWindow.postMessage("I Feel So, I feel so Special!", "http://localhost");
						// popupwindow(print_sep_url, "Print SEP Pasien", 600, 900);
					}
				}
				else
				{
					callSwal('warning','Sorry',data.message,'')
				}

				$('#btn_print_sep').attr('disabled', false);
				$('#btn_print_sep').html('<i class="fa fa-print mr-10"></i>SEP (Sudah dicetak)');
				$('#btn_print_sep').removeClass('btn-primary');
			},
			error:function(data){
				this.tryCount++;
				if (this.tryCount <= this.retryLimit) {

					$.ajax(this);
					return;
				}else{
					var message = 'Terjadi kesalahan server, tidak dapat melakukan check-in. Silahkan coba lagi. Jika masih terjadi hubungi petugas IT';
					callSwal('error','Sorry',message,'')
					$('#btn_print_sep').attr('disabled', false);
					$('#btn_print_sep').html('<i class="fa fa-print mr-10"></i>SEP (Sudah dicetak)');
					$('#btn_print_sep').removeClass('btn-primary');
				}  
			},



		});
	});

	$("#modal_print").on("hidden.bs.modal", function () {
		$('#btn_print_sep').html('<i class="fa fa-print mr-10"></i>Cetak Lembar SEP');
		$('#btn_print_sep').addClass('btn-primary');
		$('#btn_print_boarding_pass').html('<i class="fa fa-print mr-10"></i>Cetak Boarding Pass');
		$('#btn_print_boarding_pass').addClass('btn-primary');
		$('.input-el').val("");
	});
	window.addEventListener("message", receiveMessage, false);

	function receiveMessage(event) {
		console.log(event);
		console.log(myWindow)
		if(myWindow != null)
			myWindow.close()
	}
</script>
@endsection