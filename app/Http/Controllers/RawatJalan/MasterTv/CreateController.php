<?php

namespace App\Http\Controllers\RawatJalan\MasterTv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\AntrianLevel;
use App\Models\RawatJalan\MasterTv;
use App\Models\RawatJalan\Poliklinik;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function create($req)
    {
        if ($req->id) {
            $tv = MasterTv::find($req->id);
        } else {
            $tv = new MasterTv();
        }

        $slug = preg_replace('~[^\pL\d]+~u', '-', $req->nama_scr);
        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
        $slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
        $slug = trim($slug, '-'); // trim
        $slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
        $slug = strtolower($slug); // lowercase

        if (isset($req->level_all)) $level_temp = AntrianLevel::all()->pluck('id')->toArray();
        else $level_temp = $req->level;

        // if (isset($req->poli_all)) $poli_temp = Poliklinik::all()->pluck('id')->toArray();
        // else $poli_temp = $req->poli;
        $ruangan_temp = $req->ruangan;
        $tv->nama = $req->nama_scr;
        $tv->antrian_level = json_encode($level_temp);
        $tv->ruangan = json_encode($ruangan_temp);
        $tv->slug = $slug;
        
        if ($req->id) $tv->updated_at = Carbon::now();
        else $tv->created_by = Auth::user()->id;
        
        $tv->save();

        return $tv;
    }
}
