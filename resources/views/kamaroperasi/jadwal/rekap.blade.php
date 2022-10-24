@extends('layouts.main2')

@section('title')
Ruangan - Kamar Operasi - Medify
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('kamaroperasi.components.navbar2')
		<div class="row"  id="ruangSelection">
			@php $index = 0 @endphp
			<div class="col-12">
				<div class="block block-themed">
					<div class="block-header bg-success">
						<h3 class="block-title">Rekap Jadwal</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option">
								<i class="si si-wrench"></i>
							</button>
						</div>
					</div>
					<div class="block-content py-0 px-0">
						<div class="row">
							<div class="col-3">
								<div class="content">
									<div class="form-group row">
										<label class="col-12">Pilih Tanggal</label>
										<div class="col-12">
											<div class="js-datepicker" data-week-start="1" data-today-highlight="true"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-8 pt-20 pb-20">
									<span class="h5" id="content-date">Thursday, 22 Maret 2018</span>
									<div class="mt-10 spinner-container">
										<div class="spinner-back">
											<table class="table table-striped table-hover  "> 
												<thead>
													<tr class="header" ng-click="getCurrentPage()">
														<th style="width:5%">Ruangan</th>
														<th style="width:5%">Ronde</th>
														<th style="width:25%">Nama Pasien</th>
														<th style="width:5%">Usia</th>
														<th style="width:10%">No RM</th>
														<th style="width:20%">Kasus</th>
														<th style="width:20%">Dokter</th>
													</tr>
												</thead>
												<tbody  id="table-content">
												</tbody>
											</table>
											

										</div>
										<div class="spinner">
											<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	@endsection

	@section('js')
	<script>

		new_date = moment().format('dddd, DD MMMM YYYY');
		today = moment().format('YYYY-MM-DD');
		$('#content-date').text(new_date);
		var current_ruang = 0;
		var current_date = today;

		function loadData()
		{
			var id= current_ruang;
			var date= current_date; 

			$('.spinner').fadeIn();

			$.ajax
			({
				url: '{{url('/ajax/kamaroperasi/jadwal/rekap/')}}?date='+date,
				method: "GET",
				datatype:"json",
				success: function(response) 
				{
					console.log(response);
					var content = '';
					var count =0;
					$.each(JSON.parse(response), function(idx, elem){
						console.log(elem);
						content += '<tr class="" onclick="goToHref("{{url()->current()}}/'+ id+ '")">';
						content += "<td>"+elem.ruangan.name+"</td>"
						content += "<td>"+elem.nomor_ronde+"</td>"
						content += "<td>"+elem.pasien_detail.name+"</td>"
						content += "<td>"+elem.pasien_detail.age+"</td>"
						content += "<td>"+elem.pasien_detail.id+"</td>"
						if(elem.kasus_id != null)
						{
							content += "<td>"+elem.kasus.judul_kasus+"</td>"	
						}
						else
						content+= "<td>-</td>"					
						content += "<td>"+elem.dokter.name+"</td>"
						content += "</tr>"
						count++;

					});
					if(count == 0)
					{
						content += '<div class="spinner"><h5>Jadwal Operasi Kosong</h5></div>';
					}
					$('.spinner').fadeOut();
					$('#table-content').html(content);
					$('#table-content').fadeIn();
				}
			});


		}

		function loadMustache(template) {
			Mustache.parse(template, customTags);
			Mustache.tags = customTags;
		}


		loadData();
	</script>

	<script>

		function showRuang()
		{
			$('#ruangSelection').fadeIn();
			$('#jadwalContent').fadeOut();
		}

		function ruangSelect(ruang_id,name)
		{
			$('#content-title').text(name);

			var date= $('#tanggal').val();
			$('#ruangSelection').fadeOut();
			current_ruang = ruang_id;
			loadData();

			$('#jadwalContent').fadeIn();
		}

		$('.js-datepicker').on('changeDate', function() {
			var formatted_date = $('.js-datepicker').datepicker('getFormattedDate');
			current_date = moment(formatted_date).format('YYYY-MM-DD');
			console.log(current_date);


			new_date = moment(formatted_date).format('dddd, DD MMMM YYYY');
			loadData();
			$('#content-date').text(new_date);
		});

	</script>
	@endsection
