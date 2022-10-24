@extends('rawatjalan.layouts.main')

@section('title')
Histori Transaksi - Rawat Jalan - Medify
@endsection


@section('subtitle')
Histori Transaksi
@endsection

@section('content')
<main id="main-container">
    @include('rawatjalan.layouts.navbar')
	<div class="content">
		<div class="text-center pb-30">
			<h4>Histori Transaksi Poliklinik</h4>
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
										<label class="control-label">Poliklinik</label>
										<select name="poli_id" class="form-control js-select2" data-size="5" id="selectPoli">
											<option value="9999">Semua Poli</option>
											@foreach($poli as $item)
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
							<div class="col-lg-9 col-sm-12 pt-20 pb-20">
								<h5 id="content-date">Thursday, 22 Maret 2018</h5>

								<div class="form-group">
									<input type="text" id="myInput" class=" form-control" placeholder="Cari Pasien">
								</div>

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

	function loadData()
	{
		var id= current_ruang;
		var date= current_date; 
		var poli_id = $('#selectPoli').val();
		$('.spinner').fadeIn();

		$.ajax
		({
			url: API_URL + '/rawatjalan/transaksi/get?date='+date+'&poli_id='+poli_id,
			method: "GET",
			datatype:"json",
			success: function(response) 
			{
				var content = '';
				var count =0;
				$.each(JSON.parse(response), function(idx, elem){
					
					content += '<div class="block toSearch">'
					content += '<div class="block-content pb-20"><div class="row p-0 m-0">'
					content += '<div class="col-md-1 text-center h-200 d-flex align-self-center"><h6 class="mb-0">'
					content += ++count
					content += '</h6></div>'
					content += '<div class="col-md-3 h-200 d-flex align-self-center"><h6 class="mb-0"><small>'+elem.poliklinik.name+'</small><br>'
					content += elem.pasien_detail.name
					content += '<br><small class="font-w400">No.RM: ' + elem.pasien_detail.no_rm + '</small>'
					content += '<br><small class="font-w400">' + elem.pasien_detail.jenis_kelamin + ', ' + elem.pasien_detail.age + ' tahun </small>'
					if (elem.nomor_sep) {
						content += '<br><div class="badge badge-success" style="white-space:normal">BPJS</div>'
					}
					content+= '</h6></div>'
					content +=  '<div class="col-md-3 h-200 d-flex align-self-center"><h6 class="mb-0"><small class="font-w400">Waktu Pendaftaran</small><br>'
					content += elem.created_at_format
					content += '</h6></div>'
					content +=  '<div class="col-md-3 h-200 d-flex align-self-center">'
					content += '<a class="mb-5" href="{{url("rawatjalan/transaksi/pendaftaran")}}/' + elem.id + '"><span class="fa fa-file"></span> Print Dokumen</a>'
					content += '</div>'
					content += '<div class="col-md-2 h-200 d-flex align-self-center">'
					content += '<form method="POST" action="{{url("rawatjalan/transaksi/layani")}}">{{csrf_field()}}<input type="hidden" value="'+elem.id+'" name="transaksi_id">'
					if(elem.status > 0)
					{
						content+= '<button class="btn btn-alt-success mb-10" type="submit">Lihat Hasil</button>'
					}
					else
					{
						content+= '<button class="btn btn-primary mb-10" type="submit">Layani Pasien</button>'
					}
					content += '</form></div></div>'
					content += '<div class="row"><div class="col-lg-12 text-right full-only"> Dibuat Oleh : '+elem.creator_name+'</div></div>'
					content += '<div class="row p-0 m-0"><div class="col-lg-12 mobile-block"> Dibuat Oleh : '+elem.creator_name+'</div></div>'
					content += '</div></div>'
				

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

	$('input[type="text"]').keyup(function(){

	var that = this, $allListElements = $('.toSearch');
	$(".panel").toggle(true);
	var $matchingListElements = $allListElements.filter(function(i, li){
		var listItemText = $(li).text().toUpperCase(), 
		searchText = that.value.toUpperCase();
		return ~listItemText.indexOf(searchText);
	});

	$allListElements.hide();
	$matchingListElements.show();

});

</script>
@endsection
