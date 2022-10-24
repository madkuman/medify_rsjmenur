<?php

namespace App\Http\Controllers\Keuangan\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use DataTables;

class ReadController extends Controller
{
    public function allKategori()
    {
    	//dd('abc');
    	$data = Kategori::select('id','name','type','parent_id','kode_anggaran','total_anggaran')->get();
    	return Datatables::of($data)
    	->addIndexColumn()
    	->editColumn('type', function($data){
    		if($data->type == 1)
    		{
    			return 'Pemasukan';
    		}
    		else
    		{
    			return 'Pengeluaran';
    		}
    	})
    	->editColumn('parent_id', function($data){
    		if($data->parent_id != 0)
    		{
    			$nama = $this->getNama($data->parent_id);
    			//dd($nama);
    			return $nama;	
    		}
    		else
    		{
    			return '-';
    		}
    	})
        ->editColumn('total_anggaran', function($data){
            return number_format($data->total_anggaran);
        })
    	->addColumn('action', function($data){
    		return '<a href="'.url('keuangan/pengaturan/kategori/'.$data->id).'" class="btn btn-info"><i class="si si-magnifier"></i></a>';
    	})
    	->make(true);

    }

    public function getNama($id)
    {
    	$name = Kategori::where('id',$id)->pluck('name')->toArray();
    	//dd($name);
    	return $name;
    }

    public function getSlug($slug)
    {
        $name = Kategori::where('slug',$slug)->first();
        return $name;
    }


    public function getUntungRugiKategori($id = 1)
    {
        if($id == 1) $name = Kategori::whereIn('slug',['selisih-biaya-untung','selisih-biaya-rugi'])->pluck('id')->toArray();
        else $name = Kategori::whereIn('slug',['selisih-biaya-untung','selisih-biaya-rugi'])->get();
        return $name;
    }

    public function getUntungKategori($id = 1)
    {
        if($id == 1) $name = Kategori::whereIn('slug',['selisih-biaya-untung'])->pluck('id')->toArray();
        else $name = Kategori::whereIn('slug',['selisih-biaya-rugi','selisih-biaya-untung'])->get();
        return $name;
    }

    public function getRugiKategori($id = 1)
    {
        if($id == 1) $name = Kategori::whereIn('slug',['selisih-biaya-rugi'])->pluck('id')->toArray();
        else $name = Kategori::whereIn('slug',['selisih-biaya-rugi','selisih-biaya-untung'])->get();
        return $name;
    }

    public function getKategoriCustom()
    {
        $kategori['tindakan'] = [50,52,53,54,55,56,57,58,59,60,61,62,63,64,65,71];
        $kategori['penunjang'] = [66,67,68,69,70];
        $kategori['farmasi'] = [72,73,74,75];
        $merge_kategori = [];
        foreach($kategori as $item)
        {
            $merge_kategori = array_merge($merge_kategori,$item);
        }
        $kategori['lainnya'] = Kategori::where('type',1)->whereNotIn('id',$merge_kategori)->pluck('id')->toArray();
        return $kategori;
    }
}
