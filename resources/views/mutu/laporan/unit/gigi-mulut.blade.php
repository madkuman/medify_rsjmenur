@extends('mutu.layouts.main')

@section('title')
Mutu - Laporan - Medify
@endsection

@section('subtitle')
<span class="text-muted font-w400">Laporan</span> / Gigi & Mulut
@endsection

@section('content')
<main id="main-container">
	@include('mutu.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-12 text-center py-20">
				<h3>Laporan Gigi dan Mulut</h3>
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
								Ketepatan Pelayanan Departemen Gigi dan Mulut
							</div>
						</div>
						<div class="block-content block-content-full text-center min-height-125 pt-0 desc">
							Laporan Departemen Gigi dan Mulut berdasarkan Ketepatan Pelayanan
						</div>
						<div class="block-content block-content-full text-center pt-0">
							<button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modal_gilut_ketepatan_konvensional">Buat Laporan</button>
						</div>
					</div>

					<div id="modal_gilut_ketepatan_konvensional" class="modal fade " role="dialog">
					    <div class="modal-dialog modal-dialog-centered modal-bg">
					        <div class="modal-content ">
					            <div class="modal-body">
					                <form method="get" action="{{url('mutu/laporan/gigi-mulut/gilut-ketepatan')}}" class="js-validation-be-contact">
					                    {{ csrf_field() }}
					                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Ketepatan Pelayanan Departemen Gigi dan Mulut</div>
					                    <div class="form-group">
					                        <label class="" for="example-daterange1">Jenis Ketepatan</label>
					                        <select name="jenis" id="user" class="js-select2 form-control" style="width: 100%">
					                            <option value="Cabut Gigi Salah">Cabut Gigi Salah</option>
					                            <option value="Trauma Bur Gigi">Trauma Bur Gigi</option>
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