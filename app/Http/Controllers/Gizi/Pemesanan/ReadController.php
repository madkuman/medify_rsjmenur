<?php

namespace App\Http\Controllers\Gizi\Pemesanan;

use App\Models\Gizi\KategoriMakanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Gizi\Diet;
use App\Models\Hospital\Lokasi;
use App\Models\Gizi\Resep;
use App\Models\Gizi\Kelas;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Gizi\Pemesanan;
use App\Models\Gizi\PemesananDetail;
use App\Models\Gizi\BentukMakanan;
use App\Models\Gizi\DietTambahanPemesanan;
use App\Models\Gizi\DietKode;
use App\Models\Kasus\Kasus;
use Auth;
use DB;
use Carbon\Carbon;
use DataTables;

class ReadController extends Controller
{
    public function getPemesanan()
    {
    	$pemesanan = Pemesanan::all();
    	return $pemesanan;
    }

    public function getPasien()
    {
    	$pasien = Pasien::all();
    	return $pasien;
    }

    public function getBentuk()
    {
        $bentuk = BentukMakanan::all();
        return $bentuk;
    }

    public function getDiet()
    {
    	$diet = Diet::all();
    	return $diet;
    }

    public function getLokasi()
    {
    	$lokasi = Lokasi::whereIn('lokasi_departemen_id',[1,2,3])->get();
    	return $lokasi;
    }

    public function getMakananPokok()
    {
    	$makanan = Resep::where('flag_pokok','1')->get();
    	return $makanan;
    }

    public function getKelas()
    {
    	$kelas = Kelas::all();
    	return $kelas;
    }

    public function getPembayaranPasien(Request $request)
    {
    	$id = $request->id;
    	$pembayaran = PasienPembayaran::where('pasien_id',$id)->with('perusahaan')->get()->toArray();
    	return json_encode($pembayaran);
    }

    public function getPemesananWithTanggal($tanggal,$lokasi=null)
    {	
        // dd($tanggal,$lokasi);
		$today = Carbon::parse($tanggal)->startOfDay();
		$data = Pemesanan::with(['lokasi','kelas','diet','kode_diet'])->where('jadwal_pengantaran',$today)->get();
        // dd($data);
        if($lokasi != null)
        {
            $data = $data->filter( function($val,$key) use($lokasi){
                // if($val->lokasi->id == $lokasi)
                // dd($val->lokasi->id,$key,$lokasi);
                return $val->lokasi->ruangan->bangsal->id == $lokasi;
            })->all();
        }
		return $data;
    }

    public function getPemesananMutuEdit($id)
    {
    	$pemesanan = Pemesanan::where('id',$id)->first();
   		return $pemesanan;
    }

    public function getPemesananDetail($id)
    {
    	$pemesanandetail = PemesananDetail::where('pemesanan_id',$id)->get();
    	return $pemesanandetail;
    }

    public function getPemesananDetailWithTanggal($date)
    {
        $today_start = Carbon::parse($date)->startOfDay();
        $today = Carbon::parse($date)->endOfDay();

        $query = PemesananDetail::whereBetween('untuk_tanggal',[$today_start,$today])->get();
        return $query;
    }
    
    public function getPasienEdit($id)
    {
    	$pemesanan = Pemesanan::where('id',$id)->first();
    	$pasien = Pasien::where('id',$pemesanan->pasien_id)->first();
    	return $pasien;
    }

    public function getPesananTiapWaktu($id,$waktu)
    {   
        $pesanan = PemesananDetail::where('pemesanan_id',$id)
                                ->where('waktu_makan_id',$waktu)->get();
        // dd($pesanan);
        return $pesanan;
    }

    public function getPokok($id,$waktu)
    {
        $pokok =  PemesananDetail::where('pemesanan_id',$id)
                                ->where('waktu_makan_id',$waktu)
                                ->where('flag_pokok',1)
                                ->first();
        return $pokok;
    }

    public function getPemesananWithWaktu($start,$end)
    {
        $query = PemesananDetail::select('id','waktu_makan_id','pemesanan_id')->whereBetween('untuk_tanggal',[$start,$end])
                                    ->groupby('pemesanan_id','waktu_makan_id')
                                    ->with(['pemesanan:id,pasien_id,diet_id,lokasi_id','pemesanan.pasien','pemesanan.diet:id,nama','pemesanan.lokasi:id,nama'])->get();
//        dd($query[0]);
        return $query;
    }

