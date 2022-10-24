<?php

namespace App\Http\Controllers\BPJS\Piutang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use DB;
use App\Models\Pasien\Pasien;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\PiutangDetail;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\TarifTipe;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\Tarif;
use App\Models\Hospital\Lokasi;
use App\Models\Keuangan\Perusahaan;

class PostController extends Controller
{

    	public function apiSubmit(Request $request)
    	{	
    		$id = $request->id;
    		$judul = $request->judul;
    		if(!empty($request->dp))
  			{	
  				$input_tanggal = Carbon::parse($request->created_at)->format('Y-m-d');
  				// dd($input_tanggal);
  				$created_at = $input_tanggal;
    			$updated_at = $input_tanggal;
    			$tanggal = $request->created_at;
  			}
  			else
  			{
  				$created_at = $request->created_at;
    			$updated_at = $request->updated_at;
    			$tanggal = $request->tanggal;
  			}
    		$jumlah = $request->alljumlah;
    		$diskon = $request->alldiskon;
    		$total = $request->alltotal;
    		$kategori = $request->kategori_id;
    		$pasien_id = $request->pasien_id;
    		$transaksi = $request->transaksi;
    		$pihak_3 = $request->pihak_3;
    		$pasien_pembayaran_id = $request->pasien_pembayaran_id;
    		$lokasi_id = $request->lokasi_id;
    		$kasus_tagihan_id = $request->kasus_tagihan_id;
    		$perusahaan_id = $request->perusahaan_id;
    		if(empty($request->dp))
    		{
    			$piutang_parent_id = $request->piutang_parent_id;	
    		}
    		else
    		{
    			$piutang_parent_id = null;
    		}
    		$keterangan = $request->keterangan;
    		$kasir_id = $request->kasir_id;
    		$redir_url = $request->redir_url;
    		$dp = $request->dp;

    		if(empty($redir_url)) $redir_url = 'keuangan/piutang';

    		$transaksi = json_decode($transaksi);
    		$tanggal = Carbon::createFromFormat('d-m-Y', $tanggal, 'Asia/Jakarta');

    		try {
    			DB::connection('keuangan')->beginTransaction();
    			if(is_null($id)){
    				if(empty($dp))
    				{
    					$transaksi = app('App\Http\Controllers\Keuangan\Piutang\CreateController')
	    				->create($kasir_id,$judul,$jumlah,$diskon,$total,$pasien_id,$pihak_3,$kategori,
	    					$tanggal,$created_at,$updated_at,
	    					$transaksi,$pasien_pembayaran_id,$lokasi_id,
	    					$kasus_tagihan_id,$perusahaan_id,$keterangan,$piutang_parent_id);
	    				$text = 'Dibuat';
    				}
    				else
    				{	
    					// dd('dp');
    					$transaksi = app('App\Http\Controllers\Keuangan\Piutang\CreateController')
	    				->create($kasir_id,$judul,$jumlah,$diskon,$jumlah,$pasien_id,$pihak_3,$kategori,
	    					$tanggal,$created_at,$updated_at,
	    					$transaksi,$pasien_pembayaran_id,$lokasi_id,
	    					$kasus_tagihan_id,$perusahaan_id,$keterangan,$piutang_parent_id);
	    				$text = 'Dibuat';
	    				$bayar = $this->payPiutang($transaksi->id,(int)$jumlah,(int)$jumlah,1,'false',0);
	    				// dd($bayar);
    				}
    				
    			}
    			else{
    				$transaksi = app('App\Http\Controllers\Keuangan\Piutang\EditController')
    				->update($id,$kasir_id,$judul,$jumlah,$diskon,$total,$pasien_id,$pihak_3,$kategori,
    					$tanggal,$created_at,$updated_at,
    					$transaksi,$pasien_pembayaran_id,$lokasi_id,
    					$kasus_tagihan_id,$perusahaan_id,$piutang_parent_id);
    				$text = 'Diedit';
    			}

    			if($transaksi->kasus_tagihan_id != null){
    				//dd('call_kasus_tagihan_update');
           		//ubah status telah checkout
    			}

    			$data['type'] = 'success';
    			$data['title'] = 'Berhasil';
    			$data['text'] = 'Transaksi Piutang Berhasil '.$text;
    			$data['url'] = $redir_url.'/'.$transaksi->id;

    			DB::connection('keuangan')->commit();
    		} catch (\Exception $e) {
    			DB::connection('keuangan')->rollback();
               app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    			$data['type'] = 'error';
    			$data['title'] = 'Gagal';
    			$data['text'] = 'Transaksi Piutang Gagal Dibuat : Kesalahan Server, silahkan hubungi admin';
    			$data['url'] = 0;
    		}
    		if(!empty($request->dp))
    		{	
    			// dd('abc');
    			return redirect($redir_url.'/'.$transaksi->id)
    				->with('message', 'DP Berhasil dibayarkan')
	                ->with('title','Berhasil')
	                ->with('status',1);
    		}
    		return json_encode($data);
    	}

