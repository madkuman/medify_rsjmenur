<?php

namespace App\Http\Controllers\Humas\Komplain;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Humas\Komplain;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function deleteKomplain(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = $request->komplainid;
            $hapuskomplain = app('App\Http\Controllers\Humas\Komplain\DeleteController')->deleteKomplain($id);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Penghapusan respon komplain berhasil';
            $data['url'] = 'humas';
            DB::commit();
        }

        catch (\Exception $e) {
            DB::rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Respon komplain gagal dihapus : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
        }

        return json_encode($data);
    }
}
