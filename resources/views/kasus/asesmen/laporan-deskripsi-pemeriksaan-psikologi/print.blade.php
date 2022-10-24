<!DOCTYPE html>
<html>
<head>
	<title>Laporan Deskripsi Pemeriksaan Psikologi</title>
	<style type="text/css">
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
	{{-- <div class="footer">
        Laporan Pemeriksaan Psikologi - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$laporan_deskripsi_pemeriksaan_psikologi->id.'}'}} | Halaman <span class="pagenum"></span> of 1
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

	<table width="100%" cellpadding="5" style="margin-top: 15px;">
		<tr>
			<td width="90%"></td>
			<td width="15%" align="center" bgcolor="#000" style="border: 3px solid #d9d9d9;">
				<p style="font-size: 14px; color: #fff;"><b>rahasia</b></p>
			</td>
		</tr>
	</table>

	<table width="100%" style="margin-top: 15px;">
		<tr>
			<td align="center"><p style="font-size: 12"><b>LAPORAN PEMERIKSAAN PSIKOLOGI</b></p></td>
		</tr>
	</table>

	<table width="100%" style="margin-top: 15px;" cellpadding="3">
		<tr>
			<td width="23%">Tujuan Tes</td>
			<td width="2%">:</td>
			<td width="76%"><b>{{ $laporan_deskripsi_pemeriksaan_psikologi->tujuan_pemeriksaan ?? '_____________' }}</b></td>
		</tr>
		<tr>
			<td width="23%">Nama</td>
			<td width="2%">:</td>
			<td width="76%"><b>{{ $kasus->identitas->nama ?? '-' }}</b></td>
		</tr>
		<tr>
			<td>No RM</td>
			<td>:</td>
			<td><b>{{ $kasus->pasien->no_rm ?? '-' }}</b></td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td>:</td>
			<td>{{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
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
			<td>{{$laporan_deskripsi_pemeriksaan_psikologi->rujukan_dari}}</td>
		</tr>
	</table>

	<table width="100%" style="margin-top:20px;" cellpadding="5">
		<tr>
			<td><b>Berdasarkan pemeriksaan yang telah dilakukan pada hari {{ !is_null($laporan_deskripsi_pemeriksaan_psikologi->tanggal_pemeriksaan) ? indonesian_date($laporan_deskripsi_pemeriksaan_psikologi->tanggal_pemeriksaan, 'l') : '_____________'}}<b style="margin-left: -3px;">,</b> tanggal {{ !is_null($laporan_deskripsi_pemeriksaan_psikologi->tanggal_pemeriksaan) ? indonesian_date($laporan_deskripsi_pemeriksaan_psikologi->tanggal_pemeriksaan) : '_________________'}}<b style="margin-left: -3px;">,</b> dapat diketahui <u>bahwa pada saat ini:</u></b></td>
		</tr>
		<tr>
			<td>
				<div class="word-break">
                    {!! nl2br(e($laporan_deskripsi_pemeriksaan_psikologi->hasil ?? "-")) !!}
                </div>
			</td>
		</tr>
	</table>

	<table width="100%" style="margin-top: 15px;">
		<tr>
			<td width="60%"></td>
			<td width="40%" align="center">Surabaya, {{ !is_null($laporan_deskripsi_pemeriksaan_psikologi->created_at) ? indonesian_date($laporan_deskripsi_pemeriksaan_psikologi->created_at) : '_____________' }} </td>
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
			<td align="center">
				<p><u>{{$laporan_deskripsi_pemeriksaan_psikologi->creator->name ?? '.........................................'}}</u></p>
			</td>
		</tr>
	</table>

	<script type="text/php">
	    if (isset($pdf)) {
	        $x = $pdf->get_width() - 325;
	        $y = $pdf->get_height() - 34;
	        $text = "Laporan Pemeriksaan Psikologi - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$laporan_deskripsi_pemeriksaan_psikologi->id.'}'}} | Halaman {PAGE_NUM} of {PAGE_COUNT}";
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