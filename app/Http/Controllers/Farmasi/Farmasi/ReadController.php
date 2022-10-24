<?php

namespace App\Http\Controllers\Farmasi\Farmasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;
use App\Models\Pasien\PembayaranPerusahaan;
use Illuminate\Http\Response;

use App\Models\Farmasi\LogTransaksi;
use App\Models\Farmasi\LogDistribusi;
use App\Models\Farmasi\ResepDetail;
use App\Models\Farmasi\LogPenghapusan;
use App\Models\Farmasi\LogPengadaan;
use App\Models\Farmasi\LaporanTransaksi;

class ReadController extends Controller
{
    public function getAllWithHidden()
    {
        $pharmacy = Farmasi::orderBy('jenis','asc')->get();
        return $pharmacy;
    }

    public function getAll()
    {
	    $pharmacy = Farmasi::where('jenis', '!=', 3)->orderBy('jenis','asc')->get();
    	return $pharmacy;
    }

    public function getPerusahaan()
    {
        $perusahaan = PembayaranPerusahaan::get();
        return $perusahaan;
    }

    public function getSingle($farmasi)
    {
	    $pharmacy = Farmasi::where('slug',$farmasi)->first();
    	return $pharmacy;
    }

    public function getAutoSelect($kasus)
    {
        try
        {
            $farmasi= Farmasi::where('slug','LIKE','%instalasi-farmasi%')->first();
            return $farmasi->id ?? 0;

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return 0;
        }
    }
public function fillTabelLaporanDistribusi()
    {
        app('debugbar')->disable();
        ini_set('max_execution_time', 1000);
        $last_distribusi_id = LaporanTransaksi::where('jenis_type', 'LogDistribusi')->orderBy('jenis_id', 'desc')->first();
        if(is_null($last_distribusi_id))
            $last_distribusi_id = 0;
        else
            $last_distribusi_id = $last_distribusi_id->jenis_id;
        $distribusi     = LogDistribusi::with(['detail_item.detail_item.item_detail.kategori_item', 'detail_distribusi'])->where('id', '>', $last_distribusi_id)->where('jenis', 1)->get();
       
        $data = [];
        
        foreach ($distribusi as $key => $distri) {
            $item = [];
            $item['jenis_type'] = 'LogDistribusi';
            $item['jenis_id'] = $distri->id;
            $item['template_id'] = $distri->detail_item->detail_item->item_detail->id ?? null;
            $item['template_nama'] = $distri->detail_item->detail_item->item_detail->nama ?? '-';
            $item['template_kode'] = $distri->detail_item->detail_item->item_detail->kode ?? '-';
            $item['template_harga'] = $distri->detail_item->detail_item->item_detail->harga ?? '-';
            $item['template_satuan'] = $distri->detail_item->detail_item->item_detail->satuan ?? '-';
            $item['farmasi_id'] = $distri->detail_item->detail_item->farmasi_id ?? 0;
            
            $kategori = $distri->detail_item->detail_item->item_detail->kategori_item;
            if(isset($kategori)){
                $kategori_id = "-".implode("-", $kategori->pluck('kategori_id')->toArray())."-";
                $kategori_nama = "-".implode("-", $kategori->pluck('detail_kategori.nama')->toArray())."-";
            }else{
                $kategori_id = '-';
                $kategori_nama = '-';
            }
            $item['template_kategori_id'] = isset($kategori) ?  $kategori_id: null;
            $item['template_kategori'] = isset($kategori) ? $kategori_nama : '-';

            $item['item_farmasi_id'] = $distri->detail_item->item_farmasi_id ?? null;
            $item['item_farmasi_aktif'] = $distri->detail_item->detail_item->aktif ?? null;
            $item['farmasi_items_id'] = $distri->item_id ?? null;
            $item['farmasi_items_kadaluarsa'] = $distri->detail_item->kadaluarsa ?? null;
            $item['jumlah_masuk'] = ($distri->detail_distribusi->tipe == 1) ? $distri->jumlah : 0;
            $item['jumlah_keluar'] = ($distri->detail_distribusi->tipe == -1) ? $distri->jumlah : 0;
            $item['subtotal'] = $distri->subtotal;
            $item['src_created_at'] = $distri->created_at;
            array_push($data, $item);
        }

        $datas = array_chunk($data, 2000);
        foreach ($datas as $chunk) {
            LaporanTransaksi::insert($chunk); 
        }
        return('success');
    }
    public function fillTabelLaporanPengadaan()
    {
        app('debugbar')->disable();
        ini_set('max_execution_time', 1000);
        $last_pengadaan_id = LaporanTransaksi::where('jenis_type', 'LogPengadaan')->orderBy('jenis_id', 'desc')->first();
        if(is_null($last_pengadaan_id))
            $last_pengadaan_id = 0;
        else
            $last_pengadaan_id = $last_pengadaan_id->jenis_id;

        $pengadaan      = LogPengadaan::with(['detail_item.detail_item.item_detail.kategori_item'])->withTrashed()->where('id', '>', $last_pengadaan_id)->get();

        $data = [];
        

        foreach ($pengadaan as $key => $ada) {
            $item = [];
            $item['jenis_type'] = 'LogPengadaan';
            $item['jenis_id'] = $ada->id;
            $item['template_id'] = $ada->detail_item->detail_item->item_detail->id ?? null;
            $item['template_nama'] = $ada->detail_item->detail_item->item_detail->nama ?? '-';
            $item['template_kode'] = $ada->detail_item->detail_item->item_detail->kode ?? '-';
            $item['template_harga'] = $ada->detail_item->detail_item->item_detail->harga ?? '-';
            $item['template_satuan'] = $ada->detail_item->detail_item->item_detail->satuan ?? '-';
            $item['farmasi_id'] = $ada->detail_item->detail_item->farmasi_id ?? 0;

            $kategori = $ada->detail_item->detail_item->item_detail->kategori_item ?? null;
            if(isset($kategori)){
                $kategori_id = "-".implode("-", $kategori->pluck('kategori_id')->toArray())."-";
                $kategori_nama = "-".implode("-", $kategori->pluck('detail_kategori.nama')->toArray())."-";
            }else{
                $kategori_id = '-';
                $kategori_nama = '-';
            }
            $item['template_kategori_id'] = isset($kategori) ?  $kategori_id: null;
            $item['template_kategori'] = isset($kategori) ? $kategori_nama : '-';

            $item['item_farmasi_id'] = $ada->detail_item->item_farmasi_id ?? null;
            $item['item_farmasi_aktif'] = $ada->detail_item->detail_item->aktif ?? null;
            $item['farmasi_items_id'] = $ada->item_id ?? null;
            $item['farmasi_items_kadaluarsa'] = $ada->detail_item->kadaluarsa ?? null;
            $item['jumlah_masuk'] = $ada->jumlah ?? 0;
            $item['jumlah_keluar'] = 0;
            $item['subtotal'] = $ada->subtotal;
            $item['src_created_at'] = $ada->created_at;
            array_push($data, $item);
        }


        $datas = array_chunk($data, 2000);
        foreach ($datas as $chunk) {
            LaporanTransaksi::insert($chunk); 
        }
        return('success');
    }
    public function fillTabelLaporanPenghapusan()
    {
        app('debugbar')->disable();
        ini_set('max_execution_time', 1000);
        $last_penghapusan_id = LaporanTransaksi::where('jenis_type', 'LogPenghapusan')->orderBy('jenis_id', 'desc')->first();
        if(is_null($last_penghapusan_id))
            $last_penghapusan_id = 0;
        else
            $last_penghapusan_id = $last_penghapusan_id->jenis_id;
        $penghapusan    = LogPenghapusan::with(['detail_item.detail_item.item_detail.kategori_item'])->withTrashed()->where('id', '>', $last_penghapusan_id)->get();

        $data = [];

        foreach ($penghapusan as $key => $hapus) {
            $item = [];
            $item['jenis_type'] = 'LogPenghapusan';
            $item['jenis_id'] = $hapus->id;
            $item['template_id'] = $hapus->detail_item->detail_item->item_detail->id ?? null;
            $item['template_nama'] = $hapus->detail_item->detail_item->item_detail->nama ?? '-';
            $item['template_kode'] = $hapus->detail_item->detail_item->item_detail->kode ?? '-';
            $item['template_harga'] = $hapus->detail_item->detail_item->item_detail->harga ?? '-';
            $item['template_satuan'] = $hapus->detail_item->detail_item->item_detail->satuan ?? '-';
            $item['farmasi_id'] = $hapus->detail_item->detail_item->farmasi_id ?? 0;
            
            $kategori = $hapus->detail_item->detail_item->item_detail->kategori_item;
            if(isset($kategori)){
                $kategori_id = "-".implode("-", $kategori->pluck('kategori_id')->toArray())."-";
                $kategori_nama = "-".implode("-", $kategori->pluck('detail_kategori.nama')->toArray())."-";
            }else{
                $kategori_id = '-';
                $kategori_nama = '-';
            }
            $item['template_kategori_id'] = isset($kategori) ?  $kategori_id: null;
            $item['template_kategori'] = isset($kategori) ? $kategori_nama : '-';
            
            $item['item_farmasi_id'] = $hapus->detail_item->item_farmasi_id ?? null;
            $item['item_farmasi_aktif'] = $hapus->detail_item->detail_item->aktif ?? null;
            $item['farmasi_items_id'] = $hapus->item_id ?? null;
            $item['farmasi_items_kadaluarsa'] = $hapus->detail_item->kadaluarsa ?? null;
            $item['jumlah_masuk'] = 0;
            $item['jumlah_keluar'] = $hapus->jumlah ?? 0;
            $item['subtotal'] = $hapus->jumlah * ($hapus->detail_item->detail_item->item_detail->harga ?? 0);
            $item['src_created_at'] = $hapus->created_at;
            array_push($data, $item);
        }

        

        $datas = array_chunk($data, 2000);
        foreach ($datas as $chunk) {
            LaporanTransaksi::insert($chunk); 
        }
        return('success');
    }

