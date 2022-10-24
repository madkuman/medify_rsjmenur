@if($count_imun > 0)
<tr>
	@foreach($imun_custom as $key => $value)
		@if($value == 1)
			@if($key == 0 && $imun_show[$key] == 0)

			<td>HBs Ag</td>
			<td> : {{$imun->hbs_ag ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 1 && $imun_show[$key] == 0)
			<td>Anti HIV</td>
			<td>: {{$imun->anti_hiv ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 2 && $imun_show[$key] == 0)
			<td>Anti HCV</td>
			<td>: {{$imun->anti_hcv ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 3 && $imun_show[$key] == 0)
			<td>ICT Malaria</td>
			<td>: {{$imun->ict_malaria ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 4 && $imun_show[$key] == 0)
			<td>VDRL</td>
			<td>: {{$imun->vdrl ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 5 && $imun_show[$key] == 0)
			<td><span style="font-size: 13px">Coomb Test</span></td>
			<td>: {{$imun->coomb_test ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 6 && $imun_show[$key] == 0)
			<td>HBe Ag</td>
			<td>: {{$imun->hb_eag ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp

			@endif
		@endif
	@endforeach
	@foreach($imun_custom as $key => $value)
		@if($value == 1)
			@if($key == 0 && $imun_show[$key] == 0)

			<td>HBs Ag</td>
			<td> : {{$imun->hbs_ag ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 1 && $imun_show[$key] == 0)
			<td>Anti HIV</td>
			<td>: {{$imun->anti_hiv ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 2 && $imun_show[$key] == 0)
			<td>Anti HCV</td>
			<td>: {{$imun->anti_hcv ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 3 && $imun_show[$key] == 0)
			<td>ICT Malaria</td>
			<td>: {{$imun->ict_malaria ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 4 && $imun_show[$key] == 0)
			<td>VDRL</td>
			<td>: {{$imun->vdrl ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 5 && $imun_show[$key] == 0)
			<td><span style="font-size: 13px">Coomb Test</span></td>
			<td>: {{$imun->coomb_test ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 6 && $imun_show[$key] == 0)
			<td>HBe Ag</td>
			<td>: {{$imun->hb_eag ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp

			@endif
		@endif
	@endforeach
</tr>
@else
<tr>
	<td><span style="color: white">Blank</td>
	<td><span style="color: white">Blank</td>
	<td><span style="color: white">Blank</td>
	<td><span style="color: white">Blank</td>
</tr>
<tr>
	<td><span style="color: white">Blank</td>
	<td><span style="color: white">Blank</td>
	<td><span style="color: white">Blank</td>
	<td><span style="color: white">Blank</td>
</tr>
@endif

@if($count_imun > 2)
<tr>
	@foreach($imun_custom as $key => $value)
		@if($value == 1)
			@if($key == 0 && $imun_show[$key] == 0)

			<td>HBs Ag</td>
			<td> : {{$imun->hbs_ag ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 1 && $imun_show[$key] == 0)
			<td>Anti HIV</td>
			<td>: {{$imun->anti_hiv ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 2 && $imun_show[$key] == 0)
			<td>Anti HCV</td>
			<td>: {{$imun->anti_hcv ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 3 && $imun_show[$key] == 0)
			<td>ICT Malaria</td>
			<td>: {{$imun->ict_malaria ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 4 && $imun_show[$key] == 0)
			<td>VDRL</td>
			<td>: {{$imun->vdrl ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 5 && $imun_show[$key] == 0)
			<td><span style="font-size: 13px">Coomb Test</span></td>
			<td>: {{$imun->coomb_test ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 6 && $imun_show[$key] == 0)
			<td>HBe Ag</td>
			<td>: {{$imun->hb_eag ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp

			@endif
		@endif
	@endforeach
	@foreach($imun_custom as $key => $value)
		@if($value == 1)
			@if($key == 0 && $imun_show[$key] == 0)

			<td>HBs Ag</td>
			<td> : {{$imun->hbs_ag ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 1 && $imun_show[$key] == 0)
			<td>Anti HIV</td>
			<td>: {{$imun->anti_hiv ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 2 && $imun_show[$key] == 0)
			<td>Anti HCV</td>
			<td>: {{$imun->anti_hcv ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 3 && $imun_show[$key] == 0)
			<td>ICT Malaria</td>
			<td>: {{$imun->ict_malaria ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 4 && $imun_show[$key] == 0)
			<td>VDRL</td>
			<td>: {{$imun->vdrl ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 5 && $imun_show[$key] == 0)
			<td><span style="font-size: 13px">Coomb Test</span></td>
			<td>: {{$imun->coomb_test ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 6 && $imun_show[$key] == 0)
			<td>HBe Ag</td>
			<td>: {{$imun->hb_eag ?? '-'}}</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp

			@endif
		@endif
	@endforeach
</tr>
@else
<tr>
	<td><span style="color: white">Blank</td>
	<td><span style="color: white">Blank</td>
	<td><span style="color: white">Blank</td>
	<td><span style="color: white">Blank</td>
</tr>
@endif