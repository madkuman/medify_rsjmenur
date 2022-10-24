<?php

namespace App\Http\Controllers\Keuangan\Utang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Utang;
use Carbon\Carbon;
use DB;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = "utang";
        $today = Carbon::today();
        $data['today'] = $today;
        $data['utang_num'] = Utang::where('tanggal_faktur','>',$today)->whereNull('no_pjk')->count();
        $data['utang_total'] = Utang::where('tanggal_faktur','>',$today)->whereNull('no_pjk')->sum('total');
        $data['utang_rata'] = DB::connection('keuangan')->select("
            SELECT AVG(total) AS `avg`
            FROM (SELECT DATE(tanggal_faktur), AVG(total) AS total
            FROM utang
            WHERE DATE(tanggal_faktur) < DATE('".$today."') AND no_pjk IS NULL
            GROUP BY DATE(tanggal_faktur)) AVG
            ");
        $data['utang_rata'] = $data['utang_rata'][0]->avg;
        if($data['utang_rata'] == 0)
        {
            $data['utang_rata'] = 1;
        }
        
        return view('keuangan.utang.index',$data);
    }

    public function create(Request $request)
    {
        if ($request->has('po_id')){
            $data['po_id'] = $request->po_id;
        }
        $data['sidebar_active'] = "utang";
        return view('keuangan.utang.create',$data);
    }

    public function single($id)
    {
        $data['sidebar_active'] = "utang";
        $data['utang'] = Utang::find($id);
        return view('keuangan.utang.single',$data);
    }

    public function edit($id)
    {
        $data['sidebar_active'] = "utang";
        $data['utang'] = Utang::find($id);
        $data['perusahaan'] = json_decode(app('App\Http\Controllers\Keuangan\Perusahaan\ReadController')->get());
        return view('keuangan.utang.edit',$data);
    }

    public function history()
    {
        $data['sidebar_active'] = "utang";
        return view('keuangan.utang.history',$data);
    }
}
