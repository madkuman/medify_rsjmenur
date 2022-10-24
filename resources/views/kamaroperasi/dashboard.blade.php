@extends('layouts.main2')

@section('title') Dashboard - Kamar Operasi - Medify
@endsection {{--
@section('style')
<style>
p.font-size-h1 {
	margin-bottom: 0;
}
</style>
@endsection --}}
@section('style')

<style type="text/css">

.clickable-row {
	cursor: pointer;
}
</style>
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('kamaroperasi.components.navbar')
		<div class="row">
			<div class="col-6">
				<h3 class="block-title">Dashboard</h3>
			</div>
			<div class="col-6 text-right">
				<a href="{{url('kamaroperasi/pendaftaran/tambah_permintaan')}}" class="btn btn-secondary" style="margin-left: 10px;  display: none;"><i class="fa fa-plus"></i> Tambah Permintaan Operasi</a>
			</div>
		</div>
		<hr>

		{{-- <!-- <div class="row">
			<div class="col-md-6">
				<a class="block block-link-shadow" href="{{url('kamaroperasi/pemesanan')}}">
					<div class="block-content block-content-full">
						<div class="text-right font-size-h4 font-w700">
							Permintaan Hari Ini
						</div>
						<div class="row py-20 text-right">
							<div class="col-12">
								<div class="font-size-h3 font-w600 text-primary">{{ $count_permintaan }}</div>
								<div class="font-size-default font-w600 text-uppercase text-muted">Permintaan</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-6">
				<div class="block block-link-shadow" href="javascript:void(0)">
					<div class="block-content block-content-full">
						<div class="font-size-h4 font-w700">
							Jenis Operasi
						</div>
						<div class="row py-20 text-center">
							<div class="col-3 border-r">
								<div class="font-size-h3 font-w600 text-primary">{{ $count_kecil }}</div>
								<div class="font-size-default font-w600 text-uppercase text-muted">Kecil</div>
							</div>
							<div class="col-3 border-r">
								<div class="font-size-h3 font-w600 text-primary">{{ $count_sedang }}</div>
								<div class="font-size-default font-w600 text-uppercase text-muted">Sedang</div>
							</div>
							<div class="col-3 border-r">
								<div class="font-size-h3 font-w600 text-primary">{{ $count_besar }}</div>
								<div class="font-size-default font-w600 text-uppercase text-muted">Besar</div>
							</div>
							<div class="col-3">
								<div class="font-size-h3 font-w600 text-primary">{{ $count_khusus }}</div>
								<div class="font-size-default font-w600 text-uppercase text-muted">Khusus</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> --> --}}

		<div class="row">
			<div class="col-md-6">
				<div class="block block-bordered">
					<div class="block-header">
						<h3 class="block-title">Permintaan Operasi ({{$count_permintaan}})</h3>
					</div>
					<div class="block-content">
						{{--@if ($permintaans->count())--}}
						<div class="autoscroll-x">
							<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="permintaan_operasi">
								<thead>
									<tr>
										<th>#</th>
										<th>NAMA PASIEN</th>
										<th>DIAGNOSIS</th>
										<th>WAKTU PERMINTAAN</th>
									</tr>
								</thead>
								<tbody>
									@forelse($permintaans as $i => $permintaan)
									<tr>
										<td>{{ $i+1 }}</td>
										<td>{{ $permintaan->pasien_detail->name }}</td>
										<td>{{ $permintaan->diagnosis ? $permintaan->diagnosis : '-' }}</td>
										<td>{{ $permintaan->getWaktuPermintaan()->diffForHumans() }}</td>
									</tr>
									@empty
									<tr class="text-center">
										<td colspan="4">Belum ada permintaan untuk hari ini</td>
									</tr>
									@endforelse
								</tbody>
							</table>
						</div>
						<div class="row" style="margin-bottom: 15px;">
							<div class="col-12 text-center">
								<a href="{{ url('/kamaroperasi/pemesanan') }}">Selengkapnya</a>
							</div>
						</div>
						{{--@else
							<h4 class="text-center">Tidak ada data</h4>
							@endif--}}
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="block block-bordered">
						<div class="block-header">
							<h3 class="block-title">Jadwal Operasi ({{$count_jadwal}})</h3>
						</div>
						<div class="block-content">
							<div class="autoscroll-x">
								<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="jadwal_operasi">
									<thead>
										<tr>
											<th>#</th>
											<th>NAMA PASIEN</th>
											<th>RUANGAN</th>
											<th>RONDE</th>
											<th>DOKTER</th>
											<th>JENIS</th>
										</tr>
									</thead>

									<tbody>
										@php $i = 1;
										@endphp
										@forelse ($jadwals as $jadwal)
										<tr>
											<td>{{ $i++ }}</td>
											<td>{{ $jadwal->pasien_detail->name }}</td>
											<td>{{ $jadwal->ruangan->name }}</td>
											<td>{{ $jadwal->nomor_ronde }}</td>
											<td>{{ $jadwal->dokter->name }}</td>
											<td>{{ $jadwal->hasil ? $jadwal->hasil->jenis_operasi ? $jadwal->hasil->jenis_operasi : '-' : '-' }}</td>
										</tr>
										@empty
										<tr class="text-center">
											<td colspan="6">Belum ada operasi untuk hari ini</td>
										</tr>
										@endforelse
									</tbody>
								</table>
							</div>

							<div class="row" style="margin-bottom: 15px;">
								<div class="col-12 text-center">
									<a href="{{ url('kamaroperasi/jadwal') }}">Selengkapnya</a>
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
	
	

	<script type="text/javascript">
		jQuery('.js-dataTable-full').dataTable({
			"ordering": true,
			pageLength: 8,
			lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
			autoWidth: false
		});
	</script>
	<script>
		$(document).ready(function() {
			$("#dashboard").addClass('active');
		});
	</script>
	@endsection
