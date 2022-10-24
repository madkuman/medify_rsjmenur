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
	.title{
		font-size: 17px;
		font-weight: 600;
	}
	.space{
		color: white;
	}
	.justify-text{
		text-align: justify;
	}
	.ml-30{
		margin-left: 3px; 
	}
	#watermark {
		position: fixed;

          z-index:  -1000;
          opacity: 0.05;
          top: 200px;
          left:5%;
     }
</style>
</head>
<body>
	<div id="watermark">
		<img src="{{asset(config('app.kop_lg'))}}" width="90%">
	</div>
	<div class="ml-30">
		<img src="{{asset(config('app.kop_sm'))}}" height="25px">
	</div>
	<div style="position: absolute; right: 0; top: 22; width: 90%">
		<table>
			<tr>
				<td class="centered title">{{config('app.name')}}</td>
			</tr>
		</table>
	</div>
	<br><hr><br>
	<table>
		<tr>
			<td class="centered">SURAT KETERANGAN PEMERIKSAAN KESEHATAN JIWA</td>
		</tr>
		<tr>
			<td class="centered">Nomor : {{$nomor_surat}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td colspan="3">Yang bertanda tangan dibawah ini :</td>
		</tr>
		<tr>
			<td class="va-top" width="20%">Nama</td>
			<td class="va-top" width="2%">:</td>
			<td class="va-top" width="78%">{{$nama_ttd}}</td>
		</tr>
		<tr>
			<td class="va-top">No.SIPDS</td>
			<td class="va-top">:</td>
			<td class="va-top">{{$sipds_ttd}}</td>
		</tr>
		<tr>
			<td class="va-top">Jabatan</td>
			<td class="va-top">:</td>
			<td class="va-top">{{$jabatan_ttd}}</td>
		</tr>
		<tr>
			<td class="va-top">Instansi</td>
			<td class="va-top">:</td>
			<td class="va-top">{{$instansi_ttd}}</td>
		</tr>
		<tr>
			<td colspan="3" class="space">space</td>
		</tr>
		<tr>
			<td colspan="3"> Telah melakukan pemeriksaan psikiatrik pada tanggal {{$tanggal_pemeriksaan_format_ind}}, terhadap :</td>
		</tr>
		<tr>
			<td class="va-top">Nama</td>
			<td class="va-top">:</td>
			<td class="va-top">{{$identitas->nama}}</td>
		</tr>
		<tr>
			<td class="va-top">Tempat/Tanggal Lahir</td>
			<td class="va-top">:</td>
			<td class="va-top">{{$identitas->tempat_lahir}}, {{$tgl_lahir}}</td>
		</tr>
		<tr>
			<td class="va-top">No. KTP / ID</td>
			<td class="va-top">:</td>
			<td class="va-top">{{$pasien->no_identitas}}</td>
		</tr>
		<tr>
			<td class="va-top">Pendidikan</td>
			<td class="va-top">:</td>
			<td class="va-top">{{$pasien->pendidikan->nama}}</td>
		</tr>
		<tr>
			<td class="va-top">Status Pernikahan</td>
			<td class="va-top">:</td>
			<td class="va-top">
				@if($pasien->marriage == 1)
				Belum Menikah
				@elseif($pasien->marriage == 2)
				Menikah
				@else
				Duda/Janda
				@endif
			</td>
		</tr>
		<tr>
			<td class="va-top">Agama</td>
			<td class="va-top">:</td>
			<td class="va-top">{{$pasien->agama->nama}}</td>
		</tr>
		<tr>
			<td class="va-top">Alamat</td>
			<td class="va-top">:</td>
			<td class="va-top">{{$pasien->address}}</td>
		</tr>
	</table>
	<br>
	<br>
	<table>
		<tr>
			<td class="justify-text">Dengan hasil pemeriksaan kesehatan jiwa (test MMPI-2, Observasi dan Wawancara Psikiatri) pada saat ini :</td>
		</tr>
	</table>
	<table>
		<tr>
			<td>
				{!!nl2br($resume->jiwa ?? '')!!}
			</td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td width="50%"></td>
			<td class="centered" width="50%">Surabaya, {{$tanggal_surat_format_ind}}</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">Dokter yang memeriksa,</td>
		</tr>
		<tr>
			<td colspan="2" class="dummy">dummy</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">{{$nama_ttd}}</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">{{$keterangan_ttd}}</td>
		</tr>
	</table>
</body>