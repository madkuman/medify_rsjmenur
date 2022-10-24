<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
ALTER TABLE `asesmen_risiko_jatuh_psikiatri`
	ADD COLUMN `pengobatan_tanpa` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `pengobatan_jantung` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `pengobatan_psikotoprik` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `pengobatan_tambahan` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `diagnosa_bipolar` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `diagnosa_obat` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `diagnosa_gangguan` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `diagnosa_demensia` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `pengobatan_tanpa_skor` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `pengobatan_jantung_skor` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `pengobatan_psikotoprik_skor` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `pengobatan_tambahan_skor` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `diagnosa_bipolar_skor` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `diagnosa_obat_skor` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `diagnosa_gangguan_skor` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `diagnosa_demensia_skor` INT(10) NOT NULL DEFAULT '0';

<<<<<<< HEAD
ALTER TABLE `asesmen_awal_3`
	ADD COLUMN `edmonson_pengobatan_tanpa` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_pengobatan_jantung` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_pengobatan_psikotoprik` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_pengobatan_tambahan` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_diagnosa_bipolar` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_diagnosa_obat` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_diagnosa_gangguan` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_diagnosa_demensia` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_pengobatan_tanpa_skor` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_pengobatan_jantung_skor` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_pengobatan_psikotoprik_skor` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_pengobatan_tambahan_skor` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_diagnosa_bipolar_skor` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_diagnosa_obat_skor` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_diagnosa_gangguan_skor` INT(10) NOT NULL DEFAULT '0',
	ADD COLUMN `edmonson_diagnosa_demensia_skor` INT(10) NOT NULL DEFAULT '0';



pengobatan_tanpa
pengobatan_jantung
pengobatan_psikotoprik
pengobatan_tambahan
diagnosa_bipolar
diagnosa_obat
diagnosa_gangguan
diagnosa_demensia
pengobatan_tanpa_skor
pengobatan_jantung_skor
pengobatan_psikotoprik_skor
pengobatan_tambahan_skor
diagnosa_bipolar_skor
diagnosa_obat_skor
diagnosa_gangguan_skor
diagnosa_demensia_skor
php artisan make:migration create_table_master_sirs_gigi_mulut --path=database/migrations/features/2021-04/administrasi/laporan-v2
php artisan make:migration create_table_master_sirs_rehab_medik --path=database/migrations/features/2021-04/administrasi/laporan-v2
php artisan make:migration create_table_master_sirs_pelayanan_khusus --path=database/migrations/features/2021-04/administrasi/laporan-v2
php artisan make:migration create_table_master_sirs_kesehatan_jiwa --path=database/migrations/features/2021-04/administrasi/laporan-v2
php artisan make:migration alter_table_tarif_kategori --path=database/migrations/features/2021-04/administrasi/laporan-v2
php artisan make:migration create_table_master_sirs_cara_bayar --path=database/migrations/features/2021-04/administrasi/laporan-v2
php artisan make:migration alter_table_pembayaran_perusahaan --path=database/migrations/features/2021-04/administrasi/laporan-v2
php artisan migrate --path=database/migrations/features/2021-04/administrasi/laporan-v2