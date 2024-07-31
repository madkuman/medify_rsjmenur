<table>
	<tr>
		<td width="80%"> </td>
		<td class="bordered border-bottom-0 text-center">
			<span>RM.30.2</span>
		</td>
	</tr>
	<tr>
		<td width="80%"> </td>
		<td class="bordered border-bottom-0 text-center">
			<span><em>Halaman 1/1</em></span>
		</td>
	</tr>
</table>

<!-- HEADER -->
<table class="bordered border-bottom-0">
	<tr>
		<td width="60%" style="">
			<table>
				<tr>
					<td width="18%" style="text-align: right;">
						<img src="{{ url('') }}/assets/img/pemprov-jatim.png" height="55" loading="lazy">
					</td>
					<td width="62%" style="text-align: center; font-size: 11px;">
						<b>
							PEMERINTAH PROVINSI JAWA TIMUR<br>
							RUMAH SAKIT JIWA MENUR<br>
							Jl Menur No.120, Telp(031) 5021635-5021637<br>
							Surabaya
						</b>
					</td>
					<td width="20%" style="text-align: left;">
						<img src="{{ url('') }}/assets/img/menur.png" height="55" loading="lazy">
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<td><span>No. RM</span></td>
					<td width="2%"><span>:</span></td>
					<td> {{ optional($kasus->pasien)->no_rm }} </td>
				</tr>
				<tr>
					<td><span>Nama</span></td>
					<td><span>:</span></td>
					<td> {{ optional($kasus->pasien)->name }} </td>
				</tr>
				<tr>
					<td><span>Tgl lahir / umur</span></td>
					<td><span>:</span></td>
					<td> {{ optional($kasus->identitas)->tanggal }} / {{ optional($kasus->identitas)->age }} </td>
				</tr>
				<tr>
					<td><span>Jenis kelamin</span></td>
					<td><span>:</span></td>
					<td> {{ optional($kasus->pasien)->jenis_kelamin }}
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table class="bordered border-bottom-0">
	<tr>
		<td class="text-center">
			<h4>FORM B</h4>
			<h5>IMPLEMENTASI MANAJER PELAYANAN PASIEN (MPP)</h5>
		</td>
	</tr>
</table>

<table class="bordered border-bottom-0 py-2">
	<tr>
		<td width="20%">Diagnosa Medis</td>
		<td width="2%">:</td>
		<td class="diagnosa-medis"></td>
	</tr>

	<tr>
		<td>MPP</td>
		<td>:</td>
		<td class="mpp"></td>
	</tr>
</table>

<table class="bordered-full">
	<tr class="text-center">
		<th width="20%">TANGGAL/JAM</th>
		<th width="20%">IMPLEMENTASI</th>
		<th>EVALUASI</th>
		<th>PARAF</th>
	</tr>
	@foreach ($data_asesmen as $index => $item)
		<tr>
			<td><span class="datahasil-tgl"></span> <span class="datahasil-jam"></span></td>
			<td>{{ $item }}</td>
			<td class="datahasil-evaluasi"></td>
			<td class="datahasil-paraf"></td>
		</tr>
	@endforeach
	
</table>
<small>RSJM / Revisi 00 / 08.2018</small>