<style type="text/css">
	.label{
		font-size: 40px;
		padding-bottom: 40px;
	}
	.big{
		font-size: 40px;
	}
	.semibig{
		font-size: 80px;
		/*font-weight: bold;*/
	}
	.gap{
		border-bottom: 1px dashed black;
	}
	.big_barcode{
		margin-top: -1300px;
		margin-left: 0px;
		/*width: 900px !important;*/
	}
</style>
<div id="boarding_pass_antrian" class="d-none" style="width: 80mm">
	<div class="page-content" style="margin-top: 0px; margin-right: -630px;">
		<div>
			<table width="100%" style="margin-bottom: 75px;">
				<tr>
					<td style="font-size: 82px; text-align: center;">Tiket Antrian</td>
				</tr>
			</table>
			<table width="100%" style="margin-bottom: 75px;">
				<tr>
					<td style="font-size: 76px; text-align: center;">RSJ MENUR SURABAYA</td>
				</tr>
			</table>
			<table width="100%" style="margin-bottom: 75px;">
				<tr>
					<td style="font-size: 78px; text-align: center;font-weight: bold" id="boarding_poliklinik">Poliklinik</td>
				</tr>
			</table>
		</div>
		<div>
			<table style="width: 100%; margin-bottom: 75px;">
				<tr>
					<td style="font-size: 110px; text-align: center;" id="boarding_antrian">#12</td>
				</tr>
			</table>
		</div>
		<div>
			<table style="width: 100%; margin-bottom: 75px;">
				<tr>
					<td style="font-size: 85px; text-align: center;" id="boarding_loket">Loket 1</td>
				</tr>
			</table>
		</div>
		<div>
			<table style="width: 100%; text-align: center; margin-bottom: 75px;">
				<tr>
					<td style="font-size: 72px; vertical-align: middle;" id="boarding_pasien">Nama Pasien</td>
				</tr>
			</table>
			<table style="width: 100%; text-align: center; margin-bottom: 75px">
				<tr>
					<td style="font-size: 72px; vertical-align: middle;" id="boarding_dokter">Nama Dokter</td>
				</tr>
			</table>
		</div>
	</div>
</div>

<div id="boarding_pass" class="hide">
	<div class="rumkital" style="font-size: 125px; border-bottom: 7px solid black !important">
		BOARDING PASS
	</div>
	<div class="barcode ">
		<div class="boarding-pass-barcode"><img class="big_barcode" src="data:image/png;base64,{{$barcode_dummy}}" alt="" style="width:900px;"></div>
	</div>
	<div class="page-content" style="transform: rotate(90deg); margin-top: 1000px; margin-right: -700px;">
		<table style="width: 3000px;">
			<tr>
				<!-- <td width="5%" class="part blue" style=""></td> -->
				<td style="width: 2000px;" class="part">
					<table style="margin-top: 15px;">
						<tr>
							<td class="pl-20" width="5%">
								<img src="{{asset('assets/img/rumkital.png')}}" height="150">
							</td>
							<td width="80%" class="title text-uppercase boarding-pass-title" style="font-size: 100px; font-weight: bold; font-family: sans-serif;">
								POLI BEDAH ORTHOLOGI
							</td>
						</tr>
					</table>
					<br>
					<table style="width: 100%; margin-top: 40px;">
						<tr>
							<td class="pl-20 label" width="50%">NAMA PASIEN</td>
							<td class="label" width="50%">JENIS KELAMIN / USIA</td>
						</tr>
						<tr>
							<td class="pl-20 big boarding-pass-name" style="white-space: nowrap;" width="50%">FAKE</td>
							<td class="big boarding-pass-age" width="50%">FAKE</td>
						</tr>
					</table>
					<table style="width: 100%; margin-top: 60px;">
						<tr>
							<td class="pl-20 label" width="50%">NO RM</td>
							<td class="label" width="50%">TTL</td>
						</tr>
						<tr>
							<td class="pl-20 big boarding-pass-rm" style="vertical-align: top;" width="50%">FAKE</td>
							<td class="big boarding-pass-birthdate" style="line-height: 100%;" width="50%">HUMBANGHASUNDUTAN</td>
						</tr>
					</table>
					<table style="width: 100%; margin-top: 60px;">
						<tr>
							<td class="pl-20 label" width="50%">JENIS PEMBAYARAN</td>
							<td class="label" width="50%">NOMOR ANTRIAN</td>
						</tr>
						<tr>
							<td class="pl-20 big boarding-pass-jenis-pembayaran" width="50%">FAKE</td>
							<td class="big boarding-pass-estimasi-pelayanan" width="50%">FAKE</td>
						</tr>
					</table>
					<table style="width: 100%; margin-top: 60px;">
						<tr>
							<td class="pl-20 label" width="50%">ESTIMASI WAKTU</td>
							<td class="label" width="50%">TANGGAL CHECKIN</td>
						</tr>
						<tr>
							<td class="pl-20 big boarding-pass-estimasi-waktu" width="50%">FAKE</td>
							<td class="big boarding-pass-tanggal-checkin" width="50%">FAKE</td>
						</tr>
					</table>
					<table style="width: 100%; margin-top: 60px;" class="d-none" id="info-sep-boarding">
						<tr>
							<td class="pl-20 label" width="50%">NO SEP :</td>
							<td class="label" width="50%">TANGGAL SEP :</td>
						</tr>
						<tr>
							<td class="pl-20 big boarding-pass-no-sep" width="50%">FAKE</td>
							<td class="big boarding-pass-tanggal-sep" width="50%">FAKE</td>
						</tr>
					</table>
				</td>
				<td style="width: 1000px;" class="part grey">
					<table style="margin-top: 250px; margin-bottom: 50px;">
						<tr>
							<td class="pl-20 semibig">TUJUAN SELANJUTNYA</td>
						</tr>
					</table>
					<br>
					<table width="100%">
						<tr>
							<td class="pl-20 label" width="60%">TUJUAN</td>
							<td class="label" width="40%">TANGGAL</td>
						</tr>
						<tr>
							<td class="pl-20 gap"></td>
							<td class="gap"></td>
						</tr>
					</table>
					<br>
					<table width="100%">
						<tr>
							<td class="pl-20 label" width="60%">TUJUAN</td>
							<td class="label" width="40%">TANGGAL</td>
						</tr>
						<tr>
							<td class="pl-20 gap"></td>
							<td class="gap"></td>
						</tr>
					</table>
					<br>
					<table width="100%">
						<tr>
							<td class="pl-20 label" width="60%">TUJUAN</td>
							<td class="label" width="40%">TANGGAL</td>
						</tr>
						<tr>
							<td class="pl-20 gap"></td>
							<td class="gap"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</div>

