<script type="text/javascript">

	$('#input-cpo-display1drug-select-obat').change(function(){
		getDataDisplay1Drug();
	})

	function getDataDisplay1Drug()
	{
		var loading_random = Math.floor(Math.random() * (50 - 10 + 1)) + 10;

		updateProgressBar('kasus-farmasi-rpo-display-1drug',loading_random)
		$('#input-cpo-display1drug-select-obat').prop('readonly', true);
		var cpo_id = $('#input-cpo-display1drug-select-obat').val();
		$.ajax({
			url: BASE_URL + 'api/kasus/farmasi/pengobatan-pasien/get-per-obat',
			type: 'GET',
			data: {
				kasus_id : {{$kasus->id}},
				cpo_id : cpo_id,
			},
			dataType: 'json',
			success: function(response) {
				resetDataDisplay3Drug()
				updateProgressBar('kasus-farmasi-rpo-display-1drug',100)
				if(response.status == 200)
				{
					var new_date_pemberian_pertama = moment(response.rpo_pemberian_first).lang("id").format('DD MMMM YYYY');
					var new_date_pemberian_terakhir = moment(response.rpo_pemberian_latest).lang("id").format('DD MMMM YYYY');

					$('#kasus-farmasi-rpo-display-1drug-pemberian-pertama').html(new_date_pemberian_pertama)
					$('#kasus-farmasi-rpo-display-1drug-pemberian-terakhir').html(new_date_pemberian_terakhir)
					$('#kasus-farmasi-rpo-display-1drug-total-konsumsi').html(response.rpo_total)

					$.each(response.date_list, function(key, data) {
						if(key%2 == 0) var background = 'style="background: #f1f1f1;"'
						else var background = ''

							var new_class =  moment(data).format('YYYYMMDD');
						var new_date = moment(data).lang("id").format('DD MMM');

						var content = `<div class="row p-5 kasus-farmasi-rpo-display-1drug-`+new_class+`" `+background+`>
						<div class="col-6">`+new_date+`</div> 
						<div class="col-6">
						<span class="kasus-farmasi-rpo-display-1drug-pemakaian-waktu" style="display:none"></span>
						<span class="kasus-farmasi-rpo-display-1drug-pemakaian-jam" style="display:none"></span>
						</div>
						</div>`

						$('#kasus-farmasi-rpo-display-1drug-container-pemakaian').append(content)

					})

					$.each(response.rpo_items, function(key, data) {

						var new_class =  moment(data.pemberian_at).format('YYYYMMDD');

						var content_waktu = '<a href="javascript:void(0)" data-method="edit" data-id="'+data.id+'" class="badge badge-'+data.status_warna+' isiPemberianObatBtn">'+data.pemberian_at_waktu_short+'</a> '

						$('.kasus-farmasi-rpo-display-1drug-'+new_class+' .kasus-farmasi-rpo-display-1drug-pemakaian-waktu').append(content_waktu)

						var content_jam = '<a href="javascript:void(0)" data-method="edit" data-id="'+data.id+'" class="badge badge-'+data.status_warna+' isiPemberianObatBtn">'+data.pemberian_at_jam+'</a> '

						$('.kasus-farmasi-rpo-display-1drug-'+new_class+' .kasus-farmasi-rpo-display-1drug-pemakaian-jam').append(content_jam)

					})
					getFilterContentDisplay1Drug();

						
				}
			},
			error: function() {
			},
		});
	}

	function getFilterContentDisplay1Drug()
	{
		var varshort = varshort_1day
		var time_display = $('#input-cpo-display-1drug-time-display').val();

		$('#kasus-farmasi-rpo-display-1drug .kasus-farmasi-rpo-display-1drug-pemakaian-waktu').hide()
		$('#kasus-farmasi-rpo-display-1drug .kasus-farmasi-rpo-display-1drug-pemakaian-jam').hide()

		if(time_display == 'jam') {
			$('#kasus-farmasi-rpo-display-1drug .kasus-farmasi-rpo-display-1drug-pemakaian-jam').show()
		}
		else {
			$('#kasus-farmasi-rpo-display-1drug .kasus-farmasi-rpo-display-1drug-pemakaian-waktu').show()
		}

		return 1;
	}


	$('#input-cpo-display-1drug-time-display').change(function(){
		getFilterContentDisplay1Drug();
	})

	function resetDataDisplay3Drug()
	{

		$('#kasus-farmasi-rpo-display-1drug-pemberian-pertama').html('')
		$('#kasus-farmasi-rpo-display-1drug-pemberian-terakhir').html('')
		$('#kasus-farmasi-rpo-display-1drug-total-konsumsi').html('')
		$('#kasus-farmasi-rpo-display-1drug-container-pemakaian').html('')
	}

</script>


