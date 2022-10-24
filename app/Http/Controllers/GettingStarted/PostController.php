<?php

namespace App\Http\Controllers\GettingStarted;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Bugsnag;
use App\User;
use App\Models\Hospital\UserGroup;

class PostController extends Controller
{
    public function profesi(Request $request)
    {
        $user = User::find(Auth::user()->id);
        try {
            DB::connection('mysql')->beginTransaction();
            $user->profesi = $request->profession;
            $user->specialty = $request->specialty;
            if ($request->subspecialty > 0) {
                if ($request->profession == 1) {
                    $user->subspecialty = $request->subspecialty;
                }
            }
            $user->save();
            DB::connection('mysql')->commit();
        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return redirect('getting-started/grup');
    }

    public function grup(Request $request)
    {
        $user_id = Auth::user()->id;
        try {
            DB::connection('mysql')->beginTransaction();
            for ($i=0; $i<count($request->group); $i++) { 
                $is_exits = UserGroup::where('users_id',Auth::user()->id)->where('group_id', $request->group[$i])->first();
                if(empty($is_exits->id))
                {
                    UserGroup::insertGetId([
                        'users_id' => $user_id,
                        'group_id' => $request->group[$i],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'invitation' => 1
                    ]);
                }

            }
            DB::connection('mysql')->commit();
        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return redirect('getting-started/avatar');
    }


    public function avatar(Request $request)
    {

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($avatar,'user');
            $avatar = $image['file_original'];
            $avatar_thumb = $image['file_thumbnail'];
        }
        else
        {
            $avatar = 'assets/img/placeholder.jpg';
            $avatar_thumb = $avatar;
        }
        $telepon = $request->telepon;

        $user = User::find(Auth::user()->id);
        try {
            DB::connection('mysql')->beginTransaction();
            $user->avatar_ori = $avatar;
            $user->avatar_thumb = $avatar_thumb;
            $user->phone = $telepon;
            $user->save();
            DB::connection('mysql')->commit();
        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return redirect('getting-started/hubungkan-kepegawaian');
    }



    public function syncKepegawaian(Request $request)
    {           
        $data = $request->all();

        $pegawai_id = $data['pegawai_id'];
        $user_id = Auth::user()->id;

        /*CHECK USER*/
        $user_pegawai = User::where('employee_id',$pegawai_id)->first();
        if(!empty($user_pegawai->id))
            $is_pegawai_id_used = 1;
        else
            $is_pegawai_id_used = 0;

        if($is_pegawai_id_used == 0)
        {
            $user = User::find($user_id);
            try {
                DB::connection('mysql')->beginTransaction();
                $user->employee_id = $pegawai_id;
                $user->save();
                DB::connection('mysql')->commit();
            } catch (Exception $e) {
                DB::connection('mysql')->rollback();
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            }
            return redirect('getting-started/email-resmi');
        }
        else
        {
            $user_used_name = $user_pegawai->name;
            return redirect('getting-started/hubungkan-kepegawaian')->with('user_used', $user_used_name);
        }

    }


    public function emailOfficial(Request $request)
    {
        $data = $request->all();

        $email = $data['email'];
        $user_id = Auth::user()->id;

        $user_using_email = User::where('username',$email)->first();
        if(!empty($user_using_email->id))
            $is_email_used = 1;
        else
            $is_email_used = 0;

        if($is_email_used == 0)
        {
            $user = User::find($user_id);
            try {
                DB::connection('mysql')->beginTransaction();
                $user->username = $email;
                $user->save();
                DB::connection('mysql')->commit();
            } catch (Exception $e) {
                DB::connection('mysql')->rollback();
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            }
            if (in_array($user->profesi, [1, 2, 3])) {
                return redirect('getting-started/sip-str');
            } else {
                return redirect('home');
            }
        }
        else
        {
            $email_used = $user_using_email->username;
            return redirect('getting-started/email-resmi')->with('email_used', $email_used);
        }
    }

    public function noSIPSTR(Request $request)
    {
        $data = $request->all();

        $sip_str = $data['sip_str'];
        $user_id = Auth::user()->id;

        $user_using_sip = User::where('sip', $sip_str)->first();
        if(!empty($user_using_sip->id))
            $is_sip_used = 1;
        else
            $is_sip_used = 0;

        if($is_sip_used == 0)
        {
            $user = User::find($user_id);
            try {
                DB::connection('mysql')->beginTransaction();
                $user->sip = $sip_str;
                $user->save();
                DB::connection('mysql')->commit();
            } catch (Exception $e) {
                DB::connection('mysql')->rollback();
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            }
            if ($user->profesi == 1) {
                return redirect('getting-started/integrasi-dpjp');
            } else {
                return redirect('home');
            }
        }
        else
        {
            $sip_used = $user_using_sip->sip;
            return redirect('getting-started/sip-str')->with('sip_used', $sip_used);
        }
    }

    public function DPJP(Request $request)
    {
        $dokter_id = $request->dokter_id;
        $user_id = Auth::user()->id;

        
        $user = User::find($user_id);
        try {
            DB::connection('mysql')->beginTransaction();
            $user->dokter_id = $dokter_id;
            $user->save();
            DB::connection('mysql')->commit();

            $status = 1;
            $message = 'Sinkronisasi berhasil dilakukan!';
            $title = 'Sukses!';
            
            return redirect('/')
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = -1;
            $message = 'Gagal kesalahan server. Hubungi admin';
            $title = 'Gagal';

            return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        }
    }

}
