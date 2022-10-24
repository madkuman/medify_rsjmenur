<?php

namespace App\Http\Controllers\MobileAPI\Pasien\Auth\Register;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserPasien;
use Response;

class PostController extends Controller
{
	public function register(Request $request){

        $data = new UserPasien();
       	$data->ktp = $request->ktp;
        $data->first_name = $request->firstname;
        $data->last_name = $request->lastname;
        $data->nama = $request->firstname.' '.$request->lastname;
        $data->email = $request->email;
    	$data->alamat = $request->alamat;
    	$data->tempat_lahir = $request->birthplace;
    	$data->no_hp = $request->phone;
        $data->device = $request->device_token_medify;

        $new_date = date('Y-m-d', strtotime($request->birthdate));
    	$data->tanggal_lahir = $new_date;


        if($data->save()){
            $code = substr(str_shuffle("0123456789"), 0, 4);
           	//app('App\Http\Controllers\Pasien\Auth\OTPController')->sendOTP($request->phone, $code);
            $this->deviceTokenCheck($request->device_token_medify, $request->phone);
            return Response::json(['status' => '1', 
                                    'message' => 'Kode telah terikirim ke nomor 0'.$request->phone,
                                    'user' => $data]);
        }else{
            return Response::json(['status' => '0', 'message' => 'Data gagal disave']);
        }
    }

    public function uploadFotoAvatar(Request $request){

        $data = UserPasien::where('no_hp','=',$request->phone)->first();

        try {
            $image=$request->avatar;
            $filename  = date('m-d-Y_hia').'.'.$image->getClientOriginalExtension();
            $path = public_path('/photos/avatar/'.$data->id);
            $image->move($path, 'avatar_'.$filename);
        } catch (\Exception $e) {
            return Response::json(['status' => '-1', 'message' => 'Gagal upload Foto']);
        }
        $data->avatar = 'photos/avatar/'.$data->id.'/avatar_'.$filename;

        if($data->save()){
            return Response::json(['status' => '1', 'message' => 'Foto berhasil terupload', 'url' => $data->avatar]);
        }else{
            return Response::json(['status' => '0', 'message' => 'Gagal menyimpan foto']);
        }
    }

    public function uploadFotoKtp(Request $request){

        // $data = Auth::user();
        $data = UserPasien::where('no_hp', $request->phone)->first();
        try {
            $image=$request->foto_ktp;
            $filename  = date('m-d-Y_hia').'.'.$image->getClientOriginalExtension();
            $path = public_path('/photos/ktp/'.$data->id);
            $image->move($path, 'ktp_'.$filename);
        } catch (\Exception $e) {
            return Response::json(['status' => '-1', 'message' => 'Gagal upload KTP']);
        }

        $data->foto_ktp = 'photos/ktp/'.$data->id.'/ktp_'.$filename;

        if($data->save()){
            return Response::json(['status' => '1', 'message' => 'Foto berhasil terupload', 'url' => $data->foto_ktp]);
        }else{
            return Response::json(['status' => '0', 'message' => 'Gagal menyimpan foto']);
        }
    }

    public function deviceTokenCheck($device,$phone)
    {
        $isDeviceExist = UserPasien::where('device', $device)->where('no_hp', '!=', $phone)->get();

        /*JIKA ADA MAKA HAPUS DEVICE PADA ID USER SEBELUMNYA MUNGKIN DIA LOGIN PAKE DEVICE LAIN*/
        foreach($isDeviceExist as $user){
                $user->device = NULL;
                $user->save();
        }

        /*MASUKKAN DEVICE TOKEN KE USER BARU*/
        $user = UserPasien::where('device', $device)->where('no_hp', $phone)->first();
        $user->device = $device;
        $user->save();
        return 1;
    }
}
