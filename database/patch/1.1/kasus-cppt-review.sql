ALTER TABLE `medify_hospital_kasus`.`cppt`   
  ADD COLUMN `review` TEXT NULL AFTER `tagihan_detail_id`,
  ADD COLUMN `review_at` TIMESTAMP NULL AFTER `review`,
  ADD COLUMN `review_by` INT NULL AFTER `review_at`;