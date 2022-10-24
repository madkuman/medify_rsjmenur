<table>
	<tr>
		<td colspan="5">LAPORAN LAHIR MATI</td>
	</tr>
	<tr></tr>
	<tr>
		<td colspan="2">
			BULAN / TAHUN
		</td>
	</tr>
	<tr>
		<td colspan="2">RUMAH SAKIT</td>
	</tr>
	<tr></tr>
	<tr>
		<td rowspan="2">No</td>
		<td rowspan="2">Nama Bayu Yang Lahir Mati</td>
		<td rowspan="2">Nama Ayah</td>
		<td rowspan="2">Nama Ibu</td>
		<td rowspan="2">NIK Orang Tua (Ayah/Ibu)</td>
		<td rowspan="2">Alamat seusai KTP dan Domisili</td>
		<td rowspan="2">Usia Ibu</td>
		<td rowspan="2">Jenis Kelamin</td>
		<td rowspan="2">Usia kehamilan saat bayi lahir (minggu)</td>
		<td rowspan="2">Anak ke -</td>
		<td rowspan="2">Tanggal dan Jam Lahir Mati</td>
		<td rowspan="2">Penyebab Lahir Mati</td>
		<td rowspan="2">Tempat Meninggal</td>
		<td colspan="5">Asal Rujukan</td>
	</tr>
	<tr>
		<td>Puskesmas</td>
		<td>Klinik</td>
		<td>PBM</td>
		<td>dr./dr Sp.</td>
		<td>RS</td>
	</tr>
	<tr>
		@for($i=1; $i<=18; $i++)
		<td>{{ $i }}</td>
		@endfor
	</tr>
</table>