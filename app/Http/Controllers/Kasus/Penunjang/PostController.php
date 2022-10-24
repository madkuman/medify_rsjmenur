<?php
namespace App\Http\Controllers\Kasus\Penunjang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;
use App\Models\Kasus\Kasus;

class PostController extends Controller
{
	public function uploadPenunjang(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try{

            if($request->tipe_penunjang == "media"){
	            $ext = $request->file('gambar')->extension();
	            // dd($ext);
	            $image_ext = ["jpg", "png", "jpeg", "bmp", "svg", "webp"];
	            $video_ext = ["mp4", "webm", "3gp"];
	            if(in_array($ext, $image_ext))    $file_type = "image";
	            else if(in_array($ext, $video_ext))   $file_type = "video";

				if ($request->hasFile('gambar')) {
					$gambar = $request->file('gambar');
					$image = app('App\Http\Controllers\Functions\ImageUploader')->upload($gambar,'penunjang', $file_type);
					$uploaded_image = $image['file_original'];
					if($file_type == "image")
						$thumbnail = $image['file_thumbnail'];
					else
						$thumbnail = 'assets/img/video-placeholder.png';
				}
				else
				{
					$uploaded_image = 'assets/img/placeholder.jpg';
				}
				$file_url = $uploaded_image;
			} else if($request->tipe_penunjang == "pdf"){
				if(!$request->hasFile('file_pdf')){
					$kasus = Kasus::where('id',$request->kasus_id)->first();
					return redirect(url('kasus').'/'.$kasus->nomor_kasus.'/penunjang#galeri')
						->with('message', "Tidak ada file yang dipilih")
						->with('title',"Upload Gagal")
						->with('status', -1)
						->with('active_nav','galeri');
				}

				$upload = app('App\Http\Controllers\Functions\ImageUploader')->upload($request->file('file_pdf'),'penunjang', 'pdf');
				$file_url = $upload['file_original'];
				$thumbnail = 'assets/icons/svg/pdf.svg';
				$file_type = "pdf";
			}else{
				$file_type = "link";
				$file_url = $request['link'];
				$thumbnail = 'assets/img/link.png';
			}

			$kasus_id = $request->kasus_id;
			$judul = $request->judul;
			$caption = $request->caption;
			$type = 'penunjang';
			$permintaan_id = null;
			
			$penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData($file_url,$judul,$caption,$kasus_id,$file_type,$type,$permintaan_id, $thumbnail);

			$kasus = Kasus::where('id',$kasus_id)->first();
			$status = 1;
			$message = 'Penunjang Berhasil ditambahkan.';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus_id,'create','penunjang',$penunjang->id,$kasus_id);


			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();


			return redirect(url('kasus').'/'.$kasus->nomor_kasus.'/penunjang#galeri')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status)
			->with('active_nav','galeri');

		}
		
		catch (\Exception $e) {
			$status = 1;
			$message = 'Penunjang Gagal ditambahkan.';
			$title = 'Gagal!';
			
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();

			return redirect(url('kasus').'/'.$kasus->nomor_kasus.'/penunjang#galeri')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status)
			->with('active_nav','galeri');
		}

	}

	public function editPenunjang($nomor_kasus, Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$id = $request->id;
			$judul = $request->judul;
			$caption = $request->caption;
			$penunjang = app('App\Http\Controllers\Kasus\Penunjang\UpdateController')->update($id,$judul,$caption);

			$status = 1;
			$message = 'Penunjang Berhasil diedit.';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','penunjang',$penunjang->id,$kasus->id);

			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();

			return redirect(url('kasus').'/'.$nomor_kasus.'/penunjang#galeri')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status)
			->with('active_nav','galeri');

		}
		
		catch (\Exception $e) {
			$status = 1;
			$message = 'Penunjang Gagal diedit.';
			$title = 'Gagal!';
			

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();

			return redirect(url('kasus').'/'.$nomor_kasus.'/penunjang#galeri')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status)
			->with('active_nav','galeri');
		}

	}

	public function deletePenunjang($nomor_kasus, Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$id = $request->id;
			$judul = $request->judul;
			$caption = $request->caption;
			$penunjang = app('App\Http\Controllers\Kasus\Penunjang\DeleteController')->delete($id);

			$status = 1;
			$message = 'Penunjang Berhasil dihapus.';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','penunjang',$id,$kasus->id);

			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();

			return redirect(url('kasus').'/'.$nomor_kasus.'/penunjang#galeri')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status)
			->with('active_nav','galeri');

		}
		
		catch (\Exception $e) {
			$status = 1;
			$message = 'Penunjang Gagal dihapus.';
			$title = 'Gagal!';
			

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();

			return redirect(url('kasus').'/'.$nomor_kasus.'/penunjang#galeri')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status)
			->with('active_nav','galeri');
		}
	}

	public function komentar(Request $req, $nomor_kasus, $penunjang_id)
	{
		$comment = $req['komentar'];
		$komentar = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->insertKomentar($penunjang_id, $comment);
		if(!$komentar)
			return redirect()->back()
				->with('message', "Gagal Mengirim Komentar, coba lagi")
				->with('title',"Gagal Mengirim Komentar")
				->with('status', -1);
		return redirect()->back()
			->with('message', "Berhasil Mengirim Komentar")
			->with('title',	"Berhasil Mengirim Komentar")
			->with('status', 1);
	}

	public function deleteKomentar(Request $req)
	{
		$idKomentar = $req['komentarId'];
		$delete = app('App\Http\Controllers\Kasus\Penunjang\DeleteController')->deleteKomentar($idKomentar);
		
		if(is_null($delete))
			return redirect()->back()
				->with('message', "Komentar tidak ditemukan")
				->with('title',"Komentar tidak ditemukan")
				->with('status', -1);			
		if(!$delete)
			return redirect()->back()
				->with('message', "Gagal Menghapus Komentar, coba lagi")
				->with('title',"Gagal Menghapus Komentar")
				->with('status', -1);
		return redirect()->back()
			->with('message', "Berhasil Menghapus Komentar")
			->with('title',	"Berhasil Menghapus Komentar")
			->with('status', 1);		
	}

	public function updateKomentar(Request $req)
	{
		$idKomentar = $req['komentarId'];
		$komentar = $req['komentar'];
		$update = app('App\Http\Controllers\Kasus\Penunjang\UpdateController')->updateKomentar($idKomentar, $komentar);
		
		if(is_null($update))
			return redirect()->back()
				->with('message', "Komentar tidak ditemukan")
				->with('title',"Komentar tidak ditemukan")
				->with('status', -1);			
		if(!$update)
			return redirect()->back()
				->with('message', "Gagal Mengubah Komentar, coba lagi")
				->with('title',"Gagal Mengubah Komentar")
				->with('status', -1);
		return redirect()->back()
			->with('message', "Berhasil Mengubah Komentar")
			->with('title',	"Berhasil Mengubah Komentar")
			->with('status', 1);		
	}
}