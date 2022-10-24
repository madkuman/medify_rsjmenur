<?php

namespace App\Http\Controllers\Keuangan\Tarif;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\TarifDetail;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\Tarif;
use App\Models\Hospital\Kelas;
use App\Models\Keuangan\TarifTipe;
use DB;
use Auth;

class EditController extends Controller
{
    protected static $labPKDepartemen=6;

	public function edit(Request $req, $id)
	{
		try {
			DB::connection('keuangan')->beginTransaction();
			if(isset($req['deleted_id']))
				$this->deleteHarga($req);
            $kategori = TarifKategori::find($req['tarif_kategori']);

			$master = TarifMaster::find($id);
			$master->kategori_id = $req['tarif_kategori'];
			$master->deskripsi = $req['deskripsi'];
            if(!is_null($kategori) && $kategori->departemen_id == self::$labPKDepartemen)
                $master->lis_id = $req['lis_id'];
			$master->save();

			foreach($req['harga'] as $i => $t)
			{
				if(isset($req['tarif_id'][$i]))
					$tarif = Tarif::find($req['tarif_id'][$i]);
				else
					$tarif = new Tarif;

				$tarif->tarif_master_id = $id;
				// $tarif->deskripsi_temp = $req['deskripsi'];
				$tarif->tipe_id = $req['tipe'][$i];
				$tarif->kelas_id = $req['kelas'][$i];
                if($req->jenis[$i] == 'persen'){
                    $tarif->persen = $t;
                    $tarif->harga = null;
                }
                else{
                    $tarif->harga = $t;
                    $tarif->persen = null;
                }
                // $tarif->kelas_temp = Kelas::find($req->kelas[$i])->nama ?? "Semua Kelas";
                // $tarif->tipe_temp = TarifTipe::find($req->tipe[$i])->nama;
				$tarif->harga = $t;
				$tarif->save();
			}

			DB::connection('keuangan')->commit();
            $status = 'success';
            $message = "Berhasil mengubah tarif";
            $title = 'Berhasil!';
            return redirect('keuangan/tarif/'.$id)
                    ->with('status', $status)
                    ->with('message', $message)
                    ->with('title', $title);

		} catch (Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('keuangan')->rollback();
            $status = 'error';
            $message = "Gagal mengubah tarif";
            $title = 'Gagal!';
            return redirect()->back()
                    ->with('status', $status)
                    ->with('message', $message)
                    ->with('title', $title);
		}

	}

	private function deleteHarga($req)
	{
		foreach ($req['deleted_id'] as $val) {
			Tarif::find($val)->delete();
		}
	}

	public function updateMasterTag($min, $max)
    {
        $file = fopen("dataset/indonesian-stopwords-complete.txt","r");
        for ($i = $min; $i<= $max; $i++) {
    		$tarif = TarifMaster::with('kategori')->find($i);
            if(isset($tarif)){
                $new_string = strtolower(preg_replace("/[^A-Za-z ]/", ' ', $tarif->kategori->ancestor_name));
                $tags = explode(" ", $new_string);
                $tags_array = [];
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
                            array_push($tags_array, $tag);
                        }
                    }
                }
                $new_tags = implode(" ", array_unique($tags_array));
                $tarif->tags = $new_tags;
                $tarif->save();
            }
        }
        fclose($file);
    }

    public function settingUrikkes($req, $tarif_id)
    {
        $tarif = TarifMaster::find($tarif_id);
        if(is_null($tarif)) return NULL;
        $hasil_urikkes = '';
        foreach ($req['tabel'] as $i => $val) {
            $hasil_urikkes .= $val.'|'.$req['kolom'][$i];
            if(isset($req['tabel'][$i+1]))
                $hasil_urikkes .= ';';
        }
        $tarif->hasil_urikkes = $hasil_urikkes;
        $tarif->save();
        return $tarif;
    }
}