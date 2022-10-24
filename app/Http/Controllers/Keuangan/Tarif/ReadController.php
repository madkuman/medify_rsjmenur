<?php

namespace App\Http\Controllers\Keuangan\Tarif;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Departemen;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifDetail;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifKode;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\TarifTipe;
use App\Models\Keuangan\TarifINACBG;
use App\Models\Keuangan\TarifKategoriINACBG;
use App\Models\Hospital\Kelas;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use DB;

class ReadController extends Controller
{
    public function get(Request $request){

        $search = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword);
        if(!empty($search))
        {   
            if($request->get('detail')){
                $department = (int)$request->get('department');
                

                $layanan = Tarif::search($search)->paginate(10);
                //gabisa di pake 2 with karena pake search, maka diekstrak id nya baru di search pake eloquent
                $ids = $layanan->map(function ($item) {
                    return collect($item->toArray())
                    ->only(['id'])
                    ->all();
                });



                $tarif = Tarif::whereIn('id',$ids)->with('detail')->with('tarif_kategori')->paginate(10);
                return json_encode($tarif);
            }
            else
                $layanan = Tarif::search($search)->with('tarif_kategori')->paginate(10);
        }
        else
            $layanan = Tarif::orderBy('id', 'desc')->paginate(10);

        return json_encode($layanan);
    }

    public function apiSearch(Request $request)
    {
        $keyword = $request->keyword;
        $kelas = $request->kelas;
        $tipe = $request->tipe;
        $persen = $request->persen;
        $tarif = TarifMaster::where('deskripsi','like','%'.$keyword.'%')->take(35)->get();
        $result = [];
        foreach($tarif as $item)
        {
            $item->tarif_master_id = $item->id;
            if(!empty($persen)) $enable_persen = 1;
            else $enable_persen = 0;
            $item->kategori_all = $item->kategori->all_ancestor_name ?? '-';

            $temp = $this->getTarifByMaster($item->id,$tipe,$kelas,$enable_persen);
            if(!empty($temp->id))
            {
                $item->tarif_id = $temp->id;
                $item->harga = $temp->harga;
                $item->tarif_kelas_id = $temp->kelas_id;
                $item->persen = $temp->persen;
                array_push($result, $item);
            }
        }
        return json_encode($result);
    }

    public function getTarifByMaster($tarif_master_id,$tipe,$kelas,$enable_persen)
    {
        if(!$enable_persen)
            $tarif = Tarif::whereIn('kelas_id',[$kelas,0])->where('tipe_id',$tipe)->where('tarif_master_id',$tarif_master_id)
            ->with(['master', 'master.kategori'])->first();
        else
            $tarif = Tarif::whereIn('kelas_id',[$kelas,0])->where('tipe_id',$tipe)->where('tarif_master_id',$tarif_master_id)->where('persen',0)
            ->with(['master', 'master.kategori'])->first();
        return $tarif;
    }

    public function APIGetSingle(Request $request)
    {
        $tarif_id = $request->tarif;
        $kelas = $request->kelas;
        $tarif = TarifMaster::find($tarif_id);
        $temp = Tarif::whereIn('kelas_id',[$kelas,0])->where('tarif_master_id',$tarif_id)->first();
        if(!empty($temp->id))
        {
            $tarif->harga = $temp->harga;
        }
        else
        {
            $tarif->harga = 0;
        }
        return json_encode($tarif);
    }

    public function APIGetSingleMaster(Request $request)
    {
        $tarif_id = $request->id;
        $tarif = Tarif::where('tarif_master_id',$tarif_id)->with('kelas')->orderBy('kelas_id')->get();
        $tarif_result = [];
        foreach($tarif as $item)
        {
            $temp = new \stdClass();
            $temp->kelas = $item->kelas->nama ?? 'Tidak Ditemukan';
            $temp->harga = number_format($item->harga,0);
            array_push($tarif_result, $temp);
        }
        return json_encode($tarif_result);
    }

    public function APIGetINACBG(Request $request)
    {
        $tarif_id = $request->id;
        $tarif_inacbg = TarifKategoriINACBG::all();

        $tarif_result = [];
        foreach ($tarif_inacbg as $item) {
            $tarif = TarifINACBG::where('tarif_id', $tarif_id)->where('tarif_kategori_inacbg_id', $item->id)->first();
            $temp = new \stdClass();
            $temp->nama = $item->nama;
            $temp->harga = !empty($tarif) ? number_format($tarif->harga, 0) : 0;
            array_push($tarif_result, $temp);
        }
        return json_encode($tarif_result);
    }

    public function APIGetSister(Request $request)
    {
        $tarif = $request->tarif;
        $kelas = $request->kelas;
        $tipe = $request->tipe;
        $tarif_old = Tarif::find($tarif);
        $tarif_master_id = $tarif_old->tarif_master_id;

        $tarif_master = TarifMaster::find($tarif_master_id);
        $tarif = Tarif::whereIn('kelas_id',[$kelas,0])->where('tipe_id',$tipe)->where('tarif_master_id',$tarif_master_id)->first();
        $temp = new \StdClass;


        if(!empty($tarif->id))
        {
            $temp->tarif_master_id = $tarif_master->id;
            $temp->tarif_id = $tarif->id;
            $temp->harga = $tarif->harga;
            $temp->persen = $tarif->persen;
            $temp->deskripsi = $tarif_master->deskripsi;
        }
        else
        {
            $temp->harga = 0;
            $temp->persen = 0;
            $temp->deskripsi = $tarif_master->deskripsi;
            $temp->tarif_id = 0;
        }
        return json_encode($temp);
    }

    public function searchTarifTindakan(Request $request){

        $search = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword);
        $kelas = $request->get('kelas');
        $departemen = $request->get('departemen');
        if(!empty($search))
        {   
            $layanan = Tarif::search($search)->with(['tarif_kategori', 'detail'])->paginate(50);
            //gabisa di pake 2 with karena pake search, maka diekstrak id nya baru di search pake eloquent

            // return json_encode($layanan);
            $array = [];
            foreach($layanan as $item){
                foreach($item->detail as $d){
                    if(is_null($d[$kelas])) continue;
                    $temp = new \StdClass();
                    $temp->id = $d->id;
                    $temp->tarif_id = $d->tarif_id;
                    $temp->deskripsi = $item->tarif_kategori->name.' - '. $d->tipe->name.' - '.$item->deskripsi;
                    $temp->tarif_tipe_id = $d->tarif_tipe_id;
                    $temp->total = $d->$kelas;
                    $temp->departemen = $this->getDepartemen($departemen,$item->departemen_id);

                    array_push($array, $temp);
                }
            }

            return json_encode($array);
        }
        else
            $layanan = Tarif::orderBy('id', 'desc')->paginate(50);

        return json_encode($layanan);
    }

    public function searchTarif(Request $request){

        $search = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword);
        $kelas = $request->get('kelas');

        if(!empty($search))
        {   
            $layanan = Tarif::search($search)->paginate(10);
            //gabisa di pake 2 with karena pake search, maka diekstrak id nya baru di search pake eloquent

            $ids = $layanan->map(function ($item) {
                return collect($item->toArray())
                ->only(['id'])
                ->all();
            });

            $tarif = TarifDetail::whereIn('tarif_id',$ids)->whereNotNull($kelas)
            ->with('tarif.tarif_kategori')->paginate(10);
            
            $array = array();
            foreach($tarif as $item)
            {
                $temp = new \StdClass();
                $temp->id = $item->id;
                $temp->tarif_id = $item->tarif_id;
                $temp->deskripsi = $item->tarif->tarif_kategori->name.' - '. $item->tipe->name.' - '.$item->tarif->deskripsi;
                $temp->tarif_tipe_id = $item->tarif_tipe_id;
                $temp->total = $item->$kelas;

                array_push($array, $temp);
            }

            return json_encode($array);
        }
        else
            $layanan = Tarif::orderBy('id', 'desc')->paginate(10);

        return json_encode($layanan);
    }

    public function searchTarifLayanan(Request $request){

        $search = $request->get('keyword');
        $kelas = $request->get('kelas');
        $departemen = $request->get('departemen');
        $all = $request->get('all');
        $tipe = $request->get('tipe');

        $data = [];
        $layanan = Tarif::select('id', 'deskripsi', 'tarif_kategori_id')->where('departemen_id', $departemen)
                ->whereHas('detail', function($q) use(&$kelas, $tipe){
                        $q->where('tarif_tipe_id', $tipe)->whereNotNull($kelas);
                    })->with('tarif_kategori');
        if($all)
            $layanan = $layanan->get();
        else
            $layanan = $layanan->paginate(10);

        $layanan->each(function($value) use(&$data){
            if(!isset($data[$value->tarif_kategori['name']])){
                $data[$value->tarif_kategori['name']]['tarif'] = [];
                array_push($data[$value->tarif_kategori['name']]['tarif'], $value);
            } else
                array_push($data[$value->tarif_kategori['name']]['tarif'], $value);
        });
        return json_encode($data);
    }


    private function getDepartemen($departemen_kasus,$departemen_tarif)
    {
        if($departemen_tarif == 4)
        {
            if(is_null($departemen_kasus) || $departemen_kasus == 0) return $departemen_tarif;
            else return $departemen_kasus;
        }
        else return $departemen_tarif;
    }



    public function gettarif(Request $request)
    {
        $id = $request->departemen;
        $search = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword);
        if($search)
            $tarif = TarifMaster::search($search);
        else
            $tarif = TarifMaster::query();
        if($id !='none'){
            $tarif = $tarif->where('departemen_filter',$id);
        }
        
        $tarif = $tarif->with(['kategori.departemen'])->get();
        
        return DataTables::of($tarif)
        ->addColumn('kategori', function (TarifMaster $tarif) {
            return $tarif->kategori ? str_limit($tarif->kategori->nama) : '';
        })
        ->addColumn('departemen', function (TarifMaster $tarif) {
            return ($tarif->kategori && $tarif->kategori->departemen) ? str_limit($tarif->kategori->departemen->name) : '';
        })
        ->toJson();
    }

    public function getFromDepartment($department)
    {
        $tarif = Tarif::where('departemen_id', $department)->with('tarif_kategori')->get();

        return $tarif;
    }

    public function getFromKategori($kategori_id)
    {
        // $tarif = TarifMaster::where('ka')
    }

    public function getTarifByDept(Request $request)
    {
        $dept_id = $request->data;
        try {
            $tarif = Tarif::whereIn('departemen_id', $dept_id)->get();

            return $tarif;   
        } catch (Exception $e) {
            return FALSE;
        }
        
    }

    public function getDeptByTarifId($tarif_id)
    {
        // $tarif_id = $request->data;
        try {
            $tarif = Tarif::find($tarif_id);
            $dept = Departemen::find($tarif->departemen_id);
            
            return $dept;   
        } catch (Exception $e) {
            return FALSE;
        }
        
    }

    public function getTarifDetail($tarif_id, $tarif_type)
    {
        try {
            $detail = TarifDetail::where('tarif_id', $tarif_id)->where('tarif_tipe_id', $tarif_type)->first();

            return $detail;   
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function getDetail(Request $request)
    {
        $tarif_id = $request->id;
        $tarif_type = $request->tipe;
        try {
            $detail = TarifDetail::where('tarif_id', $tarif_id)->where('tarif_tipe_id', $tarif_type)->with('origin')->first();

            return $detail;   
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function getAllDetail(Request $request)
    {
        $tarif_id = $request->id;
        try {
            $details = TarifDetail::where('tarif_id', $tarif_id)->with('tipe')->with('origin')->get();

            return $details;   
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function getKategori(Request $request)
    {
        $dept_id = $request->id;
        try {
            $kategori = TarifKategori::where('departemen_id', $dept_id)->get();

            return $kategori;   
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function getKategoriSub(Request $request)
    {
        $parent_id = $request->id;
        try {
            $kategori = TarifKategori::where('parent_id', $parent_id)->get();

            return $kategori;   
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function getUnitPrice($tarif_id,$tarif_tipe_id, $kelas_id)
    {
        $tarif_detail = TarifDetail::where('tarif_id', $tarif_id)->where('tarif_tipe_id',$tarif_tipe_id)->first();
        $kelas = Kelas::find($kelas_id);
        $refer = $kelas->refer;
        $price = $tarif_detail->$refer;

        return $price;
    }

    public function getAllKode()
    {
        return TarifKode::all();
    }

    public function getTarifDetailwithId($arrayId)
    {
        $tarif = TarifMaster::with(['tarif' => function($q) use($arrayId)
        {
            return $q->whereIn('tipe_id', $arrayId);
        }])->get();
        return $tarif;
    }

    public function getTarifTop50($kelas,$departemen)
    {
        //dd($kelas,$departemen);
        $tarif = Tarif::orderBy('count','DESC')
                    //->take(50)
                    ->get();
        //dd($tarif);
        $ids = $tarif->map(function ($item) {
                return collect($item->toArray())
                ->only(['id'])
                ->all();
            });
        //dd($ids);
        $array = array();
        $tarif_d = TarifDetail::whereIn('tarif_id',$ids)
                    ->whereNotNull($kelas)
                    ->with('tarif.tarif_kategori')
                    ->take(50)
                    ->get();
        //dd($tarif_d);
        $array = array();
        foreach($tarif_d as $item)
        {
            $temp = new \StdClass();
            $temp->id = $item->id;
            $temp->tarif_id = $item->tarif_id;
            $temp->deskripsi = $item->tarif->tarif_kategori->name.' - '. $item->tipe->name.' - '.$item->tarif->deskripsi;
            $temp->tarif_tipe_id = $item->tarif_tipe_id;
            $temp->total = $item->$kelas;
            $temp->departemen = $this->getDepartemen($departemen,$item->tarif->departemen_id);

            array_push($array, $temp);
        }
        //dd($array);
        return $array;
    }

    public function getTarifFilter($departemen = NULL, $kelas = NULL, $tipe = NULL)
    {
        $tarif = Tarif::query();
        if($departemen)
            $tarif->where('departemen_id', $departemen);
        if($kelas OR $tipe)
            $tarif->whereHas('detail', function($q) use(&$kelas, $tipe){
                    if($tipe)
                        $q->where('tarif_tipe_id', $tipe);
                    if($kelas){
                        $refer = Kelas::find($kelas)->refer;
                        $q->whereNotNull($refer);
                    }
                });
        return $tarif->get();
    }



    public function getTarifRawatJalanKonsultasiDokter()
    {
        $slugs = ['rawat-jalan-konsultasi-dokter'];
        $tarif = [];
        foreach($slugs as $slug)
        {
            $kategori = TarifKategori::where('slug',$slug)->pluck('id')->toArray();
            $tarif_temp = [];
            if(!empty($kategori))
            {
                $tarif_master = TarifMaster::whereIn('kategori_id',$kategori)->pluck('id')->toArray();
                if(!empty($tarif_master))
                    $tarif_temp = Tarif::whereIn('tarif_master_id',$tarif_master)->with('master','kelas')->get();
            }
            $tarif= $tarif_temp;
        }
        return $tarif;
    }

    public function getTarifWithKelas($kelas_id, $tipe_id)
    {
        $tarif = TarifMaster::whereHas('tarif', function($q) use($kelas_id, $tipe_id)
        {
            if(is_array($kelas_id))
                $q->whereIn('kelas_id', $kelas_id)->whereIn('tipe_id', $tipe_id);
            else
                $q->where('kelas_id', $kelas_id)->whereIn('tipe_id', $tipe_id);
        })->with(['tarif' => function($q) use($kelas_id, $tipe_id)
        {
            if(is_array($kelas_id))
                return $q->whereIn('kelas_id', $kelas_id)->whereIn('tipe_id', $tipe_id);
            else
                return $q->where('kelas_id', $kelas_id)->whereIn('tipe_id', $tipe_id);
        }])->get();
        return $tarif;
    }

    public function getSingle($id){
        return TarifMaster::find($id);
    }

    public function getTarifByKategoriSlug($slugs = [])
    {
        $tarif = [];
        foreach($slugs as $slug)
        {
            $kategori = TarifKategori::where('slug',$slug)->pluck('id')->toArray();
            $tarif_temp = [];
            if(!empty($kategori))
            {
                $tarif_master = TarifMaster::whereIn('kategori_id',$kategori)->pluck('id')->toArray();
                if(!empty($tarif_master))
                    $tarif_temp = Tarif::whereIn('tarif_master_id',$tarif_master)->with('master','kelas')->get();
            }
            $tarif= $tarif_temp;
        }
        return $tarif;
    }

}