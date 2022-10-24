@extends('it.layouts.main')

@section('title')
IT - Medify
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
<main id="main-container">
	<div class="row">
		<div class="col-12">
			@include('it.layouts.header')
		</div>
	</div>
	<div class="container">
		<form class="" method="POST" action="{{url()->current()}}" id="form-respon">
			{{ csrf_field() }}
			<div class="block rounded block-transparent mb-0">
				<div class="block-header">
					<h4 class="font-w400 mb-0" id="modal-respon-title">Penyebab</h4>
				</div>
				<div class="block-content">
					<h5 class="mb-5">{{$komplain->lokasi}}</h5>
					<h6 class="mb-5"><span class="font-w400">Dilaporkan oleh :</span> {{$komplain->creator->name}}</h6>
					<h6 class="mb-5"><span class="font-w400">Waktu Pelaporan :</span> {{indonesian_date($komplain->waktu_respon,'d F Y H:i')}}</h6>
					

					<h5 class="font-w400 mb-0 text-uppercase"><small>Pesan</small></h5>
					<h5 class="font-w400">
						{{$komplain->pesan}}
					</h5>
					@if(!is_null($komplain->image_paths))
						<h6 class="font-w400 mb-0 text-uppercase">Gambar</h6>
					<div class="row items-push">
						@foreach(json_decode($komplain->image_paths) as $item)
						<div class="col-md-4 animated fadeIn">
							<div class="options-container fx-item-zoom-in">
								<img class="img-fluid options-item" src="{{url('').'/'.$item}}" alt="">
								<div class="options-overlay bg-black-op">
									<div class="options-overlay-content">
										<h4 class="h6 text-white-op mb-15">More Details</h4>
										<a class="btn btn-sm btn-rounded btn-alt-info selector full-only" href="{{url('').'/'.$item}}">
											<i class="fa fa-pencil"></i> Detail
										</a>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
					@endif

					<hr>
					<h5>Pencatatan Hasil Solusi</h5>
					<div class="row">
						<div class="col-lg-6 col-md-8 col-12">
							<div class="row">
								<div class="col-md-4 ">
									<div class="form-group">
										<label class="control-label">Tanggal Perbaikan</label>
										<input type="text" class="form-control js-datepicker" name="tgl_komplain" data-date-format="dd-mm-yyyy" 
										value="@if(!empty($komplain->waktu_respon)) {{indonesian_date($komplain->waktu_respon,'d-m-Y')}} @else {{date('d-m-Y')}} @endif
										">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Jam Perbaikan</label>

										@php
											if(!empty($komplain->waktu_respon))
											{
												$default_jam = indonesian_date($komplain->waktu_respon,'H');
												$default_menit = indonesian_date($komplain->waktu_respon,'i');
											}
											else
											{
												$default_jam = date('H');
												$default_menit = date('i');
											}
										@endphp

										<div class="row gutters-tiny">
											<div class="col-6">
												<select class="form-control" name="jam_komplain" style="width: 100%;">
													<option value="">Jam</option>
													@for($i=00; $i<=23; $i++)
													<option value="{{$i}}" @if($default_jam == $i){{'selected'}}@endif>{{$i}}</option>
													@endfor
												</select>
											</div>
											<div class="col-6">
												<select class="form-control" name="menit_komplain" style="width: 100%;">
													<option value="">Menit</option>
													@for($i=00; $i<=59; $i++)
													<option value="{{$i}}" @if($default_menit == $i){{'selected'}}@endif>{{$i}}</option>
													@endfor
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label">Jenis Penyebab</label>
								<select class="form-control" id="respon_jenis_komplain_id" name="jenis_komplain_id" style="width: 100%;" required>
									@foreach($jenis_komplain as $jenis_komplain_item)
									<option value="{{$jenis_komplain_item->id}}" @if($komplain->jenis_komplain_id == $jenis_komplain_item->id) selected @endif>{{$jenis_komplain_item->nama}}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label class="control-label">Hasil Perbaikan</label>
								<textarea class="form-control form-control-lg" name="respon" rows="3" placeholder="Isikan Solusi Perbaikan" required>{{$komplain->respon}}</textarea>
							</div>

							<div class="form-group">
								<label class="control-label">Teknisi</label>
								<select class="form-control" name="teknisi" id="teknisi" style="width: 100%;" required>
									<option></option>
									@foreach($teknisi as $teknisi_item)
									<option value="{{$teknisi_item->id}}" @if($teknisi_item->id == $komplain->teknisi) selected @endif>{{$teknisi_item->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<button type="submit" class="btn-alt btn-hero btn-primary min-width-125" id="btn-save">
									<i class="fa fa-send mr-5"></i> Simpan
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
</div>
</main>
@endsection

@section('js')
@endsection 	