<div style="height: 300px;line-height: 8.8px">
    <br>
	@foreach($obat_page as $obat)
	R/ {{{$obat['nama_obat']}}} 
    
	@if($obat['tipe'] == 0) ({{{$obat['satuan']}}}), No {{{$obat['roman']}}} @endif <br>

    <!-- apabila obat ada kategorinya -->
    @if (!empty($obat['kategori_slug']) && str_contains($obat['kategori_slug'], 'narkotika'))
        @php $show_label_high_alert = true; @endphp
        <hr style="color: red !important; width: 100px; display: inline-block; margin-left: 0px; margin-top: 0px">
    @elseif(!empty($obat['kategori_slug']) && str_contains($obat['kategori_slug'], 'psiktropika'))
        @php $show_label_high_alert = true; @endphp
        <hr style="color: blue !important; width: 100px; display: inline-block; margin-left: 0px; margin-top: 0px">
    @elseif(!empty($obat['kategori_slug']) && str_contains($obat['kategori_slug'], 'obat-obat-tertentu'))
        @php $show_label_high_alert = true; @endphp
        <hr style="color: black !important; width: 100px; display: inline-block; margin-left: 0px; margin-top: 0px">
    @endif
	
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
    <hr>
	@endforeach
</div>