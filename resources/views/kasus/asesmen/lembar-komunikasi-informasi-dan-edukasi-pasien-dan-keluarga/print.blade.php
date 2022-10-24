
<!DOCTYPE html>
<html>
<head>
	<title>Lembar Komunikasi Informasi dan Edukasi Pasien dan Keluarga</title>
	<style type="text/css">
		table {
			border-collapse: collapse;
			width : 100%;
			font-family : sans-serif;
			font-size: 13px;
		}
		.bordered td, .bordered th{
			border: 1px solid black;
			padding-left: 5px;
			padding-right: 5px;
		}
		.centered{
			text-align: center;
		}
		.check{
			font-family: ZapfDingbats;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM 05
			</td>
		</tr>
	</table>
	<table class="bordered" style="margin-top: 10px;">
		<thead>
			<tr>
				<th colspan="7">LEMBAR KOMUNIKASI - INFORMASI & EDUKASI PASIEN DAN KELUARGA (Diisi oleh PPA)</th>
			</tr>
			<tr>
				<th>No</th>
				<th>Kebutuhan & Materi Edukasi/Informasi</th>
				<th>Tgl/Jam & Durasi Edukasi</th>
				<th>Metode</th>
				<th>Nama Edukator Pemberi Informasi</th>
				<th>Verifikasi</th>
				<th>Nama Penerima Informasi</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1; @endphp
			@forelse($lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga as $item)
			<tr>
				<td class="centered">{{$i++}}</td>
				<td>{!!nl2br($item->kebutuhan_materi_edukasi_informasi)!!}</td>
				<td>{{$item->tanggal_edukasi ? date('j/m/Y', strtotime($item->tanggal_edukasi)) : '-'}}, {{$item->jam_edukasi}} (Durasi : {{$item->durasi_edukasi}})</td>
				<td>{{$item->metode}}</td>
				<td>{{$item->nama_edukator_pemberi_informasi}}</td>
				<td class="centered check">{{$item->verifikasi_verfikasi == '1' ? '4' : ''}} </td>
				<td>{{$item->nama_penerima_informasi}} ({{$item->hubungan_terhadap_pasien}})</td>
			</tr>
			@empty
			<tr>
				<td colspan="7" style="height: 100px" class="centered"><b>BELUM ADA MATERI PEMBELAJARAN YANG DILAKUKAN</b></td>
			</tr>
			@endforelse
		</tbody>
	</table>
</body>
</html>








