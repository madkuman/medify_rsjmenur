@extends('rawatjalan.layouts.main')

@section('title')
Histori Transaksi - Rawat Jalan - Medify
@endsection

@section('content')
<main id="main-container">
    @include('igd.layouts.navbar')
	<div class="content">
		<div class="text-center pb-50 pt-20">
			<h4>Histori Transaksi IGD</h4>
		</div>
		<div id="ruangSelection">
			
				<div class="block">
					<div class="block-header">
						<h3 class="block-title">Histori Transaksi</h3>
					</div>
					<div class="block-content py-0 px-0">
						<div class="row">
							<div class="col-3">
								<div class="content">

									<div class="form-group">
										<label class="control-label">Ruangan IGD</label>
										<select name="ruang_id" class="form-control js-select2" data-size="5" id="selectRuang">
											<option value="9999">Semua Ruangan IGD</option>
											@foreach($ruangan as $item)
											<option value="{{$item->id}}">{{$item->name}}</option>
											@endforeach
										</select>
									</div>


									<div class="form-group row">
										<label class="col-12">Pilih Tanggal</label>
										<div class="col-12">
											<div class="js-datepicker" id="date-picker-histori" data-week-start="1" data-today-highlight="true"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-8 pt-20 pb-20">
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
</main>

@endsection

@section('js')
<script>

	$('#selectRuang').select2();

	new_date = moment().format('dddd, DD MMMM YYYY');
	today = moment().format('YYYY-MM-DD');
	$('#content-date').text(new_date);
	var current_ruang = 0;
	var current_date = today;

	function loadData()
	{
		var id= current_ruang;
		var date= current_date; 
		var ruang_id = $('#selectRuang').val();
		$('.spinner').fadeIn();

		$.ajax
		({
			url: API_URL + '/igd/transaksi/get?date='+date+'&ruang_id='+ruang_id,
			method: "GET",
			datatype:"json",
			success: function(response) 
			{
				//console.log(response);
				var item = JSON.parse(response)
				var content = '';
				var count =item.length;
				if (ruang_id = 9999)
				{
					$.each(item, function(idx, elem){
						
						content += '<div class="block">'
						content +='<div class="block-content pb-20"><div class="row p-0 m-0 gutters-tiny">'
						

						content+= '<div class="col-1 text-center h-100 d-flex align-self-center"><h3 class="mb-0">'
						content += count--
						content += '</h3></div>'
						content += '<div class="col-1 text-center h-100 d-flex align-self-center "><h3 class="mb-0">'
						content += elem.ruangan.name
						content +=  '</h3></div>'

						content += '<div class="col-4 h-100 d-flex align-self-center"><h4 class="mb-0">'
						content += elem.pasien_detail.name
						content += '<br><small class="font-w400"><strong>#' + elem.pasien_detail.no_rm_formatted + '</strong></small>'
						content += '<br><small class="font-w400">' + elem.pasien_detail.jenis_kelamin + ', ' + elem.pasien_detail.age + ' tahun </small></h4></div><div class="col-1 h-100 d-flex align-self-center text-center"><div class="badge badge-success" style="white-space:normal">'
						content += elem.kasus.pembayaran.perusahaan.tipe.nama+'</div></div>'
						content +=  '<div class="col-3 h-100 d-flex align-self-center"><h5 class="mb-0"><small class="font-w400">Waktu Pendaftaran</small><br>'
						content += elem.created_at_format
						content += '</h5></div><div class="col-2 h-100 d-flex align-self-center">'
						content += '<a href="{{url('')}}/kasus/'+elem.kasus.nomor_kasus+'/datamedis" class="btn btn-primary" type="submit">Lihat Kasus</a>'
						content += '</div></div></div></div>'

					});

				}
				else{
					$.each(JSON.parse(response), function(idx, elem){
						
						content += '<div class="block">'
						content +='<div class="block-content pb-20"><div class="row p-0 m-0 gutters-tiny">'


						content+= '<div class="col-1 text-center h-100 d-flex align-self-center"><h3 class="mb-0">'
						content += ++count
						content += '</h3></div>'

						content += '<div class="col-1 p-0 ">'
						content += ' <img class="img-avatar" src="{{asset('')}}/'+elem.pasien_detail.photo_thumb+'">'
						content +=  '</div>'

						content += '<div class="col-4 h-100 d-flex align-self-center"><h4 class="mb-0">'
						content += elem.pasien_detail.name
						content += '<br><small class="font-w400"><strong>#' + elem.pasien_detail.no_rm_formatted + '</strong></small>'
						content += '<br><small class="font-w400">' + elem.pasien_detail.jenis_kelamin + ', ' + elem.pasien_detail.age + ' tahun </small></h4></div><div class="col-1 h-100 d-flex align-self-center text-center"><div class="badge badge-success" style="white-space:normal">'
						content += elem.kasus.pembayaran.perusahaan.tipe.nama+'</div></div>'
						content +=  '<div class="col-3 h-100 d-flex align-self-center"><h5 class="mb-0"><small class="font-w400">Waktu Pendaftaran</small><br>'
						content += elem.created_at_format
						content += '</h5></div><div class="col-2 h-100 d-flex align-self-center">'
						content += '<a href="{{url('')}}/kasus/'+elem.kasus.nomor_kasus+'/datamedis" class="btn btn-primary" type="submit">Lihat Kasus</a>'
						content += '</div></div></div></div>'

					});
				}
				if(item.length == 0)
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
		$('#selectRuang').on("select2:select", function(e) { 
			id = $('#selectRuang').val()
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
