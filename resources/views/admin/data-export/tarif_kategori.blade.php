<table>
	@foreach($tarif_kategori as $tarif_kategori_item)
	<tr>
		@foreach($tarif_kategori_item as $row)
		<td>{{$row}}</td>
		@endforeach
	</tr>
	@endforeach
</table>