<script type="text/javascript">
	$('input[type=radio][name=dokter-jenis]').change(function() {
	   if (this.value == 'rsal') {
	       $(this).closest('.dokter-container').find('.dokter-luar').hide()
	       $(this).closest('.dokter-container').find('.dokter-rsal').show()
	   }
	   else  {
	       $(this).closest('.dokter-container').find('.dokter-luar').show()
	       $(this).closest('.dokter-container').find('.dokter-rsal').hide()
	   }
	});
</script>