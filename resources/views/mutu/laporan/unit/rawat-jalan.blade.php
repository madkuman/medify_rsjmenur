@extends('mutu.layouts.main')

@section('title')
Mutu - Laporan - Medify
@endsection

@section('subtitle')
<span class="text-muted font-w400">Laporan</span> / Rawat Jalan
@endsection

@section('content')
<main id="main-container">
	@include('mutu.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-12 text-center py-20">
				<h3>Laporan Rawat Jalan</h3>
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
								Waktu Tunggu Rawat Jalan
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Waktu Tunggu Rawat Jalan
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_waktu_tunggu">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_waktu_tunggu" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/rawat-jalan/waktu-tunggu')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Waktu Tunggu Rawat Jalan</div>
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

{{--                <li class="col-lg-3 col-sm-12 d-flex align-items-stretch">--}}
{{--                	<div class="block block-bordered py-20" style="width: 100%">--}}
{{--						<div class="block-header">--}}
{{--							<div class="block-title text-center min-height-75 title">--}}
{{--								Jam Buka Pelayanan--}}
{{--							</div>--}}
{{--						</div>--}}
{{--						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">--}}
{{--							Laporan Jam Buka Pelayanan--}}
{{--						</div>--}}
{{--						<div class="block-content block-content-full text-center pt-0">--}}
{{--							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_jam_buka">Buat Laporan</button>--}}
{{--						</div>--}}
{{--					</div>--}}

{{--					<div id="modal_jam_buka" class="modal fade " role="dialog">--}}
{{--					    <div class="modal-dialog modal-dialog-centered modal-bg">--}}
{{--					        <div class="modal-content ">--}}
{{--					            <div class="modal-body">--}}
{{--					                <form method="get" action="{{url('mutu/laporan/rawat-jalan/jam-buka')}}" class="js-validation-be-contact">--}}
{{--					                    {{ csrf_field() }}--}}
{{--					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Jam Buka Pelayanan</div>--}}
{{--					                    <div class="form-group row">--}}
{{--					                        <label class="col-12">Tanggal</label>--}}
{{--					                        <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--					                            <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--					                            <div class="input-group-prepend input-group-append">--}}
{{--					                                <span class="input-group-text font-w600">to</span>--}}
{{--					                            </div>--}}
{{--					                            <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">--}}
{{--					                        </div>--}}
{{--					                    </div>--}}
{{--					                    <div id="formid"> </div>--}}

{{--					                    <div class="modal-footer">--}}
{{--					                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--					                        <button type="submit" class="btn btn-primary submit-button">Print</button>--}}
{{--					                    </div>--}}
{{--					                </form>--}}

{{--					            </div>--}}
{{--					        </div>--}}
{{--					    </div>--}}
{{--					</div>--}}
{{--                </li>--}}
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