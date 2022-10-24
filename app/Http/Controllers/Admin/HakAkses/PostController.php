<?php

namespace App\Http\Controllers\Admin\HakAkses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterHakAkses;
use App\Models\Hospital\HakAksesUsers;
use App\User;

class PostController extends Controller
{
    public function add(Request $request)
    {
        //dd($request);
        $user = User::find($request->user_id);
        $hak_akses = $request->hak_akses;
        if (count($user->hak_akses) > 0) {
            $data['type'] = 'info';
            $data['title'] = 'Perubahan Akses Berhasil';
            $data['text'] = 'Hak Akses Akun Berhasil di Perbarui';
        } else {
            $data['type'] = 'success';
            $data['title'] = 'Sukses';
            $data['text'] = 'Hak Akses Akun Berhasil di Tambahkan';
        }
        //dd($hak_akses);
        foreach($user->hak_akses as $item){
            $item->delete();
        }
        foreach($hak_akses as $item){
            $temp = HakAksesUsers::withTrashed()->where('user_id',$user->id)->where('hak_akses_id',$item)->first();
            if(!empty($temp)){
                $temp->restore();
            }
            else{
                $temp = new HakAksesUsers;
                $temp->hak_akses_id = $item;
                $temp->user_id = $user->id;
                $temp->save();
            }
        }

        return json_encode($data);
    }

    public function delete($user_id)
    {
        $user = User::find($user_id);
        foreach($user->hak_akses as $item){
            $item->delete();
        }

        $data['type'] = 'success';
        $data['title'] = 'Sukses';
        $data['text'] = 'Hak Akses Akun Berhasil di Hapus';
        return json_encode($data);
    }
}
