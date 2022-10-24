<?php

namespace App\Http\Controllers\Keuangan\Tarif;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\TarifDetail;
use App\Models\Keuangan\TarifKategori;
use App\Models\Hospital\Kelas;
use App\Models\Keuangan\TarifTipe;
use Carbon\Carbon;
use DB;
use Auth;

class ViewController extends Controller
{
    protected static $labPKDepartemen=6;


    public function index(Request $request)
    {
        return redirect('tarif');
        $kategori_id = 0;
        if(!empty($request->kategori)) {
            $kategori_id = $request->kategori;
            $kategori_ids = TarifKategori::where('id',$kategori_id)->pluck('id')->toArray();
            $data['tarif'] = TarifMaster::whereIn('kategori_id',$kategori_ids)->with('kategori')->get();
        }
        else
            $data['tarif'] = TarifMaster::with('kategori')->get();

        $data['kategori'] = TarifKategori::get();
        $data['kategori_selected'] = $kategori_id;
        $data['sidebar_active'] = "tarif";
        return view('keuangan.tarif.index',$data);
    }

    public function viewOnly(Request $request)
    {
        $kategori_id = 0;
        if(!empty($request->kategori)) {
            $kategori_id = $request->kategori;
            $kategori_ids = TarifKategori::where('id',$kategori_id)->pluck('id')->toArray();
            $data['tarif'] = TarifMaster::whereIn('kategori_id',$kategori_ids)->with('kategori')->get();
        }
        else
            $data['tarif'] = TarifMaster::with('kategori')->get();

        $data['kategori'] = TarifKategori::get();
        $data['kategori_selected'] = $kategori_id;
        $data['sidebar_active'] = "tarif";
        return view('keuangan.tarif.index-viewonly',$data);
    }

    public function create()
    {
        $data['kategori'] = TarifKategori::all();
        $data['tipe'] = TarifTipe::get(); 
        $data['kelas'] = Kelas::get();
        // $data['kategori'] = TarifKategori::get();
        $data['sidebar_active'] = "tarif";
        return view('keuangan.tarif.create',$data);
    }

    public function single($id)
    {
        $data['tarif'] = TarifMaster::with('kategori')->find($id);
        // dd($data);
        $data['sidebar_active'] = "tarif";
        $data['is_labpk'] = ($data['tarif']->kategori->slug ??  0) == 'lab-pk';
        $data['is_super_admin'] = Auth::user()->id == config('const.super_admin');
        if($data['tarif']->kategori->slug == 'lab-pk')
            $data['hasil_urikkes'] = is_null($data['tarif']->hasil_urikkes) ? [] : $this->transformHasilUrikkes($data['tarif']->hasil_urikkes);
        return view('keuangan.tarif.single',$data);
    }

    public function edit($id)
    {
        $data['tipe'] = TarifTipe::get();
        $data['kelas'] = Kelas::get();
        $data['master'] = TarifMaster::find($id);
        $data['kategori'] = TarifKategori::all();


        $data['tarif'] = $data['master']->tarif;
        $data['sidebar_active'] = "tarif";
        return view('keuangan.tarif.edit',$data);
    }

    public function adminUpdateIndex()
    {
        return view('keuangan.tarif.admin.update-index-elastic');
    }

    public function getStopword()
    {
        $tk = TarifKategori::all();
        $res = [];
        $file = fopen("dataset/indonesian-stopwords-complete.txt","r");
        foreach ($tk as $item) {
            $filtered = strtolower(preg_replace("/[^A-Za-z ]/", ' ', $item->nama));
            $tags = explode(' ', $filtered);
            foreach ($tags as $tag) {
                rewind($file);
                $tag = trim($tag);
                if($tag !=""){
                    $is_sw = false;
                    while(! feof($file))  {
                        $result = fgets($file);
                        $sw = trim(strtolower(preg_replace("/[^A-Za-z ]/", ' ', $result)));
                        if($sw == $tag)
                            $is_sw = true;
                    }
                    if(!$is_sw){
                        if(!isset($res[$tag])){
                            $res[$tag] = 1;
                            // $res[$tag]['count']=1;
                            // $res[$tag]['source']=[$item->nama];
                        }
                        else{
                            $res[$tag] += 1;
                            // $res[$tag]['count'] += 1;
                            // array_push($res[$tag]['source'], $item->nama);
                        }
                    }
                }
            }
        }
        fclose($file);
        arsort($res);
        dd($res);
    }

    private function transformHasilUrikkes($urikkes)
    {
        $target = explode(';', $urikkes);
        $result = [];
        foreach ($target as $key => $val) {
            $row = explode('|', $val);
            array_push($result, [
                'tabel' => $row[0],
                'kolom' => $row[1]
            ]);
        }
        return $result;
    }
}