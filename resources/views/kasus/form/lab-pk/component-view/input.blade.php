@if($show_data_as == 'show')
<div class="row">
	<div class="col">
		<h5><small>{{$input->label}}</small></h5>
		<h5 class="font-w400">@if(!empty($input->hasil->value)) {{$input->hasil->value}} {{$input->satuan}}@else - @endif</h5>		
	</div>	
	<div class="col-6">
		<div><strong>Nilai Normal</strong></div>
		{{$input->referensi}}		
	</div>	
</div>
@else
<label class="h5 mb-5">{{$input->label}}</label>
<div class="row">
	<div class="input-group col-8">
		<input type="{{$input->type}}" class="form-control" name="input-{{$input->id}}" value="@if(!empty($input->hasil->value)){{$input->hasil->value}} @endif">
		<div class="input-group-append">
		    <span class="input-group-text">{{$input->satuan}}</span>
		</div>
	</div>
	<div class="col">
		Normal:<br>
		<strong>{{$input->referensi}}</strong>
	</div>
</div>
@endif