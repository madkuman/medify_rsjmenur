
@forelse($master_bsi as $master)
@php $master_val = json_decode($master->val) @endphp
<div class="bg-primary p-10 mb-20 text-white text-capitalize">
	<span class="mr-5"> Tanggal Pasang : @if(!empty($master_val->tanggal_pasang)){{$master_val->tanggal_pasang}}@endif</span>
	<span class="mr-5"> Tanggal Lepas : @if(!empty($master_val->tanggal_lepas)){{$master_val->tanggal_lepas}}@endif</span>

	<span class="mr-5"> Lokasi CVC : {{$master_val->lokasi ?? ''}}{{$master_val->lokasi_lainnya ?? ''}}  </span>
	<span class="mr-5"> Nomor CVC : {{$master_val->nomor ?? ''}}{{$master_val->nomor_lainnya ?? ''}}</span>
	<span class="mr-5"> Jenis CVC : {{$master_val->jenis ?? ''}}</span>
</div>
<hr>


<div class="row">
	<div class="col-12">
		<button type="button" class="btn btn-primary float-right ml-5  btn-modal-surveilans" data-toggle="modal" data-target="#addModal" data-parent-id="{{$master->id}}"><i class="fa fa-plus"></i> Surveilans BSI</button>
		<button type="button" class="btn btn-secondary min-width-125 float-right btn-modal-master" data-val="{{$master->val}}" data-id="{{$master->id}}"><i class="fa fa-pencil"></i> Edit CVC</button>
		<button type="button" class="btn btn-danger min-width-125 float-right deleteBtn" data-id="{{$master->id}}"><i class="fa fa-trash"></i> Hapus CVC</button>
	</div>
</div> 


@php $bsi = $master->children @endphp
@php $count = count($bsi) @endphp

@if($count > 0)

<div class="row pt-10">
	<div class="col-md-12 autoscroll-x">
		<table class="table table-sm table-borderless table-vcenter table-striped" style="width: 100%">
			<tr>
				<th style="min-width:120px">Parameter</th>
				@foreach($bsi as $item)
				<th class="text-center">{{$item->created_at->format('d')}}</th>
				@endforeach
			</tr>
			<tr>
				<td>Kuman pada kultur darah</td>
				@foreach($bsi as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->kuman) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>

			@if($kasus->identitas->usia_masuk > 365)
			<tr>
				<td>Demam >= 38 C</td>
				@foreach($bsi as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->demam) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Hipotensi</td>
				@foreach($bsi as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->hipotensi) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Menggigil</td>
				@foreach($bsi as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->menggigil) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			@else
			<tr>
				<td>Demam >= 38 C / Rectal</td>
				@foreach($bsi as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->demam) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Hipothermi <= 37 C / Rectal</td>
				@foreach($bsi as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->hipothermi) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Apneu</td>
				@foreach($bsi as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->apneu) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Brakikardia</td>
				@foreach($bsi as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->brakikardia))
					@if($item_value->brakikardia) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			@endif
			<tr>
				<td>Kultur CVC</td>
				@foreach($bsi as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->kultur_cvc))
					@if($item_value->kultur_cvc) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Kultur CVC Keterangan</td>
				@foreach($bsi as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->kultur_cvc_keterangan))
					{{$item_value->kultur_cvc_keterangan}}
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Diagnosis Dokter</td>
				@foreach($bsi as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if($item_value->dx_dokter) <i class="fa fa-check"></i>@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Info</td>
				@foreach($bsi as $item)
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
				@foreach($bsi as $item)
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
	<h4 class="font-w400 mb-5">Belum ada Surveilans BSI </h4><br>
	<p>Klik tombol <b>Isi Surveilans BSI</b> untuk melakukan penilaian</p>
</div>

@endif
<hr>

@empty
<div class="text-center py-50">
	<h4 class="font-w400 mb-5">Belum ada CVC </h4><br>
	<p>Klik tombol <b>Tambah CVC</b> untuk melakukan penilaian</p>
</div>
@endforelse