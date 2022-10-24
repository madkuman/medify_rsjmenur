<table>
	<tr>
		<td colspan="19" align="center"><b>REALISASI PENGADAAN {{config('app.name')}}</b></td>
	</tr>
	<tr>
		<td colspan="19" align="center">PERIODE : {{strtoupper(indonesian_date($start_date))}} S/D {{strtoupper(indonesian_date($end_date))}}</td>
	</tr>
	<tr>
		<td colspan="19"></td>
	</tr>
	@php 
		$no = 1; 
		$total_po = 0; 
		$grandtotal = 0; 
		$grandpaid = 0; 
		$grandsisa = 0; 
		$total_po_terbayar = 0; 
		$total_po_sisa = 0; 
		$jenis = "Semua"; 
	@endphp

	@foreach($po as $i => $item)
	@if($jenis != $item->jenis_po)
	@php $jenis = $item->jenis_po @endphp
	
	@if($i > 0)
	@include('keuangan.laporan.po.print-component-total')
	@php $total_po = 0; $total_po_terbayar = 0;$total_po_sisa = 0; @endphp
	
	@endif
	
	<tr>
		@if($jenis == "Farmasi")
		<th class="bordered align-left" colspan="19"><strong>Jenis: Bekkes</strong></th>
		@elseif($jenis == "Umum")
		<th class="bordered align-left" colspan="19"><strong>Jenis: Bekkum</strong></th>
		@else
		<th class="bordered align-left" colspan="19"><strong>Jenis: Konstruksi</strong></th>
		@endif
	</tr>
	
	<tr>
		<th class="bordered" rowspan="2"><strong>No</strong></th>
		<th class="bordered" rowspan="2"><strong>No PO</strong></th>
		<th class="bordered" rowspan="2"><strong>Tgl PO</strong></th>
		<th class="bordered" rowspan="2"><strong>Penyedia</strong></th>
		<th class="bordered" rowspan="2"><strong>Nama Barang</strong></th>
		<th class="bordered" rowspan="2"><strong>Sat</strong></th>
		<th class="bordered" rowspan="2"><strong>Jml</strong></th>
		<th class="bordered" rowspan="2"><strong>Harga Sat</strong></th>
		<th class="bordered" rowspan="2"><strong>Disc.</strong></th>
		<th class="bordered" rowspan="2"><strong>Jml Harga</strong></th>
		<th class="bordered" rowspan="2"><strong>Jml Total PO</strong></th>
		<th class="bordered" rowspan="2"><strong>No Faktur</strong></th>
		<th class="bordered" rowspan="2"><strong>Tgl Faktur</strong></th>
		<th class="bordered" rowspan="2"><strong>Tgl Input Faktur</strong></th>
		<th class="bordered" rowspan="2"><strong>No SPP</strong></th>
		<th class="bordered" colspan="2"><strong>Buku Kas</strong></th>
		<th class="bordered" rowspan="2"><strong>Input Simak</strong></th>
		<th class="bordered" rowspan="2"><strong>Ket.</strong></th>
	</tr>
	<tr>
		<th class="bordered"><strong>Terbayar</strong></th>
		<th class="bordered"><strong>Sisa</strong></th>
	</tr>
	@endif

	@php $total_po += $item->total; $grandtotal += $item->total @endphp

	@foreach($item->detail as $j => $detail)
	<tr>
		@if($j == 0)
		<td class="content bordered" rowspan="{{count($item->detail)}}">{{$no++}}</td>
		<td class="content bordered" rowspan="{{count($item->detail)}}">{{$item->no_po}}</td>
		<td class="content bordered" rowspan="{{count($item->detail)}}">{{indonesian_date($item->tanggal_po)}}</td>
		<td class="content bordered" rowspan="{{count($item->detail)}}">{{$item->perusahaan->nama ?? '-'}}</td>
		@endif
		<td class="content bordered">{{$detail->deskripsi}}</td>
		<td class="content bordered">{{$detail->keterangan}}</td>
		<td class="content bordered">{{number_format($detail->jumlah,0)}}</td>
		<td class="content bordered">{{number_format($detail->harga,0)}}</td>
		<td class="content bordered">{{number_format($detail->diskon,0)}}</td>
		<td class="content bordered">{{number_format($detail->subtotal,0)}}</td>
		@if($j == 0)
		<td class="content bordered" rowspan="{{count($item->detail)}}">{{number_format($item->total)}}</td>
		<td class="content bordered" rowspan="{{count($item->detail)}}">
			@forelse($item->penerimaan as $key => $penerimaan)
			{{$key+1}}. {{$penerimaan->no_faktur}}
			@if($key+1 < count($item->penerimaan))
			<br>
			@endif
			@empty
			@endforelse
		</td>
		<td class="content bordered" rowspan="{{count($item->detail)}}">
			@forelse($item->penerimaan as $key => $penerimaan)
			{{$key+1}}. {{date('j/n/Y', strtotime($penerimaan->tanggal_faktur))}}
			@if($key+1 < count($item->penerimaan))
			<br>
			@endif
			@empty
			@endforelse
		</td>
		<td class="content bordered" rowspan="{{count($item->detail)}}">
			@forelse($item->penerimaan as $key => $penerimaan)
			{{$key+1}}. {{date('j/n/Y', strtotime($penerimaan->created_at))}}
			@if($key+1 < count($item->penerimaan))
			<br>
			@endif
			@empty
			@endforelse
		</td>
		<td class="content bordered" rowspan="{{count($item->detail)}}">
			@php $paid = 0 @endphp
			@php $total_sisa = 0 @endphp

			@forelse($item->penerimaan as $key => $penerimaan)
			{{$key+1}}. {{$penerimaan->no_spp}}
			@if($key+1 < count($item->penerimaan))
			<br>
			@endif

			@php $paid += $penerimaan->total_paid @endphp
			@php $total_sisa += $penerimaan->total @endphp
			@empty
			@endforelse
		</td>
		<td class="content bordered" rowspan="{{count($item->detail)}}">{{number_format($paid,0)}}</td>
		<td class="content bordered" rowspan="{{count($item->detail)}}">{{number_format($total_sisa - $paid,0)}}</td>
		<td class="content bordered" rowspan="{{count($item->detail)}}"></td>
		<td class="content bordered" rowspan="{{count($item->detail)}}"></td>
		@endif
	</tr>
	@endforeach

	@php 
		$total_po_terbayar += $paid; 
		$grandpaid += $paid;
		$total_po_sisa += $total_sisa - $paid; 
		$grandsisa += $total_sisa - $paid;
	@endphp

	@endforeach
	@include('keuangan.laporan.po.print-component-total')
	<tr>
		<td colspan="4" class="bordered righted">Grand Total</td>
		<td colspan="4" class="bordered"><strong>Rp {{number_format($grandtotal,0)}}</strong></td>
	</tr>
	<tr>
		<td colspan="4" class="bordered righted">Terbayar</td>
		<td colspan="4" class="bordered"><strong>Rp {{number_format($grandpaid)}}</strong></td>
	</tr>
	<tr>
		<td colspan="4" class="bordered righted">Sisa</td>
		<td colspan="4" class="bordered"><strong>Rp {{number_format($grandsisa)}}</strong></td>
	</tr>
</table>