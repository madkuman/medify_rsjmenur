@extends('kepegawaian.layouts.main-profile')

@section('title')
Kepegawaian | Pelatihan
@endsection

@section('subtitle')
Data Pelatihan
@endsection

@section('main-content')
<div class="card"> 
	<div class="card-body px-20"> 
		<div class="col-12 my-20">
			<div class="row">
				<div class="col-12 text-right float-right">
					<a href="javascript:void(0)" class="btn-add btn btn-alt-primary pull-right"><i class="fa fa-plus mr-5 mb-10"></i> Tambah</a>
					{{-- <button id="button-add-training" type="button" class="btn btn-alt-primary pull-right" data-toggle="modal" data-target="#modal-add-training">
						<i class="fa fa-plus mr-5 mb-10"></i> Tambah
					</button> --}}
				</div>
			</div>
			<div class="row">
				<div class="col-12 mb-30">
					<h5 class="card-title font-w400">KURSUS / PELATIHAN / SEMINAR</h5>
					<hr>
					<div class="table-responsive-md">
						@if($items->total() < 1)
						<p>Tidak ada data</p>
						@else
						@include('kepegawaian.layouts.partials.pagination')
						<table id="table-training" class="table table-striped table-hover mt-10"> 
							<thead>
								<tr>
									<th style="width: 10%" class="align-middle text-center">NO</th>
									<th style="width: 20%" class="align-middle text-center">PELATIHAN</th>
									<th style="width: 20%" class="align-middle text-center">TAHUN</th>
									<th style="width: 25%" class="align-middle text-center">TEMPAT</th>
									<th style="width: 10%" class="align-middle text-center">STATUS</th>
									<th style="width: 15%" class="align-middle text-center">AKSI</th>
								</tr>
							</thead>
							<tbody>
								@foreach($items->getCollection() as $key => $item)
								<tr> 
									<td class="text-center">{{(($items->currentPage() - 1) * $items->perPage()) + ($key + 1)}}
									<span class="master_id hide">{{$item->master_pelatihan_id}}</span></td>
									<td class="nama">{{ !empty($item->master_pelatihan->nama) ? $item->master_pelatihan->nama : '-' }}</td>
									<td class="text-center">{{ !empty($item->master_pelatihan->tahun) ? $item->master_pelatihan->tahun : '-' }}
									<span class="skor hide">{{ !empty($item->master_pelatihan->skor) ? $item->master_pelatihan->skor : '-' }}</span>
									<span class="tahun hide">{{ !empty($item->master_pelatihan->tahun) ? $item->master_pelatihan->tahun : '-' }}</span>
									<span class="durasi hide">{{ !empty($item->master_pelatihan->durasi) ? $item->master_pelatihan->durasi : '-' }}</span>	
									</td>
									<td class="tempat" >{{ !empty($item->master_pelatihan->tempat) ? $item->master_pelatihan->tempat : '-' }}</td>
									<td class="text-center status"><span class="badge {{ $item->status == 0 ? 'badge-danger' : 'badge-success'}}">{{ $item->status == 0 ? 'Belum Diverifikasi' : 'Sudah diverifikasi' }}</span></td>
									<td class="d-flex justify-content-center">
										<div class="row">
											{{-- <button type="button" class="btn btn-alt-warning btn-sm mr-5 detail-training-button" data-id="{{ $item->id }}" title="Lihat Detail"><i class="fa fa-search-plus"></i></button> --}}
											<a href="javascript:void(0)" class="btn-detail btn btn-alt-warning btn-sm mr-5 pull-right" data-id="{{$item->id}}" data-status="{{$item->status}}"><i class="fas fa-search-plus"></i></a>
											@if(!empty($item->master_pelatihan->sertifikat))
											<a href="{{route('file-pelatihan', ['emp' => $item->pegawai_id, 'id' => $item->master_pelatihan->sertifikat])}}" class="btn btn-alt-warning btn-sm mr-5" title="Lihat Sertifikat" target="_blank"><i class="fa fa-file"></i></a>
											@else
											<button type="button" class="btn btn-alt-warning btn-sm mr-5" disabled title="Lihat Sertifikat">
											<i class="fa fa-file"></i></button>
											@endif
											{{-- <button type="button" class="btn btn-alt-success btn-sm mr-5 edit-training-button" data-id="{{ $item->id }}" title="Edit Data">
												<i class="fa fa-pencil"></i>
											</button> --}}
											<a href="javascript:void(0)" class="btn-update btn btn-alt-success btn-sm mr-5 pull-right" data-id="{{$item->id}}"><i class="fas fa-pencil"></i></a>
											{{-- <form class="form-delete-training" method="POST" action="" enctype="multipart/form-data">
												{{csrf_field()}}
												<button type="button" class="btn btn-alt-danger btn-sm delete-training-button" data-id="{{ $item->id }}" title="Hapus Data">
													<i class="fa fa-trash"></i>
												</button>
											</form> --}}
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<!-- Pagination -->
						@include('kepegawaian.layouts.partials.pagination_bottom')
						@endif
					</div>
				</div>  
			</div>
			<!-- modal -->
			@include('kepegawaian.pegawai.pelatihan.components.modal-create')
			@include('kepegawaian.pegawai.pelatihan.components.modal-update')
			@include('kepegawaian.pegawai.pelatihan.components.modal-detail')
			@include('kepegawaian.pegawai.pelatihan.components.modal-delete')
		</div>
	</div>
