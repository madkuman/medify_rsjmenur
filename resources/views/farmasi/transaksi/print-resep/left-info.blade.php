<div style="height: 100px;padding-top: {{$transaksi->cito == 1 ? 30 : 5}}px">
	<table>
		<tr>
			<td style="width: 60%">
				<table class="text-center">
					<tr>
						<td>Tanda Tangan Penerima</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>(_____________________)</td>
					</tr>
					<tr>
						<td>Nama Terang</td>
					</tr>
				</table>
			</td>
			<td>
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
			</td>
		</tr>
	</table>			
</div>