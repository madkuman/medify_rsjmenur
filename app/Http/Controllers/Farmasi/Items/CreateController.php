<?php

namespace App\Http\Controllers\Farmasi\Items;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\Distribusi;
use App\Models\Farmasi\Pengadaan;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\ItemsKategori;
use App\Models\Farmasi\TipeObat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Auth;
use DB;
use Bugsnag;
use File;
use Image;
use Artisan;

class CreateController extends Controller
{
   	public function create(Request $request, $slug)
	{	
		DB::connection('farmasi')->beginTransaction();

		try {
			$farmasi = Farmasi::where('slug', $slug)->first();
			$item = $this->createAPI($request, $farmasi);

			DB::connection('farmasi')->commit();
			

			return redirect('farmasi/'.$slug.'/item/'.$item->slug.'-'.$farmasi->id)
				->with('status', 1)
				->with('message', 'Barang berhasil dibuat')
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


	public function createAPI(Request $request, $farmasi)
	{
		if ($request->hasFile('input_image')) {
			$file_ext = $request->input_image->extension();
			if($file_ext != 'jpeg' && $file_ext != 'png') return $response->setStatusCode(400, 'File type Invalid'); 
			$images = $this->uploadImage($request);
		}


		$name = $request->input('nama');
		$desc = $request->input('keterangan');
		$satuan = $request->input('satuan');
		$harga = $request->input('harga');
		$jenis = $request->input('jenis');
		$stok = $request->input('batasan_stok');
		$kadaluarsa = $request->input('batasan_kadaluarsa');
		$distribusi = $request->input('batasan_distribusi');
		$waktu = $request->input('satuan_waktu') ?? 1;
		$kategori = $request->input('kategori');
		
		$item = new ItemsTemplate;
		$item->nama = $name;
		$item->deskripsi = $desc;
		$item->satuan = $satuan;
		$item->harga = $harga;
		$item->jenis = $jenis;
		$item->min_stok = $stok;
		$item->min_kadaluarsa = $kadaluarsa*$waktu;
		$item->created_by = Auth::user()->id;


		$slug = preg_replace('~[^\pL\d]+~u', '-', $name);
		$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
		$slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
		$slug = str_replace('%', '', $slug);
		$slug = trim($slug, '-'); // trim
		$slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
		$slug = strtolower($slug); // lowercase
		$metal_slug = $slug;

		$i = 1;
		while(!is_null(ItemsTemplate::where("slug",$slug)->first())){
			$i++;
			$slug = $metal_slug."_".$i;
		}
		
		$item->slug = $slug;
		$item->save();

		$temp = TipeObat::where('nama',$satuan)->first();
		if(!$temp)
		{
			$tuan = new TipeObat;
			$tuan->nama = $satuan;
			$tuan->save();
		}

		if($kategori)
		{
			foreach ($kategori as $arr) {
				if(!is_numeric($arr)) $arr = app('App\Http\Controllers\Farmasi\Kategori\CreateController')->createByName($arr,0)->id;
				$gori = new ItemsKategori;
				$gori->kategori_id = $arr;
				$gori->item_template_id = $item->id;				
				$gori->save();
			}
		}

		app('App\Http\Controllers\Farmasi\Items\CreateController')->createItemEach($item->id, $distribusi);
		return $item;
	}

	public function createItemEach($item_id, $distribusi)
	{	
		//dd($request);
		$pharmacy = Farmasi::get();
		$item = ItemsTemplate::find($item_id);

		foreach ($pharmacy as $pharm) {
			$data = array(
		        'item_template_id' => $item->id,
		        'farmasi_id' => $pharm->id,
		        'harga' => $item->harga,
		        'min_kadaluarsa' => $item->min_kadaluarsa,
		        'min_stok' => $item->min_stok,
		        'max_distribusi' => $distribusi,
		        'slug' => $item->slug."-".$pharm->id
	        );

	        $insertData[] = $data;
		}
		if(!empty($insertData))
		{
			ItemsFarmasi::insert($insertData);
		}
	}

	public function createItemFarmasiAll($item, $farmasies)
	{	
		foreach ($farmasies as $pharm) {
			$data = array(
		        'item_template_id' => $item->id,
		        'farmasi_id' => $pharm->id,
		        'harga' => $item->harga,
		        'min_kadaluarsa' => $item->min_kadaluarsa,
		        'min_stok' => $item->min_stok,
		        'slug' => $item->slug."-".$pharm->id
	        );

	        $insertData[] = $data;
		}
		if(!empty($insertData))
		{
			ItemsFarmasi::insert($insertData);
		}
	}
	
	public function createStarter($pharmacy_id)
	{	
		Artisan::call('farmasi:create-starter',['farmasi_id' => $pharmacy_id]);
	}

	public function newPengadaanItem($item, $qty = 0, $pengadaan_id = 0, $harga = 0, $diskon = 0, $ppn = 10, $subtotal = 0, $expired = null, $tanggal)
	{
		$pengadaan = Pengadaan::find($pengadaan_id);

		if(!is_null($expired))
		{
			$date = Carbon::createFromFormat('d/m/Y', $expired)->toDateTimeString();
		}
		else $date = null;
		$new_log = new Items;
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

	public function newItem($item, $qty = 0, $expired = null, $farmasi_id,$distribusi_id=0, $log_pengadaan_id = null)
	{
		if(!is_null($expired))
		{
			$date = Carbon::createFromFormat('d/m/Y', $expired)->toDateTimeString();
		}
		else $date = null;
		$tempMinus = app('App\Http\Controllers\Farmasi\Items\ReadController')->getMinusItemList($item);
		
		foreach ($tempMinus as $minus) {
			if($qty > -$minus->jumlah){
				$qty += $minus->jumlah;
				$minus->jumlah = 0;
			}else{
				$minus->jumlah += $qty;
				$qty = 0;
			}
			$minus->save();
		}
		$temp = Items::where('item_farmasi_id', $item)->whereDate('kadaluarsa',date('Y-m-d', strtotime($date)))->first();
		if($temp)
		{
			$temp->jumlah += $qty;
			$temp->save();

			return $temp;
		}
		else
		{
			$new_log = new Items;
			$new_log->item_farmasi_id = $item;
			$new_log->farmasi_id = $farmasi_id;
			$new_log->jumlah = $qty;
			$new_log->kadaluarsa = $date;
			$new_log->distribusi_id = $distribusi_id;
			$new_log->log_pengadaan_id = $log_pengadaan_id;
			$new_log->status = 1;
			$new_log->jumlah_awal = 0;
			$new_log->tanggal_awal = Carbon::now()->subDay()->startOfDay();
			$new_log->save();
			
			$new_log->harga_saat_itu = $new_log->log_pengadaan->harga_saat_itu ?? NULL;
			$new_log->save();

			$item = ItemsFarmasi::find($item);
			if($item){
				$item->save();
			}

			return $new_log;
		}
	}

	public function check()
	{	
		$items = ItemsTemplate::orderBy('created_at','desc')->get();
		$farmasi = Farmasi::where('id','>=',46)->get();

		foreach ($items as $item) {
			if(!is_null($item->slug)) {
				$nama = $item->slug;
			}
			else {
				$slug = preg_replace('~[^\pL\d]+~u', '-', $item->nama);
				$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
				$slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
				$slug = trim($slug, '-'); // trim
				$slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
				$slug = strtolower($slug); // lowercase
				$nama = $slug;
			}
			foreach($farmasi as $farm)
			{
				$temp = ItemsFarmasi::where('item_template_id', $item->id)->where('farmasi_id',$farm->id)->first();
				if($temp) continue;
				else 
				{
					$data = array(
				        'item_template_id' => $item->id,
				        'farmasi_id' => $farm->id,
				        'harga' => $item->harga,
				        'min_kadaluarsa' => $item->min_kadaluarsa,
				        'min_stok' => $item->min_stok,
				        'slug' => $nama."-".$farm->id
			       	);

			        $insertData[] = $data;
				}
			}	
		}
		ItemsFarmasi::insert($insertData);
		
	}
}
