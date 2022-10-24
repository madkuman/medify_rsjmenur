
<table style="width: 100%">
	<tr>
		<td style="width: 50%"><p class="h6 my-0 mb-10">PERMINTAAN OLEH</p></td>
	</tr>
	<tr>
		<td>
			@if(empty($transaksi->kasus_id))
			{{$transaksi->nama_rs ?? config('app.name')}} - 
			{{$transaksi->nama_dokter ?? $transaksi->creator['name']}}
			@else
			{{$transaksi->kasus->dpjp->user->name ?? $transaksi->creator['name']}}
			@endif	
		</td>
	</tr>
	<tr>
		<td>
			{{$transaksi->created_at->format('d F Y, H:i')}}
		</td>
	</tr>
</table>