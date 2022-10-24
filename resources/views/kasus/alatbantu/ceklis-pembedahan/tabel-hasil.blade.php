<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Sign In</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Konfirmasi identitas dan gelang pasien</td>
				<td class="text-center">{!! isset($res->konfirmasi_identitas_dan_gelang_pasien) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Konfirmasi lokasi pasien</td>
				<td class="text-center">{!! isset($res->konfirmasi_lokasi_pasien) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Konfirmasi prosedur operasi</td>
				<td class="text-center">{!! isset($res->konfirmasi_prosedur_operasi) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Konfirmasi persetujuan operasi</td>
				<td class="text-center">{!! isset($res->konfirmasi_persetujuan_operasi) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Lokasi operasi sudah diberi tanda</td>
				<td class="text-center">{!! isset($res->lokasi_operasi_sudah_diberi_tanda) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Lokasi operasi tidak dapat dilakukan</td>
				<td class="text-center">{!! isset($res->lokasi_operasi_tidak_dapat_dilakukan) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Mesin dan obat anestesi sudah dicek</td>
				<td class="text-center">{!! isset($res->mesin_dan_obat_anestesi_sudah_dicek) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Pulse oximeter sudah dicek dan berfungsi</td>
				<td class="text-center">{!! isset($res->pulse_oximeter_sudah_dicek_dan_berfungsi) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Pasien mempunyai riwayat alergi</td>
				<td class="text-center">{!! isset($res->pasien_mempunyai_riwayat_alergi) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Kesulitan nafas atau resiko aspirasi</td>
				<td class="text-center">{!! isset($res->kesulitan_nafas_atau_resiko_aspirasi) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Resiko kehilangan darah lebih dari 500ml</td>
				<td class="text-center">{!! isset($res->resiko_kehilangan_darah_lebih_dari_500ml) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Dua akses intravena akses sentral dan rencana terapi cairan</td>
				<td class="text-center">{!! isset($res->dua_akses_intravena_akses_sentral_dan_rencana_terapi_cairan) ? '&#10004;' : '-'!!}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Time Out</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Sebutkan nama dan peran masing masing anggota tim</td>
				<td class="text-center">{!! isset($res->sebutkan_nama_dan_peran_masing_masing_anggota_tim) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Konfirmasi nama pasien</td>
				<td class="text-center">{!! isset($res->konfirmasi_nama_pasien) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Konfirmasi prosedur</td>
				<td class="text-center">{!! isset($res->konfirmasi_prosedur) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Konfirmasi lokasi insisi</td>
				<td class="text-center">{!! isset($res->konfirmasi_lokasi_insisi) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Konfirmasi fiksasi pasien</td>
				<td class="text-center">{!! isset($res->konfirmasi_fiksasi_pasien) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Profilaksis antibiotik sudah diberikan 30 menit sebelum</td>
				<td class="text-center">{!! isset($res->profilaksis_antibiotik_sudah_diberikan_30_menit_sebelum) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Kemungkinan timbul kesulitan dalam operasi</td>
				<td class="text-center">{!! isset($res->kemungkinan_timbul_kesulitan_dalam_operasi) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Masalah khusus pada pasien dan langkah antisipasi</td>
				<td class="text-center">{!! isset($res->masalah_khusus_pada_pasien_dan_langkah_antisipasi) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Cek alat steril</td>
				<td class="text-center">{!! isset($res->cek_alat_steril) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Kesediaan alat khusus</td>
				<td class="text-center">{!! isset($res->kesediaan_alat_khusus) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Hasil MRI CT Scan Foto Rontgen terpasang</td>
				<td class="text-center">{!! isset($res->hasil_mri_ct_scan_foto_rontgen_terpasang) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Profilaksis diberikan oleh</td>
				<td class="text-center">{{$res->profilaksis_diberikan_oleh ?? '-' }}</td>
			</tr>
			<tr>
				<td>Estimasi lama operasi dalam jam</td>
				<td class="text-center">{{$res->estimasi_lama_operasi_dalam_jam ?? '-' }}</td>
			</tr>
			<tr>
				<td>Perkiraan kehilangan darah dalam cc</td>
				<td class="text-center">{{$res->perkiraan_kehilangan_darah_dalam_cc ?? '-' }}</td>
			</tr>
			<tr>
				<td>Sirculation Nurs</td>
				<td class="text-center">{{$res->sirculation_nurs ?? '-' }}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Sign Out</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Konfirmasi secara verbal tentang nama prosedur tindakan</td>
				<td class="text-center">{!! isset($res->konfirmasi_secara_verbal_tentang_nama_prosedur_tindakan) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Instrumen Pra</td>
				<td class="text-center">{{$res->instrumen_pra ?? '-'}}</td>
			</tr>
			<tr>
				<td>Instrumen Intra</td>
				<td class="text-center">{{$res->instrumen_intra ?? '-'}}</td>
			</tr>
			<tr>
				<td>Instrumen Tambahan</td>
				<td class="text-center">{{$res->instrumen_tambahan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Instrumen Pasca</td>
				<td class="text-center">{{$res->instrumen_pasca ?? '-'}}</td>
			</tr>
			<tr>
				<td>Instrumen Keterangan</td>
				<td class="text-center">{{$res->instrumen_keterangan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Kassa Pra</td>
				<td class="text-center">{{$res->kassa_pra ?? '-'}}</td>
			</tr>
			<tr>
				<td>Kassa Intra</td>
				<td class="text-center">{{$res->kassa_intra ?? '-'}}</td>
			</tr>
			<tr>
				<td>Kassa Tambahan</td>
				<td class="text-center">{{$res->kassa_tambahan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Kassa Pasca</td>
				<td class="text-center">{{$res->kassa_pasca ?? '-'}}</td>
			</tr>
			<tr>
				<td>Kassa Keterangan</td>
				<td class="text-center">{{$res->kassa_keterangan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Lapspong Pra</td>
				<td class="text-center">{{$res->lapspong_pra ?? '-'}}</td>
			</tr>
			<tr>
				<td>Lapspong Intra</td>
				<td class="text-center">{{$res->lapspong_intra ?? '-'}}</td>
			</tr>
			<tr>
				<td>Lapspong Tambahan</td>
				<td class="text-center">{{$res->lapspong_tambahan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Lapspong Pasca</td>
				<td class="text-center">{{$res->lapspong_pasca ?? '-'}}</td>
			</tr>
			<tr>
				<td>Lapspong Keterangan</td>
				<td class="text-center">{{$res->lapspong_keterangan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Depers Pra</td>
				<td class="text-center">{{$res->depers_pra ?? '-'}}</td>
			</tr>
			<tr>
				<td>Depers Intra</td>
				<td class="text-center">{{$res->depers_intra ?? '-'}}</td>
			</tr>
			<tr>
				<td>Depers Tambahan</td>
				<td class="text-center">{{$res->depers_tambahan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Depers Pasca</td>
				<td class="text-center">{{$res->depers_pasca ?? '-'}}</td>
			</tr>
			<tr>
				<td>Depers Keterangan</td>
				<td class="text-center">{{$res->depers_keterangan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Jarum Pra</td>
				<td class="text-center">{{$res->jarum_pra ?? '-'}}</td>
			</tr>
			<tr>
				<td>Jarum Intra</td>
				<td class="text-center">{{$res->jarum_intra ?? '-'}}</td>
			</tr>
			<tr>
				<td>Jarum Tambahan</td>
				<td class="text-center">{{$res->jarum_tambahan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Jarum Pasca</td>
				<td class="text-center">{{$res->jarum_pasca ?? '-'}}</td>
			</tr>
			<tr>
				<td>Jarum Keterangan</td>
				<td class="text-center">{{$res->jarum_keterangan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Pisau Pra</td>
				<td class="text-center">{{$res->pisau_pra ?? '-'}}</td>
			</tr>
			<tr>
				<td>Pisau Intra</td>
				<td class="text-center">{{$res->pisau_intra ?? '-'}}</td>
			</tr>
			<tr>
				<td>Pisau Tambahan</td>
				<td class="text-center">{{$res->pisau_tambahan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Pisau Pasca</td>
				<td class="text-center">{{$res->pisau_pasca ?? '-'}}</td>
			</tr>
			<tr>
				<td>Pisau Keterangan</td>
				<td class="text-center">{{$res->pisau_keterangan ?? '-'}}</td>
			</tr>
			<tr>
				<td>Spesimen telah diberikan label</td>
				<td class="text-center">{!! isset($res->spesimen_telah_diberikan_label) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Terdapat masalah dengan peralatan selama operasi</td>
				<td class="text-center">{!! isset($res->terdapat_masalah_dengan_peralatan_selama_operasi) ? '&#10004;' : '-'!!}</td>
			</tr>
			<tr>
				<td>Pesan Khusus Oleh Ahli Bedahm Ahli Anestesi, dan Perawat Bedan untuk Perawat RR</td>
				<td class="text-center">{{$res->pesan_khusus ?? '-' }}</td>
			</tr>
		</tbody>
	</table>
</div>