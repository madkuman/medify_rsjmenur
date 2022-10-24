@extends('layouts.main2')

@section('title')
Set Avatar Anda
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		<div class="container bg-white px-100 py-50" data-toggle="appear">
			<div class="row justify-content">
				<div class="col-md-12">
					@if(in_array(Auth::user()->profesi, [1, 2, 3])) 
					@if(Auth::user()->profesi == 1)
					<h6 class="font-w400 text-right">Langkah 3 dari 7</h6>
					@else
					<h6 class="font-w400 text-right">Langkah 3 dari 6</h6>
					@endif
					@else
					<h6 class="font-w400 text-right">Langkah 3 dari 5</h6>
					@endif
					<h4 class="font-w400 mb-5"> Selamat Datang di {{config('app.name','Medify')}}, <span class="font-w600">{{Auth::user()->name}}</span></h4>
					<h5 class="font-w400">Upload foto anda. Foto akan membuat anda mudah dikenali.</h5>
				</div>
				<div class="col-md-12">
					<form method="POST" url="{{url()->current()}}" id="formRole" enctype="multipart/form-data">
						<div class="col-md-12 text-center">
							<div class="avatar-upload">
								<div class="avatar-edit">
									<input type='file' id="avatar" name="avatar" accept=".png, .jpg, .jpeg" />
									<label for="avatar"></label>
								</div>
								<div class="avatar-preview">
									<div id="imagePreview" style="background-image: url({{url('assets/img/placeholder.jpg')}});">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3"></div>
								<div class="form-group col-md-6">
	                                <label for="telepon">Telepon</label>
	                                <input type="text" class="form-control" id="telepon" name="telepon" placeholder="No.HP" autocomplete="off" required>
	                            </div>
	                            <div class="col-md-3"></div>
							</div>
							<button class="btn btn-hero btn-primary" type="submit">Simpan</button>
						</div>
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