<?php

namespace App\Http\Controllers\Kasus\Resep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Resep;
use App\Models\Kasus\ResepDetail;
use App\Models\Kasus\ResepRacikanDetail;
use App\Models\Kasus\Kasus;
use DB;
use Bugsnag;
use Auth;

class EditController extends Controller
{
	public function editResep(Request $request,$nomorKasus)
	{
		DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
			//dd($request);
			$resepId = $request->id;

			$kasusId = Kasus::where('nomor_kasus', $nomorKasus)->pluck('id')->first();
			$pasienId = Kasus::where('nomor_kasus', $nomorKasus)->pluck('pasien_id')->first();

			$kategoriObat = $request->input('kategori-obat');
			$tipeObat = $request->input('tipe-obat');
			$jumlahObat = $request->input('jumlah-obat');
			$namaObat = $request->input('nama-obat');
			$racikan = $request->input('racikan');
			$aturanObat = $request->input('aturan-obat');
			$idObat = $request->input('id-obat');

			//dd($kategoriObat);
			$resep = Resep::find($resepId);
			//handler prevent backend status farmasi
            if(!empty($resep->transaksi_farmasi->paid_at) || count($resep->transaksi_farmasi->copy_resep) > 0)
            {
                $status = -1;
                $message = 'Resep Sudah Di Layani!';
                $title = 'Gagal!';
                DB::connection('kasus')->rollback();
                DB::connection('mysql')->rollback();
                return redirect('/kasus/'.$nomorKasus.'/datamedis/resep')
                    ->with('active_nav','resep')
                    ->with('message', $message)
                    ->with('title',$title)
                    ->with('status', $status);
            }

            $resep->jenis_resep = $request->input('jenis_resep');
            $resep->save();

			$size = sizeof($namaObat);

			$this->deleteOldResepDetail($resepId);

			for($i = 0; $i < $size; $i++) {
				$resepDetail = new ResepDetail();
				$resepDetail->kasus_resep_id = $resepId;
				$resepDetail->obat_name = $namaObat[$i];
				$resepDetail->kategori = $kategoriObat[$i];
				$resepDetail->type = $tipeObat[$i];
				$resepDetail->racikan = $racikan[$i];
				$resepDetail->jumlah = $jumlahObat[$i];
				$resepDetail->aturan = $aturanObat[$i];
				$resepDetail->obat_id = $idObat[$i];
				$resepDetail->save();
				
                 if($resepDetail->kategori == 'racikan')
                {
                    $racikanDetailObat = json_decode($request->input('racikan-detail-obat')[$i]);
                    $racikanDetalJumlah = json_decode($request->input('racikan-detail-jumlah')[$i]);
                    $racikanDetalNama = json_decode($request->input('racikan-detail-nama')[$i]);

                    foreach($racikanDetailObat as $index => $item_racikan_temp)
                    {

                        $racikanDetail = new ResepRacikanDetail;
                        $racikanDetail->resep_detail_id = $resepDetail->id;
                        $racikanDetail->nama_obat = $racikanDetalNama[$index];
                        $racikanDetail->obat_id = $racikanDetailObat[$index];
                        $racikanDetail->jumlah = $racikanDetalJumlah[$index];
                        $racikanDetail->save();
                    }
                }
			}
			

			
			
			if (!empty($resep->transaksi_id)) {
				//dd("masuk if");
				$request->merge([
					'no_redirect' => 1,	
					'id' => $resep->transaksi_id,
					'farmasi' => $request->input('nama-apotek'),
					'keterangan' => 'Ubah resep pasien'		
				]);

                $resep_farmasi = app('App\Http\Controllers\Farmasi\Transaksi\EditController')->editFromKasus($request);
                //$resep_farmasi = app('App\Http\Controllers\Farmasi\Resep\CreateController')->create($request);
                //$resep->transaksi_id = $resep_farmasi->id;
                $resep->updated_by = Auth::user()->id;
                $resep->save();
            }
            //dd("lewat if");
			//$tryReturn = app('App\Http\Controllers\Apotek\TransaksiObat\CreateController')->createResep($request);

			$status = 1;
			$message = 'Resep berhasil diubah!';
			$title = 'Berhasil!';



			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasusId,'edit','resep',$resep->id);


			DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return redirect('/kasus/'.$nomorKasus.'/datamedis/resep')
            ->with('active_nav','resep')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }

	}

	private function deleteOldResepDetail($resepId)
	{
		$reseps = ResepDetail::where('kasus_resep_id',$resepId);
		//dd($reseps);
		$reseps->delete();
	}
}
