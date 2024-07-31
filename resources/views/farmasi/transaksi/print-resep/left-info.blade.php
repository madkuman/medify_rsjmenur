<div style="padding-top: {{$transaksi->cito == 1 ? 20 : 5}}px">
	<table>
		<tr>
			<td style="width: 60%">
				<table class="text-center">
					<tr>
						<td>Tanda Tangan Penerima</td>
					</tr>
					<tr>
						<td class="text-center">
							@if(!empty($transaksi->img_ttd))
								<img src="{{public_path($transaksi->img_ttd)}}" height="50px">
							@else
								<div style="height: 10px"></div>
							@endif
						</td>
					</tr>
					@if (!empty($transaksi->nama_ttd))
					<tr>
						<td>({{$transaksi->nama_ttd ?? "_____________________"}})</td>
					</tr>				 
					@else
					<tr>
						<td style="padding-top: 30px">({{$transaksi->nama_ttd ?? "_____________________"}})</td>
					</tr>
					@endif
				</table>
			</td>
			{{-- <td>
				<table class="border font-8">
					<tr>
						<td>Kriteria</td>
						<td>Paraf</td>
					</tr>
					<tr>
						<td>Penerimaan</td>
						<td class="text-center">
							@if(!empty($transaksi->paid_by) && !empty($transaksi->paidBy->ttd))
								<img src="{{{url('')}}}/{{$transaksi->paidBy->ttd}}" height="10px">
							@else
								<div style="height: 10px"></div>
							@endif
						</td>
					</tr>
					<tr>
						<td>Penyiapan Obat Jadi</td>
						<td class="text-center">
							
						</td>
					</tr>
					<tr>
						<td>Penyiapan Racikan</td>
						<td class="text-center">

						</td>
					</tr>
					<tr>
						<td>Penyerahan</td>
						<td class="text-center">
							@if(!empty($transaksi->lima_benar_created_by) && !empty($transaksi->lima_benar_creator->ttd))
								<img src="{{{url('')}}}/{{$transaksi->lima_benar_creator->ttd}}" height="10px">
							@else
								<div style="height: 10px"></div>
							@endif
						</td>
					</tr>
				</table>
			</td> --}}
		</tr>
	</table>			
</div>