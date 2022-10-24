<head>
	<title>Print SEP</title>
</head>

<style type="text/css">
@page{
	/*margin: 0;*/
	size: 16cm 16cm;
}


table {
	border-collapse: collapse;
	font-size: 14px;
	line-height: 200%;
	width: 100%
}
.text-light{
	color: white;
}

.outer{
	font-family: sans-serif;
}
</style>

<div class="outer">
	<table>
		<tr>
			<td width="80%">{{$bpjs->no_sep or '-'}}</td>
			<td width="20%"></td>
		</tr>
		<tr>
			<td>{{$tanggal or '-'}}</td>
			<td></td>
		</tr>
		<tr>
			<td>{{$bpjs->no_bpjs or '-'}}</td>
			<td></td>
		</tr>
		<tr>
			<td>{{$pasien->name or '-'}}</td>
			<td></td>
		</tr>
		<tr>
			<td>{{$tl or '-'}}</td>
			<td>@if($bpjs->jenis_pelayanan == 2) Rawat Jalan @elseif($bpjs->jenis_pelayanan == 1) Rawat Inap @else - @endif</td>
		</tr>
		<tr>
			<td>{{$pasien->jeniskelamin or '-'}}</td>
			<td>{{$bpjs->kelas_rawat or '-'}}</td>
		</tr>
		<tr>
			<td>{{$poli->name or '-'}}</td>
			<td></td>
		</tr>
		<tr>
			<td>{{$bpjs->diagnosa_awal or '-'}}</td>
			<td></td>
		</tr>
		<tr>
			<td>{{$bpjs->catatan}}</td>
			<td></td>
		</tr>
	</table>
</div>