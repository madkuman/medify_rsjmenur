@if(session('my_role_'.$kasus->nomor_kasus))
<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal2"><i class="fa fa-pencil"></i> Isi Surveilans Dekubitus</button>
@endif
<h4>Surveilans Dekubitus</h4>
<hr>
@php $count = count($surveilans) @endphp
@if($count > 0)

<div class="row">	
	<div class="col-12">
		<table class="table table-sm table-bordered table-vcenter" style="width: 100%">
			<tbody>
				<tr>
					<th style="min-width:120px"  colspan="2">Parameter</th>
					@foreach($surveilans as $item)
					<th class="text-center">{{$item->created_at->format('d')}}</th>
					@endforeach
				</tr>
				<tr class="table-danger">
					<td class="text-center" colspan="{{count($surveilans) + 2}}">
						Gejala
					</td>
				</tr>
				<tr>
					<td colspan="2">Derajat</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						{{$item_value->derajat ?? '-'}}
					</td>
					@endforeach
				</tr>
				<tr class="">
					<td class="text-center" rowspan="4">I</td>
					<td>Temperatur Kulit (Lebih Dingin/Hangat)</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->temperatur_kulit))
						@if($item_value->temperatur_kulit) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td>Konsistensi Jaringan (Lebih Keras/Lunak)</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->konsitensi_jaringan))
						@if($item_value->konsitensi_jaringan) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td>Gatal</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->gatal))
						@if($item_value->gatal) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td>Nyeri</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->nyeri))
						@if($item_value->nyeri) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td class="text-center" rowspan="3">II</td>
					<td>Abrasi</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->abrasi))
						@if($item_value->abrasi) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td>Melepuh</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->melepuh))
						@if($item_value->melepuh) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td>Lubang yang dangkal</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->lubang_yang_dangkal))
						@if($item_value->lubang_yang_dangkal) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td class="text-center" rowspan="2">III</td>
					<td>Necrosis Jaringan Subkutan</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->necrosis_jaringan_subkutan))
						@if($item_value->necrosis_jaringan_subkutan) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td>Lubang yang dalam</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->lubang_yang_dalam))
						@if($item_value->lubang_yang_dalam) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td class="text-center" rowspan="2">IV</td>
					<td>Necrosis Luas</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->necrosis_luas))
						@if($item_value->necrosis_luas) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td>Kerusakan Otot Tulang Tendon</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->kerusakan_otot_tulang))
						@if($item_value->kerusakan_otot_tulang) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr class="table-danger">
					<td class="text-center" colspan="{{count($surveilans) + 2}}">
						Tatalaksana
					</td>
				</tr>
				<tr>
					<td colspan="2">Ganti Posisi</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->ganti_posisi))
						@if($item_value->ganti_posisi) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td colspan="2">Kasur Angin / Air</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->kasur_angin))
						@if($item_value->kasur_angin) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td colspan="2">Perban Hidrokoloid</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->perban_hidrokoloid))
						@if($item_value->perban_hidrokoloid) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td colspan="2">Perban Alginat</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->perban_alginat))
						@if($item_value->perban_alginat) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td colspan="2">Krim dan Salep</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->krim_dan_salep))
						@if($item_value->krim_dan_salep) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td colspan="2">Antibiotik</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->antibiotik))
						@if($item_value->antibiotik) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td colspan="2">Suplemen Makanan</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->suplemen_makanan))
						@if($item_value->suplemen_makanan) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td colspan="2">Debridement</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->debridement))
						@if($item_value->debridement) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td colspan="2">Analgesik</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->analgesik))
						@if($item_value->analgesik) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td colspan="2">Pembedahan</td>
					@foreach($surveilans as $item)
					@php $item_value = json_decode($item->val) @endphp
					<td class="text-center">
						@if(!empty($item_value->pembedahan))
						@if($item_value->pembedahan) <i class="fa fa-check"></i>@endif
						@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td colspan="2">Info</td>
					@foreach($surveilans as $item)
					<td class="text-center">
					<button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 " data-toggle="tooltip" data-html="true" title="@include('kasus.alatbantu.isk.tooltip')" data-placement="left">
						<i class="fa fa-info"></i>
					</button>
					</td>
					@endforeach
				</tr>
				<tr>
					<td colspan="2">Edit</td>
					@foreach($surveilans as $item)
					<td class="text-center">
					@if(session('my_role_'.$kasus->nomor_kasus))
					<button class="btn btn-circle btn-outline-primary btn-sm mr-5 mb-5 editBtnSurveilans" data-id="{{$item->id}}">
						<i class="fa fa-edit"></i>
					</button>
					@endif
					</td>
					@endforeach
				</tr>
				<tr>
					<td colspan="2">Hapus</td>
					@foreach($surveilans as $item)
					<td class="text-center">
					@if(session('my_role_'.$kasus->nomor_kasus))
					<button class="btn btn-circle btn-outline-danger btn-sm mr-5 mb-5 deleteBtnSurveilans" data-id="{{$item->id}}">
						<i class="fa fa-trash"></i>
					</button>
					@endif
					@endforeach
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<hr class="my-20">
@else

<div class="text-center py-50">
	<h4 class="font-w400 mb-5">Belum ada hasil Surveilans Dekubitus tersedia</h4>
	<p>Klik tombol <b>Surveilans Baru</b> untuk mencatat Surveilans Dekubitus</p>
</div>

@endif