<li class="col-lg-3 col-sm-12 d-flex align-items-stretch">
	<div class="block block-bordered py-20" style="width: 100%">
		<div class="block-header">
			<div class="block-title text-center min-height-75 title">
				{{$title}}
			</div>
		</div>
		<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
			{{$subtitle}}
		</div>
		<div class="block-content block-content-full text-center pt-0">
			<button type="button" class="btn btn-secondary min-width-125" data-toggle="modal" data-target="#{{$modal_target}}">Buat Laporan</button>
			@if (isset($lab_pa_setting))
				<a class="btn btn-warning min-width-125 mt-10" href="{{url('mutu/laporan/pengaturan/labpa')}}">Pengaturan</a>
			@endif
		</div>
	</div>
	<div id="{{$modal_target}}" class="modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-bg">
			<div class="modal-content ">
				<div class="modal-body">
					<form method="get" action="{{url()->current().'/'.$form_url}}" class="js-validation-be-contact">
						{{ csrf_field() }}
						<div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan {{$title}}</div>
						@if (isset($form_fields))
							@foreach ($form_fields as $key => $item)
								@switch($item)
									@case('date_range')
										<div class="form-group row">
											<label class="col-12">{{$form_labels[$key] ?? 'Tanggal'}}</label>
											<div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
												<input type="text" class="form-control" autocomplete="off" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{date('d/m/Y')}}">
												<div class="input-group-prepend input-group-append">
													<span class="input-group-text font-w600">to</span>
												</div>
												<input type="text" class="input-daterange-custom form-control" autocomplete="off" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{date('d/m/Y')}}">
											</div>
										</div>
										@break
									@case('user')
										<div class="form-group row">
											<label class="col-12">{{$form_labels[$key] ?? 'User'}}</label>
											<div class="col-12">
												<select name="user" class="js-select2 form-control" style="width: 100%">
													<option value="Semua">Semua</option>
													@foreach($users as $item)
													<option value="{{$item->id}}">{{$item->name}}</option>
													@endforeach
												</select>
											</div>
										</div>
										@break
									@case('triwulan')
										<div class="form-group">
											<label>Pilih Triwulan</label>
											<select name="triwulan" id="triwulan" class="form-control" required>
												<option value="">Pilih Triwulan</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
											</select>
										</div>
										<div class="form-group">
											<label class="col-12">Tahun</label>
											<select name="tahun" id="tahun" class="form-control" required>
												<option value="">Pilih Tahun</option>
												@php $tahun = date("Y"); @endphp
												@for($i=$tahun;$i>$tahun-10;$i--)
												<option value="{{$i}}">{{$i}}</option>
												@endfor
											</select>
										</div>
									@break
									@case('field_custom')
									@if (is_array($form_field_custom) && !empty($form_field_custom[$key]))
										{!! $form_field_custom[$key] !!}
									@endif
									@break
									@default
								@endswitch
							@endforeach
						@endif
						@if (isset($form_field_custom) && !is_array($form_field_custom))
							{!! $form_field_custom !!}
						@endif
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary submit-button">Print</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</li>
