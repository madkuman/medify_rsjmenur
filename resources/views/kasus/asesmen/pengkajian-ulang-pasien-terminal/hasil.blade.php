

<div class="col-12">
	<h3 class="pt-15">Pengkajian Fisik</h3>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>K/U</small><br>
		{{$item->ku ?? "-"}}</h5>
</div>
<div class="col-12">
	<h4 class="pt-15">Observasi TTV</h4>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>TD</small><br>
		{{$item->td ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>S/N</small><br>
		{{$item->sn ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>RR</small><br>
		{{$item->rr ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>GCS</small><br>
		{{$item->gcs ?? "-"}}</h5>
</div>
<div class="col-12">
	<h4 class="pt-15">Penilaian Nyeri</h4>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Skala nyeri</small><br>
		{{$item->skala_nyeri ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Karakteristik</small><br>
		{{$item->karakteristik ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Lokasi</small><br>
		{{$item->lokasi ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Durasi</small><br>
		{{$item->durasi ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Frekuensi</small><br>
		{{$item->frekuensi ?? "-"}}</h5>
</div>
<div class="col-12">
	<h5 class="pt-15">Alat Bantu Yang Dipakai</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Ventilator</small><br>
		{{$item->alat_bantu_yang_dipakai_ventilator ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Oksigen</small><br>
		{{$item->alat_bantu_yang_dipakai_oksigen ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Monitor</small><br>
		{{$item->alat_bantu_yang_dipakai_monitor ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Tanpa Alat Bantu</small><br>
		{{$item->alat_bantu_yang_dipakai_tanpa_alat_bantu ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-12">
	&nbsp;
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Alat Bantu Lainnya</small><br>
		{{$item->alat_bantu_lainnya ?? "-"}}</h5>
</div>
<div class="col-12">
	<h3 class="pt-15">Tanda – Tanda Klinis menjelang kematian</h3>
</div>
<div class="col-12">
	<h5 class="pt-15">Kehilangan Tonus Otot</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Relaksasi otot muka sehingga dagu menjadi turun</small><br>
		{{$item->tonus_otot_relaksasi_otot_muka ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Kesulitan dalam berbicara, proses menelan dan hilangnya reflek  menelan</small><br>
		{{$item->tonus_otot_kesulitan_dalam_berbicara ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Penurunan kegiatan traktus gastrointestinal, ditandai : nausea, muntah, perut kembung,  obstipasi, dsb</small><br>
		{{$item->tonus_otot_penurunan_kegiatan_traktus ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Penurunan control spinkter urinary dan rectal</small><br>
		{{$item->tonus_otot_penurunan_control ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Gerakan tubuh yang terbatas</small><br>
		{{$item->tonus_otot_gerakan_tubuh_terbatas ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-12">
	&nbsp;
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Tanda Kehilangan Tonus Otot Lainnya</small><br>
		{{$item->tanda_kehilangan_tonus_otot_lainnya ?? "-"}}</h5>
</div>
<div class="col-12">
	<h5 class="pt-15">Kelambatan dalam sirkulasi</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Kemunduran dalam sensasi</small><br>
		{{$item->kelambatan_dalam_sirkulasi_kemunduran_dalam_sensasi ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Cyanosis pada daerah ekstermitas</small><br>
		{{$item->kelambatan_dalam_sirkulasi_cyanosis ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Kulit dingin, pertama kali pada daerah kaki, kemudian tangan, telinga dan hidung</small><br>
		{{$item->kelambatan_dalam_sirkulasi_kulit_dingin ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-12">
	&nbsp;
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Tanda Kelambatan Dalam Sirkulasi Lainnya</small><br>
		{{$item->tanda_kelambatan_dalam_sirkulasi_lainnya ?? "-"}}</h5>
</div>
<div class="col-12">
	<h5 class="pt-15">Perubahan TTV</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Nadi lambat dan lemah</small><br>
		{{$item->perubahan_ttv_nadi_lambat_dan_lemah ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Tekanan darah turun</small><br>
		{{$item->perubahan_ttv_tekanan_darah_turun ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Pernafasan cepat, cepat dangkal dan tidak teratur</small><br>
		{{$item->perubahan_ttv_pernafasan_cepat ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-12">
	&nbsp;
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Perubahan TTV Lainnya</small><br>
		{{$item->perubahan_perubahan_dalam_tanda_tanda_vital_lainnya ?? "-"}}</h5>
</div>
<div class="col-12">
	<h5 class="pt-15">Gangguan Sensoria</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Penglihatan kabur</small><br>
		{{$item->gangguan_sensoria_penglihatan_kabur ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Gangguan penciuman dan perabaan</small><br>
		{{$item->gangguan_sensoria_gangguan_penciuman_dan_perabaan ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-12">
	&nbsp;
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Gangguan Sensoria Lainnya</small><br>
		{{$item->gangguan_sensoria_lainnya ?? "-"}}</h5>
</div>
<div class="col-12">
	<h5 class="pt-15">Perubahan Fisik Saat Menjelang Kematian</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Sirkulasi melambat / ekstremitas dingin</small><br>
		{{$item->perubahan_fisik_saat_menjelang_kematian_sirkulasi_melambat ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Tonus otot menurun</small><br>
		{{$item->perubahan_fisik_saat_menjelang_kematian_tonus_otot_menurun ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Perubahan TTV</small><br>
		{{$item->perubahan_fisik_saat_menjelang_kematian_perubahan_ttv ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Berkemih dan defekasi</small><br>
		{{$item->perubahan_fisik_saat_menjelang_kematian_berkemih_dan_defekasi ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Pasien kurang responsive</small><br>
		{{$item->perubahan_fisik_saat_menjelang_kematian_pasien_kurang_responsive ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Kulit memucat</small><br>
		{{$item->perubahan_fisik_saat_menjelang_kematian_kulit_memucat ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Pendengaran adalah indera yang terakhir</small><br>
		{{$item->perubahan_fisik_saat_menjelang_kematian_pendengaran_terakhir ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-12">
	&nbsp;
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Perubahan Fisik Saat Menjelang Kematian Lainnya</small><br>
		{{$item->perubahan_fisik_saat_menjelang_kematian_lainnya ?? "-"}}</h5>
</div>
<div class="col-12">
	<h5 class="pt-15">Petunjuk Indikasi Kematian</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Tidak ada respon terhadap rangsangan dari luar secara total.</small><br>
		{{$item->petunjuk_indikasi_kematian_tidak_ada_respon_terhadap_rangsangan ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Tidak adanya gerak dari otot, khususnya pernafasan.</small><br>
		{{$item->petunjuk_indikasi_kematian_tidak_adanya_gerak_dari_otot ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Tidak ada reflek</small><br>
		{{$item->petunjuk_indikasi_kematian_tidak_ada_reflek ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Gambaran mendatar pada EKG</small><br>
		{{$item->petunjuk_indikasi_kematian_gambaran_mendatar_pada_ekg ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-12">
	&nbsp;
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Petunjuk Tentang Indikasi Kematian Lainnya</small><br>
		{{$item->petunjuk_tentang_indikasi_kematian_lainnya ?? "-"}}</h5>
</div>
<div class="col-12">
	<h3 class="pt-15">Melibatkan Keluarga</h3>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Kesukaan Pasien</small><br>
		{{$item->kesukaan_pasien ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Rencana Tempat Pemakaman</small><br>
		{{$item->rencana_tempat_pemakaman ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Transportasi Jenazah</small><br>
		{{$item->transportasi_jenazah ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Kebiasaan Pasien</small><br>
		{{$item->kebiasaan_pasien ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Perawatan Jenazah</small><br>
		{{$item->perawatan_jenazah ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Informasi dan Edukasi</small><br>
		{{$item->informasi_dan_edukasi ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Pendampingan Rohaniawan</small><br>
		{{$item->pendampingan_rohaniawan ?? "-"}}</h5>
</div>