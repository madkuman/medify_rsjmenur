<?php

namespace App\Http\Controllers\KamarOperasi\Pasca;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Pasca;
use App\Models\KamarOperasi\Transaksi;
use Carbon\Carbon;
use DB;
use Auth;

class PostController extends Controller
{
    public function ajaxPascaAdd(Request $request)
    {
    	//dd($request->all());
    	$id = !empty($request->input('id')) ? $request->input('id') : $request->input('pasca_id');
        $kasus_id = !empty($request->input('kasus_id')) ? $request->input('kasus_id') : NULL;
    	$diag_awal = $request->input('diag_awal');
		$diag_akhir = $request->input('diag_akhir');
		$persiapan = $request->input('persiapan');
		$posisi = $request->input('posisi');
		$disinfektan = $request->input('disinfektan');
		$incisi = $request->input('incisi');
		$temuan = $request->input('temuan');
		$tindakan = $request->input('tindakan');
		$pendarahan = $request->input('pendarahan');
		$advice = $request->input('advice');
		$jenis_operasi = $request->input('jenis_operasi');
		$pemeriksaan_pa = $request->input('pemeriksaan_pa');
		$tanggal = Carbon::createFromFormat('d-m-Y', $request->input('tanggal'))->toDateString();
		$waktu_mulai = Carbon::createFromFormat('H : i', $request->input('waktu_mulai'))->toTimeString();
		$waktu_selesai = Carbon::createFromFormat('H : i',$request->input('waktu_selesai'))->toTimeString();
		$anastesi = Carbon::createFromFormat('H : i',$request->input('anastesi'))->toTimeString();

		$pasca = new Pasca;
		$pasca->diagnosis_awal = $diag_awal;
		$pasca->diagnosis_akhir = $diag_akhir;
		$pasca->persiapan = $persiapan;
		$pasca->posisi = $posisi;
		$pasca->disinfektan = $disinfektan;
		$pasca->incisi = $incisi;
		$pasca->temuan_operasi = $temuan;
		$pasca->tindakan = $tindakan;
		$pasca->pendarahan = $pendarahan;
		$pasca->advice_post = $advice;
		$pasca->pemeriksaan_pa = $pemeriksaan_pa;
		$pasca->jenis_operasi = $jenis_operasi;
		$pasca->tanggal_operasi = $tanggal;
		$pasca->waktu_mulai = $waktu_mulai;
		$pasca->waktu_selesai = $waktu_selesai;
		$pasca->lama_anastesi = $anastesi;
        $pasca->kasus_id = $kasus_id;
        $pasca->created_by = Auth::user()->id;
		$pasca->save();

		//UPDATE TRANSAKSI FROM KAMAROPERASI
        if (!empty($request->input('id'))) {
            $transaksi = Transaksi::find($id);
            if($transaksi->kasus_id){
                $pasca->kasus_id = $transaksi->kasus_id;
                $pasca->save();
            }

            //DELETE OLD PASCA
            if (!empty($transaksi->hasil_id)) {
                $old_pasca = Pasca::find($transaksi->hasil_id);
                $old_pasca->delete();
            }

            //UPDATE NEW PASCA
            $transaksi->hasil_id=$pasca->id;
            $transaksi->status=1;
            $transaksi->save();
        }

        //UPDATE TRANSAKSI FROM KASUS
        else {
            //CHECK IF ALREADY HAS HASIL, BYPASS IF NEW ENTRY
            if (!empty($kasus_id)) {
                $old_pasca = Pasca::find($id);

                //UPDATE NEW PASCA
                if (!empty($old_pasca->transaksi)) {
                    $transaksi = Transaksi::find($old_pasca->transaksi->id);
                    $transaksi->hasil_id=$pasca->id;
                    $transaksi->status=1;
                    $transaksi->save();


                    if($transaksi->kasus_id){
                        $pasca->kasus_id = $transaksi->kasus_id;
                        $pasca->save();
                    }
                }

                //DELETE OLD PASCA
                $old_pasca->delete();
            }
        }

		$status = 1;
      	$message = 'Pencatatan Hasil Operasi Berhasil!';
       	$title = 'Berhasil!';

		return redirect('kamaroperasi/pelaksanaan/'.$id)
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
    }

