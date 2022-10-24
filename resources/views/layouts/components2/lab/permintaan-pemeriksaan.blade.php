<div class="col-lg-6 col-12 p-10 mb-10">
	<div class="border p-10" style="height: 100%">
		<p class="h6 my-0 mb-10">PERMINTAAN PEMERIKSAAN</p>
		<table class="mb-30">
			@foreach($transaksi->detail as $detail)
			<tr>
				<td>- {{$detail->tarif->deskripsi}}</td>
			</tr>
			@endforeach
		</table>
		@include('layouts.components2.lab.permintaan-oleh')
	</div>
</div>