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
.no-bottom{
	border-top: none;
	border-left: 1px solid black;
	border-right: 1px solid black;
	border-bottom: none;
}
.no-bottom-only{
	border-top: 1px solid black;
	border-left: 1px solid black;
	border-right: 1px solid black;
	border-bottom: none;
}
.title{
	font-size: 16px;
}
.orange-col{
	background-color: #ffdb4d;
}
.grey-col{
	background-color: #eaeae1;
}
.mint-col{
	background-color: #00e6e6;
}
.yellow-col{
	background-color: yellow;
}
.cream-col{
	background-color: #ffe680;
}
.red-text{
	color: red;
}
.blue-text{
	color: blue;
}
.pink-col{
	background-color: #ffe6ff;
}
td{
	padding-left: 5px;
}
</style>
<head>
	<title>Rekap Personel Keluar Masuk</title>
</head>
<body>
	<table width="100%">
	<tr>
		<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
	</tr>
</table>
	<br>
	<table>
		<tr>
			<td class="centered title"><b>REKAP PERSONEL</b></td>
		</tr>
		<tr>
			<td class="centered title"><b>BERDASARKAN PENEMPATAN INTEREN</b></td>
		</tr>
		<tr>
			<td class="centered title"><b>{{$date}}</b></td>
		</tr>
	</table>
	<br>
	<table width="100%">
		<tr>
			<th width="55%" class="centered no-bottom-only cream-col"><b>PENEMPATAN</b></th>
			<th width="45%" class="centered no-bottom-only cream-col"><b>PERSONEL</b></th>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<th width="28%" rowspan="2" class="centered bordered orange-col"><b>DEPARTEMEN</b></th>
			<th width="27%" rowspan="2" class="centered bordered orange-col"><b>JABATAN</b></th>
			<th width="10%" class="centered bordered orange-col"><b>01</b></th>
			<th width="10%" class="centered bordered orange-col"><b>02</b></th>
			<th width="10%" class="centered bordered orange-col"><b>03</b></th>
			<th width="15%" rowspan="2" class="centered bordered orange-col"><b>JUMLAH TOTAL</b></th>
		</tr>
		<tr>
			<th class="centered bordered orange-col"><b>MILITER</b></th>
			<th class="centered bordered orange-col"><b>PNS</b></th>
			<th class="centered bordered orange-col"><b>PHL</b></th>
		</tr>
		<?php $sum_all_militer = 0; ?>
		<?php $sum_all_pns = 0; ?>
		<?php $sum_all_phl = 0; ?>
		<?php $sum_all_total = 0; ?>

		@foreach($data as $key=>$value)
		<?php $jumlah_row = count($value)+1;?>
		<?php $flag = 0; ?>
		<?php $sum_militer = 0; ?>
		<?php $sum_pns = 0; ?>
		<?php $sum_phl = 0; ?>
		<?php $sum_total = 0; ?>

		<tr>
			<td rowspan="{{$jumlah_row}}" class="bordered blue-text"><b>{{$key}}</b></td>
			@foreach($value as $key2=>$value2)
			<?php if($flag>0) { ?> <tr> <?php }; ?>
				<td class="bordered">{{$key2}}</td>
				<td class="centered bordered">{{isset($value2['MILITER']) ? $value2['MILITER'] : ""}}</td>
				<?php isset($value2['MILITER']) ? $sum_militer+=$value2['MILITER'] : $sum_militer+=0; ?>
				<td class="centered bordered">{{isset($value2['PNS']) ? $value2['PNS'] : ""}}</td>
				<?php isset($value2['PNS']) ? $sum_pns+=$value2['PNS'] : $sum_pns+=0; ?>
				<td class="centered bordered">{{isset($value2['PHL']) ? $value2['PHL'] : ""}}</td>
				<?php isset($value2['PHL']) ? $sum_phl+=$value2['PHL'] : $sum_phl+=0; ?>
				<td class="centered bordered">{{isset($value2['total']) ? $value2['total'] : ""}}</td>
				<?php isset($value2['total']) ? $sum_total+=$value2['total'] : $sum_total+=0; ?>
			</tr>
			<?php $flag++; ?>
			@endforeach
			<tr>
				<td class="centered bordered mint-col"><b>Sub Total</b></td>
				<td class="centered bordered mint-col"><b>{{$sum_militer}}</b></td>
				<td class="centered bordered mint-col"><b>{{$sum_pns}}</b></td>
				<td class="centered bordered mint-col"><b>{{$sum_phl}}</b></td>
				<td class="centered bordered mint-col"><b>{{$sum_total}}</b></td>
				<?php $sum_all_militer += $sum_militer; ?>
				<?php $sum_all_pns += $sum_pns; ?>
				<?php $sum_all_phl += $sum_phl; ?>
				<?php $sum_all_total += $sum_total; ?>
			</tr>
			@endforeach
			<tr>
				<td colspan="2" class="centered bordered yellow-col"><b>JUMLAH TOTAL</b></td>
				<td class="centered bordered yellow-col"><b>{{$sum_all_militer}}</b></td>
				<td class="centered bordered yellow-col"><b>{{$sum_all_pns}}</b></td>
				<td class="centered bordered yellow-col"><b>{{$sum_all_phl}}</b></td>
				<td class="centered bordered yellow-col"><b>{{$sum_all_total}}</b></td>
			</tr>
		</table>
	@include('kepegawaian.laporan.hasil.components.ttd')

	</body>
	</html>