    public function getRekapDiet($diet_id,$kelas_id,$waktu_id,$date)
    {   
        //dd($date);
        $today_start = Carbon::parse($date)->subDay()->startOfDay();
        $today = Carbon::parse($date)->endOfDay();
        //dd($today_start,$today);
        $query = Pemesanan::where('diet_id',$diet_id)
                            ->where('kelas_id',$kelas_id)
                            ->whereBetween('jadwal_pengantaran',[$today_start,$today])
                            ->get();
        //dd($query);
        
        $data['tambahan'] = 0;
        $data['normal'] = 0;
        foreach ($query as $query_item) 
        {
            //dd($query_item);
            if(!empty($query_item->menu_tambahan_id))
            {
                $data['tambahan'] += $query_item->get_jumlah_pesan($date,$waktu_id,1);
                $data['normal'] += $query_item->get_jumlah_pesan($date,$waktu_id,0);
            }
            else
            {
                $data['normal'] += $query_item->get_jumlah_pesan($date,$waktu_id,0);
                $data['tambahan'] += 0;
            }
                     
        }
        //dd($data);
        return $data;
    }

    public function getRekapResep($date)
    {   
        
        $today_start = Carbon::parse($date)->subday()->startOfDay();
        $today = Carbon::parse($date)->endOfDay();
        $query = PemesananDetail::whereIn('pemesanan_id',
                            Pemesanan::whereBetween('jadwal_pengantaran',[$today_start,$today])
                            ->select('id'))
                            ->orderBy('resep_id')
                            ->get();
        //dd($query);
        $count = [];
        $i = 0;
        foreach ($query as $query_item) 
        {   
            if(empty($count[$query_item->resep_id]))
            {
                $count[$query_item->resep_id]['jumlah'] = 1;
                $count[$query_item->resep_id]['id'] = $query_item->resep_id;
                $count[$query_item->resep_id]['nama'] = $query_item->resep->nama;
            }
            else
            {
                $count[$query_item->resep_id]['jumlah'] += 1;
            }
        }
        
        return $count;
    }

    public function getPemesananOrderByDiet($date)
    {   
        //dd($date);
        $start = Carbon::parse($date)->startOfDay();
        $end = Carbon::parse($date)->endOfDay();
        $pemesanan = Pemesanan::whereBetween('jadwal_pengantaran',[$start,$end])->get();
        return $pemesanan;
    }

    public function getDietTambahan($id)
    {   
        //dd($id);
        $data = DietTambahanPemesanan::where('pemesanan_id',$id)->get();
        return $data;
    }

    public function getRekapJp($diet_id,$kelas_id,$jp,$date)
    {
        $today_start = Carbon::parse($date)->subDay()->startOfDay();
        $today = Carbon::parse($date)->endOfDay();
        if($jp == 1)
        {
            $group = [1,7,10,14,15,16];
        }
        else if($jp == 2)
        {
            $group = [2,3,4,8,9,11,12];
        }
        else if($jp == 3)
        {
            $group = [5,6,13,20];
        }
        else if($jp == 4)
        {
            $group = [32,33,34,35,36,70,71,72,73,74,75,76,77,78,79,80];
        }
        else if($jp == 5)
        {
            $group = [17,18,19];
        }
        $query = Pemesanan::where('diet_id',$diet_id)
                            ->where('kelas_id',$kelas_id)
                            ->whereBetween('jadwal_pengantaran',[$today_start,$today])
                            ->get();
        $filtered = $query->filter(function($value) use(&$group)
            {
                return in_array($value->pembayaran->perusahaan->id,$group);
            })->all();
        //dd($filtered);
        $data['tambahan'] = 0;
        $data['normal'] = 0;
        foreach ($filtered as $query_item) 
        {
            if(!empty($query_item->menu_tambahan_id))
            {
                $data['tambahan'] += $query_item->get_jumlah_pesan($date,100,1);
                $data['normal'] += $query_item->get_jumlah_pesan($date,100,0);
            }
            else
            {
                $data['normal'] += $query_item->get_jumlah_pesan($date,100,0);
                $data['tambahan'] += 0;
            }       
        }
        return $data;
    }

    public function getAlergiPasien($id)
    {
        $pemesanan = Pemesanan::find($id);
        $kasus = Kasus::find($pemesanan->kasus_id);
        return $kasus->identitas->alergi;
    }

    public function getKodeDietPasien(Request $request)
    {
        //dd($request->lc,$request->rg,$request->ptg);
        // $kode = DietKode::where('bentuk_makanan_id',$request->bentuk_makanan)
        //                 ->where('kategori_makanan_id',$request->kategori_makanan)
        //                 ->where('diet_id',$request->diet)
        //                 ->where('jenis_makanan_id',$request->jenis_makanan)
        //                 ->where('is_lc',$request->lc)
        //                 ->where('is_rg',$request->rg)
        //                 ->where('is_ptg',$request->ptg)
        //                 ->first();
        //dd($kode);
            $kode = DietKode::where('bentuk_makanan_id', $request->bentuk_makanan)
                ->where('kategori_makanan_id', $request->kategori_makanan)
                ->where('diet_id', $request->diet)
                ->where('jenis_makanan_id', $request->jenis_makanan)
//                        ->where('is_lc',$request->lc)
//                        ->where('is_rg',$request->rg)
//                        ->where('is_ptg',$request->ptg)
                // ->groupBy('nama')
                // ->where('flag','1')
                ->get();
        // dd($kode);                
        return json_encode($kode);
    }

