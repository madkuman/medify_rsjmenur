@extends('igd.layouts.blank')

@section('title')
	Check In - Pendaftaran Online
@endsection

@section('css')

	<style type="text/css">
		.bg-image {display: block;}
		#boarding_pass {display: none;}
		#lembar_sep {display: none;}
		#lembar_sep_copy {display: none;}
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
				size: 300mm 300mm;

				margin: 0px;
				padding: 0px;
			}
			html, body {
				background-color: white;
				margin: 0px;
				padding: 0px;
			}
		}
		.blue{
			background-color: #000066;
		}
		.page-content {
			position: relative;
			top: 200px;
			left: -255px;
		}
		.rumkital{
			color: white;
			width: 1000px;
			text-align: center;
			background-color: #000066;
			font-size: 23px;
			font-family: sans-serif;
			padding: 8px;
		}
		.barcode{
			position: absolute;
			height: 1000px;
			left: 50px;
			top: 302px;
			z-index: 1;
		}
		table .tabel-layout-sep{
			border-collapse: collapse;
			font-size: 14px;
			line-height: 150%;
			white-space: nowrap;
		}
		.logobpjspanjang{
			position: absolute;
			top: 200px;
			left:1000px;
			z-index: 100;
		}
		.label{
			font-size: 55px;
		}
		.big{
			font-size: 70px;
			font-weight: bold;
		}
		.semibig{
			font-size: 90px;
		}
		.gap{
			padding-top: 60px;
		}
		.pl-20{
			padding-left: 60px;
		}
		#copy_sep{
			font-size: 250px;
			opacity: 0.5;
			text-align: center;
		}
	</style>
