<head>
	<title>Surat Keterangan Dokter</title>
	<style type="text/css">
	body{
		font-family: sans-serif;
		font-size: 14px;
		padding: 15px;
	}
	table{
		border-collapse: collapse;
		width: 100vw;
	}
	.bordered{
		border: 1px solid black;
	}
	.border-bot{
		border-bottom: 1px solid black;
	}
	.centered{
		text-align: center;
		vertical-align: top;
	}
	.va-top{
		vertical-align: top;
	}
	.indent{
		text-indent: 50px;
	}
	.dummy{
		color: white;
		font-size: 45px;
	}
	.gap{
		line-height: 170%;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td width="37%" class="centered">{{config('app.name')}}</td>
			<td width="63%"></td>
		</tr>
	</table>
	<br>
	<br>
	<table>
		<tr>
			<td class="centered gap">SURAT KETERANGAN DOKTER</td>
		</tr>
		<tr>
			<td class="centered gap">{{$nomor_surat}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="indent">Yang bertanda tangan dibawah ini, dokter {{config('app.name')}} menerangkan dengan sesungguhnya, pada hari ini telah memeriksa kesehatan dari :</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="10%" class="gap"></td>
			<td width="19%" class="gap va-top">Nama</td>
			<td width="2%" class="gap va-top">:</td>
			<td width="69%" class="gap va-top">{{$identitas->nama}}</td>
		</tr>
		<tr>
			<td class="gap"></td>
			<td class="gap va-top">Umur</td>
			<td class="gap va-top">:</td>
			<td class="gap va-top">{{$identitas->age_year}} Tahun</td>
		</tr>
		<tr>
			<td class="gap"></td>
			<td class="gap va-top">Pangkat/Gol.</td>
			<td class="gap va-top">:</td>
			<td class="gap va-top">@if(!empty($pasien->tni_pangkat_singkat)) {{$pasien->tni_pangkat_singkat}} @else - @endif &nbsp;&nbsp;&nbsp; @if(!empty($pasien->tni_nrp)) NRP. {{$pasien->tni_nrp}} @endif</td>
		</tr>
		<tr>
			<td class="gap"></td>
			<td class="gap va-top">Kesatuan/Satker</td>
			<td class="gap va-top">:</td>
			<td class="gap va-top">@if(!empty($pasien->tni_satker_id)) {{$pasien->tni_satker->nama}} @else - @endif</td>
		</tr>
		<tr>
			<td class="gap"></td>
			<td class="gap va-top">Keperluan</td>
			<td class="gap va-top">:</td>
			<td class="gap va-top">{{$keperluan}}</td>
		</tr>
		<tr>
			<td class="gap"></td>
			<td class="gap va-top">Hasil Pemeriksaan</td>
			<td class="gap va-top">:</td>
			<td class="gap va-top">
				{!!nl2br($resume->resume ?? '')!!}
			</td>
		</tr>
	</table>
	<br><br><br>
	<table>
		<tr>
			<td class="centered"><u>STATUS KESEHATAN</u></td>
		</tr>
	</table>
	<br>
	<table class="bordered" style="width: 80%; margin: 0 auto;">
		<tr>
			<td width="15%" class="bordered centered">Tgl. Lahir</td>
			<td width="7%" class="bordered centered">U</td>
			<td width="7%" class="bordered centered">A</td>
			<td width="7%" class="bordered centered">B</td>
			<td width="7%" class="bordered centered">D</td>
			<td width="7%" class="bordered centered">L</td>
			<td width="7%" class="bordered centered">G</td>
			<td width="7%" class="bordered centered">J</td>
			<td width="16%" class="bordered centered">Stakes</td>
		</tr>
		<tr>
			<td class="bordered centered">15-06-1981</td>
			<td class="bordered centered">{{$resume->u}}</td>
			<td class="bordered centered">{{$resume->a}}</td>
			<td class="bordered centered">{{$resume->b}}</td>
			<td class="bordered centered">{{$resume->d}}</td>
			<td class="bordered centered">{{$resume->l}}</td>
			<td class="bordered centered">{{$resume->g}}</td>
			<td class="bordered centered">{{$resume->j}}</td>
			<td class="bordered centered">{{$resume->stakes}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="indent">Demikian yang berwenang memakluminya.</td>
		</tr>
	</table>
	<br><br><br>
	<table>
		<tr>
			<!-- if TTD 1 -->
			<!-- <td width="40%" class="centered"></td> -->
			<!-- else -->
			<td width="47%" class="centered">
				@if(!empty($dokter2))
				Mengetahui :
				@endif
			</td>
			<!-- endif -->
			<td width="6%"></td>
			<td width="47%" class="centered">Surabaya, {{$sekarang}}</td>
		</tr>
		<tr>
			<!-- if TTD 1 -->
			<!-- <td></td> -->
			<!-- else -->
			<td class="centered">
				@if(!empty($dokter2))
				{!!nl2br($dokter2->sebagai)!!}
				@endif
			</td>
			<!-- endif -->
			<td></td>
			<td class="centered">{!!nl2br($dokter->sebagai ?? '')!!}</td>
		</tr>
		<tr>
			<td colspan="3" class="dummy">dummy</td>
		</tr>
		<tr>
			<!-- if TTD 1 -->
			<!-- <td></td> -->
			<!-- else -->
			<td class="centered">
				@if(!empty($dokter2))
				{{$dokter2->nama}}
				@endif
			</td>
			<!-- endif -->
			<td></td>
			<td class="centered">{{$dokter->nama}}</td>
		</tr>
		<tr>
			<!-- if TTD 1 -->
			<!-- <td></td> -->
			<!-- else -->
			<td class="centered">
				@if(!empty($dokter2))
				{!!nl2br($dokter2->keterangan)!!}
				@endif
			</td>
			<!-- endif -->
			<td></td>
			<td class="centered">{!!nl2br($dokter->keterangan ?? '')!!}</td>
		</tr>
	</table>
</body>