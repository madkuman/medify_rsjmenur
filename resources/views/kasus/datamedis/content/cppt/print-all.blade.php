<head>
	<title>Print Rekap CPPT</title>
	<style type="text/css">
		body{
			font-family: sans-serif;
		}
		table {
			border-collapse: collapse;
			width: 100% !important;
		}
		tr {
			page-break-inside: auto !important;
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
			padding:10px 5px;
			white-space: pre-line;
		}

		.big{
			font-weight: bold;
			font-size: 16px;
			vertical-align: middle;
			text-align: center;
		}
		.un-bot{
			border-bottom: 1px solid white !important;
		}
		.un-top{
			border-top: 1px solid white !important;
		}
	</style>
</head>

<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				@if($kasus->tipe_ri == '1')
				RM. 24
				@elseif($kasus->tipe_rj == '1')
				RM. 13
				@elseif($kasus->tipe_igd == '1')
				RM 06.K2
				@else
				RM.
				@endif
			</td>
		</tr>
	</table>
	<table style="margin-top: -20px;">
		<tr>
			<td width="50%">
				<table>
					<tr>
						<td width="20%" style="text-align: center;">
							<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
						</td>
						<td width="60%" style="text-align: center; font-size: 10px;">
							<b>
								PEMERINTAH PROVINSI JAWA TIMUR<br>
								RUMAH SAKIT JIWA MENUR<br>
								Jln Menur No.120, Telp(031)5021635,5021637<br>
								Surabaya
							</b>
						</td>
						<td width="20%" style="text-align: center;">
							<img src="{{url('')}}/assets/img/menur.png" height="55">
						</td>
					</tr>
				</table>
			</td>
			<td width="50%"></td>
		</tr>
	</table>
	<table style="margin-top: 10px; border-collapse: separate;">
		<tr>
			<td width="45%" class="big" style="border: 2px solid black">
				CATATAN PERKEMBANGAN PASIEN TERINTEGRASI (CPPT)<br>
				@if($kasus->tipe_ri == '1')
				RAWAT INAP
				@elseif($kasus->tipe_rj == '1')
				RAWAT JALAN
				@elseif($kasus->tipe_igd == '1')
				GAWAT DARURAT
				@else
				MEDICAL CHECKUP
				@endif
			</td>
			<td width="55%" class="bordered">
				<table>
					<tr>
						<td>NO.RM</td>
						<td>: {{{$kasus->pasien->no_rm_formatted}}}</td>
					</tr>
					<tr>
						<td>NAMA</td>
						<td>: {{{$kasus->pasien->name}}}</td>
					</tr>
					<tr>
						<td>TGL LAHIR / UMUR</td>
						<td>: {{$kasus->pasien->date_of_birth ? indonesian_date(date("j F Y", strtotime($kasus->pasien->date_of_birth))) : '-'}} / {{{$kasus->pasien->age}}} Tahun</td>
					</tr>
					<tr>
						<td>JENIS KELAMIN</td>
						<td>: @if($kasus->pasien->gender == 1) LAKI-LAKI @else PEREMPUAN @endif</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	{{-- <table>
		<tr>
			<td width="15%" class="righted">Masuk RS Tgl</td>
			<td width="17%">: {{{$kasus->mrs_at ? date('d F Y', strtotime($kasus->mrs_at)) : date('d F Y', strtotime($kasus->created_at))}}}</td>
			<td width="10%" class="righted">Jam</td>
			<td width="13%">: {{{$kasus->mrs_at ? date('H:i:s', strtotime($kasus->mrs_at)) : date('H:i:s', strtotime($kasus->created_at))}}}</td>
			<td width="15%" class="righted">Ruangan</td>
			<td width="30%">: {{$kasus->lokasi->lokasi->nama ?? '-'}}</td>
		</tr>
	</table>
	<hr style="margin-top: 0px;"><br> --}}

	<table style="margin-top: 15px" style="overflow: wrap" autosize="1">
		<tr>
			<th class="bordered" style="width: 100px">Tanggal/Jam</th>
			<th class="bordered">PPA</th>
			<th class="bordered">Hasil Asesmen - SOAP</th>
			<th class="bordered">Instruksi Dokter / Implementasi PPA</th>
			<th class="bordered" style="width: 100px">Verifikasi DPJP</th>
		</tr>
		@foreach($cppt as $item)
		@if($item->jenis == 'adime')
		<tr style="page-break-inside: auto !important;">
			<td class="bordered">{{{date('d-m-Y', strtotime($item->created_at))}}}<br>
				Jam {{{date('H:i', strtotime($item->created_at))}}}
			</td>
			<td class="bordered">{{{$item->creator->name ?? ''}}}</td>
			<td class="bordered">
				A : {{$item->assessment}}<br><br>
				D : {{$item->subjective}}<br><br>
				I : {{$item->objective}}<br><br>
				M : {{$item->plan}}<br><br>
				E : {{$item->ppa}}
			</td>
			<td class="bordered"></td>
			<td class="bordered"></td>
		</tr>
		@else
		@if($item->jenis == 'rapt')
		<tr>
			<td class="bordered un-bot">{{{date('d-m-Y', strtotime($item->created_at))}}}<br>
				Jam {{{date('H:i', strtotime($item->created_at))}}}
			</td>
			<td class="bordered un-bot">{{{$item->creator->name ?? ''}}}</td>
			<td class="bordered un-bot">
				@if($item->preventif) Preventif<br> @endif
				@if($item->kuratif) Kuratif<br> @endif
				@if($item->rehab) Rehabilitatif<br> @endif
				@if($item->paliatif) Paliatif @endif
			</td>
			<td class="bordered un-bot">{{$item->ppa}}</td>
			<td class="bordered un-bot">
				@if($item->verified_at) 
				@if(!empty($item->verifier->ttd))
				<img src="{{url('')}}/{{$item->verifier->ttd}}" style="max-width: 90px;">
				@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="bordered un-bot un-top"></td>
			<td class="bordered un-bot un-top"></td>
			<td class="bordered un-bot un-top">S : {{$item->subjective}} </td>
			<td class="bordered un-bot un-top"></td>
			<td class="bordered un-bot un-top">
				@if($item->verified_at) 
				{{$item->verifier->name}}<br>
				{{indonesian_date($item->verified_at, 'd/m/Y H:i')}}
				@endif
			</td>
		</tr>
		@else
		<tr>
			<td class="bordered un-bot">{{{date('d-m-Y', strtotime($item->created_at))}}}<br>
				Jam {{{date('H:i', strtotime($item->created_at))}}}
			</td>
			<td class="bordered un-bot">{{{$item->creator->name ?? ''}}}</td>
			<td class="bordered un-bot">S : {{$item->subjective}} </td>
			<td class="bordered un-bot">{{$item->ppa}}</td>
			<td class="bordered un-bot">
				@if($item->verified_at) 
				@if(!empty($item->verifier->ttd))
				<img src="{{url('')}}/{{$item->verifier->ttd}}" style="max-width: 90px;">
				@endif
				@endif
			</td>
		</tr>
		@endif
		<tr>
			<td class="bordered un-bot un-top"></td>
			<td class="bordered un-bot un-top"></td>
			<td class="bordered un-bot un-top"> O : {{$item->objective}} </td>
			<td class="bordered un-bot un-top"></td>
			<td class="bordered un-bot un-top">
				@if($item->jenis != 'rapt')
				@if($item->verified_at) 
				{{$item->verifier->name}}<br>
				{{indonesian_date($item->verified_at, 'd/m/Y H:i')}}
				@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="bordered un-bot un-top"></td>
			<td class="bordered un-bot un-top"></td>
			<td class="bordered un-bot un-top"> A : {{$item->assessment}} </td>
			<td class="bordered un-bot un-top"></td>
			<td class="bordered un-bot un-top"></td>
		</tr>
		<tr>
			<td class="bordered un-top"></td>
			<td class="bordered un-top"></td>
			<td class="bordered un-top"> P : {{$item->plan}} </td>
			<td class="bordered un-top"></td>
			<td class="bordered un-top"></td>
		</tr>
		@endif
		@endforeach
	</table>
</body>