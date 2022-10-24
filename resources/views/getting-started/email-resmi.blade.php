@extends('layouts.main2')

@section('title')
Set Email Resmi Anda
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		<div class="container bg-white px-100 py-50" data-toggle="appear">
			<div class="row justify-content-md-center">
				<div class="col-md-12">
					@if(in_array(Auth::user()->profesi, [1, 2, 3])) 
					@if(Auth::user()->profesi == 1)
					<h6 class="font-w400 text-right">Langkah 5 dari 7</h6>
					@else
					<h6 class="font-w400 text-right">Langkah 5 dari 6</h6>
					@endif
					@else
					<h6 class="font-w400 text-right">Langkah 5 dari 5</h6>
					@endif
					<h4 class="font-w400 mb-5"> Selamat Datang di {{config('app.name','Medify')}}, <span class="font-w600">{{Auth::user()->name}}</span></h4>
					<h5 class="font-w400">Buat email dengan domain RS Anda.</h5>
				</div>
				<div class="col-md-6 text-center">
					<form method="POST" url="{{url()->current()}}" id="formRole" enctype="multipart/form-data">
						<div class="input-group">
							<input type="text" class="form-control" id="example-input2-group1" name="email" placeholder="Email">
							<div class="input-group-append">
								<span class="input-group-text">
									@your-site.com
								</span>
							</div>
						</div>
						<small>Email yang telah terbuat tidak dapat diganti lagi</small><br>
						@if (\Session::has('email_used'))
						<div class="alert alert-danger mt-10">
							<span class="text-danger">Email telah digunakan</span>
						</div>
						@endif

						<button class="btn btn-hero btn-primary mt-20" type="submit">Simpan</button>
						{{csrf_field()}}
					</form>
				</div>
			</div>
		</div>
	</div>
</main>



@endsection

@section('js')
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
@endsection