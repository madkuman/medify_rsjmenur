<?php

namespace App\Http\Controllers\Kepegawaian\MasterKuisioner;

use App\Exports\Kepegawaian\KuisionerBelum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Kuisioner;
use App\Models\Kepegawaian\KuisionerJawaban;
use App\Models\Kepegawaian\KuisionerPertanyaan;
use App\Models\Kepegawaian\Pertanyaan;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function baru(Request $req)
    {
        DB::connection('kepegawaian')->beginTransaction();
        try {
            app('App\Http\Controllers\Kepegawaian\MasterKuisioner\CreateController')->addKuisioner($req);
            
            $status = 1;
			$message = 'Kuisioner baru berhasil ditambahkan.';
			$title = 'Berhasil!';
    		
        	DB::connection('kepegawaian')->commit();
            return redirect('kepegawaian/master/kuisioner')->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kepegawaian')->rollback();
        }
    }

    public function edit(Request $req)
    {
        DB::connection('kepegawaian')->beginTransaction();
        try {
            app('App\Http\Controllers\Kepegawaian\MasterKuisioner\CreateController')->addKuisioner($req);
            
            $status = 1;
			$message = 'Kuisioner berhasil diperbarui.';
			$title = 'Berhasil!';
    		
        	DB::connection('kepegawaian')->commit();
            return redirect('kepegawaian/master/kuisioner')->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kepegawaian')->rollback();
        }
    }

    public function hapus($id)
    {
        $kuisioner = Kuisioner::find($id);
        try {
            $this->checkToAbort($kuisioner);
            $kuisioner->delete();

            $status = 1;
			$message = 'Kuisioner berhasil dihapus.';
			$title = 'Berhasil!';
    		
            return redirect('kepegawaian/master/kuisioner')->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function pertanyaanBaru(Request $req)
    {
        DB::connection('kepegawaian')->beginTransaction();
        try {
            $pertanyaan = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\CreateController')->addCustomPertanyaan($req);
            $flash = null;
            if ($pertanyaan->tipe == 'skala') {
                $flash = $pertanyaan->val_pilihan;
            }
            $status = 1;
			$message = 'Pertanyaan baru berhasil ditambahkan.';
			$title = 'Berhasil!';
    		
        	DB::connection('kepegawaian')->commit();
            return redirect('kepegawaian/master/kuisioner/'.$req->kuisionerid.'/pertanyaan')->with('message', $message)
                ->with('skala',$flash)
                ->with('title',$title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kepegawaian')->rollback();
        }
    }

    public function pertanyaanEdit(Request $req)
    {
        DB::connection('kepegawaian')->beginTransaction();
        try {
            app('App\Http\Controllers\Kepegawaian\MasterKuisioner\EditController')->editPertanyaan($req);
            
            $status = 1;
			$message = 'Pertanyaan berhasil diperbarui.';
			$title = 'Berhasil!';
    		
        	DB::connection('kepegawaian')->commit();
            return redirect('kepegawaian/master/kuisioner/'.$req->kuisionerid.'/pertanyaan')->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kepegawaian')->rollback();
        }
    }

    public function pertanyaanHapus($kuisioner, $id)
    {
        $pertanyaan = KuisionerPertanyaan::find($id);
        try {
            $this->checkToAbort($pertanyaan);
            $pertanyaan->delete();

            $status = 1;
			$message = 'Pertanyaan berhasil dihapus.';
			$title = 'Berhasil!';
    		
            return redirect('kepegawaian/master/kuisioner/'.$kuisioner.'/pertanyaan')->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function printKuisionerBelum(Request $req)
	{
        $id = KuisionerJawaban::where('kuisioner_id', $req->kuisionerid)->get()->pluck('created_by');
        $data['data'] = User::with('profesi_detail', 'employee')->whereNull('fake_account')->whereNotIn('id', $id)->get()->sortBy('profesi_detail.title');
        $data['nama'] = Kuisioner::find($req->kuisionerid);
		return (new KuisionerBelum($data))->download('Laporan_belum_mengisi_kuisioner.xlsx');
    }

    public function addJawaban(Request $req)
    {
        DB::connection('kepegawaian')->beginTransaction();
        try {
            if (!empty($req->jawabanid)) {
                $jawaban = KuisionerJawaban::find($req->jawabanid);
                $jawaban->edited = 1;
            }else {
                $jawaban = new KuisionerJawaban();
            }
            $jawaban->kuisioner_id = $req->kuisionerid;
            
            $jawab = collect([]);
            foreach ($req->pertanyaan as $item) {
                $pertanyaan = explode('_', $item);
                $temp = explode('_', $req->input($pertanyaan[1].'_'.$pertanyaan[0]));
                if(empty($temp[1])) $ket = '';
                else $ket = $temp[1];
                $jawab->push(['pertanyaan_id' => $pertanyaan[0],'tipe' => $pertanyaan[1], 'jawaban' => $temp[0], 'keterangan' => $ket]);
            }
            $json = json_encode($jawab);            
            $jawaban->jawaban = $json;
            $jawaban->created_by = Auth::user()->id;
    
            $jawaban->save();

            $status = 1;
			$message = 'Jawaban Anda berhasil disimpan.';
			$title = 'Berhasil!';
    		
        	DB::connection('kepegawaian')->commit();
            return redirect('kuisioner/'.$req->slug)->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kepegawaian')->rollback();
        }
    }
    
    //for kuisioner publik 
    public function addJawabanPublik(Request $req)
    {
        DB::connection('kepegawaian')->beginTransaction();
        try {
            $jawaban = KuisionerJawaban::find($req->jawabanid);
            $jawaban->edited = 1;
            $jawab = collect([]);
            foreach ($req->pertanyaan as $item) {
                $pertanyaan = explode('_', $item);
                $temp = explode('_', $req->input($pertanyaan[1].'_'.$pertanyaan[0]));
                if(empty($temp[1])) $ket = '';
                else $ket = $temp[1];
                $jawab->push(['pertanyaan_id' => $pertanyaan[0],'tipe' => $pertanyaan[1], 'jawaban' => $temp[0], 'keterangan' => $ket]);
            }
            $json = json_encode($jawab);            
            $jawaban->jawaban = $json;
            $jawaban->save();

        	DB::connection('kepegawaian')->commit();
            return json_encode(array('status' => 1));
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kepegawaian')->rollback();
            return json_encode(array('status' => 1));
        }
    }

}