	public function payPiutang($piutang_id,$pay_now,$total_pay,$akun_id,$rugi_rs,$untung_rs,$kerugian_total,$deposit_used,$cash_used){
		$user_id = Auth::user()->id;

		$piutang = Piutang::find($piutang_id);
		$kekurangan_bayar = $piutang->total - $piutang->total_paid;
		$paid = $piutang->total_paid;
		$piutang->total_paid = $paid + $total_pay;
		$piutang->cashier_by = Auth::user()->id;
		$piutang->save();

		$isHasSister = 0;
		if(count($piutang->sister) > 0) $isHasSister = 1;

		$pihak_ketiga = $piutang->pihak_ketiga;

		if($rugi_rs == "true") $piutang_total = $total_pay;
		else $piutang_total = $piutang->total;

		foreach($piutang->detail as $item){
			if($isHasSister){
				$parent_piutang = Piutang::where('id',$piutang->piutang_parent_id)->withTrashed()->first();
				$koefisien_piutang_sister = $piutang->total / $parent_piutang->total;
			}
			else $koefisien_piutang_sister = 1;
			$temp_subtotal = $total_pay/$piutang_total * $item->subtotal * $koefisien_piutang_sister;
			$beban_sister = $item->subtotal * (1 - $koefisien_piutang_sister);
			$transaksi_detail[] = (object) array(
				'deskripsi'=> $item->deskripsi,
				'lokasi_id'=> $item->lokasi_id,
				'kategori_id'=> $item->kategori_id,
				'tarif_id'=> $item->tarif_id,
				'tarif_tipe_id'=> $item->tarif_tipe_id,
				'tarif_kelas_id'=> $item->tarif_kelas_id,
				'harga'=> $item->harga,
				'jumlah'=> $item->jumlah,
				'diskon'=> $item->diskon,
				'beban_lain'=> $item->subtotal - $temp_subtotal, 					//belom tau
				'subtotal'=> $temp_subtotal,
				'keterangan'=> $item->keterangan,
				'created_by'=> $item->created_by,
				'created_at'=> $item->created_at,
				'updated_at'=> $item->updated_at
			);
		}
		if ($rugi_rs == "true") {
			$transaksi_detail[] = $this->getKerugianDetail($kerugian_total);
		}

		if($kekurangan_bayar < $pay_now && $untung_rs == "true"){
			$transaksi_detail[] = $this->getKeuntunganDetail($pay_now - $kekurangan_bayar);
		}

		if($untung_rs == 'true') $pemasukan_total = $pay_now;
		else $pemasukan_total = $total_pay;

		$total_beban_lain = 0;
		foreach($transaksi_detail as $item)
		{
			$total_beban_lain += $item->beban_lain;
		}
		$total_beban_lain = (int) $total_beban_lain;
		$piutang->beban_lain = $total_beban_lain;

		$pemasukan = new \stdClass();
		$pemasukan->judul = $piutang->judul;
		$pemasukan->jumlah = $piutang->total;
		$pemasukan->diskon = $piutang->diskon;
		$pemasukan->beban_lain = $piutang->beban_lain;
		$pemasukan->total = $pemasukan_total;
		$pemasukan->total_pembayaran = $cash_used;
		$pemasukan->total_kembalian = $pay_now-$pemasukan_total;
		$pemasukan->total_deposit = $deposit_used;
		$pemasukan->akun_id = $akun_id;
		$pemasukan->pihak_ketiga = $pihak_ketiga;
		$pemasukan->perusahaan_id = $piutang->perusahaan_id;
		$pemasukan->pasien_id = $piutang->pasien_id;
		$pemasukan->pasien_pembayaran_id = $piutang->pasien_pembayaran_id;
		$pemasukan->lokasi_id = $piutang->lokasi_id;
		$pemasukan->kategori_id = $piutang->kategori_id;
		$pemasukan->tanggal_transaksi = Carbon::now();
		$pemasukan->piutang_id = $piutang->id;


		$transaksi = app('App\Http\Controllers\Keuangan\Pemasukan\CreateController')->create($pemasukan,$transaksi_detail);
		
       	//Update IsPaid di Tagihan Kasus
		if(!empty($piutang->kasus_tagihan_id))
			$tagihan_kasus = app('App\Http\Controllers\Kasus\Tagihan\EditController')->editPaid($piutang->kasus_tagihan_id); 

		return $transaksi;
	}

