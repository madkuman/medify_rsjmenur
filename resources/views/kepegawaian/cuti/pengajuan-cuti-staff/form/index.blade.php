@extends('layouts.main2')

@section('title')
Pengajuan Cuti
@endsection

@section('content')

@php 
$jenis_cuti = $cuti->master_cuti_id ?? '';
$bersedia_unpaid_leave = $cuti->bersedia_unpaid_leave ?? '';
$alasan_cuti_id = $cuti->alasan_cuti_id ?? '';
$keterangan_alasan_cuti = $cuti->keterangan_alasan_cuti ?? '';
$date_start = $cuti->date_start ?? '';
$date_start = carbon_parse($date_start,'Y-m-d','d-m-Y');

$date_end = $cuti->date_end ?? '';
$date_end = carbon_parse($date_end,'Y-m-d','d-m-Y');
@endphp


<main id="main-container">

	<div class="row">
		<div class="col-12">
			@include('kepegawaian.layouts.partials.navbar-non-member',['judul_halaman' => 'Cuti'])
		</div>
		<div class="col-12">
			
			<div class="container">

				<h3 class="mb-0">Kuota Cuti</h3>
				@include('kepegawaian.cuti.components.navbar-staff')
				
				<div class="block">
					<div class="block-header block-header-default">
						<h3 class="block-title">Form Pengajuan Cuti</h3>
					</div>
					<form method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="id" value="{{$cuti->id ?? 0}}">

						<div class="block-content">
							<div class="row">
								<div class="col-lg-6 col-md-8 col-12">
									<div class="form-group">
										<label>Pilih Cuti</label>
										<select class="form-control" name="jenis_cuti" required>
											<option value="" disabled selected>Pilih</option>
											@foreach($master_cuti as $item)
											<option value="{{$item->id}}" @if($jenis_cuti == $item->id) selected @endif>{{$item->nama}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<label>Waktu Cuti</label>
										<div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-start-date="+{{config('app.kepegawaian_cuti_min_pengajuan_hari')}}d"  data-end-date="+{{config('app.kepegawaian_cuti_max_pengajuan_hari')}}d" >

											<input type="text" class="form-control" autocomplete="off" id="date-cuti-1" name="date_start" placeholder="From" value="{{$date_start ?? ''}}" required="">
											<div class="input-group-prepend input-group-append">
												<span class="input-group-text font-w600">to</span>
											</div>
											<input type="text" class="form-control" autocomplete="off" id="date-cuti-2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$date_end ?? ''}}" required="">
										</div>
										<small>Minimal {{config('app.kepegawaian_cuti_min_pengajuan_hari')}} dari Hari ini. Maksimal {{config('app.kepegawaian_cuti_max_pengajuan_hari')}} dari Hari ini.</small>
									</div>
									<div class="row">
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Sisa Cuti</label> <i style="display:none" class="fa fa-spinner fa-spin" id="loading-cuti-kuota"></i>
												<input class="form-control" id="cuti_kuota" value="" readonly>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Durasi Pengajuan</label> <i style="display:none" class="fa fa-spinner fa-spin" id="loading-cuti-durasi"></i>
												<input class="form-control" id="cuti_durasi" value="" readonly>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Pilih Alasan Cuti</label>
										<select class="form-control" name="alasan_cuti_id" required>
											<option value="" disabled selected>Pilih</option>
											@foreach($master_cuti_alasan as $item)
											<option value="{{$item->id}}" @if($alasan_cuti_id == $item->id) selected @endif>{{$item->nama}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<label>Keterangan</label>
										<textarea class="form-control" name="keterangan_alasan_cuti" required>{{$keterangan_alasan_cuti}}</textarea>
									</div>
									<div id="warning-cuti-kurang-container" style="display:none">
										<div class="alert alert-danger">Sisa Cuti Kurang Dari Durasi Cuti Yang Diajukan</div>
										<div class="custom-control custom-checkbox mb-5">
											<input class="custom-control-input" type="checkbox" name="bersedia_unpaid_leave" id="checkbox-bersedia-unpaid-leave" value="1"
											@if($bersedia_unpaid_leave == 1) checked @endif
											>
											<label class="custom-control-label" for="checkbox-bersedia-unpaid-leave">
												Saya bersedia menggunakan <strong>Unpaid Leave</strong>
											</label>
										</div>
										<br>
									</div>
									<button class="btn btn-primary">Submit Pengajuan</button>
								</div>
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
<script type="text/javascript">

	@if($method == 'edit')
	getKuotaCuti()
	calculateDurasiPengajuan()
	@endif

	$('select[name=jenis_cuti]').change(function(){
		getKuotaCuti()
	})
	$('.input-daterange input').change(function(){
		calculateDurasiPengajuan()
	})

	function checkIfSisaCutiKurang()
	{
		cuti_sisa = $('#cuti_kuota').val()
		cuti_durasi = $('#cuti_durasi').val()

		cuti_sisa = parseInt(cuti_sisa)
		cuti_durasi = parseInt(cuti_durasi)

		if(cuti_sisa < cuti_durasi){
			$('#warning-cuti-kurang-container').show();
			$('#checkbox-bersedia-unpaid-leave').prop('required',true);
			$('#checkbox-bersedia-unpaid-leave').prop('checked',false);
		}
		else
		{
			$('#warning-cuti-kurang-container').hide();
			$('#checkbox-bersedia-unpaid-leave').prop('required',false);
			$('#checkbox-bersedia-unpaid-leave').prop('checked',false);
		}
	}

	function calculateDurasiPengajuan()
	{
		var date_start_val = $('#date-cuti-1').val()
		var date_end_val = $('#date-cuti-2').val()
		$('#loading-cuti-durasi').show();
		$.ajax({
			type: "GET",
			url: "{{ url('api/kepegawaian/cuti/get-durasi-cuti') }}",
			data: { 
				date_start: date_start_val,
				date_end: date_end_val,
			},
			dataType: "json",
			success: function (response) {
				$('#cuti_durasi').val(response.data.durasi_cuti)
				$('#loading-cuti-durasi').hide();
				checkIfSisaCutiKurang()
			},
		})
	}

	function getKuotaCuti()
	{
		var jenis_cuti = $('select[name=jenis_cuti]').val();
		$('#loading-cuti-kuota').show();
		$.ajax({
			type: "GET",
			url: "{{ url('api/kepegawaian/cuti/kuota/get-my-kuota') }}",
			dataType: "json",
			data: { 
				master_cuti_id: jenis_cuti,
			},
			success: function (response) {
				var kuota_cuti = parseInt(response.data.kuota_cuti)
				$('#cuti_kuota').val(kuota_cuti)
				$('#loading-cuti-kuota').hide();
				checkIfSisaCutiKurang()
			},
		})
	}
</script>
@endsection