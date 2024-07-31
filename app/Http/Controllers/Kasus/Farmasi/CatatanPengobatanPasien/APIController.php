<?php

namespace App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\CatatanPengobatanPasien;
use App\Models\Kasus\CatatanPengobatanPasienDetail;
use App\Models\Kasus\Resep;
use Carbon\Carbon;

class APIController extends Controller
{
    public function getContent1Day(Request $request)
    {
        $rpo_ids = CatatanPengobatanPasien::where('kasus_id',$request->kasus_id)->take($request->limit)->skip($request->offset)->pluck('id')->toArray();

        $rpo_items = CatatanPengobatanPasienDetail::whereIn('catatan_pengobatan_pasien_id',$rpo_ids)->whereDate('pemberian_at',$request->date)->orderBy('pemberian_at','asc')->select('id','pemberian_at','id','catatan_pengobatan_pasien_id','status')->get();

        return json_encode($rpo_items);

    }

    public function getCatatanPengobatanPasienDetailData(Request $request)
    {
        $select = ['id','pemberian_at','catatan_pengobatan_pasien_id','status','evaluasi','verified_by','verified_by_2', 'created_by', 'updated_by','verifikator_name_1', 'verifikator_name_2','path_ttd_verif_1','path_ttd_verif_2'];
        
        $data = CatatanPengobatanPasienDetail::where('id',$request->id)
                    ->select($select)
                    ->with(['creator:id,name,profesi','updater:id,name,profesi'])
                    ->first();
            
        return $data;
    }

    public function getContentDays(Request $request)
    {
        $date_count = $request->date_count - 1;
        $date_end = Carbon::parse($request->date_end)->endOfDay();
        $date_start = $date_end->copy()->subDays($date_count)->startOfDay();

        $rpo_ids = CatatanPengobatanPasien::where('kasus_id',$request->kasus_id)->take($request->limit)->skip($request->offset)->pluck('id')->toArray();

        $rpo_items = CatatanPengobatanPasienDetail::whereIn('catatan_pengobatan_pasien_id',$rpo_ids)->whereBetween('pemberian_at',[$date_start,$date_end])->orderBy('pemberian_at','asc')->select('id','pemberian_at','id','catatan_pengobatan_pasien_id','status')->get();
        // dd($rpo_items);

        return json_encode($rpo_items);
    }

    public function getCatatanPengobatanPasienPerObat(Request $request)
    {
        $rpo = CatatanPengobatanPasien::where('kasus_id',$request->kasus_id)->where('id',$request->cpo_id)->first();

        $rpo_items = CatatanPengobatanPasienDetail::where('catatan_pengobatan_pasien_id',$rpo->id)->orderBy('pemberian_at','asc')->select('id','pemberian_at','status')->get();

        if(count($rpo_items) == 0){
            $data['status'] = 404;
            return json_encode($data);
        } 

        $rpo_pemberian_first = CatatanPengobatanPasienDetail::where('catatan_pengobatan_pasien_id',$rpo->id)->orderBy('pemberian_at','asc')->first()->pemberian_at;
        $rpo_pemberian_latest = CatatanPengobatanPasienDetail::where('catatan_pengobatan_pasien_id',$rpo->id)->orderBy('pemberian_at','desc')->first()->pemberian_at;
        // dd($rpo_pemberian_first);
        $rpo_pemberian_first_temp = Carbon::parse($rpo_pemberian_first)->startOfDay();
        $rpo_pemberian_latest_temp = Carbon::parse($rpo_pemberian_latest)->startOfDay();
        $diff = $rpo_pemberian_first_temp->diffInDays($rpo_pemberian_latest_temp);

        $date_list = [];

        for($i=0;$i<=$diff;$i++)
        {
            $temp_date = Carbon::parse($rpo_pemberian_first)->copy()->addDays($i);
            $date_list[] = indonesian_date($temp_date,'Y-m-d');
        }


        $data['rpo_items'] = $rpo_items;
        $data['rpo_pemberian_first'] = Carbon::parse($rpo_pemberian_first)->copy()->format('Y-m-d');
        $data['rpo_pemberian_latest'] = Carbon::parse($rpo_pemberian_latest)->copy()->format('Y-m-d');
        $data['rpo_total'] = count($rpo_items);
        $data['status'] = 200;

        $data['date_list'] = $date_list;

        return json_encode($data);
    }

    public function getCatatanPengobatanPasienById(Request $request)
    {
        $cpo = CatatanPengobatanPasien::with(['details', 'item_master'])->where('id', $request->id)->first();

        if (!empty($cpo)) {
            $resep = Resep::with(['transaksi_farmasi', 'resepDetail'])
                ->where('kasus_id', $cpo->kasus_id)
                ->get();

            $obat = [];
            $cpo->resep = $resep;
            foreach ($resep as $item) {
    //            hanya jika transaksi obat sudah dikonfirmasi -> status = 1
                if (($item->transaksi_farmasi->status ?? 0) > 0) {
                    foreach ($item->resepDetail ?? [] as $_item) {
                        $obat_id = $_item->obat_id ?? 0;
                        $obat[$obat_id] = ($obat[$obat_id] ?? 0) + ($_item->jumlah ?? 0);
                    }
                }
            }

            $cpo->jumlah_obat = $obat[$cpo->obat_id] ?? 0;
            $cpo->sisa = $cpo->jumlah_obat - $cpo->consumed;
        }

        if (empty($cpo)) {
            $data['status'] = 404;
            return json_encode($data);
        }
        return $cpo;
    }
}
