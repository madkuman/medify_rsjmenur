@extends('layouts.main2')

@section('title')
Pendaftaran - Kamar Operasi - Medify
@endsection

@section('style')

@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('kamaroperasi.components.navbar')
		<div class="row">
			<div class="col-12">
				<div class="block block-rounded">
					<div class="block-header">
						<h3 class="block-title">Pendaftaran Pasien Operasi</h3>
					</div>
					<div class="block-content">
						<div class="row">
							<div class="col-6">
								<form action="" method="post" id="pendaftaran_form">
									{{ csrf_field() }}
									<div class="row">
										<div class="col-12 form-group">
											<label>Pasien</label>
											<select class="js-select2 form-control" name="pasien" id="pasien_dropdown" data-placeholder="Pilih Pasien" required>
												@if ($permintaan)
												<option value="{{ $permintaan->pasien_detail->id }}">{{ $permintaan->pasien_detail->name }}</option>
												@endif
											</select>
										</div>

										<div class="col-12 form-group">
											<label>Kasus <i class="fa fa-spin fa-spinner" id="loadingKasus"></i></label>
											<select class="js-select2 form-control" name="kasus_id" id="kasus_dropdown" data-placeholder="Pilih Kasus" required>
											</select>
										</div>

									</div>
									<div class="block block-bordered" style="max-height: 300px">
										<div class="block-content px-5 py-5">
											<div class="table-full-width spinner-container" id="pasien_placeholder">
												<div class="spinner-back" style="min-height: 0px">
													<div class="row">
														<div class="col-3 text-center">
															<div class="vertical-align-center" style="padding-top: 15%">
																<img class="img-avatar" src="{{url('')}}/assets/img/placeholder.jpg" alt="">
															</div>
														</div>
														<div class="col-4">
															<div class="py-2">
																<table class="tr1 table table-borderless">
																	<tbody class="spinner-back-placeholder" style="min-height: 0px">
																		<tr>
																			<td class="py-1 px-1"><div class=" bg-primary-lighter">&nbsp;</div></td>
																		</tr>
																		<tr>
																			<td class="py-1 px-1"><div class=" bg-primary-lighter">&nbsp;</div></td>
																		</tr>
																		<tr>
																			<td class="py-1 px-1"><div class=" bg-primary-lighter">&nbsp;</div></td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<div class="spinner" style="padding-top: 10px;">
														<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>
													</div>
												</div>
											</div>
											<table class="table table-borderless" id="main_userdetail" style="display: none;">
												<tbody>
													<tr>
														<td>
															<div class="row">
																<div class="col-3 text-center">
																	<div class="vertical-align-center">
																		<img class="img-avatar" id="thumb_pasien" src="{{url('')}}/assets/img/placeholder.jpg" alt="">
																	</div>
																</div>
																<div class="col-9">
																	<span id="no_rm">00-10-22-34-14</span> <br>
																	<strong style="font-size: 13pt;" id="nama_pasien">Nama Pasien</strong> <br>
																	<span id="jk_umur">Laki laki, 22 tahun</span>
																</div>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>

									<div class="row">
										<div class="col-12 form-group">
											<label>Jenis Spesialis</label>
											<select class="js-select2 form-control" name="jenis_spesialis_id" id="jenis_spesialis_dropdown" data-placeholder="Pilih Spesialis" required>
												<option value="" selected="" disabled="">Pilih</option>
												@foreach($spesialis_operasi as $item)
												<option value="{{$item->id}}" @if($permintaan) @if($permintaan->jenis_spesialis_id == $item->id) selected @endif @endif>{{$item->nama}}</option>
												@endforeach
											</select>
										</div>
									</div>

									@if(empty($is_pendaftaran))
									<div class="row">
										<div class="col-12 form-group">
											<label>Tanggal Deadline Masa Tunggu</label>
											<input type="text" autocomplete="off" class="js-datepicker form-control" data-date-start-date="{{date('d-m-Y')}}" name="masa_tunggu" id="masa_tunggu" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" placeholder="Pilih Tanggal" value="{{ $permintaan && $permintaan->masa_tunggu ? \Carbon\Carbon::parse($permintaan->masa_tunggu)->format('d/m/Y') : '' }}" required>
										</div>
									</div>
									@endif

									@yield('additional-form')

									<div class="row">
										<div class="col-12 form-group text-right">
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection

