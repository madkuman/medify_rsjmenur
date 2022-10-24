<!DOCTYPE html>
<html>
<head>
	<title>Laporan Psikogram Pemeriksaan Psikologi</title>
	<style type="text/css">
		{{--@page {
			margin-top: 1.0cm;
			margin-bottom: 0.0cm;
		}--}}
		h1,h2,h3,h4,h5,h6
		{
			margin:2px;
		}
		.text-center
		{
			text-align: center;
		}
		.text-uppercase
		{
			text-transform: uppercase;
		}
		.text-bold
		{
			font-weight: 700;
		}

		p {
			font-family: "Arial";
			font-size: 16px;
			margin: 0;
		}
		.text-size-14
		{
			font-size: 14px;
		}
		small
		{
			font-size: 60%;
			letter-spacing: 1px;
		}
		.text-capitalize
		{
			text-transform: capitalize;
		}
		.text-uppercase
		{
			text-transform: uppercase;
		}

		body, p {
			font-size: 12px;
			font-family: Arial, Helvetica, sans-serif;
			/*line-height: 16px;*/
		}

		table.bordered {
			border-collapse: collapse;
		}
		table.bordered, .bordered th, .bordered td {
			border: 1px solid black;
		}
		.centered td{
			text-align: center;
		}
		.rotate{
			transform: rotate(-90.0deg);
		}
		.gede td{
			height: 400px !important; 
		}
		.grey{
			background-color: gainsboro;
		}
		.word-break {
	        word-wrap: break-word;width:100%;
	    }
	    .footer {
	        width: 100%;
	        text-align: right;
	        position: fixed;
	        bottom: 0px;
	    }
	    .pagenum:before {
	        content: counter(page);
	    }
	</style>
