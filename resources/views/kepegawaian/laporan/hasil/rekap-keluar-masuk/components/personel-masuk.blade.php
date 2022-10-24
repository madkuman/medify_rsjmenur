<table>
	<tr>
		<td class="centered title"><b>REKAP PERSONEL YANG MASUK</b></td>
	</tr>
	<tr>
		<td class="centered title"><b>{{$date}}</b></td>
	</tr>
</table>
<br>
<table width="100%">
	<tr>
		<th width="45%" class="centered no-bottom-only cream-col"><b>KETERANGAN</b></th>
		<th width="55%" class="centered no-bottom-only cream-col"><b>PERSONEL</b></th>
	</tr>
</table>
<table class="bordered">
	<tr>
		<th width="20%" rowspan="3" class="centered bordered orange-col"><b>Tahun</b></th>
		<th width="25%" rowspan="3" class="centered bordered orange-col"><b>Bulan</b></th>
		<th width="30%" colspan="3" class="centered bordered orange-col"><b>Aktif</b></th>
		<th width="25%" rowspan="3" class="centered bordered orange-col"><b>JUMLAH TOTAL</b></th>
	</tr>
	<tr>
		<th width="10%" class="centered bordered orange-col"><b>01</b></th>
		<th width="10%" class="centered bordered orange-col"><b>02</b></th>
		<th width="10%" class="centered bordered orange-col"><b>03</b></th>
	</tr>
	<tr>
		<th class="centered bordered grey-col red-text"><b>MILITER</b></th>
		<th class="centered bordered grey-col red-text"><b>PNS</b></th>
		<th class="centered bordered grey-col red-text"><b>PHL</b></th>
	</tr>
	<?php $total1 = 0; $total2 = 0; $total3 = 0; ?>
	@foreach($data['in'] as $key => $value)
		<?php $firstY = true; $subTotal1 = 0; $subTotal2 = 0; $subTotal3 = 0;?>
		@foreach($value as $key2 => $value2)
			@if($firstY)
				<tr>
					<td rowspan="{{count($value)+1}}" class="centered bordered blue-text"><b>{{$key}}</b></td>
					<td class="centered bordered">{{$key2}}</td>
					<td class="centered bordered">{{isset($value2['MILITER']) ? $value2['MILITER'] : ''}}</td>
					<td class="centered bordered">{{isset($value2['PNS']) ? $value2['PNS'] : ''}}</td>
					<td class="centered bordered">{{isset($value2['PHL']) ? $value2['PHL'] : ''}}</td>
					<td class="centered bordered">{{$value2['total']}}</td>
				</tr>
				<?php $firstY = false; ?>
			@else
				<tr>
					<td class="centered bordered">{{$key2}}</td>
					<td class="centered bordered">{{isset($value2['MILITER']) ? $value2['MILITER'] : ''}}</td>
					<td class="centered bordered">{{isset($value2['PNS']) ? $value2['PNS'] : ''}}</td>
					<td class="centered bordered">{{isset($value2['PHL']) ? $value2['PHL'] : ''}}</td>
					<td class="centered bordered">{{$value2['total']}}</td>
				</tr>
			@endif
		<?php
			if(isset($value2['MILITER']))	$subTotal1 += $value2['MILITER'];
			if(isset($value2['PNS']))	$subTotal2 += $value2['PNS'];
			if(isset($value2['PHL']))	$subTotal3 += $value2['PHL'];
		 ?>
		@endforeach
		<tr>
			<td class="centered bordered mint-col"><b>Sub Total</b></td>
			<td class="centered bordered mint-col"><b>{{$subTotal1}}</b></td>
			<td class="centered bordered mint-col"><b>{{$subTotal2}}</b></td>
			<td class="centered bordered mint-col"><b>{{$subTotal3}}</b></td>
			<td class="centered bordered mint-col"><b>{{$subTotal1 + $subTotal2 + $subTotal3}}</b></td>
		</tr>
		<?php $total1 += $subTotal1; $total2 += $subTotal2; $total3 += $subTotal3; ?>
	@endforeach

	<tr>
		<td colspan="2" class="centered bordered yellow-col"><b>JUMLAH TOTAL</b></td>
		<td class="centered bordered yellow-col"><b>{{$total1}}</b></td>
		<td class="centered bordered yellow-col"><b>{{$total2}}</b></td>
		<td class="centered bordered yellow-col"><b>{{$total3}}</b></td>
		<td class="centered bordered yellow-col"><b>{{$total1 + $total2 + $total3}}</b></td>
	</tr>
</table>