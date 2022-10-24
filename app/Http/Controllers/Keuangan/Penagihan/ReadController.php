<?php

namespace App\Http\Controllers\Keuangan\Penagihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\PaketPenagihan;
use App\Models\Keuangan\PenagihanBPJS;
use App\Models\Keuangan\KategoriBPJS;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Models\Keuangan\Perusahaan;
use DB;

defined('relasi_piutang') OR define('relasi_piutang', ['pasien', 'kategori', 'perusahaan']);

class ReadController extends Controller
{
    public function getSiapByFilter(Request $request)
    {
        $query = PaketPenagihan::where('status', config('const.state_ditagih'));

        return DataTables::of($query)
        ->toJson();
    }

    public function getByFilter(Request $request)
    {
        $query = PaketPenagihan::whereNull('status');

        return DataTables::of($query)
        ->toJson();
    }

    public function getBySlug($slug)
    {
        return PaketPenagihan::where('slug', $slug)->with(['detail', 'detail.detail', 'detail_bpjs'])->first();
    }

    public function getPenagihanBpjs($id, $relations)
    {
        return PenagihanBPJS::with($relations)->find($id);
    }

    public function getLaporan($start, $end, $tipe)
    {
        if($tipe == 0)
            return PaketPenagihan::whereBetween('created_at', [$start, $end])->with('detail')->get();
        else
            return PaketPenagihan::whereBetween('created_at', [$start, $end])->where('pembayaran_perusahaan_tipe_id', $tipe)->with('detail')->get();
    }

    public function getByPaket($penagihan_id, $kategori_bpjs_id)
    {
        return PenagihanBPJS::where('paket_penagihan_id', $penagihan_id)->where('kategori_bpjs_id', $kategori_bpjs_id)->first();
    }

    public function getSingle($penagihan_bpjs_id)
    {
        return PenagihanBPJS::with('piutang_detail')->find($penagihan_bpjs_id);
    }

    public function getSingleBpjs($paket)
    {
        $piutang_ids = $this->convertIdToString($paket->detail->pluck('id')->toArray());
        $kategori_bpjs = DB::connection('keuangan')->select(DB::raw('select k.id, k.name, k.parent_id, k.title, sum(d.subtotal) as total from kategori_bpjs k, piutang p,
                            piutang_detail d where p.pernah_ditolak=0 and d.piutang_id in '.$piutang_ids.' and d.piutang_id=p.id and d.deleted_at is null and d.kategori_bpjs_id=k.id and d.kategori_bpjs_id is not null group by d.kategori_bpjs_id'));
        return $this->reshapeKategoriBpjs($kategori_bpjs);
    }

    public function getDetailBpjs($paket, $kategori_bpjs_id)
    {
        $piutang_ids = $this->convertIdToString($paket->detail->pluck('id')->toArray());
        $pasien_ids = $paket->detail->pluck('pasien_id')->toArray();
        switch ($kategori_bpjs_id) {
            case 2:
                $piutang_detail = DB::connection('keuangan')->select(DB::raw('select p.pasien_id, sum(d.subtotal) as total, p.id, p.pernah_ditolak
                                    from piutang p, piutang_detail d where p.id in '.$piutang_ids.' and d.piutang_id=p.id and d.deleted_at is null 
                                    and d.kategori_bpjs_id in (2, 8) group by p.pasien_id;'));
                break;
            case 4:
                $piutang_detail = DB::connection('keuangan')->select(DB::raw('select p.pasien_id, sum(d.subtotal) as total, p.id, p.pernah_ditolak
                                    from piutang p, piutang_detail d where p.id in '.$piutang_ids.' and d.piutang_id=p.id and d.deleted_at is null 
                                    and d.kategori_bpjs_id in (2, 8) group by p.pasien_id;'));
                break;
            default:
                $piutang_detail = DB::connection('keuangan')->select(DB::raw('select p.pasien_id, sum(d.subtotal) as total, p.id, p.pernah_ditolak 
                                    from piutang p, piutang_detail d where p.id in '.$piutang_ids.' and d.piutang_id=p.id and d.deleted_at is null 
                                    and d.kategori_bpjs_id = '.$kategori_bpjs_id.' group by p.pasien_id;'));
                break;
        }
        $pasien = \App\Models\Pasien\Pasien::whereIn('id', $pasien_ids)->get();
        $pasien_result = [];
        foreach($pasien as $p){
            $pasien_result[$p->id] = $p->name;
        }
        return [
            'piutang' => $piutang_detail,
            'pasien' => $pasien_result,
            'kategori_bpjs' => KategoriBPJS::find($kategori_bpjs_id)
        ];
    }

    private function convertIdToString($inputs)
    {
        $res = "(";
        foreach($inputs as $i => $in)
        {
            $res .= $in;
            if(isset($inputs[$i+1]))
                $res .= ", ";
        }
        $res .= ")";
        return $res;
    }

    private function reshapeKategoriBpjs($kategori)
    {
        $res = [];
        foreach($kategori as $k)
        {
            if(!is_null($k->parent_id)){
                if(isset($res[$k->parent_id]))
                    $res[$k->parent_id]->total += $k->total;
                else
                    $res[$k->parent_id] = $k;
            }
            else
                $res[$k->id] = $k;
        }
        return $res;
    }
}