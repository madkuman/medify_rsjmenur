<script type="text/javascript">

	var kasus_rpo_3d_total_data = {{count($pengobatan)}};
	var kasus_rpo_3d_maximum_per_fetch = 20;

	var varshort_3days = 'kasus-farmasi-rpo-display-3days';

	$(document).ready(function(){
		getDataDisplay3Days(0)
	})


	function getDataDisplay3Days(data_fetched)
	{
		$('#input-cpo-display3days-date-end').prop('readonly', true);
		$('#input-cpo-display3days-filter-obat').prop('disabled', true);
		$('#input-cpo-display3days-time-display').prop('disabled', true);

		var date_end = $('#input-cpo-display3days-date-end').val();

		$.ajax({
			url: BASE_URL + 'api/kasus/farmasi/pengobatan-pasien/get-content-days',
			type: 'GET',
			data: {
				kasus_id : {{$kasus->id}},
				date_end : date_end,
				date_count : 3,
				limit : kasus_rpo_3d_maximum_per_fetch,
				offset : data_fetched
			},
			dataType: 'json',
			success: function(response) {

				var varshort = varshort_3days;
				var index_3 = moment(date_end).format('YYYY-MM-DD')
				var index_2 = moment(date_end).subtract(1,'days').format('YYYY-MM-DD')
				var index_1 = moment(date_end).subtract(2,'days').format('YYYY-MM-DD')

				var display_3 = moment(date_end).format('DD MMM')
				var display_2 = moment(date_end).subtract(1,'days').format('DD MMM')
				var display_1 = moment(date_end).subtract(2,'days').format('DD MMM')

				$('#'+varshort+'-date-1').html(display_1)
				$('#'+varshort+'-date-2').html(display_2)
				$('#'+varshort+'-date-3').html(display_3)

				$.each(response, function(key, data) {
					console.log(response);
					var index_date = 0;
					var pemberian_at_tgl = moment(data.pemberian_at).format('YYYY-MM-DD')

					if(pemberian_at_tgl == index_1) var index_date = 1;
					else if(pemberian_at_tgl == index_2) var index_date = 2;
					else if(pemberian_at_tgl == index_3) var index_date = 3;
					var varshort_id = varshort+'-content-'+index_date+'-'+data.pemberian_at_waktu_short
					var varshort_cpo_id= varshort + '-' + data.catatan_pengobatan_pasien_id
					var variable_temp = '.'+varshort_cpo_id + ' .'+varshort_id+' .'+varshort;
					console.log(variable_temp);
					$(variable_temp+'-pemakaian-waktu').append('<a href="javascript:void(0)" data-method="edit" data-id="'+data.id+'" class="badge badge-'+data.status_warna+' isiPemberianObatBtn">'+data.pemberian_at_waktu_short+'</a> ');
					$(variable_temp+'-pemakaian-jam').append('<a href="javascript:void(0)" data-method="edit" data-id="'+data.id+'" class="badge badge-'+data.status_warna+' isiPemberianObatBtn">'+data.pemberian_at_jam+'</a> ');
					$('.'+varshort_cpo_id).removeClass('kasus-farmasi-rpo-data-konsumsi-empty')
					$('.'+varshort_cpo_id).addClass('kasus-farmasi-rpo-data-konsumsi-fill')

				})

				
				data_fetched += kasus_rpo_3d_maximum_per_fetch;
				percentage = Math.ceil(data_fetched/kasus_rpo_3d_total_data*100)
				updateProgressBar(varshort_3days,percentage)

				if(data_fetched < kasus_rpo_3d_total_data) {
					getDataDisplay3Days(data_fetched);
				}
				else{
					$('#input-cpo-display3days-date-end').prop('readonly', false);
					$('#input-cpo-display3days-filter-obat').prop('disabled', false);
					$('#input-cpo-display3days-time-display').prop('disabled', false);
					getFilterContentDisplay3Days()
				}

			},
			error: function() {
			},
		});
	}

	function resetDataDisplay3Days()
	{
		var varshort = varshort_3days
		$('.'+varshort+'-pemakaian-waktu').html('')
		$('.'+varshort+'-pemakaian-jam').html('')
		$('.'+varshort+'-container').removeClass('kasus-farmasi-rpo-data-konsumsi-empty')
		$('.'+varshort+'-container').removeClass('kasus-farmasi-rpo-data-konsumsi-fill')
		$('.'+varshort+'-container').addClass('kasus-farmasi-rpo-data-konsumsi-empty')

	}

	function getFilterContentDisplay3Days()
	{
		var varshort = varshort_3days
		var obat_filter = $('#input-cpo-display3days-filter-obat').val();
		var time_display = $('#input-cpo-display3days-time-display').val();

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

	$('#input-cpo-display3days-time-display').change(function(){
		getFilterContentDisplay3Days();
	})

	$('#input-cpo-display3days-filter-obat').change(function(){
		getFilterContentDisplay3Days();
	})

	$('#input-cpo-display3days-date-end').change(function(){
		changeDatedisplay3days()
	})

	function changeDatedisplay3days()
	{
    	var date = $('#input-cpo-display3days-date-end').val()
    	date_start = moment(date).subtract(2, 'days').format('YYYY-MM-DD');
		$('#input-cpo-display3days-date-start').val(date_start)

		resetDataDisplay3Days();
		getDataDisplay3Days(0);
		updateProgressBar(varshort_3days,0)
	}

    $('#button-cpo-display3days-yesterday').click(function(){
    	var date = $('#input-cpo-display3days-date-end').val()
    	date = moment(date).subtract(2, 'days').format('YYYY-MM-DD');
    	$('#input-cpo-display3days-date-end').val(date)
    	changeDatedisplay3days();
    })

    $('#button-cpo-display3days-tomorrow').click(function(){
    	var date = $('#input-cpo-display3days-date-end').val()
    	date = moment(date).add(2, 'days').format('YYYY-MM-DD');
    	$('#input-cpo-display3days-date-end').val(date)
    	changeDatedisplay3days();
    })


</script>