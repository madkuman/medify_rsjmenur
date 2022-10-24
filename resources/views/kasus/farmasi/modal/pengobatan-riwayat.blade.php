
<div class="modal" id="riwayatModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header" style="width: 100%">
					<h3 class="block-title">Riwayat Pemberian Obat</h3>
					<a class="btn zoom" data-toggle="tooltip" title="Zoom In"><i class="fas fa-search-plus"></i></a>
					<a class="btn zoom-out" data-toggle="tooltip" title="Zoom Out"><i class="fas fa-search-minus"></i></a>
					<a class="btn zoom-init" data-toggle="tooltip" title="Default"><i class="fas fa-recycle"></i></a>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" data-toggle="tooltip" title="Close" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content" style="height: 530px; overflow-x: scroll; overflow-y: scroll;padding-left: 0px;padding-top: 0">
					<table class="table table-bordered table-striped table-vcenter tableFixHead target">
						<thead>
							<tr>
								<th rowspan="2" class="headcolrow">Nama Obat</th>
                                <th rowspan="2" class="headrow-1"></th>
								@foreach($riwayat_date as $item)
								<th colspan="{{$riwayat_date_count[$item->format('d F Y')]}}" class="text-center headrow-1">{{$item->format('d F')}}</th>
								@endforeach
							</tr>
							<tr>
								@foreach($riwayat_date as $item)
								@php $count = $riwayat_date_count[$item->format('d F Y')] @endphp
								@for($i = 1; $i <= $count; $i++)
								<th class="text-center headrow-2" style="border-top: 1px solid gainsboro; border-bottom: 1px solid gainsboro">{{$i}}</th>
								@endfor
								@endforeach
							</tr>
						</thead>
						<tbody>
							@foreach($pengobatan as $index => $obat)
                                @php
                                    $striped = $index%2==0 ? 1 : 0;
                                @endphp
							<tr @if($striped) class="tr-striped" @endif>
								<td rowspan="2" class="headcol"><p style="white-space: pre">{{$obat->nama_obat ?? "-"}}</p></td>
								<td>Jam</td>
								@php $index = 0 @endphp
								@php $count_td = 0 @endphp

								@php $array_item_printed = [] @endphp
								@foreach($riwayat_date as $date_now)
								@php $count = $riwayat_date_count[$date_now->format('d F Y')] @endphp


								@for($i = 1; $i <= $count; $i++)

								@php
									if(count($obat->details) > 0)
									{
										if(!empty($obat->details[$index]))
										{
											$time = $obat->details[$index]->pemberian_at;
											$start = $date_now->copy()->startOfDay();
											$end = $date_now->copy()->endOfDay();

											$bool = Carbon\Carbon::parse($time)->between($start, $end);
										}
										else $bool = false;
									}
									else $bool = false;
								@endphp

								@if($bool)
								@php $array_item_printed[$count_td++] = $index @endphp
								<td class="px-0">
									@php 
									$status = $obat->details[$index]->status;

									if($status == 'sukses'){
										$color = 'bg-primary';
										$status = 'Obat Telah Diberikan';
									}
									else if($status == 'pasien_tolak'){
										$color = 'bg-success';
										$status = 'Pasien Menolak';
									}
									else if($status == 'kondisi'){
										$color = 'bg-flat';
										$status = 'Batal karena kondisi';
									}
									else if($status == 'alergi'){
										$color = 'bg-danger';
										$status = 'Reaksi alergi';
									}
									else if($status == 'eso'){
										$color = 'bg-warning';
										$status = 'Efek samping obat';
									}
									else if($status == 'tap'){
										$color = 'bg-info';
										$status = 'obat tidak tersedia';
									}
									@endphp

									<div class="{{$color}} text-light text-center js-popover" href="javascript:void(0)" data-toggle="popover" title="" data-placement="left" data-content="<b>Status</b> : {{$status}}<br><br> <b>Evaluasi</b> : {{$obat->details[$index]->evaluasi}}<br><br> <b>Inisial</b> : {{$obat->details[$index]->verifikator_1->name ?? '-'}} & {{$obat->details[$index]->verifikator_2->name ?? '-'}}" data-original-title="Detail" data-html="true" style="width: 100%;">{{indonesian_date($obat->details[$index]->pemberian_at,'H:i')}}</div>
								</td>
								@php $index++ @endphp
								@else
								@php $array_item_printed[$count_td++] = 404 @endphp
								<td class="px-0">
								</td>
								@endif

								@endfor
								@endforeach
							</tr>
							<tr>
								<td>Edit</td>
								@foreach($array_item_printed as $item)
								<td class="text-center">
									@if($item!= 404)
									<button class="btn btn-sm btn-circle btn-outline-success isiPemberianBtn" data-id="{{$obat->details[$item]->id}}" data-nama="{{$obat->nama_obat}}" data-method="edit" data-content="{{json_encode($obat->details[$item])}}">
										<i class="fa fa-pencil"></i>
									</button>
									@endif
								</td>
								@endforeach
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>