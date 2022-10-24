@foreach($narkoba as $key => $value)
	@if($value == 1)
		@if($key == 0 && $narkoba_show[$key] == 0)
		<td class="noBorderRight" width="16%">Morfin</td>
		<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->morphin}}@endif {{$narkoba_show[$key]}}</td>
		@php $narkoba_show[$key] = 1 @endphp
		@php break @endphp
		@elseif($key == 1 && $narkoba_show[$key] == 0)
		<td class="noBorderRight" width="16%">Metamphetamine</td>
		<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->metamphetamine}}@endif</td>
		@php break @endphp
		@elseif($key == 2 && $narkoba_show[$key] == 0)
		<td class="noBorderRight" width="16%">Amphetamin</td>
		<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->amphetamine}}@endif</td>
		@php break @endphp
		@elseif($key == 3 && $narkoba_show[$key] == 0)
		<td class="noBorderRight" width="16%">Diazepam</td>
		<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->diazepam}}@endif</td>
		@php break @endphp
		@elseif($key == 4 && $narkoba_show[$key] == 0)
		<td class="noBorderRight" width="16%">Ganja</td>
		<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->ganja}}@endif</td>
		@php break @endphp
		@endif
	@endif
@endforeach