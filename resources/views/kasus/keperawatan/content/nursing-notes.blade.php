<div class="block-content tab-content overflow-hidden px-50 pb-30">
	<div class="row">
		<div class="col-lg-12">
			@if(session('my_role_'.$kasus->nomor_kasus))
			<button type="button" class="btn-alt btn-primary min-width-125 float-right toggleFormBtn" data-method="create" ><i class="fa fa-pencil"></i> Buat Baru</button>
			@endif
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-striped table-vcenter">
			<thead>
				<tr>
					<th style="width: 10%">Jam</th>
					<th style="width: 30%">Implementasi</th>
					<th style="width: 30%">Evaluasi</th>
					<th class="text-center" style="width: 10%">Verifikasi</th>
					<th class="text-center" style="width: 20%">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@php $current_date = 0 @endphp
				@foreach($nursing_notes as $item)

				@php $slug_specialty_user = Auth::user()->specialty_detail->slug ?? '-' @endphp

				@php $created_at = indonesian_date($item->created_at) @endphp
				@if( $created_at != $current_date)
				<tr class="table-warning text-center">
					<td colspan="5">{{$created_at}}</td>
				</tr>
				@php $current_date = $created_at @endphp
				@endif
				<tr>
					<td style="width: 10%">{{$item->jam}}</td>
					<td style="width: 30%">
						@php $diagnosa = '' @endphp

						@foreach($item->details as $item_detail)
						@if($diagnosa != ($item_detail->implementasi->rencana_asuhan->diagnosa ?? $item_detail->diagnosa_text))
						@if(!$loop->first) </ul> @endif
						
						<strong>{{$item_detail->implementasi->rencana_asuhan->diagnosa ?? $item_detail->diagnosa_text}}</strong>
						<ul>
						@php $diagnosa = $item_detail->implementasi->rencana_asuhan->diagnosa ?? $item_detail->diagnosa_text@endphp
						@endif

							<li>{{$item_detail->implementasi->konten ?? $item_detail->implementasi_text}}</li>

						@if($loop->last) </ul>@endif
						@endforeach
					</td>
					<td style="width: 30%;white-space: pre">{!! $item->evaluasi !!}</td>
					<td class="text-center" style="width: 10%">
						@if(!empty($item->verified_at))
						<button class="btn btn-circle btn-success btn-sm" type="button"  data-toggle="tooltip" data-placement="top" title="Di verifikasi oleh {{$item->verifikator->name}}, {{indonesian_date($item->verified_at,'d F Y H:i')}}"> 
							<i class="fa fa-check"></i>
						</button>
						@else
						@if($slug_specialty_user == 'perawat-ners' || $slug_specialty_user == 'magister-keperawatan')
						<a href="{{url()->current()}}/verifikasi/{{$item->id}}" class="btn btn-primary btn-sm" type="button"  data-toggle="tooltip" data-placement="top" title="Verifikasi"> 
							<i class="fa fa-check"></i> Verifikasi
						</a >
						@endif
						@endif
					</td>
					<td class="text-center" style="width: 20%">
						<button type="button" class="btn btn-secondary dropdown-toggle" id="btnGroupDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</button>
						<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
							<a class="dropdown-item" href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Dibuat oleh {{$item->creator->name}}, {{indonesian_date($item->created_at,'d F Y H:i')}}">
								<i class="fa fa-info-circle mr-5"></i>Info
							</a>
							@if(Auth::user()->id == $item->created_by)
							<a class="dropdown-item toggleFormBtn" data-id="{{$item->id}}" data-jam="{{$item->jam}}" data-method="edit" data-diagnosis="{{$item->diagnosis_id}}" data-implementasi="{{json_encode($item->details->pluck('implementasi_id')->toArray())}}" data-evaluasi="{{$item->evaluasi}}"  href="javascript:void(0)">
								<i class="fa fa-pencil mr-5"></i>Edit
							</a>
							<a class="dropdown-item deleteBtn" data-id="{{$item->id}}" href="javascript:void(0)">
								<i class="fa fa-trash mr-5"></i>Hapus
							</a>
							@endif
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
</form>