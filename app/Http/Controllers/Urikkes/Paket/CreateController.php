<?php
namespace App\Http\Controllers\Urikkes\Paket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Kelas;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifMaster;
use App\Models\Urikkes\Paket;
use App\Models\Urikkes\PaketTarif;
use Illuminate\Support\Facades\Auth;
class CreateController extends Controller
{
    public function create($request)
    {
        $id = $request->paket_id;
        $layanan = $request->layanan;
        if(!empty($id)){ //update paket
            $this->updateSlug($id);
            $paket = Paket::find($id);
            $paket->nama = $request->paket_nama;
            foreach ($layanan as $itemArr) {
                $item = (object) $itemArr;
                if($item->flag ==1){
                    $pt = new PaketTarif();
                    $pt->tarif_id = $item->id;
                    $pt->paket_id = $paket->id;
                    $pt->tipe = $item->tipe;
                    $pt->save();
                }elseif($item->flag==-1){
                    $pt = PaketTarif::find($item->id);
                    $pt->delete();
                }
            }
        }else{ //new paket
            $paket = new Paket();
            $paket->nama = $request->paket_nama;
            $paket->save();
            foreach ($layanan as $itemArr) {
                $item = (object) $itemArr;
                if($item->flag ==1){
                    $pt = new PaketTarif();
                    $pt->tarif_id = $item->id;
                    $pt->paket_id = $paket->id;
                    $pt->tipe = $item->tipe;
                    $pt->save();
                }elseif($item->flag==-1){
                    $pt = PaketTarif::find($item->id);
                    $pt->delete();
                }
            }
        }
        $paket->total = $request->total;
        $paket->save();

        $this->createMasterTarif($paket, 1);
        return $paket;
    }
    public function updateSlug($paket_id)
    {
        $paket = Paket::find($paket_id);
        if (is_null($paket->desc)) {
            $slug = preg_replace('~[^\pL\d]+~u', '-', $paket->nama);
            $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
            $slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
            $slug = trim($slug, '-'); // trim
            $slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
            $slug = strtolower($slug); // lowercase
            $paket_slug = $slug;
            $paket->desc = $paket_slug;
            $paket->save();
        }
        return $paket;
    }
    public function createMasterTarif($paket, $edit = 0)
    {
        $tarif_kategori = TarifKategori::where('slug', 'pemeriksaan-urikkes')->first();
        $kls = Kelas::where('medical_checkup', 1)->first();
        $kelas_tarif = $kls->id;
        if ($paket->tarif_master_id) {
            $tarif_master = TarifMaster::find($paket->tarif_master_id);
            if ($edit > 0) {
                $tarif = Tarif::where('tarif_master_id', $tarif_master->id)->first();
                $tarif->harga = $paket->total;
                $tarif->save();
            }
        }
        else {
            $req = new \stdClass();
            $req->tarif_kategori = $tarif_kategori->id;
            $req->deskripsi = $paket->nama;
            $req->harga[] = $paket->total;
            $req->kelas[] = $kelas_tarif;
            $req->tipe[] = 1;
            $req->jenis[] = '';
    
            $tarif_master = app('App\Http\Controllers\Keuangan\Tarif\CreateController')->create($req);
            $paket->tarif_master_id = $tarif_master->id;
            $paket->save();
        }
        return $tarif_master;
    }

    public function updatePaketHarga($paket)
    {
        $tarif_master = TarifMaster::with('tarif')->where('slug', $paket->desc);
        if (empty($tarif_master)) {
            $this->createMasterTarif($paket);
        }
    }
}