<script type="text/javascript">
	var currentShowPaket = 0;

	function previewPaketSubscribe(id)
	{
		$('#loading-subscribe-paket-obat').show();
		$('#paket-obat-result-container').hide();
		$('#error-subscribe-paket-obat').hide();
		$('#success-subscribe-paket-obat').hide();
		$('#warning-subscribe-paket-obat').hide();
		$('#paket-obat-nama').text('');
		$.ajax({
			url: API_URL + '/paket-obat/get/'+ id,
			type: 'GET',
			dataType: 'json',
			tryCount : 0,
			retryLimit : 1,
			success: function(data) {
				$('#paket-obat-result').empty();
				details = data.detail
				$('#paket-obat-nama').text(data.nama);
				$.each(details, function(i) {
					 if(details[i].kategori == 'generik')
                        		var nama_obat = details[i].item_detail.nama
                    	else
                        		var nama_obat = ''

	                    var type = details[i].type
	                    var obat_string = nama_obat
	                    var racikan = details[i].racikan
	                    var jumlah = details[i].jumlah
	                    var aturan = details[i].aturan
	                    if(nama_obat == null) nama_obat = ''
	                    if(racikan == null) racikan = ''

					content = '<div class="col-12 resep-item-container">'
					content += '<div class="border p-15">'
					content += '<span class="font-w400 text-muted" id="display-kategori-tipe-obat">'+type+'</span>'
					content += '<p class="font-w600 mb-5" id="display-nama-obat" style="white-space: pre;">'+obat_string+racikan+'</p>'
					content += '<span class="font-w400" id="display-jumlah-aturan-obat">Jumlah : '+jumlah+' - Aturan : ' + aturan + '</span>'
					content += '</div>'
					content += '</div>'

        				$('#paket-obat-result').append(content);
				});

				$('#paket-obat-result-container').show();
				if(data.is_subscribe == 0){
					$('#btn-subscribe-paket-obat').show();
					$('#btn-subscribe-paket-obat-loading').hide();
					$('#btn-subscribe-paket-obat-success').hide();
				}
				else{
					$('#btn-subscribe-paket-obat').hide();
					$('#btn-subscribe-paket-obat-loading').hide();
					$('#btn-subscribe-paket-obat-success').show();
				}


				$('#loading-subscribe-paket-obat').hide();
				currentShowPaket = id
			},
			error: function() {
				this.tryCount++;
				if (this.tryCount <= this.retryLimit) {

					$.ajax(this);
					return;
				}else{
					$('#error-subscribe-paket-obat').show();
					$('#loading-subscribe-paket-obat').hide();
				}  
			},
		});
	}

	$('#btn-subscribe-paket-obat').click(function(){

		$('#error-subscribe-paket-obat').hide();
		$('#btn-subscribe-paket-obat').hide();
		$('#btn-subscribe-paket-obat-loading').show();
		$('#success-subscribe-paket-obat').hide();
		$('#warning-subscribe-paket-obat').hide();

		$.ajax({
			url: API_URL + '/paket-obat/subscribe/'+ currentShowPaket,
			type: 'GET',
			dataType: 'json',
			tryCount : 0,
			retryLimit : 1,
			success: function(data) {
				$('#btn-subscribe-paket-obat-loading').hide();
				$('#btn-subscribe-paket-obat-success').show();
				if(data.status == 1){
					$('#success-subscribe-paket-obat').show();
					$('#success-subscribe-paket-obat span').text(data.message);
				}
				else
				{
					$('#warning-subscribe-paket-obat').show();
					$('#warning-subscribe-paket-obat span').text(data.message);
				}
				var subscribed_span = '<span class="badge badge-success">Subscribed</span>'
				$('#daftar-paket #paket-obat-'+currentShowPaket+ ' .item-paket').append(subscribed_span)
			},
			error: function() {
				this.tryCount++;
				if (this.tryCount <= this.retryLimit) {

					$.ajax(this);
					return;
				}else{
					$('#error-subscribe-paket-obat').show();
					$('#btn-subscribe-paket-obat').show();
					$('#btn-subscribe-paket-obat-loading').hide();
				}  
			},
		});
	})

</script>


<script src="{{asset('assets/js/plugins/listjs/list.min.js')}}"></script>
<script type="text/javascript">
	function initSearch()
	{
		var options = {
			valueNames: [ 'item-paket' ]
		};

		var paketObatList = new List('daftar-paket', options);

		$("#search-paket-obat").keyup(function(){
			paketObatList.search($(this).val());
		});
	}
	initSearch();


    $('#modal-subscribe-resep').on('hide.bs.modal', function(){
        location.reload();
    });
</script>