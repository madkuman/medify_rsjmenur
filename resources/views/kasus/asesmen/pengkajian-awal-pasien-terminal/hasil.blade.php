

<div class="col-12">
	<h3 class="pt-15">Pengkajian Fisik</h3>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>K/U</small><br>
		{{$item->ku ?? "-"}}</h5>
</div>
<div class="col-12">
	<h4 class="pt-15">Observerasi TTV</h4>
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
	<h5 class="font-w400"><small>Skala Nyeri</small><br>
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
<div class="col-12">
	&nbsp;
</div>
<div class="col-12">
	<h3 class="pt-15">Pengkajian Psikologis</h3>
</div>
<div class="col-12">
	<h5 class="pt-15">Kondisi Psikologis</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Denial</small><br>
		{{$item->kondisi_psikologis_denial ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Sedih</small><br>
		{{$item->kondisi_psikologis_sedih ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Depresi</small><br>
		{{$item->kondisi_psikologis_depresi ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Marah</small><br>
		{{$item->kondisi_psikologis_marah ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Rasa Ketergantungan</small><br>
		{{$item->kondisi_psikologis_rasa_ketergantungan ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Kehilangan Harapan</small><br>
		{{$item->kondisi_psikologis_kehilangan_harapan ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Menerima</small><br>
		{{$item->kondisi_psikologis_menerima ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-12">
	&nbsp;
</div>
<div class="col-12">
	<h3 class="pt-15">Pengkajian Sosial</h3>
</div>
<div class="col-12">
	<h5 class="pt-15">Dukungan</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Apakah Ada Teman Dekat</small><br>
		{{$item->dukungan_apakah_ada_teman_dekat ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Apakah Ada Keluarga Yang Mendukung</small><br>
		{{$item->dukungan_apakah_ada_keluarga_yang_mendukung ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Tidak Ada Yang Mendukung</small><br>
		{{$item->dukungan_tidak_ada_yang_mendukung ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-12">
	&nbsp;
</div>
<div class="col-12">
	<h3 class="pt-15">Pengkajian Spiritual</h3>
</div>
<div class="col-12">
	<h5 class="pt-15">Kondisi Spiritual</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Taat beribadah</small><br>
		{{$item->kondisi_spiritual_taat_beribadah ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Kurang taat beribadah</small><br>
		{{$item->kondisi_spiritual_kurang_taat_beribadah ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Membutuhkan Pelayanan  Rohaniawan</small><br>
		{{$item->kondisi_spiritual_membutuhkan_pelayanan__rohaniawan ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Menolak Pelayanan rohaniawan</small><br>
		{{$item->kondisi_spiritual_menolak_pelayanan_rohaniawan ? "Ya" : "Tidak"}}
	</h5>
</div>
<div class="col-12">
	&nbsp;
</div>
<div class="col-12">
	<h3 class="pt-15">Informasi dan Edukasi</h3>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Informasi dan Edukasi</small><br>
		{{$item->informasi_dan_edukasi ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Alat Bantu Lainnya</small><br>
		{{$item->alat_bantu_lainnya ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Kondisi Psikologis Lainnya</small><br>
		{{$item->kondisi_psikologis_lainnya ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Dukungan Lainnya</small><br>
		{{$item->dukungan_lainnya ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Kondisi Spiritual Lainnya</small><br>
		{{$item->kondisi_spiritual_lainnya ?? "-"}}</h5>
</div>