    public function getDietPasien(Request $request)
    {   
        $diet = Diet::where('jenis_makanan_id',$request->jenis_makanan);
        if(!empty($request->kategori_makanan))
        {
            $diet = $diet->where('cair',$request->kategori_makanan)->get();
        }
        else
        {
            $diet = $diet->get();
        }
        return json_encode($diet);
    }

    public function getBentukMakanan(Request $request)
    {
        // if($request->jenis_makanan == 4)
        // {
        //     $bentuk = BentukMakanan::where('flag_cair',1)->get();
        // }
        // else
        // {
        //     $bentuk = BentukMakanan::where('flag_cair',null)->get();
        // }
        $bentuk = BentukMakanan::whereRaw("find_in_set(?,diet_id)",[$request->diet])->get();
        // dd($bentuk);
        return json_encode($bentuk);
    }

    public function getPemesananMonitoring($tanggal)
    {
        $today_start = Carbon::parse($tanggal)->startOfDay();
        $today = Carbon::parse($tanggal)->endOfDay();
        $kasus_id=Pemesanan::wherebetween('jadwal_pengantaran',[$today_start,$today])->get()->pluck('kasus_id')->toArray();
        return $kasus_id;
    }

    public function getKategoriMakanan()
    {
        $kategori =KategoriMakanan::get();
        return json_encode($kategori);
    }

    public function getKodeDietMonitoring($tanggal,$kasus_id)
    {
        $today_start = Carbon::parse($tanggal)->startOfDay();
        $today = Carbon::parse($tanggal)->endOfDay();
        $kode_diet=Pemesanan::where('kasus_id',$kasus_id)->wherebetween('jadwal_pengantaran',[$today_start,$today])->with('kode_diet')->first();
        return $kode_diet;
    }

    public function getRekapPemesananWithTanggal($data)
    {
        $today = Carbon::parse($data['tanggal'])->startOfDay();
        $pemesanan = PemesananDetail::with(['lokasi','diet','pemesanan.kelas'])
            ->whereDate('untuk_tanggal',$today)
            ->where('waktu_makan_id',$data['waktu_makan'])
            ->get()
            ->groupBy('diet.nama');
        foreach ($pemesanan as $index=> $item){
            $item->jumlah=0;
            foreach ($item as $key=> $detail){
                $item->jumlah +=1;
                unset($item[$key]);
            }
        }
        return $pemesanan;
    }

    public function getPemesananTiapRuangan($tanggal,$waktu_makan)
    {
        $today = Carbon::parse($tanggal)->startOfDay();
        $data = PemesananDetail::with(['lokasi','bangsal','ruangan','kelas','diet','jenis_makanan','pemesanan.pasien'])
            ->whereDate('untuk_tanggal',$today)
            ->where('waktu_makan_id',$waktu_makan)
            ->orderBy('bangsal_id')
            ->get();
        return $data;
    }

