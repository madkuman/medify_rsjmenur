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
				<td>Ketuban pecah sejak jam</td>
				<td class="text-center">{{$res->ketuban_pecah_jam or '-'}}</td>
			</tr>
			<tr>
				<td>Mules sejak jam</td>
				<td class="text-center">{{$res->mules_jam or '-'}}</td>
			</tr>
			<tr>
				<td>Denyut Jantung Janin</td>
				<td class="text-center">{{$res->denyut_jantung_janin or '-'}}</td>
			</tr>
			<tr>
				<td>Air Ketuban Penyusupan</td>
				<td class="text-center">{{$res->air_ketuban_penyusupan or '-'}}</td>
			</tr>
			<tr>
				<td>Pembukaan Serviks</td>
				<td class="text-center">{{$res->pembukaan_serviks or '-'}}</td>
			</tr>
			<tr>
				<td>Turunnya Kepala</td>
				<td class="text-center">{{$res->turunnya_kepala or '-'}}</td>
			</tr>
			<tr>
				<td>Waktu (jam)</td>
				<td class="text-center">{{$res->waktu or '-'}}</td>
			</tr>
			<tr>
				<td>Kontraksi Tiap 10 Menit</td>
				<td class="text-center">{{$res->kontraksi_tiap_10 or '-'}}</td>
			</tr>
			<tr>
				<td>Oksitoksin U/I tetes/menit</td>
				<td class="text-center">{{$res->oksitosin_ui or '-'}}</td>
			</tr>
			<tr>
				<td>Obat dan Cairan IV / Oral</td>
				<td class="text-center">{{$res->obat_dan_cairan_iv or '-'}}</td>
			</tr>
			<tr>
				<td>Suhu</td>
				<td class="text-center">{{$res->suhu or '-'}}</td>
			</tr>
			<tr>
				<td>Suhu Urin</td>
				<td class="text-center">{{$res->suhu_urin or '-'}}</td>
			</tr>
			<tr>
				<td>Volume Urin</td>
				<td class="text-center">{{$res->volume_urin or '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Catatan Persalinan</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Tanggal</td>
				<td class="text-center">{{$res->tanggal or '-'}}</td>
			</tr>
			<tr>
				<td>Nama Bidan</td>
				<td class="text-center">{{$res->nama_bidan or '-'}}</td>
			</tr>
			<tr>
				<td>Tempat Persalinan</td>
				<td class="text-center">{{$res->tempat_persalinan or '-'}}</td>
			</tr>
			<tr>
				<td>Alamat Tempat Persalinan</td>
				<td class="text-center">{{$res->alamat_tempat_persalinan or '-'}}</td>
			</tr>
			<tr>
				<td>Catatan Rujuk</td>
				<td class="text-center">{{$res->catatan or '-'}}</td>
			</tr>
			<tr>
				<td>Alasan Merujuk</td>
				<td class="text-center">{{$res->alasan_merujuk or '-'}}</td>
			</tr>
			<tr>
				<td>Tempat Rujukan</td>
				<td class="text-center">{{$res->tempat_rujukan or '-'}}</td>
			</tr>
			<tr>
				<td>Pendamping pada saat merujuk</td>
				<td class="text-center">{{$res->pendamping_rujuk or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Kala I</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Patograf Melewati Garis Waspada</td>
				<td class="text-center">@if(!empty($res->normal)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Masalah yang terjadi Kala I</td>
				<td class="text-center">{{$res->masalah_kala_i or '-'}}</td>
			</tr>
			<tr>
				<td>Penatalaksanaan masalah tersebut</td>
				<td class="text-center">{{$res->penatalaksanaan_kala_i or '-'}}</td>
			</tr>
			<tr>
				<td>Hasilnya</td>
				<td class="text-center">{{$res->hasilnya_kala_i or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Kala II</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Episotomi</td>
				<td class="text-center">@if(!empty($res->episotomi)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Pendamping pada saat persalinan</td>
				<td class="text-center">{{$res->pendamping_persalinan or '-'}}</td>
			</tr>
			<tr>
				<td>Gawat Janin</td>
				<td class="text-center">@if(!empty($res->gawat_janin)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Tindakan ketika gawat janin</td>
				<td class="text-center">{{$res->tindakan_gawat_janin or '-'}}</td>
			</tr>
			<tr>
				<td>Distosia Bahu</td>
				<td class="text-center">@if(!empty($res->distosia_bahu)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Tindakan ketika Distosia bahu</td>
				<td class="text-center">{{$res->tindakan_distosia_bahu or '-'}}</td>
			</tr>
			<tr>
				<td>Masalah yang terjadi Kala II</td>
				<td class="text-center">{{$res->masalah_kala_ii or '-'}}</td>
			</tr>
			<tr>
				<td>Penatalaksanaan masalah tersebut</td>
				<td class="text-center">{{$res->penatalaksanaan_kala_ii or '-'}}</td>
			</tr>
			<tr>
				<td>Hasilnya</td>
				<td class="text-center">{{$res->hasilnya_kala_ii or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Kala III</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Lama Kala III</td>
				<td class="text-center">{{$res->lama_kala_iii or '-'}}</td>
			</tr>
			<tr>
				<td>Pemberian Oksitosion 10 U IM</td>
				<td class="text-center">@if(!empty($res->pemberian_oksitosin)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Waktu pemberian Oksitosion (apabila diberikan)</td>
				<td class="text-center">{{$res->waktu_pemberian_oksitosion or '-'}}</td>
			</tr>
			<tr>
				<td>Alasan tidak diberikan Oksitosion (apabila tidak diberikan)</td>
				<td class="text-center">{{$res->alasan_tidak_oksitosion or '-'}}</td>
			</tr>
			<tr>
				<td>Penegangan Tali Pusat Terkendali</td>
				<td class="text-center">@if(!empty($res->penegangan_tali)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Alasan tidak melakukan penegangan tali pusat terkendali</td>
				<td class="text-center">{{$res->alasan_tidak_penegangan_tali or '-'}}</td>
			</tr>
			<tr>
				<td>Masase Fundus Uteri</td>
				<td class="text-center">@if(!empty($res->masase)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Alasan tidak melakukan Masase Fundus Uteri</td>
				<td class="text-center">{{$res->alasan_tidak_masase or '-'}}</td>
			</tr>
			<tr>
				<td>Plasenta lahir lengkap</td>
				<td class="text-center">@if(!empty($res->plasenta_lengkap)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Tindakan yang dilakukan (apabila plasenta tidak lengkap)</td>
				<td class="text-center">{{$res->tindakan_plasenta_tidak_lengkap or '-'}}</td>
			</tr>
			<tr>
				<td>Plasenta tidak lahir > 30 menit</td>
				<td class="text-center">@if(!empty($res->plasenta_30)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Tindakan yang dilakukan (apabila plasenta tidak lahir > 30 menit)</td>
				<td class="text-center">{{$res->tindakan_plasenta_tidak_30 or '-'}}</td>
			</tr>
			<tr>
				<td>Laserasi</td>
				<td class="text-center">@if(!empty($res->laserasi)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Tempat Laserasi (bila ada)</td>
				<td class="text-center">{{$res->tempat_laserasi or '-'}}</td>
			</tr>
			<tr>
				<td>Derajat Laserasi Perineum</td>
				<td class="text-center">{{$res->derajat_laserasi_perineum or '-'}}</td>
			</tr>
			<tr>
				<td>Tindakan yang dilakukan (apabila terdapat laserasi)</td>
				<td class="text-center">{{$res->tindakan_laserasi_perineum or '-'}}</td>
			</tr>
			<tr>
				<td>Penjahitan</td>
				<td class="text-center">{{$res->penjahitan or '-'}}</td>
			</tr>
			<tr>
				<td>Alasan (apabila tidak dijahit)</td>
				<td class="text-center">{{$res->alasan_tidak_dijahit or '-'}}</td>
			</tr>
			<tr>
				<td>Atoni Uteri</td>
				<td class="text-center">@if(!empty($res->atoni_uteri)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Tindakan yang dilakukan (apabila terjadi Atoni uteri)</td>
				<td class="text-center">{{$res->tindakan_atoni_uteri or '-'}}</td>
			</tr>
			<tr>
				<td>Jumlah Perdarahan</td>
				<td class="text-center">{{$res->jumlah_perdarahan or '-'}}</td>
			</tr>
			<tr>
				<td>Masalah yang terjadi Kala III</td>
				<td class="text-center">{{$res->masalah_kala_iii or '-'}}</td>
			</tr>
			<tr>
				<td>Penatalaksanaan masalah tersebut</td>
				<td class="text-center">{{$res->penatalaksanaan_kala_iii or '-'}}</td>
			</tr>
			<tr>
				<td>Hasilnya</td>
				<td class="text-center">{{$res->hasilnya_kala_iii or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Bayi Baru Lahir</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Berat Badan</td>
				<td class="text-center">{{$res->berat_badan or '-'}}</td>
			</tr>
			<tr>
				<td>Panjang Badan</td>
				<td class="text-center">{{$res->panjang_badan or '-'}}</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td class="text-center">{{$res->jenis_kelamin or '-'}}</td>
			</tr>
			<tr>
				<td>Penilaian Bayi Lahir : Mengeringkan</td>
				<td class="text-center">@if(!empty($res->mengeringkan)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Tindakan Bayi Lahir : Menghangatkan</td>
				<td class="text-center">@if(!empty($res->menghangatkan)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Tindakan Bayi Lahir : Rangsangan Taktil</td>
				<td class="text-center">@if(!empty($res->rangsangan_taktil)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Tindakan Bayi Lahir : Bungkus bayi dan letakkan di sisi ibu</td>
				<td class="text-center">@if(!empty($res->bungkus)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Tindakan Bayi Lahir : Tindakan pencegahan infeksi mata</td>
				<td class="text-center">@if(!empty($res->pencegahan_infeksi_mata)) YA @else TIDAK @endif</td>
			</tr>
			<tr>
				<td>Aspiksia</td>
				<td class="text-center">{{$res->aspiksia or '-'}}</td>
			</tr>
			<tr>
				<td>Tindakan bila terjadi aspiksia</td>
				<td class="text-center">{{$res->tindakan_aspiksia or '-'}}</td>
			</tr>
			<tr>
				<td>Cacat bawaan</td>
				<td class="text-center">{{$res->cacat_bawaan or '-'}}</td>
			</tr>
			<tr>
				<td>Tindakan apabila terjadi hipotermia</td>
				<td class="text-center">{{$res->tindakan_hipotermi or '-'}}</td>
			</tr>
			<tr>
				<td>Waktu Pemberian ASI</td>
				<td class="text-center">{{$res->waktu_pemberian_asi or '-'}}</td>
			</tr>
			<tr>
				<td>Masalah yang terjadi ketika bayi lahir</td>
				<td class="text-center">{{$res->masalah_bayi_lahir or '-'}}</td>
			</tr>
			<tr>
				<td>Penatalaksanaan masalah tersebut</td>
				<td class="text-center">{{$res->penatalaksanaan_bayi_lahir or '-'}}</td>
			</tr>
			<tr>
				<td>Hasilnya</td>
				<td class="text-center">{{$res->hasilnya_bayi_lahir or '-'}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Pemantauan Persalinan Kala IV</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Jam ke</td>
				<td class="text-center">{{$res->jam_ke or '-'}}</td>
			</tr>
			<tr>
				<td>Waktu</td>
				<td class="text-center">{{$res->waktu_pemantauan or '-'}}</td>
			</tr>
			<tr>
				<td>Tekanan darah</td>
				<td class="text-center">{{$res->tekanan_darah_pemantauan or '-'}}</td>
			</tr>
			<tr>
				<td>Nadi</td>
				<td class="text-center">{{$res->nadi_pemantauan or '-'}}</td>
			</tr>
			<tr>
				<td>Suhu</td>
				<td class="text-center">{{$res->suhu_pemantauan or '-'}}</td>
			</tr>
			<tr>
				<td>Tinggi Fundus Uteri</td>
				<td class="text-center">{{$res->tinggi_fundus_uteri or '-'}}</td>
			</tr>
			<tr>
				<td>Kontraksi Uterus</td>
				<td class="text-center">{{$res->kontraksi_uterus or '-'}}</td>
			</tr>
			<tr>
				<td>Kandung Kemih</td>
				<td class="text-center">{{$res->kandung_kemih or '-'}}</td>
			</tr>
			<tr>
				<td>Perdarahan</td>
				<td class="text-center">{{$res->perdarahan or '-'}}</td>
			</tr>
			<tr>
				<td>>Masalah yang terjadi Kala IV</td>
				<td class="text-center">{{$res->masalah_kala_iv or '-'}}</td>
			</tr>
			<tr>
				<td>Penatalaksanaan masalah tersebut</td>
				<td class="text-center">{{$res->penatalaksanaan_kala_iv or '-'}}</td>
			</tr>
			<tr>
				<td>Hasilnya</td>
				<td class="text-center">{{$res->hasilnya_kala_iv or '-'}}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-6">
</div>