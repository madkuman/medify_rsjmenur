@extends('layouts.main2')

@section('title')
Laporan - CSSD
@endsection

@section('css')

@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('cssd.layouts.navbar')
		<div class="row">
			<div class="col-3">
				<div class="block">
					<div class="block-content block-content-full text-center">
						<h5>Rekap Penggunaan Alat</h5>
						<p>Rekap mengenai jumlah penggunaan Alat dalam periode waktu tertentu</p>
						<button class="btn btn-secondary " data-toggle="modal" data-target="#rekap-penggunaan-alat">Cetak</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>


<div id="rekap-penggunaan-alat" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Rekap Penggunaan Alat</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="GET" action="{{url('cssd/laporan/rekap-penggunaan-alat')}}" target="_blank">
				<div class="modal-body">
					<p>Rekap mengenai jumlah penggunaan Alat dalam periode waktu tertentu</p>
					<p>Pilih tanggal awal dan tanggal akhir untuk di rekap</p>
					<div class="row">
						<div class="col-8">
							<div class="form-group">
								<div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
									<input type="text" required autocomplete="off" class="form-control" id="tanggal_min" name="tanggal_min" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
									<div class="input-group-prepend input-group-append">
										<span class="input-group-text font-w600">to</span>
									</div>
									<input type="text" required autocomplete="off"  class="form-control" id="tanggal_max" name="tanggal_max" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
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