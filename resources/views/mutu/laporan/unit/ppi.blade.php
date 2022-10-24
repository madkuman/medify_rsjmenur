@extends('mutu.layouts.main')

@section('title')
Mutu - Laporan - Medify
@endsection

@section('subtitle')
<span class="text-muted font-w400">Laporan</span> / PPI
@endsection

@section('content')
<main id="main-container">
	@include('mutu.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-12 text-center py-20">
				<h3>Laporan PPI</h3>
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
								Audit IAD
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Audit IAD Bundle Checklist
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_iad">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_iad" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/ppi/iad')}}" class="js-validation-be-contact">
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit IAD Bundle Checklist</div>
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
								Audit ISK
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Audit ISK Bundle Checklist
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_isk">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_isk" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/ppi/isk')}}" class="js-validation-be-contact">
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit ISK</div>
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
								Audit IDO
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Audit IDO Bundle Checklist
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_ido">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_ido" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/ppi/ido')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit IDO Bundle Checklist</div>
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
								Audit VAP
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Audit Ventilator Bundle Checklist
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_vap">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_vap" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/ppi/vap')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Ventilator Bundle Checklist</div>
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
								Surveilans IAD
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Surveilans IAD Bundle Checklist
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_surveilans_iad">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_surveilans_iad" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/ppi/iad-surveilans')}}" class="js-validation-be-contact">
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Survailans IAD Bundle Checklist</div>
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
								Surveilans ISK
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Surveilans ISK Bundle Checklist
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_surveilans_isk">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_surveilans_isk" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/ppi/isk-surveilans')}}" class="js-validation-be-contact">
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Survailans ISK</div>
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
								Surveilans IDO
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Surveilans IDO Bundle Checklist
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_surveilans_ido">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_surveilans_ido" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/ppi/ido-surveilans')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Survailans IDO Bundle Checklist</div>
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
								Surveilans VAP
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Surveilans Ventilator Bundle Checklist
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_surveilans_vap">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_surveilans_vap" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/ppi/vap-surveilans')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Survailans Ventilator Bundle Checklist</div>
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
								Kepatuhan Cuci Tangan
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Rekap Kepatuhan Cuci Tangan
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_cuci_tangan">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_cuci_tangan" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/ppi/cuci-tangan')}}" class="js-validation-be-contact">
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Cuci Tangan</div>
					                    <div class="form-group">
					                        <label class="" for="example-daterange1">User</label>
					                        <select name="user" id="user" class="js-select2 form-control" style="width: 100%">
					                            @foreach($users as $item)
					                            <option value="{{$item->id}}">{{$item->name}}</option>
					                            @endforeach
					                        </select>
					                    </div>
					                    <div class="form-group row">
					                        <label class="col-12">Tanggal</label>
					                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
					                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
					                            <div class="input-group-prepend input-group-append">
					                                <span class="input-group-text font-w600">to</span>
					                            </div>
					                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
					                        </div>
					                    </div>
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
								Rekap Surveilans Angka Kejadian Dekubitus
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Rekap Surveilans Angka Kejadian Dekubitus
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_kejadian_dekubitus">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_kejadian_dekubitus" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/ppi/kejadian-dekubitus')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Kejadian Dekubitus</div>
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
								Rekap Surveilans Angka Kejadian Plebitis
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Rekap Surveilans Angka Kejadian Plebitis
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_kejadian_plebitis">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_kejadian_plebitis" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/ppi/kejadian-plebitis')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Kejadian Plebitis</div>
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
								Rekap Surveilans Angka Kejadian HAP
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Rekap Surveilans Angka Kejadian HAP
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_kejadian_hap">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_kejadian_hap" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/ppi/kejadian-hap')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Kejadian HAP</div>
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
								Rekap Surveilans Angka Sepsis
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Rekap Surveilans Angka Sepsis
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_kepatuhan_sepsis">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_kepatuhan_sepsis" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/ppi/kepatuhan-sepsis')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Audit Sepsis</div>
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