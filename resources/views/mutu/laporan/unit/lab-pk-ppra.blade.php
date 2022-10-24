@extends('mutu.layouts.main')

@section('title')
Mutu - Laporan - Medify
@endsection

@section('subtitle')
<span class="text-muted font-w400">Laporan</span> / Lab PK & PPRA
@endsection

@section('content')
<main id="main-container">
	@include('mutu.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-12 text-center py-20">
				<h3>Laporan Lab PK dan PPRA</h3>
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
								Ketepatan Pelayanan Golongan Darah Lab PK
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Mutu Terkait Ketepatan Pelayanan pada Uji Golongan Darah Lab PK
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_labpk_goldar">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_labpk_goldar" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/lab-pk-ppra/labpk-goldar')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Ketepatan Pelayanan Lab PK</div>
					                    @include('mutu.layouts.components.range-datepicker')
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
								Infeksi Bakteri Lab PK
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Lab Patologi Klinis berdasarkan infeksi bakteri
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_labpk_bakteri">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_labpk_bakteri" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/lab-pk-ppra/labpk-bakteri')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Infeksi Bakteri Lab PK</div>
					                    <div class="form-group">
					                        <label class="" for="example-daterange1">Jenis Bakteri</label>
					                        <select name="bakteri" id="user" class="js-select2 form-control" style="width: 100%">
					                            <option value="">Semua</option>
					                            <option value="mdr">Bakteri MDR</option>
					                            <option value="karbapenemase">Bakteri Karbapenemase</option>
					                            <option value="esbl">Bakteri ESBL</option>
					                            <option value="aureus">Bakteri Aureus</option>
					                        </select>
					                    </div>
					                    @include('mutu.layouts.components.range-datepicker')
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