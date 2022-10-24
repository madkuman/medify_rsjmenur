<!DOCTYPE html>
<html>
<head>
	<title>Pengantar Pengiriman Pasien</title>
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
		.big{
			font-size: 19px;
		}
		.va-mid{
			vertical-align: middle;
		}
		.px-5 td{
			padding-left: 5px;
			padding-right: 5px;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM 14
			</td>
		</tr>
	</table>
	<table class="big">
		<tr>
			<td width="20%" style="text-align: right;">
				<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
			</td>
			<td width="60%" style="text-align: center;">
				<b>
					PEMERINTAH PROVINSI JAWA TIMUR<br>
					RUMAH SAKIT JIWA MENUR<br>
					Jln Menur No.120, Telp(031)5021635,5021637<br>
					S U R A B A Y A
				</b>
			</td>
			<td width="20%" style="text-align: left;">
				<img src="{{url('')}}/assets/img/menur.png" height="55">
			</td>
		</tr>
	</table>
	<table class="big" style="border: 1px solid black; margin-top: 10px;">
		<tr>
			<td class="centered"><b>PENGANTAR PENGIRIMAN PASIEN</b></td>
		</tr>
	</table>
	<table class="px-5" style="border: 1px solid black;" cellpadding="4">
		<tr>
			<td>Ditujukan Kepada Yth :</td>
		</tr>
		<tr>
			<td>Rumah Sakit / Puskemas : {{$pengantar_pengiriman_pasien->rumah_sakit_tujuan ?? '.....................................................................'}}</td>
		</tr>
	</table>
	<table class="px-5" style="border: 1px solid black;" cellpadding="4">
		<tr>
			<td width="20%">No Rekam Medis</td>
			<td width="80%">: {{$kasus->pasien->no_rm}}</td>
		</tr>
		<tr>
			<td>Nama Pasien</td>
			<td>: {{$kasus->pasien->name}}</td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td>: {{$kasus->pasien->gender == '1' ? 'Laki-laki' : 'Perempuan'}}</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>: {{$kasus->pasien->address}}</td>
		</tr>
		<tr>
			<td>Tgl Lahir / Umur</td>
			<td>: {{date('d F Y', strtotime($kasus->pasien->date_of_birth))}} / {{$kasus->pasien->age}} Tahun</td>
		</tr>
		<tr>
			<td>No Kartu BPJS</td>
			<td>
				:
				@if($kasus->pembayaran->perusahaan->tipe->id == 1)
				{{$kasus->pembayaran->no_asuransi ?? '-'}}
				@else
				-
				@endif
			</td>
		</tr>
		<tr>
			<td>No SEP</td>
			<td>
				: 
				@if($kasus->pembayaran->perusahaan->tipe->id == 1)
				{{$kasus->active_sep->no_sep ?? ''}}
				@else
				-
				@endif
			</td>
		</tr>
		<tr>
			<td>Diagnosa Utama</td>
			<td>: ({{$kasus->diagnosisUtama->icd10->code_icd ?? '-'}}) - {{$kasus->diagnosisUtama->icd10->long_desc ?? '-'}}</td>
		</tr>
	</table>
	<table class="px-5" style="border: 1px solid black;" cellpadding="4">
		<tr>
			<td>Diagnosa tambahan / sekunder</td>
		</tr>
		@php $i = 1; @endphp
		@if(count($kasus->diagnosis) > 0)
		@foreach($kasus->diagnosis as $diagnosis)
		<tr>
			<td width="95%">{{$i++}}. ({{$diagnosis->icd10->code_icd ?? ''}}) - {{$diagnosis->icd10->long_desc ?? ''}}</td>
		</tr>
		@endforeach
		@endif
	</table>
	<table class="px-5" style="border: 1px solid black;" cellpadding="4">
		<tr>
			<td>Pengobatan yang diberikan</td>
		</tr>
		@php $i = 1; @endphp
		@if(count($kasus->resep) > 0)
		@foreach($kasus->resep as $resep)
		@foreach($resep->resepDetail as $detail)
		<tr>
			<td>
				{{$i++}}. 	
				{{($detail->kategori == 'racikan') ? $detail->racikan : $detail->obat_name}}, {{$detail->jumlah}} {{$detail->type}}
			</td>
		</tr>
		@endforeach
		@endforeach
		@endif
	</table>
	<table class="px-5" style="border: 1px solid black;" cellpadding="4">
		<tr>
			<td>Tindakan yang dilakukan</td>
		</tr>
		@php $i = 1; @endphp
		@if(count($kasus->tindakan_icd9) > 0)
		@foreach($kasus->tindakan_icd9 as $tindakan)
		<tr>
			<td>{{$i++}}. ({{$tindakan->icd9->code_icd}}) - {{$tindakan->desc ?? ''}}</td>
		</tr>
		@endforeach
		@endif
	</table>
	<table class="px-5" style="border: 1px solid black;" cellpadding="4">
		<tr>
			<td>Saran Perawatan dan pengobatan lebih lanjut</td>
		</tr>
		<tr>
			<td>{!! nl2br($pengantar_pengiriman_pasien->saran_perawatan_dan_pengobatan_lebih_lanjut ?? '-') !!}</td>
		</tr>
	</table>
	<table>
		<tr>
			<td>
				<table class="px-5" style="border: 1px solid black;" cellpadding="4">
					<tr>
						<td width="60%"></td>
						<td width="40%" class="centered">Surabaya, {{Carbon\Carbon::today()->format('j F Y')}}</td>
					</tr>
					<tr>
						<td></td>
						<td class="centered">Tanda Tangan Dokter</td>
					</tr>
					<tr>
						<td colspan="2"><br><br><br></td>
					</tr>
					<tr>
						<td></td>
						<td class="centered">{{$pengantar_pengiriman_pasien->creator->name}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>