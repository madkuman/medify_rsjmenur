@extends('layouts.main2')

@section('title')
Set Profesi Anda
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		<div class="container bg-white px-100 py-50" data-toggle="appear">
			<div class="row justify-content">
				<div class="col-md-12">
					<h6 class="font-w400 text-right">Langkah 1 dari 5</h6>
					<h4 class="font-w400 mb-5"> Selamat Datang di {{config('app.name','Medify')}}, <span class="font-w600">{{Auth::user()->name}}</span></h4>
					<h5 class="font-w400">Silahkan pilih profesi anda</h5>
				</div>
				<div class="col-md-6">
					<form class="js-validation-signup" method="POST" action="{{url('getting-started/profesi')}}">
						{{ csrf_field() }}
						<div class="row">
							<label class="col-md-12">Profesi</label>
							<div class="col-md-11">
								<select class="js-select2 form-control" id="profesi" name="profession" data-placeholder="Pilih Profesi">
									<option value="">Pilih Profesi</option>
									@foreach($profesi as $id => $title)
									<option value="{{ $id }}">{{ $title }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-1">
								<span id="loader" style="visibility: hidden;"><i class="fa fa-spinner fa-2x fa-spin"></i></span>
							</div>
							<label id="sp_label" class="col-md-12 mt-10" style="visibility: hidden;">Spesialisasi / Bagian</label>
							<div id="sp_select" class="col-md-11" style="visibility: hidden;">
								<select class="js-select2 form-control" id="spesialisasi" name="specialty">
									<option value=""></option>
								</select>
							</div>
							<label id="subsp_label" class="col-md-12 mt-10" style="display: none;">Subspesialis</label>
							<div id="subsp_select" class="col-md-11" style="display: none;">
								<select class="js-select2 form-control" id="subspesialis" name="subspecialty">
									<option value=""></option>
									@foreach($subspecialty as $item)
									<option value="{{ $item->id }}">{{ $item->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<button type="submit" id="btn_submit" class="btn btn-block btn-hero btn-noborder btn-primary col-3 mt-10" style="visibility: hidden;">Simpan</button>	
					</form>
				</div>
			</div>
		</div>		
	</div>
</main>

@endsection

@section('js')
<script>
	$(document).ready(function(){
		$('#profesi').select2();
		$('#spesialisasi').select2();
		$('#subspesialis').select2({ width: '100%' });
	});
</script>
<script>

	var specialty_exist = 0;
	$('#profesi').on('change', function(e){
		// console.log(e);
		var profesi_id = $(this).val();
		if(profesi_id){
			$.ajax({
				url: '{{url("getting-started")}}/profesi/spesialisasi/get/'+profesi_id,
				type: "GET",
				dataType: "json",
				beforeSend: function(){
					$('#loader').css("visibility","visible");
				},
				success: function(data){
					$('#spesialisasi').empty();
					if (data.length != 0)
					{
						specialty_exist = 1;
						$.each(data, function(key, value){
							$('#spesialisasi').append('<option value="'+key+'">'+value+'</option>');
						});
					}
					else
					{
						specialty_exist = 0;
					}

				},
				complete: function(){
					$('#loader').css("visibility","hidden");
					$('#btn_submit').css("visibility","visible");
					if(specialty_exist == 1)
					{
						$('#sp_label').css("visibility","visible");
						$('#sp_select').css("visibility","visible");
						$('#sp_label').css("display","block");
						$('#sp_select').css("display","block");
					}
					else{
						$('#sp_label').css("visibility","hidden");
						$('#sp_select').css("visibility","hidden");
						$('#sp_label').css("display","none");
						$('#sp_select').css("display","none");
					}
					if (profesi_id == 1) {
						$('#subsp_label').show(500);
						$('#subsp_select').show(500);
					}
					else{
						$('#subsp_label').hide(500);
						$('#subsp_select').hide(500);
					}
				}
			});
		}
		else{
			$('#spesialisasi').empty();
		}
	});
</script>
@endsection