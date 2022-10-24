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

		<form class="" method="POST" action="{{url('it/komplain')}}" id="form-add" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="block rounded block-transparent mb-0">
				<div class="block-header">
					<h4 class="font-w400 mb-0">Laporkan Masalah IT</h4>
				</div>
				<div class="block-content">
					<div class="row" id="komplain-content">    
						<div class="col-md-4 ">
							<div class="form-group">
								<label class="control-label">Tanggal</label>
								<input type="text" class="form-control js-datepicker" name="tgl_komplain" data-date-format="dd-mm-yyyy" value="{{date('d-m-Y')}}">
							</div>
						</div>
						<div class="col-md-4">

							<div class="form-group">
								<label class="control-label">Jam Komplain</label>

								<div class="row gutters-tiny">
									<div class="col-4">
										<select class="form-control" name="jam_komplain" style="width: 100%;">
											<option value="">Jam</option>
											@for($i=00; $i<=23; $i++)
											<option value="{{$i}}" @if(date('H') == $i){{'selected'}}@endif>{{$i}}</option>
											@endfor
										</select>
									</div>
									<div class="col-4">
										<select class="form-control" name="menit_komplain" style="width: 100%;">
											<option value="">Menit</option>
											@for($i=00; $i<=59; $i++)
											<option value="{{$i}}" @if(date('i') == $i){{'selected'}}@endif>{{$i}}</option>
											@endfor
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">

							<div class="form-group">
								<label class="control-label">Lokasi</label>
								<select class="form-control js-select2" id="komplain_lokasi" name="lokasi" id="komplain_lokasi" style="width: 100%;">
									@foreach($lokasi as $lokasi_item)
									<option value="{{$lokasi_item->id}}">{{$lokasi_item->nama}}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label class="control-label">Pesan</label>
								<textarea class="form-control form-control-lg" name="pesan" rows="3" placeholder="Isikan pesan" required></textarea>
							</div>
							<div class="form-group">
								<label>Upload Gambar</label>
								<div class="custom-file">
									<input class="custom-file-input" type="file" name="image[]" multiple="" accept=".png, .jpg, .jpeg"/>
									<label class="custom-file-label">Pilih file..</label>
								</div>
								<small>*Dapat upload banyak gambar</small>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer border-top-0">
					<button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" data-dismiss="modal">
						Tutup
					</button>
					<button type="submit" class="btn-alt btn-hero btn-primary min-width-125" id="btn-save-it">
						<i class="fa fa-send mr-5"></i> Simpan
					</button>
				</div>
			</div>
		</form>
	</div>
</main>
@endsection

@section('js')
	<script type="text/javascript">
		$('input[type="file"]').change(function(e){
			var fileNames =  e.target.files;
			var fileName = '';
			$.each(fileNames,function (j,item) {
				fileName += item.name+' '
			});
			if (fileName.length > 130) {
				fileName = fileName.substring(0,130)+'..';
			}
			$(this).next().html(fileName);
		});
	</script>
@endsection