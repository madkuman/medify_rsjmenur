@extends('layouts.main2')

@section('title')
Ruangan - Kamar Operasi - Medify
@endsection

@section('css')

<style>
div.dataTables_wrapper div.dataTables_processing {
	top: 10%;
	background-color: rgba(188, 192, 196, 0.5);
}
th {
	font-size: 12px;
}
</style>
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('kamaroperasi.components.navbar')
		<div class="row">
			<div class="col-12">
				<div class="block block-rounded">
					<div class="block-header">
						<h3 class="block-title">Jadwal Operasi</h3>
						<a href="javascript:void(0)" class="btn btn-success submit-button" style="margin-left: 10px;" id="download_data"><i class="fa fa-download"></i> Download Data</a>
						<a href="{{url('kamaroperasi/pendaftaran/tambah_permintaan')}}" class="btn btn-primary" style="margin-left: 10px; display: none;"><i class="fa fa-plus"></i> Tambah Permintaan Operasi</a>
						<hr>
					</div>
					<div class="block-content">
						<div class="row gutters-tiny">
							<div class="col-12">
								<div class="row">
									<div class="col-sm-12 col-xl-2">
										<div class="form-group">
											<div class="input-group">
												<input type="text" class="form-control search_box" id="search_box" placeholder="Search">
												<div class="input-group-append">
													<button type="button" class="btn btn-alt-secondary">
														<i class="fa fa-search"></i>
													</button>
												</div>
											</div>
										</div>
									</div>

									<div class="col-sm-12 col-xl-2">
										<div class="form-group">
											<select class="js-select2 form-control" id="dokter" style="width: 100%;" data-placeholder="Semua Dokter">

												<option value="all">Semua Dokter</option>
												@foreach ($dokters as $dokter)
												<option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-sm-12 col-xl-2">
										<div class="form-group">
											<select class="js-select2 form-control" id="jenis_spesialis" style="width: 100%;" name="jenis_spesialis" data-placeholder="Semua Jenis Spesialis">
												<option value="all">Jenis Spesialis</option>
												@foreach ($spesialis_operasi as $item)
												<option value="{{ $item->id }}">{{ $item->nama }}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-sm-12 col-xl-2">
										<div class="form-group">
											<select class="js-select2 form-control" id="kamar_operasi" style="width: 100%;" data-placeholder="Semua Kamar Operasi">
												{{-- <option></option> --}}
												<option value="all">Semua Kamar Operasi</option>
												@foreach ($ruangan as $ruang)
												<option value="{{ $ruang->id }}">{{ $ruang->name }}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-sm-12 col-xl-4">
										<div class="form-group row">
											<div class="col-12 text-center">

												<div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true" id="datepicker">
													<input type="text" class="form-control" id="tanggal_min" name="example-daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$today}}">
													<div class="input-group-prepend input-group-append">
														<span class="input-group-text font-w600">to</span>
													</div>
													<input type="text" class="form-control" id="tanggal_max" name="example-daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{$today}}">
												</div>
											</div>
										</div>
									</div>
									<!-- <div class="col-1">
										<button type="button" id="filter_button" class="btn btn-primary">Filter</button>
									</div> -->
								</div>
							</div>
							<div class="col-12" id="copy-scroll" style="overflow-x: scroll; height: 20px;">
								<div class="copy-table" style="height: 20px;"></div>
							</div>
							<div class="col-12" id="table-div" style="overflow-x: scroll;">
								<table class="table table-bordered table-striped table-vcenter js-dataTable-full">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>IDENTITAS PASIEN</th>
											<th>ASAL LAYANAN</th>
											<th class="d-none d-sm-table-cell">JENIS PASIEN</th>
											<th class="d-none d-sm-table-cell">KAMAR OK</th>
											<th class="d-none d-sm-table-cell">RONDE</th>
											<th class="d-none d-sm-table-cell">DOKTER</th>
											<th class="d-none d-sm-table-cell">DIAGNOSIS</th>
											<th class="d-none d-sm-table-cell">JENIS SPESIALIS</th>
											<th class="d-none d-sm-table-cell">STATUS</th>
											<th class="d-none d-sm-table-cell">DIJADWALKAN OLEH</th>
                                            <th class="text-center">Aksi</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<form type="POST" action="{{url('kamaroperasi/pendaftaran/download')}}" id="form_download_jadwal" target="_blank">
	{{csrf_field()}}
	<input type="hidden" id="search_box_form" name="search_box">
	<input type="hidden" id="dokter_form" name="dokter_id">
	<input type="hidden" id="jenis_spesialis_form" name="jenis_spesialis">
	<input type="hidden" id="kamar_operasi_form" name="ruangan_id">
	<input type="hidden" id="tanggal1_form" name="tanggal_min">
	<input type="hidden" id="tanggal2_form" name="tanggal_max">
