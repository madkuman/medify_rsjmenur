<!DOCTYPE html>
<html>
<head>
	<title>Profil Ringkas Medis Rawat Jalan (PRMRJ)</title>
	<style type="text/css">
		table{
			font-family: sans-serif;
			width: 100%;
			font-size: 13px;
			border-collapse: collapse;
		}
		.bordered td, .bordered th{
			border: 1px solid black;
			padding-left: 5px;
			padding-right: 5px;
		}
		td{
			vertical-align: top;
		}
		.centered td, .centered{
			text-align: center;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM 03
			</td>
		</tr>
	</table>
	<table style="margin-top: 5px;">
		<tr>
			<td width="60%">
				<table>
					<tr>
						<td width="15%" style="text-align: center;">
							<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="75">
						</td>
						<td width="70%" style="text-align: center; font-size: 10px;">
							<p style="font-size: 10px;">PEMERINTAH PROVINSI JAWA TIMUR <br>
                                DINAS KESEHATAN <br>
                                <b>RUMAH SAKIT JIWA MENUR</b> <br>
                                Jln. Raya Menur No.120, Gubeng, Kertajaya, Surabaya Jatim  <br>
                                Telp. (031) 5021635, Laman:rsjmenur.jatimprov.go.id
                            </p>
						</td>
						<td width="15%" style="text-align: center;">
						</td>
					</tr>
					<tr>
						<td colspan="3" style="font-size: 7px;"></td>
					</tr>
					<tr>
						<td colspan="3">
							<b style="font-size: 16px;">PROFIL RINGKAS MEDIS RAWAT JALAN (PRMRJ)</b><br>
							<i style="font-size: 14px;">(Diisi oleh DPJP)</i>
						</td>
					</tr>
				</table>
			</td>
			<td width="40%">
				<div style="border: 1px solid black; padding: 5px;">
					<table style="font-size: 11px;">
						<tr>
							<td>No Rekam Medis</td>
							<td>: {{$identitas->no_rm_formatted}}</td>
						</tr>
						<tr>
							<td>Nama</td>
							<td>: {{$identitas->name}}</td>
						</tr>
						<tr>
							<td>Tgl Lahir/Umur</td>
							<td>: {{date('d-m-Y', strtotime($identitas->date_of_birth))}}/{{$identitas->age}} Tahun</td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td>: {{$identitas->gender == '1' ? 'Laki-laki' : 'Perempuan'}}</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
	<table class="bordered" style="margin-top: 10px;">
		<thead>
			<tr class="centered">
				<th width="15%">TANGGAL</th>
				<th width="20%">KLINIK</th>
				<th width="30%">DIAGNOSA</th>
				<th width="20%">TERAPI</th>
				<th width="15%">TTD DPJP</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($kunjungan as $kasus)
			<tr>
				<td>{{date('d M Y', strtotime($kasus->created_at))}}</td>
				<td>
					@foreach($kasus->lokasiAll as $lokasi)
					- {{$lokasi->lokasi->nama}}<br>
					@endforeach
				</td>
				<td>
					{{$kasus->diagnosisUtama->icd10->code_icd}} - {{$kasus->diagnosisUtama->icd10->long_desc}}
				</td>
				<td>
					@if(count($kasus->resep) > 0)
					@foreach($kasus->resep as $resep)
					@foreach($resep->resepDetail as $detail)
					- {{($detail->kategori == 'racikan') ? $detail->racikan : $detail->obat_name}}, {{$detail->jumlah}} {{$detail->type}}<br>
					@endforeach
					@endforeach
					@endif
				</td>
				<td>
					<img src="{{url('')}}/{{$kasus->dpjp->user->ttd}}" style="max-width: 90px;"><br>
					{{$kasus->dpjp->user->name}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>