@endsection
@section('content')
	<div class="bg-image" style="background-image: url('{{asset('assets/img/bgmenur.png')}}');">
		<div class="hero-static content content-full bg-white-op-95 invisible" data-toggle="appear" data-class="animated fadeIn">

			<div class="row justify-content-center">
				<div id="modal_success" class="col-10 alert alert-primary" role="alert" style="display: none; z-index: 10; position: absolute;">
					<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<h4 class="alert-heading"><i class="fa fa-check text-primary fa-2x"></i> Pendaftaran Berhasil !</h4>
					<p>Anda telah terdaftar di Pelayanan Rawat Jalan. Silahkan menunggu di Poli yang ditujukan</p>
					<hr>
					<p class="mb-0">Lembar SEP hanya diberikan pada pasien BPJS. Apabila Anda mendaftar dengan layanan BPJS namun lembar SEP tidak tercetak silahkan hubungi petugas.</p>
				</div>
			</div>

			<!-- Avatar -->
			<div class="pt-0 pb-10 px-5 text-center">
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
							<input type="number" class="input-el form-control border-primary form-button" style="height: 50px; font-size: 2rem;" name="no_rm" id="no_rm">
						</div>
						<div class="col-12 mt-5">
							<label for="lock-password" style="font-size: 1rem">Kode Booking</label>
							<input type="text" class="input-el form-control border-primary form-button" style="height: 50px; font-size: 2rem;" name="kode_booking" id="kode_booking">
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
						<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5 form-button" value="1" style="width: 100%">
							<b style="font-size: 30px;">1</b>
						</button>
					</div>
					<div class="col-3 text-center px-5">
						<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5 form-button" value="2" style="width: 100%">
							<b style="font-size: 30px;">2</b>
						</button>
					</div>
					<div class="col-3 text-center px-5">
						<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5 form-button" value="3" style="width: 100%">
							<b style="font-size: 30px;">3</b>
						</button>
					</div>
					<div class="col-3 text-center px-5">
						<button type="button" class="btn btn-hero btn-danger mr-5 mb-5 form-button btn-delete" style="width: 100%">
							<i class="fa fa-chevron-left"></i>
						</button>
					</div>
					<div class="col-3 text-center px-5">
						<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5 form-button" value="4" style="width: 100%">
							<b style="font-size: 30px;">4</b>
						</button>
					</div>
					<div class="col-3 text-center px-5">
						<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5 form-button" value="5" style="width: 100%">
							<b style="font-size: 30px;">5</b>
						</button>
					</div>
					<div class="col-3 text-center px-5">
						<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5 form-button" value="6" style="width: 100%">
							<b style="font-size: 30px;">6</b>
						</button>
					</div>
					<div class="col-3 text-center px-5">
						<button type="button" class="btn btn-hero btn-danger mr-5 mb-5 form-button btn-clear" style="width: 100%">
							CLEAR
						</button>
					</div>
					<div class="col-3 text-center px-5">
						<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5 form-button" value="7" style="width: 100%">
							<b style="font-size: 30px;">7</b>
						</button>
					</div>
					<div class="col-3 text-center px-5">
						<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5 form-button" value="8" style="width: 100%">
							<b style="font-size: 30px;">8</b>
						</button>
					</div>
					<div class="col-3 text-center px-5">
						<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5 form-button" value="9" style="width: 100%">
							<b style="font-size: 30px;">9</b>
						</button>
					</div>
					<div class="col-3 text-center">
					</div>
					<div class="col-3 text-center">
					</div>
					<div class="col-3 text-center px-5">
						<button type="button" class="btn btn-numpad btn-hero btn-info mr-5 mb-5 form-button" value="0" style="width: 100%">
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
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END Page Container -->

	<div id="boarding_pass" class="hide">
		<div class="rumkital" style="font-size: 100px; border-bottom: 7px solid black !important">
			BOARDING PASS
		</div>
		<div class="barcode ">
			<img class="boarding-pass-barcode" src="" alt="barcode" style="width: 900px;">
		</div>
		<div class="page-content" style="transform: rotate(90deg); margin-top: 500px; margin-right: -500px;">
			<table style="width: 3000px;">
				<tr>
					<!-- <td width="5%" class="part blue" style=""></td> -->
					<td width="60%" class="part">
						<table style="margin-top: 15px;">
							<tr>
								<td class="pl-20" width="5%">
									<img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="150">
								</td>
								<td width="80%" class="title text-uppercase boarding-pass-title" style="font-size: 100px; font-weight: bold">
									FAKE
								</td>
							</tr>
						</table>
						<br>
						<table style="width: 100%">
							<tr>
								<td class="pl-20 label" width="50%">NAMA PASIEN</td>
								<td class="label" width="50%">JENIS KELAMIN / USIA</td>
							</tr>
							<tr>
								<td class="pl-20 big boarding-pass-name" width="50%">FAKE</td>
								<td class="big boarding-pass-age" width="50%">FAKE</td>
							</tr>
						</table>
						<br>
						<table style="width: 100%">
							<tr>
								<td class="pl-20 label" width="50%">NO RM</td>
								<td class="label" width="50%">TTL</td>
							</tr>
							<tr>
								<td class="pl-20 big boarding-pass-rm" width="50%">FAKE</td>
								<td class="big boarding-pass-birthdate" width="50%">FAKE</td>
							</tr>
						</table>
						<br>
						<table style="width: 100%">
							<tr>
								<td class="pl-20 label" width="50%">JENIS PEMBAYARAN</td>
								<td class="label" width="50%">NOMOR ANTRIAN</td>
							</tr>
							<tr>
								<td class="pl-20 big boarding-pass-jenis-pembayaran" width="50%">FAKE</td>
								<td class="big boarding-pass-estimasi-pelayanan" width="50%">FAKE</td>
							</tr>
						</table>
						<table style="width: 100%">
							<tr>
								<td class="pl-20 label" width="50%">ESTIMASI WAKTU</td>
								<td class="label" width="50%"></td>
							</tr>
							<tr>
								<td class="pl-20 big boarding-pass-estimasi-waktu" width="50%">FAKE</td>
								<td class="big" width="50%"></td>
							</tr>
						</table>
					</td>
					<td width="35%" class="part grey">
						<table style="margin-left: 500px;">
							<tr>
								<td class="pl-20 semibig">TUJUAN SELANJUTNYA</td>
							</tr>
						</table>
						<br>
						<table style="margin-left: 500px;">
							<tr>
								<td class="pl-20 label" width="60%">TUJUAN</td>
								<td class="label" width="40%">TANGGAL</td>
							</tr>
							<tr>
								<td class="pl-20 gap">_________________________________________________________________</td>
								<td class="gap">______________________________________________________________</td>
							</tr>
						</table>
						<br>
						<table style="margin-left: 500px;">
							<tr>
								<td class="pl-20 label" width="60%">TUJUAN</td>
								<td class="label" width="40%">TANGGAL</td>
							</tr>
							<tr>
								<td class="pl-20 gap">_________________________________________________________________</td>
								<td class="gap">______________________________________________________________</td>
							</tr>
						</table>
						<br>
						<table style="margin-left: 500px;">
							<tr>
								<td class="pl-20 label" width="60%">TUJUAN</td>
								<td class="label" width="40%">TANGGAL</td>
							</tr>
							<tr>
								<td class="pl-20 gap">_________________________________________________________________</td>
								<td class="gap">______________________________________________________________</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<div id="lembar_sep" class="hide" style="font-size: 20px;">
		<div class="rumkital" style="font-size: 100px; border-bottom: 7px solid black !important">
			SEP - BPJS
		</div>
		<div class="logobpjspanjang">
			<img src="{{asset('assets/img/logobpjstinggi.png')}}" style="height: 800px;">
		</div>
		<div class="page-content" style="transform: rotate(90deg); margin-top: 500px; margin-right: -500px;">
			<table style="width: 3000px;">
				<tr>
					<td colspan="4" style="font-size: 70px; text-align: center;">SURAT ELEGIBILITAS PESERTA</td>
				</tr>
				<tr>
					<td colspan="4" style="font-size: 70px; text-align: center;">RSJ MENUR SURABAYA</td>
				</tr>
				<tr>
					<td class="label" width="20%">No.SEP</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-no-sep">: FAKE</td>
					<td class="label" width="19%">Jenis BPJS</td>
					<td class="label" width="1%">:</td>
					<td width="20%" class="label sep-jenis-bpjs">: FAKE</td>
				</tr>
				<tr>
					<td class="label" width="20%">Tgl.SEP</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-tanggal-sep">: FAKE</td>
					<td class="label" width="19%">Jenis Rawat</td>
					<td class="label" width="1%">:</td>
					<td width="20%" class="label sep-jenis-rawat">: FAKE</td>
				</tr>
				<tr>
					<td class="label" width="20%">No.Kartu</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-no-kartu">: FAKE</td>
					<td class="label" width="19%">Kelas Rawat</td>
					<td class="label" width="1%">:</td>
					<td width="20%" class="label sep-kelas-rawat">: FAKE</td>
				</tr>
				<tr>
					<td class="label" width="20%">Nama Peserta</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-name">: FAKE</td>
					<td class="label" width="19%"></td>
					<td class="label" width="1%">:</td>
					<td class="label" width="20%"></td>
				</tr>
				<tr>
					<td class="label" width="20%">Tgl.Lahir</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-birthdate">: FAKE</td>
					<td colspan="3" style="font-size: 40px;">*SEP bukan sebagai bukti penjamin peserta</td>
				</tr>
				<tr>
					<td class="label" width="20%">Jenis Kelamin</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-sex">: FAKE</td>
					<td class="label" width="19%"></td>
					<td class="label" width="1%"></td>
					<td class="label" width="20%"></td>
				</tr>
				<tr>
					<td class="label" width="20%">Poli Tujuan</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-poli-tujuan">: FAKE</td>
					<td class="label" width="19%"></td>
					<td class="label" width="1%"></td>
					<td class="label" width="20%"></td>
				</tr>
				<tr>
					<td class="label" width="20%">Diagnosa Awal</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-diagnosa">: FAKE</td>
					<td class="label" width="19%"></td>
					<td class="label" width="1%"></td>
					<td class="label" width="20%"></td>
				</tr>
				<tr>
					<td class="label" width="20%">Catatan</td>
					<td class="label" width="1%">:</td>
					<td class="label" width="39%">-</td>
					<td class="label" width="19%"></td>
					<td class="label" width="1%"></td>
					<td class="label" width="20%"></td>
				</tr>
			</table>
		</div>
	</div>

	<div id="lembar_sep_copy" class="hide" style="font-size: 20px;">
		<div class="rumkital" style="font-size: 100px; border-bottom: 7px solid black !important">
			SEP - BPJS
		</div>
		<div class="logobpjspanjang">
			<img src="{{asset('assets/img/logobpjstinggi.png')}}" style="height: 800px;">
		</div>
		<div class="page-content" style="transform: rotate(90deg); margin-top: 500px; margin-right: -500px;">
			<table style="width: 3000px;">
				<tr>
					<td colspan="4" style="font-size: 70px; text-align: center;">SURAT ELEGIBILITAS PESERTA</td>
					<td colspan="2" rowspan="2" style="border: 10px solid black; font-size: 90px; font-weight: bold; text-align: center;">C O P Y</td>
				</tr>
				<tr>
					<td colspan="4" style="font-size: 70px; text-align: center;">RSJ MENUR SURABAYA</td>
				</tr>
				<tr>
					<td class="label" width="20%">No.SEP</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-no-sep">: 1301R0100819V013931</td>
					<td class="label" width="19%">Jenis BPJS</td>
					<td class="label" width="1%">:</td>
					<td width="20%" class="label sep-jenis-bpjs">: MANDIRI</td>
				</tr>
				<tr>
					<td class="label" width="20%">Tgl.SEP</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-tanggal-sep">: 1301R0100819V013931</td>
					<td class="label" width="19%">Jenis Rawat</td>
					<td class="label" width="1%">:</td>
					<td width="20%" class="label sep-jenis-rawat">: MANDIRI</td>
				</tr>
				<tr>
					<td class="label" width="20%">No.Kartu</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-no-kartu">: 1301R0100819V013931</td>
					<td class="label" width="19%">Kelas Rawat</td>
					<td class="label" width="1%">:</td>
					<td width="20%" class="label sep-kelas-rawat">: MANDIRI</td>
				</tr>
				<tr>
					<td class="label" width="20%">Nama Peserta</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-name">: 1301R0100819V013931</td>
					<td class="label" width="19%"></td>
					<td class="label" width="1%">:</td>
					<td class="label" width="20%"></td>
				</tr>
				<tr>
					<td class="label" width="20%">Tgl.Lahir</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-birthdate">: 1301R0100819V013931</td>
					<td colspan="3" style="font-size: 40px;">*SEP bukan sebagai bukti penjamin peserta</td>
				</tr>
				<tr>
					<td class="label" width="20%">Jenis Kelamin</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-sex">: 1301R0100819V013931</td>
					<td class="label" width="19%"></td>
					<td class="label" width="1%"></td>
					<td class="label" width="20%"></td>
				</tr>
				<tr>
					<td class="label" width="20%">Poli Tujuan</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-poli-tujuan">: 1301R0100819V013931</td>
					<td class="label" width="19%"></td>
					<td class="label" width="1%"></td>
					<td class="label" width="20%"></td>
				</tr>
				<tr>
					<td class="label" width="20%">Diagnosa Awal</td>
					<td class="label" width="1%">:</td>
					<td width="39%" class="label sep-diagnosa">: 1301R0100819V013931</td>
					<td class="label" width="19%"></td>
					<td class="label" width="1%"></td>
					<td class="label" width="20%"></td>
				</tr>
				<tr>
					<td class="label" width="20%">Catatan</td>
					<td class="label" width="1%">:</td>
					<td class="label" width="39%">-</td>
					<td class="label" width="19%"></td>
					<td class="label" width="1%"></td>
					<td class="label" width="20%"></td>
				</tr>
			</table>
		</div>
	</div>
