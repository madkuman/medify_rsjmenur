

<div class="col-md-3">
	<h5 class="font-w400"><small>Dari Ruangan</small><br>
		{{$item->dari_ruangan ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Ke Ruangan</small><br>
		{{$item->ke_ruangan ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Tingkat Kesadaran</small><br>
		{{$item->tingkat_kesadaran ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>GCS</small><br>
		{{$item->gcs ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Keadaan Umum</small><br>
		{{$item->keadaan_umum ?? "-"}}</h5>
</div>
<div class="col-12">
	<h4 class="pt-15">Tanda Tanda Vital</h4>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Tensi</small><br>
		{{$item->tensi ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Suhu</small><br>
		{{$item->suhu ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>EWS / PEWS / IMEWS</small><br>
		{{$item->ews ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>RR</small><br>
		{{$item->rr ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>DJJ</small><br>
		{{$item->djj ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>CVP</small><br>
		{{$item->cvp ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>N</small><br>
		{{$item->n ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>SpO2</small><br>
		{{$item->spo2 ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>TTV Lain lain</small><br>
		{{$item->ttv_lain_lain ?? "-"}}</h5>
</div>
<div class="col-12">
	<h4 class="pt-15">Identifikasi Pasien</h4>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Gelang Identifikasi Pasien</small><br>
		{{$item->gelang_identifikasi_pasien ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Persetujuan MRS / Tindakan / Operasi</small><br>
		{{$item->persetujuan_mrs_operasi ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Lembar Observasi</small><br>
		{{$item->lembar_observasi ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Konsul dr Spesialis</small><br>
		{{$item->konsul_dr_spesialis ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Pasang Infus</small><br>
		{{$item->pasang_infus ?? "-"}}</h5>
</div>
<div class="col-12">
	<h5 class="pt-15">Laboratorium</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>DL</small><br>
		{{$item->laboratorium_dl ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>GDA</small><br>
		{{$item->laboratorium_gda ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>BJP</small><br>
		{{$item->laboratorium_bjp ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Elektrolit</small><br>
		{{$item->laboratorium_elektrolit ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>KK</small><br>
		{{$item->laboratorium_kk ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>BGA</small><br>
		{{$item->laboratorium_bga ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-12">
	&nbsp;
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Lab Lainnya</small><br>
		{{$item->lab_lainnya ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>ECG Posisi</small><br>
		{{$item->ecg_posisi ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>ECG Jenis</small><br>
		{{$item->ecg_jenis ?? "-"}}</h5>
</div>
<div class="col-12">
	<h5 class="pt-15">Radiologi</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Throax</small><br>
		{{$item->radiologi_throax ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>CT Scan</small><br>
		{{$item->radiologi_ct_scan ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>MRI</small><br>
		{{$item->radiologi_mri ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>USG</small><br>
		{{$item->radiologi_usg ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-12">
	&nbsp;
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Radiologi Lainnya</small><br>
		{{$item->radiologi_lainnya ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Kateter Ukuran</small><br>
		{{$item->kateter_ukuran ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Kateter Fiksasi</small><br>
		{{$item->kateter_fiksasi ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Kateter UP</small><br>
		{{$item->kateter_up ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Diet Oral</small><br>
		{{$item->diet_oral ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Diet Enteral</small><br>
		{{$item->diet_enteral ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Diet NGT Residu</small><br>
		{{$item->diet_ngt_residu ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Diet NGT Residu Volume</small><br>
		{{$item->diet_ngt_residu_volume ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Diet NGT Residu Warna</small><br>
		{{$item->diet_ngt_residu_warna ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Diet Parenteral</small><br>
		{{$item->diet_parenteral ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Rawat Luka - Luas Luka</small><br>
		{{$item->rawat_luka_luas_luka ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Rawat Luka - Jumlah Luka</small><br>
		{{$item->rawat_luka_jumlah_luka ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Drainage</small><br>
		{{$item->drainage ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Jahit Luka - Jenis Benang</small><br>
		{{$item->jahit_luka_jenis_benang ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Jahit Luka - Jumlah</small><br>
		{{$item->jahit_luka_jumlah ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Obat Obatan Oral</small><br>
		{{$item->obat_obatan_oral ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Obat Obatan Parenteral</small><br>
		{{$item->obat_obatan_parenteral ?? "-"}}</h5>
</div>
<div class="col-12">
	<h5 class="pt-15">Oksigen Jenis</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Nasale</small><br>
		{{$item->oksigen_jenis_nasale ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Masker</small><br>
		{{$item->oksigen_jenis_masker ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Jacson Race</small><br>
		{{$item->oksigen_jenis_jacson_race ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-12">
	&nbsp;
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Oksigen Ukuran</small><br>
		{{$item->oksigen_ukuran ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Derajat Transfer</small><br>
		{{$item->derajat_transfer ?? "-"}}</h5>
</div>
<div class="col-12">
	<h5 class="pt-15">Pendamping Transfer</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Pemandu</small><br>
		{{$item->pendamping_transfer_pemandu ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Perawat</small><br>
		{{$item->pendamping_transfer_perawat ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Dokter</small><br>
		{{$item->pendamping_transfer_dokter ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Dokter Spesialis</small><br>
		{{$item->pendamping_transfer_dokter_spesialis ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-12">
	&nbsp;
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Metode Transfer</small><br>
		{{$item->metode_transfer ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Perawat pasien lanjutan yang masih dilanjutkan</small><br>
		{{$item->perawat_pasien_lanjutan_yang_masih_dilanjutkan ?? "-"}}</h5>
</div>
<div class="col-12">
	<h3 class="pt-15">Monitoring Selama Transfer</h3>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Tingkat Kesadaran Selama Transfer</small><br>
		{{$item->tingkat_kesadaran_selama_transfer ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>GCS Selama Transfer</small><br>
		{{$item->gcs_selama_transfer ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Kejadian Klinis Selama Transfer</small><br>
		{{$item->kejadian_klinis_selama_transfer ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Barang Pasien</small><br>
		{{$item->barang_pasien ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Keluarga Nama</small><br>
		{{$item->keluarga_nama ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Keluarga No HP</small><br>
		{{$item->keluarga_no_hp ?? "-"}}</h5>
</div>