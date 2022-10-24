@extends('harmat.layouts.main')

@section('title')
Harmat - Listrik Mati - Medify
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
			@include('harmat.listrik-mati.components.content')
		</div>
	</main>

	@include('harmat.listrik-mati.components.modal-create')
	@include('harmat.listrik-mati.components.modal-edit')
	@include('harmat.listrik-mati.components.modal-delete')
@endsection

@section('js')
	
	
	<script type="text/javascript">
		$(document).ready( function () {
			var mati_at_start = $("#mati_at_start").val();
			var mati_at_end = $("#mati_at_end").val();

			$('#table').DataTable({
				processing:true,
				searching: false,
				ordering: false,
				lengthChange: false,
				autoWidth: false,
			    serverSide: true,
			    ajax: {
			    	dataSrc: "data",
			        url  : API_URL+'/harmat/listrik-mati/getDataTable',
			        type :'GET',
			        data :{
			        	mati_at_start : mati_at_start,
			        	mati_at_end : mati_at_end
			        }

			    },
			    language: {
	              	processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
	          	},
			    columns: [
			    	{ data: 'DT_Row_Index' },
			        { data: 'tgl_mati_at' },
			        { data: 'jam_mati_at' },
			        { data: 'jam_nyala_at' },
			        { data: 'keterangan' },
			        { data: 'aksi' }
			    ]
			});
			$('.js-datepicker').on('changeDate', function(ev){
			    $(this).datepicker('hide');
			});
		});

		$('#btn-add').on('click', function(){
			$('#modal-create').modal('show');
		});

	    $('.js-select2').select2();

	    $('#table').on('click', '.btn-edit', function(){
	    	var id = $(this).attr('id_data');

			$('#form-edit').attr('action', '{{url('harmat')}}/listrik-mati/'+id+'/update');

			$.ajax({
				type:'GET',
				url : API_URL+'/harmat/listrik-mati/getEachJSON',
				data:{ id : id },
				beforeSend:function() {
					$('#loading').removeClass('d-none');
					$('#edit-content').addClass('d-none');
				},
				success:function(data){
					var mati_at  = data.mati_at;
					var nyala_at = data.nyala_at;

					mati_at  = mati_at.split(" ");
					nyala_at = nyala_at.split(" ");

					var tgl   = mati_at[0].split("-");
					var waktu = mati_at[1].split(":");

					var tahun   = tgl[0];
					var bulan   = tgl[1];
					var tanggal = parseInt(tgl[2]);

					var jam   = parseInt(waktu[0]);
					var menit = parseInt(waktu[1]);
					var detik = parseInt(waktu[2]);

					var waktu_nyala = nyala_at[1].split(":");

					var jam_nyala   = parseInt(waktu_nyala[0]);
					var menit_nyala = parseInt(waktu_nyala[1]);
					var detik_nyala = parseInt(waktu_nyala[2]);

					$('#edit_tahun_mati').val(tahun);
					$('#edit_bulan_mati').val(bulan);
					$('#edit_tanggal_mati').val(tanggal);
					$('#edit_jam_mati').val(jam);
					$('#edit_menit_mati').val(menit);
					$('#edit_detik_mati').val(detik);
					$('#edit_jam_nyala').val(jam_nyala);
					$('#edit_menit_nyala').val(menit_nyala);
					$('#edit_detik_nyala').val(detik_nyala);

					$('#edit_keterangan').text(data.keterangan);

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
			var id = $( this ).attr( 'id_data' );

			$('#form-delete').attr('action', '{{url('harmat')}}/listrik-mati/'+id+'/delete');
			$('#modal-delete').modal('show');
		});
	</script>
@endsection
