<table>
	<tr>
		<td class="centered title"><b>REKAP PERSONEL DPB</b></td>
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
		<th width="20%" rowspan="3" class="centered bordered orange-col"><b>TAHUN</b></th>
		<th width="25%" rowspan="3" class="centered bordered orange-col"><b>BULAN</b></th>
		<th width="30%" colspan="3" class="centered bordered orange-col"><b>AKTIF</b></th>
		<th width="25%" rowspan="3" class="centered bordered orange-col"><b>JUMLAH TOTAL</b></th>
	</tr>
	<tr>
		<th width="10%" class="centered bordered orange-col"><b>01</b></th>
		<th width="10%" class="centered bordered orange-col"><b>02</b></th>
		<th width="10%" class="centered bordered orange-col"><b>03</b></th>
	</tr>
	<tr>
		<th class="centered bordered orange-col"><b>MILITER</b></th>
		<th class="centered bordered orange-col"><b>PNS</b></th>
		<th class="centered bordered orange-col"><b>PHL</b></th>
	</tr>
	<?php $total1 = 0; $total2 = 0; $total3 = 0; ?>
	@foreach($data['out']['DPB'] as $key => $val)
		<?php $firstY = true; $subTotal1 = 0; $subTotal2 = 0; $subTotal3 = 0;?>
		@foreach($val as $key2 => $val2)
			@if($firstY)
				<tr>
					<td rowspan="{{count($val)+1}}" class="centered bordered blue-text"><b>{{$key}}</b></td>
					<td class="centered bordered">{{$key2}}</td>
					<td class="centered bordered">{{isset($val2['MILITER']) ? $val2['MILITER'] : ''}}</td>
					<td class="centered bordered">{{isset($val2['PNS']) ? $val2['PNS'] : ''}}</td>
					<td class="centered bordered">{{isset($val2['PHL']) ? $val2['PHL'] : ''}}</td>
					<td class="centered bordered">{{$val2['total']}}</td>
				</tr>
				<?php $firstY = false; ?>
			@else
				<tr>
					<td class="centered bordered">{{$key2}}</td>
					<td class="centered bordered">{{isset($val2['MILITER']) ? $val2['MILITER'] : ''}}</td>
					<td class="centered bordered">{{isset($val2['PNS']) ? $val2['PNS'] : ''}}</td>
					<td class="centered bordered">{{isset($val2['PHL']) ? $val2['PHL'] : ''}}</td>
					<td class="centered bordered">{{$val2['total']}}</td>
				</tr>
			@endif
			<?php
				if(isset($val2['MILITER']))	$subTotal1 += $val2['MILITER'];
				if(isset($val2['PNS']))	$subTotal2 += $val2['PNS'];
				if(isset($val2['PHL']))	$subTotal3 += $val2['PHL'];
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