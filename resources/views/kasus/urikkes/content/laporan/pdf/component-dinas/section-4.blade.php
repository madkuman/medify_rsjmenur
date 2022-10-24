<div class="text-center" style="font-size: 16px;">4.</div>
<div style="padding-left: 25px;">
	<table width="90%" style="font-size: 13px;" class="lab" cellpadding="0" cellspacing="0">
		<tr>
			<th colspan="2"><b><u>URINALISA</u></b></th>
			<th colspan="2"><b><u>Sedimen(Lpb)</u></b></th>
		</tr>
		<tr>
			<td style="width: 20%" >PH</td>
			<td style="width: 30%" >: {{!is_null($urine) ? $urine->ph : ''}}</td>
			<td style="width: 20%" >Leuko</td>
			<td style="width: 20%" >: {{!is_null($urine) ? $urine->leuko : ''}}</td>
		</tr>
		<tr>
			<td >BJ</td>
			<td >: {{!is_null($urine) ? $urine->berat_jenis : ''}}</td>
			<td >Erit</td>
			<td >: {{!is_null($urine) ? $urine->eritrosit : ''}}</td>
		</tr>
		<tr>
			<td >Protein</td>
			<td >: {{!is_null($urine) ? $urine->protein : ''}}</td>
			<td >Cyl</td>
			<td >: {{!is_null($urine) ? $urine->cylinder : ''}}</td>
		</tr>
		<tr>
			<td >Reduksi</td>
			<td >: {{!is_null($urine) ? $urine->reduksi : ''}}</td>
			<td >Krit</td>
			<td >: {{!is_null($urine) ? $urine->kristal : ''}}</td>
		</tr>
		<tr>
			<td >Bilirubin</td>
			<td >:  {{!is_null($urine) ? $urine->bilirubin : ''}}</td>
			<td >Epitel</td>
			<td >:  {{!is_null($urine) ? $urine->epitel : ''}}</td>
		</tr>
		<tr>
			<td >Urobilin</td>
			<td >: {{!is_null($urine) ? $urine->urobilinogen : ''}}</td>
			<td >Bact.</td>
			<td >: {{!is_null($urine) ? $urine->bakteri : ''}}</td>
		</tr>
		<tr>
			<td >Keton</td>
			<td >: {{!is_null($urine) ? $urine->keton : ''}}</td>
			@if($count_narkoba > 0)
			<td colspan="2" style="font-size: 13px;">* Narkoba {{$count_narkoba}} Item :</td>
			@endif
		</tr>
		<tr>
			<td >Nitrit</td>
			<td >: {{!is_null($urine) ? $urine->nitrit : ''}}</td>
			@foreach($narkoba as $key => $value)
			@if($value == 1)
			@if($key == 0 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - MOR : {{$urine->morphin ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 1 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - MET : {{$urine->metamphetamine ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 2 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - AMP : {{$urine->amphetamine ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 3 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - DZM : {{$urine->diazepam ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 4 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - GNJ : {{$urine->ganja ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@endif
			@endif
			@endforeach



		</tr>
		<tr>
			<td >Lekosit</td>
			<td >: {{!is_null($urine) ? $urine->leukosit : ''}}</td>
			@foreach($narkoba as $key => $value)
			@if($value == 1)
			@if($key == 0 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - MOR : {{$urine->morphin ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 1 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - MET : {{$urine->metamphetamine ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 2 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - AMP : {{$urine->amphetamine ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 3 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - DZM : {{$urine->diazepam ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 4 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - GNJ : {{$urine->ganja ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@endif
			@endif
			@endforeach
		</tr>
		<tr>
			<td ><span style="color: white">Blank</span></td>
			<td ></td>
			@foreach($narkoba as $key => $value)
			@if($value == 1)
			@if($key == 0 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - MOR : {{$urine->morphin ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 1 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - MET : {{$urine->metamphetamine ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 2 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - AMP : {{$urine->amphetamine ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 3 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - DZM : {{$urine->diazepam ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 4 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - GNJ : {{$urine->ganja ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@endif
			@endif
			@endforeach
		</tr>
		<tr>
			<td ><span style="color: white">Blank</span></td>
			<td ></td>
			@foreach($narkoba as $key => $value)
			@if($value == 1)
			@if($key == 0 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - MOR : {{$urine->morphin ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 1 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - MET : {{$urine->metamphetamine ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 2 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - AMP : {{$urine->amphetamine ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 3 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - DZM : {{$urine->diazepam ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@elseif($key == 4 && $narkoba_show[$key] == 0)
			<td colspan="2" style="font-size: 13px;"> - GNJ : {{$urine->ganja ?? '-'}}</td>
			@php $narkoba_show[$key] = 1 @endphp
			@php break @endphp
			@endif
			@endif
			@endforeach
		</tr>
		<tr>
			<td colspan="4" style="padding-top: 10px;"><b><u>IMUNOLOGI</u></b></td>
		</tr>
		@include('kasus.urikkes.content.laporan.pdf.component-dinas.imun-custom')
		<tr>
			<td colspan="4" style="padding-top: 10px;"><b><u>RADIOLOGI</u></b></td>
		</tr>
		<tr>
			<td> X ray Photo</td>
			<td colspan="2">: {{!is_null($klinis) ? $klinis->x_ray : ''}}</td>
		</tr>
		<tr>
			<td colspan="4" style="padding-top: 10px;"><b><u>U S G</u></b></td>
		</tr>
		@if($pasien->gender == 1)
		<tr>
			<td style="vertical-align: top"> Abdomen</td>
			<td colspan="3" rowspan="2" style="vertical-align: top">: {{!is_null($klinis) ? $klinis->abdomen : '-'}}</td>
		</tr>
		<tr>
			<td></td>
		</tr>
		@else
		<tr>
			<td > Abdomen</td>
			<td colspan="3">: {{!is_null($klinis) ? $klinis->abdomen : '-'}}</td>
		</tr>
		<tr>
			<td > Mammae</td>
			<td colspan="3">: {{!is_null($klinis) ? $klinis->mamae : '-'}}</td>
		</tr>
		@endif
		<tr>
			<td style="padding-top: 10px;"> <b><u>E C G</u></b></td>
			<td style="padding-top: 10px;" colspan="3">: {{!is_null($klinis) ? $klinis->ecg : '-'}}</td>
		</tr>
		<tr>
			<td style="padding-top: 10px;"> <b><u>TREADMILL</u></b></td>
			<td style="padding-top: 10px;" colspan="3">: {{!is_null($klinis) ? $klinis->treadmill : '-'}}</td>
		</tr>
		@if($pasien->gender == 2)
		<tr>
			<td style="padding-top: 10px;"> <b><u>PAP SMEAR</u></b></td>
			<td style="padding-top: 10px;" colspan="3">: {{!is_null($smear) ? $smear->pap_smear : '-'}}</td>
		</tr>
		@endif
		<tr>
			<td rowspan="2" style="padding-top: 10px;"> <b><u>AUDIOMETRI</u></b></td>
			<td colspan="3" style="padding-top: 10px;"> <b>&nbsp;&nbsp;&nbsp;AD</b>: {{!is_null($telinga) ? $telinga->suara_ad : '-'}}</td>
		</tr>
		<tr>
			<td colspan="3" style="padding-top: 10px;"> <b>&nbsp;&nbsp;&nbsp;AS</b>: {{!is_null($telinga) ? $telinga->suara_as : '-'}}</td>
		</tr>
	</table>
</div>