<table>
	<tr>
		<td>id</td>
		<td>nama</td>
		<td>jenis</td>
		<td>satuan</td>
		<td>harga</td>
		<td>limit_warning_expired</td>
		<td>limit_warning_stok</td>
		<td>kategori</td>
		<td>kandungan</td>
	</tr>
	@foreach($obat as $item)
	<tr>
		<td>{{$item->id ?? ''}}</td>
		<td>{{$item->nama ?? ''}}</td>
		<td>{{$item->jenis ?? ''}}</td>
		<td>{{$item->satuan ?? ''}}</td>
		<td>{{$item->harga ?? ''}}</td>
		<td>{{$item->min_kadaluarsa ?? ''}}</td>
		<td>{{$item->min_stok ?? ''}}</td>
		<td>
		@php $first = 1 @endphp
		@foreach($item->kategori_item as $kategori_item)
			@php
				$kandungan = $kategori_item->detail_kategori->is_kandungan ?? 0;
			@endphp
			@if(!$kandungan)
				@if(!$first),@endif
				{{$kategori_item->detail_kategori->nama ?? ''}}
				@php $first = 0 @endphp
			@endif
		@endforeach
		</td>
		<td>
		@php $first = 1 @endphp
		@foreach($item->kategori_item as $kategori_item)
			@php
				$kandungan = $kategori_item->detail_kategori->is_kandungan ?? 0;
			@endphp
			@if($kandungan)
				@if(!$first),@endif
				{{$kategori_item->detail_kategori->nama ?? ''}}
				@php $first = 0 @endphp
			@endif
		@endforeach
		</td>
	</tr>
	@endforeach
</table>