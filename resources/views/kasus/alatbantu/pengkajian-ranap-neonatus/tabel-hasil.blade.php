<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Informasi Umum</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Tanggal Datang ke RS</td>
				<td class="text-center">{{$res->tgl_kedatangan or '-'}}</td>
			</tr>
			<tr>
				<td>Jam</td>
				<td class="text-center">{{$res->jam_kedatangan or '-'}}</td>
			</tr>
			<tr>
				<td>Ruangan</td>
				<td class="text-center">{{$res->ruangan or '-'}}</td>
			</tr>
			<tr>
				<td>Agama</td>
				<td class="text-center">{{$res->agama or '-'}}</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td class="text-center">{{$res->alamat or '-'}}</td>
			</tr>
			<tr>
				<td>Tanggal Pengkajian</td>
				<td class="text-center">{{$res->tgl_pengkajian or '-'}}</td>
			</tr>
			<tr>
				<td>Jam</td>
				<td class="text-center">{{$res->jam_pengkajian or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Alergi / Reaksi</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Alergi Obat</td>
				<td class="text-center">{{$res->alergi_obat or '-'}}</td>
			</tr>
			<tr>
				<td>Reaksi Alergi Obat</td>
				<td class="text-center">{{$res->reaksi_obat or '-'}}</td>
			</tr>
			<tr>
				<td>Alergi Makanan</td>
				<td class="text-center">{{$res->alergi_makanan or '-'}}</td>
			</tr>
			<tr>
				<td>Reaksi Alergi Makanan</td>
				<td class="text-center">{{$res->reaksi_makanan or '-'}}</td>
			</tr>
			<tr>
				<td>Alergi Lain</td>
				<td class="text-center">{{$res->alergi_lain or '-'}}</td>
			</tr>
			<tr>
				<td>Reaksi Terhadap Alergi Diatas</td>
				<td class="text-center">{{$res->reaksi_terhadap_alergi or '-'}}</td>
			</tr>
			<tr>
				<td>Gelang Tanda Alergi</td>
				<td class="text-center">{{$res->gelang_tanda_alergi or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Keluhan</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Keluhan Utama Masuk Rumah Sakit</td>
				<td class="text-center">{{$res->keluhan or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Riwayat Kesehatan</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Diagnosis Perawatan Sebelumnya (Bila pernah)</td>
				<td class="text-center">{{$res->diagnosis_perawatan or '-'}}</td>
			</tr>
			<tr>
				<td>Tempat Perawatan</td>
				<td class="text-center">{{$res->tempat_perawatan or '-'}}</td>
			</tr>
			<tr>
				<td>Waktu Perawatan</td>
				<td class="text-center">{{$res->waktu_perawatan or '-'}}</td>
			</tr>
			<tr>
				<td>Riwayat Penyakit Mayor Keluarga</td>
				<td class="text-center">{{$res->riwayat_keluarga or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Riwayat Kehamilan</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Pemeriksaan Kehamilan (ANC)</td>
				<td class="text-center">{{$res->pemeriksaan_kehamilan or '-'}}</td>
			</tr>
			<tr>
				<td>Penggunaan Obat-obatan</td>
				<td class="text-center">{{$res->penggunaan_obat or '-'}}</td>
			</tr>
			<tr>
				<td>Konsumsi Tablet Fe</td>
				<td class="text-center">{{$res->konsumsi_tablet_fe or '-'}}</td>
			</tr>
			<tr>
				<td>Gangguan Kehamilan</td>
				<td class="text-center">{{$res->gangguan_kehamilan or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Riwayat Kelahiran</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Cara Lahir</td>
				<td class="text-center">{{$res->cara_lahir or '-'}}</td>
			</tr>
			<tr>
				<td>PB (cm)</td>
				<td class="text-center">{{$res->pb or '-'}}</td>
			</tr>
			<tr>
				<td>BBL (gr)</td>
				<td class="text-center">{{$res->BBL or '-'}}</td>
			</tr>
			<tr>
				<td>LK (cm)</td>
				<td class="text-center">{{$res->lk or '-'}}</td>
			</tr>
			<tr>
				<td>LD (cm)</td>
				<td class="text-center">{{$res->ld or '-'}}</td>
			</tr>
			<tr>
				<td>LL (cm)</td>
				<td class="text-center">{{$res->ll or '-'}}</td>
			</tr>
			<tr>
				<td>AS</td>
				<td class="text-center">{{$res->as or '-'}}</td>
			</tr>
			<tr>
				<td>Ketuban</td>
				<td class="text-center">{{$res->ketuban or '-'}}</td>
			</tr>
			<tr>
				<td>Keadaan Tali Pusat</td>
				<td class="text-center">{{$res->keadaan_tali_pusat or '-'}}</td>
			</tr>
			<tr>
				<td>Penyulit Persalinan</td>
				<td class="text-center">{{$res->penyulit_persalinan or '-'}}</td>
			</tr>
			<tr>
				<td>Obat-obatan yang digunakan selama persalinan</td>
				<td class="text-center">{{$res->obat_selama_persalinan or '-'}}</td>
			</tr>
			<tr>
				<td>Reflek</td>
				<td class="text-center">{{$res->reflek or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Pendaftaran</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Pemberian ASI (bila diberikan) hingga usia</td>
				<td class="text-center">{{$res->asi_hingga_usia or '-'}}</td>
			</tr>
			<tr>
				<td>Alasan apabila tidak diberikan ASI</td>
				<td class="text-center">{{$res->alasan_tidak_asi or '-'}}</td>
			</tr>
			<tr>
				<td>Penyakit Saat Neonatal</td>
				<td class="text-center">{{$res->penyakit_neonatal or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Riwayat Imunisasi</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>BCG</td>
				<td class="text-center">{{!empty($res->bcg) ? 'YA' : 'TIDAK'}}</td>
			</tr>
			<tr>
				<td>DPT</td>
				<td class="text-center">{{!empty($res->dpt) ? 'YA' : 'TIDAK'}}</td>
			</tr>
			<tr>
				<td>Hepatitis B</td>
				<td class="text-center">{{!empty($res->hepatitis_b) ? 'YA' : 'TIDAK'}}</td>
			</tr>
			<tr>
				<td>Polio</td>
				<td class="text-center">{{!empty($res->polio) ? 'YA' : 'TIDAK'}}</td>
			</tr>
			<tr>
				<td>Campak</td>
				<td class="text-center">{{!empty($res->campak) ? 'YA' : 'TIDAK'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Riwayat Psikososial</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Masalah Perilaku (bila ada)</td>
				<td class="text-center">{{$res->masalah_perilaku or '-'}}</td>
			</tr>
			<tr>
				<td>Perilaku Kekerasan yang dialami Pasien sebelumnya (bila ada)</td>
				<td class="text-center">{{$res->perilaku_kekerasan or '-'}}</td>
			</tr>
			<tr>
				<td>Hubungan Pasien dengan Anggota Keluarga</td>
				<td class="text-center">{{$res->hubungan_keluarga or '-'}}</td>
			</tr>
			<tr>
				<td>Tempat Tinggal</td>
				<td class="text-center">{{$res->tempat_tinggal or '-'}}</td>
			</tr>
			<tr>
				<td>Nama kerabat terdekat yang dapat dihubungi</td>
				<td class="text-center">{{$res->nama_kerabat or '-'}}</td>
			</tr>
			<tr>
				<td>Hubungan dengan kerabat tersebut</td>
				<td class="text-center">{{$res->hubungan_kerabat or '-'}}</td>
			</tr>
			<tr>
				<td>Nomor telepon kerabat</td>
				<td class="text-center">{{$res->telepon_kerabat or '-'}}</td>
			</tr>
			<tr>
				<td>Pekerjaan Orang Tua / Wali</td>
				<td class="text-center">{{$res->pekerjaan_ortu or '-'}}</td>
			</tr>
			<tr>
				<td>Penghasilan Orang Tua / Wali</td>
				<td class="text-center">{{$res->penghasilan_ortu or '-'}}</td>
			</tr>
			<tr>
				<td>Pendidikan Orang Tua / Wali</td>
				<td class="text-center">{{$res->pendidikan or '-'}}</td>
			</tr>
			<tr>
				<td>Budaya / Nilai Kepercayaan yang perlu diperhatikan (bila ada)</td>
				<td class="text-center">{{$res->budaya or '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Pemeriksaan Fisik</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>TD</td>
				<td class="text-center">{{$res->td or '-'}}</td>
			</tr>
			<tr>
				<td>Nadi per menit</td>
				<td class="text-center">{{$res->nadi or '-'}}</td>
			</tr>
			<tr>
				<td>P per menit</td>
				<td class="text-center">{{$res->p or '-'}}</td>
			</tr>
			<tr>
				<td>Suhu (dalam celcius)</td>
				<td class="text-center">{{$res->suhu or '-'}}</td>
			</tr>
			<tr>
				<td>SPO2</td>
				<td class="text-center">{{$res->spo2 or '-'}}</td>
			</tr>
			<tr>
				<td>PEWS</td>
				<td class="text-center">{{$res->pews or '-'}}</td>
			</tr>
			<tr>
				<td>Lingkar Kepala</td>
				<td class="text-center">{{$res->lingkar_kepala or '-'}}</td>
			</tr>
			<tr>
				<td>Berat Badan Sekarang</td>
				<td class="text-center">{{$res->bb_sekarang or '-'}}</td>
			</tr>
			<tr>
				<td>Berat Badan Sebelum Masuk RS</td>
				<td class="text-center">{{$res->bb_sebelum or '-'}}</td>
			</tr>
			<tr>
				<td>Antropometri TB</td>
				<td class="text-center">{{$res->antropometri_tb or '-'}}</td>
			</tr>
			<tr>
				<td>Antropometri LLA</td>
				<td class="text-center">{{$res->antropometri_lla or '-'}}</td>
			</tr>
			<tr>
				<td>Nafsu Makan</td>
				<td class="text-center">{{$res->nafsu_makan or '-'}}</td>
			</tr>
			<tr>
				<td>Pola Makan</td>
				<td class="text-center">{{$res->pola_makan or '-'}}</td>
			</tr>
			<tr>
				<td>Mual</td>
				<td class="text-center">{{$res->mual or '-'}}</td>
			</tr>
			<tr>
				<td>Frekuensi muntah (bila muntah)</td>
				<td class="text-center">{{$res->frekuensi_muntah or '-'}}</td>
			</tr>
			<tr>
				<td>Makanan Pantangan</td>
				<td class="text-center">{{$res->makanan_pantangan or '-'}}</td>
			</tr>
			<tr>
				<td>Jumlah Minum Susu Formula</td>
				<td class="text-center">{{$res->jumlah_minum_susu_formula or '-'}}</td>
			</tr>
			<tr>
				<td>NGT</td>
				<td class="text-center">{{$res->ngt or '-'}}</td>
			</tr>
			<tr>
				<td>Dot</td>
				<td class="text-center">{{$res->dot or '-'}}</td>
			</tr>
			<tr>
				<td>Sendok</td>
				<td class="text-center">{{$res->sendok or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Aktivitas Sehari-hari</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Durasi Tidur Siang</td>
				<td class="text-center">{{$res->tidur_siang or '-'}}</td>
			</tr>
			<tr>
				<td>Durasi Tidur Malam</td>
				<td class="text-center">{{$res->tidur_malam or '-'}}</td>
			</tr>
			<tr>
				<td>Durasi Aktivitas Lainnya</td>
				<td class="text-center">{{$res->aktivitas_lain or '-'}}</td>
			</tr>
			<tr>
				<td>Kebiasaan Saat/Akan Tidur</td>
				<td class="text-center">{{$res->kebiasaan_tidur or '-'}}</td>
			</tr>
			<tr>
				<td>Frekuensi Mandi</td>
				<td class="text-center">{{$res->frekuensi_mandi or '-'}}</td>
			</tr>
			<tr>
				<td>Frekuensi Menyikat Gigi</td>
				<td class="text-center">{{$res->frekuensi_menyikat_gigi or '-'}}</td>
			</tr>
			<tr>
				<td>Frekuensi Mencuci Rambut</td>
				<td class="text-center">{{$res->frekuensi_mencuci_rambut or '-'}}</td>
			</tr>
			<tr>
				<td>Frekuensi Ganti Pakaian</td>
				<td class="text-center">{{$res->frekuensi_ganti_pakaian or '-'}}</td>
			</tr>
			<tr>
				<td>Bermain</td>
				<td class="text-center">{{$res->bermain or '-'}}</td>
			</tr>
			<tr>
				<td>Pola Asuh</td>
				<td class="text-center">{{$res->pola_asuh or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Fisiologi Pernafasan</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Bentuk Dada</td>
				<td class="text-center">{{$res->bentuk_dada or '-'}}</td>
			</tr>
			<tr>
				<td>Frekuensi Nafas</td>
				<td class="text-center">{{$res->frekuensi_nafas or '-'}}</td>
			</tr>
			<tr>
				<td>Irama</td>
				<td class="text-center">{{$res->irama or '-'}}</td>
			</tr>
			<tr>
				<td>Retraksi Dada</td>
				<td class="text-center">{{$res->retraksi_dada or '-'}}</td>
			</tr>
			<tr>
				<td>Otot Bantu Pernafasan</td>
				<td class="text-center">{{$res->otot_bantu_pernafasan or '-'}}</td>
			</tr>
			<tr>
				<td>Bunyi Nafas</td>
				<td class="text-center">{{$res->bunyi_nafas or '-'}}</td>
			</tr>
			<tr>
				<td>Pernafasan Cuping Hidung</td>
				<td class="text-center">{{$res->pernafasan_cuping_hidung or '-'}}</td>
			</tr>
			<tr>
				<td>Letak Cyanosis (bila ada)</td>
				<td class="text-center">{{$res->cyanosis_pernafasan or '-'}}</td>
			</tr>
			<tr>
				<td>Perkusi</td>
				<td class="text-center">{{$res->perkusi or '-'}}</td>
			</tr>
			<tr>
				<td>Batuk Sputum</td>
				<td class="text-center">{{$res->batuk_sputum or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Fisiologi Sirkulasi</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Bunyi Jantung</td>
				<td class="text-center">{{$res->bunyi_jantung or '-'}}</td>
			</tr>
			<tr>
				<td>CRT</td>
				<td class="text-center">{{$res->crt or '-'}}</td>
			</tr>
			<tr>
				<td>Letak Cyanosis (bila ada)</td>
				<td class="text-center">{{$res->cyanosis_sirkulasi or '-'}}</td>
			</tr>
			<tr>
				<td>Clubbing Finger</td>
				<td class="text-center">{{$res->clubbing_finger or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Neurologi</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Kesadaran</td>
				<td class="text-center">{{$res->kesadaran or '-'}}</td>
			</tr>
			<tr>
				<td>Kejang</td>
				<td class="text-center">{{$res->kejang or '-'}}</td>
			</tr>
			<tr>
				<td>Tremor</td>
				<td class="text-center">{{$res->tremor or '-'}}</td>
			</tr>
			<tr>
				<td>Kaku Kuduk</td>
				<td class="text-center">{{$res->kaku_kuduk or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Eliminasi</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Bentuk Kelamin</td>
				<td class="text-center">{{$res->bentuk_kelamin or '-'}}</td>
			</tr>
			<tr>
				<td>Uretra</td>
				<td class="text-center">{{$res->uretra or '-'}}</td>
			</tr>
			<tr>
				<td>Scrotum</td>
				<td class="text-center">{{$res->scrotum or '-'}}</td>
			</tr>
			<tr>
				<td>Vagina</td>
				<td class="text-center">{{$res->vagina or '-'}}</td>
			</tr>
			<tr>
				<td>BAK</td>
				<td class="text-center">{{$res->bak or '-'}}</td>
			</tr>
			<tr>
				<td>Frekuensi BAK</td>
				<td class="text-center">{{$res->frekuensi_bak or '-'}}</td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td class="text-center">{{$res->jumlah_bak or '-'}}</td>
			</tr>
			<tr>
				<td>Warna BAK</td>
				<td class="text-center">{{$res->warna_bak or '-'}}</td>
			</tr>
			<tr>
				<td>Masalah BAK</td>
				<td class="text-center">{{$res->masalah_bak or '-'}}</td>
			</tr>
			<tr>
				<td>Penggunaan Alat Bantu</td>
				<td class="text-center">{{$res->penggunaan_alat_bantu or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Gastro Intestinal</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Mulut</td>
				<td class="text-center">{{$res->mulut or '-'}}</td>
			</tr>
			<tr>
				<td>Bibir</td>
				<td class="text-center">{{$res->bibir or '-'}}</td>
			</tr>
			<tr>
				<td>Lidah</td>
				<td class="text-center">{{$res->lidah or '-'}}</td>
			</tr>
			<tr>
				<td>Rongga Mulut</td>
				<td class="text-center">{{$res->rongga_mulut or '-'}}</td>
			</tr>
			<tr>
				<td>Nyeri Telan</td>
				<td class="text-center">{{$res->nyeri_telan or '-'}}</td>
			</tr>
			<tr>
				<td>Kembung</td>
				<td class="text-center">{{$res->kembung or '-'}}</td>
			</tr>
			<tr>
				<td>Luka</td>
				<td class="text-center">{{$res->luka or '-'}}</td>
			</tr>
			<tr>
				<td>Bising Usus</td>
				<td class="text-center">{{$res->bising_usus or '-'}}</td>
			</tr>
			<tr>
				<td>Anus Hemmoroid</td>
				<td class="text-center">{{$res->anus_hemmoroid or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Integumen</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Kulit</td>
				<td class="text-center">{{$res->kulit or '-'}}</td>
			</tr>
			<tr>
				<td>Turgor Kulit</td>
				<td class="text-center">{{$res->turgor_kulit or '-'}}</td>
			</tr>
			<tr>
				<td>Akral</td>
				<td class="text-center">{{$res->akral or '-'}}</td>
			</tr>
			<tr>
				<td>Kebersihan</td>
				<td class="text-center">{{$res->kebersihan or '-'}}</td>
			</tr>
			<tr>
				<td>Punggung</td>
				<td class="text-center">{{$res->punggung or '-'}}</td>
			</tr>
			<tr>
				<td>Area Luka/Lesi (bila ada)</td>
				<td class="text-center">{{$res->area_luka or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Kelainan Bawaan</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Tidak Ada</td>
				<td class="text-center">{{!empty($res->tidak_ada) ? 'YA' : 'TIDAK'}}</td>
			</tr>
			<tr>
				<td>Omphalocel</td>
				<td class="text-center">{{!empty($res->omphalocel) ? 'YA' : 'TIDAK'}}</td>
			</tr>
			<tr>
				<td>Gastroschizis</td>
				<td class="text-center">{{!empty($res->gastroschizis) ? 'YA' : 'TIDAK'}}</td>
			</tr>
			<tr>
				<td>Hisprung Disease</td>
				<td class="text-center">{{!empty($res->hisprung_disease) ? 'YA' : 'TIDAK'}}</td>
			</tr>
			<tr>
				<td>Atresia Ani</td>
				<td class="text-center">{{!empty($res->atresia_ani) ? 'YA' : 'TIDAK'}}</td>
			</tr>
			<tr>
				<td>Polidaktili</td>
				<td class="text-center">{{!empty($res->polidaktili) ? 'YA' : 'TIDAK'}}</td>
			</tr>
			<tr>
				<td>Sindaktili</td>
				<td class="text-center">{{!empty($res->sindaktili) ? 'YA' : 'TIDAK'}}</td>
			</tr>
			<tr>
				<td>CTEV</td>
				<td class="text-center">{{!empty($res->ctev) ? 'YA' : 'TIDAK'}}</td>
			</tr>
			<tr>
				<td>Down Syndrome</td>
				<td class="text-center">
					@if(!empty($res->down_syndrome))
					{{$res->down_syndrome ? 'YA' : TIDAK}}
					@else
					-
					@endif
				</td>
			</tr>
			<tr>
				<td>Caput Succedaneum</td>
				<td class="text-center">
					@if(!empty($res->caput_succedaneum))
					{{$res->caput_succedaneum ? 'YA' : 'TIDAK'}}
					@else
					-
					@endif
				</td>
			</tr>
			<tr>
				<td>Cephal Hematoma</td>
				<td class="text-center">
					@if(!empty($res->cephal_hematoma))
					{{$res->cephal_hematoma ? 'YA' : 'TIDAK'}}
					@else
					-
					@endif
				</td>
			</tr>
		</tbody>
	</table>
</div>