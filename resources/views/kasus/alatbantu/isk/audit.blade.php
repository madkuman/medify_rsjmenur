@php $count = count($isk_audit) @endphp
@if($count > 0)

<div class="row">
	<div class="col-md-12 autoscroll-x">
		<table class="table table-sm table-borderless table-vcenter table-striped" style="width: 100%">
			<tr>
				<th style="min-width:120px">Parameter</th>
				@foreach($isk_audit as $item)
				<th class="text-center">{{$item->created_at->format('d')}}</th>
				@endforeach
			</tr>

			<tr>
				<td>Pemasangan sesuai indikasi</td>
				@foreach($isk_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->pemasangan) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>>APD Tepat</td>
				@foreach($isk_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->apd) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>>Pemasangan menggunakan alat steril</td>
				@foreach($isk_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->alat_steril) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Hand Hygiene</td>
				@foreach($isk_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->hand_hygiene) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Segera dilepas jika tidak indikasi</td>
				@foreach($isk_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->lepas_indikasi) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Pengisian balon sesuai 30 ml</td>
				@foreach($isk_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->pengisian_balon) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Fiksasi kateter dengan plester</td>
				@foreach($isk_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->fiksasi_kateter) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Urine bag menggantung</td>
				@foreach($isk_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->urine_bag_menggantung) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Info</td>
				@foreach($isk_audit as $item)
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
				@foreach($isk_audit as $item)
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