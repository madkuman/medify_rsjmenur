<!DOCTYPE html>
<html>
<head>
	<title>Laporan TBC</title>
	<style type="text/css">
	table{
		border-collapse: collapse;;
		width: 100%;
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
	<table style="width: 100%;page-break-inside: auto">
		<thead>
			<tr>
				<th class="bordered title" style="width: 3%">NO</th>
				<th class="bordered title" style="width: 8%">NO RM</th>
				<th class="bordered title" style="width: 9%">NAMA PASIEN</th>
				<th class="bordered title" style="width: 3%">L / P</th>
				<th class="bordered title" style="width: 7%">UMUR (Th)</th>
				<th class="bordered title" style="width: 15%">WAKTU DATANG</th>
				<th class="bordered title" style="width: 15%;">MOBILITAS</th>
				<th class="bordered title" style="width: 15%;">PERNAFASAN</th>
				<th class="bordered title" style="width: 15%;">HEART RATE</th>
				<th class="bordered title" style="width: 15%;">TEKANAN SISTOLIK</th>
				<th class="bordered title" style="width: 15%;">TEMPERATURE</th>
				<th class="bordered title" style="width: 15%;">KESADARAN</th>
				<th class="bordered title" style="width: 15%;">TRAUMA</th>
				<th class="bordered title" style="width: 15%;">SKOR</th>
				<th class="bordered title" style="width: 15%;">FAKTOR DISKRIMINAN</th>
				<th class="bordered title" style="width: 15%;">TRIAGE</th>
				<th class="bordered title" style="width: 15%;">WAKTU PEMERIKSAAN DOKTER</th>
				<th class="bordered title" style="width: 15%;">HASIL PEMERIKSAAN DOKTER</th>
			</tr>
		</thead>
		<tbody>
			@php $i = 1; @endphp
			@foreach($triage as $item)
			<tr>
				<td class="bordered center">{{$i}}</td>
				<td class="bordered">{{$item->kasus->pasien->no_rm or '-'}}</td>
				<td class="bordered">{{$item->kasus->pasien->name or '-'}}</td>
				<td class="bordered center">{{$item->kasus->pasien->gender == 1 ? 'L' : 'P'}}</td>
				<td class="bordered center">{{$item->kasus->identitas->age ?? '-'}}</td>
				<td class="bordered center">{{$item->created_at->format('d/m/Y H:i:s') ?? '-'}}</td>
				<td class="bordered">
					@if($item->mobility == 0) Berjalan
					@elseif($item->mobility == 1) Berjalan dengan bantuan
					@elseif($item->mobility == 2) Tidak dapat berjalan
					@endif
				</td>
				<td class="bordered">`
					@if($item->resp == -3) 0-6
					@elseif($item->resp == -1) 7-11
					@elseif($item->resp == 0) 12-20
					@elseif($item->resp == 1) 21-29
					@elseif($item->resp == 2) >=30
					@endif
				</td>
				<td class="bordered">`
					@if($item->heartrate == -3) 0
					@elseif($item->heartrate == -2) <50
					@elseif($item->heartrate == -1) 50-59
					@elseif($item->heartrate == 0) 60-100
					@elseif($item->heartrate == 1) 101-119
					@elseif($item->heartrate == 2) 120-139
					@elseif($item->heartrate == 3) >=140
					@endif
				</td>
				<td class="bordered">`
					@if($item->systol == -3) <70
					@elseif($item->systol == -2) 70-80
					@elseif($item->systol == -1) 81-100
					@elseif($item->systol == 0) 101-199
					@elseif($item->systol == 1) 
					@elseif($item->systol == 2) >=200
					@endif
				</td>
				<td class="bordered">`
					@if($item->temp == -2) <35
					@elseif($item->temp == -1) 35-35.9
					@elseif($item->temp == 0) 36-37.9
					@elseif($item->temp == 1) 38-38.9
					@elseif($item->temp == 2) >=39
					@endif
				</td>
				<td class="bordered">
					@if($item->conscious == 0) Alert
					@elseif($item->conscious == 1) Respond to Verbal
					@elseif($item->conscious == 2) Respond to Pain
					@elseif($item->conscious == 3) Unresponsive
					@endif
				</td>
				<td class="bordered">
					@if($item->trauma == 0) Tidak
					@else($item->trauma == 1) Ya
					@endif
				</td>
				<td class="bordered">
					{{$item->score}}
				</td>
				<td class="bordered">
					Diskriminan P1 : {{$item->p1_diskriminan}} <br>
					Diskriminan P2 : {{$item->p2_diskriminan}}  <br>
					Diskriminan P3 : {{$item->p3_diskriminan}} <br>
					Diskriminan PONEK : {{$item->ponek_diskriminan}} <br>
					Pertimbangan P1 : {{$item->pertimbangan_khusus_p1}} <br>
					Pertimbangan P1 : {{$item->pertimbangan_khusus_p2}} <br>
				</td>
				<td class="bordered">
					@if(!empty($item->ponek_diskriminan))
						PONEK
					@elseif(!empty($item->p1_diskriminan) || $item->score > 5 || !empty($item->pertimbangan_khusus_p1))
						P1
					@elseif(!empty($item->p2_diskriminan) || $item->score >= 3 || !empty($item->pertimbangan_khusus_p2))
						P2
					@else
						P3
					@endif
				</td>
				<td class="bordered">{{$item->kasus->created_at->format('d/m/Y H:i:s') ?? '-'}}</td>
				<td class="bordered">
					@foreach($item->kasus->diagnosis as $item_dx)
					{{$item_dx->icd10->code_icd ?? ''}} - {{$item_dx->icd10->long_desc ?? ''}}
					@if(!$loop->last) , @endif
					@endforeach
				</td>
			</tr>
			@php $i++; @endphp
			@endforeach
		</tbody>
	</table>
</body>
</html>