    public function fillTabelLaporanTransaksi()
    {
        app('debugbar')->disable();
        ini_set('max_execution_time', 1000);
        $last_transaksi_id = LaporanTransaksi::where('jenis_type', 'LogTransaksi')->orderBy('jenis_id', 'desc')->first();
        
        if(is_null($last_transaksi_id))
            $last_transaksi_id = 0;
        else
            $last_transaksi_id = $last_transaksi_id->jenis_id;
        
        
        $transaksi      = LogTransaksi::with(['detail_item.detail_item.item_detail.kategori_item'])->where('id', '>', $last_transaksi_id)->get();
        $transaksi_ids = $transaksi;


        $chunks = array_chunk($transaksi_ids->pluck('resep_detail_id')->toArray(), 5000);
        $resep_details = [];
        $shift_id = [];
        $kasus_id = [];
        foreach ($chunks as $chunk) {
            $resep_detail = ResepDetail::with(['resep_detail.transaksi_detail'])->whereIn('id',$chunk)->withTrashed()->get();
            $shift_id = array_merge($shift_id, $resep_detail->pluck('resep_detail.transaksi_detail.shift_id', 'id')->toArray());
            $kasus_id = array_merge($kasus_id, $resep_detail->pluck('resep_detail.transaksi_detail.kasus_id', 'id')->toArray());
            $resep_details = array_merge($resep_details, $resep_detail->pluck('subtotal', 'id')->toArray());    
        }
        
        
        $data = [];
        foreach ($transaksi as $key => $trans) {
            $item = [];
            $item['jenis_type'] = 'LogTransaksi';
            $item['jenis_id'] = $trans->id;
            $item['template_id'] = $trans->detail_item->detail_item->item_detail->id ?? null;
            $item['template_nama'] = $trans->detail_item->detail_item->item_detail->nama ?? '-';
            $item['template_kode'] = $trans->detail_item->detail_item->item_detail->kode ?? '-';
            $item['template_harga'] = $trans->detail_item->detail_item->item_detail->harga ?? '-';
            $item['template_satuan'] = $trans->detail_item->detail_item->item_detail->satuan ?? '-';
            $item['farmasi_id'] = $trans->detail_item->detail_item->farmasi_id ?? 0;
            $item['shift_id'] = $trans->detail_item->detail_item->farmasi_id ?? 0;
            $item['kasus_id'] = $trans->detail_item->detail_item->farmasi_id ?? 0;
            // dd($trans->detail_item->detail_item);
            
            $kategori = $trans->detail_item->detail_item->item_detail->kategori_item;
            if(isset($kategori)){
                $kategori_id = "-".implode("-", $kategori->pluck('kategori_id')->toArray())."-";
                $kategori_nama = "-".implode("-", $kategori->pluck('detail_kategori.nama')->toArray())."-";
            }else{
                $kategori_id = '-';
                $kategori_nama = '-';
            }
            $item['template_kategori_id'] = isset($kategori) ?  $kategori_id: null;
            $item['template_kategori'] = isset($kategori) ? $kategori_nama : '-';

            $item['item_farmasi_id'] = $trans->detail_item->item_farmasi_id ?? null;
            $item['item_farmasi_aktif'] = $trans->detail_item->detail_item->aktif ?? null;
            $item['farmasi_items_id'] = $trans->item_id ?? null;
            $item['farmasi_items_kadaluarsa'] = $trans->detail_item->kadaluarsa ?? null;
            $item['jumlah_masuk'] = $trans->jumlah_retur ?? 0;
            $item['jumlah_keluar'] = $trans->jumlah ?? 0;

            if(isset($shift_id[$trans->resep_detail_id]))
                $item['shift_id'] = $shift_id[$trans->resep_detail_id];
            if(isset($kasus_id[$trans->resep_detail_id]))
                $item['kasus_id'] = $kasus_id[$trans->resep_detail_id];
            if(isset($resep_details[$trans->resep_detail_id]))
                $item['subtotal'] = $resep_details[$trans->resep_detail_id] - ($trans->subtotal_retur ?? 0);
            else
                $item['subtotal'] = 0 - ($trans->subtotal_retur ?? 0);
            $item['src_created_at'] = $trans->created_at;
            array_push($data, $item);
        }

        $datas = array_chunk($data, 2000);
        foreach ($datas as $chunk) {
            LaporanTransaksi::insert($chunk); 
        }
        return('success');
    }

    public function getStatistik()
    {
        $day = Carbon::now();
        
        $kategori = Kategori::groupBy('slug')
                    ->get(array(
                            DB::raw('nama'),
                            DB::raw('COUNT(*) as "kategori_count"')
                        ));

        $stats = new stdClass();
        $stats->kategori = $kategori;

        $item = ItemsTemplate::with('stok')->whereDate('created_at', '>=', $day->copy()->startOfDay())->get();
        $stats->item = $item->count();

        return $stats;
    }
}
