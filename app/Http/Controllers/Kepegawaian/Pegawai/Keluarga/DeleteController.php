<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai\Keluarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Keluarga;
use Alert,Auth;

class DeleteController extends Controller{

    public function delete($id){
		$delete = Keluarga::where('id',$id)->delete();
        
        if ( !$delete )
          Alert::error('Terjadi kesalahan saat menghapus data keluarga. Silahkan ulangi lagi', 'Gagal!');
        else 
          Alert::success('Data keluarga berhasil di hapus', 'Berhasil!');
    
        return redirect()->route('families', ['id' => $id, '_' => microtime(true)]);
	}
}