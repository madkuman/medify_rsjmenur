@extends('layouts.main2')

@section('title')
Sambungkan ke Kepegawaian
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		<div class="container bg-white px-100 py-50" data-toggle="appear">
			<div class="row justify-content-md-center">
				<div class="col-md-12">
					@if(in_array(Auth::user()->profesi, [1, 2, 3])) 
					@if(Auth::user()->profesi == 1)
					<h6 class="font-w400 text-right">Langkah 4 dari 7</h6>
					@else
					<h6 class="font-w400 text-right">Langkah 4 dari 6</h6>
					@endif
					@else
					<h6 class="font-w400 text-right">Langkah 4 dari 5</h6>
					@endif
					<h4 class="font-w400 mb-5"> Selamat Datang di {{config('app.name','Medify')}}, <span class="font-w600">{{Auth::user()->name}}</span></h4>
					<h5 class="font-w400">Hubungkan dengan data kepegawaian anda.</h5>
				</div>
				<div class="col-md-6 text-center">
					<form method="POST" url="{{url()->current()}}" id="formRole" enctype="multipart/form-data">
						<select class="form-control js-select2" id="pegawai_id" name="pegawai_id">
							<option value="0" selected>Dokter Tamu / Konsultan</option>
							@foreach($pegawai as $item)
							<option value="{{$item->id}}">{{$item->name}} - {{$item->nrp}}</option>
							@endforeach
						</select>
						<small>Mohon gunakan data kepegawaian anda sendiri</small><br>
						@if (\Session::has('user_used'))
						<div class="alert alert-danger mt-10">
							<span class="text-danger">Data Pegawai sudah digunakan oleh {!! \Session::get('user_used') !!}</span>
						</div>
						@endif

						<button id="btn_submit" class="btn btn-hero btn-primary mt-20" type="submit" style="display: none;">Simpan</button>
						<a id="btn_skip" class="btn btn-hero btn-primary mt-20" href="{{url('getting-started/email-resmi')}}">Simpan</a>
						{{csrf_field()}}
						
						<!-- {{--
						<a class="btn btn-hero btn-default mt-20" href="{{url('getting-started')}}/email-resmi">Lewati</a>
						--}} -->
					</form>
				</div>
			</div>
		</div>
	</div>
</main>



@endsection

@section('js')
<script type="text/javascript">
    $('#pegawai_id').on('change', function() {
		if ($('#pegawai_id').val() != 0) {
			$('#btn_submit').show();
			$('#btn_skip').hide();
		}
		else{
			$('#btn_submit').hide();
			$('#btn_skip').show();
		}
	});
</script>
@endsection