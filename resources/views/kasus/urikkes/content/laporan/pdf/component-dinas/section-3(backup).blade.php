<div class="text-center">3.</div>
<table style="font-size: 11px">
	<tr>
		<th>
			<b><u>HEMATOLOGI</u></b>
		</th>
		<th ><b>Hasil</b></th>
		<th >&nbsp;</th>
		<th><b>Nilai Normal</b></th>
	</tr>
	@php($string = "")
	@foreach($input_lab1 as $key => $input)
	@if(strpos($input->label, "Diff") !== false)
		@if(!empty($input->hasil))
		@php($string .= "/".$input->hasil->value)
		@else
		@php($string .= "/-")
		@endif
	@else
	<tr>
		<td >{{$input->label}}</td>
		@if(!empty($input->hasil))
		<td >
			: @if(!empty($input->hasil->value)) {{$input->hasil->value}}  @else - @endif
		</td>
		<td>@if(is_numeric($input->hasil->value)) {{$input->satuan}}@endif</td>
		@else
		<td >
			: -
		</td>
		<td>{{$input->satuan}}</td>
		@endif
		<td>
			@php($pos = strpos($input->referensi, "P:"))
			@if($pos !== false && $identitas->jenis_kelamin == "P")
			{{substr($input->referensi, $pos-1)}}
			@elseif($pos !==false && $identitas->jenis_kelamin == "L")
			{{substr($input->referensi, 0, $pos)}}
			@else
			{{$input->referensi}}
			@endif
		</td>
	</tr>
	@endif
	@endforeach
	<tr>
		<td>Diff. Count</td>
		<td colspan="2">{{$string}}</td>
	</tr>
	<tr>
		<td>
			<b><u>KIMIA KLINIK</u></b>
		</td>
		<td ><b>Hasil</b></td>
		<th >&nbsp;</th>
		<td><b>Nilai Normal</b></td>
	</tr>
	@php($i=0)
	@foreach($input_lab37 as $key => $input)
	<tr>
		<td>{{$input->label}}</td>
		<td>
			: @if(!empty($input->hasil->value)) {{$input->hasil->value}} @else - @endif
		</td>
		<td>
			{{$input->satuan}}
		</td>
		<td>
			@php($pos = strpos($input->referensi, "P:"))
			@if($pos !== false && $identitas->jenis_kelamin == "P")
			{{substr($input->referensi, $pos-1)}}
			@elseif($pos !==false && $identitas->jenis_kelamin == "L")
			{{substr($input->referensi, 0, $pos)}}
			@else
			{{$input->referensi}}
			@endif
		</td>
	</tr>
	@endforeach
	@foreach($input_lab38 as $key => $input)
	<tr>
		<td>{{$input->label}}</td>
		<td>
			: @if(!empty($input->hasil->value)) {{$input->hasil->value}} @else - @endif
		</td>
		<td>
			{{$input->satuan}}
		</td>
		<td>
			@php($pos = strpos($input->referensi, "P:"))
			@if($pos !== false && $identitas->jenis_kelamin == "P")
			{{substr($input->referensi, $pos-1)}}
			@elseif($pos !==false && $identitas->jenis_kelamin == "L")
			{{substr($input->referensi, 0, $pos)}}
			@else
			{{$input->referensi}}
			@endif
		</td>
	</tr>
	@endforeach
	@foreach($input_lab39 as $key => $input)
	<tr>
		<td>{{$input->label}}</td>
		<td>
			: @if(!empty($input->hasil->value)) {{$input->hasil->value}} @else - @endif
		</td>
		<td>
			{{$input->satuan}}
		</td>
		<td >
			@php($pos = strpos($input->referensi, "P:"))
			@if($pos !== false && $identitas->jenis_kelamin == "P")
			{{substr($input->referensi, $pos-1)}}
			@elseif($pos !==false && $identitas->jenis_kelamin == "L")
			{{substr($input->referensi, 0, $pos)}}
			@else
			{{$input->referensi}}
			@endif
		</td>
	</tr>
	@endforeach
	@foreach($input_lab40 as $key => $input)
	@if(!(strpos($input->referensi, "HBA") === false || strpos($input->referensi, "Acak") === false))
	<tr>
		<td >{{$input->label}}</td>
		<td >
			: @if(!empty($input->hasil->value)) {{$input->hasil->value}} @else - @endif
		</td>
		<td>
			{{$input->satuan}}
		</td>
		<td>
			@php($pos = strpos($input->referensi, "P:"))
			@if($pos !== false && $identitas->jenis_kelamin == "P")
			{{substr($input->referensi, $pos-1)}}
			@elseif($pos !==false && $identitas->jenis_kelamin == "L")
			{{substr($input->referensi, 0, $pos)}}
			@else
			{{$input->referensi}}
			@endif
		</td>
	</tr>
	@endif
	@endforeach
</table>