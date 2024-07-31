<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL313bObatPelayananResep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ResepDetail;
use App\Models\Hospital\Lokasi;
use Carbon\Carbon;
use DB;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
        $start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
        $end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

        // $total = ResepDetail::whereBetween('created_at',[$start,$end])->count('id');
        return json_encode([
            'status' => 200,
            'data' => 3
        ]);
    }

    public function getData(Request $request)
    {
        $generik = "generik";
        $formularium = "formularium";
        $non_generik = "non-generik";
        $rajal = implode(",", Lokasi::leftJoin('lokasi_departemen', 'lokasi_departemen.id', '=', 'lokasi.lokasi_departemen_id')->where('lokasi_departemen.slug', '=', 'rawat-jalan')->pluck('lokasi.id')->toArray());
        $ranap = implode(",", Lokasi::leftJoin('lokasi_departemen', 'lokasi_departemen.id', '=', 'lokasi.lokasi_departemen_id')->where('lokasi_departemen.slug', '=', 'rawat-inap')->pluck('lokasi.id')->toArray());
        $igd = implode(",", Lokasi::leftJoin('lokasi_departemen', 'lokasi_departemen.id', '=', 'lokasi.lokasi_departemen_id')->where('lokasi_departemen.slug', '=', 'igd')->pluck('lokasi.id')->toArray());

        $start = Carbon::parse($request->datestart)->startOfDay()->toDateTimeString();
        $end = Carbon::parse($request->dateend)->endOfDay()->toDateTimeString();

        $kategori_generik = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getSingle('generik')->id;
        $kategori_formularium = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getSingle('fornas')->id;
        $item_template_ids_generik = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getItemTemplateIdByItemKategori($kategori_generik);
        $item_template_ids_non_generik_formularium = app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->getNonGenerikFormularium($kategori_generik, $kategori_formularium);
        $item_template_ids_non_generik_non_formularium = app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->getNonGenerikNonFormularium($kategori_generik, $kategori_formularium);
        $request_ke = $request->datafetched;

        $generik = implode(",", $item_template_ids_generik);
        $non_generik_formularium = implode(",", array_pluck($item_template_ids_non_generik_formularium, 'id'));
        $non_generik_non_formularium = implode(",", array_pluck($item_template_ids_non_generik_non_formularium, 'id'));

        $array_data = [];
        $content = "";

        if ($request_ke == 0) {
            $content = 1;
        } else if ($request_ke == 1) {
            $content = 'Obat Generik (Fornas + Non Fornas)';
        } else if ($request_ke == 2) {
            $generik_rajal = "
    		SELECT SUM(jumlah.value) AS generik_rajal FROM (
	    		SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t
				INNER JOIN resep r ON r.id = t.resep_final
				INNER JOIN resep_detail rd ON rd.resep_id = r.id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				AND t.lokasi_id IN ($rajal)
				AND item.item_template_id IN ($generik)
				AND t.deleted_at IS NULL
				AND t.paid_at IS NOT NULL
				UNION
				SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t
				INNER JOIN resep r ON r.id = t.resep_final
				INNER JOIN resep_detail rd ON rd.resep_id = r.id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				AND t.lokasi_id IN ($rajal)
				AND item.item_template_id IN ($generik)
				AND t.deleted_at IS NULL
				AND t.paid_at IS NOT NULL
				)jumlah";
            $generik_rajal = DB::connection('farmasi')->select($generik_rajal);
            $content = $generik_rajal[0]->generik_rajal ?? 0;
        } else if ($request_ke == 3) {
            $generik_igd = "
            SELECT SUM(jumlah.value) AS generik_igd FROM (
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN items_farmasi item ON rd.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($igd)
                AND item.item_template_id IN ($generik)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                UNION
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
                INNER JOIN items_farmasi item ON racikan.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($igd)
                AND item.item_template_id IN ($generik)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
            )jumlah";
            $generik_igd = DB::connection('farmasi')->select($generik_igd);
            $content = $generik_igd[0]->generik_igd ?? 0;
        } else if ($request_ke == 4) {
            $generik_ranap = "
            SELECT SUM(jumlah.value) AS generik_ranap FROM (
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN items_farmasi item ON rd.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($ranap)
                AND item.item_template_id IN ($generik)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                UNION
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
                INNER JOIN items_farmasi item ON racikan.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($ranap)
                AND item.item_template_id IN ($generik)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
            )jumlah";
            $generik_ranap = DB::connection('farmasi')->select($generik_ranap);
            $content = $generik_ranap[0]->generik_ranap ?? 0;
        } else if ($request_ke == 5) {
            $content = 2;
        } else if ($request_ke == 6) {
            $content = 'Obat Non Generik Fornas';
        } else if ($request_ke == 7) {
            $non_generik_formalium_rajal = "
            SELECT SUM(jumlah.value) AS non_generik_formalium_rajal FROM (
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN items_farmasi item ON rd.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($rajal)
                AND item.item_template_id IN ($non_generik_formularium)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                UNION
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
                INNER JOIN items_farmasi item ON racikan.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($rajal)
                AND item.item_template_id IN ($non_generik_formularium)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
            )jumlah";
            $non_generik_formalium_rajal = DB::connection('farmasi')->select($non_generik_formalium_rajal);
            $content = $non_generik_formalium_rajal[0]->non_generik_formalium_rajal ?? 0;
        } else if ($request_ke == 8) {
            $non_generik_formalium_igd = "
            SELECT SUM(jumlah.value) AS non_generik_formalium_igd FROM (
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN items_farmasi item ON rd.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($igd)
                AND item.item_template_id IN ($non_generik_formularium)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                UNION
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
                INNER JOIN items_farmasi item ON racikan.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($igd)
                AND item.item_template_id IN ($non_generik_formularium)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
            )jumlah";
            $non_generik_formalium_igd = DB::connection('farmasi')->select($non_generik_formalium_igd);
            $content = $non_generik_formalium_igd[0]->non_generik_formalium_igd ?? 0;
        } else if ($request_ke == 9) {
            $non_generik_formalium_ranap = "
            SELECT SUM(jumlah.value) AS non_generik_formalium_ranap FROM (
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN items_farmasi item ON rd.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($ranap)
                AND item.item_template_id IN ($non_generik_formularium)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                UNION
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
                INNER JOIN items_farmasi item ON racikan.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($ranap)
                AND item.item_template_id IN ($non_generik_formularium)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
            )jumlah";
            $non_generik_formalium_ranap = DB::connection('farmasi')->select($non_generik_formalium_ranap);
            $content = $non_generik_formalium_ranap[0]->non_generik_formalium_ranap ?? 0;
        } else if ($request_ke == 10) {
            $content = 3;
        } else if ($request_ke == 11) {
            $content = 'Obat Non Generik Non Fornas';
        } else if ($request_ke == 12) {
            $non_generik_non_formalium_rajal = "
            SELECT SUM(jumlah.value) AS non_generik_non_formalium_rajal FROM (
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN items_farmasi item ON rd.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($rajal)
                AND item.item_template_id IN ($non_generik_non_formularium)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                UNION
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
                INNER JOIN items_farmasi item ON racikan.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($rajal)
                AND item.item_template_id IN ($non_generik_non_formularium)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
            )jumlah";
            $non_generik_non_formalium_rajal = DB::connection('farmasi')->select($non_generik_non_formalium_rajal);
            $content = $non_generik_non_formalium_rajal[0]->non_generik_non_formalium_rajal ?? 0;
        } else if ($request_ke == 13) {
            $non_generik_non_formalium_igd = "
            SELECT SUM(jumlah.value) AS non_generik_non_formalium_igd FROM (
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN items_farmasi item ON rd.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($igd)
                AND item.item_template_id IN ($non_generik_non_formularium)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                UNION
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
                INNER JOIN items_farmasi item ON racikan.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($igd)
                AND item.item_template_id IN ($non_generik_non_formularium)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
            )jumlah";
            $non_generik_non_formalium_igd = DB::connection('farmasi')->select($non_generik_non_formalium_igd);
            $content = $non_generik_non_formalium_igd[0]->non_generik_non_formalium_igd ?? 0;
        } else if ($request_ke == 14) {
            $non_generik_non_formalium_ranap = "
            SELECT SUM(jumlah.value) AS non_generik_non_formalium_ranap FROM (
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN items_farmasi item ON rd.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($ranap)
                AND item.item_template_id IN ($non_generik_non_formularium)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
                UNION
                SELECT COUNT(rd.id) AS value
                FROM transaksi_obat t
                INNER JOIN resep r ON r.id = t.resep_final
                INNER JOIN resep_detail rd ON rd.resep_id = r.id
                INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
                INNER JOIN items_farmasi item ON racikan.obat_id = item.id
                WHERE t.created_at >= '$start'
                AND t.created_at <= '$end'
                AND t.lokasi_id IN ($ranap)
                AND item.item_template_id IN ($non_generik_non_formularium)
                AND t.deleted_at IS NULL
                AND t.paid_at IS NOT NULL
            )jumlah";
            $non_generik_non_formalium_ranap = DB::connection('farmasi')->select($non_generik_non_formalium_ranap);
            $content = $non_generik_non_formalium_ranap[0]->non_generik_non_formalium_ranap ?? 0;
        }

        return json_encode([
            'content' => $content
        ]);


    }
}