	private function getKerugianDetail($kerugian_total)
	{
        	$tipe_default = TarifTipe::where('slug','default')->first();
        	$tarif_master = TarifMaster::where('slug','selisih-biaya-rugi')->first();
        	$tarif = Tarif::where('tarif_master_id',$tarif_master->id)->where('tipe_id',$tipe_default->id)->first(); 
        	$kategori = Kategori::where('slug','selisih-biaya-rugi')->first();
        	$lokasi = Lokasi::where('slug', 'keuangan')->first();

		$kerugian = (object) array(
			'deskripsi'=> $tarif_master->deskripsi,
			'lokasi_id'=> $lokasi->id,
			'kategori_id'=> $kategori->id,
			'tarif_id'=> $tarif->id,
			'tarif_kelas_id'=> null,
        		'tarif_tipe_id' => $tipe_default->id,
			'harga'=> $kerugian_total,
			'jumlah'=> 1,
			'diskon'=> 0,
			'beban_lain'=> null,
			'subtotal'=> $kerugian_total,
			'keterangan'=> null,
			'created_by'=> Auth::user()->id,
			'created_at'=> Carbon::now(),
			'created_at'=> Carbon::now()
		);
		return $kerugian;

	}

	private function getKeuntunganDetail($keuntungan_total)
	{

        	$tipe_default = TarifTipe::where('slug','default')->first();
        	$tarif_master = TarifMaster::where('slug','selisih-biaya-untung')->first();
        	$tarif = Tarif::where('tarif_master_id',$tarif_master->id)->where('tipe_id',$tipe_default->id)->first(); 
        	$kategori = Kategori::where('slug','selisih-biaya-untung')->first();
        	$lokasi = Lokasi::where('slug', 'keuangan')->first();

		$keuntungan = (object) array(
			'deskripsi'=> $tarif_master->deskripsi,
			'lokasi_id'=> $lokasi->id,
			'kategori_id'=> $kategori->id,
			'tarif_id'=> $tarif->id,
			'tarif_kelas_id'=> null,
        		'tarif_tipe_id' => $tipe_default->id,
			'harga'=> $keuntungan_total,
			'jumlah'=> 1,
			'diskon'=> 0,
			'beban_lain'=> null,
			'subtotal'=> $keuntungan_total,
			'keterangan'=> null,
			'created_by'=> Auth::user()->id,
			'created_at'=> Carbon::now(),
			'created_at'=> Carbon::now()
		);
		return $keuntungan;

	}
		
	public function pay(Request $request)
	{
		DB::connection('keuangan')->beginTransaction();
		DB::connection('kasus')->beginTransaction();
		try {
			$piutang_id = $request->id;
			$pembayaran = $request->pembayaran;
			$deposit = $request->deposit;
			$akun_id = $request->akun_id;
			$rugi_rs = $request->rugi_rs;
			$untung_rs = $request->untung_rs;
			$redir_url = $request->redir_url;

			$total_pembayaran = $pembayaran+$deposit;
			$piutang = Piutang::find($piutang_id);
			$kekurangan_bayar = $piutang->total - $piutang->total_paid;

			if($total_pembayaran > $kekurangan_bayar) $piutang_terbayar = $kekurangan_bayar;
			else $piutang_terbayar = $total_pembayaran;


			$kerugian_total = 0;
			if($rugi_rs == "true") $kerugian_total = $total_pembayaran - $kekurangan_bayar;

			$pemasukan = $this->payPiutang($piutang_id,$total_pembayaran,$piutang_terbayar,$akun_id,$rugi_rs,$untung_rs,$kerugian_total,$deposit,$pembayaran);

			if ($rugi_rs == "true") {
				$transaksi = $this->getKerugianDetail($kerugian_total);
				$detail = app('App\Http\Controllers\Keuangan\Piutang\CreateController')->insertDetail($piutang_id,$transaksi);
		
			}


			if(empty($redir_url)) $redir_url = 'keuangan/pemasukan'.'/'.$pemasukan->id;
			else $redir_url = $redir_url.'/'.$piutang_id;


			$data['type'] = 'success';
			$data['title'] = 'Berhasil';
			$data['text'] = 'Pembayaran Berhasil';
    			$data['url'] = $redir_url;
			DB::connection('keuangan')->commit();
			DB::connection('kasus')->commit();

		} catch (\Exception $e) {

			DB::connection('keuangan')->rollback();
			DB::connection('kasus')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$data['type'] = 'error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Pembayaran Gagal';
    			$data['url'] = $redir_url.'/'.$piutang_id;
		}


		return json_encode($data);
	}

