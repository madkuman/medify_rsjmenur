<head>
	<title>Hasil Pemeriksaan Laboratorium Klinik</title>
</head>

<style type="text/css">
	@page {
		padding-bottom: 85px;
	}
	table, th, td {
		border-collapse: collapse;

	}

	.small-col {
		width: 20%;
		background: red;
	}
	.big-col {
		width: 30%;
		background: blue;
	}
	.extra-big-col {
		width: 80%;
	}
	.table-warning, .table-warning>td, .table-warning>th {
		background-color: #dcff82;
	}
	.table-danger, .table-danger>td, .table-danger>th {
		background-color: #ed554c;
	}
	.text-center{
		text-align: center;
	}
	.text-left{
		text-align: left;
	}
	.hasil-pemeriksaan{
		border-collapse: collapse;
	}
	.hasil-pemeriksaan td{
		padding: 5px;
	}
	.hasil-pemeriksaan td{
		border-bottom: solid 1px #ccc;
	}
	hr
	{
		border: 1px solid #ccc;
	}
</style>
<body>
<table width="100%">
	<tr>
		<td width="20%" style="text-align: center;">
			<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="100">
		</td>
		<td width="60%" style="text-align: center; font-size: 17px;">
			<b>
				PEMERINTAH PROVINSI JAWA TIMUR<br>
				RUMAH SAKIT JIWA MENUR<br>
				Jln Menur No.120, Telp(031)5021635,5021637<br>
				Surabaya
			</b>
		</td>
		<td width="20%" style="text-align: center;">
			<img src="{{url('')}}/assets/img/menur.png" height="100">
		</td>
	</tr>
</table>
	<br>
	<hr>
	<table width="100%">
		<tr><td colspan="2" class="text-center"><h4>HASIL PEMERIKSAAN MIKROBIOLOGI</h4></td></tr>
		<tr>
			<td colspan="2">
				Telah dilakukan pemeriksaan kultur atas nama :
			</td>
		</tr>
		<tr>
			<td style="width:25%" >Nama</td>
			<td style="width:75%" >: {{$transaksi->pasien->name}}</td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td>: {{$transaksi->pasien->jenis_kelamin}}</td>
		</tr>
		<tr>
			<td>Usia</td>
			<td>: {{$transaksi->pasien->detailed_age}}</td>
		</tr>
		<tr>
			<td>No RM</td>
			<td>: {{$transaksi->pasien->no_rm}}</td>
		</tr>
		<tr>
			<td>Diagnosa</td>
			<td>: {{$transaksi->kasus->diagnosaUtama->icd10->code_icd ?? ''}} {{$transaksi->kasus->diagnosaUtama->icd10->long_desc}}</td>
		</tr>
		<tr>
			<td>DPJP</td>
			<td>: {{$transaksi->kasus->admin->user->name ?? ''}} </td>
		</tr>
		<tr>
			<td>Tgl Spesimen</td>
			<td>: 
				@if(!empty($transaksi->spesimen_terima_at))
				{{indonesian_date($transaksi->spesimen_terima_at)}}
				@endif
			</td>
		</tr>
		<tr>
			<td>Spesimen</td>
			<td>: 
				@foreach($transaksi->spesimen as $spesimen)
				{{$spesimen->spesimen->kategori->nama}} {{$spesimen->spesimen->nama}} 
				@if(!empty($spesimen->keterangan))
				: {{$spesimen->keterangan}}
				@endif
                 @if(!$loop->last), @endif
				@endforeach
			</td>
		</tr>
	</table>
	<br>
	@if(count($result_text) > 0)
	<div>
		<?php $current_head = null; ?>
		@foreach($result_text as $row)
		<div>
			<h4 style="text-transform: uppercase;margin-bottom: 5px">{{$row->parameter}}</h4>
			<span>{!! nl2br($row->value)!!}</span>
		</div>
		@endforeach
	</div>
	@endif
	<br><br>
	<table style="width: 100%;page-break-inside: avoid;">
		<tr>
			<td style="width: 60%"></td>
			<td class="text-center">Mengetahui</td>
		</tr>
		@php $now = Carbon\Carbon::now() @endphp
		<tr>
			<td style="width: 60%"></td>
			<td class="text-center">Surabaya, {{indonesian_date($now,'d F Y')}}</td>
		</tr>
		<tr>
			<td ></td>
			<td class="text-center">Penanggung Jawab Laboratorium</td>
		</tr>

		@php $ttd = $transaksi->verificator->ttd ?? '' @endphp
		@if(!empty($ttd) && !empty($transaksi->verified_at))
		<tr>
			<td ></td>
			<td class="text-center">
				<img src="{{$ttd ?? '-'}}" height="50px">
			</td>
		</tr>
		<tr>
			<td></td>
			<td class="text-center" style="font-weight: 600">{{$transaksi->verificator->name ?? ''}}</td>
		</tr>
		@else
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td></td>
			<td class="text-center" style="font-weight: 600"></td>
		</tr>
		@endif
	</table>
	<script type="text/php">
		if ( isset($pdf) ) 
		{
			$x = 500;
			$y = 800;
			$text = "Halaman {PAGE_NUM} of {PAGE_COUNT}";
			$font = $fontMetrics->get_font("Arial", "bold");
			$size = 11;
			$color = array(0,0,0);
			$word_space = 0.0;  //  default
			$char_space = 0.0;  //  default
			$angle = 0.0;   //  default
			$pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);

			$x = 30;
			$y = 800;
			$text = "Dicetak pada ".date('d-m-Y h:i', time());
			$font = $fontMetrics->get_font("Arial", "bold");
			$size = 11;
			$color = array(0,0,0);
			$word_space = 0.0;  //  default
			$char_space = 0.0;  //  default
			$angle = 0.0;   //  default
			$pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
		}
	</script>
</body>