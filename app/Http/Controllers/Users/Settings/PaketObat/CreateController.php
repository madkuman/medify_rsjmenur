<?php

namespace App\Http\Controllers\Users\Settings\PaketObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\PaketObat;
use App\Models\Hospital\PaketObatDetail;
use App\Models\Hospital\PaketObatRacikanDetail;
use App\Models\Hospital\PaketObatSubscribe;
use Auth;

class CreateController extends Controller
{
    	public function create($data)
    	{	
    		$paket = new PaketObat;
    		$paket->nama = $data['nama_paket'];
    		$paket->created_by = $data['user_id'];
    		$paket->save();

    		foreach ($data['kategori_obat'] as $index => $value) {
    			$item = new PaketObatDetail;
    			$item->paket_obat_id = $paket->id;
    			$item->kategori = $data['kategori_obat'][$index];
    			$item->obat_id = $data['generik_id'][$index];
    			$item->racikan = $data['racikan_nama'][$index];
    			$item->type = $data['tipe_obat'][$index];
    			$item->jumlah = $data['jumlah_obat'][$index];
    			$item->aturan = $data['aturan'][$index];
    			$item->save();

                if($item->kategori == 'racikan')
                {
                    $racikanDetailObat = json_decode($data['racikan-detail-obat'][$index]);
                    $racikanDetalJumlah = json_decode($data['racikan-detail-jumlah'][$index]);
                    $racikanDetalNama = json_decode($data['racikan-detail-nama'][$index]);

                    foreach($racikanDetailObat as $index => $item_racikan_temp)
                    {

                        $racikanDetail = new PaketObatRacikanDetail;
                        $racikanDetail->resep_detail_id = $item->id;
                        $racikanDetail->nama_obat = $racikanDetalNama[$index];
                        $racikanDetail->obat_id = $racikanDetailObat[$index];
                        $racikanDetail->jumlah = $racikanDetalJumlah[$index];
                        $racikanDetail->save();
                    }
                }
    		}

    		return $paket;
    	}

        public function subscribePaket($id)
        {

            $item = PaketObatSubscribe::where('created_by',Auth::user()->id)->where('paket_obat_id',$id)->first();
            if(empty($item->id)){
                $paket = new PaketObatSubscribe;
                $paket->paket_obat_id = $id;
                $paket->created_by = Auth::user()->id;
                $paket->save();
                $data['message'] = 'Berhasil di subscribe';
                $data['status'] = 1;
            }
            else
            {
                $data['message'] = 'Anda telah men-subscribe paket ini sebelumnya';
                $data['status'] = -1;
            }

            return $data;
        }
}
