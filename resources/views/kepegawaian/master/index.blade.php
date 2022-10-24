@extends('kepegawaian.layouts.main')

@section('title')
{{$htmlheader_title}}
@endsection

@section('subtitle')
  {{$contentheader_title}}
@endsection

@section('content')
<main id="container">
	<div class="row justify-content-around">
		<h3>{{$contentheader_title}}</h3>
	</div>
	<div class="content px-0">
		<div class="row">
			<div class="col-12">
				<div class="block rounded p-0">
					<div class="block-content">
						<div class="row justify-content-center px-20">
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/general">
									<div class="block-content">
										<p><i class="fa fa-cogs fa-4x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Pengaturan Umum</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/kualifikasi">
									<div class="block-content">
										<p><i class="fa fa-stethoscope fa-4x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Kualifikasi</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/pangkat">
									<div class="block-content">
										<p><i class="si si-badge fa-4x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Pangkat</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/jabatan">
									<div class="block-content">
										<p><i class="si si-badge fa-4x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Jabatan</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/subkualifikasi">
									<div class="block-content">
										<p><i class="fa fa-user-md fa-4x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Subkualifikasi</p>
									</div>
								</a>
							</div>
							{{-- <div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/jenis-jabatan">
									<div class="block-content">
										<p><i class="fa fa-anchor fa-4x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Jenis Jabatan</p>
									</div>
								</a>
							</div> --}}
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/tanda-tangan">
									<div class="block-content">
										<p><i class="fa fa-anchor fa-4x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Tanda Tangan</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/corporate-grade">
									<div class="block-content">
										<p><i class="si si-trophy fa-4x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Corporate Grade</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/penghargaan">
									<div class="block-content">
										<p><i class="si si-trophy fa-4x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Penghargaan</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/kuisioner">
									<div class="block-content">
										<p><i class="si si-note fa-4x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Kuisioner</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/jenis-kendaraan">
									<div class="block-content">
										<p><i class="fa fa-car fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Jenis Kendaraan</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/status-rumah">
									<div class="block-content">
										<p><i class="fa fa-home fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Status Rumah</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/nama-bank">
									<div class="block-content">
										<p><i class="fa fa-university fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Nama Bank</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/status-pegawai">
									<div class="block-content">
										<p><i class="fa fa-users fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Status Pegawai</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/jenis-pegawai">
									<div class="block-content">
										<p><i class="fa fa-user fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Jenis Pegawai</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/jenis-surat-peringatan">
									<div class="block-content">
										<p><i class="fa fa-envelope fa-3x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Jenis Surat Peringatan</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/faskes-asuransi">
									<div class="block-content">
										<p><i class="fa fa-medkit fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Faskes Asuransi</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/pelatihan">
									<div class="block-content">
										<p><i class="si si-note fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Pelatihan</p>
									</div>
								</a>
							</div>
							{{-- <div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/gelar-pendidikan">
									<div class="block-content">
										<p><i class="si si-badge fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Gelar Pendidikan</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/strata-pendidikan">
									<div class="block-content">
										<p><i class="fa fa-anchor fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Strata Pendidikan</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/jenis-pendidikan">
									<div class="block-content">
										<p><i class="fa fa-stethoscope fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Jenis Pendidikan</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/institusi-pendidikan">
									<div class="block-content">
										<p><i class="fa fa-university fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Institusi Pendidikan</p>
									</div>
								</a>
							</div> --}}
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/departemen">
									<div class="block-content">
										<p><i class="fa fa-university fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Departemen</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/pendidikan">
									<div class="block-content">
										<p><i class="fa fa-university fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Pendidikan</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/beban-kerja">
									<div class="block-content">
										<p><i class="fa fa-anchor fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Beban Kerja</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/resiko-kerja">
									<div class="block-content">
										<p><i class="fa fa-user-md fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Resiko Kerja</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/kategori-pegawai">
									<div class="block-content">
										<p><i class="fa fa-users fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Kategori Pegawai</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/masa-kerja">
									<div class="block-content">
										<p><i class="fa fa-calendar-check-o fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Masa Kerja</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/golongan">
									<div class="block-content">
										<p><i class="fa fa-pie-chart fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Golongan</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/tim-pembagi-jasa">
									<div class="block-content">
										<p><i class="fa fa-users fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Tim Pembagi Jasa</p>
									</div>
								</a>
							</div>
							<div class="col-xs-12 col-md-3 px-10">
								<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/cuti">
									<div class="block-content">
										<p><i class="fa fa-forward fa-5x text-muted"></i></p>
										<p class="text-uppercase font-w600 font-size-lg mb-0">Cuti</p>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('js')
<script type="text/javascript" src="{{asset('assets/js/jquery1.10.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/dataTables1.10.bootstrap4.min.js')}}"></script>
@endsection
