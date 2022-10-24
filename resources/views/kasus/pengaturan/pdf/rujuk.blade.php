<head>
	<title>Print SEP</title>
</head>

<style type="text/css">
table {
	border-collapse: collapse;
	font-size: 12px;
}
</style>
<div style="position: absolute; left: 0; top: 0; width: 45%">
	<img src="{{asset('assets/app/kasus/bpjs/bpjs.png')}}" style="float: left; width: 70%; display: inline;">
</div>
<div style="position: absolute; right: 0; top: 0; width: 55%">
	<table style="width: 100vw">
		<tr>
			<td style="font-size: 13px; text-align: center;">SURAT RUJUKAN</td>
			<td style="font-size: 13px; text-align: center;">No. {{$rujuk->no_rujukan}}</td>			
		</tr>
		<tr>
			<td style="font-size: 13px; text-align: center;">{{config('app.name')}}</td>
			<td style="font-size: 13px; text-align: center;">{{$tanggal_rujuk}}</td>
		</tr>
	</table>
</div>
<div style="position: absolute; top: 35;">
	<table style="width: 100vw">
		<tr>
			<td style="width: 20%">Kepada Yth</td>
			<td style="width: 1%">:</td>
			<td style="width: 50%">{{$rujuk->nama_poli_rujukan}}<br>{{$rujuk->faskes}}</td>
			<td style="width: 29%"></td>
		</tr>
		<tr>
			<td colspan="3">Mohon Pemeriksaan dan Penanganan Lebih Lanjut :</td>
			<td>== @if($rujuk->tipe_rujuk == 0) Rujuk Penuh @elseif($rujuk->tipe_rujuk == 1) Rujuk Parsial @else Rujuk Balik @endif ==</td>
		</tr>
		<tr>
			<td>No.Kartu</td>
			<td>:</td>
			<td>{{$bpjs->no_bpjs or '-'}}</td>
			<td>@if($rujuk->jenis_rujuk == 1) Rawat Inap @else Rawat Jalan @endif</td>
		</tr>
		<tr>
			<td>Nama Peserta</td>
			<td>:</td>
			<td>{{$pasien->name or '-'}}</td>
		</tr>
		<tr>
			<td>Tgl Lahir</td>
			<td>:</td>
			<td>{{$tl or '-'}}</td>
		</tr>
		<tr>
			<td>Diagnosa</td>
			<td>:</td>
			<td>{{$rujuk->diagnosa}}</td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td>:</td>
			<td>{{$rujuk->catatan}}</td>
		</tr>
		<tr>
			<td colspan="3" style="font-size: 10px;">Demikian atas bantuannya, diucapkan terima kasih.</td>
		</tr>
		<tr>
			<td colspan="3" style="font-size: 10px;">*Rujukan Berlaku Sampai {{$tanggal_berlaku}}</td>
		</tr>
		<tr>
			<td colspan="3" style="font-size: 10px;">*Tgl Rencana Berkunjung {{$rencana_berkunjung}}</td>
		</tr>
	</table>
	<br>
	<table style="width: 100vw">
		<tr>
			<td style="text-align: center; width: 17%"></td>
			<td style="text-align: center; width: 28%"></td>
			<td style="text-align: center; width: 10%"></td>
			<td style="text-align: center; width: 28%">Pasien/Keluarga Pasien</td>
			<td style="text-align: center; width: 17%"></td>
		</tr>
		<tr style="padding: 50px;">
			<td colspan="5" style="font-size: 60px; color: white;">&nbsp;</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td style="color: white; border-bottom: 1px solid black"></td>
			<td></td>
		</tr>
	</table>
</div>