@php $count = count($vap_audit) @endphp
@if($count > 0)

<div class="row">
	<div class="col-md-12 autoscroll-x">
		<table class="table table-sm table-borderless table-vcenter table-striped" style="width: 100%">
			<tr>
				<th style="min-width:120px">Parameter</th>
				@foreach($vap_audit as $item)
				<th class="text-center">{{$item->created_at->format('d')}}</th>
				@endforeach
			</tr>

			<tr>
				<td>HOB >30-45</td>
				@foreach($vap_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->hob) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Pengkajian setiap hari terhadap sedasi dan extubasi</td>
				@foreach($vap_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->pengkajian_tiap_hari) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Hand hygiene</td>
				@foreach($vap_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->hand_hygiene) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Oral Hygiene 4 – 6 jam</td>
				@foreach($vap_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->oral_hygiene) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Penyikatan gigi setiap 12 jam</td>
				@foreach($vap_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->sikat_gigi_12_jam) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Suction / manajemen sekresi</td>
				@foreach($vap_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->suction) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Profilaksis peptic ulcer</td>
				@foreach($vap_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->profilaksis) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>DVT Profilaksis</td>
				@foreach($vap_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->profilaksis_dvt) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
		</table>
	</div>
</div>
@else

<div class="text-center py-50">
	<h4 class="font-w400 mb-5">Belum ada audit VAP </h4><br>
	<p>Klik tombol <b>Isi audit VAP</b> untuk melakukan penilaian</p>
</div>

@endif