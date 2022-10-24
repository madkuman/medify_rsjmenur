<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionRawatInapGetWaktuPerawatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('rawatinap')->unprepared('
        CREATE DEFINER=`'.config('app.db_user').'`@`%` FUNCTION `get_waktu_perawatan`(date_min DATE, date_max DATE, tempat_tidur_ids TEXT) RETURNS int
BEGIN
	DECLARE hari_perawatan INT;
	DECLARE hari_perawatan_sekarang INT;
	DECLARE date_sekarang DATE;

	SET hari_perawatan = 0;
	SET date_sekarang = date_min;
	
	while1: WHILE date_sekarang <= date_max DO
	
		SET hari_perawatan_sekarang = (SELECT COUNT(1) 
						FROM (
							SELECT tempat_tidur_id, COUNT(1) 
							FROM '.config('app.db_name').'_rawat_inap.transaksi 
							JOIN '.config('app.db_name').'_rawat_inap.`tempat_tidur` ON transaksi.`tempat_tidur_id` = tempat_tidur.`id`
							WHERE DATE(waktu_masuk) <= date_sekarang AND 
							(
								DATE(waktu_keluar) >= date_sekarang
								OR DATE(waktu_keluar) IS NULL
							)
							AND tempat_tidur_id IS NOT NULL
							AND transaksi.`deleted_at` IS NULL
							AND tempat_tidur.`deleted_at` IS NULL
                            AND FIND_IN_SET(tempat_tidur_id, tempat_tidur_ids)
							AND transaksi.`status` != -1
							GROUP BY tempat_tidur_id
						) AS t);
		SET hari_perawatan = hari_perawatan + hari_perawatan_sekarang;
		SET date_sekarang = DATE_ADD(date_sekarang, INTERVAL 1 DAY);
	END WHILE while1;

	   RETURN hari_perawatan;

    END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection('rawatinap')->unprepared('DROP FUNCTION IF EXISTS get_waktu_perawatan');
    }
}
