USE `medify_hospital_kasus`;
ALTER TABLE `medify_hospital_kasus`.`alat_edukasi_pasien`
	ADD COLUMN `nama_ttd` VARCHAR(50) NULL DEFAULT NULL AFTER `jenis`,
	ADD COLUMN `img_ttd` VARCHAR(255) NULL DEFAULT NULL AFTER `rekomendasi`;