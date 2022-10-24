@php $count = count($bsi_audit) @endphp
@if($count > 0)

<div class="row">
	<div class="col-md-12 autoscroll-x">
		<table class="table table-sm table-borderless table-vcenter table-striped" style="width: 100%">
			<tr>
				<th style="min-width:120px">Parameter</th>
				@foreach($bsi_audit as $item)
				<th class="text-center">{{$item->created_at->format('d')}}</th>
				@endforeach
			</tr>

			<tr>
				<td>Hand Hygiene</td>
				@foreach($bsi_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->hand_hygiene) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>APD Tepat</td>
				@foreach($bsi_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->apd) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Pembersihan kulit dengan chlorhexidine</td>
				@foreach($bsi_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->pembersihan_chlorhexidine) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Lokasi pemasangan sesuai</td>
				@foreach($bsi_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->lokasi_sesuai) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Selang infuse diganti sesuai standar</td>
				@foreach($bsi_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->selang_standard) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Swab alcohol setiap injeksi</td>
				@foreach($bsi_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->swab_alkohol_injeksi) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Spuit yang digunakan disposable</td>
				@foreach($bsi_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->spuit_disposable) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Penutup insersi dengan transparan dressing</td>
				@foreach($bsi_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->penutup_insersi) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Perawatan lokasi insersi setiap 4 hari dan jika kotor</td>
				@foreach($bsi_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->perawatan_lokasi_insersi) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Menggunakan stopper needles</td>
				@foreach($bsi_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->stopper_needles) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Info</td>
				@foreach($bsi_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">

					<button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 " data-toggle="tooltip" data-html="true" title="@include('kasus.alatbantu.isk.tooltip')" data-placement="left">
						<i class="fa fa-info"></i>
					</button>

				</td>
				@endforeach
			</tr>
			<tr>
				<td>Hapus</td>
				@foreach($bsi_audit as $item)
				<td class="text-center">
					@if(session('my_role_'.$kasus->nomor_kasus))
					<button class="btn btn-circle btn-outline-danger mr-5 mb-5 deleteBtn" data-id="{{$item->id}}">
						<i class="fa fa-trash"></i>
					</button>
					@endif
				</td>
				@endforeach
			</tr>
		</table>
	</div>
</div>
@else

<div class="text-center py-50">
	<h4 class="font-w400 mb-5">Belum ada audit isk </h4><br>
	<p>Klik tombol <b>Isi audit isk</b> untuk melakukan penilaian</p>
</div>

@endif