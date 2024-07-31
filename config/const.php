<?php 

return [
	'igd' => "igd",
	'rawat_jalan' => "rawat-jalan",
	'rawat_inap' => "rawat-inap",
	'medical_checkup' => "medical-checkup",
	'rawat-jalan' => "rawat-jalan",
	'rawat-inap' => "rawat-inap",
	'medical-checkup' => "medical-checkup",
	'rj' => "rawat-jalan",
	'ri' => "rawat-inap",
	'mc' => "medical-checkup",
	'all' => "all",
	'radiologi' => "radiologi",
	'labpa' => "lab-pa",
	'lab-pa' => "lab-pa",
	'labpk' => "lab-pk",
	'lab-pk' => "lab-pk",
	'name-medical-checkup' => "Medical Checkup",
	'name-rawat-jalan' => "Rawat Jalan",
	'name-rawat-inap' => "Rawat Inap",
	'name-igd' => "IGD",
	'name-all' => "Semua Layanan",
	'layanan-array' => ['rawat-jalan','igd','rawat-inap','medical-checkup','all'],
	'layanan-array-4' => ['rawat-jalan','igd','rawat-inap','medical-checkup'],
	'download_laporan_url' => 'downloads/laporan/',
	'profesi_dokter' => 1,
	'state_ditagih' => "ditagih",
	'state_dibayar' => "dibayar",
	'asuransi_bpjs_non_pbi' => [1],
	'asuransi_bpjs_pbi' => [2],
	'asuransi_jamkesda_p100' => [3],
	'asuransi_jamkesda_p50' => [4],
	'asuransi_jamkesda_sby' => [5],
	'asuransi_tunai' => [6],
	'asuransi_kartu_sehati' => [7],
	'asuransi_spm' => [8],
	'asuransi_sk_direktur' => [9],
    'asuransi_kemenkes_covid' => [15],
	'state_fpk'            => "konfirmasi fpk",
	'state_piutang_1'      => "pending",
	'state_piutang_2'      => "penagihan",
	'state_piutang_3'      => "terbayar",
	'bpjs'                 => 1,
	'umbal_status_1'       => 'klaim', #Klaim      : Ada di Paket & FPK
	'umbal_status_2'       => 'dispute', #Dispute  : Ada di Paket , di FPK tidak ada
	'umbal_status_3'       => 'tambahan', #Tambahan: Tidak ada di Paket , di FPK ada
	'umbal_status_4'       => 'tidak ada di sistem', # Tidak ada di Paket , ada di FPK, tidak ada di system (alias buat baru)
	'umbal_status_5'          => 'duplikasi', # Sudah Pernah ditagihkan dan diklaim
    'state_paket_penagihan_1' => "ditagih",
    'state_paket_penagihan_2' => "konfirmasi fpk",
    'state_paket_penagihan_3' => "siap bayar",
    'state_paket_penagihan_4' => "dibayar",
	#inputan sep v2
	'pembiayaan'			  => [
		'1' => 'Pribadi',
		'2' => 'Pemberi Kerja',
		'3' => 'Asuransi Kesehatan Tambahan'
	],
	'tujuan_kunjungan'	       => [
		'0' => 'Normal',
		'1' => 'Prosedur',
		'2' => 'Konsul Dokter'
	],
    'flag_procedure'          => [
        '0' => 'Prosedur Tidak Berkelanjutan',
        '1' => 'Prosedur dan Terapi Berkelanjutan'
    ],
    'kode_penunjang'          => [
        "1" => 'Radioterapi',
        "2" => 'Kemoterapi',
        "3" => 'Rehabilitasi Medik',
        "4" => 'Rehabilitasi Psikososial',
        "5" => 'Transfusi Darah',
        "6" => 'Pelayanan Gigi',
        "7" => 'Laboratorium',
        "8" => 'USG',
        "9" => 'Farmasi',
        "10" => 'Lain-Lain',
        "11" => 'MRI',
        "12" => 'HEMODIALISA',
    ],
    'asesment_pelayanan'      => [
        "1" => 'Poli spesialis tidak tersedia pada hari sebelumnya',
        "2" => 'Jam Poli telah berakhir pada hari sebelumnya',
        "3" => 'Dokter Spesialis yang dimaksud tidak praktek pada hari sebelumnya',
        "4" => 'Atas Instruksi RS',
		"5" => 'Tujuan Kontrol',
	],
	'kelas_rawat_naik' 		=> [
									"1" => 'VVIP',
									"2" => 'VIP',
									"3" => '1',
									"4" => '2',
									"5" => '3',
									"6" => 'ICCU',
									"7" => 'ICU',
								],
	'laka_lantas'			=> [
									'0' => 'Bukan Kecelakaan Lalu Lintas (BKKL)',
									'1' => 'KLL dan bukan kecelakaan Kerja (BKK)',
									'2' => 'KLL dan KK',
									'3' => 'Kecelakaan Kerja (KK)',
								],
	'kategori_resep' => [
		'racikan-kapsul' => 'Racikan Kapsul',
		'racikan-puyer'	=> 'Racikan Puyer',
		'racikan-salep' => 'Racikan Salep',
		'resep-obat-jadi' => 'Resep Obat Jadi',
		'dispensing-aseptik' => 'Dispensing Aseptik',
		'obat-sediaan-tpn' => 'Obat Sediaan TPN',
		'sirup-kering' => 'Sirup Kering',
	],
];

?>