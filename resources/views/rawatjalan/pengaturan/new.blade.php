@extends('rawatjalan.layouts.main')

@section('title')
Poliklinik - Rawat Jalan - Medify
@endsection

@section('subtitle')
Daftar Poliklinik
@endsection

@section('content')
<main id="main-container">
	@include('rawatjalan.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="block  text-center pb-100">
					<div class="block-content block-content text-left">
						<h4>Buat Poliklinik Baru</h4>
						<hr>
					</div>
					<form method="POST" action="{{url()->current()}}" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="avatar-upload">
							<div class="avatar-edit">
								<input type='file' id="avatar" name="logo" accept=".png, .jpg, .jpeg" />
								<label for="avatar"></label>
							</div>
							<div class="avatar-preview">
								<div id="imagePreview" style="background-image: url('');">
								</div>
							</div>
						</div>
						<div class="row  justify-content-center">
							<div class="col-6">
								<div class="form-group text-left">
									<label for="name">Nama Poliklinik</label>
									<input type="text" class="form-control form-control-lg" id="name" name="name" value="">
								</div>
							</div>	
						</div>
						
						<div class="row justify-content-center">
							<div class="col-md-6">
								<div class="form-group text-left">
									<label for="plafon_sep">Plafon SEP</label>
									<input type="text" class="form-control form-control-lg" id="plafon_sep" name="plafon_sep" value="">
								</div>
							</div>
						</div>
						
						<div class="row justify-content-center">
							<div class="col-md-6">
								<div class="form-group text-left">
									<label for="plafon_sep">Tarif Konsultasi Dokter</label>
									<select class="js-select2 form-control" name="tarif_konsultasi_id">
										<option value="" selected disabled>Pilih</option>
										@foreach($tarif as $item)
										<option value="{{$item->id}}">{{$item->master->deskripsi ?? 'Tarif Unknown'}} - 
										@if($item->kelas_id == 0) Semua Kelas
										@else {{$item->kelas->nama ?? 'Kelas Unknown'}} 
										@endif
										- {{number_format($item->harga,0)}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-6">
								<div class="form-group text-left">
									<label for="plafon_sep">Mapping Poliklinik BPJS</label>
									<select class="js-select2 form-control" name="bpjs_id">
										<option value="" selected>Pilih</option>
										@foreach($poliklinik_bpjs as $item)
										<option value="{{$item->kode}}">{{$item->nama}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-6">
								<div class="form-group text-left">
									<label for="plafon_sep">Mapping Spesialis Dokter</label>
									<select class="js-select2 form-control" name="profesi_spesialis_id">
										<option value="" selected>Pilih</option>
										@foreach($spesialis as $item)
										<option value="{{$item->id}}">{{$item->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-6">
								<div class="form-group text-left">
                                    <label>SIRS - Kunjungan Kegiatan</label>
                                    <select class="js-select2 form-control" name="sirs_kunjungan_kegiatan" style="width: 100%;"required>
                                        <option value="" selected="" disabled="">Pilih Jenis Kunjungan Kegiatan</option>
                                        @foreach($all_sirs_kunjungan_kegiatan as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
						<div class="row justify-content-center">
							<div class="col-md-6">
								<div class="form-group text-left">
									<label for="interval-antrian">Interval Antrian (Menit)</label>
									<input type="number" class="form-control form-control-lg" id="interval-antrian" name="interval_antrian" value="10">
								</div>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-3">
								<div class="form-group text-left">
									<label>Tarif Telekonsultasi</label>
								</div>
							</div>
							<div class="col-2">
								<div class="form-group text-left">
									<label>
										Durasi <small>(detik)</small>
									</label>
								</div>
							</div>
							<div class="col-1">
								<div class="form-group">
									<button type="button" class="btn btn-sm btn-primary pull-right" id="btnAddItems">
										<i class="fa fa-plus"></i> Tambah
									</button>
								</div>
							</div>
						</div>
						<div id="newItem">
						</div>
						<br>
						<div class="row justify-content-center">
							<div class="col-md-6">
								<button class="btn btn-primary btn-hero" id="save">Simpan</button>
							</div>
						</div>
					</form>					
				</div>
			</div>
		</div>
	</div>
</main>
@endsection

@section('js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$('#save').click(function(event){
		if($('#name').val() == ''){
			event.preventDefault();
			$('#name').parent().parent().addClass('is-invalid');
			$('#error-nama').remove();
			$('#name').parent().parent().append("<div class='invalid-feedback' id='error-nama'>Isi nama poli terlebih dahulu</div>");
		}
	});

	$('#name').change(function(){
		if($('#name').val() != ''){
			$('#error-nama').remove();
			$('#name').parent().parent().removeClass('is-invalid');
		}
	});
</script>
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#imagePreview').css('background-image', 'url('+e.target.result +')');
				$('#imagePreview').hide();
				$('#imagePreview').fadeIn(650);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#avatar").change(function() {
		readURL(this);
	});
</script>
<script type="text/javascript">
	counter = 0;
	$(document).ready(function () {
		for (i=1;i<=counter;i++){
			removeItem()
		}
		++counter;
	});
</script>
@include('rawatjalan.pengaturan.js-form-telekonsultasi')
@endsection