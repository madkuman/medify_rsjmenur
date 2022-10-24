<!DOCTYPE html>
<html>
<style type="text/css">
html{
	padding: 0%;
	height: 100%;
}
body{
	font-size: 14px;
	height: 100%;
	font-family: sans-serif;
}
table{
	border-collapse: collapse;
	width: 100%;
}
td{
	vertical-align: middle;
}
.bordered{
	border: 1px solid black;
}

.table-title{
	padding-bottom: 5px;
	padding-top: 5px;
}
.bottom-border{
	border-bottom: 1px solid black;
}
.centered{
	text-align: center;
}
.righted{
	text-align: right;
}
.no-bottom{
	border-top: none;
	border-left: 1px solid black;
	border-right: 1px solid black;
	border-bottom: none;
}
.title{
	font-size: 16px;
}
.orange-col{
	background-color: #ffc266;
}
.grey-col{
	background-color: #eaeae1;
}
.blue-col{
	background-color: #b3ffff;
}


</style>
<head>
	<title>Laporan Remunerasi Pegawai</title>
</head>
<body>
	<table width="100%">
	<tr>
		<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
	</tr>
</table>
	<br><br>
	<table>
		<tr>
			<td class="centered title"> <b> DAFTAR PENERIMAAN UANG JASA PELAYANAN PEGAWAI </b></td>
		</tr>
		<tr>
			<td class="centered title"> <b> PERIODE BULAN {{strtoupper(Date::parse($date)->format('F'))}} TAHUN {{Date::parse($date)->format('Y')}} </b></td>
		</tr>
	</table>
	<br>
	<table class="bordered"  width="100%" >
		<tr>
			<th width="3%" class="centered bordered"><b>No</b></th>
			<th width="10%" class="centered bordered"><b>Nama</b></th>
			<th width="10%" class="centered bordered"><b>Rekening Bank</b></th>

			<th width="5%" class="centered bordered" colspan="2"><b>Golongan</b></th>
			<th width="5%" class="centered bordered" colspan="2"><b>Pendidikan</b></th>
			<th width="5%" class="centered bordered" colspan="2"><b>Jabatan</b></th>
			<th width="5%" class="centered bordered" colspan="2"><b>Status</b></th>
			<th width="5%" class="centered bordered" colspan="2"><b>KA</b></th>
			<th width="5%" class="centered bordered" colspan="2"><b>Beban Kerja</b></th>
			<th width="5%" class="centered bordered" colspan="2"><b>Resiko Kerja</b></th>
			<th width="5%" class="centered bordered" colspan="2"><b>Masa Kerja</b></th>
			<th width="5%" class="centered bordered"><b>Index Pajak</b></th>


			<th width="9%" class="centered bordered"><b>Jasa Pelayanan</b></th>
			<th width="9%" class="centered bordered"><b>Pelayanan Tambahan</b></th>
            <th width="9%" class="centered bordered"><b>Potongan</b></th>
            <th width="15%" class="centered bordered"><b>Terima Bersih</b></th>
		</tr>
		@foreach($data as $item)
		<tr>
			<td class="bordered centered">{{$item['nomer']}}</td>
			<td class="bordered">{{$item['pegawai']}}</td>
			<td class="bordered">{{$item['rekening']}}</td>

			<td class="centered bordered">{{$item['golongan']}}</td>
			<td class="centered bordered">{{$item['index_golongan']}}</td>
			<td class="centered bordered">{{$item['pendidikan']}}</td>
			<td class="centered bordered">{{$item['index_pendidikan']}}</td>
			<td class="centered bordered">{{$item['jabatan']}}</td>
			<td class="centered bordered">{{$item['index_jabatan']}}</td>
			<td class="centered bordered">{{$item['status']}}</td>
			<td class="centered bordered">{{$item['index_status']}}</td>
			<td class="centered bordered">{{$item['pangkat']}}</td>
			<td class="centered bordered">{{$item['index_pangkat']}}</td>
			<td class="centered bordered">{{$item['beban_kerja']}}</td>
			<td class="centered bordered">{{$item['index_beban']}}</td>
			<td class="centered bordered">{{$item['resiko_kerja']}}</td>
			<td class="centered bordered">{{$item['index_resiko']}}</td>
			<td class="centered bordered">{{$item['masa_kerja']}}</td>
			<td class="centered bordered">{{$item['index_masa_kerja']}}</td>
			<td class="centered bordered">{{$item['index_pajak']}}</td>

			<td class="bordered righted">{{$item['jasa_pelayanan']}}</td>
			<td class="bordered righted">{{$item['pelayanan_tambahan']}}</td>
			<td class="bordered righted">{{$item['potongan']}}</td>
            <td class="bordered righted">{{$item['total']}}</td>
		</tr>
		@endforeach
	</table>
	<br>
		{{-- @include('kepegawaian.laporan.hasil.components.ttd') --}}
</body>
</html>