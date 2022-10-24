@extends('mutu.layouts.main')

@section('title')
Mutu - Laporan - Medify
@endsection

@section('subtitle')
Laporan
@endsection

@section('content')
<main id="main-container">
	@include('mutu.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-12 text-center py-20">
				<h3>Laporan</h3>
			</div>
			<div class="col-12 my-20 px-30">
				<input type="text" class="form-control fuzzy-search-unit" placeholder="Cari Unit">
			</div>
		</div>
		<div id="unit-list">
			<ul class="list row row-deck">
				<li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">PPI</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Unit PPI</p>
							<a href="{{url('mutu/laporan/ppi')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li>
				<li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">Rawat Jalan</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Unit Rawat Jalan</p>
							<a href="{{url('mutu/laporan/rawat-jalan')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li>
				<li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">Rawat Inap</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Unit Rawat Inap</p>
							<a href="{{url('mutu/laporan/rawat-inap')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li>
				
				{{-- <li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">Gigi dan Mulut</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Unit Gigi dan Mulut</p>
							<a href="{{url('mutu/laporan/gigi-mulut')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li>
				<li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">THT</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Unit THT</p>
							<a href="{{url('mutu/laporan/tht')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li>
				<li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">Mata</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Unit Mata</p>
							<a href="{{url('mutu/laporan/mata')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li>
				<li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">Bedah</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Unit Bedah</p>
							<a href="{{url('mutu/laporan/bedah')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li>
				<li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">Lab PA</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Unit Lab PA</p>
							<a href="{{url('mutu/laporan/lab-pa')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li>
				<li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">Lab PK dan PPRA</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Unit Lab PK dan PPRA</p>
							<a href="{{url('mutu/laporan/lab-pk-ppra')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li>
				<li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">Radiologi</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Unit Radiologi</p>
							<a href="{{url('mutu/laporan/radiologi')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li> --}}

				<li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">IGD</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Unit IGD</p>
							<a href="{{url('mutu/laporan/igd')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li>

				<li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">Keselamatan Kerja</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Keselamatan Kerja</p>
							<a href="{{url('mutu/laporan/keselamatan-kerja')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li>
				<li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">SPM Penunjang</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan SPM Penunjang</p>
							<a href="{{url('mutu/laporan/spm-penunjang')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li>
				<li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">Audit</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Mutu Audit</p>
							<a href="{{url('mutu/laporan/audit')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li>
				{{-- <li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">SATMA dan HUMAS</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Unit SATMA dan HUMAS</p>
							<a href="{{url('mutu/laporan/satma-humas')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li>
				<li class="col-lg-3 col-sm-12">
					<div class="block block-bordered py-20">
						<div class="block-header">
							<div class="block-title text-center font-w600">
								<h5 class="title mb-0">IT</h5>
							</div>
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<p class="desc">Laporan Unit IT</p>
							<a href="{{url('mutu/laporan/it')}}" class="btn btn-primary">Lihat</a>
						</div>
					</div>
				</li> --}}
			</ul>
		</div>
	</div>
</main>
@endsection

@section('js')
<script type="text/javascript" src="{{url('assets/js/plugins/listjs/list.min.js')}}"></script>
<script type="text/javascript">
    var options = {
        valueNames: [ 'title', 'desc' ]
    };
    var laporanList = new List('unit-list', options);
    $(".fuzzy-search-unit").keyup(function(){
        laporanList.search($(this).val());
    });
</script>
@endsection