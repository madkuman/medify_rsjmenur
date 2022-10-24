<script type="text/javascript">
	 function updateProgressBar(percentage)
    {
    	if(percentage < 100){
        	$('.progress-data-loader-loading .progress-bar').css("width",percentage+"%")
        	$('.progress-data-loader-loading .progress-bar-label').html(percentage+"%")

        	$('.progress-data-loader-loading').show()
        	$('.progress-data-loader-complete').hide()
    	}
    	else
    	{
        	$('.progress-data-loader-loading').hide()
        	$('.progress-data-loader-complete').show()
    	}
    }
</script>