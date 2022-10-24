<script type="text/javascript">
	// fitTextAntrian1();

	var fullscreen = 0;
	$('#memanggil-antrian').hide();
	$('#nomor-antrian-1').hide();
	$('#ruangan-antrian-1').hide();
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

	//js untuk antrian
	$(document).ready(function(){
		Codebase.loader('show')
	});
	$('.start-button').click(function(){
		Codebase.loader('hide')
		start = 1;
		getDataUpdateAntrian();
	})

	var times = 9000;
	var times_short = 3000;
	var times_medium = 5000;
	var times_long = 60000;
	var current_loket_id = 0;
	var current_ruangan_nama = '';
	var current_nomor_antrian = 0;

	var intervalUpdateAntrian = setInterval(getDataUpdateAntrian, times);

	function getDataUpdateAntrian() {
		if(start)
		{
			$.ajax({
				url: "{{url('')}}/api/rawatjalan/antrian-screen/update/{{$master_tv_id}}",
				dataType: 'json',
				cache: false,
				type: 'GET',
				success: function(data) {
					clearInterval(intervalUpdateAntrian)
					if(data.status != 0) updateViewAntrian(data);
					else intervalUpdateAntrian = setInterval(getDataUpdateAntrian, times_short); //jika tidak maka akan terus ngecall ajax tapi lebih cepat
					current_loket_id = data.ruangan_id;
					current_ruangan_nama = data.ruangan_nama;
					current_nomor_antrian = data.nomor_antrian;
				}
			});
		}
	}
    
    function updateViewAntrian(data) {
        intervalUpdateAntrian = setInterval(getDataUpdateAntrian, times);
        if(current_nomor_antrian == data.nomor_antrian && current_loket_id == data.ruangan_id) recallAntrian1();
		else
		{
			updateKontenAntrian(data);
			announceAntrian(data.nomor_antrian,data.ruangan_nama);
		}
    }

    function updateKontenAntrian(data) {
		$('#active_antrian').val(data.ruangan_id);
		$('#memanggil-antrian').show();
		$('#nomor-antrian-1').text(data.nomor_antrian);
		$('#ruangan-antrian-1').text(data.ruangan_nama);
		$('#nomor-antrian-1').show();
		$('#ruangan-antrian-1').show();
		blinkAnimate('#ruangan-antrian-1')
		blinkAnimate('#nomor-antrian-1')
        $('.ruangan-'+data.ruangan_id).text(data.nomor_antrian);
    }

	function blinkAnimate(element)
	{
		$(element).animate({opacity:0},200,"linear",function(){
			$(this).animate({opacity:1},200);
		});
	}

	function recallAntrian1(){
		announceAntrian(current_nomor_antrian,current_ruangan_nama);
		blinkAnimate('#memanggil-antrian');
		blinkAnimate('#nomor-antrian-1');
		blinkAnimate('#ruangan-antrian-1');
	}

	function announceAntrian(nomor_antrian,ruangan_nama)
	{
		var url = "{{url('')}}/assets/img/rawatjalan-tv/sound/";
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
		});
		var lastItem = ruangan_nama.split(" ").pop(-1);
		arrayAudio.push(url+"menuju.mp3");
		arrayAudio.push(url+"Ruangan.mp3");
		arrayAudio.push(url+lastItem+".mp3");
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
</script>