<table class="vertical-align-top font-8 text-left">
	<tr>
		<td style="width: 50%">
			<table class="vertical-align-top font-8 text-left">
				<tr>
					<td style="width: 40%">Klinik / Ruang</td>
					<td style="width: 2%">:</td>
					<td>{{$transaksi->lokasi->nama ?? '-'}}</td>
				</tr>
				<tr>
					<td>Nama Dokter</td>
					<td>:</td>
					<td>{{$dokter}}</td>
				</tr>
				<tr>
					<td>SIP</td>
					<td>:</td>
					<td>{{ $sip_dokter ?? "-" }}</td>
				</tr>
				<tr>
					<td>No Resep</td>
					<td>:</td>
					<td>{{$transaksi->final_detail->nomor_resep ?? '-'}}</td>
				</tr>
			</table>
		</td>
		<td style="width: 50%">
			<table class="vertical-align-top font-8 text-left">
				<tr>
					<td style="width: 40%">Tanggal</td>
					<td style="width: 2%">:</td>
					<td>{{$transaksi->created_at->format('d-m-Y')}}</td>
				</tr>
				<tr>
					<td>TTD Dokter</td>
					<td>:</td>
					<td style="padding:3px">
						<div style="border:solid 1px #000;height: 40px;padding-top: 2px; text-align: center"> 
							@if(!empty($dokter_ttd))
							<img src="{{ public_path($dokter_ttd) }}" height="36px">
							@endif
						</div>
					</td>
				</tr>	
			</table>
		</td>
	</tr>
</table>