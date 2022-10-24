<!DOCTYPE html>
<html>
<head>
	<title>Laporan Katarak</title>
	<style type="text/css">
	table{
		border-collapse: collapse;;
		width: 100vw;
	}
	.title{
		text-align: center;
		vertical-align: middle;
		padding-top: 10px;
		padding-bottom: 10px;
	}
	.bordered{
		border: 1px solid black;
	}
	.center{
		text-align: center;
	}
</style>
</head>
<body>
	
<table width="100%">
	<tr>
		<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
	</tr>
</table>
	<hr style="width: 25%; margin-left: 0px; margin-bottom: 15px;">
	
	<table>
		<tr>
			<td class="center">FORM LAPORAN PASIEN KATARAK DAN PASIEN KATARAK YANG SUDAH DIOPERASI</td>
		</tr>
	</table>
	<br>

	<table>
		<tr>
			<td style="width: 20%">RUMAH SAKIT/ KLINIK MATA</td>
			<td style="width: 90%">: {{config('app.name')}}</td>
		</tr>
		<tr>
			<td>BULAN</td>
			<td>: {{$bulan}}</td>
		</tr>
	</table>

	<table>
		<thead>
			<tr>
				<th class="bordered title" rowspan="2" style="width: 3%">NO</th>
				<th class="bordered title" rowspan="2" style="width: 21%">NAMA PASIEN</th>
				<th class="bordered title" rowspan="2" style="width: 7%">NIK</th>
				<th class="bordered title" rowspan="2" style="width: 27%">ALAMAT</th>
				<th class="bordered title" colspan="2" style="width: 8%">UMUR (Th)</th>
				<th class="bordered title" rowspan="2" style="width: 9%">DIAGNOSA / KODE ICD X</th>
				<th class="bordered title" colspan="2" style="width: 15%">OPERASI KATARAK</th>
				<th class="bordered title" rowspan="2" style="width: 10%">TANGGAL OPERASI</th>
			</tr>
			<tr>
				<th class="bordered center">L</th>
				<th class="bordered center">P</th>
				<th class="bordered center">SUDAH</th>
				<th class="bordered center">BELUM</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php for($i=1;$i<=10;$i++) { ?>
				<td class="bordered center">{{$i}}</td>
				<?php } ?>
			</tr>
			@php $i = 1; @endphp
			@foreach($katarak_diagnosis as $diagnosis)
			<tr>
				<td class="bordered center">{{$i}}</td>
				<td class="bordered">{{$diagnosis->kasus->pasien->name}}</td>
				<td class="bordered center">{{$diagnosis->kasus->pasien->no_identitas or '-'}}</td>
				<td class="bordered">{{$diagnosis->kasus->pasien->address or '-'}}</td>
				@if($diagnosis->kasus->pasien->jenis_kelamin == 'Laki laki')
				<td class="bordered center">{{$diagnosis->kasus->pasien->age}}</td>
				<td class="bordered"></td>
				@else
				<td class="bordered"></td>
				<td class="bordered center">{{$diagnosis->kasus->pasien->age}}</td>
				@endif
				<td class="bordered center">{{$diagnosis->icd10->code_icd}}</td>
				@php $flag = 0; @endphp
				@forelse($katarak_operasi as $operasi)
					@if($operasi->kasus_id == $diagnosis->kasus_id && $diagnosis->icd10->id == $operasi->diagnosis_id)
					@if($operasi->status == 1)
					<td class="bordered center">x</td>
					<td class="bordered"></td>
					@else
					<td class="bordered"></td>
					<td class="bordered center">x</td>
					@endif
					@if(!empty($operasi->jadwal_operasi))
					<td class="bordered center">{{date_format(date_create($operasi->jadwal_operasi), 'd-m-Y')}}</td>
					@else
					<td class="bordered center">-</td>
					@endif
					@php $flag = 1; @endphp
					@break
					@endif
				@empty
					<td class="bordered"></td>
					<td class="bordered center">x</td>
					<td class="bordered"></td>
					@php $flag = 1; @endphp
				@endforelse
				@if($flag == 0)
				<td class="bordered"></td>
				<td class="bordered center">x</td>
				<td class="bordered"></td>
				@endif
			</tr>
			@php $i++; @endphp
			@endforeach
		</tbody>
	</table>
</body>
</html>