<?php

namespace App\Http\Controllers\Gudang\Pengadaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Pengadaan;
use App\Models\Keuangan\PO;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DB;
use Bugsnag;
use Auth;
use Image;
use File;
use Storage;
use DateTime;

class CreateController extends Controller
{
  	public function create(Request $request)
	{	
		//dd($request);
		$penyedia = $request->input('peyedia');
		$description = $request->input('keterangan');
		//$category = $request->input('category');
		$tanggal = $request->input('tanggal_transaksi');
		$tgl_faktur = $request->input('tanggal_faktur');
		$tgl_surat_jalan = $request->input('tanggal_surat_jalan');
		$referral_number = $request->input('nomor_referensi');
		$nomor_surat = $request->input('nomor_surat');
		$items = $request->input('barang');
		$qty = $request->input('jumlah');
		$diskon = $request->input('diskon');
		$ppn = $request->input('ppn');
		$subzero = $request->input('subtotal');
		$harga = $request->input('harga_satuan');
		$expired = $request->input('expired');
		$image = $request->file('image');
		$batch = $request->batch;
		$po_id = $request->input('po');
		//$date = DateTime::createFromFormat('Y-m-d H:i:s', $tanggal);
		//dd($date);

		
		DB::connection('keuangan')->beginTransaction();

		try
		{
			$date = Carbon::createFromFormat('d/m/Y', $tanggal, 'Asia/Jakarta')->toDateTimeString(); 
			if($tgl_faktur) $date_faktur = Carbon::createFromFormat('d/m/Y', $tgl_faktur, 'Asia/Jakarta')->toDateTimeString();
			if($tgl_surat_jalan) $date_surat_jalan = Carbon::createFromFormat('d/m/Y', $tgl_surat_jalan, 'Asia/Jakarta')->toDateTimeString();
			
			$transaction = new Pengadaan;
			$transaction->supplier_id = $penyedia;
			$transaction->keterangan = $description;
			$transaction->tanggal = $date;
			if($tgl_faktur) $transaction->tanggal_faktur = $date_faktur;
			if($tgl_surat_jalan) $transaction->tanggal_surat_jalan = $date_surat_jalan;
			//$transaction->category = $category;
			$transaction->nomor_referensi = $referral_number;
			$transaction->nomor_surat_jalan = $nomor_surat;
			$transaction->created_by = Auth::user()->id;
			$transaction->save();
			
			$total = 0;
			$total_non_diskon = 0;
			$diskon_total = 0;
			$i = 0;
			$detail_utangs = [];
			if(isset($po_id) && $po_id != 0)
				$po = PO::with('detail')->find($po_id);

			foreach($items as $item)
			{
				if(is_numeric($item))
				{
					if(!is_null($qty[$i])) {
						$log = app('App\Http\Controllers\Gudang\Items\CreateController')->newItem($item,$qty[$i],$expired[$i]);
						$subtotal = app('App\Http\Controllers\Gudang\LogPengadaan\CreateController')->create($log,$qty[$i],$transaction->id,$harga[$i],$diskon[$i],$ppn[$i],$subzero[$i],$date,$batch[$i]);
						$subtotal_non_diskon =  $subtotal * 100 /(100-$diskon[$i]);

						$total += $subtotal;
						$total_non_diskon += $subtotal_non_diskon;
						$diskon_total += $subtotal_non_diskon - $subtotal;

						if(isset($po->detail[$i])){
							$detail_utang['id_detail'] = $po->detail[$i]->id;
							$detail_utang['layanan_string'] = $po->detail[$i]->deskripsi;
							$detail_utang['harga'] = $po->detail[$i]->harga;
							$detail_utang['diskon'] = $po->detail[$i]->diskon;
							$detail_utang['jumlah'] = $qty[$i];
							$detail_utang['subtotal'] = $subtotal;
							$detail_utang['keterangan'] = $po->detail[$i]->keterangan;
							array_push($detail_utangs, (object) $detail_utang);
						}else{
							$detail_utang['layanan_id'] = $item;
							$detail_utang['layanan_string'] = $log->detail_item->nama;
							$detail_utang['harga'] = $log->detail_item->harga;
							$detail_utang['diskon'] = $diskon[$i];
							$detail_utang['jumlah'] = $qty[$i];
							$detail_utang['subtotal'] = $subtotal;
							$detail_utang['keterangan'] = $log->detail_item->satuan;
							array_push($detail_utangs, (object) $detail_utang);
						}
					}
				}
				$i++;
			}

			$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);

			//Uploading Image
			if ($request->hasFile('image')) {
				$img = $this->uploadImage($request,$transaction->slug);
				$transaction->bukti_nota = $img['big'];
			}
			//dd($transaction);

			if(isset($po)){
				$utang = app('App\Http\Controllers\Keuangan\Utang\CreateController')->create(
					$po->judul,
					$total_non_diskon,
					$diskon_total,
					$total,
					$detail_utangs,
					$transaction->supplier_id,
					$transaction->tanggal,
					$transaction->tanggal_faktur,
					$po->tanggal_po,
					$transaction->nomor_referensi,
					$po->no_po,
					$po->id,
					$image
				);
				$transaction->utang_id = $utang->id;
			}else{
				$po = app('App\Http\Controllers\Keuangan\PO\CreateController')->create(
					$transaction->keterangan,
					$total_non_diskon,
					$diskon_total,
					$total,
					$detail_utangs,
					$transaction->supplier_id,
					$transaction->tanggal,
					'',
					null,
					null,
					'Farmasi',
					null,
					null
				);
				foreach ($detail_utangs as $i => $detail_utang) {
					$detail_utang->id_detail = $po->detail[$i]->id;
				}
				$utang = app('App\Http\Controllers\Keuangan\Utang\CreateController')->create(
					$po->judul,
					$total_non_diskon,
					$diskon_total,
					$total,
					$detail_utangs,
					$transaction->supplier_id,
					$transaction->tanggal,
					$transaction->tanggal_faktur,
					$po->tanggal_po,
					$transaction->nomor_referensi,
					$po->no_po,
					$po->id,
					$image
				);
				$transaction->utang_id = $utang->id;
			}
			
			$transaction->total_harga = $total;
			$transaction->po_id = $po->id;
			$transaction->save();


			
			DB::connection('keuangan')->commit();
      		return redirect('gudang/pengadaan/'.$transaction->slug)
      				->with('status', 1)
              		  ->with('message', 'Pengadaan baru berhasil dibuat')
                		->with('title', 'Sukses');
		}
		catch (\Exception $e) 
		{
	    	
	    	DB::connection('keuangan')->rollBack();
	    	app('App\Http\Controllers\Error\Handler')->bugsnag($e);

	      	return redirect()->back()
	      				->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
	      				->with('status', -1)
                		->with('title', 'Gagal');
		}
	}

	private function uploadImage($request,$name)
	{

		//declare folder
		$folder = 'gudang/pengadaan';
		$public_folder = public_path('uploads/'.$folder);

		//getextension
		$ext = $request->image->extension();

		//create filename
		$filename = $this->createFilename($name,$public_folder,$ext);

		//join extension with filename
		$filename.='.'.$ext;

		//store local storage
		$old_path = $request->image->storeAs($folder, $filename);
		
		//move to public path (dest,source)
		$new_path = $request->file('image')->move($public_folder, $old_path);

		//delete file di storage
		Storage::delete($old_path);

		$file_url = 'uploads/'.$old_path;

		$thumb_filename = 'thumb_'.$filename;
		$resized_filename = 'big_'.$filename;

		// open an image file
		$img = Image::make($file_url);
		$img->fit(300);
		$img->save($public_folder.'/'.$thumb_filename);


		// open an image file
		$img = Image::make($file_url);
		$img->resize(null, 500, function ($constraint) {
			$constraint->aspectRatio();
		});
		$img->save($public_folder.'/'.$resized_filename);

		$images = array(
			'ori'=> 'uploads/'.$folder.'/'.$filename,
			'thumb' => 'uploads/'.$folder.'/'.$thumb_filename,
			'big' => 'uploads/'.$folder.'/'.$resized_filename
		);

		return $images;
	}

	private function createFilename($name,$public_folder,$ext)
	{

    		//slug filename
		$filename = $name;
		$filename = substr($filename, 0,10);
		$filename = preg_replace('~[^\pL\d]+~u', '-', $filename);
		$filename = iconv('utf-8', 'us-ascii//TRANSLIT', $filename);// transliterate
		$filename = preg_replace('~[^-\w]+~', '', $filename); // remove unwanted characters
		$filename = trim($filename, '-'); // trim
		$filename = preg_replace('~-+~', '-', $filename); // remove duplicate -
		$filename = strtolower($filename); // lowercase

		$filename_check = $filename;
		$i = 2;


		//if file exist change name;
		while(file_exists( $public_folder .'/'. $filename_check .'.'. $ext)) {
			$filename_check = $filename;
			$filename_check.= "_".$i;
			$i++;
		}

		$filename = $filename_check;

		return $filename;
		$images = array(
			'original'=> $folder.'/'.$filename,
			'thumb' => $folder.'/'.$thumb_filename
		);

		return $images;		
	}
}
