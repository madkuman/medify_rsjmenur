<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Panss Remisi</title>
   <style>
      body, p {
			font-size: 14px;
			font-family: Arial, Helvetica, sans-serif;
		}
      .bordered {
         border: 1px solid black;
         border-collapse: collapse;
      }
      .bordered td{
			vertical-align: top !important;
			padding-left: 5px;
			padding-right: 5px; 
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
      p {
			line-height: 0.3;
		}
   </style>
</head>
<body>
   <table width="100%">
		<tr>
			<td width="33%" valign="top">
				<table width="100%">
					<tr>
						<td width="15%" style="text-align: left">
							<img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="40">
						</td>
						<td width="63%" style="text-align: center">
							<p style="font-size: 11px;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
							<p style="font-size: 13px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
							<p style="font-size: 9px;"><b>Jln. Menur No. 120, Telp. (031) 5021635, 5021637</b></p>
							<p style="font-size: 11px;"><b>S U R A B A Y A</b></p>
						</td>
						<td width="17%" style="text-align: left">
							<img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="40">
						</td>
					</tr>
				</table>
			</td>
			<td width="33%" style="text-align: center">
				<br>
				<b style="font-size: 15px;">LEMBAR PENILAIAN PANSS REMISI</b>
			</td>
         <td width="33%" style="text-align: right"></td>
		</tr>
	</table>

   <table width="100%">	
		<tr>
			<td width="70%">Nama Pasien: {{ $kasus->identitas->nama ?? '.........................................' }}, Tgl Lahir/Umur: {{ date("d/m/Y", strtotime($kasus->identitas->tanggal_lahir)) ?? '.........................................' }} / {{$kasus->identitas->umur ?? '.........................................'}} Tahun</td>			
			<td width="30%" class="text-right"> No. Rekam Medis: {{ join("-", str_split($kasus->pasien->no_rm, 2)) }}</td>
		</tr>
	</table>

   <table width="100%" class="bordered">
      <thead>
			<tr>
				<th width="5%">No</th>
				<th width="19%">Positive and Negative Syndromes Scale</th>
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
				<td style="text-align: center">@if($loop->iteration<9){{$loop->iteration}}@endif</td>
				@for($i=0;$i<18;$i++)				
				<td>{{$item[$i]}}</td>
				@endfor
			</tr>
			@endforeach
		</tbody>
   </table>
</body>
</html>