</form>

@endsection

@section('js')


<script type="text/javascript">
	$(document).ready(function(){
		$('#datepicker').datepicker({
			format: "dd/mm/yyyy"
		});
	})
</script>
<script type="text/javascript">
	$('#download_data').on('click', function()
	{	
		var search_box = $('#search_box').val();
		var dokter = $('#dokter').val();
		var jenis_spesialis = $('#jenis_spesialis').val();
		var kamar_operasi = $('#kamar_operasi').val();
		var tanggal1 = $('#tanggal_min').data('datepicker').getFormattedDate('dd/mm/yyyy');
		var tanggal2 = $('#tanggal_max').data('datepicker').getFormattedDate('dd/mm/yyyy');

		$('#search_box_form').val(search_box);
		$('#dokter_form').val(dokter);
		$('#kamar_operasi_form').val(kamar_operasi);
		$('#tanggal1_form').val(tanggal1);
		$('#jenis_spesialis_form').val(jenis_spesialis);
		$('#tanggal2_form').val(tanggal2);
		$('#form_download_jadwal').submit();
		
		$('#form_download_jadwal').unbind('submit');

	});
</script>
<script>
	$(document).ready(function(){
		Codebase.helpers(['select2']);
		$("#jadwal_operasi").addClass('active');

		var datatable = $('.js-dataTable-full').DataTable({
			columnDefs: [ {className: "text-center", targets: 7} ],
			order: [[ 0, "asc" ]],
			pageLength: 10,
			processing: true,
			oLanguage: {sProcessing: '<i class="fa fa-4x fa-cog fa-spin text-primary"></i><p>loading...</p>'},
			dom: 'tipr',
			ajax: {
				url: '{{url('ajax/kamaroperasi/transaksi/')}}',
				type: "POST",
				data: function(d)
				{
					d._token = "{{csrf_token()}}";
					d.ruangan_id = $("#kamar_operasi option:selected").val();
					d.dokter_id = $("#dokter option:selected").val();
					d.jenis_spesialis = $("#jenis_spesialis").val();
					d.tanggal_min = $("#tanggal_min").datepicker('getFormattedDate');
					d.tanggal_max = $("#tanggal_max").datepicker('getFormattedDate');
				},
				dataSrc:""
			},
			columns: [
			{ "data": "no" },
			{ "data": "name" },
			{ "data": "lokasi" },
			{ "data": "type" },
			{ "data": "ruangan" },
			{ "data": "nomor_ronde" },
			{ "data": "doctor" },
			{ "data": "diagnosis" },
			{ "data": "jenis_spesialis" },
			{ "data": "status" },
			{ "data": "by" },
			{ "data": "aksi" }
			]
		});

		$("#dokter").on('change', function(){
			datatable.ajax.reload();
		});

		$("#kamar_operasi").on('change', function(){
			datatable.ajax.reload();
		});

		$("#jenis_spesialis").on('change', function(){
			datatable.ajax.reload();
		});

		$("#tanggal_min").on('change', function(){
			datatable.ajax.reload();
		});

		$("#tanggal_max").on('change', function(){
			datatable.ajax.reload();
		});
		$("#search_box").keyup(function(){
			datatable.search($(this).val()).draw();
		});

		datatable.on('draw', function() {
			var width = $('table').width();
			$('.copy-table').css('width', width);
		});
		$(function(){
		    $("#copy-scroll").scroll(function(){
		        $("#table-div")
		            .scrollLeft($("#copy-scroll").scrollLeft());
		    });
		    $("#table-div").scroll(function(){
		        $("#copy-scroll")
		            .scrollLeft($("#table-div").scrollLeft());
		    });
		});
	});
</script>
	@endsection
