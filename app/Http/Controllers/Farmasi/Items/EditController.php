<?php

namespace App\Http\Controllers\Farmasi\Items;

use App\Models\Farmasi\LogPenghapusan;
use App\Models\Farmasi\StokOpname;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\Distribusi;
use App\Models\Farmasi\Pengadaan;
use App\Models\Farmasi\LogDistribusi;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\Kategori;
use App\Models\Farmasi\ItemsKategori;
use App\Models\Farmasi\ItemTemplateHarga;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DB;
use Bugsnag;
use File;
use Image;

class EditController extends Controller
{
	public function edit(Request $request)
	{
		$id = $request->input('id');
		$farmasi_slug = $request->input('farmasi');
		$consis = $request->input('consis');
		$stok = $request->input('batasan_stok');
		$kadaluarsa = $request->input('batasan_kadaluarsa');
		$distribusi = $request->input('batasan_distribusi');
		$waktu = $request->input('satuan_waktu');
		$harga = $request->input('harga');
		$harga_default = $request->input('harga_default');
		$kategori = $request->input('kategori');
		$desc = $request->input('keterangan');
		$satuan = $request->input('satuan');
		$jenis = $request->input('jenis');
        $name = $request->input('nama');


		DB::connection('farmasi')->beginTransaction();
		
		try {
			$farmasi = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi_slug);
			
			$item = ItemsFarmasi::find($id);
			$is_consis = (is_null($consis) ? $consis : 1);
			if($item->consis != $is_consis)
				if($is_consis)
    				app('App\Http\Controllers\Farmasi\Consis\PostController')->updateObat($item->item_template_id);
    			else
    				app('App\Http\Controllers\Farmasi\Consis\DeleteController')->deleteObat($item->item_template_id);
    			
    		if(isset($harga)){
	    		$itemHarga = app('App\Http\Controllers\Farmasi\ItemTemplateHarga\EditController')->pilih($harga);

	    		if(isset($itemHarga)){
					$item->item_detail->harga = $itemHarga->harga;
					$item->item_detail->save();
	    		}
	    	}else{
	    		if(isset($harga_default)){
					$item->item_detail->harga = $harga_default;
					$item->item_detail->save();
				}
	    	}

			$item->min_stok = $stok;
			$item->min_kadaluarsa = $kadaluarsa*$waktu;
			$item->max_distribusi = $distribusi;
			$item->consis = $is_consis;

			if($farmasi->jenis_detail->nama == 'Gudang'){
				foreach ($item->item_detail->kategori_item as $gor) {
					$gor->delete();
				}

				if($kategori)
				{
					foreach ($kategori as $arr) {
						if(!is_numeric($arr)) $arr = app('App\Http\Controllers\Farmasi\Kategori\CreateController')->createByName($arr)->id;
						$gori = new ItemsKategori;
						$gori->kategori_id = $arr;
						$gori->item_template_id = $item->item_detail->id;				
						$gori->save();
					}
				}
			}
			$item->save();

			if($farmasi->jenis_detail->nama == 'Gudang'){
				$items = ItemsFarmasi::where('item_template_id', $item->item_template_id)->get();
				foreach ($items as $value) {
					$value->max_distribusi = $distribusi;
					$value->save();
				}
				$items_template = ItemsTemplate::where('id',$item->item_template_id)->first();
				$items_template->nama = $name;
				$items_template->satuan = $satuan;
				$items_template->save();
			}

			DB::connection('farmasi')->commit();
			
			return redirect('farmasi/'.$farmasi_slug.'/item/'.$item->slug)
			->with('status', 1)
			->with('message', 'Barang berhasil diubah')
			->with('title', 'Sukses');
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('farmasi')->rollBack();

			return redirect()->back()
			->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
			->with('status', -1)
			->with('title', 'Gagal');
		}
	}

	public function editItem($item_id, $item, $qty = 0, $pengadaan_id = 0, $harga = 0, $diskon = 0, $ppn = 10, $subtotal = 0, $expired = null, $tanggal)
	{
		$pengadaan = Pengadaan::find($pengadaan_id);
		$new_log = Items::find($item_id);

		if(!is_null($expired))
		{
			$date = Carbon::createFromFormat('d/m/Y', $expired)->toDateTimeString();
		}
		else $date = null;

		$new_log->item_farmasi_id = $item;
		$new_log->jumlah_total = $qty;
		$new_log->jumlah_sedia = $qty;
		$new_log->kadaluarsa = $date;
		$new_log->tanggal = $tanggal;
		$new_log->status = 1;
		$new_log->pengadaan_id = $pengadaan->id;
		$new_log->farmasi_id = $pengadaan->farmasi_id;
		$new_log->supplier_id = $pengadaan->supplier_id;

		$farm = ItemsFarmasi::find($item);
		$farm->save();
		$items = ItemsTemplate::find($farm->item_template_id);

		$new_log->harga_saat_itu = $harga;
		$new_log->diskon = $diskon;
		$new_log->ppn = $ppn;
		$new_log->subtotal = $harga * $qty;
		$new_log->save();

		return $new_log->subtotal;
	}

	public function verifyLog($item)
	{
		$new_log = Items::find($item);
		$new_log->status = 1;
		$new_log->save();
		//$item_global = ItemsFarmasi::find($item);
		
		return $new_log;
	}

	public function verifyItem($ref, $item, $qty, $expired)
	{
		if(!is_null($expired))
		{
			$date = Carbon::createFromFormat('d/m/Y', $expired)->toDateTimeString();
		}
		else $date = null;

		$new_log = Items::find($ref);
		$new_log->item_farmasi_id = $item;
		$new_log->jumlah_total = $qty;
		$new_log->jumlah_sedia = $qty;
		$new_log->kadaluarsa = $date;
		$new_log->status = 1;
		$new_log->subtotal = $qty * $new_log->detail_item->item_detail->harga;
		$new_log->save();

		$farm = ItemsFarmasi::find($item);
		$farm->save();

		return $new_log->subtotal;
	}

	public function verifyBatch($distribusi_id)
	{
		$items = Items::where('distribusi_id', $distribusi_id)->get();

		$total = 0;
		foreach ($items as $item) {
			$item->jumlah_sedia = $item->jumlah_total;
			$item->status = 1;
			$item->subtotal = $item->jumlah_sedia * $item->detail_item->item_detail->harga;
			$item->save();

			$total+=$item->subtotal;

			$farm = ItemsFarmasi::find($item->item_farmasi_id);
			$farm->save();
		}

		return $total;
	}

	public function verifyRetur($draft)
	{
		//dd($draft);
		
		$log = Items::find($draft->item_id);
		$log->jumlah_sedia += $draft->jumlah;
		$log->status = 1;
		$log->save();

		$draft->jenis = 1;
		$draft->subtotal = $draft->jumlah * $log->detail_item->item_detail->harga;
		$draft->save();
		
		$farm = ItemsFarmasi::find($log->item_farmasi_id);
		$farm->save();
		
		return $draft->subtotal;
	}
	
	public function verifyKeluar($items_id, $jumlah)
	{
		
		$log = Items::find($items_id);
		$log->jumlah -= $jumlah;
		$log->save();
		return $log;
	}

    public function verifyKeluarKiriman($items_id, $jumlah,$log_id)
    {
        $log_lama = LogDistribusi::find($log_id);

        $log = Items::find($items_id);
        $log->jumlah = $log->jumlah + $log_lama->jumlah - $jumlah;
        $log->save();
        return $log;
    }
	/*public function verifyRetur($ref, $item, $qty, $expired)
	{
		if(!is_null($expired))
		{
			$date = Carbon::createFromFormat('d/m/Y', $expired);
		}
		else $date = null;
		$draft = LogDistribusi::find($ref);
		$exp = Carbon::parse($draft->detail_item->kadaluarsa);
		if($date->isSameDay($exp) && $item == $draft->detail_item->item_farmasi_id)
		{
			$log = Items::find($draft->item_id);
			$log->jumlah_sedia += $qty;
			$log->status = 1;
			$log->save();

			$draft->jenis = 1;
			$draft->jumlah = $qty;
			$draft->subtotal = $draft->jumlah * $log->detail_item->item_detail->harga;
			$draft->save();
		}
		else {
			$log = app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($item,$qty,$draft->distribusi_id,$expired);
			$log->jumlah_sedia = $qty;
			$log->kadaluarsa = $date->toDateTimeString();
			$log->status = 1;
			$log->save();

			$new_log = new LogDistribusi;
			$new_log->distribusi_id = $draft->distribusi_id;
			$new_log->jumlah = $qty;
			$new_log->item_id = $log->id;
			$new_log->jenis = 1;
			$new_log->subtotal = $new_log->jumlah * $log->detail_item->item_detail->harga;
			$new_log->save();
		}

		$farm = ItemsFarmasi::find($item);
		$farm->aktif = 1;
		$farm->save();
			
		return $log;
	}*/

	public function editHarga($item_template_id, $harga)
	{
		ItemsFarmasi::where('item_template_id', $item_template_id)->update(['harga' => $harga]);
	}

	public function recalculate($farmasi_slug,Request $request)
    {
        $item_farmasi_id = $request->input('item_farmasi_id');

        DB::connection('farmasi')->beginTransaction();

        try {
            $item = $this->recalculateStok($item_farmasi_id);
            DB::connection('farmasi')->commit();

            return redirect('farmasi/'.$farmasi_slug.'/item/'.$item->slug)
                ->with('status', 1)
                ->with('message', 'Stok Barang berhasil dihitung ulang')
                ->with('title', 'Sukses');
        }
        catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('farmasi')->rollBack();

            return redirect()->back()
                ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                ->with('status', -1)
                ->with('title', 'Gagal');
        }

    }

	public function recalculateStok($item_farmasi_id)
    {
        $item_farmasi = ItemsFarmasi::where('id',$item_farmasi_id)->with('all_items')->first();
        $max_date = Carbon::now()->endOfDay()->toDateTimeString();
        foreach ($item_farmasi->all_items as $item) {
            if($item->tanggal_awal) {
                $min_date = Carbon::parse($item->tanggal_awal)->toDateTimeString();
                $last_so_besar = StokOpname::where('id',$item->last_so_id)->with('distribusi','penghapusan')->first();
                if($last_so_besar){
                    $penghapusan_id = $last_so_besar->penghapusan->id ?? -1;
                    $exclude_so_penghapusan="
                        AND d.id != " . $penghapusan_id . "
                    ";
                    $exclude_so_distribusi="
                        AND d.id != " . $last_so_besar->distribusi->id . "
                    ";
                }else{
                    $exclude_so_penghapusan = '';
                    $exclude_so_distribusi = '';
                }
                $log = "SELECT * FROM (
                            SELECT  
                            table_transaksi.id, 
                    table_transaksi.created_at, 
                    IF(table_transaksi.pasien_id IS NULL, '0', p.no_rm) nomor_rm, 
                    IF(table_transaksi.pasien_id IS NULL, 'Pasien Bebas', p.name) nama, 
                    table_transaksi.jumlah_min,
                    table_transaksi.jumlah_plus, 
                    table_transaksi.nomor_resep  
                            FROM (
                                SELECT  it.id, ld.created_at, (ld.jumlah) AS jumlah_min, IFNULL((ld.jumlah_retur), 0) AS jumlah_plus, r.nomor_resep nomor_resep, d.pasien_id
                                FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                                WHERE  i.id = ld.item_id
                                AND i.id = " . $item->id . "
                                AND ld.`resep_detail_id` = rd.`id`
                                AND rd.`resep_id` = r.`id`
                                AND r.`id` = d.`resep_final`
                                AND i.item_farmasi_id = it.id
                                AND ld.created_at > '" . $min_date . "'
                                AND ld.created_at < '" . $max_date . "'
                                AND r.`deleted_at` IS  NULL
                                AND d.deleted_at IS  NULL
                                AND ld.`deleted_at` IS  NULL
                                
                                UNION ALL
                                
                                SELECT  it.id, ld.created_at, (ld.jumlah) AS jumlah_min, IFNULL((ld.jumlah_retur), 0) AS jumlah_plus, r.nomor_resep nomor_resep, d.pasien_id
                                FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                                WHERE  i.id = ld.item_id
                                AND i.id = " . $item->id . "
                                AND ld.`resep_detail_id` = rd.`id`
                                AND rd.`resep_id` = r.`id`
                                AND r.`transaksi_id` = d.id
                                AND r.retur = 1
                                AND i.item_farmasi_id = it.id
                                AND ld.created_at > '" . $min_date . "'
                                AND ld.created_at < '" . $max_date . "'
                                AND r.`deleted_at` IS  NULL
                                AND d.deleted_at IS  NULL
                                AND ld.`deleted_at` IS  NULL
                            ) table_transaksi
                            LEFT JOIN " . config('app.db_name') . "_patients.pasien p
                            ON table_transaksi.pasien_id = p.id
        
                            UNION ALL
                            
                            SELECT  it.id, d.created_at, 0 as nomor_rm, 'Penghapusan Obat' nama, (ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, '-' nomor_resep
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND i.id = " . $item->id . "
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at > '" . $min_date . "'
                            AND d.created_at < '" . $max_date . "'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            $exclude_so_penghapusan
                            
                            UNION ALL
                            
                            SELECT  it.id, d.tanggal, 0 AS nomor_rm, 'Pengadaan Obat' nama, 0 AS jumlah_min, (ld.jumlah) AS jumlah_plus, '-' nomor_resep
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND i.id = " . $item->id . "
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal > '" . $min_date . "'
                            AND d.tanggal < '" . $max_date . "'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL 
                            
                            UNION ALL
                            
                            SELECT  it.id, ld.created_at, 0 as nomor_rm, IF(d.unit_tujuan, f.nama, 'GUDANG') nama, (ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, '-' nomor_resep
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it, farmasi f
                            WHERE d.id = ld.distribusi_id
                            AND i.id = " . $item->id . "
                            AND f.id = d.unit_tujuan
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '" . $min_date . "'
                            AND ld.created_at < '" . $max_date . "'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND d.kategori != 'Permintaan' 
                            UNION ALL
                            
                            SELECT  it.id, ld.created_at, 0 as nomor_rm, IF(d.unit_tujuan, f.nama, 'GUDANG') nama, (ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, '-' nomor_resep
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it, farmasi f
                            WHERE d.id = ld.distribusi_id
                            AND i.id = " . $item->id . "
                            AND f.id = d.unit_tujuan
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '" . $min_date . "'
                            AND ld.created_at < '" . $max_date . "'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND d.kategori = 'Permintaan'
                            AND d.status = 2 
                            UNION ALL
                            
                            SELECT  it.id, ld.created_at, 0 AS nomor_rm, IF(d.unit_tujuan, IF(d.unit_tujuan = d.farmasi_id, 'Stok Opname', f.nama), 'GUDANG') nama, 0 AS jumlah_min, (ld.jumlah) AS jumlah_plus, '-' nomor_resep
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it, farmasi f
                            WHERE d.id = ld.distribusi_id
                            AND i.id = " . $item->id . "
                            AND f.id = d.unit_tujuan
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '" . $min_date . "'
                            AND ld.created_at < '" . $max_date . "'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            $exclude_so_distribusi
                        ) AS hasil ORDER BY created_at ASC";
                $log = \Illuminate\Support\Facades\DB::connection('farmasi')->select(DB::raw($log));
                $jumlah_plus = collect($log)->sum(function ($item) {
                    return $item->jumlah_plus;
                });
                $jumlah_min = collect($log)->sum(function ($item) {
                    return $item->jumlah_min;
                });
                $item->jumlah = $item->jumlah_awal + $jumlah_plus - $jumlah_min;
                $item->jumlah_recalculate = $item->jumlah_awal + $jumlah_plus - $jumlah_min;
                $item->last_recalculate_at = Carbon::now();
                $item->save();
            }
        }
        return $item_farmasi;
    }
}