</div> 
	@endsection

	@section('script')
	@include('kepegawaian.pegawai.pelatihan.components.js')
	<!-- All javascript function's files are included at main layout -->
	{{-- <script type="text/javascript">
		$(document).ready(function() {
			var name = 'Data pelatihan', 
			urlGetTraining = "{{ URL::to('/kepegawaian/get-training') }}" + "/",
			urlGetMTraining = "{{ URL::to('/kepegawaian/get-mtraining') }}" + "/",
			urlEditTraining = "{{ URL::to('/kepegawaian/pegawai/pelatihan/edit') }}",
			urlDeleteTraining = "{{ URL::to('/kepegawaian/pegawai/pelatihan/delete') }}",
			urlVerification = "{{ URL::to('/kepegawaian/pegawai/pelatihan/verification') }}",
			urlImage = "{{ URL::to('/kepegawaian/get-image/training') }}";

			jsSelect2();

		// FUNCTIONS
		//function check image exists
		function UrlExists(url){
			var req = new XMLHttpRequest();
			req.open('GET', url, false);
			req.send();
			return req.status==200;
		}

		function formatDate(tmt) {
			let date = new Date(tmt),
			monthNames = [
			"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
			day = date.getDate(),
			monthIndex = date.getMonth(),
			year = date.getFullYear(),
			hh = date.getHours(),
			mm = date.getMinutes();

			if (hh == 00 && mm == 00) {
				return day + ' ' + monthNames[monthIndex] + ' ' + year;
			} else {
				if(hh < 10) hh = "0" + hh;
				if(mm < 10) mm = "0" + mm;
				return day + ' ' + monthNames[monthIndex] + ' ' + year + ', ' + hh + '.' + mm;
			}      
		}

		function verifAlert(param1, param2, url, id, name) {
			$(param1).on('click', function() {
				console.log(id);
				swal({
					title: "Apakah anda yakin?",
					text: "Pastikan " + name.toLowerCase() + " yang akan diverifikasi sudah benar",
					type: "warning",
					showCancelButton: true,
					cancelButtonText: 'Tidak', 
					closeOnConfirm: false,
					confirmButtonText: "Ya, saya yakin!",
					confirmButtonColor: "#ec6c62"
				})
				.then((isConfirm) => {
					if(isConfirm.value) {
						$(param2).attr('action', url + "/" + id).submit();
					}
					else {
						swal("Batal Verifikasi", name + " tidak diverifikasi", "error");
					}
				});
			});
		}

		//ADD MODAL
		yearPicker();
		$('#button-add-training').on('click', function() {
			saveAlert(1, '#form-add-training','', name, 'form-add-training');
		});

		//DISPLAY DATA IN EDIT MODAL
		$('.edit-training-button').on('click', function() {
			let idEmployee = $(this).data('id');

			$.get(urlGetTraining + idEmployee, function(data) {
				let json = JSON.parse(data);
				console.log(json["ret"])
				$('#nama-pelatihan').val(json["ret"].name);
				jsSelect2();
				$('#tahun-pelatihan').val(json["ret"].period);
				yearPicker();
				$('#tempat-pelatihan').val(json["ret"].place);
				if(json["ret"].status == true)
					$('#upload-sertif').hide();
				$('#modal-edit-training').modal('show'); 
			});
			saveAlert(2, '#form-edit-training', urlEditTraining, name, idEmployee);
		});

		// DISPLAY DATA IN DETAIL MODAL
		$('.detail-training-button').on('click', function() {
			let idEmployee = $(this).data('id');

			$.get(urlGetTraining + idEmployee, function(data) {
				let json = JSON.parse(data);

				$('#info-nama-pelatihan').html(json["ret"].name);
				if(json["ret"].period)
					$('#info-tahun-pelatihan').html(json["ret"].period);
				else
					$('#info-tahun-pelatihan').html("—");
				// tempat pelatihan
				if(json["ret"].place)
					$('#info-tempat-pelatihan').html(json["ret"].place);
				else
					$('#info-tempat-pelatihan').html("—");
				// uploader
				$('#info-uploader').html(formatDate(json["ret"].created_at));
				$('#modal-detail-training #creator').html(json["ret"].creator_name);
				if(json["ret"].status) {
					$('#info-verificator').html("<p class='text-muted font-400 mb-1'>DIVERIFIKASI OLEH</p><h6 class='mb-2'>" + json["verificator"].name + "</h6><h6 class='font-w400'>" +  formatDate(json["ret"].verified_at) + "</h6>");
				} else {
					$('#verif-button').html('<div class="modal-footer"><form class="form-verifikasi" method="POST" action="" enctype="multipart/form-data">{{csrf_field()}}<button type="button" class="btn btn-alt-primary verification-button"><i class="fa fa-check mr-5"></i>Verifikasi</button></form></div>');
					verifAlert('.verification-button', '.form-verifikasi', urlVerification, idEmployee, name);
				}

				$('#modal-detail-training').modal('show');
			});
		});

		//DELETE CONFIRMATION
		deleteAlert('.delete-training-button', '.form-delete-training', urlDeleteTraining, name);

		//UPLOAD FILE
		$(document).on('change', '.btn-file :file', function() {
			var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
			var input = $(this).parents('.input-group').find(':text'),
			log = label;

			if( input.length ) {
				input.val(log);
			} else {
				if( log ) alert(log);
			}
		});

		function readURL(input, param) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$(param).attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#imgInp").change(function(){
			readURL(this, '#img-upload');
		});

		$("#imgInp-edit").change(function(){
			readURL(this, '#img-upload-edit');
		}); 

		});
	</script> --}}
@endsection