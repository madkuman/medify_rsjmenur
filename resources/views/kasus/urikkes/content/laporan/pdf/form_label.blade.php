@if($value->type == 'h1')
<b>{{$value->label}}</b>
@elseif($value->type == 'h2')
<b>{{$value->label}}</b>
@elseif($value->type == 'h3')
<b>{{$value->label}}</b>
@elseif($value->type == 'h4')
<b>{{$value->label}}</b>
@elseif($value->type == 'h5')
<b>{{$value->label}}</b>
@else
<span style="text-transform: capitalize;">{{$value->label}}</span>
@endif