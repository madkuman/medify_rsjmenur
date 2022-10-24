<?php

namespace App\Http\Controllers\Keuangan\Pemasukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\PemasukanDetail;
use DB;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        try {
            DB::connection('keuangan')->beginTransaction();
            $id = $request->id;
            $pemasukan = Pemasukan::find($id);

            $details = PemasukanDetail::where('pemasukan_id',$pemasukan->id)->get();
            $kategoriUntungRugi = app('App\Http\Controllers\Keuangan\Kategori\ReadController')->getUntungRugiKategori();
            $kategoriUntung = app('App\Http\Controllers\Keuangan\Kategori\ReadController')->getUntungKategori();
            $kategoriRugi = app('App\Http\Controllers\Keuangan\Kategori\ReadController')->getRugiKategori();

            $isDeleteKategoriUntungRugi = 0;
            $total_pengurang = $pemasukan->total;
            foreach($details as $item)
            {
                $temp = PemasukanDetail::find($item->id);
                if(in_array($temp->kategori_id, $kategoriUntungRugi)){
                    $isDeleteKategoriUntungRugi = 1;
                    if(in_array($temp->kategori_id, $kategoriRugi))
                    {
                        //$total_pengurang += abs($temp->subtotal);
                    }
                    else
                    {
                        $total_pengurang -= abs($temp->subtotal);
                    }
                }
                $temp->delete();
            }
            if($pemasukan->piutang_id != null){
                if($isDeleteKategoriUntungRugi) {
                    $kategoriUntungRugi = app('App\Http\Controllers\Keuangan\Piutang\EditController')
                    ->deleteDetailByKategori($pemasukan->piutang_id,$kategoriUntungRugi);
                }

                app('App\Http\Controllers\Keuangan\Piutang\EditController')->kurangiTotalPaid($pemasukan->piutang_id,$total_pengurang);
                
            }

            if($pemasukan->total_deposit > 0) app('App\Http\Controllers\Keuangan\Deposit\CreateController')->cashBackDeposit($pemasukan->pasien_id,$pemasukan->total_deposit,$pemasukan->id);

            $pemasukan->delete();
            //UPDATE PAKET PEMASUKANNYA
            if(is_null($pemasukan->paket))
                $data['url'] = 'keuangan/pemasukan/';                    
            else if(count($pemasukan->paket->detail) == 0)
                $data['url'] = 'keuangan/paket-pemasukan/';
            else
                $data['url'] = 'keuangan/paket-pemasukan/'.$pemasukan->paket->slug;
            if($pemasukan->paket)
                app('App\Http\Controllers\Keuangan\PaketPemasukan\EditController')->updateFromChild($pemasukan->paket);
            DB::connection('keuangan')->commit();


            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Pemasukan berhasil dihapus.';
            return json_encode($data);
        } catch (\Exception $e) {
            DB::connection('keuangan')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Transaksi Pemasukan Gagal Dihapus : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            return json_encode($data);
        }

    }

    public function deletePemasukanByTagihanID($id)
    {
        $pemasukan_detail = PemasukanDetail::where('tagihan_id',$id)->first();
        if(!empty($pemasukan_detail->pemasukan_id))
        {
            $pemasukan = Pemasukan::find($pemasukan_detail->pemasukan_id);
            $pemasukan->delete();
            $pemasukan_details = PemasukanDetail::where('tagihan_id',$id)->delete();
        }
    }
}

