<h4>TOTAL SKOR {{$input->label}} : 
	<strong id="total-skor-{{$input->id}}">
		@if(!empty($input->hasil->value)) {{$input->hasil->value}} @endif
	</strong>
</h4>
<input name="input-{{$input->id}}" id="input{{$input->id}}" type="hidden" value="@if(!empty($input->hasil->value)) {{$input->hasil->value}} @endif">
