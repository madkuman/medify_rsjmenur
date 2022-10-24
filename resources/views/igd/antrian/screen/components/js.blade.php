<script type="text/javascript">
	fitTextAntrian1();

	var fullscreen = 0;
	$('#memanggil-antrian').hide();
	$('#nomor-antrian-1').hide();
	$('#poli-antrian-1').hide();
	$('#nomor-antrian-2').hide();
	$('#poli-antrian-2').hide();
	$('#nomor-antrian-3').hide();
	$('#poli-antrian-3').hide();
	$('#nomor-antrian-4').hide();
	$('#poli-antrian-4').hide();
	$('#nomor-antrian-5').hide();
	$('#poli-antrian-5').hide();

	var start = 0;

	var toggle = true;
	setInterval(function() {
		//jam
		var d = new Date().toLocaleTimeString('id-ID', { hour12: false, hour: 'numeric', minute: 'numeric' });
		var parts = d.split(".");
		$('#hours').text(parts[0]);
		$('#minutes').text(parts[1]);
		$("#colon").css({ visibility: toggle?"visible":"hidden"});
		toggle=!toggle;

		/*tanggal*/
		moment.locale('id'); 
		var today = moment(new Date()).format('dddd, DD MMMM YYYY');
		$('#tanggal').text(today);

	},1000);



	/*MENANDAKAN APAKAH KONTEN ANTRIAN SUDAH DIGUNAKAN*/
	var show = [0,0,0,0,0,0];

	/*
	fungsi untuk menyesuaikan ukuran huruf dengan kontainer
	karena ada nama poli yang panjang
	misal : poli hematologi onkologi

	dibuat dua macem logic, yaitu fullscreen dan non fullscreen karena hasilnya dan ukurannya emang beda
	*/
	function fitTextAntrian1()
	{
		$('.sub-header-1').css('font-size', '3.1rem' );
		if( $('.sub-header-1 div').height() > $('#fitin').height() ) {
			$('.sub-header-1').css('font-size', '1.7rem' );
		}

		if(fullscreen){
			$('.sub-header-1').css('font-size', '3.1rem' );
			if( $('.sub-header-1 div').height() > $('#fitin').height() ) {
				$('.sub-header-1').css('font-size', '2.1rem' );
			}
		}
	}


	function fitTextAntrian2()
	{
		array = [2,3,4,5];
		jQuery.each( array, function( i, val ) {
			$('#antrian-container-'+val).css('font-size', '1.5rem' );
			if( $('#poli-antrian-'+val).height() > $('#antrian-container-'+val).height() ) {
				$('#poli-antrian-'+val).css('font-size', '1.25rem' );
			}
		});
	}

	//dipanggil jika ada event resize
	function changeContentAntrian1()
	{
		if(fullscreen == 1){
			$('.sub-header-1').css('height','80px');
			$('.header-1').css('padding','20px 0px');
			$('.header-2').css('padding','20px 0px');
			$('.header-2').css('margin-bottom','0px');
			fitTextAntrian1();
			fitTextAntrian2();
		}
		else
		{
			$('.sub-header-1').css('height','70px');
			$('.header-1').css('padding','0px');
			$('.header-2').css('padding','0px');
			$('.header-2').css('margin-bottom','15px');
			fitTextAntrian1();
			fitTextAntrian2();
		}
	}
	//event untuk tau bahwa window lagi diubah
	$(window).on('resize', function(){
		var height = document.body.clientHeight;
		var width = document.body.clientWidth;
		
		if(height < 760) fullscreen = 0;
		else fullscreen = 1;

		changeContentAntrian1();
	});

	//init text news dibawah
	$('#marquee').liMarquee({
		direction: 'left',	
		loop:-1,			
		scrolldelay: 0,	
		scrollamount:90,	
		circular: true,
		hoverstop:false,	
		drag: false			
	});


	//js untuk antrian

	$(document).ready(function(){
		Codebase.loader('show')
	});
	$('.start-button').click(function(){
		Codebase.loader('hide')
		start = 1;
		getDataUpdateAntrian();
		slideShowRawatInap();
	})

	var times = 9000;
	var times_short = 3000;
	var times_medium = 5000;
	var times_long = 60000;
	var current_loket_id = 0;
	var current_nomor_antrian = 0;

	var intervalUpdateAntrian = setInterval(getDataUpdateAntrian, times);

	function getDataUpdateAntrian() {
		if(start)
		{
			$.ajax({
				url: API_URL+"/igd/antrian-screen/update",
				dataType: 'json',
				cache: false,
				type: 'GET',
				success: function(data) {
					clearInterval(intervalUpdateAntrian)
					//jika bakal di update
					if(data.status != 0) updateViewAntrian(data);
					else intervalUpdateAntrian = setInterval(getDataUpdateAntrian, times_short); //jika tidak maka akan terus ngecall ajax tapi lebih cepat

					current_loket_id = data.loket_id;
					current_nomor_antrian = data.no_antrian;
				}
			});
		}
	}

	function updateViewAntrian(data)
	{
		intervalUpdateAntrian = setInterval(getDataUpdateAntrian, times);
		if(current_nomor_antrian == data.nomor_antrian && current_loket_id == data.loket_id) recallAntrian1();
		else
		{
			updateKontenAntrian(1,data.nomor_antrian,data.loket_nama,1);
			announceAntrian(data.nomor_antrian,data.loket_id);
		}
	}

	function updateKontenAntrian(id,no_antrian,poli_nama,is_show)
	{
		var is_show_next = is_show
		if(show[id] == 0)
		{
			show[id] = is_show;
			if(is_show)
			{
				$('#memanggil-antrian').show();
				$('#nomor-antrian-'+id).show();
				$('#poli-antrian-'+id).show();
			}
			is_show_next = 0;
		}
		else
		{
			is_show_next = 1;
		}
		if(id == 1){
			blinkAnimate('#memanggil-antrian');
			blinkAnimate('#nomor-antrian-1');
			blinkAnimate('#poli-antrian-1');
		}

		var current_antrian = $('#nomor-antrian-'+id).text();
		var current_poli = $('#poli-antrian-'+id).text();

		fitTextAntrian1();
		fitTextAntrian2();

		$('#nomor-antrian-'+id).text(no_antrian);
		$('#poli-antrian-'+id).text(poli_nama);
		
		if(id != 5)
		{
			updateKontenAntrian(id+1,current_antrian,current_poli,is_show_next);
		}
	}

	function blinkAnimate(element)
	{
		$(element).animate({opacity:0},200,"linear",function(){
			$(this).animate({opacity:1},200);
		});
	}

	function recallAntrian1(){
		announceAntrian(current_nomor_antrian,current_loket_id);
		blinkAnimate('#memanggil-antrian');
		blinkAnimate('#nomor-antrian-1');
		blinkAnimate('#poli-antrian-1');
	}

	function announceAntrian(nomor_antrian,poli_id)
	{
		var url = "{{url('')}}/assets/img/igd-tv/sound/";
		var arrayAudio = [];
		arrayAudio.push(url+"nomor.mp3");
		arrayAudio.push(url+"antrian.mp3");
		var nomor_antrian_string = nomor_antrian.toString();
		var array_nomor = nomor_antrian_string.split("");
		var total_nomor = array_nomor.length;
		

		$.each( array_nomor, function( i, val ) {

			var total_nol = total_nomor - i - 1;
			var nol_str = ""
			var mp3 = ".mp3"

			if(val == 0) return; //jika 0 gausah di call

			//jika mengandung 10 - 19
			if(total_nol == 1 && val == 1){
				var angka = array_nomor[i] + array_nomor[i+1]
				arrayAudio.push(url+angka+mp3);
				return false;
			}

			if(total_nol == 1) nol_str = "0" //puluhan
			else if(total_nol == 2) nol_str = "00" //ratusan

				arrayAudio.push(url+val+nol_str+mp3);
		})

		;
		arrayAudio.push(url+"menuju.mp3");
		arrayAudio.push(url+"loket"+poli_id+".mp3");
		doAnnounce(arrayAudio);
	}

	var playing = 0;
	var queue_playlist = []
	var allowCheckQueuePlaylist = 1;

	function doAnnounce(file_name)
	{
		var audio = document.getElementById("player");
		var total = file_name.length;
		var count = 0;
		audio.src = file_name[0];
		document.getElementById('player').muted = false;
		audio.play();
		count++;
		var playing = 1;
		audio.addEventListener("ended", function() {
			if(count < total)
			{
				audio.src = file_name[count];
				audio.play();
			}
			else
			{
				//done playing
				queue_playlist.shift();
				allowCheckQueuePlaylist = 1;
			}
			count++;
		});
	};
	/*RAWAT INAP*/

	var intervalUpdateRawatInap = setInterval(getDataRawatInap, times_short);
	var intervalSlideShowRawatInap = setInterval(slideShowRawatInap, times_medium);


	function getDataRawatInap(){
		$.ajax({
			url: API_URL+"/official-website/rawatinap/ketersediaan-bed",
			dataType: 'json',
			cache: false,
			type: 'GET',
			success: function(data) {
				clearInterval(intervalUpdateRawatInap)
				if(data.status != 0) updateViewRawatInap(data);
				else intervalUpdateRawatInap = setInterval(getDataRawatInap, times_long); //jika tidak maka akan terus ngecall ajax tapi lebih cepat
				var CurrentDate = moment().format('DD MMM YYYY HH:mm');	
				$('#rawat-inap-last-update').text(CurrentDate)
			}
		});
	}

	function updateViewRawatInap(data)
	{
		$.each(data, function( index, value ) {
			var index_item = index+1;
			$('#rawat-inap-kelas-'+index_item+ ' .kelas').html(value.kelas)
			$('#rawat-inap-kelas-'+index_item+ ' .total-kosong').html(value.total_kosong)
			$('#rawat-inap-kelas-'+index_item+ ' .total-kapasitas').html('/'+value.total_kapasitas)
		});
		intervalUpdateRawatInap = setInterval(getDataRawatInap, times_long);
	}

	var set_1_show = 0;

	function slideShowRawatInap()
	{
		if(set_1_show){
			$(".set-1").fadeOut(1000, function(){
				$('.set-0').fadeIn()
			})
			set_1_show = 0;
		}
		else{
			$(".set-0").fadeOut(1000, function(){
				$('.set-1').fadeIn()
			})
			set_1_show = 1;
		}
		clearInterval(intervalSlideShowRawatInap)
		intervalSlideShowRawatInap = setInterval(slideShowRawatInap, times_medium);
		
	}

	

</script>