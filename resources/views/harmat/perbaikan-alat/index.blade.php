@extends('harmat.layouts.main')

@section('title')
Harmat - Perbaikan Alat - Medify
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
	<style type="text/css">
		.container-fluid {
			padding-right: 0 !important;
			padding-left: 0 !important;
		}
	</style>
@endsection

@section('content')

	<main id="main-container">
		<div class="row">
			<div class="col-12">
		        @include('harmat.layouts.header')
		    </div>
		</div>
		<div class="container">
			@include('harmat.perbaikan-alat.components.content')
		</div>
	</main>

	@include('harmat.perbaikan-alat.components.modal-create')
	@include('harmat.perbaikan-alat.components.modal-edit')
	@include('harmat.perbaikan-alat.components.modal-delete')
	@include('harmat.perbaikan-alat.components.modal-update-status')
@endsection

@section('js')
	
	
	<script src="{{asset('assets/js/pages/be_tables_datatables.js')}}"></script>

	<script type="text/javascript">
		$('#btn-add').on('click', function(){
			$('#modal-create').modal('show');
		});

        $('#asal_ruangan').select2({
            dropdownParent: $("#modal-create"),
            ajax: {
			url: API_URL+"/harmat/perbaikan-alat/getLokasi",
			dataType: 'json',
			delay: 250,
				data: function (params)
				{
					return {
						keyword: params.term
					};
				},
				processResults: function (data) {
					return {
						results: data
					};
				}
			},
			escapeMarkup: function (markup) { return markup; },
			minimumInputLength: 3,
			placeholder: "Cari Lokasi"
	    });

	    $('#table').on('click', '.btn-edit', function(){
	    	var id = $(this).attr('id_data');

	    	$('#edit_tanggal_laporan').parent().parent().hide();
	    	$('#edit_tanggal_identifikasi').parent().parent().hide();
	    	$('#edit_tanggal_mulai').parent().parent().hide();
	    	$('#edit_tanggal_selesai').parent().parent().hide();

	    	$('#edit_jam_laporan').parent().parent().hide();
	    	$('#edit_jam_identifikasi').parent().parent().hide();

	    	$.ajax({
	        	type:'GET',
				url : API_URL+'/harmat/perbaikan-alat',
				data:{ id : id },
				beforeSend:function() {
					$('#loading').removeClass('d-none');
					$('#edit-content').addClass('d-none');
				},
				success:function(data){
					var status       = data.status;
					var alasan       = data.alasan;
					var nama_alat    = data.nama_alat;
					var asal_ruangan = data.asal_ruangan;

					$('#edit_alasan').val(alasan);
					$('#edit_nama_alat').val(nama_alat);

					if ($('#edit_asal_ruangan').hasClass("select2-hidden-accessible")) {
					    $('#edit_asal_ruangan').select2('destroy');
					}
					$('#edit_asal_ruangan').html('');
					$('#edit_asal_ruangan').append('<option value="'+asal_ruangan+'">'+asal_ruangan+'</option');

					$('#edit_asal_ruangan').select2({
				        dropdownParent: $("#modal-edit"),
				        ajax: {
						url: API_URL+"/harmat/perbaikan-alat/getLokasi",
						dataType: 'json',
						delay: 250,
							data: function (params)
							{
								return {
									keyword: params.term
								};
							},
							processResults: function (data) {
								return {
									results: data
								};
							}
						},
						escapeMarkup: function (markup) { return markup; },
						minimumInputLength: 2,
						placeholder: {
							id   : asal_ruangan,
							text : asal_ruangan
						}
				    });

					$('#form-edit').attr('action', 'perbaikan-alat/'+id+'/update');

					if(status == 0){
						var tgl_laporan = data.tgl_laporan;

						tgl_laporan = tgl_laporan.split(" ");

						tgl   = tgl_laporan[0].split("-");
						waktu = tgl_laporan[1].split(":");

						var tahun   = tgl[0];
						var bulan   = tgl[1];
						var tanggal = parseInt(tgl[2]);

						var jam   = parseInt(waktu[0]);
						var menit = parseInt(waktu[1]);

						$('#edit_tahun_laporan').val(tahun);
						$('#edit_bulan_laporan').val(bulan);
						$('#edit_tanggal_laporan').val(tanggal);
						$('#edit_jam_laporan').val(jam);
						$('#edit_menit_laporan').val(menit);

						$('#edit_tanggal_laporan').parent().parent().show();
						$('#edit_jam_laporan').parent().parent().show();
					} else if(status == 1){
						var tgl_identifikasi = data.tgl_identifikasi;

						var tgl_identifikasi   = tgl_identifikasi.split(" ");

						tgl   = tgl_identifikasi[0].split("-");
						waktu = tgl_identifikasi[1].split(":");

						var tahun   = tgl[0];
						var bulan   = tgl[1];
						var tanggal = parseInt(tgl[2]);

						var jam   = parseInt(waktu[0]);
						var menit = parseInt(waktu[1]);

						$('#edit_tahun_identifikasi').val(tahun);
						$('#edit_bulan_identifikasi').val(bulan);
						$('#edit_tanggal_identifikasi').val(tanggal);
						$('#edit_jam_identifikasi').val(jam);
						$('#edit_menit_identifikasi').val(menit);

						$('#edit_tanggal_identifikasi').parent().parent().show();
						$('#edit_jam_identifikasi').parent().parent().show();
					} else if(status == 2){
						var tgl_mulai = data.tgl_mulai;

						var tgl_mulai   = tgl_mulai.split("-");

						var tahun_mulai   = tgl_mulai[0];
						var bulan_mulai   = tgl_mulai[1];
						var tanggal_mulai = parseInt(tgl_mulai[2]);

						$('#edit_tahun_mulai').val(tahun_mulai);
						$('#edit_bulan_mulai').val(bulan_mulai);
						$('#edit_tanggal_mulai').val(tanggal_mulai);

						$('#edit_tanggal_mulai').parent().parent().show();
					} else if(status == 3){
						var tgl_selesai = data.tgl_selesai;

						tgl_selesai = tgl_selesai.split("-");

						var tahun_selesai   = tgl_selesai[0];
						var bulan_selesai   = tgl_selesai[1];
						var tanggal_selesai = parseInt(tgl_selesai[2]);

						$('#edit_tahun_selesai').val(tahun_selesai);
						$('#edit_bulan_selesai').val(bulan_selesai);
						$('#edit_tanggal_selesai').val(tanggal_selesai);

						$('#edit_tanggal_selesai').parent().parent().show();
					}

					$('#loading').addClass('d-none');
					$('#edit-content').removeClass('d-none');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(XMLHttpRequest, textStatus, errorThrown);
				},
	        });

			$('#modal-edit').modal('show');
		});

		$('#table').on('click', '.btn-delete', function(){
			var id = $(this).attr('id_data');

			$('#form-delete').attr('action', 'perbaikan-alat/'+id+'/delete');

			$('#modal-delete').modal('show');
		});

		$('#table').on('click', '.btn-status', function(){
			var id = $(this).attr('id_data');

	    	$.ajax({
	        	type:'GET',
				url : API_URL+'/harmat/perbaikan-alat',
				data:{ id : id },
				beforeSend:function() {
					$('#loading-update-status').removeClass('d-none');
					$('#content-update-status').addClass('d-none');
				},
				success:function(data){
					var status       = data.status;
					var nama_alat    = data.nama_alat;
					var asal_ruangan = data.asal_ruangan;

					$('#update-status_nama_alat').val(nama_alat);
					$('#update-status_asal_ruangan').val(asal_ruangan);
					$('#form-update-status').attr('action', 'perbaikan-alat/'+id+'/update-status');

					if(status == 0){
						$('#label_tanggal').html('Tanggal Identifikasi');
						$('#label_jam').html('Jam Identifikasi');
					}else if(status == 1){
						$('#label_tanggal').html('Tanggal Service');
						$('#label_jam').parent().hide();
					}else if(status == 2){
						$('#label_tanggal').html('Tanggal Selesai');
						$('#label_jam').parent().hide();
					}

					$('#loading-update-status').addClass('d-none');
					$('#content-update-status').removeClass('d-none');
				}
	        });
	    });

		$(document).ready( function () {
		    var tgl_laporan_start = $("#tgl_laporan_start").val();
			var tgl_laporan_end = $("#tgl_laporan_end").val();

			$('#table').DataTable({
				processing:true,
				searching: false,
				ordering: false,
				lengthChange: false,
				autoWidth: false,
		        serverSide: true,
			    ajax: {
			    	dataSrc: "data",
			        url  : API_URL+'/harmat/perbaikan-alat/getDataTable',
			        type :'GET',
			        data :{
			        	tgl_laporan_start : tgl_laporan_start,
			        	tgl_laporan_end : tgl_laporan_end
			        }

			    },
			    language: {
	              	processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
	          	},
			    columns: [
			    	{ data: 'DT_Row_Index' },
			        { data: 'nama_alat' },
			        { data: 'asal_ruangan' },
			        { data: 'tgl_laporan' },
			        { data: 'tgl_identifikasi' },
			        { data: 'tgl_mulai' },
			        { data: 'tgl_selesai' },
			        { data: 'statusnya' },
			        { data: 'alasan' },
			        { data: 'aksi' }
			    ]
			});

			$('.js-datepicker').on('changeDate', function(ev){
			    $(this).datepicker('hide');
			});
		});
	</script>
@endsection
