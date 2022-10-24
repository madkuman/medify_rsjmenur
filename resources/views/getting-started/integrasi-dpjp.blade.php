@extends('layouts.main2')

@section('title')
Integrasi DPJP BPJS
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		<div class="container bg-white px-100 py-50" data-toggle="appear">
			<div class="row justify-content">
				<div class="col-md-12">
					<h6 class="font-w400 text-right">Langkah 7 dari 7</h6>
					<h4 class="font-w400 mb-5"> Selamat Datang di SIMRS {{config('app.name')}}, <span class="font-w600">{{Auth::user()->name}}</span></h4>
					<h5 class="font-w400">Integrasikan DPJP BPJS Anda.</h5>
				</div>
				<div class="col-md-6">
					<form method="POST" url="{{url()->current()}}" id="formRole" enctype="multipart/form-data" class="row">
						
						<div class="form-group col-12">
							<select class="js-select2 form-control" name="dokter_id">
								<option disabled selected>Pilih Dokter</option>
								@foreach($dokter as $item)
								<option value="{{$item->id}}" @if($item->id == Auth::user()->dokter_id) selected @endif>{{$item->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-md-12">
							<button id="btn_submit" class="btn btn-hero btn-primary mt-20" type="submit">Simpan</button>
						</div>
						{{csrf_field()}}
					</form>

					<div>
						<a class="btn mt-20" href="{{url('/')}}">Lewati</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>



@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function() {
		$('#specialty').select2();
		$('#service-type').select2();
		$('#dpjp').select2();
		$('#spesialisasiLoading').show();
		$.ajax({
			type: "POST",
			url: API_URL + '/getting-started/bpjs/referensi/spesialis',
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function (data) {
				if (data.response.list.length != 0)
				{
					$.each(data.response.list, function(key, value){
						$('#specialty').append('<option value="'+value.kode+'">'+value.nama+'</option>');
					});
				}
				$('#spesialisasiLoading').hide();
			}
		});
	});
	$('#specialty').on('change', function(){
		getDPJPList();
	});
	$('#service-type').on('change', function(){
		getDPJPList();
	});

	function getDPJPList() {
		var specialty = $('#specialty').val();
		var service_type = $('#service-type').val();
		if(specialty != '' && service_type != ''){
			$.ajax({
				url: API_URL + '/getting-started/bpjs/referensi/dpjp/'+service_type+'/'+specialty,
				type: "GET",
				dataType: "json",
				beforeSend: function(){
					$('#loader').show();
					$('#form-dpjp').hide();
					$('#btn_submit').hide();
					$('#dpjpError').hide();
					$('#dpjpError201').hide();
				},
				success: function(data){
					$('#dpjp').empty();
					if (data.metaData.code == 200 && data.response.list.length != 0)
					{
						$.each(data.response.list, function(key, value){
							$('#dpjp').append('<option value="'+value.kode+'">'+value.nama+'</option>');
						});
						$('#form-dpjp').show();
						$('#loader').hide()
						$('#dpjpError201').hide();
						$('#dpjpError').hide();
						$('#btn_submit').show(500);
					}
					else if(data.metaData.code == 201)
					{
						$('#dpjpError').hide();
						$('#dpjpError201').show();
						$('#form-dpjp').hide();
						$('#loader').hide()
						$('#btn_submit').hide();
					}
					else
					{
						$('#dpjpError').show();
						$('#dpjpError201').hide();
						$('#form-dpjp').hide();
						$('#loader').hide()
						$('#btn_submit').hide();
					}
				},
				complete: function(){
				}
			});
		}
	}
</script>
@endsection