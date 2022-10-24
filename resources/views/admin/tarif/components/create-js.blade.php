<script type="text/javascript">
	var trCount = 1;
	var tbody = $('#harga-tbody');
	$(document).on('click', '#tambahRecord', function(){
		trCount++;
		tbody.append(`@include('admin.tarif.components.create-tr')`);
		
	$('.input-harga').mask("000.000.000.000.000", {reverse: true});
	});
	$(document).on('click', '.remove', function(el){
		trCount--;
		$(this).parent().parent().remove();
		reindexNum();
	});


	function reindexNum(){
		$('.index-num').each(function(key, item){
			item.innerText = key+1;
		});
	}
	$('.input-harga').mask("000.000.000.000.000", {reverse: true});

</script>