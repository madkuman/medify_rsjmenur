<head>
	<title>Print TTV - Tindakan Keperawatan</title>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table {
		border-collapse: collapse;
		width: 100%;
	}

	.centered{
		text-align: center;
	}

	.bot{
		border-bottom: 1px solid black;
	}

	.righted{
		text-align: right;
	}

	.bordered{
		border: 1px solid black;
	}

	.big{
		font-weight: bold;
		font-size: 26px;
		vertical-align: middle;
		text-align: center;
	}
	.small{
		font-size: 12px !important;
	}
	td{
		vertical-align: middle;
		margin:5px;
	}
</style>
</head>

<body>
	<table width="100%">
        <tr>
            <td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
        </tr>
    </table>
	<br><br>
	
	<table>
		<tr>
			<td width="60%" class="big bordered centered">
				TINDAKAN KEPERAWATAN
			</td>
			<td width="40%" class="bordered">
				<table>
					<tr>
						<td>No.RM</td>
						<td>: {{$kasus->pasien->no_rm}}</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>: {{$kasus->pasien->name}}</td>
					</tr>
					<tr>
						<td>Tgl Lahir / Umur</td>
						<td>: {{indonesian_date($kasus->pasien->date_of_birth)}} / {{$kasus->identitas->age}}</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>: {{$kasus->identitas->gender}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td width="12%">Masuk RS Tgl</td>
			<td width="38%">: {{indonesian_date($kasus->created_at)}}</td>
			<td width="15%" class="righted">Ruangan</td>
			<td width="35%">: {{$kasus->lokasi->lokasi->nama}}</td>
		</tr>
	</table>
	<hr style="margin-top: 0px;"><br>
	<table class="small">
		<thead>
			<tr>
				<th class="bordered centered" rowspan="2">TGL</th>
				<th class="bordered centered" rowspan="2">JAM</th>
				<th class="bordered centered" colspan="6">TANDA - TANDA VITAL</th>
				<th class="bordered centered" rowspan="2">SKALA NYERI</th>
				<th class="bordered centered" rowspan="2">GCS</th>
				<th class="bordered centered">AVPU</th>
				<th class="bordered centered" rowspan="2">CAIRAN Infus/tts</th>
				<th class="bordered centered" rowspan="2">EWS PEWS</th>
				<th class="bordered centered" rowspan="2">PORSI MAKAN</th>
				<th class="bordered centered" rowspan="2">NAMA LENGKAP</th>
			</tr>
			<tr>
				<th class="bordered centered">T</th>
				<th class="bordered centered">N</th>
				<th class="bordered centered">t&#176;C</th>
				<th class="bordered centered">RR</th>
				<th class="bordered centered">O2</th>
				<th class="bordered centered">SPO2</th>
				<th class="bordered centered">Perilaku</th>
			</tr>
			<tr>
				<th class="bordered centered">1</th>
				<th class="bordered centered">2</th>
				<th class="bordered centered">3</th>
				<th class="bordered centered">4</th>
				<th class="bordered centered">5</th>
				<th class="bordered centered">6</th>
				<th class="bordered centered">7</th>
				<th class="bordered centered">8</th>
				<th class="bordered centered">9</th>
				<th class="bordered centered">10</th>
				<th class="bordered centered">11</th>
				<th class="bordered centered" style="width: 50px !important;">12</th>
				<th class="bordered centered">13</th>
				<th class="bordered centered">14</th>
				<th class="bordered centered">15</th>
			</tr>
		</thead>
		<tbody>
			@php $iteration = 0 @endphp
			@php $total_ttv = 0 @endphp
			@while($total_ttv < count($ttv))

			@php
				if($iteration == 0){
					$iteration == 1;
					$max_total = 24;
				}
				else $max_total = 35;
			@endphp

			@for($i=0;$i<$max_total;$i++)
				@if(!empty($ttv[$total_ttv]))
				@php $item=$ttv[$total_ttv] @endphp
				@php $total_ttv++ @endphp
				<tr>
					<td class="bordered centered">{{$item->created_at->format('d/m/y')}}</td>
					<td class="bordered centered">{{$item->created_at->format('H:i')}}</td>
					<td class="bordered centered">{{$item->sistol ?? '-'}}/{{$item->diastol}}</td>
					<td class="bordered centered">{{$item->nadi or '-'}}</td>
					<td class="bordered centered">{{$item->temperatur or '-'}}</td>
					<td class="bordered centered">{{$item->pernapasan or '-'}}</td>
					<td class="bordered centered">{{$item->o2 or '-'}}</td>
					<td class="bordered centered">{{$item->spo2 or '-'}}</td>
					<td class="bordered centered">{{$item->skala_nyeri or '-'}}</td>
					<td class="bordered centered">{{$item->gcs or '-'}}</td>
					<td class="bordered centered">{{$item->avpu or '-'}}</td>
					<td class="bordered centered">{{$item->cairan_infus or '-'}}</td>
					<td class="bordered centered">{{$item->ews or '-'}}</td>
					<td class="bordered centered">{{$item->porsi_makan or '-'}}</td>
					<td class="bordered centered">{{$item->creator->name ?? '-'}}</td>
					{{--
					@if($i == 0)
					<td class="bordered centered" style="vertical-align: top" rowspan="20">
						@foreach($tindakan as $item)
						{{$item->created_at->format('H:i')}}<br>
						@endforeach
					</td>
					<td class="bordered" style="vertical-align: top" rowspan="20">
						@foreach($tindakan as $item)
						{{$item->desc}}<br>
						@endforeach
					</td>
					<td class="bordered" style="vertical-align: top" rowspan="20">
						@foreach($tindakan as $item)
						{{$item->creator->name ?? '-'}}<br>
						@endforeach
					</td>
					@endif
					--}}
				</tr>
				@else
				<tr>
					<td class="bordered centered">&nbsp;</td>
					<td class="bordered centered"></td>
					<td class="bordered centered"></td>
					<td class="bordered centered"></td>
					<td class="bordered centered"></td>
					<td class="bordered centered"></td>
					<td class="bordered centered"></td>
					<td class="bordered centered"></td>
					<td class="bordered centered"></td>
					<td class="bordered centered"></td>
					<td class="bordered centered"></td>
					<td class="bordered centered"></td>
					<td class="bordered centered"></td>
					<td class="bordered centered"></td>
					<td class="bordered centered"></td>
				</tr>
				@endif
			@endfor
			@endwhile
		</tbody>
	</table>
</body>