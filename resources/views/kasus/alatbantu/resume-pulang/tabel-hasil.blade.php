<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Kondisi Pasien</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Suhu</td>
				<td class="text-center">{{$res->suhu or '-'}}</td>
			</tr>
			<tr>
				<td>Nadi</td>
				<td class="text-center">{{$res->nadi or '-'}}</td>
			</tr>
			<tr>
				<td>RR</td>
				<td class="text-center">{{$res->rr or '-'}}</td>
			</tr>
			<tr>
				<td>TD</td>
				<td class="text-center">{{$res->td or '-'}}</td>
			</tr>
			<tr>
				<td>Diet / Nutrisi : Oral</td>
				<td class="text-center">{{!empty($res->oral) ? 'Ya' : '-'}}</td>
			</tr>
			<tr>
				<td>Diet / Nutrisi : NGT</td>
				<td class="text-center">{{!empty($res->ngt) ? 'Ya' : '-'}}</td>
			</tr>
			<tr>
				<td>Diet Khusus</td>
				<td class="text-center">{{$res->diet_khusus or '-'}}</td>
			</tr>
			<tr>
				<td>Batasan Cairan</td>
				<td class="text-center">{{$res->batasan_cairan or '-'}}</td>
			</tr>
			<tr>
				<td>BAB</td>
				<td class="text-center">{{$res->bab or '-'}}</td>
			</tr>
			<tr>
				<td>BAK</td>
				<td class="text-center">{{$res->bak or '-'}}</td>
			</tr>
			<tr>
				<td>Tanggal Pemasangan Kateter Terakhir (bila ada)</td>
				<td class="text-center">{{$res->kateter or '-'}}</td>
			</tr>
			<tr>
				<td>Luka / Luka Operasi</td>
				<td class="text-center">{{!empty($res->luka) ? str_replace(",", ", ", $res->luka) : '-'}}</td>
			</tr>
			<tr>
				<td>Cairan Luka (bila ada)</td>
				<td class="text-center">{{$res->cairan_luka or '-'}}</td>
			</tr>
			<tr>
				<td>Transfer dan Mobilisasi</td>
				<td class="text-center">{{$res->transfer or '-'}}</td>
			</tr>
			<tr>
				<td>Alat Bantu</td>
				<td class="text-center">{{$res->alat_bantu or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Kondisi Khusus Pasien Kebidanan</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Kontraksi Uterus</td>
				<td class="text-center">{{$res->uterus or '-'}}</td>
			</tr>
			<tr>
				<td>Tinggi Fundus Uteri</td>
				<td class="text-center">{{$res->fundus_uteri or '-'}}</td>
			</tr>
			<tr>
				<td>Vulva</td>
				<td class="text-center">{{$res->vulva or '-'}}</td>
			</tr>
			<tr>
				<td>Lochea</td>
				<td class="text-center">{{$res->lochea or '-'}}</td>
			</tr>
			<tr>
				<td>Warna</td>
				<td class="text-center">{{$res->warna or '-'}}</td>
			</tr>
			<tr>
				<td>Bau</td>
				<td class="text-center">{{$res->bau or '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Edukasi / Penyuluhan Kesehatan yang sudah diberikan</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Penyakit dan pengobatannya</td>
				<td class="text-center">{{!empty($res->penyakit) ? 'Ya' : '-'}}</td>
			</tr>
			<tr>
				<td>Mengatasi Nyeri</td>
				<td class="text-center">{{!empty($res->mengatasi_nyeri) ? 'Ya' : '-'}}</td>
			</tr>
			<tr>
				<td>Persiapan lingkungan dan fasilitas untuk perawatan di rumah</td>
				<td class="text-center">{{!empty($res->persiapan_lingkungan) ? 'Ya' : '-'}}</td>
			</tr>
			<tr>
				<td>Perawatan di rumah</td>
				<td class="text-center">{{!empty($res->perawatan_rumah) ? 'Ya' : '-'}}</td>
			</tr>
			<tr>
				<td>Perawatan luka</td>
				<td class="text-center">{{!empty($res->perawatan_luka) ? 'Ya' : '-'}}</td>
			</tr>
			<tr>
				<td>Perawatan ibu dan bayi</td>
				<td class="text-center">{{!empty($res->perawatan_ibu) ? 'Ya' : '-'}}</td>
			</tr>
			<tr>
				<td>Nasehat Keluarga Berencana</td>
				<td class="text-center">{{!empty($res->nasehat) ? 'Ya' : '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Diagnosa dan Anjuran</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Diagnosa Keperawatan selama dirawat</td>
				<td class="text-center">{{$res->diagnosa_keperawatan or '-'}}</td>
			</tr>
			<tr>
				<td>Anjuran Keperawatan khusus setelah pulang</td>
				<td class="text-center">{{$res->anjuran_keperawatan or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Manajemen Nyeri</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Obat yang diminum / anti nyeri</td>
				<td class="text-center">{{$res->obat_diminum or '-'}}</td>
			</tr>
			<tr>
				<td>Efek samping yang mungkin timbul</td>
				<td class="text-center">{{$res->efek_samping or '-'}}</td>
			</tr>
			<tr>
				<td>Bila nyeri bertambah berat segera ke RS</td>
				<td class="text-center">{{$res->nyeri_bertambah or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Barang dan hasil pemeriksaan yang diserahkan pasien / keluarga</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Hasil laborat (jumlah lembar)</td>
				<td class="text-center">{{$res->hasil_laborat or '-'}}</td>
			</tr>
			<tr>
				<td>Foto Rontgen (jumlah lembar)</td>
				<td class="text-center">{{$res->rontgen or '-'}}</td>
			</tr>
			<tr>
				<td>CT Scan (jumlah lembar)</td>
				<td class="text-center">{{$res->ct_scan or '-'}}</td>
			</tr>
			<tr>
				<td>MRI / MRA (jumlah lembar)</td>
				<td class="text-center">{{$res->mri or '-'}}</td>
			</tr>
			<tr>
				<td>Hasil USG (jumlah lembar)</td>
				<td class="text-center">{{$res->usg or '-'}}</td>
			</tr>
			<tr>
				<td>Surat Keterangan Sakit (jumlah lembar)</td>
				<td class="text-center">{{$res->sk_sakit or '-'}}</td>
			</tr>
			<tr>
				<td>Surat Asuransi</td>
				<td class="text-center">{{!empty($res->asuransi) ? 'Ya' : '-'}}</td>
			</tr>
			<tr>
				<td>Resume Pasien Pulang</td>
				<td class="text-center">{{!empty($res->resume) ? 'Ya' : '-'}}</td>
			</tr>
			<tr>
				<td>Buku Bayi</td>
				<td class="text-center">{{!empty($res->buku_bayi) ? 'Ya' : '-'}}</td>
			</tr>
			<tr>
				<td>Kartu Golongan Darah Bayi</td>
				<td class="text-center">{{!empty($res->kartu_goldar) ? 'Ya' : '-'}}</td>
			</tr>
			<tr>
				<td>Surat Keterangan Lahir</td>
				<td class="text-center">{{!empty($res->sk_lahir) ? 'Ya' : '-'}}</td>
			</tr>
			<tr>
				<td>Barang Lain-lain</td>
				<td class="text-center">{{$res->barang_lain2 or '-'}}</td>
			</tr>
			<tr>
				<td>Obat yang dibawa</td>
				<td class="text-center">{{$res->obat_dibawa or '-'}}</td>
			</tr>
			<tr>
				<td>Bayi diserahkan oleh</td>
				<td class="text-center">{{$res->bayi_diserahkan or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Rencana Kontrol Selanjutnya</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Tanggal</td>
				<td class="text-center">{{$res->tgl_kontrol or '-'}}</td>
			</tr>
			<tr>
				<td>Jam</td>
				<td class="text-center">{{$res->jam_kontrol or '-'}}</td>
			</tr>
			<tr>
				<td>Klinik yang dituju</td>
				<td class="text-center">{{$res->klinik or '-'}}</td>
			</tr>
			<tr>
				<td>Bagian</td>
				<td class="text-center">{{$res->bagian or '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-6">
</div>