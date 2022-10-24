<head>
	<title>Print SEP</title>
	<style type="text/css">
	table {
		border-collapse: collapse;
		font-size: 14px;
		line-height: 150%;
		white-space: nowrap;
	}
	.text-light{
		color: black;
	}
	@page{
		margin-top: 20px;
	}
	.watermark{
		position:absolute;
		top:100px;
		left:150px;
		opacity:0.2;
		z-index:99;
		font-size: 130px;
		font-weight: bold;
	}
</style>
</head>


<body style="margin-top: 0px">
	<div class="halaman_1" style="page-break-after: always;">
		<div style="position: absolute; top: 10" id="logobpjspanjang">
			<img src="{{url('assets/img')}}/logobpjspanjang.png" style="height: 30px">
		</div>
		<div style="position: absolute; top: 5; left: 180;">
			<span>SURAT ELEGIBILITAS PESERTA <br> {{config('app.name')}}</span>
		</div>

		<div style="font-family: sans-serif; margin-top: 55px; margin-left: 23px;">
			<div style="position: absolute; top: 0;">
				<table style="width: 100%">
					<tr>
						<td class="text-light" style="width: 20%">No.SEP</td>
						<td style="width: 1%" class="text-light">:</td>
						<td style="width: 79%;">{{$bpjs_real->noSep ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Tgl.SEP</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->tglSep ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">No.Kartu</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->peserta->noKartu ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Nama Peserta</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->peserta->nama ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Tgl Lahir</td>
						<td class="text-light">:</td>
						@php 
						$tgl_lahir = implode("-", array_reverse(explode("-", $bpjs_real->peserta->tglLahir)));
						@endphp
						<td>{{$tgl_lahir ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Jenis Kelamin</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->peserta->kelamin ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Poli Tujuan</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->poli ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Diagnosa Awal</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->diagnosa ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Catatan</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->catatan}}</td>
					</tr>
					<tr>
						<td colspan="3" style="color: white; font-size: 6px;">.</td>
					</tr>
					<tr>
						<td class="text-light" colspan="3" style="font-size: 10px;">*SEP bukan sebagai bukti penjamin peserta</td>
					</tr>
				</table>
			</div>
			<div style="position: absolute; top: 51; left: 290;">
				<table style="width: 100vw">
					<tr>
						<td class="text-light" style="width: 25%">Jenis Rawat</td>
						<td style="width: 4%" class="text-light">:</td>
						<td style="width: 31%">{{$bpjs_real->peserta->jnsPeserta ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light" style="width: 25%">Jenis Rawat</td>
						<td style="width: 4%" class="text-light">:</td>
						<td style="width: 31%">{{$bpjs_real->jnsPelayanan ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Kelas Rawat</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->kelasRawat ?? '-'}}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="halaman_2" style="page-break-after: always;">
		<div class="watermark">COPY</div>
		<div style="position: absolute; top: 10" id="logobpjspanjang">
			<img src="{{url('assets/img')}}/logobpjspanjang.png" style="height: 30px">
		</div>
		<div style="position: absolute; top: 5; left: 180;">
			<span>SURAT ELEGIBILITAS PESERTA <br> {{config('app.name')}}</span>
		</div>

		<div style="font-family: sans-serif; margin-top: 55px; margin-left: 23px;">
			<div style="position: absolute; top: 0;">
				<table style="width: 100%">
					<tr>
						<td class="text-light" style="width: 20%">No.SEP</td>
						<td style="width: 1%" class="text-light">:</td>
						<td style="width: 79%;">{{$bpjs_real->noSep ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Tgl.SEP</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->tglSep ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">No.Kartu</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->peserta->noKartu ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Nama Peserta</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->peserta->nama ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Tgl Lahir</td>
						<td class="text-light">:</td>
						@php 
						$tgl_lahir = implode("-", array_reverse(explode("-", $bpjs_real->peserta->tglLahir)));
						@endphp
						<td>{{$tgl_lahir ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Jenis Kelamin</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->peserta->kelamin ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Poli Tujuan</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->poli ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Diagnosa Awal</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->diagnosa ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Catatan</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->catatan}}</td>
					</tr>
					<tr>
						<td colspan="3" style="color: white; font-size: 6px;">.</td>
					</tr>
					<tr>
						<td class="text-light" colspan="3" style="font-size: 10px;">*SEP bukan sebagai bukti penjamin peserta</td>
					</tr>
				</table>
			</div>
			<div style="position: absolute; top: 51; left: 290;">
				<table style="width: 100vw">
					<tr>
						<td class="text-light" style="width: 25%">Jenis Rawat</td>
						<td style="width: 4%" class="text-light">:</td>
						<td style="width: 31%">{{$bpjs_real->peserta->jnsPeserta ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light" style="width: 25%">Jenis Rawat</td>
						<td style="width: 4%" class="text-light">:</td>
						<td style="width: 31%">{{$bpjs_real->jnsPelayanan ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Kelas Rawat</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->kelasRawat ?? '-'}}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="halaman_3" style="">
		<div class="watermark">COPY</div>
		<div style="position: absolute; top: 10" id="logobpjspanjang">
			<img src="{{url('assets/img')}}/logobpjspanjang.png" style="height: 30px">
		</div>
		<div style="position: absolute; top: 5; left: 180;">
			<span>SURAT ELEGIBILITAS PESERTA <br> {{config('app.name')}}</span>
		</div>

		<div style="font-family: sans-serif; margin-top: 55px; margin-left: 23px;">
			<div style="position: absolute; top: 0;">
				<table style="width: 100%">
					<tr>
						<td class="text-light" style="width: 20%">No.SEP</td>
						<td style="width: 1%" class="text-light">:</td>
						<td style="width: 79%;">{{$bpjs_real->noSep ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Tgl.SEP</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->tglSep ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">No.Kartu</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->peserta->noKartu ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Nama Peserta</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->peserta->nama ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Tgl Lahir</td>
						<td class="text-light">:</td>
						@php 
						$tgl_lahir = implode("-", array_reverse(explode("-", $bpjs_real->peserta->tglLahir)));
						@endphp
						<td>{{$tgl_lahir ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Jenis Kelamin</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->peserta->kelamin ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Poli Tujuan</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->poli ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Diagnosa Awal</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->diagnosa ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Catatan</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->catatan}}</td>
					</tr>
					<tr>
						<td colspan="3" style="color: white; font-size: 6px;">.</td>
					</tr>
					<tr>
						<td class="text-light" colspan="3" style="font-size: 10px;">*SEP bukan sebagai bukti penjamin peserta</td>
					</tr>
				</table>
			</div>
			<div style="position: absolute; top: 51; left: 290;">
				<table style="width: 100vw">
					<tr>
						<td class="text-light" style="width: 25%">Jenis Rawat</td>
						<td style="width: 4%" class="text-light">:</td>
						<td style="width: 31%">{{$bpjs_real->peserta->jnsPeserta ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light" style="width: 25%">Jenis Rawat</td>
						<td style="width: 4%" class="text-light">:</td>
						<td style="width: 31%">{{$bpjs_real->jnsPelayanan ?? '-'}}</td>
					</tr>
					<tr>
						<td class="text-light">Kelas Rawat</td>
						<td class="text-light">:</td>
						<td>{{$bpjs_real->kelasRawat ?? '-'}}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>