</head>
<body>
	@php 
	$checked = '<div style="font-family: ZapfDingbats, sans-serif; display: inline;">4</div>';
	@endphp

	{{-- <div class="footer">
        Laporan Psikogram Pemeriksaan Psikologi - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$laporan_psikogram_pemeriksaan_psikologi->id.'}'}} | Halaman <span class="pagenum"></span> of 2
    </div> --}}

	<table width="100%" align="center" style="border-bottom: 5px double #000;">
		<tr>
			<td width="100%" valign="top">
				<table width="100%" cellpadding="5">
					<tr>
						<td width="20%" align="right">
							<img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="80">
						</td>
						<td width="60%" align="center">
							<p style="font-size: 14px;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
							<p style="font-size: 22px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
							<p style="font-size: 10px;">Jln. Menur No. 120, Telp. (031) 5021635, 5021637</p>
						</td>
						<td width="20%" align="left">
							<img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="80">
						</td>
					</tr> 
				</table>
			</td>
		</tr>
	</table>

	<table width="100%" cellpadding="5" style="margin-top: 5px;">
		<tr>
			<td width="90%"></td>
			<td width="15%" align="center" bgcolor="#000" style="border: 3px solid #d9d9d9;">
				<p style="font-size: 14px; color: #fff;"><b>rahasia</b></p>
			</td>
		</tr>
	</table>

	<table width="100%" style="margin-top: 5px;">
		<tr>
			<td align="center"><p style="font-size: 16"><b><u>LAPORAN HASIL PEMERIKSAAN PSIKOLOGI</u></b></p></td>
		</tr>
	</table>

	<table width="100%" style="margin-top: 10px;">
		<tr>
			<td width="25%">Tujuan Tes</td>
			<td width="3%">:</td>
			<td width="72%">{{ $laporan_psikogram_pemeriksaan_psikologi->tujuan_pemeriksaan ?? '-' }}</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td>{{ $kasus->identitas->nama ?? "-" }}</td>
		</tr>
		<tr>
			<td>No. RM</td>
			<td>:</td>
			<td>{{ $kasus->pasien->no_rm ?? "-" }}</td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td>:</td>
			<td>{{ $kasus->identitas->jenis_kelamin == 'L' ? "Laki-laki" : "Perempuan" }}</td>
		</tr>
		<tr>
			<td>Usia</td>
			<td>:</td>
			<td>{{ $kasus->identitas->umur ?? '-' }}</td>
		</tr>
		<tr>
			<td>Status</td>
			<td>:</td>
			<td>
				@if($kasus->pasien->marriage == 1 ) Single
				@elseif($kasus->pasien->marriage == 2 ) Menikah
				@elseif($kasus->pasien->marriage == 3 ) Duda/Janda
				@else -
				@endif
			</td>
		</tr>
		<tr>
			<td>Pendidikan</td>
			<td>:</td>
			<td>{{ $kasus->pasien->pendidikan->nama ?? '-' }}</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td>{{ $kasus->identitas->alamat ?? '-' }}</td>
		</tr>
		<tr>
			<td>Rujukan dari</td>
			<td>:</td>
			<td>{{$laporan_psikogram_pemeriksaan_psikologi->rujukan_dari ?? '-'}}</td>
		</tr>
	</table>

	<table width="100%" style="margin-top: 20px;">
		<tr>
			<td><p>Berdasarkan pemeriksaan yang telah dilakukan pada hari {{ trim(indonesian_date($laporan_psikogram_pemeriksaan_psikologi->tanggal_pemeriksaan, 'l')) }}, tanggal {{ trim(indonesian_date($laporan_psikogram_pemeriksaan_psikologi->tanggal_pemeriksaan)) }}, maka dapat diketahui <b>bahwa pada saat ini:</b></p></td>
		</tr>
	</table>

	<table width="100%" class="bordered centered" cellpadding="3" style="margin-top: 5px;">
		<tr>
			<td colspan="10">Kemampuan Intelektual Berfungsi pada Taraf : <b>{{$laporan_psikogram_pemeriksaan_psikologi->kemampuan_intelektual_berfungsi_pada_taraf ?? '-'}}</b></td>
		</tr>
		<tr class="grey">
			<td colspan="2">Aspek Psikologis</td>
			<td>Gambaran Individu<br>(Skor Rendah)</td>
			<td>SR</td>
			<td>R</td>
			<td>HC</td>
			<td>C</td>
			<td>T</td>
			<td>ST</td>
			<td>Gambaran Individu<br>(Skor Tinggi)</td>
		</tr>
		<tr>
			<td width="5%" text-rotate="90" class="grey">Intelegensi</td>
			<td width="15%">Kecerdasan Umum</td>
			<td width="25%" style="text-align: justify">Ketidakmampuan untuk memahami & mengkaji persoalan serta memberikan respon yang sesuai</td>
			<td width="5%">{!! $laporan_psikogram_pemeriksaan_psikologi->kecerdasan_umum == 'Sangat Rendah' ? $checked : '' !!}</td>
			<td width="5%">{!! $laporan_psikogram_pemeriksaan_psikologi->kecerdasan_umum == 'Rendah' ? $checked : '' !!}</td>
			<td width="5%">{!! $laporan_psikogram_pemeriksaan_psikologi->kecerdasan_umum == 'Hampir Cukup' ? $checked : '' !!}</td>
			<td width="5%">{!! $laporan_psikogram_pemeriksaan_psikologi->kecerdasan_umum == 'Cukup' ? $checked : '' !!}</td>
			<td width="5%">{!! $laporan_psikogram_pemeriksaan_psikologi->kecerdasan_umum == 'Tinggi' ? $checked : '' !!}</td>
			<td width="5%">{!! $laporan_psikogram_pemeriksaan_psikologi->kecerdasan_umum == 'Sangat Tinggi' ? $checked : '' !!}</td>
			<td width="25%" style="text-align: justify">Kemampuan yang sangat baik untuk memahami & mengkaji persoalan serta memberikan respon yang sesuai</td>
		</tr>
		<tr>
			<td rowspan="5" text-rotate="90" class="grey">Kepribadian</td>
			<td>Stabilitas Emosi</td>
			<td style="text-align: justify">Ketidakmampuan untuk mengendalikan perasaan & mudah panik / reaktif dalam menghadapi tekanan</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->stabilitas_emosi == 'Sangat Rendah' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->stabilitas_emosi == 'Rendah' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->stabilitas_emosi == 'Hampir Cukup' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->stabilitas_emosi == 'Cukup' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->stabilitas_emosi == 'Tinggi' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->stabilitas_emosi == 'Sangat Tinggi' ? $checked : '' !!}</td>
			<td style="text-align: justify">Kemampuan yang sangat baik untuk mengendalikan perasaan & mudah panik / reaktif dalam menghadapi tekanan</td>
		</tr>
		<tr>
			<td>Kemampuan Adaptasi</td>
			<td style="text-align: justify">Kaku, Kurang Luwes membutuhkan waktu lama untuk menyesuaikan diri</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->kemampuan_adaptasi == 'Sangat Rendah' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->kemampuan_adaptasi == 'Rendah' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->kemampuan_adaptasi == 'Hampir Cukup' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->kemampuan_adaptasi == 'Cukup' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->kemampuan_adaptasi == 'Tinggi' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->kemampuan_adaptasi == 'Sangat Tinggi' ? $checked : '' !!}</td>
			<td style="text-align: justify">Mampu menyesuaikan diri dengan perubahan situasi</td>
		</tr>
		<tr>
			<td>Kepekaan Sosial</td>
			<td style="text-align: justify">Ketidakmampuan untuk mengenali kebutuhan & perasaan orang lain serta menindaklanjuti respon</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->kepekaan_sosial == 'Sangat Rendah' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->kepekaan_sosial == 'Rendah' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->kepekaan_sosial == 'Hampir Cukup' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->kepekaan_sosial == 'Cukup' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->kepekaan_sosial == 'Tinggi' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->kepekaan_sosial == 'Sangat Tinggi' ? $checked : '' !!}</td>
			<td style="text-align: justify">Kemampuan yang sangat baik untuk mengenali kebutuhan & perasaan orang lain serta menindaklanjuti respon</td>
		</tr>
		<tr>
			<td>Motivasi</td>
			<td style="text-align: justify">Tidak mempunyai dorongan / keinginan untuk selalu mencapai target yang terbaik, tidak siap untuk menghadapi tantangan, tidak mau belajar & berusaha</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->motivasi == 'Sangat Rendah' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->motivasi == 'Rendah' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->motivasi == 'Hampir Cukup' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->motivasi == 'Cukup' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->motivasi == 'Tinggi' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->motivasi == 'Sangat Tinggi' ? $checked : '' !!}</td>
			<td style="text-align: justify">Mempunyai dorongan / keinginan yang kuat untuk selalu mencapai target yang terbaik, tidak siap untuk menghadapi tantangan, mau belajar & berusaha</td>
		</tr>
		<tr>
			<td>Daya Tahan Terhadap Stress</td>
			<td style="text-align: justify">Tidak mampu melawan stressor yang mengancam dan mengganggu kehidupan yang bermanifestasi dalam bentuk reaksi stress yang bersifat fisiologis dan psikologis</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->daya_tahan_terhadap_stres == 'Sangat Rendah' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->daya_tahan_terhadap_stres == 'Rendah' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->daya_tahan_terhadap_stres == 'Hampir Cukup' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->daya_tahan_terhadap_stres == 'Cukup' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->daya_tahan_terhadap_stres == 'Tinggi' ? $checked : '' !!}</td>
			<td>{!! $laporan_psikogram_pemeriksaan_psikologi->daya_tahan_terhadap_stres == 'Sangat Tinggi' ? $checked : '' !!}</td>
			<td style="text-align: justify">Kemampuan yang baik dalam melawan stressor yang mengancam dan mengganggu kehidupan yang bermanifestasi dalam bentuk reaksi stress yang bersifat fisiologis dan psikologis</td>
		</tr>
	</table>
	<br>
	
	<div style="page-break-after: always;"></div>

	<b>Kesimpulan</b>
	<div style="width: 100%; border: 1px solid black; margin-bottom: 10px; padding-top: 3px; padding-left: 10px;">
		<div class="word-break">
            {!! nl2br($laporan_psikogram_pemeriksaan_psikologi->kesimpulan ?? "-") !!}
        </div>
	</div>

	<table width="100%">
		<tr>
			<td width="60%"></td>
			<td width="40%">
				<div style="border: 1px solid #000; border-radius: 20px; padding: 10px;">
					<table width="100%">
						<tr>
							<td colspan="4" style="text-align: center"><b><u>Keterangan :</u></b></td>
						</tr>
						<tr>
							<td>SR</td>
							<td>: Sangat Rendah</td>
							<td>R</td>
							<td>: Rendah</td>
						</tr>
						<tr>
							<td>HC</td>
							<td>: Hampir Cukup</td>
							<td>C</td>
							<td>: Cukup</td>
						</tr>
						<tr>
							<td>T</td>
							<td>: Tinggi</td>
							<td>ST</td>
							<td>: Sangat Tinggi</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>

	<table width="100%" style="margin-top: 120px;">
		<tr>
			<td width="60%"></td>
			<td width="40%" align="center">Surabaya, {{ !is_null($laporan_psikogram_pemeriksaan_psikologi->created_at) ? indonesian_date($laporan_psikogram_pemeriksaan_psikologi->created_at) : '_____________' }}</td>
		</tr>
		<tr>
			<td></td>
			<td align="center"><b>Psikolog</b></td>
		</tr>
		<tr>
			<td></td>
			<td align="center" height="50"></td>
		</tr>
		<tr>
			<td></td>
			<td align="center">{{$laporan_psikogram_pemeriksaan_psikologi->creator->name}}</td>
		</tr>
	</table>

	<script type="text/php">
	    if (isset($pdf)) {
	        $x = $pdf->get_width() - 370;
	        $y = $pdf->get_height() - 34;
	        $text = "Laporan Psikogram Pemeriksaan Psikologi - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$laporan_psikogram_pemeriksaan_psikologi->id.'}'}} | Halaman {PAGE_NUM} of {PAGE_COUNT}";
	        $font = null;
	        $size = 9;
	        $color = array(0,0,0);
	        $word_space = 0.0;
	        $char_space = 0.0;
	        $angle = 0.0;
	        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
	    }
	</script> 
</body>
</html>