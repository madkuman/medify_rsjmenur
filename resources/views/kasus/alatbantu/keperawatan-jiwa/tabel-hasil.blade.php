<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Masuk RS</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Marah-marah</td>
				<td class="text-center">{{$res->marah ?? '-' }}</td>
			</tr>
			<tr>
				<td>Merusak barang</td>
				<td class="text-center">{{$res->merusak ?? '-' }}</td>
			</tr>
			<tr>
				<td>Bicara keras</td>
				<td class="text-center">{{$res->bicara_keras ?? '-' }}</td>
			</tr>
			<tr>
				<td>Memukul orang</td>
				<td class="text-center">{{$res->memukul ?? '-' }}</td>
			</tr>
			<tr>
				<td>Menyendiri</td>
				<td class="text-center">{{$res->menyendiri ?? '-' }}</td>
			</tr>
			<tr>
				<td>Defisit bicara</td>
				<td class="text-center">{{$res->defisit ?? '-' }}</td>
			</tr>
			<tr>
				<td>Bicara ngelantur</td>
				<td class="text-center">{{$res->bicara_ngelantur ?? '-' }}</td>
			</tr>
			<tr>
				<td>Tidak rapi</td>
				<td class="text-center">{{$res->tidak_rapi ?? '-' }}</td>
			</tr>
			<tr>
				<td>Mondar-mandir</td>
				<td class="text-center">{{$res->mondar_mandir ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_alasan_masuk ?? '-' }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Riwayat Kesehatan / Pengobatan / Perawatan</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Pengobatan sebelumnya</td>
				<td class="text-center">{{$res->pengobatan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Riwayat Aniaya Fisik</td>
				<td class="text-center">{{$res->aniaya_fisik ?? '-' }}</td>
			</tr>
			<tr>
				<td>Riwayat Aniaya Seksual</td>
				<td class="text-center">{{$res->aniaya_seksual ?? '-' }}</td>
			</tr>
			<tr>
				<td>Riwayat Penolakan</td>
				<td class="text-center">{{$res->penolakan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Riwayat Kekerasan dalam Keluarga</td>
				<td class="text-center">{{$res->kekerasan_keluarga ?? '-' }}</td>
			</tr>
			<tr>
				<td>Riwayat Tindakan Kriminal</td>
				<td class="text-center">{{$res->tindakan_kriminal ?? '-' }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Riwayat Kesehatan Keluarga</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Anggota keluarga lain yang mengalami gangguan kejiwaan</td>
				<td class="text-center">{{$res->anggota_keluarga ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_anggota_keluarga ?? '-' }}</td>
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
				<td>Pengalaman masa lalu yang tidak menyenangkan</td>
				<td class="text-center">{{$res->pengalaman ?? '-' }}</td>
			</tr>
			<tr>
				<td>Konsep diri : gambaran diri, identitas diri, peran diri, ideal diri</td>
				<td class="text-center">{{$res->konsep_diri ?? '-' }}</td>
			</tr>
			<tr>
				<td>Hubungan sosial dan ekonomi : Orang yang berarti</td>
				<td class="text-center">{{$res->orang_berarti ?? '-' }}</td>
			</tr>
			<tr>
				<td>Peran serta dalam kegiatan kelompok / masyarakat</td>
				<td class="text-center">{{$res->peran ?? '-' }}</td>
			</tr>
			<tr>
				<td>Hambatan dalam berhubungan dengan orang lain</td>
				<td class="text-center">{{$res->hambatan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td class="text-center">{{$res->pekerjaan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Penghasilan</td>
				<td class="text-center">{{$res->penghasilan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Pendidikan</td>
				<td class="text-center">{{$res->pendidikan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Nilai dan keyanikan / merasa sakitnya dari Tuhan</td>
				<td class="text-center">{{$res->nilai_keyakinan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Kegiatan ibadah / melakukan sembahyang</td>
				<td class="text-center">{{$res->kegiatan_ibadah ?? '-' }}</td>
			</tr>
			<tr>
				<td>Budaya / nilai kepercayaan yang perlu diperhatikan</td>
				<td class="text-center">{{$res->budaya_diperhatikan ?? '-' }}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Pemeriksaan Status Mental</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Penampilan Tidak rapi</td>
				<td class="text-center">{{$res->pakaian_tidak_rapi ?? '-' }}</td>
			</tr>
			<tr>
				<td>Penggunaan pakaian tidak sesuai</td>
				<td class="text-center">{{$res->pakaian_tidak_sesuai ?? '-' }}</td>
			</tr>
			<tr>
				<td>Cara berpakaian tidak seperti orang normal</td>
				<td class="text-center">{{$res->pakaian_tidak_normal ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_pakaian ?? '-' }}</td>
			</tr>
			<tr>
				<td>Cara Bicara : Cepat</td>
				<td class="text-center">{{$res->cepat ?? '-' }}</td>
			</tr>
			<tr>
				<td>Cara Bicara : Keras</td>
				<td class="text-center">{{$res->keras ?? '-' }}</td>
			</tr>
			<tr>
				<td>Cara Bicara : Gagap</td>
				<td class="text-center">{{$res->gagap ?? '-' }}</td>
			</tr>
			<tr>
				<td>Cara Bicara : Inkoheren</td>
				<td class="text-center">{{$res->inkoheren ?? '-' }}</td>
			</tr>
			<tr>
				<td>Cara Bicara : Apatis</td>
				<td class="text-center">{{$res->apatis ?? '-' }}</td>
			</tr>
			<tr>
				<td>Cara Bicara : Lambat</td>
				<td class="text-center">{{$res->lambat ?? '-' }}</td>
			</tr>
			<tr>
				<td>Cara Bicara : Membisu</td>
				<td class="text-center">{{$res->membisu ?? '-' }}</td>
			</tr>
			<tr>
				<td>Cara Bicara : Tidak mampu memulai pembicaraan</td>
				<td class="text-center">{{$res->tidak_memulai ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_pembicaraan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Aktivitas Motorik : Lesu</td>
				<td class="text-center">{{$res->lesu ?? '-' }}</td>
			</tr>
			<tr>
				<td>Aktivitas Motorik : Tegang</td>
				<td class="text-center">{{$res->tegang ?? '-' }}</td>
			</tr>
			<tr>
				<td>Aktivitas Motorik : Gelisah</td>
				<td class="text-center">{{$res->gelisah ?? '-' }}</td>
			</tr>
			<tr>
				<td>Aktivitas Motorik : Agitasi</td>
				<td class="text-center">{{$res->agitasi ?? '-' }}</td>
			</tr>
			<tr>
				<td>Aktivitas Motorik : Tik</td>
				<td class="text-center">{{$res->tik ?? '-' }}</td>
			</tr>
			<tr>
				<td>Aktivitas Motorik : Grimasen</td>
				<td class="text-center">{{$res->grimasen ?? '-' }}</td>
			</tr>
			<tr>
				<td>Aktivitas Motorik : Tremor</td>
				<td class="text-center">{{$res->tremor ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_motorik ?? '-' }}</td>
			</tr>
			<tr>
				<td>Alam Perasaan : Sedih</td>
				<td class="text-center">{{$res->sedih ?? '-' }}</td>
			</tr>
			<tr>
				<td>Alam Perasaan : Ketakutan</td>
				<td class="text-center">{{$res->ketakutan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Alam Perasaan : Putus asa</td>
				<td class="text-center">{{$res->putus_asa ?? '-' }}</td>
			</tr>
			<tr>
				<td>Alam Perasaan : Khawatir</td>
				<td class="text-center">{{$res->khawatir ?? '-' }}</td>
			</tr>
			<tr>
				<td>Alam Perasaan : Gembira berlebihan</td>
				<td class="text-center">{{$res->gembira_berlebihan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_perasaan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Afek : Datar</td>
				<td class="text-center">{{$res->datar ?? '-' }}</td>
			</tr>
			<tr>
				<td>Afek : Tumpul</td>
				<td class="text-center">{{$res->tumpul ?? '-' }}</td>
			</tr>
			<tr>
				<td>Afek : Labil</td>
				<td class="text-center">{{$res->labil ?? '-' }}</td>
			</tr>
			<tr>
				<td>Afek : Tidak Sesuai</td>
				<td class="text-center">{{$res->tidak_sesuai ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_afek ?? '-' }}</td>
			</tr>
			<tr>
				<td>Interaksi selama wawancara : Bermusuhan</td>
				<td class="text-center">{{$res->bermusuhan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Interaksi selama wawancara : Tidak Kooperatif</td>
				<td class="text-center">{{$res->tidak_kooperatif ?? '-' }}</td>
			</tr>
			<tr>
				<td>Interaksi selama wawancara : Mudah Tersinggung</td>
				<td class="text-center">{{$res->tersinggung ?? '-' }}</td>
			</tr>
			<tr>
				<td>Interaksi selama wawancara : Kontak mata (-)</td>
				<td class="text-center">{{$res->kontak_mata ?? '-' }}</td>
			</tr>
			<tr>
				<td>Interaksi selama wawancara : Defensif</td>
				<td class="text-center">{{$res->defensif ?? '-' }}</td>
			</tr>
			<tr>
				<td>Interaksi selama wawancara : Curiga</td>
				<td class="text-center">{{$res->curiga ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_interaksi ?? '-' }}</td>
			</tr>
			<tr>
				<td>Persepsi : Pendengaran</td>
				<td class="text-center">{{$res->pendengaran ?? '-' }}</td>
			</tr>
			<tr>
				<td>Persepsi : Penglihatan</td>
				<td class="text-center">{{$res->penglihatan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Persepsi : Perabaan</td>
				<td class="text-center">{{$res->perabaan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Persepsi : Pengecapan</td>
				<td class="text-center">{{$res->pengecapan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Persepsi : Penghidu</td>
				<td class="text-center">{{$res->penghidu ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_persepsi ?? '-' }}</td>
			</tr>
			<tr>
				<td>Proses Pikir : Sirkumtansial</td>
				<td class="text-center">{{$res->sirkum ?? '-' }}</td>
			</tr>
			<tr>
				<td>Proses Pikir : Tangensial</td>
				<td class="text-center">{{$res->tangen ?? '-' }}</td>
			</tr>
			<tr>
				<td>Proses Pikir : Kehilangan Asosiasi</td>
				<td class="text-center">{{$res->hilang_asosiasi ?? '-' }}</td>
			</tr>
			<tr>
				<td>Proses Pikir : Flight of Ideas</td>
				<td class="text-center">{{$res->flight ?? '-' }}</td>
			</tr>
			<tr>
				<td>Proses Pikir : Blocking</td>
				<td class="text-center">{{$res->blocking ?? '-' }}</td>
			</tr>
			<tr>
				<td>Proses Pikir : Pengulanagn bicara</td>
				<td class="text-center">{{$res->pengulang ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_proses_pikir ?? '-' }}</td>
			</tr>
			<tr>
				<td>Isi Pikir : Obsesi</td>
				<td class="text-center">{{$res->obsesi ?? '-' }}</td>
			</tr>
			<tr>
				<td>Isi Pikir : Pobia</td>
				<td class="text-center">{{$res->pobia ?? '-' }}</td>
			</tr>
			<tr>
				<td>Isi Pikir : Hipokondria</td>
				<td class="text-center">{{$res->hipokondria ?? '-' }}</td>
			</tr>
			<tr>
				<td>Isi Pikir : Depersonalisasi</td>
				<td class="text-center">{{$res->depersonalisasi ?? '-' }}</td>
			</tr>
			<tr>
				<td>Isi Pikir : Ide yang terkait</td>
				<td class="text-center">{{$res->ide ?? '-' }}</td>
			</tr>
			<tr>
				<td>Isi Pikir : Pikiran Magis</td>
				<td class="text-center">{{$res->magis ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_isi_pikir ?? '-' }}</td>
			</tr>
			<tr>
				<td>Waham : Agama</td>
				<td class="text-center">{{$res->agama ?? '-' }}</td>
			</tr>
			<tr>
				<td>Waham : Somatic</td>
				<td class="text-center">{{$res->somatic ?? '-' }}</td>
			</tr>
			<tr>
				<td>Waham : Kebesaran</td>
				<td class="text-center">{{$res->kebesaran ?? '-' }}</td>
			</tr>
			<tr>
				<td>Waham : Curiga</td>
				<td class="text-center">{{$res->waham_curiga ?? '-' }}</td>
			</tr>
			<tr>
				<td>Waham : Nihilistik</td>
				<td class="text-center">{{$res->nihilistik ?? '-' }}</td>
			</tr>
			<tr>
				<td>Waham : Sisip Pikir</td>
				<td class="text-center">{{$res->sisip ?? '-' }}</td>
			</tr>
			<tr>
				<td>Waham : Siar Pikir</td>
				<td class="text-center">{{$res->siar ?? '-' }}</td>
			</tr>
			<tr>
				<td>Waham : Control Piker</td>
				<td class="text-center">{{$res->control ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_waham ?? '-' }}</td>
			</tr>
			<tr>
				<td>Tingkat Kesadaran : Bingung</td>
				<td class="text-center">{{$res->bingung ?? '-' }}</td>
			</tr>
			<tr>
				<td>Tingkat Kesadaran : Sedasi</td>
				<td class="text-center">{{$res->sedasi ?? '-' }}</td>
			</tr>
			<tr>
				<td>Tingkat Kesadaran : Stupor</td>
				<td class="text-center">{{$res->stupor ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_kesadaran ?? '-' }}</td>
			</tr>
			<tr>
				<td>Disorientasi : Waktu</td>
				<td class="text-center">{{$res->waktu ?? '-' }}</td>
			</tr>
			<tr>
				<td>Disorientasi : Tempat</td>
				<td class="text-center">{{$res->tempat ?? '-' }}</td>
			</tr>
			<tr>
				<td>Disorientasi : Orang</td>
				<td class="text-center">{{$res->orang ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_disorientasi ?? '-' }}</td>
			</tr>
			<tr>
				<td>Memori : Gangguan daya ingat jangka panjang</td>
				<td class="text-center">{{$res->panjang ?? '-' }}</td>
			</tr>
			<tr>
				<td>Memori : Gangguan daya ingat jangka pendek</td>
				<td class="text-center">{{$res->pendek ?? '-' }}</td>
			</tr>
			<tr>
				<td>Memori : Gangguan daya ingat saat ini</td>
				<td class="text-center">{{$res->saat_ini ?? '-' }}</td>
			</tr>
			<tr>
				<td>Memori : Konfabulasi</td>
				<td class="text-center">{{$res->konfabulasi ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_memori ?? '-' }}</td>
			</tr>
			<tr>
				<td>Tingkat Konsentrasi Berhitung : Mudah beralih</td>
				<td class="text-center">{{$res->beralih ?? '-' }}</td>
			</tr>
			<tr>
				<td>Tingkat Konsentrasi Berhitung : Tidak mampu berkonsentrasi</td>
				<td class="text-center">{{$res->tidak_berkonsentrasi ?? '-' }}</td>
			</tr>
			<tr>
				<td>Tingkat Konsentrasi Berhitung : Tidak mampu berhitung</td>
				<td class="text-center">{{$res->tidak_berhitung ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_konsentrasi ?? '-' }}</td>
			</tr>
			<tr>
				<td>Kemampuan Penilaian : Gangguan ringan</td>
				<td class="text-center">{{$res->ringan ?? '-' }}</td>
			</tr>
			<tr>
				<td>Kemampuan Penilaian : Gangguan bermakna</td>
				<td class="text-center">{{$res->bermakna ?? '-' }}</td>
			</tr>
			<tr>
				<td>Keterangan/Penjelasan</td>
				<td class="text-center">{{$res->keterangan_penilaian ?? '-' }}</td>
			</tr>
			<tr>
				<td>Daya Tilik Diri : Mengingkari penyakit yang diderita</td>
				<td class="text-center">{{$res->mengingkari ?? '-' }}</td>
			</tr>
			<tr>
				<td>Daya Tilik Diri : Menyalahkan hal-hal diluar dirinya</td>
				<td class="text-center">{{$res->menyalahkan ?? '-' }}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-6">
</div>