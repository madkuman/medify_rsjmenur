<?php

namespace App\Http\Controllers\Kasus\Asesmen\IdentifikasiBayi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use DB;

class PostController extends Controller
{
    protected $route;
    protected $jenis;
    protected $asesmen;

    public function __construct()
    {
        $this->route = "identitikasi-bayi";
        $this->jenis = "Identitikasi Bayi";
        $this->asesmen = new ReadController();
    }

	public function save($nomor_kasus, Request $req)
	{
		DB::connection('kasus')->beginTransaction();
		try {
			$kasus = $this->asesmen->kasus($nomor_kasus);
			$val = $req->except('_token');
			if(isset($req->id) && $req->id != ""){
                $this->edit($val, $req->id);
			} else {
                $this->create($this->route, $val, $kasus->id);
			}
			DB::connection('kasus')->commit();
			return back()
                ->with('message', $this->jenis.' berhasil disimpan')
                ->with('title', 'Berhasil')
                ->with('status', 1);
		} catch (Exception $e) {
			DB::connection('kasus')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			$status = -1;
            $message = $this->jenis.' gagal dibuat!';
            $title = 'Error!';
            return back()
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
		}		
	}

    public function create($route_asesmen, $val, $kasus_id)
    {
        $asesmen_lanjutan = new AlatBantu;
    	
        $asesmen_lanjutan->type = $route_asesmen;
        $asesmen_lanjutan->val = json_encode($val);
    	$asesmen_lanjutan->created_by = auth()->user()->id;
    	$asesmen_lanjutan->kasus_id = $kasus_id;

    	$asesmen_lanjutan->save();
    }

    public function edit($val, $id)
    {
        $asesmen_lanjutan = AlatBantu::find($id);
        $asesmen_lanjutan->val = json_encode($val);
        $asesmen_lanjutan->updated_by = auth()->user()->id;

    	$asesmen_lanjutan->save();
    }

	public function delete($nomor_kasus, Request $req)
	{	
        DB::connection('kasus')->beginTransaction();
		try {
            AlatBantu::where('id', $req->id)->delete();
            DB::connection('kasus')->commit();
			return back()
                ->with('message', $this->jenis.' berhasil dihapus')
                ->with('title', 'Berhasil!')
                ->with('status', 1);
		} catch (Exception $e) {
            app("App\Http\Controllers\Error\Handler")->bugsnag($e);
            DB::connection("kasus")->rollback();
            return back()
                ->with("message", $this->jenis.' gagal dihapus!')
                ->with("title", 'Gagal!')
                ->with("status", -1);
		}		
	}
}