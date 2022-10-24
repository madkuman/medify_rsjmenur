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
				white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
				white-space: -webkit-pre-wrap; /*Chrome & Safari*/
				white-space: -pre-wrap;      /* Opera 4-6 */
				white-space: -o-pre-wrap;    /* Opera 7 */
				white-space: pre-wrap;       /* css-3 */
				word-wrap: break-word;       /* Internet Explorer 5.5+ */
				word-break: break-all;
				white-space: normal;
			}
			.wrapword{
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
		<table class="no-border md" style="width: 100%">
			<tr>
				<td class="text-center" width="20%">{{config('app.name')}}</td>
				<td width="55%"></td>
				<td width="25%">Lampiran Surat</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>Nomor Sprin /{{$nomor_sprin}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td class="border-bottom">Tanggal {{$tanggal_surat}}</td>
			</tr>
			<tr>
				<td></td>
				<td class="text-center">Nominatif Personel</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td class="text-center">{{$kop_bulan}}</td>
				<td></td>
			</tr>
		</table>
		<br>
		@php 
			$first_time = 0;
			$mod = 7;
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
						$mod = 9;
					}
					$count = 0;
				}
				if($loop->last) $border_bottom = 1;
				if($first_time == 0) $px = '70px';
				else $px = '70px';
			@endphp
		@if($break_table)
			<table class="border sm" style="width: 100%">
			<tr class="text-center">
				<th width="4%">No</th>
				<th width="10%">Nama<br>Tanggal Lahir</th>
				<th width="7%">Pangkat<br>Korp</th>
				<th width="5%">NRP</th>
				<th width="4%">TMT TNI/AL</th>
				<th width="4%">TMT Pa</th>
				<th width="4%">TMT. Kat Akhir</th>
				<th width="4.5%">Jabatan</th>
				<th width="4%">TMT. Jabatan</th>
				<th width="16.5%">Umum</th>
				<th width="16.5%">Militer</th>
				<th>K/TK</th>
				<th>Agama</th>
				<th>Status Rumah</th>
				<th width="12%">Alamat</th>
			</tr>
			<tr class="border-bottom text-center">
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				<td>8</td>
				<td>9</td>
				<td>10</td>
				<td>11</td>
				<td>12</td>
				<td>13</td>
				<td>14</td>
				<td>15</td>
			</tr>
			@endif

			<tr @if($border_bottom) class="border-bottom" @endif>
				<td class="text-center" style="height: {{$px}};overflow-y: hidden;">{{$loop->iteration}}</td>
				<td>{{$item->name}}<br>{{$item->kelahiran_format_custom_dmy}}</td>
				<td>{{$item->pangkat}}<br>{{$item->korps}}</td>
				<td>{{$item->nrp}}</td>
				<td class="text-center">{{ date('d/m/y', strtotime( $item->tmt))}}</td>
				<td class="text-center">{{ date('d/m/y', strtotime( $item->tmt_pa_pns))}}</td>
				<td class="text-center">{{ date('d/m/y', strtotime( $item->tmt_kesatuan))}}</td>
				<td>{{$item->jabatan}}</td>
				<td class="text-center">{{ date('d/m/y', strtotime( $item->st_kasal_tgl_sp))}}</td>
				<td>{{$item->text_pendidikan_umum}}</td>
				<td>{{$item->text_pendidikan_militer}}</td> 
				@if($item->marriages->count() > 0)
				@php
				$marriage = $item->marriages->first();
				@endphp
				<td class="text-center">{{ !empty($marriage) ? $marriage->status . '/' . $marriage->total_child : '-' }}</td>
				@else
				<td class="text-center"> — </td>
				@endif
				<td class="text-center">{{$item->agama}}</td>
				<td class="text-center">{{$item->living_type}}</td>
				<td>{{$item->address}}</td>
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