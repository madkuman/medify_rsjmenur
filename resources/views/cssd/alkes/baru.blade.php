@extends('layouts.main2')

@section('title')
Alkes Baru - CSSD
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/simplemde/css/simplemde.min.css')}}">
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('cssd.layouts.navbar')
		<div class="block">
			<div class="block-header">
				<h4>Tambah Alat Baru</h4>
			</div>

			<div class="block-content block-content-full pb-100">
				<form class="{{url()->current()}}" method="POST">
					{{csrf_field()}}
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label>Nama Alat</label>
								<input class="form-control" name="nama" required="">
							</div>
							<div class="form-group">
								<label>Batas Penggunaan Efektif</label>
								<input class="form-control" name="batas_efektif" required="">
							</div>
							<div class="form-group">
								<label>Stok Awal</label>
								<input class="form-control" name="stok_awal" required="">
							</div>
							<div class="form-group">
								<label>Keterangan</label>
								<textarea class="form-control" name="keterangan"></textarea> 
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label>Prosedur Sterilisasi</label>
								<textarea class="js-simplemde" id="simplemde" name="prosedur_sterilisasi"></textarea>
							</div>
						</div>
					</div>
					<button class="btn btn-primary btn-hero float-right">Simpan</button>
				</form>
			</div>
		</div>

	</div>
</main>

@endsection

@section('js')
<script src="{{asset('assets/js/plugins/simplemde/js/simplemde.min.js')}}"></script>
<script type="text/javascript">
	jQuery('.js-simplemde:not(.js-simplemde-enabled)').each(function(){
		var el = jQuery(this);

            // Add .js-simplemde-enabled class to tag it as activated
            el.addClass('js-simplemde-enabled');

            // Init editor
            new SimpleMDE({ element: el[0] });
       });
  </script>
  @endsection