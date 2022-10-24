@php
$kasal_position = $signed['signBy']->jabatan_kasal->position;
$position = !empty($signed['signBy']->last_position->name) ? $signed['signBy']->last_position->name : '';
@endphp
<table style="width: 100%;">
	<tr>
		<td style="width: 50%; color: white">dummy</td>
		<td style="width: 50%; text-align: center;">
			{{$signed['isHead'] ? '' : 'a.n '}} Kepala {{config('app.name')}}{{$signed['isHead'] ? ',' : ''}}
		</td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center;">
			@if(!$signed['isHead'])
			@if($kasal_position == 'Kabagminpers')
			Dansatma<br>U.b.<br>Kabagminpers,
			@else
			<p>{{$kasal_position}},</p>
			@endif
			@endif
		</td>
	</tr>
	<tr>
		<td></td>
		<td style="color: white; font-size: 60px">dummy</td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center;">
			{{$signed['signBy']->name}}
		</td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center;">
			{{$position}} NRP {{$signed['signBy']->nrp}}
		</td>
	</tr>
</table>
<div>
	
</div>