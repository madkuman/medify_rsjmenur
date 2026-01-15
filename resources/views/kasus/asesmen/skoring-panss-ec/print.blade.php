<!DOCTYPE html>
<html>
<head>
	<title>Skoring PANSS EC</title>
	<style type="text/css">
		body, p {
			font-size: 12px;
			font-family: Arial, Helvetica, sans-serif;
		}
		p {
			line-height: 0.3;
		}
		table{
			width: 100%
		}
		table.bordered {
			border-collapse: collapse;
		}
		table.bordered, .bordered th, .bordered td {
			border: 1px solid black;
		}
		table.bordered, .bordered th, .bordered td.has-border {
			border: 1px solid black;
		}
		.bordered td{
			vertical-align: top !important;
			padding-left: 5px;
			padding-right: 5px; 
		}
		.border{
			border: 1px solid black;
		}
		.borderv2{
			width: fit-content;
			border: solid black 1px;
			padding:10px;
		}
		.noBorder {
			border: 1px solid white !important;
			vertical-align: top
		}
		.mx-5 td{
			margin-left: 5px !important;
			margin-right: 5px !important;
		}
		.fixed{
			width: 30px !important;
			overflow: hidden;
			white-space: nowrap;
		}
		.big {
			font-weight: bold;
		}
		.pagenum:before {
			content: counter(page);			
		}
		.text-right {
			text-align: right;
		}
		.text-center {
			text-align: center;
		}
		.text-left {
			text-align: left;
		}
	</style>
</head>
<body>
	<table width="100%">
		<tr>
			<td width="90%"></td>
			<td width="10%" align="center" class="border">RM. 07</td>
        <tr>
			<td width="90%"></td>
            <td width="10%" align="center" class="border">Halaman 1/1</td>
        </tr>
    </table>
	<table width="100%">
		<tr>
			<td width="33%" valign="top">
				<table width="100%">
					<tr>
						<td width="15%" align="left">
							<img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="40">
						</td>
						<td width="63%" align="center">
							<p style="font-size: 11px;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
							<p style="font-size: 13px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
							<p style="font-size: 9px;"><b>Jln. Menur No. 120, Telp. (031) 5021635, 5021637</b></p>
							<p style="font-size: 11px;"><b>S U R A B A Y A</b></p>
						</td>
						<td width="17%" align="left">
							<img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="40">
						</td>
					</tr>
				</table>
			</td>
			<td width="33%" align="center">
				<br>
				<b style="font-size: 15px;">LEMBAR PENILAIAN PENSS EC</b>
			</td>
			<td width="33%" align="right">					
					{{-- <p class="borderv2 text-center">RM. 07</p>							
					<p class="borderv2 text-center">Halaman 1/1</p>				 --}}
			</td>
		</tr>
	</table>
	<table width="100%">	
		<tr>
			<td width="70%">Nama Pasien: {{ $kasus->identitas->nama ?? '.........................................' }}, Tgl Lahir/Umur: {{ date("d/m/Y", strtotime($kasus->identitas->tanggal_lahir)) ?? '.........................................' }} / {{$kasus->identitas->umur ?? '.........................................'}} Tahun</td>			
			<td width="30%" class="text-right"> No. Rekam Medis: {{ join("-", str_split($kasus->pasien->no_rm, 2)) }}:</td>
		</tr>
	</table>
	<table class="bordered" width="100%">
		<thead>
			<tr>
				<th width="5%">No</th>
				<th width="19%">Uraian</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
				<th>Skor</th>
			</tr>
		</thead>
		<tbody>
			@foreach($all_data as $item)
			<tr>
				<td class="text-center">@if($loop->iteration<6){{$loop->iteration}}@endif</td>
				@for($i=0;$i<18;$i++)				
				<td class="@if($loop->iteration > 5 && $i == 0) {big} @endif">{{$item[$i]}}</td>
				@endfor
			</tr>
			@endforeach
			<tr>
				<td></td>
				<td class="text-center"><b class="text-center">Paraf</b></td>
				@for($i=0;$i<17;$i++)
				<td class="text-center"></td>
				@endfor
			</tr>
		</tbody>
	</table>
	<br>
	<span>Hasil Penilaian PANSS EC  menjadi panduan dalam transfer pasien dalam kondisi:</span>
	<br>
	<span>1. Indikasi masuk unit intensif bila nilai PANSS EC Lebih dari 20</span>
	<br>
	<span>2. Indikasi masuk unit Perawatan Maintenence bila nilai PANSS EC Kurang dari 20</span>
	<br>
	<span>3. Indikasi masuk unit Rehabilitasi bila nilai PANSS EC Kurang dari 20</span>
</body>
</html>