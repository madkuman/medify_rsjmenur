<script type="text/javascript">
	function rujukClick(poli_tujuan_id, no_sep, sisa_plafon, kasus_id, metode_pembayaran_id, rujuk_id,is_buat_kasus){
	    $('#selectPoli').val(poli_tujuan_id).trigger('change');
	    $('#selectPembayaran').val(metode_pembayaran_id).trigger('change');
	    $('#selectPoli').val(poli_tujuan_id).trigger('change');
	    $('#selectRujukan option').each(function() {
	        if($(this).data('self') == 1){
	            console.log($(this).val());
	            $('#selectRujukan').val($(this).val());
	            $('#selectRujukan').trigger('change');
	        }
	    });
	    $('#selectRujukanID').val(rujuk_id);

	    if(is_buat_kasus == '0') 
	    	$('#selectKasus').val(kasus_id)
        else 
        	$('#selectKasus').val('0')


            lihatRuangVideo(poli_tujuan_id)
        lihatMetode(metode_pembayaran_id)

        if(is_buat_kasus == '0')
        {
            $('#noSEP').val(no_sep);
            $('#sisaPlafon').text('Rp ' + numeral(sisa_plafon).format('0,0'))
            $('#infoSEP').show();
        }
        else
        {
            $('#noSEP').val(0);
            $('#infoSEP').hide();
        }
    }

    

    function removeRujukan()
    {
        $('#selectRujukanID').val(0)
        $('#selectKasus').val(0)
        if ($('#selectPembayaran').find(':selected').data('bpjs')=="yes") {
                $('#noSEP').val('');
            }
            else {
                $('#noSEP').val('0');
            };
        $( "a.block.block-link-pop" ).removeClass( "active" )
    }

</script>