		public function multiplePay(Request $request)
		{
			DB::connection('keuangan')->beginTransaction();
			DB::connection('kasus')->beginTransaction();
			try {

				$total_paid = $request->total_paid;
				$total = $request->total;
				$akun_id = $request->akun_id;
				$transaksi = $request->transaksi;
				$transaksi = json_decode($transaksi);
				
				foreach($transaksi as $item)
				{
					$total_each = $item->total / $total * $total_paid;
					$transaksi = $this->payPiutang($item->pk_id,$total_each,$total_each,$akun_id,"false","false",0,0,$total_each);
				}

				$data['type'] = 'success';
				$data['title'] = 'Berhasil';
				$data['text'] = 'Transaksi Berhasil';
				DB::connection('keuangan')->commit();
				DB::connection('kasus')->commit();

			} catch (\Exception $e) {

				DB::connection('keuangan')->rollback();
				DB::connection('kasus')->rollback();
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
				$data['type'] = 'error';
				$data['title'] = 'Gagal';
				$data['text'] = 'Transaksi Gagal';
			}

			return json_encode($data);
		}

		public function apiSplit(Request $request)
		{
			$id = $request->id;
			$parent = Piutang::find($id);
			$perusahaan = Perusahaan::find($request->perusahaan_id);

			$perusahaan_tunai = Perusahaan::where('tunai',1)->first();
			if($request->perusahaan_id == $perusahaan_tunai->id)
			{
				$get_tunai = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')
				->getJenisTunaiFromPasien($parent->pasien_id);
				if(!empty($get_tunai->id))
				{
					$pihak_3 = $perusahaan->nama;
					$pasien_pembayaran_id = $get_tunai->id;
				}
				else
				{
					$pihak_3 = $perusahaan->nama;
					$pasien_pembayaran_id = null;
				}
			}
			else
			{
				$pihak_3 = $perusahaan->nama;
				$pasien_pembayaran_id = null;
			}

			$tanggal = $parent->tanggal_transaksi;
			$judul = $parent->judul;
			$jumlah = $parent->jumlah;
			$diskon = $parent->diskon;
			$total = $request->split_total;
			$kategori = $parent->kategori_id;
			$pasien_id = $parent->pasien_id;
			$pihak_3 = $pihak_3;
			$pasien_pembayaran_id = $pasien_pembayaran_id;
			$lokasi_id = $parent->lokasi_id;
			$kasus_tagihan_id = $parent->kasus_tagihan_id;
			$perusahaan_id = $request->perusahaan_id;
			$keterangan = $parent->keterangan;
			$transaksi = array();

			try {
				DB::connection('keuangan')->beginTransaction();
				$new_split = app('App\Http\Controllers\Keuangan\Piutang\CreateController')
				->create($judul,$jumlah,$diskon,$total,$pasien_id,$pihak_3,$kategori,$tanggal,null,null,$transaksi,$pasien_pembayaran_id,$lokasi_id,$kasus_tagihan_id,$perusahaan_id,$keterangan);
				$split_parent_total = app('App\Http\Controllers\Keuangan\Piutang\EditController')
				->split($id,$total,$new_split->id);
				$data['type'] = 'success';
				$data['title'] = 'Berhasil';
				$data['text'] = 'Transaksi Piutang Berhasil Dibuat';
				$data['url'] = 'keuangan/piutang/'.$new_split->id;

				DB::connection('keuangan')->commit();
			} catch (\Exception $e) {
				DB::connection('keuangan')->rollback();
				$data['type'] = 'error';
				$data['title'] = 'Gagal';
				$data['text'] = 'Transaksi Piutang Gagal Dibuat : Kesalahan Server, silahkan hubungi admin';
				$data['url'] = 0;
			}

			return json_encode($data);
		}