    public function loadData(Request $request)
    {
        if($request->get('tanggal')){
            $tanggal=$request->get('tanggal');
        }
        else{
            $tanggal=date('d F Y');
        }
        if($request->get('waktu_makan'))
        {
            $waktu_makan = $request->get('waktu_makan');
        }
        else
        {
            $waktu_makan = 1;
        }
        //dd($request);
        $data =$this->getPemesananTiapRuangan($tanggal,$waktu_makan);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                $aksi = '<div>                            
                            <a class="btn btn-alt-warning" href="javascript:void(0)" onclick="modal_order_edit('.$data->id.')">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="btn btn-alt-danger" href="javascript:void(0)" onclick="modal_order_delete('.$data->id.')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>';
                return $aksi;
            })
            ->addColumn('pasien', function ($data) {
                $pasien = $data->pemesanan->pasien->name;

                return $pasien;
            })
            ->addColumn('bangsal', function ($data) {
                $bangsal = [
                    'nama' => $data->bangsal->nama ?? '',
                    'bangsal_id' => $data->bangsal_id
                ];

                return $bangsal;
            })
            ->addColumn('ruangan', function ($data) {
                $ruangan = $data->ruangan->nama ?? '';

                return $ruangan;
            })
            ->addColumn('diet', function ($data) {
                $diet = $data->diet->nama ?? '';

                return $diet;
            })
            ->addColumn('kelas', function ($data) {
                $kelas = $data->kelas->nama ?? '';

                return $kelas;
            })
            ->addColumn('jenis_makanan', function ($data) {
                $jenis_makanan = $data->jenis_makanan->nama ?? '';

                return $jenis_makanan;
            })
            ->addColumn('makanan_tambahan', function ($data) {
                $jenis_makanan = json_decode($data->makanan_tambahan_nama) ?? [];
                $return = '';
                foreach ($jenis_makanan as $value){
                    $return .= '<span class="badge badge-success ml-5">'.$value.'</span>';
                }

                return $return;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function rekomendasiOrder(Request $request)
    {
        $pemesanan=Pemesanan::where('kasus_id',$request->kasus_id)
                            ->where('pasien_id',$request->pasien_id)
                            ->orderby('jadwal_pengantaran','DESC')
                            ->take(1)
                            ->with(['kode_diet.jenis_makanan','kode_diet.kategori_makanan',
                                    'kode_diet.diet','kode_diet.bentuk_makanan'])
                            ->get();
        return json_encode($pemesanan);
    }

    public function getLastOrder($start,$end,$bangsal_id)
    {
        $pemesanan = Pemesanan::select('id','pasien_id')
            ->whereBetween('jadwal_pengantaran',[$start,$end])
            ->where('bangsal_id', $bangsal_id)
            ->orderby('id','desc')
            ->get()
            ->groupby('pasien_id');
        $pemesanan_id=[];
        foreach($pemesanan as $pasien){
            $pemesanan_id[]=$pasien[0]->id;
        }
        return $pemesanan_id;
    }

    public function getLabelMakanan($start,$end,$bangsal_id,$waktu_makan_id)
    {
        $label = PemesananDetail::whereBetween('untuk_tanggal',[$start,$end])
            ->where('waktu_makan_id',$waktu_makan_id)
            ->where('bangsal_id', $bangsal_id)
            ->with(['pemesanan.diet'])->get();
        return $label;
    }

    public function getLabelMakananCair($start,$end,$bangsal_id,$pemesanan_id)
    {
        $label = Pemesanan::select('id','pasien_id','lokasi_id','bangsal_id','tidak_pesan','diet_id','bentuk_makanan_id','kode_diet_id','catatan','ukuran1','ukuran2')
            ->wherein('id',$pemesanan_id)
            ->whereBetween('jadwal_pengantaran',[$start,$end])
            ->where('bangsal_id',$bangsal_id)
            ->where('tidak_pesan',0)
            ->whereHas('diet', function($query)
            {
                $query->where('jenis_makanan_id', 4);
            })
            ->whereHas('bentuk_makanan', function($query)
            {
                $query->wherenull('flag_bayi');
            })
            ->orderby('id','desc')
            ->with(['pasien','kode_diet:id,nama','lokasi:id,nama','diet:id,jenis_makanan_id','bentuk_makanan:id,flag_bayi'])->get()
            ->groupby('pasien_id');
        return $label;
    }

    public function getLabelMakananBayi($start,$end,$bangsal_id,$pemesanan_id)
    {
        $label = Pemesanan::select('id','pasien_id','lokasi_id','bangsal_id','tidak_pesan','diet_id','bentuk_makanan_id','kode_diet_id','catatan','ukuran1','ukuran2')
            ->wherein('id',$pemesanan_id)
            ->whereBetween('jadwal_pengantaran',[$start,$end])
            ->where('bangsal_id',$bangsal_id)
            ->where('tidak_pesan',0)
            ->whereHas('diet', function($query)
            {
                $query->where('jenis_makanan_id', 4);
            })
            ->whereHas('bentuk_makanan', function($query)
            {
                $query->where('flag_bayi',1);
            })
            ->orderby('id','desc')
            ->with(['pasien','kode_diet:id,nama','lokasi:id,nama','diet:id,jenis_makanan_id','bentuk_makanan:id,flag_bayi'])->get()
            ->groupby('pasien_id');
        return $label;
    }

    public function kasusGetPemesanan($kasus_id)
    {
        $pemesanan = Pemesanan::with(['diet', 'pembuat','pemesanan_detail.menu','pemesanan_detail.diet'])
            ->where('kasus_id', $kasus_id)
            ->orderBy('id','desc')
            ->get();
        return $pemesanan;
    }

    public function getPemesananEdit($id)
    {
        $pemesanan = PemesananDetail::where('id',$id)->with(['jenis_makanan','diet','lokasi'])->first();
        return $pemesanan;
    }
}
