<script type="text/javascript">
	function verifBPJS(){
		var errCounter=0;
        $('#modal-bpjs input, #modal-bpjs select').each(function(n,element){
            if($(element).hasClass('laka')){
        	    if($('#laka')[0].checked && $(element).attr('required') && $(element).val()==''){
	                errCounter++;
	                console.log(element);
	                console.log($(element).val());
        	    }
        	}else if($(element).hasClass('suplesi')){
        	    if($('#suplesi')[0].checked && $(element).attr('required') && $(element).val()==''){
	                errCounter++;
	                console.log(element);
	                console.log($(element).val());
        	    }
        	}
        	else if ($(element).attr('required') && $(element).val()=='') {
                errCounter++;
                console.log(element);
                console.log($(element).val());
            }
        });

        if (errCounter==0) {
            return 1;
        } 
        else {
            $('#modal-bpjs input, #modal-bpjs select').each(function(n,element){
            	if($(element).hasClass('laka')){
            		if($('#laka')[0].checked && $(element).attr('required') && $(element).val()==''){
	                    $(element).parentsUntil(".block-content").addClass("is-invalid");
	        	    }else{
                    	$(element).parentsUntil(".block-content").removeClass("is-invalid");
	        	    }
            	}
            	else if($(element).hasClass('suplesi')){
            		if($('#suplesi')[0].checked && $(element).attr('required') && $(element).val()==''){
	                    $(element).parentsUntil(".block-content").addClass("is-invalid");
	        	    }else{
                    	$(element).parentsUntil(".block-content").removeClass("is-invalid");
	        	    }
            	}
            	else if ($(element).attr('required') && $(element).val()=='') {
                    $(element).parentsUntil(".block-content").addClass("is-invalid");
                }
                else {
                    $(element).parentsUntil(".block-content").removeClass("is-invalid");
                }
            });
            return 0;
        }
	}

	$('#saveBPJS').click(function() {
        $('#data_sep_rujukan').text("-");
        $('#data_sep_jenis_pelayanan').text("-");
        $('#data_sep_poli').text("-");
        $('#data_sep_poli_eksekutif').text("-");
        $('#data_sep_cob').text("-");
        $('#data_sep_katarak').text("-");
        $('#data_sep_laka').text("-");
        $('#data_sep_suplesi_laka').text("-");
        $('#data_sep_tanggal_laka').text("-");
        $('#data_sep_tempat_laka').text("-");
        if(data_rujukan){
            $('#data_sep_rujukan').text( data_rujukan.noKunjungan || "Tidak Ada Rujukan");
            $('#data_sep_jenis_pelayanan').text( data_rujukan.pelayanan.nama || "-");
            $('#data_sep_poli').text( data_rujukan.poliRujukan.nama || "-");
            $('#data_sep_poli_eksekutif').text( ($('#is_eksekutif').is(':checked')) ? "YA" : "TIDAK");
            $('#data_sep_cob').text( ($('#cob').is(':checked')) ? "YA" : "TIDAK");
            $('#data_sep_katarak').text( ($('#katarak').is(':checked')) ? "YA" : "TIDAK");
            if($('#laka').is(':checked')){
                var data = $('#penjamin_laka').select2('data');
                if(data) {
                    var penjamin = "";
                    for (var i = 0; i < data.length; i++) {
                        penjamin+=", "+data[i].text;
                    }
                    penjamin = penjamin.substring(2, penjamin.length);
                    $('#data_sep_laka').text(penjamin);
                }else{
                    $('#data_sep_laka').text("-");
                }
                $('#data_sep_suplesi_laka').text($('#sep_suplesi').val());
                $('#data_sep_tanggal_laka').text($('#tanggal_laka').val());
                // var prov =
                // var kab =
                // var kec =
                $('#data_sep_tempat_laka').text(", ");
            }
            $('#infoBPJSWrapper').show();
            $('#modal-bpjs').modal('hide');
        }
	});


</script>