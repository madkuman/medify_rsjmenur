<script type="text/javascript">
	fitTextAntrian1();

	var fullscreen = 0;
	var start = 0;
	var times = 9000;
	var times_short = 3000;
	var times_medium = 5000;
	var times_long = 60000;

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
	})
	/*RAWAT INAP*/

	var intervalUpdateRawatInap = setInterval(getDataRawatInap, times_short);
	// var intervalSlideShowRawatInap = setInterval(slideShowRawatInap, times_medium);


    function getDataRawatInap(){
        $.ajax({
            url: "{{url('')}}/api/official-website/rawatinap/ketersediaan-rawat-inap",
            dataType: 'json',
            cache: false,
            type: 'GET',
            success: function(data) {
                clearInterval(intervalUpdateRawatInap)
                if(data.status != 0) updateViewRawatInap(data);
                else intervalUpdateRawatInap = setInterval(getDataRawatInap, times_long); //jika tidak maka akan terus ngecall ajax tapi lebih cepat
                var CurrentDate = moment().format('DD MMM YYYY HH:mm');
                console.log(CurrentDate);
                $('#rawat-inap-last-update').text(CurrentDate)
            }
        });
    }

    function updateViewRawatInap(data)
    {
        $.each(data, function( index, value ) {
            $.each(value, function( index2, value2 ) {
                var total = '-', isi = '-', kosong = '-';
                if(value2.total != undefined) total = value2.total;
                if(value2.isi != undefined) isi = value2.isi;
                if(value2.kosong != undefined) kosong = value2.kosong;
                $('#total_'+value2.bangsal_id+'_'+value2.kelas_id).html(total)
                $('#isi_'+value2.bangsal_id+'_'+value2.kelas_id).html(isi)
                $('#kosong_'+value2.bangsal_id+'_'+value2.kelas_id).html(kosong)
            });
        });
        intervalUpdateRawatInap = setInterval(getDataRawatInap, times_long);
    }
	

</script>