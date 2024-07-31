<script type="text/javascript">

	var kasus_rpo_1d_total_data = {{count($pengobatan)}};
	var kasus_rpo_1d_maximum_per_fetch = 25;

	var varshort_1day = 'kasus-farmasi-rpo-display-1day';

	$(document).ready(function(){
		getDataDisplay1Day(0)
	})


	function getDataDisplay1Day(data_fetched)
	{
		$('#input-cpo-display1day-date').prop('readonly', true);
		$('#button-cpo-display1day-tomorrow').prop('disabled', true);
		$('#button-cpo-display1day-yesterday').prop('disabled', true);
		var date = $('#input-cpo-display1day-date').val();

		$.ajax({
			url: BASE_URL + 'api/kasus/farmasi/pengobatan-pasien/get-content-1day',
			type: 'GET',
			data: {
				kasus_id : {{$kasus->id}},
				date : date,
				limit : kasus_rpo_1d_maximum_per_fetch,
				offset : data_fetched
			},
			dataType: 'json',
			success: function(response) {

				var varshort = varshort_1day

				$.each(response, function(key, data) {
					var varshort_id = varshort+'-'+data.catatan_pengobatan_pasien_id


					$('.'+varshort_id+' .'+varshort+'-pemakaian-waktu').append('<a href="javascript:void(0)" data-method="edit" data-id="'+data.id+'" class="badge badge-'+data.status_warna+' isiPemberianObatBtn">'+data.pemberian_at_waktu_short+'</a> ');
					$('.'+varshort_id+' .'+varshort+'-pemakaian-jam').append('<a href="javascript:void(0)" data-method="edit" data-id="'+data.id+'" class="badge badge-'+data.status_warna+' isiPemberianObatBtn">'+data.pemberian_at_jam+'</a> ');
					$('.'+varshort_id).removeClass('kasus-farmasi-rpo-data-konsumsi-empty')
					$('.'+varshort_id).addClass('kasus-farmasi-rpo-data-konsumsi-fill')

				})


				data_fetched += kasus_rpo_1d_maximum_per_fetch;
				percentage = Math.ceil(data_fetched/kasus_rpo_1d_total_data*100)
				updateProgressBar(varshort_1day,percentage)

				if(data_fetched < kasus_rpo_1d_total_data) {
					getDataDisplay1Day(data_fetched);
				}
				else{
					$('#input-cpo-display1day-date').prop('readonly', false);
					$('#button-cpo-display1day-tomorrow').prop('disabled', false);
					$('#button-cpo-display1day-yesterday').prop('disabled', false);
					getFilterContentDisplay1Day()
				}

			},
			error: function() {
			},
		});
	}

	

	function resetDataDisplay1Day()
	{
		var varshort = varshort_1day
		$('.'+varshort+'-pemakaian-waktu').html('')
		$('.'+varshort+'-pemakaian-jam').html('')
		$('.'+varshort+'-container').removeClass('kasus-farmasi-rpo-data-konsumsi-empty')
		$('.'+varshort+'-container').removeClass('kasus-farmasi-rpo-data-konsumsi-fill')
		$('.'+varshort+'-container').addClass('kasus-farmasi-rpo-data-konsumsi-empty')

	}

	function getFilterContentDisplay1Day()
	{
		var varshort = varshort_1day
		var obat_filter = $('#input-cpo-display1day-filter-obat').val();
		var time_display = $('#input-cpo-display1day-time-display').val();

		$('#'+varshort+' .'+varshort+'-pemakaian-waktu').hide()
		$('#'+varshort+' .'+varshort+'-pemakaian-jam').hide()

		if(time_display == 'jam') {
			$('#'+varshort+' .'+varshort+'-pemakaian-jam').show()
		}
		else {
			$('#'+varshort+' .'+varshort+'-pemakaian-waktu').show()
		}

		$('#'+varshort+' .kasus-farmasi-rpo-data-konsumsi-empty').show()
		$('#'+varshort+' .kasus-farmasi-rpo-data-konsumsi-fill').show()

		if(obat_filter == 1) {
			$('#'+varshort+' .kasus-farmasi-rpo-data-konsumsi-empty').hide()
		}
		else if(obat_filter == 0) {
			$('#'+varshort+' .kasus-farmasi-rpo-data-konsumsi-fill').hide()
		}


		return 1;
	}

	$('#input-cpo-display1day-time-display').change(function(){
		getFilterContentDisplay1Day();
	})

	$('#input-cpo-display1day-filter-obat').change(function(){
		getFilterContentDisplay1Day();
	})

	$('#input-cpo-display1day-date').change(function(){
		changeDateDisplay1Day()
	})

	function changeDateDisplay1Day()
	{
		resetDataDisplay1Day();
		getDataDisplay1Day(0);
		updateProgressBar(varshort_1day,0)
	}

	function updateProgressBar(id_container,percentage)
    {
    	if(percentage < 100){
        	$('#'+id_container+ ' .progress-data-loader-loading .progress-bar').css("width",percentage+"%")
        	$('#'+id_container+ ' .progress-data-loader-loading .progress-bar-label').html(percentage+"%")
        	$('#'+id_container+ ' .progress-data-loader-loading').show()
    	}
    	else
    	{
        	$('#'+id_container+ ' .progress-data-loader-loading').hide()
    	}
    }

    $('#button-cpo-display1day-yesterday').click(function(){
    	var date = $('#input-cpo-display1day-date').val()
    	date = moment(date).subtract(1, 'days').format('YYYY-MM-DD');
    	$('#input-cpo-display1day-date').val(date)
    	changeDateDisplay1Day();
    })

    $('#button-cpo-display1day-tomorrow').click(function(){
    	var date = $('#input-cpo-display1day-date').val()
    	date = moment(date).add(1, 'days').format('YYYY-MM-DD');
    	$('#input-cpo-display1day-date').val(date)
    	changeDateDisplay1Day();
    })


</script>