@endsection

<!-- Codebase Core JS -->
@section('js')
	<script type="text/javascript">
		var active_el = null;
		var myWindow = null;
		var is_bpjs = 0;
		var count_print = 0;
		var no_sep_transaksi = null;
		var is_paid = false;
		var is_perusahaan_lain_type = false;

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
			active_el.value = curr_val.slice(0, -1);
		});

		$(document).on('click', '.btn-clear', function(e){
			active_el.value = '';
		});

		function checkPembayaran(data) {
			is_paid = false;
			is_bpjs = 0;
			no_sep_transaksi = null;
			is_perusahaan_lain_type = false;
			if (data.data.transaksi.nomor_sep) {
				is_bpjs = 1;
				no_sep_transaksi = data.data.transaksi.nomor_sep;
				is_paid =true
				seedPrintData(data, no_sep_transaksi);
			} else {
				pembayaran_type = data.data.transaksi.pasien_pembayaran.perusahaan.tipe.slug ?? 'lain';
				// console.log('pembayaran tipe', pembayaran_type);
				// Jika Pembayaran tipe BPJS maka auto create SEP
				// Jika Pembayaran tipe Tunai maka cek piutang
				if (pembayaran_type == 'bpjs') {
					is_paid = true;
					is_bpjs = 1;
					transaksi_id = data.data.transaksi.id;

					$.ajax({
						url: BASE_URL + "rawatjalan/pendaftaran-online/generate/auto-sep/" + transaksi_id,
						type: "get",
						dataType: "json",
						contentType: false,
						success:function(resp) {
							if(resp.status == 200) {
								no_sep_transaksi = resp.result.response.sep.noSep ?? null;
								seedPrintData(data, no_sep_transaksi);
								// console.log('2', data);
								// console.log('3', no_sep_transaksi);
							}else{
								donePrint()
							}
						},
						error:function(err){
							donePrint()
						},
					});
				} else if (pembayaran_type == 'tunai') {

					if(data.data.transaksi.piutang_id == null) editStatusTransaksi(data);
					else getPiutang(data, data.data.transaksi.piutang_id);
					
				} else {
					is_perusahaan_lain_type = true;
					if (data.data.transaksi.status == 0) {
						is_paid = true;
						seedPrintData(data, no_sep_transaksi);
					}else{
						donePrint();
					}
				}
			}
		}

		function editStatusTransaksi(data)
		{
			is_paid = true;
			$.ajax({
				type:'GET',
				url: BASE_URL + "rawatjalan/pendaftaran-online/edit/status/"+data.data.transaksi.id+"/0"
			});
			donePrint();
		}

		function getPiutang(data, piutang_id) {
			$.ajax({
				type:'GET',
				url: API_URL + '/keuangan/piutang/tunai/status/'+piutang_id,
				dataType: 'json',
				success:function(response){
					if (response.status == 1) {
						is_paid = true;
						$.ajax({
							type:'GET',
							url: BASE_URL + "rawatjalan/pendaftaran-online/edit/status/"+data.data.transaksi.id+"/0"
						});
						seedPrintData(data, no_sep_transaksi);
					} else {
						donePrint();
					}
				},
				error:function(error){
					console.log('error_getPiutang : ', error);
				}
			});
		}

		function getSep(pasien_id) {
			nomor_sep_pasien = null;
			$.ajax({
				type:'GET',
				url:BASE_URL + 'bpjs/sep/search-pasien/'+pasien_id,
				dataType: 'json',
				success:function(data){
					var rest = JSON.stringify(data[0]);
					nomor_sep_pasien = rest.no_sep;
				},
				error:function(error){
					console.log('error_getSep : ', error);
				}
			});
			return nomor_sep_pasien;
		}

		function seedPrintData(data, nomor_sep) {
			if (is_bpjs == 1 && nomor_sep != null) {
				$.ajax({
					type:'GET',
					url: BASE_URL + "rawatjalan/pendaftaran-online/edit/status/"+data.data.transaksi.id+"/0"
				});
			}

			$.ajax({
				url: API_URL + "/bpjs/sep/search/"+ nomor_sep,
				type: "get",
				dataType: "json",
				success:function(sep_data) {
					// console.log('data', data);
					// console.log('sep_data', sep_data);
					var jk = (data.data.transaksi.pasien.gender == 2) ? 'Perempuan' : 'Laki-laki';

					// generate boarding pass
					$('.boarding-pass-barcode').html(data.data.barcode);
					$('.boarding-pass-title').html("Poli "+data.data.transaksi.poliklinik.name);
					$('.boarding-pass-name').html(data.data.transaksi.pasien.name);
					$('.boarding-pass-age').html(jk+", "+data.data.transaksi.pasien.detailed_age_short);
					$('.boarding-pass-rm').html(data.data.transaksi.pasien.no_rm);
					$('.boarding-pass-birthdate').html(data.data.transaksi.pasien.place_of_birth+", "+data.data.transaksi.pasien.date_of_birth);
					$('.boarding-pass-jenis-pembayaran').html(data.data.transaksi.pasien_pembayaran.perusahaan.nama);
					$('.boarding-pass-estimasi-pelayanan').html(data.data.transaksi.nomor_antrian);
					$('.boarding-pass-estimasi-waktu').html(formatDate(data.data.transaksi.ordered_at));

					// generate lembar SEP
					if(sep_data.response != null && nomor_sep != null){
						$('.sep-no-sep').empty();
						$('.sep-no-sep').append(sep_data.response.noSep);
						$('.sep-tanggal-sep').empty();
						$('.sep-tanggal-sep').append(sep_data.response.tglSep);
						$('.sep-no-kartu').empty();
						$('.sep-no-kartu').append(sep_data.response.peserta.noKartu);
						$('.sep-name').empty();
						$('.sep-name').append(sep_data.response.peserta.nama);
						$('.sep-birthdate').empty();
						$('.sep-birthdate').append(sep_data.response.peserta.tglLahir);
						$('.sep-sex').empty();
						$('.sep-sex').append(sep_data.response.peserta.kelamin);
						$('.sep-poli-tujuan').empty();
						$('.sep-poli-tujuan').append(sep_data.response.poli);
						$('.sep-diagnosa').empty();
						$('.sep-diagnosa').append(sep_data.response.diagnosa);
						$('.sep-jenis-bpjs').empty();
						$('.sep-jenis-bpjs').append(sep_data.response.peserta.jnsPeserta);
						$('.sep-jenis-rawat').empty();
						$('.sep-jenis-rawat').append(sep_data.response.jnsPelayanan);
						$('.sep-kelas-rawat').empty();
						$('.sep-kelas-rawat').append(sep_data.response.kelasRawat);
					}

					printBoardingPass();
				},
				error:function(data){
					this.tryCount++;
					if (this.tryCount <= this.retryLimit) {

						$.ajax(this);
						return;
					}else{
						var message = 'Terjadi kesalahan server, tidak dapat melakukan check-in. Silahkan coba lagi. Jika masih terjadi hubungi petugas IT';
						callSwal('error','Sorry',message,'')
						$('.form-button').attr('disabled', false);
						$('#btn-cetak').attr('disabled', false);
						$('#btn-cetak').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
					}
				},
			});
		}

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
					$('.form-button').attr('disabled', true);
					$('#btn-cetak').attr('disabled', true);
					$('#btn-cetak').html('<i class="fa fa-spinner fa-spin fa-2x"></i> &nbsp;&nbsp;&nbsp; Silahkan Tunggu ...');
				},
				success:function(data) {
					if(data.status == 1){
						count_print = 0;
						checkPembayaran(data)
						// console.log('1', data);
					}
					else
					{
						callSwal('warning','Mohon Maaf',data.message,'')
						$('.input-el').val("");
						$('.form-button').attr('disabled', false);
						$('#btn-cetak').attr('disabled', false);
						$('#btn-cetak').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
					}
				},
				error:function(data){
					this.tryCount++;
					if (this.tryCount <= this.retryLimit) {

						$.ajax(this);
						return;
					}else{
						var message = 'Terjadi kesalahan server, tidak dapat melakukan check-in. Silahkan coba lagi. Jika masih tjadi hubungi petugas IT';
						callSwal('error','Sorry',message,'')
						$('.form-button').attr('disabled', false);
						$('#btn-cetak').attr('disabled', false);
						$('#btn-cetak').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
					}
				},



			});
		});

		function donePrint()
		{
			$('.input-el').val("");
			$('.form-button').attr('disabled', false);
			$('#btn-cetak').attr('disabled', false);
			$('#btn-cetak').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
			if (is_bpjs == 1 && no_sep_transaksi == null) {
				swal({
					type: 'error',
					title: 'SEP Gagal Dicetak',
					html: 'Silahkan datang ke loket Bantuan BPJS, untuk mencetak boarding pass dan SEP Anda',
					timer: 10000,
				})
			} else {
				if (is_paid) {
					callSwal('success','Selesai','Anda Berhasil Check In, silahkan datang ke poli tujuan','')
				} else if (is_perusahaan_lain_type) {
					swal({
						type: 'warning',
						title: 'Data Booking Belum Terkonfirmasi',
						html: 'Silahkan Konfirmasi di Loket Kerjasama Terlebih Dahulu',
						timer: 10000,
					});
				} else {
					swal({
						type: 'warning',
						title: 'Biaya registrasi belum terbayar',
						html: 'Silahkan bayar terlebih dahulu dikasir dengan menginformasikan NO RM Pasien',
						timer: 10000,
					});
				}
				no_sep_transaksi = null;
				is_paid = false;
				is_perusahaan_lain_type = false;
			}
		}


		window.onafterprint = function(){
			setTimeout(function(){
				if(is_bpjs == 1 && no_sep_transaksi != null){
					if(count_print == 1) printSEP()
					else if(count_print == 2) printSEPCopy()
					else if(count_print == 3) printSEPCopy()
					else donePrint()
				}
				else{
					donePrint()
				}
			}, 3000);
		}
		function printBoardingPass(){
			$(".bg-image").hide();
			$("#boarding_pass").show();
			window.print();
			$(".bg-image").show();
			$("#boarding_pass").hide();
			count_print++;
		}

		$('#btn_print_sep').on('click', function(e){
			printSEP()
		});

		function printSEP(){
			$(".bg-image").hide();
			$("#lembar_sep").show();
			window.print();
			$(".bg-image").show();
			$("#lembar_sep").hide();
			count_print++;
		}

		function printSEPCopy(){
			$(".bg-image").hide();
			$("#lembar_sep_copy").show();
			window.print();
			$(".bg-image").show();
			$("#lembar_sep_copy").hide();
			count_print++;
		}

		$("#modal_print").on("hidden.bs.modal", function () {
			$('#btn_print_sep').html('<i class="fa fa-print mr-10"></i>Cetak Lembar SEP');
			$('#btn_print_sep').addClass('btn-primary');
			$('#btn_print_boarding_pass').html('<i class="fa fa-print mr-10"></i>Cetak Boarding Pass');
			$('#btn_print_boarding_pass').addClass('btn-primary');
		});

		function formatDate(input) {
			// let date = new Date(tmt),
			// 		hh = date.getHours(),
			// 		mm = date.getMinutes();

			// if(hh < 10) hh = "0" + hh;
			// if(mm < 10) mm = "0" + mm;
			// return hh + ':' + mm;

			if (input === null) {
				return null;
			} else {
				var datePart = input.match(/\d+/g),
				year = datePart[0],
				month = datePart[1], day = datePart[2];
				var time = datePart[3];
				var minute = datePart[4];

				return time+":"+minute;
			}
		}
	</script>
@endsection