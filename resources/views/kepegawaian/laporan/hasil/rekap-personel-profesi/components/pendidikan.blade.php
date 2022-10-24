<table>
	<tr>
		<td class="centered title"><b>REKAPITULASI PENDIDIKAN PERSONEL</b></td>
	</tr>
	<tr>
		<td class="centered title"><b>06 Februari 2019</b></td>
	</tr>
</table>
<br>
<table width="100%">
	<tr>
		<th width="60%" colspan="2" class="centered no-bottom-only orange-col"><b>PROFESI</b></th>
		<th width="40%" colspan="4" class="centered no-bottom-only orange-col"><b>STATUS PEGAWAI</b></th>
	</tr>
</table>
<table>
	<tr>
		<th width="5%" rowspan="2" class="centered bordered orange-col"><b>KODE</b></th>
		<th width="25%" rowspan="2" class="centered bordered orange-col"><b>KUALIFIKASI</b></th>
		<th width="30%" rowspan="2" class="centered bordered orange-col"><b>PENDIDIKAN TERAKHIR</b></th>
		<th width="10%" class="centered bordered orange-col"><b>01</b></th>
		<th width="10%" class="centered bordered orange-col"><b>02</b></th>
		<th width="10%" class="centered bordered orange-col"><b>03</b></th>
		<th width="10%" rowspan="2" class="centered bordered orange-col"><b>JUMLAH TOTAL</b></th>
	</tr>
	<tr>
		<th class="centered bordered orange-col"><b>MILITER</b></th>
		<th class="centered bordered orange-col"><b>PNS</b></th>
		<th class="centered bordered orange-col"><b>PHL</b></th>
	</tr>
	@php $index = 1; @endphp
	@php $total1 = 0; $total2 = 0; $total3 = 0; @endphp
	@foreach($data['kualifikasi'] as $key => $val)
		@php $firstY = true; $subTotal1 = 0; $subTotal2 = 0; $subTotal3 = 0; @endphp
		@foreach($val as $key2 => $val2)
			@if($key2 == 'self')	
				@continue
			@endif
			@if($firstY)
				<tr>
					<td rowspan="{{count($val)}}" class="centered bordered">{{$index}}</td>
					<td rowspan="{{count($val)}}" class="centered bordered text-blue">{{$key}}</td>
					<td class="centered bordered">{{$key2}}</td>
					<td class="centered bordered">{{isset($val2['MILITER']) ? $val2['MILITER'] : ''}}</td>
					<td class="centered bordered">{{isset($val2['PNS']) ? $val2['PNS'] : ''}}</td>
					<td class="centered bordered">{{isset($val2['PHL']) ? $val2['PHL'] : ''}}</td>
					<td class="centered bordered">{{$val2['total']}}</td>
				</tr>
				@php $firstY = false; @endphp
			@else
				<tr>
					<td class="centered bordered">{{$key2}}</td>
					<td class="centered bordered">{{isset($val2['MILITER']) ? $val2['MILITER'] : ''}}</td>
					<td class="centered bordered">{{isset($val2['PNS']) ? $val2['PNS'] : ''}}</td>
					<td class="centered bordered">{{isset($val2['PHL']) ? $val2['PHL'] : ''}}</td>
					<td class="centered bordered">{{$val2['total']}}</td>
				</tr>
			@endif
			@php
				if(isset($val2['MILITER']))	$subTotal1 += $val2['MILITER'];
				if(isset($val2['PNS']))	$subTotal2 += $val2['PNS'];
				if(isset($val2['PHL']))	$subTotal3 += $val2['PHL'];
			 @endphp
		@endforeach
		<tr>
			<td class="centered bordered blue-col"><b>Total</b></td>
			<td class="centered bordered blue-col"><b>{{$subTotal1}}</b></td>
			<td class="centered bordered blue-col"><b>{{$subTotal2}}</b></td>
			<td class="centered bordered blue-col"><b>{{$subTotal3}}</b></td>
			<td class="centered bordered blue-col"><b>{{$subTotal1 + $subTotal2 + $subTotal3}}</b></td>
		</tr>
		@php $total1 += $subTotal1; $total2 += $subTotal2; $total3 += $subTotal3; $index++; @endphp
	@endforeach

	<tr>
		<td class="centered bordered yellow-col" colspan="3"><b>JUMLAH TOTAL</b></td>
		<td class="centered bordered yellow-col"><b>{{$total1}}</b></td>
		<td class="centered bordered yellow-col"><b>{{$total2}}</b></td>
		<td class="centered bordered yellow-col"><b>{{$total3}}</b></td>
		<td class="centered bordered yellow-col"><b>{{$total1 + $total2 + $total3}}</b></td>
	</tr>
</table>