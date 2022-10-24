<?php

namespace App\Http\Controllers\Kasus\Kolaborator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kolaborator;
use App\Models\Kasus\Kasus;
use Auth;
use DB;
use Bugsnag;
use Carbon\Carbon;

class CreateController extends Controller
{
	public function create($nomor_kasus, Request $request)
	{
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
    		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
    		$user_id = $request->user_id;
            $message = $request->message;
    		
            $check_if_exist = $this->checkIfExist($kasus->id,$user_id);

            if($check_if_exist == 0)
            {
                $kolaborator = new Kolaborator();
                $kolaborator->kasus_id = $kasus->id;
                $kolaborator->user_id = $user_id;
                $kolaborator->invitation = 0;
                $kolaborator->message = $message;
                $kolaborator->created_by = Auth::user()->id;
                $kolaborator->save();
                
                $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                ->create($kasus->id,'create','kolaborator',$kolaborator->id);
            }
            $kasus->last_update_kolaborator = Carbon::now();
            $kasus->save();

            $notif = app('App\Http\Controllers\Users\Notification\CreateController')->create($user_id, Auth::user()->id, Auth::user()->name.' mengundang anda pada Kasus. '.$message, 'kasus/'.$kasus->nomor_kasus);


            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return 1;

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
	}

    private function checkIfExist($kasus_id,$user_id)
    {
        $kolab = Kolaborator::where('user_id',$user_id)->where('kasus_id',$kasus_id)->withTrashed()->first();
        if(!empty($kolab->id))
        {
            if($kolab->invitation == -1 || !empty($kolab->deleted_at))
            {
                $kolab->invitation = 0;
                $kolab->deleted_at = null;
                $kolab->save();
            }
            return $kolab->id;
        }
        return 0;
    }

    public function createWithStatus($kasus_id,$user_id,$status = 0,$creator = 0)
    {
         $kolaborator = new Kolaborator();
         $kolaborator->kasus_id = $kasus_id;
         $kolaborator->user_id = $user_id;
         $kolaborator->invitation = $status;
         $kolaborator->created_by = $creator;
         $kolaborator->save();
    }

    public function joinKasus(Request $request)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            $kasus = Kasus::find($request->kasus_id);
            $user_id = Auth::user()->id;
            
            $check_if_exist = $this->checkIfExist($kasus->id,$user_id);

            if($check_if_exist == 0)
            {
                $kolaborator = new Kolaborator();
                $kolaborator->kasus_id = $kasus->id;
                $kolaborator->user_id = $user_id;
                $kolaborator->invitation = 1;
                $kolaborator->created_by = Auth::user()->id;
                $kolaborator->save();
            }
            else
            {
                $kolaborator = app('App\Http\Controllers\Kasus\Kolaborator\EditController')
                ->updateStatus($check_if_exist,1);
            }
            $kasus->last_update_kolaborator = Carbon::now();
            $kasus->save();
            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasus->id,'create','kolaborator',$kolaborator->id,$kasus->id);

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            $status = 1;
            $message = 'Berhasil menjadi kolaborator';
            $title = 'Selamat Datang!';

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
            
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            $status = 1;
            $message = 'Kesalahan Server, gagal menjadi kolaborator. Silahkan coba lagi';
            $title = 'Sorry!';

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
    }
}
