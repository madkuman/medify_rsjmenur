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
	<title>Daftar Pegawai Keluar & Masuk</title>
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
			<td class="centered title"> <b> Daftar Pegawai Masuk </b></td>
		</tr>
		<tr>
			<td class="centered title"><b>Bulan {{$kop_bulan}}</b></td>
		</tr>
	</table>
	<br>

	<table class="bordered">
		<tr>
			<th width="5%" class="centered bordered"><b>No</b></th>
			<th width="20%" class="centered bordered"><b>Nama</b></th>
			<th width="20%" class="centered bordered"><b>Pangkat</th>
			<th width="20%" class="centered bordered"><b>Jenis</th>
			<th width="10%" class="centered bordered"><b>NRP</b></th>
			<th width="15%" class="centered bordered"><b>Tgl Masuk</b></th>
		</tr>
		{{-- <tr>
			<td class="centered bordered">1</td>
			<td class="centered bordered">2</td>
			<td class="centered bordered">3</td>
			<td class="centered bordered">4</td>
			<td class="centered bordered">5</td>
		</tr> --}}
		@if (count($pegawai_masuk) == 0)
			<tr>
				<td class="centered bordered" colspan="6"><b>Tidak Ada Data</b></td>
			</tr>
		@else
		@php $i = 1; @endphp
		@foreach($pegawai_masuk as $item)
		<tr>
			<td class="centered no-bottom bordered">{{$i}}</td>
			<td class="no-bottom bordered">{{$item->name}}</td>
			<td class="no-bottom centered bordered">{{empty($item->masterPangkat->nama) ? '-' : $item->masterPangkat->nama}}</td>
			<td class="no-bottom centered bordered">{{empty($item->masterJenisPegawai->nama) ? '-' : $item->masterJenisPegawai->nama}}</td>
			<td class="no-bottom bordered">{{$item->nrp}}</td>
			<td class="no-bottom bordered centered">{{Date::parse($item->tmt)->format('d F Y')}}</td>
		</tr>
		@php $i++; @endphp
		@endforeach
		@endif
	</table>

	<br><br>
	<pagebreak></pagebreak>
	<table>
		<tr>
			<td class="centered title"><b>Daftar Pegawai Keluar</b></td>
		</tr>
		<tr>
			<td class="centered title"><b>Bulan {{$kop_bulan}}</b></td>
		</tr>
	</table>
	<br>

	<table class="bordered">
		<tr>
			<th width="5%" class="centered bordered"><b>No</b></th>
			<th width="20%" class="centered bordered"><b>Nama</b></th>
			<th width="20%" class="centered bordered"><b>Pangkat</th>
			<th width="20%" class="centered bordered"><b>Jenis</th>
			<th width="10%" class="centered bordered"><b>NRP</b></th>
			<th width="15%" class="centered bordered"><b>Tgl Keluar</b></th>
		</tr>
		{{-- <tr>
			<td class="centered bordered">1</td>
			<td class="centered bordered">2</td>
			<td class="centered bordered">3</td>
			<td class="centered bordered">4</td>
			<td class="centered bordered">5</td>
		</tr> --}}
		@if (count($pegawai_keluar) == 0)
			<tr>
				<td class="centered bordered" colspan="6"><b>Tidak Ada Data</b></td>
			</tr>
		@else
			
		@php $i = 1; @endphp
		@foreach($pegawai_keluar as $item)
		<tr>
			<td class="centered no-bottom bordered">{{$i}}</td>
			<td class="no-bottom bordered">{{$item->name}}</td>
			<td class="no-bottom centered bordered">{{empty($item->masterPangkat->nama) ? '-' : $item->masterPangkat->nama}}</td>
			<td class="no-bottom centered bordered">{{empty($item->masterJenisPegawai->nama) ? '-' : $item->masterJenisPegawai->nama}}</td>
			<td class="no-bottom bordered">{{$item->nrp}}</td>
			<td class="no-bottom bordered">{{Date::parse($item->tmt_out)->format('d F Y')}}</td>
		</tr>
		@php $i++; @endphp
		@endforeach
		@endif
	</table>
	<br>

	@include('kepegawaian.laporan.hasil.components.ttd')
</body>
</html>