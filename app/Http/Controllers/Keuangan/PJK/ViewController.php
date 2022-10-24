<?php

namespace App\Http\Controllers\Keuangan\PJK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\Utang;
use App\Models\Keuangan\UtangDetail;
use App\Models\Keuangan\AkunPJK;
use Carbon\Carbon;
use DB;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = "utang";
        $today = Carbon::today();
        $data['today'] = $today;
        $data['utang_num'] = Utang::where('tanggal_transaksi','>',$today)->whereNull('tanggal_spp')->count();
        $data['utang_total'] = Utang::where('tanggal_transaksi','>',$today)->whereNull('tanggal_spp')->sum('total');
        $data['utang_rata'] = DB::connection('keuangan')->select("
            SELECT AVG(total) AS `avg`
            FROM (SELECT DATE(tanggal_transaksi), AVG(total) AS total
            FROM utang
            WHERE DATE(tanggal_transaksi) < DATE('".$today."') AND tanggal_spp IS NULL
            GROUP BY DATE(tanggal_transaksi)) AVG
            ");
        $data['utang_rata'] = $data['utang_rata'][0]->avg;
        if($data['utang_rata'] == 0)
        {
            $data['utang_rata'] = 1;
        }
        
        return view('keuangan.pjk.index',$data);
    }

    public function create(Request $request)
    {
        if ($request->has('utang_id')){
            $data['utang_id'] = $request->utang_id;
        }
        $data['sidebar_active'] = "utang";
        $data['akun_pjk'] = AkunPJK::all();
        return view('keuangan.pjk.create',$data);
    }

    public function single($id)
    {
        $data['sidebar_active'] = "utang";
        $data['utang'] = Utang::find($id);
        return view('keuangan.pjk.single',$data);
    }

    public function edit($id)
    {
        $data['sidebar_active'] = "utang";
        $data['utang'] = Utang::find($id);
        $data['akun_pjk'] = AkunPJK::all();
        $data['perusahaan'] = json_decode(app('App\Http\Controllers\Keuangan\Perusahaan\ReadController')->get());
        return view('keuangan.pjk.edit',$data);
    }

    public function history()
    {
        $data['sidebar_active'] = "utang";
        return view('keuangan.pjk.history',$data);
    }
}
