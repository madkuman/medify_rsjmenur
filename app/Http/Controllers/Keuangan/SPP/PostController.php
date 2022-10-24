<?php

namespace App\Http\Controllers\Keuangan\SPP;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use DB;
use App\Models\Keuangan\Utang;

class PostController extends Controller
{
    public function apiSubmit(Request $request)
    {
        if ($request->has('delete')) {
            $id = $request->id;
            $tanggal_spp = NULL;
            $kategori_id = NULL;
            $tahun_anggaran = NULL;
        }
        else{
            if ($request->has('tanggalspp')) {
                $tanggal_spp = $request->tanggalspp;
                $tanggal_spp = Carbon::createFromFormat('d-m-Y', $tanggal_spp, 'Asia/Jakarta');
            }
            else
                $tanggal_spp = NULL;

            $id = $request->id;
            $kategori_id = $request->kategori;
            $tahun_anggaran = $request->tahunanggaran;
        }

        try {
            DB::connection('keuangan')->beginTransaction();
            $transaksi = app('App\Http\Controllers\Keuangan\Utang\EditController')
                        ->SPP($id,$tanggal_spp,$kategori_id,$tahun_anggaran);
            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = $request->has('delete') ? 'Transaksi SPP Berhasil Dihapus' : 'Transaksi SPP Berhasil Dibuat';
            $data['url'] = 'keuangan/spp';

            DB::connection('keuangan')->commit();
        } catch (\Exception $e) {
            DB::connection('keuangan')->rollback();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Transaksi SPP Gagal Dibuat : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
        }

        return json_encode($data);
    }
    
    public function payUtang($utang_id,$total_paid,$akun_id){
		$user_id = Auth::user()->id;

		$utang = Utang::find($utang_id);
		$paid = $utang->total_paid;
		$utang->total_paid = $paid + $total_paid;
		$utang->save();

		$diskon_pengeluaran = (100 - (($total_paid * 100) / $utang->jumlah));
		
		foreach($utang->detail as $item){
			$subtotal_pengeluaran = $item->harga*$item->jumlah*((100-$diskon_pengeluaran)/100);
			$transaksi_detail[] = (object) array(
				'utang_id' =>$utang_id,
				'layanan_string'=> $item->deskripsi,
				'harga'=> $item->harga,
				'diskon'=> $diskon_pengeluaran,
				'jumlah'=> $item->jumlah,
				'subtotal'=> $subtotal_pengeluaran,
				'created_by' => $item->created_by,
				'keterangan' => 'Pembayaran Utang');
		}

		$transaksi = app('App\Http\Controllers\Keuangan\Pengeluaran\CreateController')
					->create($utang->judul,$utang->pemberi,$utang->penerima,$utang->jumlah,$utang->jumlah-$total_paid,$total_paid,$utang->kategori_id,Carbon::now(),$transaksi_detail,$akun_id,$utang->perusahaan_id);
	
		return $utang;
	}
	
	public function pay(Request $request)
	{
		$utang_id = $request->id;
		$total_paid = $request->total_paid;
        $akun_id = $request->akun_id;
		$transaksi = $this->payUtang($utang_id,$total_paid,$akun_id);

		$data['type'] = 'success';
		$data['title'] = 'Berhasil';
		$data['text'] = 'Transaksi Berhasil';
		$data['url'] = 'keuangan/utang/'.$utang_id;

		return json_encode($data);
	}

    public function printWithTTD(Request $request)
    {
        // dd($request);
        $spp_id = $request->id;
        $ttd_id = $request->ttd;
        return app('App\Http\Controllers\Keuangan\SPP\ViewController')
                ->print($spp_id, $ttd_id);
    }
}