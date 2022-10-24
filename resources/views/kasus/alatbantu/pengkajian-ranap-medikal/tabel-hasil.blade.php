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
				<td class="text-center">{{$res->tgl_kedatangan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Jam</td>
				<td class="text-center">{{$res->jam_kedatangan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Ruangan</td>
				<td class="text-center">{{$res->ruangan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Agama</td>
				<td class="text-center">{{$res->agama ?? '-'}}</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td class="text-center">{{$res->alamat ?? '-'}}</td>
			</tr>
			<tr>
				<td>Tanggal Pengkajian</td>
				<td class="text-center">{{$res->tgl_pengkajian ?? '-'}}</td>
			</tr>
			<tr>
				<td>Jam</td>
				<td class="text-center">{{$res->jam_pengkajian ?? '-'}}</td>
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
				<td class="text-center">{{$res->alergi_obat ?? '-'}}</td>
			</tr>
			<tr>
				<td>Reaksi Alergi Obat</td>
				<td class="text-center">{{$res->reaksi_obat ?? '-'}}</td>
			</tr>
			<tr>
				<td>Alergi Makanan</td>
				<td class="text-center">{{$res->alergi_makanan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Reaksi Alergi Makanan</td>
				<td class="text-center">{{$res->reaksi_makanan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Alergi Lain</td>
				<td class="text-center">{{$res->alergi_lain ?? '-'}}</td>
			</tr>
			<tr>
				<td>Reaksi Terhadap Alergi Diatas</td>
				<td class="text-center">{{$res->reaksi_alergi_lain ?? '-'}}</td>
			</tr>
			<tr>
				<td>Gelang Tanda Alergi</td>
				<td class="text-center">{{$res->gelang_tanda_alergi}}</td>
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
				<td class="text-center">{{$res->keluhan ?? '-'}}</td>
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
				<td class="text-center">{{$res->diagnosis_perawatan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Tempat Perawatan</td>
				<td class="text-center">{{$res->tempat_perawatan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Waktu Perawatan</td>
				<td class="text-center">{{$res->waktu_perawatan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Alat Implan Terpasang</td>
				<td class="text-center">{{$res->alat_implan_terpasang ?? '-'}}</td>
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
				<td>Status Psikologis (Cemas, Takut, Kecenderungan bunuh diri, dll)</td>
				<td class="text-center">{{$res->status_psikologis ?? '-'}}</td>
			</tr>
			<tr>
				<td>Orientasi</td>
				<td class="text-center">{{$res->orientasi}}</td>
			</tr>
			<tr>
				<td>Masalah Perilaku (bila ada)</td>
				<td class="text-center">{{$res->masalah_perilaku ?? '-'}}</td>
			</tr>
			<tr>
				<td>Perilaku Kekerasan yang dialami Pasien sebelumnya (bila ada)</td>
				<td class="text-center">{{$res->perilaku_kekerasan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Hubungan Pasien dengan Anggota Keluarga</td>
				<td class="text-center">{{$res->hubungan_keluarga ?? '-'}}</td>
			</tr>
			<tr>
				<td>Tempat Tinggal</td>
				<td class="text-center">{{$res->tempat_tinggal ?? '-'}}</td>
			</tr>
			<tr>
				<td>Nama kerabat terdekat yang dapat dihubungi</td>
				<td class="text-center">{{$res->nama_kerabat ?? '-'}}</td>
			</tr>
			<tr>
				<td>Hubungan dengan kerabat tersebut</td>
				<td class="text-center">{{$res->hubungan_kerabat ?? '-'}}</td>
			</tr>
			<tr>
				<td>Nomor telepon kerabat</td>
				<td class="text-center">{{$res->telepon_kerabat ?? '-'}}</td>
			</tr>
			<tr>
				<td>Kegiatan keagamaan yang biasa dilakukan</td>
				<td class="text-center">{{$res->kegiatan_keagamaan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Kegiatan spiritual yang diperlukan selama perawatan</td>
				<td class="text-center">{{$res->kegiatan_spiritual ?? '-'}}</td>
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
				<td>Kesadaran</td>
				<td class="text-center">{{$res->kesadaran ?? '-'}}</td>
			</tr>
			<tr>
				<td>Tekanan darah</td>
				<td class="text-center">{{$res->tekanan_darah_1 ?? '-'}}/{{$res->tekanan_darah_2 ?? '-'}} mmHg</td>
			</tr>
			<tr>
				<td>Nadi</td>
				<td class="text-center">{{$res->nadi ?? '-'}} x/min</td>
			</tr>
			<tr>
				<td>RR</td>
				<td class="text-center">{{$res->rr ?? '-'}} x/min</td>
			</tr>
			<tr>
				<td>Temperatur</td>
				<td class="text-center">{{$res->temperatur ?? '-'}} °C</td>
			</tr>
			<tr>
				<td>Berat Badan</td>
				<td class="text-center">{{$res->berat_badan ?? '-'}} kg</td>
			</tr>
			<tr>
				<td>Tinggi Badan</td>
				<td class="text-center">{{$res->tinggi_badan ?? '-'}} cm</td>
			</tr>
			<tr>
				<td>Keluhan Gastrointestinal</td>
				<td class="text-center">{{$res->keluhan_gastrointestinal ?? '-'}}</td>
			</tr>
			<tr>
				<td>Pembatasan Makanan</td>
				<td class="text-center">{{$res->pembatasan_makanan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Gigi Palsu</td>
				<td class="text-center">{{$res->gigi_palsu ?? '-'}}</td>
			</tr>
			<tr>
				<td>Neurosensori Pendengaran</td>
				<td class="text-center">{{$res->neurosensori_pendengaran ?? '-'}}</td>
			</tr>
			<tr>
				<td>Neurosensori Penglihatan</td>
				<td class="text-center">{{$res->neurosensori_penglihatan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Eliminasi Defekasi</td>
				<td class="text-center">{{$res->eliminasi_defekasi ?? '-'}}</td>
			</tr>
			<tr>
				<td>Eliminasi Miksi</td>
				<td class="text-center">{{$res->eliminasi_miksi ?? '-'}}</td>
			</tr>
			<tr>
				<td>Hamil</td>
				<td class="text-center">{{!empty($res->hamil) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>HPHT</td>
				<td class="text-center">{{$res->hpht ?? '-'}}</td>
			</tr>
			<tr>
				<td>Keluhan Menstruasi</td>
				<td class="text-center">{{$res->keluhan_menstruasi ?? '-'}}</td>
			</tr>
			<tr>
				<td>Keadaan Kulit</td>
				<td class="text-center">{{$res->keadaan_kulit ?? '-'}}</td>
			</tr>
			<tr>
				<td>Skor Norton</td>
				<td class="text-center">{{$res->skor_norton ?? '-'}}/20</td>
			</tr>
			<tr>
				<td>Resiko Dekubitus</td>
				<td class="text-center">{{!empty($res->resiko_dekubitus) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Terdapat Luka</td>
				<td class="text-center">{{!empty($res->terdapat_luka) ? 'Ya' : 'Tidak'}}</td>
			</tr>
			<tr>
				<td>Lokasi Luka / Lesi lain</td>
				<td class="text-center">{{$res->lokasi_luka ?? '-'}}</td>
			</tr>
			<tr>
				<td>Pemeriksaan Penunjang</td>
				<td class="text-center">{{$res->pemeriksaan_penunjang ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>