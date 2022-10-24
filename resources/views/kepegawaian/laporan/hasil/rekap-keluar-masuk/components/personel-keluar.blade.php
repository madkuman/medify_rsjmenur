	<table>
		<tr>
			<td class="centered title"><b>REKAP PERSONEL YANG KELUAR</b></td>
		</tr>
		<tr>
		<td class="centered title"><b>{{$date}}</b></td>
		</tr>
	</table>
	<br>
	<table width="100%">
		<tr>
			<th width="50%" class="centered no-bottom-only cream-col"><b>KETERANGAN</b></th>
			<th width="50%" class="centered no-bottom-only cream-col"><b>PERSONEL</b></th>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<th width="15%" rowspan="3" class="centered bordered orange-col"><b>STATUS</b></th>
			<th width="15%" rowspan="3" class="centered bordered orange-col"><b>TAHUN</b></th>
			<th width="20%" rowspan="3" class="centered bordered orange-col"><b>BULAN</b></th>
			<th width="30%" colspan="3" class="centered bordered orange-col"><b>AKTIF</b></th>
			<th width="20%" rowspan="3" class="centered bordered orange-col"><b>JUMLAH TOTAL</b></th>
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
		@php $total1 = 0; $total2 = 0; $total3 = 0; $firstS = true; @endphp
		@foreach($data['out'] as $key => $value)
			@if($key == 'DPB')	
			@break
			@endif
			@php $firstY = true; $subTotal1 = 0; $subTotal2 = 0; $subTotal3 = 0;@endphp
			@foreach($value as $key2 => $value2)
				@php 	$firstM = true; $superTotal1 = 0; $superTotal2 = 0; $superTotal3 = 0;@endphp
				@foreach($value2 as $key3 => $value3)
				@if($firstY)
					<tr>
						<td rowspan="{{$span[$key]['self']}}" class="centered bordered blue-text"><b>{{$key}}</b></td>
						<td rowspan="{{$span[$key][$key2]}}" class="centered bordered">{{$key2}}</td>
						<td class="centered bordered">{{$key3}}</td>
						<td class="centered bordered">{{isset($value3['MILITER']) ? $value3['MILITER'] : ''}}</td>
						<td class="centered bordered">{{isset($value3['PNS']) ? $value3['PNS'] : ''}}</td>
						<td class="centered bordered">{{isset($value3['PHL']) ? $value3['PHL'] : ''}}</td>
						<td class="centered bordered">{{$value3['total']}}</td>
					</tr>
					@php $firstY = false; $firstM = false; @endphp
				@elseif($firstM)
					<tr>
						<td rowspan="{{$span[$key][$key2]}}" class="centered bordered">{{$key2}}</td>
						<td class="centered bordered">{{$key3}}</td>
						<td class="centered bordered">{{isset($value3['MILITER']) ? $value3['MILITER'] : ''}}</td>
						<td class="centered bordered">{{isset($value3['PNS']) ? $value3['PNS'] : ''}}</td>
						<td class="centered bordered">{{isset($value3['PHL']) ? $value3['PHL'] : ''}}</td>
						<td class="centered bordered">{{$value3['total']}}</td>
					</tr>
					@php $firstM = false; @endphp
				@else
					<tr>
						<td class="centered bordered">{{$key3}}</td>
						<td class="centered bordered">{{isset($value3['MILITER']) ? $value3['MILITER'] : ''}}</td>
						<td class="centered bordered">{{isset($value3['PNS']) ? $value3['PNS'] : ''}}</td>
						<td class="centered bordered">{{isset($value3['PHL']) ? $value3['PHL'] : ''}}</td>
						<td class="centered bordered">{{$value3['total']}}</td>
					</tr>
				@endif
					@php
				if(isset($value3['MILITER']))	$superTotal1 += $value3['MILITER'];
				if(isset($value3['PNS']))	$superTotal2 += $value3['PNS'];
				if(isset($value3['PHL']))	$superTotal3 += $value3['PHL'];
			 @endphp
			@endforeach
			<tr>
				<td class="centered bordered pink-col"><b>Jumlah</b></td>
			<td class="centered bordered pink-col"><b>{{$superTotal1}}</b></td>
			<td class="centered bordered pink-col"><b>{{$superTotal2}}</b></td>
			<td class="centered bordered pink-col"><b>{{$superTotal3}}</b></td>
			<td class="centered bordered pink-col"><b>{{$superTotal1 + $superTotal2 + $superTotal3}}</b></td>
			</tr>
			@php $subTotal1 += $superTotal1; $subTotal2 += $superTotal2; $subTotal3 += $superTotal3; @endphp
		@endforeach
		<tr>
			<td colspan="2" class="centered bordered mint-col"><b>Total Status</b></td>
			<td class="centered bordered mint-col"><b>{{$subTotal1}}</b></td>
			<td class="centered bordered mint-col"><b>{{$subTotal2}}</b></td>
			<td class="centered bordered mint-col"><b>{{$subTotal3}}</b></td>
			<td class="centered bordered mint-col"><b>{{$subTotal1 + $subTotal2 + $subTotal3}}</b></td>
		</tr>
		@php $total1 += $subTotal1; $total2 += $subTotal2; $total3 += $subTotal3; @endphp
	@endforeach
	<tr>
		<td colspan="3" class="centered bordered yellow-col"><b>JUMLAH TOTAL</b></td>
			<td class="centered bordered yellow-col"><b>{{$total1}}</b></td>
			<td class="centered bordered yellow-col"><b>{{$total2}}</b></td>
			<td class="centered bordered yellow-col"><b>{{$total3}}</b></td>
			<td class="centered bordered yellow-col"><b>{{$total1 + $total2 + $total3}}</b></td>
	</tr>
	</table>