@forelse($master_vap as $master)
@php $master_item = json_decode($master->val) @endphp
<div class="bg-primary p-10 mb-20 text-white">
	<span class="mr-5"> Tanggal Pasang : @if(!empty($master_item->tanggal_pasang)){{$master_item->tanggal_pasang}}@endif</span>
	<span class="mr-5"> Tanggal Lepas : @if(!empty($master_item->tanggal_lepas)){{$master_item->tanggal_lepas}}@endif</span>

	<span class="mr-5"> Jenis Ventilator : {{$master_item->jenis_ventilator ?? ''}}</span>
</div>
<hr>

<div class="row">
	<div class="col-12">
		<button type="button" class="btn btn-primary float-right ml-5  btn-modal-surveilans" data-toggle="modal" data-target="#addModal" data-parent-id="{{$master->id}}"><i class="fa fa-plus"></i> Surveilans VAP</button>
		<button type="button" class="btn btn-secondary min-width-125 float-right btn-modal-master" data-val="{{$master->val}}" data-id="{{$master->id}}"><i class="fa fa-pencil"></i> Edit Ventilator</button>
		<button type="button" class="btn btn-danger min-width-125 float-right deleteBtn" data-id="{{$master->id}}"><i class="fa fa-trash"></i> Hapus Ventilator</button>
	</div>
</div> 

@php $vap = $master->children @endphp
@php $count = count($vap) @endphp

@if($count > 0)

<div class="row pt-10">
	<div class="col-md-12 autoscroll-x">
		<table class="table table-sm table-borderless table-vcenter table-striped" style="width: 100%">
			<tr>
				<th style="min-width:120px">Parameter</th>
				@foreach($vap as $item)
				<th class="text-center">{{$item->created_at->format('d')}}</th>
				@endforeach
			</tr>

			
			<tr>
				<td>Demam >= 38 C rektal</td>
				@foreach($vap as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->demam))
					@if($item_value->demam) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Leukopenia < 4000 WBC/mm3 atau Leukositosis >= 12.000 SDP/mm3</td>
				@foreach($vap as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->leukositosis))
					@if($item_value->leukositosis) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Timbul Sputum Purulen</td>
				@foreach($vap as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->sputum))
					@if($item_value->sputum) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Peningkatan FiO2 >= 0.2</td>
				@foreach($vap as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->fio2))
					@if($item_value->fio2) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Peningkatan PEEP setiap hari sebesar >= 3cm H20 dari PEEP sebelumnya selama 2 hari berturut turut</td>
				@foreach($vap as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->peep))
					@if($item_value->peep) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Kultur Sputum</td>
				@foreach($vap as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->kultur_sputum))
					@if($item_value->kultur_sputum) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Kultur Sputum Keterangan</td>
				@foreach($vap as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->kultur_sputum_keterangan))
					{{$item_value->kultur_sputum_keterangan}}
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Thorax foto gambaran pneumonia yang sebelumya tidak ada</td>
				@foreach($vap as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->thorax_foto))
					@if($item_value->thorax_foto) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Diagnosis Dokter</td>
				@foreach($vap as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->dx_dokter))
					@if($item_value->dx_dokter) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Info</td>
				@foreach($vap as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">

					<button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 " data-toggle="tooltip" data-html="true" title="@include('kasus.alatbantu.monitoring-ventilator.tooltip')" data-placement="left">
						<i class="fa fa-info"></i>
					</button>

				</td>
				@endforeach
			</tr>
			<tr>
				<td>Hapus</td>
				@foreach($vap as $item)
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
	<h4 class="font-w400 mb-5">Belum ada Form VAP </h4><br>
	<p>Klik tombol <b>Isi Surveilans VAP</b> untuk melakukan penilaian</p>
</div>
@endif
<hr>
@empty
<div class="text-center py-50">
	<h4 class="font-w400 mb-5">Belum ada Ventilator </h4><br>
	<p>Klik tombol <b>Tambah Ventilator</b> untuk melakukan penilaian</p>
</div>
@endforelse