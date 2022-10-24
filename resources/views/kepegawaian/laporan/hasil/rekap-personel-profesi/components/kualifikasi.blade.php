<table>
	<tr>
		<td class="centered title"><b>REKAPITULASI PROFESI PERSONEL</b></td>
	</tr>
	<tr>
		<td class="centered title"><b>06 Februari 2019</b></td>
	</tr>
</table>
<br>
<table width="100%">
	<tr>
		<th width="40%" colspan="2" class="centered no-bottom-only orange-col"><b>PROFESI</b></th>
		<th width="60%" colspan="4" class="centered no-bottom-only orange-col"><b>STATUS PEGAWAI</b></th>
	</tr>
</table>
<table width="100%">
	<tr>
		<th  rowspan="2" class="centered bordered orange-col"><b>KODE</b></th>
		<th  rowspan="2" class="centered bordered orange-col"><b>KUALIFIKASI</b></th>
		<th  class="centered bordered orange-col"><b>01</b></th>
		<th  class="centered bordered orange-col"><b>02</b></th>
		<th  class="centered bordered orange-col"><b>03</b></th>
		<th  rowspan="2" class="centered bordered orange-col"><b>JUMLAH TOTAL</b></th>
	</tr>
	<tr>
		<th class="centered bordered orange-col"><b>MILITER</b></th>
		<th class="centered bordered orange-col"><b>PNS</b></th>
		<th class="centered bordered orange-col"><b>PHL</b></th>
	</tr>
	<?php $index = 1; ?>
	<?php $total1 = 0; $total2 = 0; $total3 = 0; ?>
	@foreach($data['kualifikasi'] as $key => $val)
		<tr>
			<td class="centered bordered text-blue">{{$index}}</td>
			<td class="centered bordered">{{$key}}</td>
			<td class="centered bordered">{{isset($val['self']['MILITER']) ? $val['self']['MILITER'] : ''}}</td>
			<td class="centered bordered">{{isset($val['self']['PNS']) ? $val['self']['PNS'] : ''}}</td>
			<td class="centered bordered">{{isset($val['self']['PHL']) ? $val['self']['PHL'] : ''}}</td>
			<td class="centered bordered">{{$val['self']['total']}}</td>
		</tr>
		<?php
			if(isset($val['self']['MILITER']))	$total1 += $val['self']['MILITER'];
			if(isset($val['self']['PNS']))	$total2 += $val['self']['PNS'];
			if(isset($val['self']['PHL']))	$total3 += $val['self']['PHL'];
		 ?>
		<?php $index++; ?>
	@endforeach
	<tr>
		<td class="centered bordered yellow-col" colspan="2"><b>JUMLAH TOTAL</b></td>
		<td class="centered bordered yellow-col"><b>{{$total1}}</b></td>
		<td class="centered bordered yellow-col"><b>{{$total2}}</b></td>
		<td class="centered bordered yellow-col"><b>{{$total3}}</b></td>
		<td class="centered bordered yellow-col"><b>{{$total1 + $total2 + $total3}}</b></td>
	</tr>
</table>