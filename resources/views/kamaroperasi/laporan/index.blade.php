@extends('layouts.main2')

@section('title') Laporan - Kamar Operasi @endsection

@section('content')
<div class="container">
	<div class="content">
		@include('kamaroperasi.components.navbar')
		<div class="row">
			<div class="col-6">
				<h3 class="block-title">Laporan Kamar Operasi</h3>
			</div>
		</div>
		<hr>
		<div class="row row-deck">
			<div class="col-3">
				<div class="block">
					<div class="block-content block-content-full text-center">
						<h5>Rekap Jenis Operasi</h5>
						<p>Rekap pelaksanaan operasi berdasarkan jenis operasi (kecil, sedang, besar, canggih, khusus)</p>
						<button class="btn btn-secondary " data-toggle="modal" data-target="#rekap-jenis-operasi">Cetak</button>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="block">
					<div class="block-content block-content-full text-center">
						<h5>Laporan Penggunaan Ruangan</h5>
						<p>Laporan Penggunaan Ruangan Kamar Operasi</p>
						<button class="btn btn-secondary" data-toggle="modal" data-target="#laporan-penggunaan-ruangan">Cetak</button>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="block">
					<div class="block-content block-content-full text-center">
						<h5>Diagnosis Terbanyak</h5>
						<p>Laporan Operasi Dengan Diagnosis Tertinggi</p>
						<button class="btn btn-secondary" data-toggle="modal" data-target="#diagnosis-terbanyak">Cetak</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row row-deck">
			<div class="col-6">
				<div class="block">
					<div class="block-content block-content-full text-center">
						<h5>Occupancy Kamar Operasi Dalam 1 Bulan</h5>
						<div id="occupancy-chart" style="width:100%; height:400px;"></div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="block">
					<div class="block-content block-content-full text-center">
						<h5>Kasus Terbanyak Dalam 1 Bulan</h5>
						<div id="kasus-terbanyak-chart" style="width:100%; height:400px;"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row row-deck">
			<div class="col-6">
				<div class="block">
					<div class="block-content block-content-full text-center">
						<h5>Kamar Operasi Dengan Efektifitas Tertinggi Selama Sebulan</h5>
						<div id="ok-tertinggi-chart" style="width:100%; height:400px;"></div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="block">
					<div class="block-content block-content-full text-center">
						<h5>Distribusi Jenis Operasi Selama Sebulan</h5>
						<div id="jenis-operasi-chart" style="width:100%; height:400px;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="rekap-jenis-operasi" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cetak Rekap Jenis Pasien</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="GET" action="{{url('kamaroperasi/laporan/rekap-jenis-operasi')}}" target="_blank">
				<div class="modal-body">
					<p>Rekap pelaksanaan operasi berdasarkan jenis operasi (kecil, sedang, besar, canggih, khusus)</p>
					<p>Pilih tanggal awal dan tanggal akhir untuk di rekap</p>
					<div class="row">
						<div class="col-8">
							<div class="form-group">
								<div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
									<input type="text" class="form-control" required=""  id="tanggal_min" name="tanggal_min" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
									<div class="input-group-prepend input-group-append">
										<span class="input-group-text font-w600">to</span>
									</div>
									<input type="text" class="form-control" required=""  id="tanggal_max" name="tanggal_max" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>

	</div>
</div>

<div id="laporan-penggunaan-ruangan" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cetak Laporan Penggunaan Ruangan</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="GET" action="{{url('kamaroperasi/laporan/laporan-penggunaan-ruangan')}}" target="_blank">
				<div class="modal-body">
					<p>Ketahui durasi penggunaan OK setiap harinya</p>
					<p>Pilih tanggal awal dan tanggal akhir untuk di rekap</p>
					<div class="row">
						<div class="col-8">
							<div class="form-group">
								<div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
									<input type="text" class="form-control" required=""  id="tanggal_min" name="tanggal_min" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
									<div class="input-group-prepend input-group-append">
										<span class="input-group-text font-w600">to</span>
									</div>
									<input type="text" class="form-control" required=""  id="tanggal_max" name="tanggal_max" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>

	</div>
</div>

<div id="diagnosis-terbanyak" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cetak Laporan Diagnosis Terbanyak</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="GET" action="{{url('kamaroperasi/laporan/diagnosis-terbanyak')}}" target="_blank">
				<div class="modal-body">
					<p>Laporan diagnosis terbanyak berdasarkan waktu tertentu</p>
					<p>Pilih tanggal awal dan tanggal akhir untuk di rekap</p>
					<div class="row">
						<div class="col-8">
							<div class="form-group">
								<div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
									<input type="text" class="form-control" required=""  id="tanggal_min" name="tanggal_min" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off">
									<div class="input-group-prepend input-group-append">
										<span class="input-group-text font-w600">to</span>
									</div>
									<input type="text" class="form-control" required=""  id="tanggal_max" name="tanggal_max" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>

	</div>
</div>
@endsection

@section('js')
<script src="{{ asset('bower/amcharts3/amcharts/amcharts.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/pie.js') }}"></script>
<script src="{{ asset('bower/amcharts3/amcharts/serial.js') }}"></script>
@include('kamaroperasi.laporan.components.js-ok-occupancy')
@include('kamaroperasi.laporan.components.js-kasus-terbanyak')
@include('kamaroperasi.laporan.components.js-ok-tertinggi')
@include('kamaroperasi.laporan.components.js-jenis-operasi')


<script>
	$(document).ready(function() {
		$("#laporan").addClass('active');
	});
</script>
@endsection