@section('js')
<script>
	$("#pendaftaran_form").on('submit', function(){
		var selected = $("#diagnosis_dropdown").select2('data')[0].text;
		$("#diagnosis").val(selected);
	});

	$("#main_userdetail").hide();
	$(".spinner").hide();
	Codebase.helpers(['select2']);

	@if ($permintaan)
	var initials = {
		'pasien': {
			id: {{ $permintaan->pasien_detail->id }}, text: "{{ $permintaan->pasien_detail->name }}"
		},
		@if($permintaan->dokter)
		'dokter': {
			id: {{ $permintaan->dokter->id }}, text: "{{ $permintaan->dokter->name }}"
		},
		@else
		'dokter': null,
		@endif
		'diagnosis': {
			id: "{{ $permintaan->diagnosis }}", text: "{{ $permintaan->diagnosis }}"
		},
		'ronde': {{ $permintaan->nomor_ronde ? $permintaan->nomor_ronde : 'null' }},
		'ruangan': {{ $permintaan->ruangan_id ? $permintaan->ruangan_id : 'null' }},
		'tanggal': {!! $permintaan->jadwal_operasi ? "'".\Carbon\Carbon::parse($permintaan->jadwal_operasi)->format('d/m/Y')."'" : 'null' !!},
	};
	@else
	var initials = {
		'pasien': null,
		'dokter': null,
		'ruangan': null,
		'ronde': null,
		'ruangan': null,
		'tanggal': null,
	};
	@endif

	$("#pasien_dropdown").select2({
		data: initials.pasien,
		ajax : {
			url: API_URL + '/pasien/get',
			delay: 250,
			dataType: 'json',
			data: function (params) {
				var query = {
					keyword: params.term,
				}
				return query;
			},
			processResults: function (response) {
				data = response.data 
				console.log(data)
				data = data.map(function (item) {
					return {
						id: item.id,
						text: item.no_rm +' - '+ item.name
					};
				});
				return { results: data };
			},
		}
	});
	$("#diagnosis_dropdown").select2({
		data: initials.diagnosis,
		ajax : {
			url: '{{ url('ajax/kamaroperasi/search_diagnosis') }}',
			delay: 250,
			dataType: 'json',
			data: function (params) {
				var query = {
					search: params.term || '',
					page: params.page || 1
				}
				return query;
			},
			processResults: function (data) {
				return {
					results: data
				};
			},
		}
	});

	$("#pasien_dropdown").change(function(){
		getPasienKasus($(this).val())
		$("#main_userdetail").hide();
		$("#pasien_placeholder").show();
		$(".spinner").show();
		$.ajax({
			url: '{{ url('ajax/kamaroperasi/get_pasien_summary') }}',
			dataType: 'json',
			data: {
				id: $(this).val(),
			},
			success: function(data){
				$("#pasien_placeholder").hide();
				$("#no_rm").html(data.no_rm);
				$("#nama_pasien").html(data.name);
				if(data.gender == 1) gender = 'Laki laki';
				else gender = 'Perempuan';
				$("#jk_umur").html(gender+', '+data.age+' tahun');
				$("#thumb_pasien").attr('src', '{{ url('/') }}/'+data.photo_thumb);
				$(".spinner").hide();
				$("#main_userdetail").show();
			}
		});
	});
</script>

<script>
	$(document).ready(function(){
		@if ($permintaan)
		$('.js-select2').change();
		@endif
	});
</script>

<script type="text/javascript">
	function getPasienKasus(pasien_id){
		$('#loadingKasus').show();
		$.ajax({
			url: API_URL + '/pasien/'+pasien_id+'/kasus',
			dataType: 'json',
			success: function(data){
				console.log(data)
				var kasus_current = $('#kasus_dropdown').val();
				var option = [];

				for (i in data) {
					option.push({
						id: data[i].id,
						text: data[i].lokasi +' - '+data[i].judul_kasus,
					});
				}
				$('#kasus_dropdown').select2({
					data: option
				});
				@if($permintaan)
				$('#kasus_dropdown').val("{{$permintaan->kasus->id}}").trigger('change');
				@else
				$('#kasus_dropdown').val("").trigger('change');
				@endif
				$('#loadingKasus').hide();
			}
		});
	}
</script>
@endsection
