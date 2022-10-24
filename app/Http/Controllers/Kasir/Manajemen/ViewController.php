<?php

namespace App\Http\Controllers\Kasir\Manajemen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasir\Kasir;
use App\Models\Kasir\MasterKasirSlug;
use Carbon\Carbon;
use DB;

class ViewController extends Controller
{
    public function index(Request $request)
    {
        $kasir = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getAll();
        $data['kasir'] = $kasir;
        $data['sidebar_active'] = "switch";
        return view('kasir.manajemen.switch', $data);
    }

    public function index2()
    {
    	$data['sidebar_active'] = "manajemen";
        $today = Carbon::today();
        $data['today'] = Carbon::today();
    	$data['manajemen_detail'] = Kasir::get();
        // dd($data);
        return view('kasir.manajemen.index',$data);
   	}

    private function getMasterSlugFree()
    {
        $kasir = Kasir::whereNotNull('slug')->get();
        $slugs = "";
        foreach($kasir as $item)
        {
            $slugs.=$item->slug.',';
        }
        $slugs_free = explode(",", $slugs);
        $slugs_free_obj = MasterKasirSlug::whereNotIn('slug',$slugs_free)->get();
        return $slugs_free_obj;
    }

    private function getMasterSlug($slugs)
    {
        $slugs = explode(",", $slugs);
        $slugs = MasterKasirSlug::whereIn('slug',$slugs)->get();
        return $slugs;
    }

    public function create()
    {
        $data['sidebar_active'] = "manajemen";
        $data['slugs'] = $this->getMasterSlugFree();
        return view('kasir.manajemen.create2',$data);
    }

    public function edit($id)
    {
        $data['sidebar_active'] = "manajemen";
        $data['kasir'] = Kasir::find($id);
        $data['slugs'] = $this->getMasterSlugFree();
        $data['slugs_now'] = $this->getMasterSlug($data['kasir']->slug);
        return view('kasir.manajemen.edit',$data);
    }

    public function editFoto(Request $request,$id)
    {
        $kasir = Kasir::find($id);
        $kasir->id = $request->input('id',$id);
        $kasir->foto = NULL;
        $kasir->save();
        
        // dd($data);
        return redirect()->route('edit_foto',['id'=>$kasir->id]);
    }
}
