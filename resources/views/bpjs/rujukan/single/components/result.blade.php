<table>
	<tr>
		<td style="width: 150px">Nomor Rujukan</td>
		<td style="width: 10px">:</td>
		<td><span id="nomor_rujukan">{{$no_rujukan}}</span></td>
	</tr>
	<tr>
		<td>Tanggal Rujukan</td>
		<td>:</td>
		<td><span id="tanggal_rujukan">{{$tanggal_rujuk}}</span></td>
	</tr>
	<tr>
		<td>Tipe Pelayanan</td>
		<td>:</td>
		<td><span id="pelayanan">{{$result->jenis_rujuk == 1 ? 'Rawat Inap' : 'Rawat Jalan'}}</span></td>
	</tr>
	<tr>
		<td>Tipe</td>
		<td>:</td>
		<td><span id="tipe">{{$result->tipe_rujuk == 0 ? 'Penuh' : ($result->tipe_rujuk == 1 ? 'Partial' : 'Rujuk Balik')}}</span></td>
	</tr>
	<tr>
		<td>Diagnosa Rujukan</td>
		<td>:</td>
		<td><span id="diagnosa">{{$diagnosa}}</span></td>
	</tr>
	<tr>
		<td>Di Rujuk Ke</td>
		<td>:</td>
		<td><span id="provPerujuk">{{$result->faskes}}</span></td>
	</tr>
	<tr>
		<td>Spesialis/SubSpesialis</td>
		<td>:</td>
		<td><span id="poliRujukan">{{$result->nama_poli_rujukan}}</span></td>
	</tr>
</table>