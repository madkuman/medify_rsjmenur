@extends('bpjs.layouts.main')

@section('title')
Rujukan BPJS
@endsection

@section('subtitle')
Rujukan / Tambah Data
@endsection

@section('css')
@endsection

@section('content')
@if(!$window)
<main id="main-container">
    @include('bpjs.layouts.navbar')
    <div class="container">
@else
<main id="main-container" class="pt-0">
@endif
		<div class="block">
			<div class="block-content block-content-full">
				<h5>Tambah Data Rujukan</h5>
				<hr>
				@include('bpjs.rujukan.create.components.form')
			</div>
		</div>
	@if(!$window)
	</div>
	@endif
</main>
@endsection


@section('js')
<script type="text/javascript">
	$('#select_pasien').select2({
		ajax: {
			url: function (params) {
				return API_URL+'/pasien/get?keyword='+params.term;
			},
			processResults: function (data, params) {
				// console.log(data);
				data = JSON.parse(data);
				return {
					results: $.map(data.data, function(obj) {
						return { id: JSON.stringify((obj)), text: obj.name };
					})
				};
			},
			cache: true
		}
	});
	$('#select_diagnosis').select2({
		ajax: {
			url: function (params) {
				return API_URL+'/kasus/get/list/diagnosis?keyword='+params.term;
			},
			processResults: function (data, params) {
				// console.log(data);
				data = JSON.parse(data);
				return {
					results: $.map(data.data, function(obj) {
						return { id: obj.code_icd, text: obj.code_icd+' | '+obj.long_desc };
					})
				};
			},
			cache: true
		}
	});
	$('#select_poli').select2({
		ajax: {
			url: function (params) {
				return API_URL+'/bpjs/referensi/poli?poli='+params.term;
			},
			processResults: function (data, params) {
				data = JSON.parse(data);
				return {
					results: $.map(data.response.poli, function(obj) {
						return { id: JSON.stringify((obj)), text: obj.kode+' | '+obj.nama };
					})
				};
			},
			cache: true
		}
	});
	$('#select_faskes').select2({
		ajax: {
			url: function (params) {
				return API_URL+'/bpjs/referensi/faskes?faskes='+params.term;
			},
			processResults: function (data, params) {
				data = JSON.parse(data);
				return {
					results: $.map(data.response.faskes, function(obj) {
						return { id: JSON.stringify((obj)), text: obj.kode+' | '+obj.nama };
					})
				};
			},
			cache: true
		}
	});

	var countChangeKasus = 0;

	$('#select_pasien').on('change', function(e){
		var pasien = $(this).val();
		pasien = JSON.parse(pasien);
		if(pasien.id){
			$.ajax({
				url: API_URL+'/bpjs/rujukan/create/get/kasus?pasien_id='+pasien.id,
				type: "GET",
				dataType: "json",
				success: function(data){
					// console.log(data);
					$('#select_kasus').empty();
					if (data.length != 0)
					{
						$('#select_kasus').append('<option value="">--Pilih kasus--</option>');
						$.each(data, function(key, value){
							$('#select_kasus').append("<option value='"+JSON.stringify((value))+"'>"+value.nomor_kasus+" | "+value.judul_kasus+"</option>");
						});
					}
				}
			});
		}
		else{
			$('#select_kasus').empty();
		}
	});
	$('#select_kasus').on('change', function(e){
		var kasus = $(this).val();
		countChangeKasus++;
		kasus = JSON.parse(kasus);
		if(kasus.id  && countChangeKasus > 1){
			$.ajax({
				url: API_URL+'/bpjs/rujukan/create/get/sep?kasus_id='+kasus.id,
				type: "GET",
				dataType: "json",
				success: function(data){
					// console.log(data);
					$('#select_sep').empty();
					if (data.length != 0)
					{
						$('#select_sep').append('<option value="">--Pilih SEP--</option>');
						$.each(data, function(key, value){
							$('#select_sep').append('<option value="'+value.no_sep+'">'+value.no_sep+'</option>');
						});
					}
					else
					{
						$('#select_sep').append('<option value="">Tidak ada SEP</option>');
					}
				}
			});
		}
		else{
			$('#select_sep').empty();
		}
	});

	@if(!empty($pasien->id))
		setOptionSelect("#select_pasien","{{$pasien->id}}","{{$pasien->name}}");
	@endif
	@if(!empty($kasus->id))
		setOptionSelect("#select_kasus",'{!!json_encode($kasus)!!}',"{{$kasus->judul_kasus}}");
	@endif
	@if(!empty($sep->id))
		setOptionSelect("#select_sep","{{$sep->no_sep}}","{{$sep->no_sep}}");
	@endif
	@if(!empty($icd10->id))
		setOptionSelect("#select_diagnosis","{{$icd10->code_icd}}","{{$icd10->code_icd}} | {{$icd10->long_desc}}");
	@endif


	function setOptionSelect(select_id,val,text)
	{
		var option = new Option(text, val);
		option.selected = true;

		$(select_id).append(option);
		$(select_id).trigger("change");
	}

</script>
@endsection