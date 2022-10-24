<?php

namespace App\Http\Controllers\Admin\UserControl;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Hospital\Profesi;
use App\Models\Hospital\Spesialisasi;
use App\Models\Hospital\SubSpesialisasi;
use Illuminate\Support\Facades\Validator;
use DB;
use Bugsnag;

class EditController extends Controller
{
    public function deaktif($id)
    {
    	//dd("abcasd");
    	$user = User::where('id',$id)->first();
    	$user->flag = 0;
    	$user->save();
    	return back()
	            ->with('message', 'Akun Berhasil di Deaktifkan')
	            ->with('status', 1)
	            ->with('title', 'Sukses');
    }
    public function aktif($id)
    {
    	//dd("abcasd");
    	$user = User::where('id',$id)->first();
    	$user->flag = 1;
    	$user->save();
    	return back()
	            ->with('message', 'Akun Berhasil di Aktifkan')
	            ->with('status', 1)
	            ->with('title', 'Sukses');
    }
    public function reset($id)
    {
    	$user = User::where('id',$id)->first();
    	$user->password = bcrypt('123456');
    	$user->save();
    	return back()
	            ->with('message', 'Password Akun Berhasil di Reset')
	            ->with('status', 1)
	            ->with('title', 'Sukses');
    }
    public function deaktifAjax($id)
    {
        //dd("abcasd");
        $user = User::where('id',$id)->first();
        $user->flag = 0;
        $user->save();

        $data['type'] = 'success';
        $data['title'] = 'Sukses';
        $data['text'] = 'Akun Berhasil di Deaktifkan';
        return json_encode($data);
    }
    public function aktifAjax($id)
    {
        //dd("abcasd");
        $user = User::where('id',$id)->first();
        $user->flag = 1;
        $user->save();
        
        $data['type'] = 'success';
        $data['title'] = 'Sukses';
        $data['text'] = 'Akun Berhasil di Aktifkan';
        return json_encode($data);
    }
    public function resetAjax($id)
    {
        $user = User::where('id',$id)->first();
        $user->password = bcrypt('123456');
        $user->save();
        
        $data['type'] = 'success';
        $data['title'] = 'Sukses';
        $data['text'] = 'Password Akun Berhasil di Reset';
        return json_encode($data);
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        DB::connection('mysql')->beginTransaction();
        try {
            $user->email = (isset($request->email)) ? $request->email : $user->email ;
            $user->employee_id = $request->employee;
            $user->profesi = $request->profession;
            $user->specialty = (isset($request->specialty)) ? $request->specialty : NULL ;
            $user->subspecialty = (isset($request->subspecialty)) ? $request->subspecialty : NULL ;
            $user->dokter_id = (isset($request->dokter_id)) ? $request->dokter_id : NULL ;

            $user->save();
            DB::connection('mysql')->commit();

            $status = 1;
            $message = 'Akun '.$user->name.' berhasil diubah!';
            $title = 'Sukses!';
        } catch (\Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return back()
        ->with('message', $message)
        ->with('title', $title)
        ->with('status', $status);
        
    }
    public function admin($id)
    {
        $user = User::where('id',$id)->first();
        $user->admin = 1;
        $user->save();
        return back()
                ->with('message', 'Akun Berhasil di jadikan Admin')
                ->with('status', 1)
                ->with('title', 'Sukses');
    }
    public function removeAdmin($id)
    {
        $user = User::where('id',$id)->first();
        $user->admin = 0;
        $user->save();
        return back()
                ->with('message', 'Status admin telah berhasil dilepas')
                ->with('status', 1)
                ->with('title', 'Sukses');
    }

    protected function validator(array $data, $user)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id
        ]);
    }
}
