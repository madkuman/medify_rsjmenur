<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Karakteristik Ibu</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Pendidikan</td>
				<td class="text-center">{{$res->pendidikan}}</td>
			</tr>
			<tr>
				<td>Jumlah Gravida</td>
				<td class="text-center">{{$res->gravida}}</td>
			</tr>
			<tr>
				<td>Jumlah Partus</td>
				<td class="text-center">{{$res->partus}}</td>
			</tr>
			<tr>
				<td>Jumlah Abortus</td>
				<td class="text-center">{{$res->abortus}}</td>
			</tr>
			<tr>
				<td>Kehamilan Terakhir</td>
				<td class="text-center">{{$res->hamilterakhir != 'Lain-lain' ? $res->hamilterakhir : $res->hamilterakhir_lain2}}</td>
			</tr>
			<tr>
				<td>meninggal</td>
				<td class="text-center">{{$res->meninggal}}</td>
			</tr>
			<tr>
				<td>Cara Persalinan</td>
				<td class="text-center">{{$res->cara_salin}}</td>
			</tr>
			<tr>
				<td>Umur Anak Terakhir (dalam bulan)</td>
				<td class="text-center">{{$res->umur}}</td>
			</tr>
			<tr>
				<td>Pemberian ASI saja sampai umur 4 bulan</td>
				<td class="text-center">{{$res->asi_4_bulan}}</td>
			</tr>
			<tr>
				<td>Lama pemberian ASI (dalam bulan)</td>
				<td class="text-center">{{$res->lama_asi}}</td>
			</tr>
			<tr>
				<td>HPHT</td>
				<td class="text-center">{{$res->hpht ?? "-" }}</td>
			</tr>
			<tr>
				<td>TP</td>
				<td class="text-center">{{$res->tp ?? "-" }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Kehamilan</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Hari Pertama Menstruasi</td>
				<td class="text-center">{{$res->menstruasi}}</td>
			</tr>
			<tr>
				<td>Umur Kehamilan (dalam minggu)</td>
				<td class="text-center">{{$res->lama_asi}}</td>
			</tr>
			<tr>
				<td>Tinggi Badan (cm)</td>
				<td class="text-center">{{$res->tinggi}}</td>
			</tr>
			<tr>
				<td>Berat Badan (Kg)</td>
				<td class="text-center">{{$res->berat}}</td>
			</tr>
			<tr>
				<td>Lingkar Lengan Atas (cm)</td>
				<td class="text-center">{{$res->lengan_atas}}</td>
			</tr>
			<tr>
				<td>Tekanan darah (mmHg)</td>
				<td class="text-center">{{$res->tekanan_darah_1}} / {{$res->tekanan_darah_2}}</td>
			</tr>
			<tr>
				<td>Kadar Hemogoblia saat MRS (g%)</td>
				<td class="text-center">{{$res->hemogoblia}}</td>
			</tr>
			<tr>
				<td>Jumlah Kunjungan ANC oleh Bidan</td>
				<td class="text-center">{{$res->anc_bidan}}</td>
			</tr>
			<tr>
				<td>Jumlah Kunjungan ANC oleh Dokter</td>
				<td class="text-center">{{$res->anc_dokter}}</td>
			</tr>
			<tr>
				<td>Imunisasi TT</td>
				<td class="text-center">{{$res->imunisasi_tt}}</td>
			</tr>
			<tr>
				<td>Pemberian Tablet Fe</td>
				<td class="text-center">{{$res->tablet_fe}}</td>
			</tr>
			<tr>
				<td>Pernah dirujuk selama kehamilan</td>
				<td class="text-center">{{$res->pernah_rujuk}}</td>
			</tr>
			@if($res->pernah_rujuk == 'Ya')
			<tr>
				<td>Umur Kehamilan ketika dirujuk (dalam satuan minggu)</td>
				<td class="text-center">{{$res->umur_hamil_rujuk}}</td>
			</tr>
			<tr>
				<td>Dirujuk Oleh</td>
				<td class="text-center">{{$res->dirujuk_oleh}}</td>
			</tr>
			<tr>
				<td>Pergi Rujuk</td>
				<td class="text-center">{{$res->pergi_rujuk != 'Lain-lain' ? $res->pergi_rujuk : $res->pergi_rujuk_lain2}}</td>
			</tr>
			<tr>
				<td>Alasan Dirujuk</td>
				<td class="text-center">{{$res->alasan_dirujuk}}</td>
			</tr>
			@endif
		</tbody>
	</table>
</div>
<div class="col-md-6">
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Persalinan</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Jenis Persalinan</td>
				<td class="text-center">{{$res->jenis_persalinan}}</td>
			</tr>
			<tr>
				<td>Presentasi janin pada persalinan</td>
				<td class="text-center">{{$res->presentasi_janin != 'Lain-lain' ? $res->presentasi_janin : $res->presentasi_janin_lain2}}</td>
			</tr>
			<tr>
				<td>Macam persalinan</td>
				<td class="text-center">{{$res->macam_persalinan != 'Lain-lain' ? $res->macam_persalinan : $res->macam_persalinan_lain2}}</td>
			</tr>
			<tr>
				<td>Komplikasi persalinan</td>
				<td class="text-center">{{$res->komplikasi_persalinan != 'Lain-lain' ? $res->komplikasi_persalinan : $res->komplikasi_persalinan_lain2}}</td>
			</tr>
			<tr>
				<td>Lama Persalinan Kala I (jam)</td>
				<td class="text-center">{{$res->lama_persalinan_1}}</td>
			</tr>
			<tr>
				<td>Lama Persalinan Kala II (menit)</td>
				<td class="text-center">{{$res->lama_persalinan_2}}</td>
			</tr>
			<tr>
				<td>Lama Ketuban Pecah sampai Bayi Lahir</td>
				<td class="text-center">{{$res->ketuban_pecah}}</td>
			</tr>
			<tr>
				<td>Penolong Persalinan</td>
				<td class="text-center">{{$res->penolong_persalinan != 'Lain-lain' ? $res->penolong_persalinan : $res->penolong_persalinan_lain2}}</td>
			</tr>
			<tr>
				<td>Tempat Persalinan</td>
				<td class="text-center">{{$res->tempat_persalinan != 'Lain-lain' ? $res->tempat_persalinan : $res->tempat_persalinan_lain2}}</td>
			</tr>
			<tr>
				<td>Keadaan Ibu Sampai Pulang</td>
				<td class="text-center">{{$res->keadaan_ibu}}</td>
			</tr>
			{{--<tr>
				<td>Penyebab Langsung Kematian Ibu</td>
				<td class="text-center">{{$res->penyebab_kematian_ibu != 'Lain-lain' ? $res->penyebab_kematian_ibu : $res->penyebab_kematian_ibu_lain2}}</td>
			</tr>--}}
		</tbody>
	</table>
	<table class="table table-sm table-striped table-vcenter" style="width: 100%">
		<thead>
			<tr>
				<th class="text-center">Bayi</th>
			</tr>
			<tr>
				<th style="width:70%">Parameter</th>
				<th class="text-center" style="width: 30%;">Kondisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Tanggal Kelahiran</td>
				<td class="text-center">{{$res->tgl_lahir_bayi}}</td>
			</tr>
			<tr>
				<td>Berat Badan</td>
				<td class="text-center">{{$res->berat_badan_bayi}}</td>
			</tr>
			<tr>
				<td>Panjang Badan (cm)</td>
				<td class="text-center">{{$res->panjang_badan}}</td>
			</tr>
			<tr>
				<td>Lingkar Kepala (cm)</td>
				<td class="text-center">{{$res->lingkar_kepala}}</td>
			</tr>
			<tr>
				<td>Lingkar Dada (cm)</td>
				<td class="text-center">{{$res->lingkar_dada}}</td>
			</tr>
			<tr>
				<td>Lingkar Lengan Atas</td>
				<td class="text-center">{{$res->lengan_atas_bayi}}</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td class="text-center">{{$res->jk_bayi}}</td>
			</tr>
			<tr>
				<td>Nilai Apgar (1 menit)</td>
				<td class="text-center">{{$res->nilai_apgar_1}}</td>
			</tr>
			<tr>
				<td>Nilai Apgar (5 menit)</td>
				<td class="text-center">{{$res->nilai_apgar_5}}</td>
			</tr>											<tr>
				<td>Keadaan Bayi Setelah Lahir</td>
				<td class="text-center">{{$res->keadaan_bayi_lahir != 'Lain-lain' ? $res->keadaan_bayi_lahir : $res->keadaan_bayi_lahir_lain2}}</td>
			</tr>											<tr>
				<td>Keadaan Bayi Sampai Umur 1 Minggu</td>
				<td class="text-center">{{$res->keadaan_bayi_1_minggu != 'Lain-lain' ? $res->keadaan_bayi_1_minggu : $res->keadaan_bayi_1_minggu_lain2}}</td>
			</tr>											
			<tr>
				<td>Kematian Janin / Bayi</td>
				<td class="text-center">{{$res->kematian_janin != 'Lain-lain' ? $res->kematian_janin : $res->kematian_janin_lain2}}</td>
			</tr>
			<tr>
				<td>Lamanya bayi bertahan setelah kelahiran sebelum akhirnya meninggal (dalam jam)</td>
				<td class="text-center">{{$res->bayi_bertahan}}</td>
			</tr>
			{{--<tr>
				<td>Penyebab Kematian Bayi</td>
				<td class="text-center">{{$res->penyebab_kematian_bayi != 'Lain-lain' ? $res->penyebab_kematian_bayi : $res->penyebab_kematian_bayi_lain2}}</td>
			</tr>--}}
			{{--<tr>
				<td>Keterlambatan dalam sistem Rujukan : Persetujuan dirujuk</td>
				<td class="text-center">{{$res->terlambat_rujuk_persetujuan}}</td>
			</tr>
			<tr>
				<td>Keterlambatan dalam sistem Rujukan : Sampai di RS</td>
				<td class="text-center">{{$res->terlambat_rujuk_sampai_rs}}</td>
			</tr>
			<tr>
				<td>Keterlambatan dalam sistem Rujukan : Penanganan di RS</td>
				<td class="text-center">{{$res->terlambat_rujuk_penanganan}}</td>
			</tr>--}}
			<tr>
				<td>Jenis Kelainan bawaan yang ditemukan</td>
				<td class="text-center">{{$res->kelainan_bawaan}}</td>
			</tr>
			<tr>
				<td>Nilai Dubowitz</td>
				<td class="text-center">{{$res->dubowitz}}</td>
			</tr>
			<tr>
				<td>Nilai Ballard</td>
				<td class="text-center">{{$res->ballard}}</td>
			</tr>
		</tbody>
	</table>
</div>