@extends('mutu.layouts.main')

@section('title')
Mutu - Laporan - Medify
@endsection

@section('subtitle')
<span class="text-muted font-w400">Laporan</span> / SATMA & HUMAS
@endsection

@section('content')
<main id="main-container">
	@include('mutu.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-12 text-center py-20">
				<h3>Laporan SATMA dan HUMAS</h3>
			</div>
			<div class="col-12 my-20 px-30">
				<input type="text" class="form-control fuzzy-search-laporan" placeholder="Cari Laporan">
			</div>
		</div>
		<div id="laporan-list">
			<ul class="list row">
                <li class="col-lg-3 col-sm-12 d-flex align-items-stretch">
                	<div class="block block-bordered py-20" style="width: 100%">
						<div class="block-header">
							<div class="block-title text-center min-height-75 title">
								Penilaian Kuisioner
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Kepegawaian, terkait Kuisioner Kepegawaian
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_kuisioner_penilaian">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_kuisioner_penilaian" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/satma-humas/kuisioner-penilaian')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Kuisioner - Laporan Penilaian Kuisioner</div>
					                    <div class="form-group row">
					                        <label class="col-12">Nama Kuisioner</label>
					                        <div class="col-12">
					                            <select class="form-control js-select2" style="width: 100%" name="kuisioner_id" required>
					                                <option value="" disabled selected>-- Pilih Kuisioner --</option>
					                                @foreach ($kuisionerlist as $item)
					                                <option value="{{$item->id}}">{{$item->nama}}</option>
					                                @endforeach
					                            </select>
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
								Keamanan, Kesehatan dan Keselamatan Kerja
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Keamanan, Kesehatan dan Keselamatan Kerja
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_k3">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_k3" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/satma-humas/k3')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Keamanan, Kesehatan dan Keselamatan Kerja</div>
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
								Harmat - Listrik Mati
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Mutu Terkait Keterlambatan Respon Time Genset
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_harmat_listrik_mati">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_harmat_listrik_mati" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/satma-humas/harmat/listrik-mati')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Mutu Terkait Keterlambatan Respon Time Genset</div>
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
								Humas - Komplain
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Humas Terkait Kecepatan Respon Terhadap Komplain
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_humas_komplain">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_humas_komplain" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/satma-humas/humas-komplain')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Humas - Komplain</div>
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
								Harmat - Perbaikan Alat
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Mutu Terkait Perbaikan Alat
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_harmat_perbaikan_alat">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_harmat_perbaikan_alat" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/satma-humas/harmat/perbaikan-alat')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Mutu Terkait Perbaikan Alat</div>
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
    $('#modal_kesling_limbah_b3').on('change', 'select[name="jenis_zat"]', function () {
		zat = $(this).val();
		if (zat == 'Padat') {
			$('.padat-form').removeClass('d-none');
			$('.cair-form').addClass('d-none');
		} else {
			$('.cair-form').removeClass('d-none');
			$('.padat-form').addClass('d-none');
		}
	})
</script>
@endsection