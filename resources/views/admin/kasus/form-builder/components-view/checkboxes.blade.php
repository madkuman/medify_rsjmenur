<div class="row">
	<div class="col-4">
		<h6>{{$input->label}}</h6>
		<small>{{$input->caption}}</small>
	</div>
	<div class="col">
		@php $index = 0 @endphp
		@foreach($input->opsi as $opsi)
		@php $checked = 0 @endphp
		<div class="custom-control custom-checkbox mb-5">
			<input class="custom-control-input" type="checkbox" name="input-{{$input->id}}[]" id="input-{{$opsi->id}}"  value="{{$opsi->id}}" data-score="{{$opsi->skor}}"
			@if(!empty($input->hasil->value))
			@if(in_array($opsi->id,$input->hasil->value))
			checked
			@php $checked = 1 @endphp
			@endif
			@endif
			@if($show_data_as == 'show') disabled @endif
			>
			<label class="custom-control-label" for="input-{{$opsi->id}}">
				@if($checked  && $show_data_as != 'edit') <strong class="text-black"> @endif
					{{$opsi->deskripsi}} 
					@if($checked  && $show_data_as != 'edit') @if(!empty($input->hasil->keterangan[$index])) - ({{$input->hasil->keterangan[$index]}}) @endif @endif
				@if($checked  && $show_data_as != 'edit') </strong> @endif
			</label>
		</div>
		@if($show_data_as != 'show')
		<div class="form-group row" @if($opsi->extra_input!=1) hidden @endif>
			<div class="col-6">
				<div class="form-material pt-0">
					<input type="text" class="form-control" id="material-text" name="opsi-keterangan-{{$opsi->id}}" placeholder="Keterangan" value="@if(!empty($input->hasil->keterangan[$index]) && $checked) {{$input->hasil->keterangan[$index]}} @endif">
				</div>
			</div>
		</div>
		@endif
		@if($checked == 1)  @php $index++ @endphp @endif
		@endforeach

	</div>
</div>