<?php

namespace App\Http\Controllers\Kasus\TagihanDetail;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\TagihanDetail;
use App\Models\Kasus\Kasus;
use Auth;
use DB;
use Bugsnag;

class PostController extends Controller
{
    public function create(Request $request,$nomor_kasus)
    {
        // dd($request);
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
            $data['kasus_id'] = $request->kasus_id;
            $data['tarif_id'] = $request->tarif_id;
            $data['tarif_tipe_id'] = $request->tarif_tipe_id;
            $data['tarif_kelas_id'] = $request->tarif_kelas_id;
            $data['desc'] = $request->desc;
            $data['unit_price'] = $request->unit_price;
            $data['qty'] = $request->qty;
            $data['tagihan_id'] = $request->tagihan_id;
            $data['sep_id'] = $request->sep_id;
            // $data['daftar_harga_id'] = $request->daftar_harga_id; -OBSOLETE-
            $data['lokasi'] = $request->lokasi_id;
            $data['kategori_id'] = $request->kategori_id;
            // $data['departemen_id'] = $request->departemen_id; -OBSOLETE-
            $data['transaksi_kamar_operasi_id'] = $request->transaksi_kamar_operasi_id;

            $tgl = $request->tanggal_transaksi ?? Carbon::now()->format('d-m-Y');
            $jam = $request->jam ?? Carbon::now()->format('H');
            $menit = $request->menit ?? Carbon::now()->format('i');
            $format = $tgl.' '.$jam.':'.$menit;
            $data['created_at'] = Carbon::createFromFormat('d-m-Y H:i',$format);

            $createDetail = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);

            $status = 1;
            $message = 'Tagihan berhasil ditambahkan';
            $title = 'Berhasil!';

            
            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }

    public function edit(Request $request,$nomor_kasus)
    {
        // dd($request);
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
            $data['id'] = $request->id;
            $data['kasus_id'] = $request->kasus_id;
            $data['desc'] = $request->desc;
            $data['unit_price'] = $request->unit_price;
            $data['qty'] = $request->qty;
            $data['tagihan_id'] = $request->tagihan_id;
            // $data['daftar_harga_id'] = $request->daftar_harga_id; -OBSOLETE-
            $data['lokasi'] = $request->lokasi_id;
            $data['tarif_id'] = $request->tarif_id;
            // $data['tarif_tipe_id'] = $request->tarif_tipe_id; -OBSOLETE-
            $data['tarif_kelas'] = $request->tarif_kelas;
            // $data['departemen_id'] = $request->departemen_id; -OBSOLETE-
            $data['sep_id'] = $request->sep_id;
            $tgl = $request->tanggal_transaksi ?? Carbon::now()->format('d-m-Y');
            $jam = $request->jam ?? Carbon::now()->format('H');
            $menit = $request->menit ?? Carbon::now()->format('i');
            $format = $tgl.' '.$jam.':'.$menit;
            $data['created_at'] = Carbon::createFromFormat('d-m-Y H:i',$format);

            $editDetail = app('App\Http\Controllers\Kasus\TagihanDetail\EditController')->edit($data);

            $status = 1;
            $message = 'Tagihan berhasil diubah';
            $title = 'Berhasil!';

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }

    public function delete($nomor_kasus,Request $request)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            $tagihan = TagihanDetail::find($request->id);
            $kasus = Tagihan::find($tagihan->kasus_tagihan_id);
            $kasusId = $kasus->kasus_id;
            $tagihanId = $tagihan->id;
            $new_nominal = $tagihan->subtotal;
            $tagihan->delete();

            $status = 1;
            $message = 'Tagihan berhasil dihapus!';
            $title = 'Berhasil!';

            $tagihan = app('App\Http\Controllers\Kasus\Tagihan\EditController')->delete_bill($tagihan->kasus_tagihan_id,$new_nominal);


            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasusId,'delete','tagihan',$tagihanId);

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            if(!empty($request->operasi_id))
            {
                return redirect('/kamaroperasi/pelaksanaan/'.$request->operasi_id.'#tagihan')
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);    
            }
            else
            {
                return back()
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
            }

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }

    public function pindahkanMulti(Request $request)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        $status = -1;
        $message = "Tagihan untuk sudah di checkout. Silahkan batalkan checkout terlebih dahulu sebelum melanjutkan.";
        $title = 'Gagal!';
        try {
            $kasus = $request->kasus;
            if ($request->tujuan_tagihan != 0) {
                $pindahkan = app('App\Http\Controllers\Kasus\TagihanDetail\EditController')->pindahkan($request, 'multi');
                if (empty($pindahkan)) {
                    DB::connection('kasus')->rollback();
                    DB::connection('mysql')->rollback();
                } else {
                    $status = 1;
                    $message = 'Tagihan berhasil dipindahkan';
                    $title = 'Berhasil!';
                }
                DB::connection('kasus')->commit();
                DB::connection('mysql')->commit();
            }

            return back()
                ->with('message', $message)
                ->with('title', $title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
        }
    }

}
