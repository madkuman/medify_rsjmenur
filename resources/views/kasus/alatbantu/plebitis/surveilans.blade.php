@forelse($master_plebitis as $master)
@php $master_plebitis_item = json_decode($master->val) @endphp
<div class="bg-primary p-10 mb-20 text-white text-capitalize">
	<span class="mr-5"> Tanggal Pasang : @if(!empty($master_plebitis_item->tanggal_pasang)){{$master_plebitis_item->tanggal_pasang}}@endif</span><br>
	<span class="mr-5"> Tanggal Lepas : @if(!empty($master_plebitis_item->tanggal_lepas)){{$master_plebitis_item->tanggal_lepas}}@endif</span><br>

	<span class="mr-5"> Jenis Cath : {{$master_plebitis_item->jenis_cath ?? ''}}{{$master_plebitis_item->jenis_cath_lain ?? ''}}  </span><br>
	<span class="mr-5"> Jenis Cairan : {{$master_plebitis_item->jenis_cairan ?? ''}}{{$master_plebitis_item->jenis_cairan_lain ?? ''}}  </span><br>
	<span class="mr-5"> Nomor Cath : {{$master_plebitis_item->nomor_cath ?? ''}}</span><br>
	<span class="mr-5"> Antibiotik : {{$master_plebitis_item->antibiotik ?? ''}}</span><br>
</div>

<div class="row">
	<div class="col-12">
		<button type="button" class="btn btn-primary float-right ml-5  btn-modal-surveilans" data-toggle="modal" data-target="#addModal" data-parent-id="{{$master->id}}"><i class="fa fa-plus"></i> Surveilans Plebitis</button>
		<button type="button" class="btn btn-secondary min-width-125 float-right btn-modal-master" data-val="{{$master->val}}" data-id="{{$master->id}}"><i class="fa fa-pencil"></i> Edit Cath</button>
		<button type="button" class="btn btn-danger min-width-125 float-right deleteBtn" data-id="{{$master->id}}"><i class="fa fa-trash"></i> Hapus Cath</button>
	</div>
</div> 


@php $plebitis = $master->children @endphp
@php $count = count($plebitis) @endphp

@if($count > 0)

<div class="row pt-10">
	<div class="col-md-12 autoscroll-x">
		<table class="table table-sm table-borderless table-vcenter table-striped" style="width: 100%">
			<tr>
				<th style="min-width:120px">Parameter</th>
				@foreach($plebitis as $item)
				<th class="text-center">{{$item->created_at->format('d')}}</th>
				@endforeach
			</tr>
			<tr>
				<td>Merah</td>
				@foreach($plebitis as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->merah) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Rasa Terbakar</td>
				@foreach($plebitis as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->rasa_terbakar) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Bengkak</td>
				@foreach($plebitis as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->bengkak) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Sakit Tekan</td>
				@foreach($plebitis as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->sakit_tekan) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Ulkus</td>
				@foreach($plebitis as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->ulkus) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Purulen</td>
				@foreach($plebitis as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->purulen) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Diagnosis Dokter</td>
				@foreach($plebitis as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->dx_dokter) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Info</td>
				@foreach($plebitis as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">

					<button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 " data-toggle="tooltip" data-html="true" title="@include('kasus.alatbantu.plebitis.tooltip')" data-placement="left">
						<i class="fa fa-info"></i>
					</button>

				</td>
				@endforeach
			</tr>
			<tr>
				<td>Hapus</td>
				@foreach($plebitis as $item)
				<td class="text-center">
					@if(session('my_role_'.$kasus->nomor_kasus))
					<button class="btn btn-circle btn-sm btn-outline-danger mr-5 mb-5 deleteBtn" data-id="{{$item->id}}">
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
	<h4 class="font-w400 mb-5">Belum ada Form Plebitis </h4><br>
	<p>Klik tombol <b>Isi Surveilans Plebitis</b> untuk melakukan penilaian</p>
</div>

@endif
<hr>
@empty
<div class="text-center py-50">
	<h4 class="font-w400 mb-5">Belum ada Cath </h4><br>
	<p>Klik tombol <b>Tambah Cath</b> untuk melakukan penilaian</p>
</div>
@endforelse