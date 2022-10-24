<?php

namespace App\Http\Controllers\Laundry\Permintaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Laundry\Transaksi;
use App\Models\Laundry\TransaksiDetail;
use App\Models\Laundry\PenanggungJawab;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;

use DB;
use Bugsnag;

class PostController extends Controller
{

    public function PostPermintaan(Request $request)
    {
        DB::connection('laundry')->beginTransaction();
        try{
            // dd($request);
            $jumlah = $request->input('jumlah');
            $permintaan = array(
                'isi' => array(),
                'grup' => $request->input('grup')
                );
            $counter = 1;
            // dd($request->input('barang')[0]);
            for ($i=0; $i <= $jumlah; $i++) {
                $isinya = $request->input('barang');
                if(array_key_exists($i, $isinya))
                {
                    $permintaan['isi'][$counter] = array(
                    'barang'.$counter => $request->input('barang')[$i][1],
                    'ket'.$counter => $request->input('ket', '-')[$i],
                    'barang_id' => $request->input('barang')[$i][0]
                    );
                    $counter++;
                }
            }
            $permintaan['jumlah'] = (string)$counter-1;
            // dd($permintaan);
            $add_permintaan = app('App\Http\Controllers\Laundry\Permintaan\EditController')->addPermintaan($permintaan);

            //notifikasi
            $laundry_id = Grup::where('name', 'Laundry')->first()->id;
            $user_id = UserGroup::where('group_id', $laundry_id)->pluck('users_id')->toArray();
            foreach ($user_id as $key) {
                $notif = app('App\Http\Controllers\Users\Notification\CreateController')->create($key, 1, "Barang baru telah ditambah ke Laundry!", 'laundry/dashboard');
            }

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Penerimaan Laundry berhasil';
            $data['url'] = 'laundry/permintaan/detil-permintaan/'.$add_permintaan['id'];
            DB::connection('laundry')->commit();
        }

        catch (\Exception $e) {
            DB::connection('laundry')->rollback();
            Bugsnag::notifyException($e);
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Permintaan gagal diproses : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
            $data['line'] = $e->getLine();
        }

        return json_encode($data);
    }

    public function EditTransaksi(Request $request)
    {
        DB::connection('laundry')->beginTransaction();
        try{
            // dd($request);
            $jumlah = $request->input('jumlah');
            $permintaan = array(
                'isi' => array()
                );

            for ($i=1; $i <= $jumlah; $i++) {
                $permintaan['isi'][$i] = array(
                    'barang'.$i => $request->input('barang')[$i],
                    'ket'.$i => $request->input('ket', '-')[$i],
                    'detail'.$i => $request->input('detail_id')[$i],
                    );
                }
            $permintaan['id'] = $request->input('id');
            $permintaan['jumlah'] = $jumlah;
            // dd($permintaan);

            $edit_laundry = app('App\Http\Controllers\Laundry\Permintaan\EditController')->editLaundry($permintaan);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Penerimaan Laundry berhasil';
            $data['url'] = 'laundry/permintaan/detil-permintaan/'.$permintaan['id'];
            DB::connection('laundry')->commit();

        }

        catch (\Exception $e) {
            DB::connection('laundry')->rollback();
            Bugsnag::notifyException($e);
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Layanan gagal didaftarkan : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
        }

        return json_encode($data);
    }

    public function EditProsesCuciTransaksi(Request $request)
    {
        DB::connection('laundry')->beginTransaction();
        try{
            // dd($request);
            $jumlah = $request->input('jumlah');
            $permintaan = array(
                'isi' => array()
                );

            for ($i=1; $i <= $jumlah; $i++) {
                $permintaan['isi'][$i] = array(
                    'barang'.$i => $request->input('barang')[$i],
                    'ket'.$i => $request->input('ket', '-')[$i],
                    'detail'.$i => $request->input('detail_id')[$i],
                    );
                }
            $permintaan['id'] = $request->input('id');
            $permintaan['jumlah'] = $jumlah;
            // dd($permintaan);

            $edit_laundry = app('App\Http\Controllers\Laundry\Permintaan\EditController')->editProsesCuciLaundry($permintaan);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Penerimaan Laundry berhasil';
            $data['url'] = 'laundry/permintaan/detil-permintaan/'.$permintaan['id'];
            DB::connection('laundry')->commit();

        }

        catch (\Exception $e) {
            DB::connection('laundry')->rollback();
            Bugsnag::notifyException($e);
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Layanan gagal didaftarkan : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
        }

        return json_encode($data);
    }

    public function DeleteTransaksi(Request $request)
    {
        DB::connection('laundry')->beginTransaction();
        try{

            $permintaan['id'] = $request->input('id');

            $edit_laundry = app('App\Http\Controllers\Laundry\Permintaan\DeleteController')->DeletePermintaan($permintaan);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Penghapusan permintaan berhasil';
            $data['url'] = 'laundry/dashboard';
            DB::connection('laundry')->commit();

        }

        catch (\Exception $e) {
            DB::connection('laundry')->rollback();
            Bugsnag::notifyException($e);
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Permintaan gagal dihapus : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
        }

        return json_encode($data);
    }

    public function PostDetailTransaksi(Request $request)
    {
    	DB::connection('laundry')->beginTransaction();
        try{
            // dd($request);
            $jumlah = $request->input('jumlah');
            $permintaan = array(
            	'isi' => array()
            	);

            for ($i=1; $i <= $jumlah; $i++) {
            	$permintaan['isi'][$i] = array(
            		'barang'.$i => $request->input('barang')[$i],
            		'ket'.$i => $request->input('ket', '-')[$i],
            		'detail'.$i => $request->input('detail_id')[$i],
            		);
            	}
            $permintaan['id'] = $request->input('id');
            $permintaan['jumlah'] = $jumlah;
            // dd($permintaan);

            $accept_laundry = app('App\Http\Controllers\Laundry\Permintaan\EditController')->acceptLaundry($permintaan);
            $update_permintaan = app('App\Http\Controllers\Laundry\Permintaan\EditController')->updatePermintaan($permintaan['id']);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Penerimaan Laundry berhasil';
            $data['url'] = 'laundry/permintaan/detil-permintaan/'.$permintaan['id'];
            DB::connection('laundry')->commit();

        }

        catch (\Exception $e) {
            DB::connection('laundry')->rollback();
            Bugsnag::notifyException($e);
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Layanan gagal didaftarkan : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
        }

        return json_encode($data);
    }

    public function Reject(Request $request){
      DB::connection('laundry')->beginTransaction();
        try{
            $permintaan = array(
              'keterangan_tolak' => $request->input('keterangan_tolak'),
              'idTransaksi' => $request->input('idTransaksi')
              );

            $reject_laundry = app('App\Http\Controllers\Laundry\Permintaan\EditController')->rejectLaundry($permintaan);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Penolakan laundry berhasil';
            $data['url'] = 'laundry/transaksi';
            DB::connection('laundry')->commit();
        }

        catch (\Exception $e) {
            DB::connection('laundry')->rollback();
            Bugsnag::notifyException($e);
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Layanan gagal didaftarkan : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
        }

        return json_encode($data);
    }
}