    public function hasilOperasiAdd(Request $request)
    {
        $connection = DB::connection('kamaroperasi');
        $connection->beginTransaction();
        try {
            $id = !empty($request->input('id')) ? $request->input('id') : $request->input('pasca_id');
            $kasus_id = !empty($request->input('kasus_id')) ? $request->input('kasus_id') : NULL;
            $diag_awal = $request->input('diag_awal');
            $diag_akhir = $request->input('diag_akhir');
            $persiapan = $request->input('persiapan');
            $posisi = $request->input('posisi');
            $disinfektan = $request->input('disinfektan');
            $incisi = $request->input('incisi');
            $temuan = $request->input('temuan');
            $tindakan = $request->input('tindakan');
            $pendarahan = $request->input('pendarahan');
            $advice = $request->input('advice');
            $jenis_operasi = $request->input('jenis_operasi');
            $pemeriksaan_pa = $request->input('pemeriksaan_pa');
            $macam_anestesi = $request->input('macam_anestesi');
            $tanggal = Carbon::createFromFormat('d M Y', $request->input('tanggal'))->toDateString();
            $waktu_mulai = Carbon::createFromFormat('H:i', $request->input('waktu_mulai'))->toTimeString();
            $waktu_selesai = Carbon::createFromFormat('H:i',$request->input('waktu_selesai'))->toTimeString();
            $anastesi = Carbon::createFromFormat('H:i',$request->input('anastesi'))->toTimeString();
            $status_pasien = $request->input('status_pasien');
            
            $pasca = new Pasca;
            $pasca->diagnosis_awal = $diag_awal;
            $pasca->diagnosis_akhir = $diag_akhir;
            $pasca->persiapan = $persiapan;
            $pasca->posisi = $posisi;
            $pasca->disinfektan = $disinfektan;
            $pasca->incisi = $incisi;
            $pasca->temuan_operasi = $temuan;
            $pasca->tindakan = $tindakan;
            $pasca->pendarahan = $pendarahan;
            $pasca->advice_post = $advice;
            $pasca->pemeriksaan_pa = $pemeriksaan_pa;
            $pasca->jenis_operasi = $jenis_operasi;
            $pasca->tanggal_operasi = $tanggal;
            $pasca->waktu_mulai = $waktu_mulai;
            $pasca->waktu_selesai = $waktu_selesai;
            $pasca->lama_anastesi = $anastesi;
            $pasca->macam_anestesi = $macam_anestesi;
            $pasca->status_pasien = $status_pasien; //PENAMBAHAN STATUS PASIEN
            $pasca->kasus_id = $kasus_id;
            $pasca->created_by = Auth::user()->id;
            $pasca->save();

            //UPDATE TRANSAKSI FROM KAMAROPERASI
            if (empty($kasus_id)) {
                $transaksi = Transaksi::find($id);
                if($transaksi->kasus_id){
                    $pasca->kasus_id = $transaksi->kasus_id;
                    $pasca->save();
                }elseif(isset($transaksi->parent)) {
                    $pasca->kasus_id = $transaksi->parent->kasus_id;
                    $pasca->save();
                }

                //DELETE OLD PASCA
                if (!empty($transaksi->hasil_id)) {
                    $old_pasca = Pasca::find($transaksi->hasil_id);
                    $old_pasca->delete();
                }

                //UPDATE NEW PASCA
                $transaksi->hasil_id=$pasca->id;
                $transaksi->status=1;
                $transaksi->save();
            }

            //UPDATE TRANSAKSI FROM KASUS
            else {
                //CHECK IF ALREADY HAS HASIL, BYPASS IF NEW ENTRY
                if (!empty($id)) {
                    $old_pasca = Pasca::find($id);

                    if($transaksi->kasus_id){
                        $pasca->kasus_id = $transaksi->kasus_id;
                        $pasca->save();
                    }

                    //UPDATE NEW PASCA
                    if (!empty($old_pasca->transaksi)) {
                        $transaksi = Transaksi::find($old_pasca->transaksi->id);
                        $transaksi->hasil_id=$pasca->id;
                        $transaksi->status=1;
                        $transaksi->save();
                    }

                    //DELETE OLD PASCA
                    $old_pasca->delete();
                }
            }

            $connection->commit();

            $status = 1;
            $message = 'Pencatatan Hasil Operasi Berhasil!';
            $title = 'Berhasil!';

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        } catch (\Exception $e) {
            
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $connection->rollback();

            $status = -1;
            $message = 'An Error Occured';
            $title = 'Error!';

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
    }
}
