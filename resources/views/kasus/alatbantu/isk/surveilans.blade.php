@forelse($master_isks as $master_isk_item)
@php $master_isk = json_decode($master_isk_item->val) @endphp
<div class="bg-primary p-10 mb-20 text-white text-capitalize">
	<span class="mr-5"> Tanggal Pasang : @if(!empty($master_isk->tanggal_pasang)){{$master_isk->tanggal_pasang}}@endif</span>
	<span class="mr-5"> Tanggal Lepas : @if(!empty($master_isk->tanggal_lepas)){{$master_isk->tanggal_lepas}}@endif</span>

	<span class="mr-5"> Jenis Cath : {{$master_isk->jenis_cath ?? ''}}{{$master_isk->jenis_cath_lain ?? ''}}  </span>
	<span class="mr-5"> Nomor Cath : {{$master_isk->nomor_cath ?? ''}}{{$master_isk->nomor_cath_lain ?? ''}}</span>
</div>

<div class="row">
	<div class="col-12">
		<button type="button" class="btn btn-primary float-right ml-5  btn-modal-surveilans" data-toggle="modal" data-target="#addModal" data-parent-id="{{$master_isk_item->id}}"><i class="fa fa-plus"></i> Surveilans ISK</button>
		<button type="button" class="btn btn-secondary min-width-125 float-right btn-modal-master" data-val="{{$master_isk_item->val}}" data-id="{{$master_isk_item->id}}"><i class="fa fa-pencil"></i> Edit Cath</button>
		<button type="button" class="btn btn-danger min-width-125 float-right deleteBtn" data-id="{{$master_isk_item->id}}"><i class="fa fa-trash"></i> Hapus Cath</button>
	</div>
</div> 

@php $isk = $master_isk_item->children @endphp
@php $count = count($isk) @endphp

@if($count > 0)

<div class="row pt-10">
	<div class="col-md-12 autoscroll-x">
		<table class="table table-sm table-borderless table-vcenter table-striped" style="width: 100%">
			<tr>
				<th style="min-width:120px">Parameter</th>
				@foreach($isk as $item)
				<th class="text-center">{{$item->created_at->format('d')}}</th>
				@endforeach
			</tr>

			@if($kasus->identitas->usia_masuk > 365)
			<tr>
				<td>Demam >= 38 C</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->demam))
					@if($item_value->demam) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Urgency</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->urgency))
					@if($item_value->urgency) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Frequency</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->frequency))
					@if($item_value->frequency) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Dysuria</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->dysuria))
					@if($item_value->dysuria) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Nyeri supra-pubic</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->suprapubic))
					@if($item_value->suprapubic) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			@else
			<tr>
				<td>Demam >= 38 C rektal</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->demam))
					@if($item_value->demam) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Hipothermi < 37 C rektal</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->hipothermi))
					@if($item_value->hipothermi) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Apneu</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->apneu))
					@if($item_value->apneu) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Brakikardia</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->brakikardia))
					@if($item_value->brakikardia) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Lekargia</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->lekargia))
					@if($item_value->lekargia) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Muntah muntah</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->muntah))
					@if($item_value->muntah) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			@endif
			<tr>
				<td>Tes Carik Celup Positif</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->tes_carik_celup))
					@if($item_value->tes_carik_celup) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Pyuria (>= 10 leukosit urin)</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->pyuria))
					@if($item_value->pyuria) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Ditemukan kuman dengan pewarnaan gram dari urin yang tidak disentrifugasi</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->ditemukan_kuman))
					@if($item_value->ditemukan_kuman) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Paling sedikit 2 kultur urin ulangan didapatkan urapatogen yang sama.</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->urapatogen))
					@if($item_value->urapatogen) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Kuman biakan urine >= 10^5 / ml</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->kuman))
					@if($item_value->kuman) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Kultur Urine</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->kultur_urine))
					@if($item_value->kultur_urine) <i class="fa fa-check"></i>@endif
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Kultur Sputum Keterangan</td>
				@foreach($isk as $item)
				@php $item_value = json_decode($item->val) @endphp
				<td class="text-center">
					@if(!empty($item_value->kultur_urine_keterangan))
					{{$item_value->kultur_urine_keterangan}}
					@endif
				</td>
				@endforeach
			</tr>
			<tr>
				<td>Diagnosis Dokter</td>
				@foreach($isk as $item)
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
				@foreach($isk as $item)
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
				@foreach($isk as $item)
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
	<h4 class="font-w400 mb-5">Belum ada Form ISK </h4><br>
	<p>Klik tombol <b>Isi Surveilans ISK</b> untuk melakukan penilaian</p>
</div>

@endif
<hr>
@empty
<div class="text-center py-50">
	<h4 class="font-w400 mb-5">Belum ada Cath </h4><br>
	<p>Klik tombol <b>Tambah Cath</b> untuk melakukan penilaian</p>
</div>
@endforelse