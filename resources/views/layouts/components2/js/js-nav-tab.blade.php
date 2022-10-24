<script type="text/javascript">
	$(".nav-tabs").find("li a").last().click();

	var url = document.URL;
	var hash = url.substring(url.indexOf('#'));

	$(".main-tab").find("li a").each(function(key, val) {

		if (hash == $(val).attr('href')) {
			$(val).click();
		}
		$(val).click(function(ky, vl) {
			console.log($(this).attr('href')+"1");
			location.hash = $(this).attr('href');
		});

	});

	window.onhashchange = locationchange;

	function locationchange()
	{   
		var lokasi = location.hash;
		var satuan = lokasi.split("");
		satuan.splice(0,1);
		var hash_baru = satuan.join("");
		console.log(lokasi)
		console.log(hash_baru)
		if(lokasi === '')
		{
			$('.tab-pane').removeClass('show active');
			$('.nav-link').removeClass('active');
			$('.tab-default-content').addClass('show active');
			$('.tab-default-nav').addClass('active');    
		}
		else
		{
			$('.tab-pane').removeClass('show active');
			$('.nav-link').removeClass('active');
			$('.'+hash_baru+'-content').addClass('show active');
			$('.'+hash_baru+'-nav').addClass('active');    
		}
	}

	$(document).ready(function() {
		locationchange();
	});
</script>