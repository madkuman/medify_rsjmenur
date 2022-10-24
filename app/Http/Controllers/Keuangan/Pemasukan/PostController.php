<?php

namespace App\Http\Controllers\Keuangan\Pemasukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use App\Models\Pasien\Pasien;
use App\Models\Keuangan\Pemasukan;

class PostController extends Controller
{

    	public function apiSubmit(Request $request)
    	{
			$id = $request->id;
			$judul = $request->judul;
    		$tanggal = $request->tanggal;
    		$jumlah = $request->alljumlah;
    		$diskon = $request->alldiskon;
    		$total = $request->alltotal;
    		$kategori = $request->kategori;
    		$pasien_id = $request->pasien_id;
    		$transaksi = $request->transaksi;
			$pihak_3 = $request->pihak_3;
			$pasien_pembayaran_id = $request->pasien_pembayaran_id;
			$akun_id = $request->akun_id;
			$lokasi_id = $request->lokasi_id;
			$perusahaan_id = $request->perusahaan_id;
            $tagihan_id = $request->tagihan_id;
            $beban_lain = $request->beban_lain;
            $piutang_id = $request->piutang_id;
            $transaksi = json_decode($transaksi);
    		$tanggal = Carbon::createFromFormat('d-m-Y', $tanggal, 'Asia/Jakarta');

    		try {

                if(!empty($piutang_id)){
                    $data['type'] = 'error';
                    $data['title'] = 'Tidak Bisa';
                    $data['text'] = 'Transaksi ini dibuat dari Piutang. Anda harus menghapus pemasukan ini dan mengedit pada menu Piutang';
                    $data['url'] = 0;
                    return json_encode($data);
                }

    			DB::connection('keuangan')->beginTransaction();
				if(is_null($id)){
                    $pemasukan = new \stdClass();
                    $pemasukan->judul = $request->judul;
                    $pemasukan->jumlah = $request->alljumlah;
                    $pemasukan->diskon = $request->alldiskon;
                    $pemasukan->beban_lain = 0;
                    $pemasukan->total = $request->alltotal;
                    $pemasukan->total_pembayaran = $request->alltotal;
                    $pemasukan->total_kembalian = 0;
                    $pemasukan->total_deposit = 0;
                    $pemasukan->akun_id = $request->akun_id;
                    $pemasukan->pihak_ketiga = $request->pihak_3;
                    $pemasukan->perusahaan_id = $request->perusahaan_id;
                    $pemasukan->pasien_id = $request->pasien_id;
                    $pemasukan->pasien_pembayaran_id = $request->pasien_pembayaran_id;
                    $pemasukan->lokasi_id = $request->lokasi_id;
                    $pemasukan->kategori_id = $request->kategori;
                    $pemasukan->tanggal_transaksi = $tanggal;
                    $pemasukan->piutang_id = $request->piutang_id;
					$transaksi = app('App\Http\Controllers\Keuangan\Pemasukan\CreateController')
								->create($pemasukan,$transaksi,$pasien_pembayaran_id);
                }
				else
					$transaksi = app('App\Http\Controllers\Keuangan\Pemasukan\EditController')
								->update($id,$judul,$jumlah,$diskon,$beban_lain,$total,$pasien_id,$pihak_3,
                                    $kategori,$tanggal,$transaksi,$pasien_pembayaran_id,$akun_id,
                                    $perusahaan_id,$lokasi_id,$tagihan_id,$piutang_id);



    			$data['type'] = 'success';
    			$data['title'] = 'Berhasil';
    			$data['text'] = 'Transaksi Pemasukan Berhasil Dibuat';
    			$data['url'] = 'keuangan/pemasukan/'.$transaksi->id;

    			DB::connection('keuangan')->commit();
    		} catch (\Exception $e) {
    			DB::connection('keuangan')->rollback();
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    			$data['type'] = 'error';
    			$data['title'] = 'Gagal';
    			$data['text'] = 'Transaksi Pemasukan Gagal Dibuat : Kesalahan Server, silahkan hubungi admin';
    			$data['url'] = 0;
    		}

		return json_encode($data);
    	}
}

