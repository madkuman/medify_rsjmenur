<?php

namespace App\Http\Controllers\Users\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\Hospital\UserProfilePublic;
use Auth;
use DB;
use Bugsnag;

class PostController extends Controller
{
    public function account(Request $req){
    	$this->validator($req->all())->validate();

		try {
            DB::connection('mysql')->beginTransaction();

			$user = User::find(Auth::user()->id);
	    	$user->name = $req->name;
	    	$user->email = $req->email;
	    	if ($req->hasFile('avatar')) {
				$avatar = $req->file('avatar');
				$image = app('App\Http\Controllers\Functions\ImageUploader')->upload($avatar,'user');
				$avatar = $image['file_original'];
				$avatar_thumb = $image['file_thumbnail'];
				$user->avatar_ori = $avatar;
	    		$user->avatar_thumb = $avatar_thumb;
			}
            $user->phone = $req->phone;
			$user->save();
            DB::connection('mysql')->commit();

			$status = 1;
    		$message = 'Akun berhasil diubah!';
    		$title = 'Sukses!';

		} catch (Exception $e) {
            DB::connection('mysql')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}

		return back()
			->with('message', $message)
    		->with('title', $title)
    		->with('status', $status);
    }

    public function password(Request $req){
    	$user = User::find(Auth::user()->id);
    	// dd($req->new_pass);

    	if(!Hash::check($req->current_pass, $user->password)){
    		$status = -1;
    		$message = 'Password yang anda masukkan tidak sama dengan password saat ini';
    		$title = 'Gagal!';
    	}
    	elseif (strcmp($req->current_pass, $req->new_pass) == 0) {
    		$status = -1;
    		$message = 'Password baru tidak boleh sama dengan password sebelumnya';
    		$title = 'Gagal!';
    	}
    	elseif (strcmp($req->new_pass, $req->verify_pass) != 0) {
    		$status = -1;
    		$message = 'Pastikan password yang anda masukkan pada kolom Password Baru dan Verifikasi Password Baru sama';
    		$title = 'Gagal!';
    	}
    	else{
    		try {
                DB::connection('mysql')->beginTransaction();
    			$user->password = bcrypt($req->new_pass);
    			$user->save();
                DB::connection('mysql')->commit();
    		
	    		$status = 1;
	    		$message = 'Password berhasil diubah!';
	    		$title = 'Sukses!';

    		} catch (Exception $e) {
                DB::connection('mysql')->rollback();
    			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    		}
    	}

    	return back()
			->with('message', $message)
    		->with('title', $title)
    		->with('status', $status);
    }

    public function profession(Request $req){
    	try {
            DB::connection('mysql')->beginTransaction();
    		$user = User::find(Auth::user()->id);
    		$user->specialty = $req->specialty;
            $user->subspecialty = $req->subspecialty;
            $user->sip = $req->sip;
            $user->str = $req->str;
    		$user->save();
            DB::connection('mysql')->commit();

    		$status = 1;
    		$message = 'Profesi berhasil diubah!';
    		$title = 'Sukses!';

    	} catch (Exception $e) {
            DB::connection('mysql')->rollback();
    		app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    	}
    	
    	return back()
			->with('message', $message)
    		->with('title', $title)
    		->with('status', $status);
    }

    public function sync(Request $req){
        try {
            DB::connection('mysql')->beginTransaction();
            $user = User::find(Auth::user()->id);
            $user->employee_id = $req->employee;
            $user->save();
            DB::connection('mysql')->commit();

            $status = 1;
            $message = 'Sinkronisasi berhasil dilakukan!';
            $title = 'Sukses!';

        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
        
        return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
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
        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = -1;
            $message = 'Gagal kesalahan server. Hubungi admin';
            $title = 'Gagal';
        }

        return back()
        ->with('message', $message)
        ->with('title', $title)
        ->with('status', $status);
    }

    public function publication(Request $req)
    {
        $user = UserProfilePublic::where('users_id', Auth::user()->id)->first();

        try {
            DB::connection('mysql')->beginTransaction();

            if ($user === NULL) {
                $user = new UserProfilePublic;
                $user->users_id = Auth::user()->id;
            }
            if ($req->allow_publish === NULL) {
                $user->allow_publish = 0;
                $user->allow_pendidikan = 0;
                $user->allow_pelatihan = 0;
                $user->allow_karya = 0;
                $user->allow_skill = 0;
                $user->allow_kasus = 0;
                $user->allow_jadwal = 0;
            }
            else{
                $user->allow_publish = $req->allow_publish;
                if ($req->pendidikan === NULL) {
                    $user->allow_pendidikan = 0;
                }
                else{
                    $user->allow_pendidikan = 1;
                }
                if ($req->pelatihan === NULL) {
                    $user->allow_pelatihan = 0;
                }
                else{
                    $user->allow_pelatihan = 1;
                }
                if ($req->karya === NULL) {
                    $user->allow_karya = 0;
                }
                else{
                    $user->allow_karya = 1;
                }
                if ($req->skill === NULL) {
                    $user->allow_skill = 0;
                }
                else{
                    $user->allow_skill = 1;
                }
                if ($req->kasus === NULL) {
                    $user->allow_kasus = 0;
                }
                else{
                    $user->allow_kasus = 1;
                }
                if ($req->jadwal === NULL) {
                    $user->allow_jadwal = 0;
                }
                else{
                    $user->allow_jadwal = 1;
                }
            }
            
            $user->save();

            DB::connection('mysql')->commit();

            $status = 1;
            $message = 'Pengaturan berhasil disimpan!';
            $title = 'Sukses!';

        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
    }

    protected function validator(array $data)
    {
        $user = User::find(Auth::user()->id);
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id
        ]);
    }

    public function sip(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            DB::connection('mysql')->beginTransaction();
            $user = User::where('id',$user_id)->first();
            $user->sip = $request->sip;
            $user->save();
            DB::connection('mysql')->commit();

            $status = 1;
            $message = 'Informasi berhasil diubah!';
            $title = 'Sukses!';

        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
    }
    public function str(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            DB::connection('mysql')->beginTransaction();
            $user = User::where('id',$user_id)->first();
            $user->str = $request->str;
            $user->save();
            DB::connection('mysql')->commit();

            $status = 1;
            $message = 'Informasi berhasil diubah!';
            $title = 'Sukses!';

        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
    }

     public function tandaTangan(Request $req){
        try {
            DB::connection('mysql')->beginTransaction();
            $user = User::find(Auth::user()->id);
            $image = app('App\Http\Controllers\Functions\ImageUploader')->uploadBase64($req->ttd,'user');
            $user->ttd = $image;
            $user->save();
            DB::connection('mysql')->commit();

            $status = 1;
            $message = 'Tanda Tangan berhasil diubah!';
            $title = 'Sukses!';

        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = -1;
            $message = 'Tanda Tangan gagal diubah!';
            $title = 'Gagal!';
        }

        return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
    }

    public function perizinanAkses(Request $req){
        try {
            DB::connection('mysql')->beginTransaction();
            $user = User::find(Auth::user()->id);
            $user->user_allow_override = implode($req->user_allow_override, ',');
            $user->save();
            DB::connection('mysql')->commit();

            $status = 1;
            $message = 'Perubahan data berhasil!';
            $title = 'Sukses!';

        } catch (Exception $e) {
            DB::connection('mysql')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = -1;
            $message = 'Perubahan data gagal!';
            $title = 'Gagal!';
        }

        return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
    }
}
