<?php

namespace App\Http\Controllers\Keuangan\Utang;
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
        if ($request->has('id')) {
            $id = $request->id;
        }
        else
            $id = NULL;
        $tanggal_penerimaan = $request->tanggalpenerimaan;
        $tanggal_faktur = $request->tanggalfaktur;
        $tanggal_po = $request->tanggalpo;
        $judul = $request->judul;
        $jumlah = $request->alljumlah;
        $diskon = $request->alldiskon;
        $total = $request->alltotal;
        $perusahaan_id = $request->perusahaan_id;
        $no_faktur = $request->nofaktur;
        $no_po = $request->nopo;
        $id_po = $request->idpo;
        if ($request->hasFile('gambarfaktur')) {
            $gambar_faktur = $request->file('gambarfaktur');
            $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($gambar_faktur,'faktur');
            $faktur = $image['file_original'];
        }
        else{
            $faktur = NULL;
        }
        $transaksi = $request->transaksi;
        $transaksi = json_decode($transaksi);

        $tanggal_penerimaan = Carbon::createFromFormat('d-m-Y', $tanggal_penerimaan, 'Asia/Jakarta');
        if (!empty($tanggal_faktur)) {
            $tanggal_faktur = ($tanggal_faktur != "undefined") ? Carbon::createFromFormat('d-m-Y', $tanggal_faktur, 'Asia/Jakarta') : $tanggal_faktur;
        }
        if (!empty($tanggal_po)) {
            $tanggal_po = ($tanggal_po != "undefined") ? Carbon::createFromFormat('d-m-Y', $tanggal_po, 'Asia/Jakarta') : $tanggal_po;
        }
        try {
            DB::connection('keuangan')->beginTransaction();
            if(is_null($id))
                $transaksi = app('App\Http\Controllers\Keuangan\Utang\CreateController')
                            ->create($judul,$jumlah,$diskon,$total,$transaksi,$perusahaan_id,$tanggal_penerimaan,$tanggal_faktur,$tanggal_po,$no_faktur,$no_po,$id_po,$faktur);
            else{
                $transaksi = app('App\Http\Controllers\Keuangan\Utang\EditController')
                            ->update($id,$judul,$jumlah,$diskon,$total,$transaksi,$perusahaan_id,$tanggal_penerimaan,$tanggal_faktur,$tanggal_po,$no_faktur,$no_po,$id_po,$faktur);
            }
            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Transaksi Penerimaan Berhasil Dibuat';
            $data['url'] = 'keuangan/penerimaan/'.$transaksi->id;

            DB::connection('keuangan')->commit();
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('keuangan')->rollback();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Transaksi Penerimaan Gagal Dibuat : Kesalahan Server, silahkan hubungi admin';
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
		$data['url'] = 'keuangan/pjk/'.$utang_id;

		return json_encode($data);
	}
}