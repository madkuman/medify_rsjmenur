<?php

namespace App\Http\Controllers\Keuangan\Pengeluaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Keuangan\Pengeluaran;
use App\Models\Keuangan\PengeluaranDetail;

class EditController extends Controller
{
    public function update($id,$tanggal_bk,$akun,$no_bk)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->tanggal_bk = $tanggal_bk;
        $pengeluaran->akun_id = $akun;
        $pengeluaran->bk_id = app('App\Http\Controllers\Keuangan\BukuKas\CreateController')->createManual($no_bk);
        // NOT USED FOR NOW
        // $pengeluaran->bk_id = app('App\Http\Controllers\Keuangan\BukuKas\CreateController')->create();

        $pengeluaran->save();
        
        return $pengeluaran;
    }



    public function editPajak($id, Request $request)
    {
        // dd($request);
        $pengeluaran = Pengeluaran::find($id);
        // $detail_ppn = $pengeluaran->detail->where('kategori_id', 47)->first();
        // dd($detail_ppn);
        $dpp = floor(($pengeluaran->kena_ppn+$pengeluaran->jasa) * (100/110));
        
        try {
            DB::connection('keuangan')->beginTransaction();

            if (!($pengeluaran->detail()->exists())) {
                for ($i=0; $i < 6; $i++) {     
                    $detail = new PengeluaranDetail;
                    $detail->utang_id = $pengeluaran->utang_id;    
                    $detail->pengeluaran_id = $pengeluaran->id;
                    $detail->created_by = $pengeluaran->created_by;
                    $detail->created_at = $pengeluaran->created_at;
                    $detail->updated_at = $pengeluaran->updated_at;
                    if ($i == 0) {
                        $detail->kategori_id = $pengeluaran->kategori_id;
                        $detail->jumlah = $pengeluaran->total;
                    }
                    else{
                        $detail->kategori_id = $i+42;
                    }

                    $detail->save(['timestamps' => false]);
                }
            }

            if ($request->ppn > 0){
                $pengeluaran->ppn = 100 * $request->ppn / $dpp;
                $detail_ppn = $pengeluaran->detail->where('kategori_id', 47)->first();
                $detail_ppn->jumlah = $request->ppn;
                $detail_ppn->save();
            }
            else{
                $pengeluaran->ppn = NULL;
                $detail_ppn = $pengeluaran->detail->where('kategori_id', 47)->first();
                $detail_ppn->jumlah = $request->ppn;
                $detail_ppn->save();
            }
            if ($request->pph21 > 0){
                if ($pengeluaran->pph_21_5 != NULL) {
                    $pengeluaran->pph_21_5 = 100 * $request->pph21 / $dpp;
                }
                elseif ($pengeluaran->pph_21_15 != NULL) {
                    $pengeluaran->pph_21_15 = 100 * $request->pph21 / $dpp;
                }
                else{
                    $pengeluaran->pph_21_5 = 100 * $request->pph21 / $dpp;
                }
                $detail_pph_21 = $pengeluaran->detail->where('kategori_id', 43)->first();
                $detail_pph_21->jumlah = $request->pph21;
                $detail_pph_21->save();
            }
            else{
                if ($pengeluaran->pph_21_5 != NULL) {
                    $pengeluaran->pph_21_5 = NULL;
                }
                elseif ($pengeluaran->pph_21_15 != NULL) {
                    $pengeluaran->pph_21_15 = NULL;
                }
                $detail_pph_21 = $pengeluaran->detail->where('kategori_id', 43)->first();
                $detail_pph_21->jumlah = $request->pph21;
                $detail_pph_21->save();
            }
            if ($request->pph22 > 0){
                $pengeluaran->pph_22 = 100 * $request->pph22 / $dpp;
                $detail_pph_22 = $pengeluaran->detail->where('kategori_id', 44)->first();
                $detail_pph_22->jumlah = $request->pph22;
                $detail_pph_22->save();
            }
            else{
                $pengeluaran->pph_22 = NULL;
                $detail_pph_22 = $pengeluaran->detail->where('kategori_id', 44)->first();
                $detail_pph_22->jumlah = $request->pph22;
                $detail_pph_22->save();
            }
            if ($request->pph23 > 0){
                $pengeluaran->pph_23 = 100 * $request->pph23 / ($dpp+$pengeluaran->pph23nonppn);
                $detail_pph_23 = $pengeluaran->detail->where('kategori_id', 45)->first();
                $detail_pph_23->jumlah = $request->pph23 + $request->pph23ac + $request->pph23bb;
                $detail_pph_23->save();
            }
            else{
                $pengeluaran->pph_23 = NULL;
                $detail_pph_23 = $pengeluaran->detail->where('kategori_id', 45)->first();
                $detail_pph_23->jumlah = $request->pph23;
                $detail_pph_23->save();
            }
            // if ($request->pph23ac){
            //     $pengeluaran->pph_23_ac = 100 * $request->pph23ac / ($dpp+$pengeluaran->pph23nonppn);
            //     $detail_pph_23 = $pengeluaran->detail->where('kategori_id', 45)->first();
            //     $detail_pph_23->jumlah = $request->pph23 + $request->pph23ac + $request->pph23bb;
            //     $detail_pph_23->save();
            // }
            // else{
            //     $pengeluaran->pph_23_ac = NULL;
            //     $detail_pph_23 = $pengeluaran->detail->where('kategori_id', 45)->first();
            //     $detail_pph_23->jumlah = $request->pph23 + $request->pph23ac + $request->pph23bb;
            //     $detail_pph_23->save();
            // }
            // if ($request->pph23bb > 0){
            //     $pengeluaran->pph_23_bb = 100 * $request->pph23bb / ($dpp+$pengeluaran->pph23nonppn);
            //     $detail_pph_23 = $pengeluaran->detail->where('kategori_id', 45)->first();
            //     $detail_pph_23->jumlah = $request->pph23 + $request->pph23ac + $request->pph23bb;
            //     $detail_pph_23->save();
            // }
            // else{
            //     $pengeluaran->pph_23_bb = NULL;
            //     $detail_pph_23 = $pengeluaran->detail->where('kategori_id', 45)->first();
            //     $detail_pph_23->jumlah = $request->pph23 + $request->pph23ac + $request->pph23bb;
            //     $detail_pph_23->save();
            // }
            if ($request->pph4 > 0){
                $pengeluaran->pph_4 = 100 * $request->pph4 / $pengeluaran->bebas_ppn;
                $detail_pph_4 = $pengeluaran->detail->where('kategori_id', 46)->first();
                $detail_pph_4->jumlah = $request->pph4;
                $detail_pph_4->save();
            }
            else{
                $pengeluaran->pph_4 = NULL;
                $detail_pph_4 = $pengeluaran->detail->where('kategori_id', 46)->first();
                $detail_pph_4->jumlah = $request->pph4;
                $detail_pph_4->save();
            }

            $pengeluaran->dibayarkan = $pengeluaran->total - ($request->ppn+$request->pph21+$request->pph22+$request->pph23+$request->pph4);
            $pengeluaran->save();

            $status = 1;
            $message = 'Berhasil Mengedit UJI';
            $title = 'Berhasil!';

            DB::connection('keuangan')->commit();
        } catch (\Exception $e) {
            DB::connection('keuangan')->rollback();
            $status = -1;
            $message = 'Gagal Mengedit UJI';
            $title = 'Gagal!';
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return redirect('keuangan/uji')
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }
}