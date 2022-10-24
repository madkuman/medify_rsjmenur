@if($show_data_as == 'show')
<h5><small>{{$input->label}}</small></h5>
<h5 class="font-w400">
	@if(!empty($input->hasil->value)) 
	{{ $input->hasil->value }} 
	@else - @endif
</h5>
@else
<div class="row">
	<div class="col-2 pt-10">
		<h6>{{$input->label}}</h6>
	</div>
	<div class="col">
		<select class="form-control" name="input-{{$input->id}}">
			@foreach($input->opsi as $opsi)
			<option value="{{$opsi->deskripsi}}" 
				@if(!empty($input->hasil->value))
				@if($input->hasil->value == $opsi->deskripsi) selected @endif 
				@endif
				>{{$opsi->deskripsi}}</option>
				@endforeach
			</select>
			<small>{{$input->caption}}</small>
		</div> 
	</div>
	@endif
