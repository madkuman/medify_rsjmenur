<head>
	<title>Print Riwayat Pemberian Obat</title>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table {
		border-collapse: collapse;
		width: 100%;
	}
	tr {
		page-break-inside: auto !important;
	}
	td, th{
		font-size: 12px;
	}
	.bold {
		font-weight: bold;
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

	.bg
	{
		background-color: #D0D0D0;
	}

	.bordered{
		border: 1px solid black;
		padding:10px 5px;
		white-space: pre-line;
	}

	.bordered-y{
		border-top: 1px solid black;
		border-bottom: 1px solid black;
		padding:10px 5px;
		white-space: pre-line;
	}

	.bordered-right{
		border-right: 1px solid black;
		padding:10px 5px;
		white-space: pre-line;
	}

	.bordered-left{
		border-left: 1px solid black;
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
			<td width="30%" class="centered">&nbsp;</td>
			<td width="70%"></td>
		</tr>
		<tr>
			<td class="bot centered">RUMAH SAKIT {{strtoupper(config('app.name'))}}</td>
			<td></td>
		</tr>
	</table>
	<br><br>
	
	<table>
		<tr>
			<td width="30%" class="big bordered">
				RIWAYAT PEMBERIAN OBAT
			</td>
			<td width="70%" class="bordered">
				<table>
					<tr>
						<td>No.RM</td>
						<td>: {{{!empty($kasus->pasien) ? $kasus->pasien->no_rm_formatted : '-'}}}</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>: {{{!empty($kasus->pasien) ? $kasus->pasien->name : $kasus->identitas->nama}}}</td>
					</tr>
					<tr>
						<td>Tgl Lahir / Umur</td>
						<td>: {{!empty($kasus->pasien) ? date("j F Y", strtotime($kasus->pasien->date_of_birth)) : '-'}} / {{{!empty($kasus->identitas) ? $kasus->identitas->age : $kasus->pasien->age}}}</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>: @if(!empty($kasus->pasien)) @if($kasus->pasien->gender == 1) Laki-Laki @else Perempuan @endif @else - @endif</td>
					</tr>
					<tr>
						<td>Masuk RS Tgl</td>
						<td>: {{{$kasus->mrs_at ? date('d F Y', strtotime($kasus->mrs_at)) : date('d F Y', strtotime($kasus->created_at))}}}</td>
					</tr>
					<tr>
						<td>Ruangan</td>
						<td>: {{$kasus->lokasi->lokasi->nama ?? '-'}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<hr style="margin-top: 0px;"><br>

	<table>
		<tr>
			<th class="bordered centered" rowspan="2" style="width: 6%">No</th>
			<th class="bordered" rowspan="2" style="width: 26%">Obat</th>
			<th class="bordered" rowspan="2" style="width: 12%">Tanggal Pemberian</th>
			<th class="bordered" colspan="8" style="width: 56">Waktu</th>
		</tr>
		<tr>
			@for($i=1;$i<=8;$i++)
			<td class="bordered centered" style="width: 7%">{{$i}}</td>
			@endfor
		</tr>
		@php $first_pages = 5 @endphp
		@php $other_pages = 8 @endphp
		@php $last_tanggal = '' @endphp

		@php
			$page = $first_pages
		@endphp
		@foreach($data as $obat_id => $item_array)
			@php $no = $loop->iteration @endphp

			@php $total_hari = count($item_array); @endphp
			@php $index = 0 @endphp
			@foreach($item_array as $tanggal => $item_detail)
			@if($index++ == 0)
			<tr><td colspan="11">&nbsp;</td></tr>
			<tr>
				<td colspan="3" class="bold bordered-y bordered-left bg">
					{{$no}}. {{$obat[$obat_id]->nama_obat ?? '-'}}
				</td>
				<td colspan="2" class="bold bordered-y bg">
					Rute : {{$obat[$obat_id]->rute ?? '-'}}
				</td>
				<td colspan="7" class="bold bordered-y bordered-right bg">
					Aturan : {{$obat[$obat_id]->aturan_pemakaian ?? '-'}}
				</td>
			</tr>
			@endif

			<tr>
				<td class="bordered" colspan="2"></td>
				<td class="bordered">
					{{$tanggal}}
				</td>

				@for($i=1;$i<=8;$i++)
				<td class="bordered centered">{{$item_detail[$i] ?? ''}}</td>
				@endfor	
			</tr>
			@endforeach
		@endforeach
	</table>
</body>