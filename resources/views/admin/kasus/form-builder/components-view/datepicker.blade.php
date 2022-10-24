@if($show_data_as == 'show')
<h5><small>{{$input->label}}</small></h5>
<h5 class="font-w400">
	@if(!empty($input->hasil->value)) 
	{{ Carbon\Carbon::createFromFormat('d/m/y', $input->hasil->value)->format('d F Y')}} 
	@else - @endif
</h5>
@else
<div class="row">
	<div class="col-2 pt-10">
		<h6>{{$input->label}}</h6>
	</div>
	<div class="col">
		<input type="text" class="js-datepicker form-control" autocomplete="off" name="input-{{$input->id}}" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yy" placeholder="dd/mm/yy"
		value="@if(!empty($input->hasil->value)){{$input->hasil->value}}@endif" 
		>          
		<small>{{$input->caption}}</small>
	</div>
</div>
@endif