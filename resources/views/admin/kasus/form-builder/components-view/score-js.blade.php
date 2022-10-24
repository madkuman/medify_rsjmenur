
<script type="text/javascript">
	$( document ).ready(function() {
		@foreach($input->skor as $skor)



		@if($skor->child->type == 'radio-score')
		
		$('input[name=input-{{$skor->child->id}}]').change(function(){
			updateTotalSkor{{$input->id}}()
		});

		@elseif($skor->child->type == 'checkboxes-score')

		$('input.input-{{$skor->child->id}}').change(function() {
			updateTotalSkor{{$input->id}}()
		});
		@endif



		@endforeach

		function updateTotalSkor{{$input->id}}()
		{
			console.log('updateTotalSkor');
			var value_total = 0;
			@foreach($input->skor as $skor)
				@if($skor->child->type == 'radio-score')
				var value = $( 'input[name=input-{{$skor->child->id}}]:checked' ).data('score');
				value_total = value_total + parseInt(value);
				@elseif($skor->child->type == 'checkboxes-score')
				$('input.input-{{$skor->child->id}}:checked').each(function() {
					console.log('{{$input->id}}');
					value_total = value_total + parseInt($(this).data('score'));
				});
				@endif
			@endforeach
			$('#total-skor-{{$input->id}}').html(value_total)
			$('#input{{$input->id}}').val(value_total)
		}

	});
</script>