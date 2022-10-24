<div class="row">
	<div class="col-md-6">
		<table width="100%">
			<tr>
				<td width="25%"></td>
				<td width="2%"></td>
				<td width="73%"></td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>INFORMASI AWAL</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Alergi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['alergi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Risiko</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['risiko'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tanggal datang</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['tanggal_datang'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Jam datang</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['jam_datang'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kategori pasien</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kategori_pasien'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tanggal rujukan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['tanggal_rujukan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Nomor rujukan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['nomor_rujukan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Dokter pengirim</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['dokter_pengirim'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>ASESMEN KEPERAWATAN</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tanggal pengkajian</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['tanggal_pengkajian'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Jam pengkajian</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['jam_pengkajian'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Keluhan utama</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($item['keluhan_utama'] ?? '-') !!}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>STATUS FISIK</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">GCS</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['gcs'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tekanan darah</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['tekanan_darah'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Frekuensi nadi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['frekuensi_nadi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Berat badan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['berat_badan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Suhu</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['suhu'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Pernapasan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['pernapasan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tinggi badan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['tinggi_badan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>STATUS PSIKOLOGIS</b></td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Penampilan</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Rapi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['rapi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tidak rapi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['tidak_rapi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tidak sesuai</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['tidak_sesuai'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['penampilan_lain_lain'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Pembicaraan</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Keras</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['keras'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Diam</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['diam'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Cepat</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['cepat'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lambat</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['lambat'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Non realistis</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['non_realistis'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['pembicaraan_lain_lain'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Aktivitas Motorik</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lesu</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['lesu'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Gelisah</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['gelisah'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Mondar mandir</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['mondar_mandir'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['aktivitas_motorik_lain_lain'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Alam Perasaan</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Cemas</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['cemas'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Sedih</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['sedih'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Takut</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['takut'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Gembira berlebihan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['gembira_berlebihan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['alam_perasaan_lain_lain'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Proses pikir</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['proses_pikir'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Persepsi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['persepsi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>STATUS SOSIAL</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Yang menemani pasien di rs</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['yang_menemani_pasien_di_rs'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>SPIRITUAL</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Saat ini apakah pasien membutuhkan pelayanan rohani?</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kebutuhan_pelayanan_rohani_pasien'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>STATUS EKONOMI</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Penanggung jawab biaya perawatan pasien</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['penanggung_jawab_biaya_perawatan_pasien'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>RIWAYAT KESEHATAN</b></td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Pupil</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Normal</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['normal'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Miosis</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['miosis'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Midriasis</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['midriasis'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Isokor</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['isokor'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Anisokor</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['anisokor'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['pupil_lain2'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Neuro Sensori Motorik</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Neuro sensori motorik tidak ada keluhan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['neuro_sensori_motorik_tidak_ada_keluhan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Neuro sensori motorik spasme otot</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['neuro_sensori_motorik_spasme_otot'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Neuro sensori motorik perubahan sensorik</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['neuro_sensori_motorik_perubahan_sensorik'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Neuro sensori motorik perubahan motorik</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['neuro_sensori_motorik_perubahan_motorik'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['neuro_sensori_motorik_lain2'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Kepala Leher</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kepala leher tidak ada gangguan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kepala_leher_tidak_ada_gangguan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kepala leher anemis</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kepala_leher_anemis'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kepala leher pernapasan cuping hidung</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kepala_leher_pernapasan_cuping_hidung'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kepala leher benjolan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kepala_leher_benjolan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kepala leher dispenea</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kepala_leher_dispenea'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kepala_leher_lain2'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Thorax</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Thorax tidak ada gangguan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['thorax_tidak_ada_gangguan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Thorax asimetris</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['thorax_asimetris'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Thorax wheezing</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['thorax_wheezing'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Thorax ronchi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['thorax_ronchi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Thorax pernapasan cuping hidung</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['thorax_pernapasan_cuping_hidung'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Thorax atelektasis</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['thorax_atelektasis'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['thorax_lain2'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Muskuloskeletal</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Muskuloskeletal tidak ada gangguan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['muskuloskeletal_tidak_ada_gangguan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Muskuloskeletal kerusakan jaringan atau luka</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['muskuloskeletal_kerusakan_jaringan_atau_luka'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Muskuloskeletal fraktur</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['muskuloskeletal_fraktur'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Muskuloskeletal dislokasi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['muskuloskeletal_dislokasi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Muskuloskeletal luksasio</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['muskuloskeletal_luksasio'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Muskuloskeletal perubahan bentuk ekstremitas</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['muskuloskeletal_perubahan_bentuk_ekstremitas'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['muskuloskeletal_lain2'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Kulit</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kulit tidak ada gangguan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kulit_tidak_ada_gangguan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kulit luka</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kulit_luka'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kulit lecet</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kulit_lecet'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kulit robek</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kulit_robek'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kulit combus</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kulit_combus'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kulit ganggren</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kulit_ganggren'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kulit_lain2'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Turgor Kulit</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Turgor normal</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['turgor_normal'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Turgor turun</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['turgor_turun'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['turgor_kulit_lain2'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Edema</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Edema tidak ada</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['edema_tidak_ada'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Edema seluruh</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['edema_seluruh'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Edema anggota gerak</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['edema_anggota_gerak'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Edema kelopak mata</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['edema_kelopak_mata'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Edema perut</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['edema_perut'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['edema_lain2'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Mukosa Mulut</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Mukosa lembab</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['mukosa_lembab'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Mukosa kering</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['mukosa_kering'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['mukosa_mulut_lain2'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Intoksifikasi</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Makanan minuman</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['makanan_minuman'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Zat kimia</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['zat_kimia'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Gigitan hewan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['gigitan_hewan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Gas</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['gas'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Obat</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['obat'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Eleminasi</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Frekuensi bab</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['frekuensi_bab'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Konsistensi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['konsistensi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Warna bab</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['warna_bab'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Frekuensi bak</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['frekuensi_bak'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Warna baK</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['warna_baK'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Riwayat penyakit dahulu</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($item['riwayat_penyakit_dahulu'] ?? '-') !!}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Riwayat penyakit keluarga</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($item['riwayat_penyakit_keluarga'] ?? '-') !!}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Riwayat konsumsi alkohol</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($item['riwayat_konsumsi_alkohol'] ?? '-') !!}</td>
			</tr>
		</table>		
	</div>
	<div class="col-md-6">
		<table width="100%">
			<tr>
				<td width="25%"></td>
				<td width="2%"></td>
				<td width="73%"></td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>RIWAYAT ALERGI</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Ada alergi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['ada_alergi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tidak ada alergi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['tidak_ada_alergi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Alergi tidak diketahui</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['alergi_tidak_diketahui'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Gelang tanda alergi terpasang</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['gelang_tanda_alergi_terpasang'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Alergi terhadap</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['alergi_terhadap'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Reaksi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['reaksi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>SKRINING NYERI</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Nyeri scala</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['nyeri_scala'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Nyeri lokasi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['nyeri_lokasi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Nyeri durasi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['nyeri_durasi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Nyeri frekuensi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['nyeri_frekuensi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Nyeri karakteristik</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['nyeri_karakteristik'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>ASESMEN AWAL RESIKO JATUH</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Pasien tampak tidak seimbang</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['pasien_tampak_tidak_seimbang'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Pasien memegang pinggiran</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['pasien_memegang_pinggiran'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Penilaian resiko jatuh</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['penilaian_resiko_jatuh'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>ASESMEN FUNGSIONAL</b></td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Sensorik Penglihatan</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Penglihatan normal</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['penglihatan_normal'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Penglihatan kabur</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['penglihatan_kabur'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Penglihatan kacamata</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['penglihatan_kacamata'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Penglihatan lensa kontak</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['penglihatan_lensa_kontak'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['sensorik_penglihatan_lain_lain'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Sensorik Penciuman</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Penciuman normal</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['penciuman_normal'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Penciuman tidak normal</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['penciuman_tidak_normal'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['sensorik_penciuman_lain_lain'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Sensorik Pendengaran</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Pendengaran normal</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['pendengaran_normal'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Pendengaran tuli kanan kiri</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['pendengaran_tuli_kanan_kiri'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Pendengaran alat bantu dengar kanan kiri</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['pendengaran_alat_bantu_dengar_kanan_kiri'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['sensorik_pendengaran_lain_lain'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Kognitif</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kognitif orientasi penuh</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kognitif_orientasi_penuh'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kognitif pelupa</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kognitif_pelupa'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kognitif bingung</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kognitif_bingung'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kognitif tidak dapat dimengerti</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kognitif_tidak_dapat_dimengerti'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kognitif_lain_lain'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Motorik Aktivitas Sehari-hari</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Aktivitas mandiri</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['aktivitas_mandiri'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Aktivitas bantuan minimal</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['aktivitas_bantuan_minimal'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Aktivitas bantuan sebagian</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['aktivitas_bantuan_sebagian'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Aktivitas ketergantungan total</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['aktivitas_ketergantungan_total'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['motorik_aktivitas_seharihari_lain_lain'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Motorik Berjalan</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Berjalan tidak ada kesulitan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['berjalan_tidak_ada_kesulitan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Berjalan sering jatuh</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['berjalan_sering_jatuh'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Berjalan perlu bantuan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['berjalan_perlu_bantuan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Berjalan kelumpuhan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['berjalan_kelumpuhan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['motorik_berjalan_lain_lain'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>SKRINING GIZI AWAL</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Gizi 6 bulan terakhir BB turun</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['gizi_enam_bulan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Gizi asupan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['gizi_asupan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Pasien kondisi khusus</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['pasien_kondisi_khusus'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>PERENCANAAN PULANG PASIEN</b></td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>Kebutuhan Discharge Planning Awal</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Discharge planning tidak ada</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['discharge_planning_tidak_ada'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Discharge planning usia lanjut 60 tahun lebih</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['discharge_planning_usia_lanjut_60_tahun_lebih'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Discharge planning hambatan mobilisasi</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['discharge_planning_hambatan_mobilisasi'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Discharge planning pelayanan medis</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['discharge_planning_pelayanan_medis'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Discharge planning bergantung untuk aktivitas harian</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['discharge_planning_bergantung_aktivitas'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Kriteria discharge planning lain</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['kriteria_discharge_planning_lain'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>KEPERAWATAN</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Masalah keperawatan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{!! nl2br($item['masalah_keperawatan'] ?? '-') !!}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>PERENCANAAN KEPERAWATAN</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">NCP 01</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['ncp_01'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">NCP 02</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['ncp_02'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">NCP 03</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['ncp_03'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">NCP 04</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['ncp_04'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">NCP 05</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['ncp_05'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">NCP 06</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['ncp_06'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">NCP 07</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['ncp_07'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Rencana keperawatan lainnya</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['rencana_keperawatan_lainnya'] ?? '-'}}</td>
			</tr>
			<tr>
				<td colspan="3" class="align-top border-bottom"><b>IMPLEMENTASI KEPERAWATAN</b></td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tanggal jam implementasi keperawatan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['tanggal_jam_implementasi_keperawatan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Tindakan implementasi keperawatan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['tindakan_implementasi_keperawatan'] ?? '-'}}</td>
			</tr>
			<tr>
				<td class="align-top border-bottom">Evaluasi implementasi keperawatan</td>
				<td class="align-top border-bottom">:</td>
				<td class="align-top border-bottom">{{$item['evaluasi_implementasi_keperawatan'] ?? '-'}}</td>
			</tr>
		</table>
	</div>
</div>
