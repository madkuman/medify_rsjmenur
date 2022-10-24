@extends('rawatinap.layouts.main')

@section('title')
Histori Transaksi - Rawat Inap
@endsection

@section('content')
<main id="main-container">
    @include('rawatinap.layouts.navbar')
	<div class="content">
		<div class="text-center py-50">
			<h4>Histori Transaksi Rawat Inap</h4>
		</div>
		<div class="row"  id="ruangSelection">
			@php $index = 0 @endphp
			<div class="col-12">
				<div class="block">
					<div class="block-header">
						<h3 class="block-title">Histori Transaksi</h3>
					</div>
					<div class="block-content py-0 px-0">
						<div class="row mx-0">
							<div class="col-lg-3 col-sm-12">
								<div class="content px-0">

									<div class="form-group">
										<label class="control-label">Bangsal</label>
										<select name="poli_id" class="form-control js-select2" data-size="5" id="selectPoli" style="width: 100%">
											<option value="0">Semua Bangsal</option>
											@foreach($bangsal as $item)
											<option value="{{$item->id}}">{{$item->nama}}</option>
											@endforeach
										</select>
									</div>


									<div class="form-group row">
										<label class="col-12">Pilih Tanggal</label>
										<div class="col-12">
											<div class="js-datepicker" id="date-picker-histori" data-week-start="1" data-today-highlight="true"></div>
										</div>
									</div>

									<div class="form-group text-center">
										<div class="custom-control-inline custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" name="masuk" id="masuk" value="1" checked="">
											<label class="custom-control-label" for="masuk">Masuk</label>
										</div>
										
										<div class="custom-control-inline custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" name="keluar" id="keluar" value="1" checked="">
											<label class="custom-control-label" for="keluar">Keluar</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-8 col-sm-12 pt-20 pb-20">
								<span class="h5" id="content-date">Thursday, 22 Maret 2018</span>

								<div class="mt-10 spinner-container">
									<div class="spinner-back">
										<div id="transaksi-content">
										</div>
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

	$('#selectPoli').select2();

	new_date = moment().format('dddd, DD MMMM YYYY');
	today = moment().format('YYYY-MM-DD');
	$('#content-date').text(new_date);
	var current_ruang = 0;
	var current_date = today;
	var reqLoadData = null;


	$('input[type=checkbox][name=masuk]').change(function() {
		loadData();
	});

	$('input[type=checkbox][name=keluar]').change(function() {
		loadData();
	});


	function loadData()
	{
		var id= current_ruang;
		var date= current_date; 
		var bangsal_id = $('#selectPoli').val();
		$('.spinner').fadeIn();
		var keluar =  $('#keluar')[0].checked ? 1 : 0;
		var masuk =  $('#masuk')[0].checked ? 1 : 0;
		var url = '/rawatinap/transaksi/get?date='+date+'&bangsal_id='+bangsal_id+'&masuk='+masuk+'&keluar='+keluar;
		console.log(url);
		reqLoadData = null;
		reqLoadData = $.ajax({
			url: API_URL + url,
			method: "GET",
			datatype:"json",
	        cache: false,
	        contentType: false,
	        processData: false,
			success: function(response) 
			{
				var content = '';
				var count =0;
				$.each(JSON.parse(response), function(idx, elem){
					
					content += '<div class="block">'
					content +='<div class="block-content pb-20"><div class="row p-0 m-0">'


					content+= '<div class="col-md-1 text-center h-100 d-flex align-self-center"><h3 class="mb-0">'
					content += ++count;
					content += '</h3></div>'

					content += '<div class="col-md-4 h-100 d-flex align-self-center"><h4 class="mb-0">'
					content += elem.pasien.name
					content += '<br><small class="font-w400">#' + elem.pasien.no_rm + ' </small>'
					content += '<br><small class="font-w400">' + elem.pasien.jenis_kelamin + ', ' + elem.pasien.age + ' tahun </small></h4></div>'
					content +=  '<div class="col-md-3 h-100 d-flex align-self-center"><h5 class="mb-0"><small class="font-w400">Waktu Masuk RS</small><br>'
					content += elem.masuk_rs_at_format
					content += '<br>'
					content +=  '<small class="font-w400">Waktu Keluar RS</small><br>'
					content += elem.keluar_rs_format
					content += '</h5></div><div class="col-md-3 h-100 d-flex align-self-center">'

					if(elem.kasus_id != 0)
					{
						content+= '<a href="{{url("rawatinap/transaksi/pendaftaran/print-final/")}}/'+elem.id+'" class="btn btn-primary">Lihat Detail</a>'
					}
					else
					{
						content+= '<a href="{{url("rawatinap/transaksi/pendaftaran/print-final/")}}/'+elem.id+'" class="btn btn-primary">Lihat Detail</a>'
					}
					content += '</div></div></div></div>'

				});
				if(count == 0)
				{
					content += '<div class="spinner"><h5>Tidak terdapat transaksi</h5></div>';
				}
				$('.spinner').fadeOut();
				$('#transaksi-content').html(content);
				$('#transaksi-content').fadeIn();
			}
		});


	}


	loadData();
</script>

<script>

	$( document ).ready(function() {
		$('#selectPoli').on("select2:select", function(e) { 
			id = $('#selectPoli').val()
			console.log(id)
			loadData()
		});
	});


	$('#date-picker-histori').on('changeDate', function() {
		var formatted_date = $(this).datepicker('getFormattedDate');
		current_date = moment(formatted_date).format('YYYY-MM-DD');
		console.log(current_date);


		new_date = moment(formatted_date).format('dddd, DD MMMM YYYY');
		loadData();
		$('#content-date').text(new_date);
	});

</script>
@endsection