<div id="lembar_sep" class="hide" style="font-size: 20px;">
	<div class="RSPAL" style="font-size: 85px; border-bottom: 7px solid black !important; text-align: center;">
		SEP - BPJS
	</div>
	<div class="logobpjspanjang" style="position: absolute; top: 180px; left: 860px">
		<img src="{{asset('assets/img/logobpjstinggi.png')}}" style="height: 700px;">
	</div>
	<div class="page-content" style="transform: rotate(90deg); margin-top: 450px; margin-right: -650px;">
		<table style="width: 3000px;">
			<tr>
				<td style="font-size: 55px; text-align: center;">SURAT ELEGIBILITAS PESERTA</td>
			</tr>
		</table>
		<table style="width: 3000px; margin-top: 50px;">
			<tr>
				<td style="font-size: 55px; text-align: center;">RSJ MENUR SURABAYA</td>
			</tr>
		</table>
		<table style="width: 3000px; margin-top: 50px;">
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
	<div class="RSPAL" style="font-size: 85px; border-bottom: 7px solid black !important; text-align: center;">
		SEP - BPJS
	</div>
	<div class="logobpjspanjang" style="position: absolute; top: 180px; left: 860px">
		<img src="{{asset('assets/img/logobpjstinggi.png')}}" style="height: 700px;">
	</div>
	<div class="page-content" style="transform: rotate(90deg); margin-top: 500px; margin-right: -650px;">
		<table style="width: 3000px;">
			<tr>
				<td colspan="4" style="font-size: 70px; text-align: center; line-height: 80px;">SURAT ELEGIBILITAS PESERTA</td>
				<td colspan="2" rowspan="2" style="border: 10px solid black; font-size: 90px; font-weight: bold; text-align: center;">C O P Y</td>
			</tr>
			<tr>
				<td colspan="4" style="font-size: 70px; text-align: center; line-height: 80px;">RSJ MENUR SURABAYA</td>
			</tr>
			<tr>
				<td style="padding-top: 50px;" class="label" width="20%">No.SEP</td>
				<td style="padding-top: 50px;" class="label" width="1%">:</td>
				<td style="padding-top: 50px;" width="39%" class="label sep-no-sep">: 1301R0100819V013931</td>
				<td style="padding-top: 50px;" class="label" width="19%">Jenis BPJS</td>
				<td style="padding-top: 50px;" class="label" width="1%">:</td>
				<td style="padding-top: 50px;" width="20%" class="label sep-jenis-bpjs">: MANDIRI</td>
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
				<td colspan="3" style="font-size: 60px;">*SEP bukan sebagai bukti penjamin peserta</td>
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