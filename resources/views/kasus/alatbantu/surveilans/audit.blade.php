@php $count = count($ido_audit) @endphp
@if($count > 0)

<div class="row">
	<div class="col-md-12 autoscroll-x">
		<table class="table table-sm table-borderless table-vcenter table-striped" style="width: 100%">
			<tr>
				<th style="min-width:120px">Parameter</th>
				@foreach($ido_audit as $item)
				<th class="text-center">{{$item->created_at->format('d')}}</th>
				@endforeach
			</tr>

			<tr>
				<td>Cukur dengan E-clipper</td>
				@foreach($ido_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->cukur) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Waktu cukur 2 jam sebelum operasi</td>
				@foreach($ido_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->waktu_cukur) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Mandi cholrhexidine</td>
				@foreach($ido_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->mandi_cholrhexidine) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Antibiotic 1 jam sebelum insisi</td>
				@foreach($ido_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->antibiotik) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Pasien tidak sedang infeksi</td>
				@foreach($ido_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->infeksi) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Gula darah Terkontrol</td>
				@foreach($ido_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->gula_darah) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Info</td>
				@foreach($ido_audit as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">

					<button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 " data-toggle="tooltip" data-html="true" title="@include('kasus.alatbantu.bsi.tooltip')" data-placement="left">
						<i class="fa fa-info"></i>
					</button>

				</td>
				@endforeach
			</tr>
			<tr>
				<td>Hapus</td>
				@foreach($ido_audit as $item)
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
	<h4 class="font-w400 mb-5">Belum ada audit IDO </h4><br>
	<p>Klik tombol <b>Isi audit IDO</b> untuk melakukan penilaian</p>
</div>

@endif