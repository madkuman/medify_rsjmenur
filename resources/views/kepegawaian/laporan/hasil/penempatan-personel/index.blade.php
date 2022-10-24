<!DOCTYPE html>
<html lang="en">
	<head>
		<style type="text/css">
			body{
				font-family: sans-serif;
			}
			.text-center{
				text-align: center;
			}
			.border-bottom{
				border-bottom: solid 1px #000;
			}
			table.border td, table.border th{
				border: solid 1px #000;
			}
			table.border{
				border-collapse: collapse;
			}
			table{
				table-layout: fixed;
			}
			table.sm td, table.sm th,
			table.md td, table.md th
			{
				font-size: 10px;
				padding-top: 0px;
				padding-bottom: 0px;
				padding-left: 4px;
				padding-right: 4px;
				vertical-align: top;
			}
			.wrapword{
				white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
				white-space: -webkit-pre-wrap; /*Chrome & Safari*/
				white-space: -pre-wrap;      /* Opera 4-6 */
				white-space: -o-pre-wrap;    /* Opera 7 */
				white-space: pre-wrap;       /* css-3 */
				word-wrap: break-word;       /* Internet Explorer 5.5+ */
				word-break: break-all;
				white-space: normal;
			}

			.page-break {
				page-break-after: always;
			}

			table.md td, table.md th{
				font-size: 13px;
			}
			table.border td{
				border-bottom: none;
				border-top: none;
			}
			tr.border-bottom td{
				border-bottom: solid 1px #000;
			}
			tr.border-top td{
				border-top: solid 1px #000;
			}
			tr.text-center td{
				text-align: center;
			}
			table.border th{
				vertical-align: middle!important;
			}
			.ttd-table td
			{
				font-size: 13px;
			}
			table.header td{
				font-size: 16px;
			}
		</style>
		<title>@yield('title')</title>
	</head>
	<body>
		<table width="100%">
	<tr>
		<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
	</tr>
</table>
		<br>
		<table class="no-border md header" style="width: 100%">
			<tr>
				<td class="text-center">Daftar Personel Berdasarkan Kualifikasi</td>
			</tr>
			<tr>
				<td class="text-center">Bulan {{$kop_bulan}}</td>
			</tr>
		</table>
		<br>
		@php 
			$first_time = 0;
			$mod = 11;
			$count = 0;
		@endphp
		@foreach($pegawai as $item)
			@php 
				$count += 1;
				$border_bottom = 0;
				$break_table = 0;
				if($count % $mod == 1) 
				{
					$break_table = 1;
				}
				if($count % $mod == 0) 
				{
					$border_bottom = 1;
					if($first_time == 0) {
						$first_time = 1;
						$mod = 13;
					}
					$count = 0;
				}
				if($loop->last) $border_bottom = 1;
				if($first_time == 0) $px = '70px';
				else $px = '70px';
			@endphp
		@if($break_table)
		<table class="border md" style="width: 100%">
			<tr class="text-center">
				<th style="width: 5%">No</th>
				<th style="width: 20%">Nama</th>
				<th style="width: 15%">Pangkat<br>Korp</th>
				<th style="width: 10%">NRP</th>
				<th style="width: 20%">Jabatan Sesuai ST</th>
				<th style="width: 30%">Kualifikasi</th>
			</tr>
			<tr class="border-bottom text-center">
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
			</tr>
		@endif
			<tr @if($border_bottom) class="border-bottom" @endif>
				<td class="text-center" style="height: {{$px}};overflow-y: hidden;">{{$loop->iteration}}</td>
				<td>{{$item->name}}</td>
				<td>{{$item->pangkat}}<br>{{$item->korps}}</td>
				<td class="wrapword">{{$item->nrp}}</td>
				<td>{{$item->jabatan}}</td> 
				<td>{{$item->kualifikasi}}</td>
			</tr>
		@if($border_bottom)
		</table>
		@if(!$loop->last)
		<div class="page-break"></div>
		@endif
		@endif
		@endforeach
	<br>
	@include('kepegawaian.laporan.hasil.components.ttd')
	</body>
</html>