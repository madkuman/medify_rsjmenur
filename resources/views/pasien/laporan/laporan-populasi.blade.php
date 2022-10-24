<!doctype html>
<html>
<head>
	<style type="text/css">
	table.table, .table td, .table th 
	{    
		border: 1px solid #000;
		text-align: left;
	}

	table.table 
	{
		border-collapse: collapse;
		width: 100%;
	}

	.table th, .table td 
	{
		padding: 15px;
	}
	th, .text-center
	{
		text-align: center;
	}
	table {
		border-collapse: collapse;
	}

	table, th, td {
		border: 1px solid black;
		padding: 5px;
	}
	body {
		font-family: sans-serif;
	}
</style>
</head>
<body>
	<div class="text-center">
		<h4>LAPORAN POPULASI</h4>
		<h4>PERIODE : {{$start}} - {{$end}}</h4>
	</div>
	<table width="100%">
		<tr>
			<td colspan="2" rowspan="2">DATA</td>
			<td colspan="{{count($months)}}">BULAN</td>
			<td rowspan="2">TOTAL</td>
			<td rowspan="2">PERSENTASE</td>
		</tr>
		<tr>
			@foreach($months as $month)
			<td>{{$month['month']}}</td>
			@endforeach
		</tr>

		@php $last_key = count($usia) - 1 @endphp
		@foreach($usia as $key => $item)
		<tr>
			@if($loop->first)
			<td rowspan="{{count($usia)}}">UMUR</td>
			@endif

			<td>{{$item}}</td>
			@php $total = 0 @endphp
			@php $total_all = 0 @endphp

			@foreach($months as $month)
				<td>{{$month['usia'][$key]->total}}</td>
				@php $total += $month['usia'][$key]->total @endphp
				@php $total_all += $month['usia'][$last_key]->total @endphp
			@endforeach
			<td>{{$total}}</td>
			<td>{{$total_all != 0 ? round($total/$total_all*100,2) : 0}} %</td>
		</tr>
		@endforeach

		@php $last_key = count($jk)-1 @endphp
		@foreach($jk as $key => $item)
		<tr>
			@if($loop->first)
			<td rowspan="{{count($jk)}}">SEX</td>
			@endif



			<td>{{$item}}</td>
			@php $total = 0 @endphp
			@php $total_all = 0 @endphp

			@foreach($months as $month)
				<td>{{$month['jk'][$key]->total}}</td>
				@php $total += $month['jk'][$key]->total @endphp
				@php $total_all += $month['jk'][$last_key]->total @endphp
			@endforeach
			<td>{{$total}}</td>
			<td>{{$total_all != 0 ? round($total/$total_all*100,2) : 0}} %</td>
		</tr>
		@endforeach

		@php $last_key = count($agama)-1 @endphp
		@foreach($agama as $key => $item)
		<tr>
			@if($loop->first)
			<td rowspan="{{count($agama)}}">AGAMA</td>
			@endif

			<td>{{$item}}</td>
			@php $total = 0 @endphp
			@php $total_all = 0 @endphp
			@foreach($months as $month)
				<td>{{$month['agama'][$key]->total}}</td>
				@php $total += $month['agama'][$key]->total @endphp
				@php $total_all += $month['agama'][$last_key]->total @endphp
			@endforeach
			<td>{{$total}}</td>
			<td>{{$total_all != 0 ? round($total/$total_all*100,2) : 0}} %</td>
		</tr>
		@endforeach


		@php $last_key = count($pendidikan) - 1 @endphp
		@foreach($pendidikan as $key => $item)
		<tr>
			@if($loop->first)
			<td rowspan="{{count($pendidikan)}}">PENDIDIKAN</td>
			@endif

			@php $total = 0 @endphp
			@php $total_all = 0 @endphp
			<td>{{$item}}</td>
			@foreach($months as $month)
				<td>{{$month['pendidikan'][$key]->total}}</td>
				@php $total += $month['pendidikan'][$key]->total @endphp
				@php $total_all += $month['pendidikan'][$last_key]->total @endphp
			@endforeach
			<td>{{$total}}</td>
			<td>{{$total_all != 0 ? round($total/$total_all*100,2) : 0}} %</td>
		</td>
		@endforeach

		@php $last_key = count($bahasa) - 1 @endphp
		@foreach($bahasa as $key => $item)
		<tr>
			@if($loop->first)
			<td rowspan="{{count($bahasa)}}">BAHASA</td>
			@endif

			@php $total = 0 @endphp
			@php $total_all = 0 @endphp
			<td>{{$item}}</td>
			@foreach($months as $month)
				<td>{{$month['bahasa'][$key]->total}}</td>
				@php $total += $month['bahasa'][$key]->total @endphp
				@php $total_all += $month['bahasa'][$last_key]->total @endphp
			@endforeach
			<td>{{$total}}</td>
			<td>{{$total_all != 0 ? round($total/$total_all*100,2) : 0}} %</td>
		</td>
		@endforeach

		@php $last_key = count($suku) - 1 @endphp
		@foreach($suku as $key => $item)
		<tr>
			@if($loop->first)
			<td rowspan="{{count($suku)}}">SUKU</td>
			@endif

			@php $total = 0 @endphp
			@php $total_all = 0 @endphp
			<td>{{$item}}</td>
			@foreach($months as $month)
				<td>{{$month['suku'][$key]->total}}</td>
				@php $total += $month['suku'][$key]->total @endphp
				@php $total_all += $month['suku'][$last_key]->total @endphp
			@endforeach
			<td>{{$total}}</td>
			<td>{{$total_all != 0 ? round($total/$total_all*100,2) : 0}} %</td>
		</td>
		@endforeach
	</table>
</body>