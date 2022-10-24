<div style="height: 370px;">
	@foreach($obat_page as $obat)
	R/ {{{$obat['nama_obat']}}} 
    
	@if($obat['tipe'] == 0) ({{{$obat['satuan']}}}), No {{{$obat['roman']}}} @endif <br>
	
	@foreach($obat['racikan'] as $racikan_detail)
		{{{$racikan_detail->nama_obat}}} ({{{$racikan_detail->jumlah}}})<br>
	@endforeach

    @if($obat['tipe'] == 1)
    ({{{$obat['satuan']}}}), No {{{$obat['roman']}}}<br>
    @endif
    
    @foreach($obat['aturan'] as $aturan)
    @if($loop->first)
    <span style="font-family: Dejavu Sans, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&int;</span> 
    @else
    <span style="font-family: Dejavu Sans, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
    @endif
    {{{$aturan}}}
    @if(!$loop->last)<br>@endif
    @endforeach
    <hr style="margin-top: 4px; margin-bottom: 4px">
	@endforeach
</div>