<div class="text-center">4.</div>
<table width="100%">
	<tr>
		<th colspan="2"><b><u>URINALISA</u></b></th>
		<th colspan="2"><b><u>Sedimen(Lpb)</u></b></th>
	</tr>
	@for($i=0; $i<9; $i++)
	<tr>
		<td >{{$input_lab5[$i]->label}}</td>
		<td >
			: @if(!empty($input_lab5[$i]->hasil->value)) {{$input_lab5[$i]->hasil->value}}@else - @endif
		</td>
		@if($i<6)
		<td >{{$input_lab4[$i]->label}}</td>
		<td >
			: @if(!empty($input_lab4[$i]->hasil->value)) {{$input_lab4[$i]->hasil->value}}@else - @endif
		</td>
		@endif
	</tr>
	@endfor
	@foreach($input_lab42 as $key => $input)
	<tr>
		<td >{{$input->label}}</td>
		<td colspan="2">
			: @if(!empty($input->hasil->value)) {{$input->hasil->value}} @else - @endif
		</td>
	</tr>
	@endforeach
	<tr>
		<td colspan="4"><b><u>RADIOLOGI</u></b></td>
	</tr>
	<tr>
		<td> X ray Photo</td>
		<td colspan="2">: @if(!empty($form31[0])) {{$form31[0]->value}} @else - @endif</td>
	</tr>
	<tr>
		<td colspan="4"><b><u>U S G</u></b></td>
	</tr>
	<tr>
		<td > Abdomen</td>
		<td colspan="2">: @if(!empty($form34[0])) {{$form34[0]->value}} @else - @endif</td>
	</tr>
	<tr>
		<td > Mamme</td>
		<td colspan="2">: @if(!empty($form34[1])) {{$form34[1]->value}} @else - @endif</td>
	</tr>
	<tr>
		<td > <b><u>E C G</u></b></td>
		<td colspan="2">: @if(!empty($form33[0])) {{$form33[0]->value}} @else - @endif</td>
	</tr>
	<tr>
		<td > <b><u>TREADMILL</u></b></td>
		<td colspan="2">: @if(!empty($form35[0])) {{$form35[0]->value}} @else - @endif</td>
	</tr>
	<tr>
		<td > <b><u>PAP SMEAR</u></b></td>
		<td colspan="2">: @if(!empty($form32[0])) {{$form32[0]->value}} @else - @endif</td>
	</tr>
	<tr>
		<td  rowspan="2"> <b><u>AUDIOMETRI</u></b></td>
		<td colspan="2"> <b>AD</b> : @if(($print_all == 1 || $print_telinga == 1) and isset($telinga)) {{$telinga->audio_ad}} @endif</td>
	</tr>
	<tr>
		<td colspan="2"> <b>AS</b> : @if(($print_all == 1 || $print_telinga == 1) and isset($telinga)) {{$telinga->audio_as}} @endif</td>
	</tr>
	<tr>
	</tr>
</table>