		public function split(Request $request,$piutang_id)
		{
			try {
				DB::connection('keuangan')->beginTransaction();
				$piutang = Piutang::find($piutang_id);
				$count = count($request->perusahaan);

				for($i = 0; $i < $count ; $i++)
				{
					$kasir_id = $piutang->kasir_id;
					$judul = $piutang->judul;
					$jumlah = $piutang->jumlah;
					$diskon = $piutang->diskon;
					$total = $request->total[$i];
					$total_paid = 0;
					$pihak_ketiga = $request->pihak_ketiga[$i];
					$perusahaan_id = $request->perusahaan[$i];
					$kategori_id = $piutang->kategori_id;
					$pasien_id = $piutang->pasien_id;
					$lokasi_id = $piutang->lokasi_id;
					$tanggal_transaksi = $piutang->tanggal_transaksi;
					$kasus_tagihan_id = $piutang->kasus_tagihan_id;
					$piutang_parent_id = $piutang->id;
					$keterangan = $piutang->keterangan;
					$transaksi_detail = $piutang->detail;
					$created_at = $piutang->created_at;
					$updated_at = $piutang->updated_at;
					$created_by = Auth::user()->id;
					if(!empty($request->pasien_pembayaran_id))
						$pasien_pembayaran_id = $request->pasien_pembayaran_id[$i];
					else
						$pasien_pembayaran_id = null;


					$transaksi = app('App\Http\Controllers\Keuangan\Piutang\CreateController')
					->create($kasir_id,$judul,$jumlah,$diskon,$total,$pasien_id,$pihak_ketiga,$kategori_id,
						$tanggal_transaksi,$created_at,$updated_at,
						$transaksi_detail,$pasien_pembayaran_id,$lokasi_id,
						$kasus_tagihan_id,$perusahaan_id,$keterangan,$piutang_parent_id);

					if($i == 0) $redir_id = $transaksi->id;
				}
				app('App\Http\Controllers\Keuangan\Piutang\DeleteController')->deleteAct($piutang->id,0);



				DB::connection('keuangan')->commit();

				$status = 1;
				$message = 'Piutang Berhasil di split.';
				$title = 'Berhasil!';

				return redirect('keuangan/piutang/'.$redir_id)
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);

			} catch (\Exception $e) {
				DB::connection('keuangan')->rollback();
                	app('App\Http\Controllers\Error\Handler')->bugsnag($e);

				$status = 1;
				$message = 'Piutang Gagal di split. Kesalahan Server. Hubungi Admin';
				$title = 'Gagal!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}

		public function revokeSplit($piutang_id)
		{
			try {
				DB::connection('keuangan')->beginTransaction();
				$piutang = Piutang::find($piutang_id);
				$revokeAccepted = 1;
				foreach($piutang->sister as $item)
				{
					if($item->total_paid > 0) $revokeAccepted = 0;
				}

				if($piutang->total_paid > $item->total) $revokeAccepted = 0;
				if($revokeAccepted)
				{
					$piutang_parent_id = $piutang->piutang_parent_id;
					foreach($piutang->sister as $item)
					{
						$temp = Piutang::find($item->id);
						app('App\Http\Controllers\Keuangan\Piutang\DeleteController')->deleteAct($temp->id,0);
					}
					app('App\Http\Controllers\Keuangan\Piutang\DeleteController')->deleteAct($piutang->id,0);
					app('App\Http\Controllers\Keuangan\Piutang\DeleteController')->reviveData($piutang_parent_id);
					
					$status = 1;
					$message = 'Piutang split di dikembalikan.';
					$title = 'Berhasil!';
				}
				else
				{
					$piutang_parent_id = $piutang_id;
					$status = -1;
					$message = 'Piutang Gagal di dikembalikan. Terdapat piutang lain yang telah terbayar. Anda harus menghapus histori pembayaran piutang hasil split yang sama.';
					$title = 'Gagal!';
				}

				DB::connection('keuangan')->commit();


				return redirect('keuangan/piutang/'.$piutang_parent_id)
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);

			} catch (\Exception $e) {
				DB::connection('keuangan')->rollback();
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);

				$status = 1;
				$message = 'Piutang Split gagal dikembalikan. Kesalahan Server. Hubungi Admin';
				$title = 'Gagal!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}

	public function tagihkan(Request $req)
	{
		try {
			DB::connection('keuangan')->beginTransaction();
			foreach($req->piutang_id as $id)
			{
				$piutang = Piutang::find($id);
				$piutang->status = config('const.state_ditagih');
				$piutang->save();
			}
			DB::connection('keuangan')->commit();
			$status = "success";
			$message = 'Piutang berhasil ditagihkan.';
			$title = 'Berhasil!';

			return redirect('keuangan/piutang')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		} catch (Exception $e) {
			DB::connection('keuangan')->rollback();
			$status = "error";
			$message = 'Piutang gagal ditagihkan. Kesalahan Server. Hubungi Admin';
			$title = 'Gagal!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}
}