@extends('mutu.layouts.main')

@section('title')
Mutu - Laporan - Medify
@endsection

@section('subtitle')
<span class="text-muted font-w400">Laporan</span> / Rawat Inap
@endsection

@section('content')
<main id="main-container">
	@include('mutu.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-12 text-center py-20">
				<h3>Laporan Rawat Inap</h3>
			</div>
			<div class="col-12 my-20 px-30">
				<input type="text" class="form-control fuzzy-search-laporan" placeholder="Cari Laporan">
			</div>
		</div>
		<div id="laporan-list">
			<ul class="list row row-deck">
                <li class="col-lg-3 col-sm-12 d-flex align-items-stretch">
                	<div class="block block-bordered py-20" style="width: 100%">
						<div class="block-header">
							<div class="block-title text-center min-height-75 title">
								Kepatuhan Identifikasi Pasien
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Rekap Kepatuhan Identifikasi Pasien
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_identifikasi">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_identifikasi" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/rawat-inap/kepatuhan-identifikasi')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Kepatuhan Identifikasi Pasien</div>
					                    @include('mutu.layouts.components.zona-tanggal')
					                    <div id="formid"> </div>

					                    <div class="modal-footer">
					                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                        <button type="submit" class="btn btn-primary submit-button">Print</button>
					                    </div>
					                </form>

					            </div>
					        </div>
					    </div>
					</div>
                </li>

                <li class="col-lg-3 col-sm-12 d-flex align-items-stretch">
                	<div class="block block-bordered py-20" style="width: 100%">
						<div class="block-header">
							<div class="block-title text-center min-height-75 title">
								Kepatuhan Jam Visite
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Rekap Kepatuhan Jam Visite Pasien
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_kepatuhan_visite">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_kepatuhan_visite" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/rawat-inap/kepatuhan-visite')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Kepatuhan Jam Visite</div>
					                    @include('mutu.layouts.components.ruangan-tanggal')
					                    <div id="formid"> </div>

					                    <div class="modal-footer">
					                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                        <button type="submit" class="btn btn-primary submit-button">Print</button>
					                    </div>
					                </form>

					            </div>
					        </div>
					    </div>
					</div>
                </li>

                {{-- <li class="col-lg-3 col-sm-12 d-flex align-items-stretch">
                	<div class="block block-bordered py-20" style="width: 100%">
						<div class="block-header">
							<div class="block-title text-center min-height-75 title">
								Kepatuhan Upaya Pencegahan Risiko Cedera Akibat Pasien Jatuh
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Rekap Kepatuhan Upaya Pencegahan Risiko Cedera Akibat Pasien Jatuh
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " onclick="sweetTalking2();" data-title="Laporan Kunjungan Harian">Buat Laporan</button>
						</div>
					</div>
                </li> --}}

                <li class="col-lg-3 col-sm-12 d-flex align-items-stretch">
                	<div class="block block-bordered py-20" style="width: 100%">
						<div class="block-header">
							<div class="block-title text-center min-height-75 title">
								Penilaian CPPT Dan Kehadiran DPJP
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Evaluasi Penilaian CPPT Dan Kehadiran DPJP
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_penilaian_cppt_dpjp">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_penilaian_cppt_dpjp" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/rawat-inap/penilaian-cppt-kehadiran-dpjp')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Evaluasi Peniliain CPPT dan Kehadiran DPJP</div>
					                    @include('mutu.layouts.components.ruangan-tanggal')
					                    <div id="formid"> </div>

					                    <div class="modal-footer">
					                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                        <button type="submit" class="btn btn-primary submit-button">Print</button>
					                    </div>
					                </form>

					            </div>
					        </div>
					    </div>
					</div>
                </li>

                <li class="col-lg-3 col-sm-12 d-flex align-items-stretch">
                	<div class="block block-bordered py-20" style="width: 100%">
						<div class="block-header">
							<div class="block-title text-center min-height-75 title">
								Rekap Kejadian Pasien Jatuh
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Rekap Kejadian Pasien Jatuh
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_kejadian_jatuh">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_kejadian_jatuh" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/rawat-inap/kejadian-jatuh')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Kejadian Jatuh</div>
					                    @include('mutu.layouts.components.zona-tanggal')
					                    <div id="formid"> </div>

					                    <div class="modal-footer">
					                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                        <button type="submit" class="btn btn-primary submit-button">Print</button>
					                    </div>
					                </form>

					            </div>
					        </div>
					    </div>
					</div>
                </li>
			</ul>
		</div>
	</div>
</main>
@endsection

@section('js')
<script type="text/javascript" src="{{url('assets/js/plugins/listjs/list.min.js')}}"></script>
<script type="text/javascript">
	$(document).on('click', '.submit-button', function(){
		$(this).parent().parent().unbind('submit').submit();
	})
    var options = {
        valueNames: [ 'title', 'desc' ]
    };
    var laporanList = new List('laporan-list', options);
    $(".fuzzy-search-laporan").keyup(function(){
        laporanList.search($(this).val());
    });
</script>
@endsection