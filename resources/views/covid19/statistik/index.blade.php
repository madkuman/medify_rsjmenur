@extends('covid19.layouts.main')
@section('title')
	COVID-19
@endsection

@section('content')
	<div class="container pt-30">
		<div class="row justify-content-center">
			<div class="col-3 col-md-2 text-center p-5">
				<button type="button" class="btn-alt btn-secondary btn-block btn-date btn-date-hari" data-date="hari">Hari</button>
			</div>
			<div class="col-3 col-md-2 text-center p-5">
				<button type="button" class="btn-alt btn-secondary btn-block btn-date btn-date-bulan"  data-date="bulan">Bulan</button>
			</div>
			<div class="col-3 col-md-2 text-center p-5">
				<button type="button" class="btn-alt btn-primary btn-block btn-date btn-date-all" data-date="all">Semua</button>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center pt-20">
				<h4>Rekap Kasus COVID-19 <span class="text-title">Keseluruhan</span></h4>
				<h6>Data Update Pada : <span class="number-last_update"></span></h6>
			</div>
		</div>
		<div class="d-none d-md-inline">
			@include('covid19.statistik.components-index.desktop')
		</div>
		<div class="d-md-none">
			@include('covid19.statistik.components-index.mobile')
		</div>
	</div>

@endsection


@section('css')
	<style type="text/css">
		p{
			margin:0!important;
		}
	</style>
@endsection

@section('js')
	<script type="text/javascript">
		$('.btn-date').click(function(){

			var value = $(this).data('date')

			var y = ['hari','bulan','all']
			var removeItem = value;
			updateData(value)

			y = jQuery.grep(y, function(value) {
				return value != removeItem;
			});


			$(".btn-date").removeClass("btn-primary");
			$(".btn-date").removeClass("btn-secondary");
			$(".btn-date-"+value).addClass("btn-primary");

			$.each(y, function( index, value ) {
				$(".btn-date-"+value).addClass("btn-secondary");
			});

			if(value == 'all') $('.text-title').text('Keseluruhan')
			else if(value == 'hari') $('.text-title').text('Hari Ini')
			else if(value == 'bulan') $('.text-title').text('Bulan Ini')


		})


		function updateData(date)
		{
			Codebase.blocks('.block', 'state_toggle');
			$.ajax({
				url: API_URL + '/covid19/get-data?durasi='+ date,
				type: 'GET',
				dataType: 'json',
				success: function(data) {
					Codebase.blocks('.block', 'state_toggle');

					$.each(data, function( index, value ) {
						$('.number-'+index).text(value);
					});


				},
				error: function() {
					Codebase.blocks('.block', 'state_toggle');
				},
			});
		}

		updateData('all')
	</script>
@endsection