@if($count_imun > 0)
<tr class="noBorder">
	@foreach($imun_custom as $key => $value)
		@if($value == 1)
			@if($key == 0 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">HBs Ag (RPHA)</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->hbs_ag or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">mlU/ml</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 1 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">Anti HIV</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->anti_hiv or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">mlU/ml</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 2 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">Anti HCV</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->anti_hcv or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 3 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">ICT Malaria</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->ict_malaria or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 4 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">VDRL</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->vdrl or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 5 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">Coomb Test</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->coomb_test or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 6 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">HBe Ag</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->hb_eag or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp

			@endif
		@endif
	@endforeach
</tr>
@endif
@if($count_imun > 1)
<tr class="noBorder">
	@foreach($imun_custom as $key => $value)
		@if($value == 1)
			@if($key == 0 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">HBs Ag (RPHA)</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->hbs_ag or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">mlU/ml</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 1 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">Anti HIV</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->anti_hiv or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">mlU/ml</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 2 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">Anti HCV</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->anti_hcv or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 3 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">ICT Malaria</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->ict_malaria or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 4 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">VDRL</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->vdrl or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 5 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">Coomb Test</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->coomb_test or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 6 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">HBe Ag</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->hb_eag or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp

			@endif
		@endif
	@endforeach
</tr>
@endif
@if($count_imun > 2)
<tr class="noBorder">
	@foreach($imun_custom as $key => $value)
		@if($value == 1)
			@if($key == 0 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">HBs Ag (RPHA)</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->hbs_ag or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">mlU/ml</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 1 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">Anti HIV</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->anti_hiv or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">mlU/ml</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 2 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">Anti HCV</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->anti_hcv or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 3 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">ICT Malaria</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->ict_malaria or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 4 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">VDRL</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->vdrl or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 5 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">Coomb Test</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->coomb_test or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 6 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">HBe Ag</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->hb_eag or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp

			@endif
		@endif
	@endforeach
</tr>
@endif
@if($count_imun > 3)
<tr class="noBorder">
	@foreach($imun_custom as $key => $value)
		@if($value == 1)
			@if($key == 0 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">HBs Ag (RPHA)</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->hbs_ag or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">mlU/ml</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 1 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">Anti HIV</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->anti_hiv or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">mlU/ml</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 2 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">Anti HCV</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->anti_hcv or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 3 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">ICT Malaria</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->ict_malaria or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 4 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">VDRL</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->vdrl or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 5 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">Coomb Test</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->coomb_test or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp


			@elseif($key == 6 && $imun_show[$key] == 0)
			<td style="padding-left: 20px;">HBe Ag</td>
			<td style="padding-left: 5px; text-align: center;">{{$imun->hb_eag or '-'}}</td>
			<td style="padding-left: 5px; text-align: center;">-</td>
			<td style="padding-left: 5px; text-align: center;">Negatif</td>
			@php $imun_show[$key] = 1 @endphp
			@php break @endphp

			@endif
		@endif
	@endforeach
</tr>
@endif
<tr class="noBorder"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>