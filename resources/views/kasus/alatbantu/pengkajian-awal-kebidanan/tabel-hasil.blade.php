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
				<td class="text-center">{{$res->tgl_kedatangan ?? "-" }}</td>
			</tr>
			<tr>
				<td>Jam</td>
				<td class="text-center">{{$res->jam_kedatangan ?? "-" }}</td>
			</tr>
			<tr>
				<td>Ruangan</td>
				<td class="text-center">{{$res->ruangan ?? "-" }}</td>
			</tr>
			<tr>
				<td>Agama</td>
				<td class="text-center">{{$res->agama ?? "-" }}</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td class="text-center">{{$res->alamat ?? "-" }}</td>
			</tr>
			<tr>
				<td>Tanggal Pengkajian</td>
				<td class="text-center">{{$res->tgl_pengkajian ?? "-" }}</td>
			</tr>
			<tr>
				<td>Jam</td>
				<td class="text-center">{{$res->jam_pengkajian ?? "-" }}</td>
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
				<td class="text-center">{{$res->alergi_obat ?? "-" }}</td>
			</tr>
			<tr>
				<td>Reaksi Alergi Obat</td>
				<td class="text-center">{{$res->reaksi_obat ?? "-" }}</td>
			</tr>
			<tr>
				<td>Alergi Makanan</td>
				<td class="text-center">{{$res->alergi_makanan ?? "-" }}</td>
			</tr>
			<tr>
				<td>Reaksi Alergi Makanan</td>
				<td class="text-center">{{$res->reaksi_makanan ?? "-" }}</td>
			</tr>
			<tr>
				<td>Alergi Lain</td>
				<td class="text-center">{{$res->alergi_lain ?? "-" }}</td>
			</tr>
			<tr>
				<td>Reaksi Terhadap Alergi Diatas</td>
				<td class="text-center">{{$res->reaksi_alergi ?? "-" }}</td>
			</tr>
			<tr>
				<td>Gelang Tanda Alergi Dipasang (Warna Merah)</td>
				<td class="text-center">{{$res->gelang_alergi ?? "-" }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Riwayat / Pola Hidup</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Keluhan Utama</td>
				<td class="text-center">{{$res->keluhan ?? "-" }}</td>
			</tr>
			<tr>
				<td>Riwayat Penyakit Sekarang</td>
				<td class="text-center">{{$res->riwayat_sekarang ?? "-" }}</td>
			</tr>
			<tr>
				<td>Riwayat Kesehatan Masa Lalu : Kardiovaskuler</td>
				<td class="text-center">{{$res->kardiovaskuler ?? "-" }}</td>
			</tr>
			<tr>
				<td>Riwayat Kesehatan Masa Lalu : Hipertensi</td>
				<td class="text-center">{{$res->hipertensi ?? "-" }}</td>
			</tr>
			<tr>
				<td>Riwayat Kesehatan Masa Lalu : Diabetes</td>
				<td class="text-center">{{$res->diabetes ?? "-" }}</td>
			</tr>
			<tr>
				<td>Riwayat Kesehatan Masa Lalu : Malaria</td>
				<td class="text-center">{{$res->malaria ?? "-" }}</td>
			</tr>
			<tr>
				<td>Riwayat Kesehatan Masa Lalu : Penyakit Kelamin / HIV / AIDS</td>
				<td class="text-center">{{$res->kelamin ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pernah Dirawat</td>
				<td class="text-center">{{$res->pernah_dirawat ?? "-" }}</td>
			</tr>
			<tr>
				<td>Sebab Dirawat</td>
				<td class="text-center">{{$res->sebab_dirawat ?? "-" }}</td>
			</tr>
			<tr>
				<td>Tempat Dirawat</td>
				<td class="text-center">{{$res->tempat_dirawat ?? "-" }}</td>
			</tr>
			<tr>
				<td>Bulan / Tahun Dirawat</td>
				<td class="text-center">{{$res->bulan_tahun_dirawat ?? "-" }}</td>
			</tr>
			<tr>
				<td>Riwayat Kesehatan Keluarga</td>
				<td class="text-center">@if(!empty($res->riwayat_keluarga)) {!! nl2br($res->riwayat_keluarga) !!} @else - @endif</td>
			</tr>
			<tr>
				<td>HPHT</td>
				<td class="text-center">{{$res->hpht ?? "-" }}</td>
			</tr>
			<tr>
				<td>TP</td>
				<td class="text-center">{{$res->tp ?? "-" }}</td>
			</tr>
			<tr>
				<td>Gerakan Janin</td>
				<td class="text-center">{{$res->gerakan_janin ?? "-" }}</td>
			</tr>
			<tr>
				<td>Tanda Bahaya / Penyulit</td>
				<td class="text-center">{{$res->penyulit ?? "-" }}</td>
			</tr>
			<tr>
				<td>Obat-obatan yang dikonsumsi (termasuk jamu)</td>
				<td class="text-center">{{$res->obat_dikonsumsi ?? "-" }}</td>
			</tr>
			<tr>
				<td>Riwayat KB yang lalu</td>
				<td class="text-center">{{!empty($res->riwayat_kb_lalu) ? str_replace("|", ", ", $res->riwayat_kb_lalu) : '-'}}</td>
			</tr>
			<tr>
				<td>Lama Pemakaian KB</td>
				<td class="text-center">{{$res->lama_kb ?? "-" }}</td>
			</tr>
			<tr>
				<td>Keluhan Pemakaian</td>
				<td class="text-center">{{$res->keluhan_pemakaian ?? "-" }}</td>
			</tr>
			<tr>
				<td>Rencana KB Selanjutnya</td>
				<td class="text-center">{{$res->rencana_kb ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pola Sehari-hari : Merokok</td>
				<td class="text-center">{{$res->merokok ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pola Sehari-hari : Alkohol</td>
				<td class="text-center">{{$res->alkohol ?? "-" }}</td>
			</tr>
			<tr>
				<td>Alergi sehari-hari</td>
				<td class="text-center">{{$res->alergi_sehari_hari ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pola Nutrisi / Cairan : Nafsu Makan</td>
				<td class="text-center">{{$res->nafsu_makan ?? "-" }}</td>
			</tr>
			<tr>
				<td>Perubahan Berat Badan</td>
				<td class="text-center">{{$res->perubahan_bb ?? "-" }}</td>
			</tr>
			<tr>
				<td>Perubahan Berat Badan (kg)</td>
				<td class="text-center">{{$res->perubahan_bb_kg ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pola Nutrisi / Cairan : Keterangan</td>
				<td class="text-center">{{!empty($res->pola_nutrisi_keterangan) ? str_replace("|", ", ", $res->pola_nutrisi_keterangan) : '-'}}</td>
			</tr>
			<tr>
				<td>Frekuensi BAB dalam 1 hari</td>
				<td class="text-center">{{$res->frekuensi_bab ?? "-" }}</td>
			</tr>
			<tr>
				<td>Kondisi BAB</td>
				<td class="text-center">{{$res->kondisi_bab ?? "-" }}</td>
			</tr>
			<tr>
				<td>Frekuensi BAK dalam 1 hari</td>
				<td class="text-center">{{$res->frekuensi_bak ?? "-" }}</td>
			</tr>
			<tr>
				<td>Kondisi BAK</td>
				<td class="text-center">{{$res->kondisi_bak ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pola Tidur : Durasi Tidur Siang</td>
				<td class="text-center">{{$res->durasi_tidur_siang ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pola Tidur : Durasi Tidur Malam</td>
				<td class="text-center">{{$res->durasi_tidur_malam ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pola Tidur Insomnia</td>
				<td class="text-center">{{$res->pola_tidur_insomnia ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pola Konsep Diri : Gambaran Diri Terganggu</td>
				<td class="text-center">{{$res->gambaran_diri_terganggu ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pola Konsep Diri : Peran Terganggu</td>
				<td class="text-center">{{$res->peran_terganggu ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pola Konsep Diri : Emosi</td>
				<td class="text-center">{{$res->emosi ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pola Reproduksi : Frekuensi Seksual</td>
				<td class="text-center">{{$res->frekuensi_seksual ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pola Spiritual / Budaya / Nilai Kepercayaan yang dilakukan</td>
				<td class="text-center">{{$res->pola_spritual ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pola Hubungan Peran Sosial - Ekonomi</td>
				<td class="text-center">{{$res->pola_hubungan ?? "-" }}</td>
			</tr>
			<tr>
				<td>>Resiko Cedera / Jatuh</td>
				<td class="text-center">{{$res->resiko_cedera ?? "-" }}</td>
			</tr>
			<tr>
				<td>Status Fungsional</td>
				<td class="text-center">{{$res->status_fungsional ?? "-" }}</td>
			</tr>
			<tr>
				<td>Ketergantungan yang Dibutuhkan</td>
				<td class="text-center">{{$res->ketergantungan ?? "-" }}</td>
			</tr>
			<tr>
				<td>Skrining Gizi : Asupan Makan Berkurang Karena Tidak Nafsu Makan</td>
				<td class="text-center">{{$res->asupan_makan_berkurang ?? "-" }}</td>
			</tr>
			<tr>
				<td>Gangguan Metabolisme yang Dialami</td>
				<td class="text-center">{{$res->gangguan_metabolisme ?? "-" }}</td>
			</tr>
			<tr>
				<td>Skrining Gizi : Perubahan Berat Badan Lebih / Kurang dari Anjuran Selama Kehamilan</td>
				<td class="text-center">{{$res->bb_lebih_kurang ?? "-" }}</td>
			</tr>
			<tr>
				<td>Skrining Gizi : Nilai Hb < 10 g/l atau HCT < 30%</td>
				<td class="text-center">{{$res->hb_hct ?? "-" }}</td>
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
				<td>Tinggi Badan</td>
				<td class="text-center">{{$res->tinggi_badan ?? "-" }}</td>
			</tr>
			<tr>
				<td>Berat Badan Sebelum Hamil / Sakit</td>
				<td class="text-center">{{$res->berat_badan_sebelum ?? "-" }}</td>
			</tr>
			<tr>
				<td>Berat Badan Sekarang</td>
				<td class="text-center">{{$res->berat_badan_sekarang ?? "-" }}</td>
			</tr>
			<tr>
				<td>GCS</td>
				<td class="text-center">{{$res->gcs ?? "-" }}</td>
			</tr>
			<tr>
				<td>IMEWS</td>
				<td class="text-center">{{$res->imews ?? "-" }}</td>
			</tr>
			<tr>
				<td>Temperatur</td>
				<td class="text-center">{{$res->temperatur ?? "-" }}</td>
			</tr>
			<tr>
				<td>Nadi</td>
				<td class="text-center">{{$res->nadi ?? "-" }}</td>
			</tr>
			<tr>
				<td>RR</td>
				<td class="text-center">{{$res->rr ?? "-" }}</td>
			</tr>
			<tr>
				<td>SPO2</td>
				<td class="text-center">{{$res->spo2 ?? "-" }}</td>
			</tr>
			<tr>
				<td>Tekanan Darah</td>
				<td class="text-center">{{$res->tekanan_darah ?? "-" }}</td>
			</tr>
			<tr>
				<td>Penilaian Nyeri : Provokatif</td>
				<td class="text-center">{{$res->provokatif ?? "-" }}</td>
			</tr>
			<tr>
				<td>Penilaian Nyeri : Quality</td>
				<td class="text-center">{{$res->quality ?? "-" }}</td>
			</tr>
			<tr>
				<td>Penilaian Nyeri : Region</td>
				<td class="text-center">{{$res->region ?? "-" }}</td>
			</tr>
			<tr>
				<td>Penilaian Nyeri : Scala</td>
				<td class="text-center">{{$res->scala ?? "-" }}</td>
			</tr>
			<tr>
				<td>Penilaian Nyeri : Time</td>
				<td class="text-center">{{$res->time ?? "-" }}</td>
			</tr>
			<tr>
				<td>Penilaian Nyeri : Nyeri Hilang Apabila</td>
				<td class="text-center">{{$res->nyeri_hilang ?? "-" }}</td>
			</tr>
			<tr>
				<td>Kondisi Kepala</td>
				<td class="text-center">{{$res->kondisi_kepala ?? "-" }}</td>
			</tr>
			<tr>
				<td>Rambut Rontok</td>
				<td class="text-center">{{$res->rambut_rontok ?? "-" }}</td>
			</tr>
			<tr>
				<td>Mata Icterus</td>
				<td class="text-center">{{$res->mata_icterus ?? "-" }}</td>
			</tr>
			<tr>
				<td>Mata Cekung</td>
				<td class="text-center">{{$res->mata_cekung ?? "-" }}</td>
			</tr>
			<tr>
				<td>Mata Anemis</td>
				<td class="text-center">{{$res->mata_anemis ?? "-" }}</td>
			</tr>
			<tr>
				<td>Mata Oedem</td>
				<td class="text-center">{{$res->mata_oedem ?? "-" }}</td>
			</tr>
			<tr>
				<td>Kondisi Leher</td>
				<td class="text-center">{{$res->kondisi_leher ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pembesaran Kelenjar Getah Bening</td>
				<td class="text-center">{{$res->pembesaran_kelenjar_getah_bening ?? "-" }}</td>
			</tr>
			<tr>
				<td>Pembendungan Vena Julgularis</td>
				<td class="text-center">{{$res->pembendungan_vena_julgularis ?? "-" }}</td>
			</tr>
			<tr>
				<td>Mammae Simetris</td>
				<td class="text-center">{{$res->mammae_simetris ?? "-" }}</td>
			</tr>
			<tr>
				<td>Asi Keluar</td>
				<td class="text-center">{{$res->asi_keluar ?? "-" }}</td>
			</tr>
			<tr>
				<td>Benjolan</td>
				<td class="text-center">{{$res->benjolan ?? "-" }}</td>
			</tr>
			<tr>
				<td>Hyperpigmentasi Areola</td>
				<td class="text-center">{{$res->hyperpigmentasi_areola ?? "-" }}</td>
			</tr>
			<tr>
				<td>Puting Susu</td>
				<td class="text-center">{{$res->puting_susu ?? "-" }}</td>
			</tr>
			<tr>
				<td>Suara Nafas</td>
				<td class="text-center">{{$res->suara_nafas ?? "-" }}</td>
			</tr>
			<tr>
				<td>Suara Jantung</td>
				<td class="text-center">{{$res->suara_jantung ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : Acites</td>
				<td class="text-center">{{$res->abdomen_acites ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : Bising Usus</td>
				<td class="text-center">{{$res->abdomen_bising_usus ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : Nyeri Ulu Hati</td>
				<td class="text-center">{{$res->abdomen_nyeri_ulu ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : Linea Alba</td>
				<td class="text-center">{{$res->abdomen_linea ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : Inea Nigra</td>
				<td class="text-center">{{$res->abdomen_inea ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : Striae Livide</td>
				<td class="text-center">{{$res->abdomen_striae_livide ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : Striae Albican</td>
				<td class="text-center">{{$res->abdomen_striae_albican ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : Luka Bekas Operasi</td>
				<td class="text-center">{{$res->abdomen_luka ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : Leopold I</td>
				<td class="text-center">{{$res->abdomen_leopold_i ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : Bagian Fundus Teraba</td>
				<td class="text-center">{{$res->abdomen_bagian_fundus ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : Leopold II</td>
				<td class="text-center">{{$res->abdomen_leopold_ii ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : Leopold III</td>
				<td class="text-center">{{$res->abdomen_leopold_iii ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : Leopold IV</td>
				<td class="text-center">{{$res->abdomen_leopold_iv ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : TFU</td>
				<td class="text-center">{{$res->abdomen_tfu ?? "-" }} cm</td>
			</tr>
			<tr>
				<td>Abdomen : TBJ</td>
				<td class="text-center">{{$res->abdomen_tbj ?? "-" }} gr</td>
			</tr>
			<tr>
				<td>Abdomen : DJJ</td>
				<td class="text-center">{{$res->abdomen_djj ?? "-" }}</td>
			</tr>
			<tr>
				<td>Abdomen : HIS</td>
				<td class="text-center">{{$res->abdomen_his ?? "-" }}</td>
			</tr>
			<tr>
				<td>Labia Mayora dan Minora : Varises</td>
				<td class="text-center">{{$res->labia_varises ?? "-" }}</td>
			</tr>
			<tr>
				<td>Labia Mayora dan Minora : Warna Cairan</td>
				<td class="text-center">{{$res->labia_warna ?? "-" }}</td>
			</tr>
			<tr>
				<td>Labia Mayora dan Minora : Jumlah Cairan</td>
				<td class="text-center">{{$res->labia_jumlah ?? "-" }}</td>
			</tr>
			<tr>
				<td>Labia Mayora dan Minora : Konsistensi Cairan</td>
				<td class="text-center">{{$res->labia_konsistensi ?? "-" }}</td>
			</tr>
			<tr>
				<td>Labia Mayora dan Minora : Bau Cairan</td>
				<td class="text-center">{{$res->labia_bau ?? "-" }}</td>
			</tr>
			<tr>
				<td>Erineum (Bekas Jahitan)</td>
				<td class="text-center">{{$res->erineum ?? "-" }}</td>
			</tr>
			<tr>
				<td>Hemoroid</td>
				<td class="text-center">{{$res->hemoroid ?? "-" }}</td>
			</tr>
			<tr>
				<td>Vulva Vagina : Pendarahan</td>
				<td class="text-center">{{$res->vulva_pendarahan ?? "-" }}</td>
			</tr>
			<tr>
				<td>Vulva Vagina : Fluor Albus</td>
				<td class="text-center">{{$res->vulva_fluor_albus ?? "-" }}</td>
			</tr>
			<tr>
				<td>Vulva Vagina : Gatal</td>
				<td class="text-center">{{$res->vulva_gatal ?? "-" }}</td>
			</tr>
			<tr>
				<td>Vulva Vagina : Berwarna</td>
				<td class="text-center">{{$res->vulva_berwarna ?? "-" }}</td>
			</tr>
			<tr>
				<td>Vulva Vagina : Berbau</td>
				<td class="text-center">{{$res->vulva_berbau ?? "-" }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Kebutuhan Edukasi</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Hambatan dalam Pembelajaran</td>
				<td class="text-center">{{$res->hambatan_belajar ?? "-" }}</td>
			</tr>
			<tr>
				<td>Membutuhkan Penerjemah</td>
				<td class="text-center">{{$res->penerjemah ?? "-" }}</td>
			</tr>
			<tr>
				<td>Kebutuhan Pembelajaran Pasien</td>
				<td class="text-center">{{$res->kebutuhan_pembelajaran ?? "-" }}</td>
			</tr>
			<tr>
				<td>Tanggal Pemeriksaan Penunjang</td>
				<td class="text-center">{{$res->tanggal_pemeriksaan_penunjang ?? "-" }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Perencanaan Pulang</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Kriteria Discharge Planning : Umur > 65 Tahun</td>
				<td class="text-center">{{$res->umur_65 ?? "-" }}</td>
			</tr>
			<tr>
				<td>Kriteria Discharge Planning : Keterbatasan Mobilitas</td>
				<td class="text-center">{{$res->keterbatasan_mobilitas ?? "-" }}</td>
			</tr>
			<tr>
				<td>Kriteria Discharge Planning : Perawatan / Pengobatan Lanjutan</td>
				<td class="text-center">{{$res->perawatan_pengobatan_lanjutan ?? "-" }}</td>
			</tr>
			<tr>
				<td>Kriteria Discharge Planning : Bantuan Beraktivitas Sehari-hari</td>
				<td class="text-center">{{$res->bantuan_beraktivitas ?? "-" }}</td>
			</tr>
			<tr>
				<td>Perencanaan Pulang</td>
				<td class="text-center">{{!empty($res->perencanaan_pulang) ? str_replace("|", ", ", $res->perencanaan_pulang) : '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>