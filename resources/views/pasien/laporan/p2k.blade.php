<!DOCTYPE html>
<html>
<head>
	<title>Laporan Penderita Penyakit Kronis</title>
	<style type="text/css">
	table{
		border-collapse: collapse;;
		width: 100vw;
		font-size: 10px;
	}
	.title{
		text-align: center;
		vertical-align: middle;
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
	<hr style="width: 17%; margin-left: 0px;">
	
	<table>
		<tr>
			<td class="center">LAPORAN PENDERITA PENYAKIT KRONUS (P2K)</td>
		</tr>
		<tr>
			<td class="center">{{config('app.name')}}</td>
		</tr>
		<tr>
			<td class="center" style="text-transform: uppercase;">BULAN {{$bulan}}</td>
		</tr>
	</table>
	<br>

	<table>
		<thead>
			<tr>
				<th class="bordered title" rowspan="3" style="width: 3%">NO</th>
				<th class="bordered title" rowspan="3" style="width: 10%">NAMA</th>
				<th class="bordered title" rowspan="3" style="width: 5%">DIAGNOSIS</th>
				<th class="bordered title" rowspan="3" style="width: 5%">TANGGAL MULAI SAKIT</th>
				<th class="bordered title" colspan="12" style="width: 72%">
					GOLONGAN/JENIS P2K (A/B/C1/C2/C3/C4) PENGOBATAN/TINDAKAN
				</th>
				<th class="bordered title" rowspan="3" style="width: 5%">KET</th>
			</tr>
			<tr>
				<th class="bordered title" colspan="12">2018</th>
			</tr>
			<tr>
				<th class="bordered title">JAN</th>
				<th class="bordered title">FEB</th>
				<th class="bordered title">MAR</th>
				<th class="bordered title">APR</th>
				<th class="bordered title">MEI</th>
				<th class="bordered title">JUN</th>
				<th class="bordered title">JUL</th>
				<th class="bordered title">AGS</th>
				<th class="bordered title">SEP</th>
				<th class="bordered title">OKT</th>
				<th class="bordered title">NOV</th>
				<th class="bordered title">DES</th>
			</tr>	
		</thead>
		<tbody>
			@php $no=1; @endphp		
			<tr>
				<?php for($i=1;$i<=17;$i++) { ?>
				<td class="bordered center">{{$i}}</td>
				<?php } ?>
			</tr>
			@foreach($kasus as $item)
			<tr>
				<td class="bordered center">{{$no}}</td>
				<td class="bordered">{{$item->pasien->name}}</td>
				<td class="bordered center">@if(!empty($item->diagnosisUtama)) {{$item->diagnosisUtama->icd10->long_desc}} @else {{$item->diagnosisTambahan[0]->icd10->long_desc}} @endif</td>
				<td class="bordered center">{{$item->tanggal}}</td>
				<?php for($i=1;$i<=12;$i++) { ?>
				<td class="bordered">
				@foreach($item->resep as $resep_item)
					@if($resep_item->created_at->format('m') == $i)
						@foreach($resep_item->resepDetail as $resep_detail_item)
						- {{$resep_detail_item->obat_name ?? $resep_detail_item->racikan}}<br>
						@endforeach
					@endif
				@endforeach
				<?php } ?>
				</td>
				<td class="bordered"></td>
			</tr>
			@php $no++; @endphp
			@endforeach
		</tbody>
	</table>
</body>
</html>