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


</style>
<head>
	<title>Daftar Susunan Personel</title>
</head>
<body>
	<table>
		<tr>
			<td width="23%" class="centered">{{config('app.name')}}</td>
			<td width="70%" class="centered"></td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td class="centered">DAFTAR SUSUNAN PERONEL ( DSP ) {{config('app.name')}}</td>
		</tr>
		<tr>
			<td class="centered">Bulan {{$date}}</td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<th width="5%" class="centered bordered"><b>No</b></th>
			<th width="10%" class="centered bordered"><b>Jabatan</b></th>
			<th width="5%" class="centered bordered"><b>Pangkat</b></th>
			<th width="5%" class="centered bordered"><b>Korps</b></th>
			<th width="5%" class="centered bordered"><b>Kejur</b></th>
			<th width="15%" class="centered bordered"><b>Nama</b></th>
			<th width="7%" class="centered bordered"><b>Pangkat Korp</b></th>
			<th width="8%" class="centered bordered"><b>NRP</b></th>
			<th width="20%" class="centered bordered"><b>ST Kasal<br>SP Satuan</b></th>
			<th width="20%" class="centered bordered"><b>Jabatan Internal<br>SP Internal</b></b></th>
		</tr>
		<tr>
			<td class="centered bordered">1</td>
			<td class="centered bordered">2</td>
			<td class="centered bordered">3</td>
			<td class="centered bordered">4</td>
			<td class="centered bordered">5</td>
			<td class="centered bordered">6</td>
			<td class="centered bordered">7</td>
			<td class="centered bordered">8</td>
			<td class="centered bordered">9</td>
			<td class="centered bordered">10</td>
		</tr>
		@php $i = 1 @endphp
		@foreach($data as $item)
		<tr>
			<td class="centered no-bottom">{{$i}}</td>
			@if(!is_null($item->employee_id))
            <td class="no-bottom">{{$item->jabatan}}</td>
            @else
            <td class="no-bottom" style="color: red">{{$item->jabatan}}</td>
            @endif
			<td class="no-bottom">{{$item->pkt1}}</td>
			<td class="no-bottom">{{$item->korp1}}</td>
			<td class="no-bottom">{{$item->kejuruan}}</td>
			@if(!is_null($item->employee_id))
			<td class="no-bottom">{{$item->pegawai->name}}</td>
			<td class="no-bottom">{{$item->pegawai->pangkat}}<br>{{$item->pegawai->korps}}</td>
			<td class="no-bottom">{{$item->pegawai->nrp}}</td>
			<td class="no-bottom">{{$item->pegawai->st_kasal_no_st}}<br>{{$item->pegawai->st_kasal_no_sp}} Tmt.{{date('d/m/Y', $item->pegawai->st_kasal_tgl_sp)}}</td>
			<td class="no-bottom">{{$item->pegawai->intern_dep}}/{{$item->pegawai->intern_jabatan}}<br>{{$item->pegawai->intern_no_sp}} Tmt.{{date('d/m/Y', $item->pegawai->intern_tgl_sp)}}</td>
            @else
			<td class="no-bottom"></td>
			<td class="no-bottom"></td>
			<td class="no-bottom"></td>
			<td class="no-bottom">Tmt.0<br>Tmt. 0</td>
			<td class="no-bottom">/<br>Tmt. 0</td>
            @endif
		</tr>
		@php $i++ @endphp
		@endforeach
	</table>
	<br>
	<table>
		<tr>
			<td width="60%" class="centered"></td>
			<td width="40%" class="centered">a.n. Kepala {{config('app.name')}}</td>
		</tr>
	</table>
	<br><br><br>
	<table>
		<tr>
			<td width="60%" class="centered"></td>
			<td width="40%" class="centered">U.b.</td>
		</tr>
		<tr>
			<td class="centered"></td>
			<td class="centered">{{$ttd->alias}},</td>
		</tr>
		<tr>
			<td class="centered"></td>
			<td class="centered">{{$ttd->bagian_bawah}}</td>
		</tr>
	</table> 
</body>
</html>