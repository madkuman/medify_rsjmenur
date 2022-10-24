<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pemakaian Obat Dukungan</title>
	<style type="text/css">
		body{
			font-family: sans-serif;
		}
		table{
			width: 100%;
			border-collapse: collapse;
		}
		table td, table th{
			padding-left: 5px;
			padding-right: 5px;
		}
		.bordered td, .bordered th{
			border: 1px solid black
		}
		.centered{
			text-align: center;
		}
		.righted{
			text-align: right;
		}
		.no_bottom{
			border-bottom: hidden !important;
		}
		.no_top{
			border-top: hidden !important;
		}
		.no_vertical{
			border-top: hidden !important;
			border-bottom: hidden !important;
		}
		.td-bordered{
			border: 1px solid black !important
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td class="centered">LAPORAN PEMAKAIAN OBAT DUKUNGAN</td>
		</tr>
		<tr>
			<td class="centered" style="text-transform: capitalize;">BULAN {{$bulan}}</td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<thead>
			<tr>
				<th width="5%" class="td-bordered">No</th>
				<th width="15%" class="td-bordered">Tgl</th>
				<th width="20%" class="td-bordered">Nama Pasien</th>
				<th width="13%" class="td-bordered">No Resep</th>
				<th width="25%" class="td-bordered">Nama Obat</th>
				<th width="7%" class="td-bordered">Jumlah</th>
				<th width="15%" class="td-bordered">Total</th>
			</tr>
		</thead>
		<tbody>
			@php $i = 1; $total = 0; @endphp
			@foreach($transaksi as $trans)
			@php($racikan = $trans->final_detail->resep_detail[0]->tipe )
			<tr @if($racikan) class="no_bottom" @endif>
				<td>{{$i++}}</td>
				<td>{{indonesian_date($trans->created_at)}}</td>
				<td>{{$trans->pasien_detail->name ?? $trans->nama_pasien ?? 'Pasien Bebas'}}</td>
				<td>{{$trans->final_detail->nomor_resep}}</td>
				<td>{{$trans->final_detail->resep_detail[0]->nama_obat}}</td>
				@if($trans->final_detail->resep_detail[0]->tipe)
				<td>{{$trans->final_detail->resep_detail[0]->jumlah}}</td>
				@else
				@if(isset($trans->final_detail->resep_detail[0]->logLast))
				<td>{{$trans->final_detail->resep_detail[0]->logLast->jumlah 
						- ($trans->final_detail->resep_detail[0]->logLast->jumlah_retur ?? 0)}}
				</td>
				@else
				<td>{{$trans->final_detail->resep_detail[0]->jumlah}}</td>
				@endif
				@endif
				@php($total+=$trans->total_biaya_obat)
				<td class="righted">{{number_format($trans->total_biaya_obat)}}</td>
			</tr>
				@foreach($trans->final_detail->resep_detail as $key => $detail)
					@php($last_detail = $key == count($trans->final_detail->resep_detail) -1)
					@if($key == 0 && !$detail->tipe) 
						@continue 
					@elseif($key != 0)
						<tr>
							<td  @if($last_detail) class="no_top" @else class="no_vertical" @endif></td>
							<td  @if($last_detail) class="no_top" @else class="no_vertical" @endif></td>
							<td  @if($last_detail) class="no_top" @else class="no_vertical" @endif></td>
							<td  @if($last_detail) class="no_top" @else class="no_vertical" @endif></td>
							<td class="td-bordered">{{$detail->nama_obat}}</td>
							@if($detail->tipe)
								<td class="td-bordered">{{$detail->jumlah}}</td>
							@else
								@if(isset($trans->final_detail->resep_detail[0]->logLast))
								<td>{{$trans->final_detail->resep_detail[0]->logLast->jumlah 
										- ($trans->final_detail->resep_detail[0]->logLast->jumlah_retur ?? 0)}}
								</td>
								@else
								<td>{{$trans->final_detail->resep_detail[0]->jumlah}}</td>
								@endif
							@endif
							<td  @if($last_detail) class="no_top" @else class="no_vertical" @endif></td>
						</tr>
					@endif
					@if($detail->tipe)
						@foreach($detail->log as $key2 => $log)
						@php($last_log_detail = $last_detail && $key2 == count($detail->log) -1)
						<tr>
							<td @if($last_log_detail) class="no_top" @else class="no_vertical" @endif></td>
							<td @if($last_log_detail) class="no_top" @else class="no_vertical" @endif></td>
							<td @if($last_log_detail) class="no_top" @else class="no_vertical" @endif></td>
							<td @if($last_log_detail) class="no_top" @else class="no_vertical" @endif></td>
							<td @if($last_log_detail) class="no_top" @else class="no_vertical" @endif>&nbsp;&nbsp;&nbsp;- {{$log->detail_item->detail_item->item_detail->nama}} ({{$log->jumlah - ($log->jumlah_retur ?? 0)}})</td>
							<td @if($last_log_detail) class="no_top" @else class="no_vertical" @endif></td>
							<td @if($last_log_detail) class="no_top" @else class="no_vertical" @endif></td>
						</tr>
						@endforeach
					@endif
				@endforeach
			@endforeach
			<tr>
				<td class="righted" colspan="6">T O T A L</td>
				<td class="righted">{{number_format($total)}}</td>
			</tr>
		</tbody>
	</table>
</body>
</html>