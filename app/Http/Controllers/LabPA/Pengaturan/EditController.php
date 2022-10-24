<?php

namespace App\Http\Controllers\LabPA\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Tarif;
use DB;
use Bugsnag;

class EditController extends Controller
{
    private const departemenId = 7;
    public function update(Request $req)
    {
    	try {
            DB::connection('keuangan')->beginTransaction();
    		$tarif_types = [1, 2];
            $tarif = Tarif::find($req['tarif_id']);
            $tarif_details = [];
            foreach($tarif_types as $type){
                $data = app('App\Http\Controllers\Keuangan\Tarif\ReadController')->getTarifDetail($req['tarif_id'], $type);
                            // dd($req[$type.'_urj']);
                $item = (object) array(
                    'is_deleted' => false,
                    'detail_id' => $data->id,
                    'tipe_id' => $type,
                    'biasa' => $data->biasa,
                    'urj' => $req[$type.'_urj'],
                    'igd' => $req[$type.'_igd'],
                    'vvip' => $req[$type.'_vvip'],
                    'vip_a' => $req[$type.'_vip_a'],
                    'vip_paviliun' => $req[$type.'_vip_paviliun'],
                    'i_paviliun' => $req[$type.'_i_paviliun'],
                    'vip_ruangan' => $req[$type.'_vip_ruangan'],
                    'i_a' => $req[$type.'_i_a'],
                    'i_b' => $req[$type.'_i_b'],
                    'ii' => $req[$type.'_ii'],
                    'iii_ac' => $req[$type.'_iii_ac'],
                    'iii_non_ac' => $req[$type.'_iii_non_ac']
                );
                array_push($tarif_details, $item);
            }
            if(app('App\Http\Controllers\Keuangan\Tarif\EditController')->update($req['tarif_id'], $this::departemenId, $tarif->tarif_kategori_id, $tarif->deskripsi, $tarif->tarif_kode_id, $tarif->satuan, $tarif_details)){
                DB::connection('keuangan')->commit();
              return redirect('labpa/pengaturan')->with('status', 'success')->with('message', 'Berhasil Mengubah Layanan');
            }
    	} catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('keuangan')->rollback();
            return redirect('labpa/pengaturan')->with('status', 'error')->with('message', 'Gagal Mengubah Layanan');
    	}
    }
}