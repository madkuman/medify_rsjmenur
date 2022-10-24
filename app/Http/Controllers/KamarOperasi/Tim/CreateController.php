<?php

namespace App\Http\Controllers\KamarOperasi\Tim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Tim;
use App\Models\KamarOperasi\Transaksi;
use DB;

class CreateController extends Controller
{
    public function syncTim(Request $request)
    {
        $users = array_filter($request->input('namatim'));
        $roles = $request->input('peran');
        $operasi_id = $request->input('id');
        $tim_userid = Tim::withTrashed()->where('operasi_id', $operasi_id)->pluck('user_id')->toArray();
        $ada = array_intersect($tim_userid, $users);
        $tobedeleted = array_diff($tim_userid, $users);

        $connection = DB::connection('kamaroperasi');
        $connection->beginTransaction();
        try {
            foreach ($users as $i => $user)
            {
                if (in_array(intval($user), $ada))
                {
                    $tim = Tim::withTrashed()->where('operasi_id', $operasi_id)->where('user_id', $user)->first();
                    $tim->role_id = $roles[$i];
                    $tim->deleted_at = null;
                    $tim->save();
                }
                else
                {
                    $tim = new Tim;
                    $tim->operasi_id = $operasi_id;
                    $tim->user_id = $user;
                    $tim->role_id = $roles[$i];
                    $tim->save();
                }
            }

            foreach ($tobedeleted as $user_deleted)
            {
                $tim = Tim::where('operasi_id', $operasi_id)->where('user_id', $user_deleted)->first();
                if ($tim)
                {
                    $tim->delete();
                }
            }
            // $syncdata = array_combine($users, $temp);
            // $operasi->user()->sync($syncdata);
            $connection->commit();

            $status = 1;
            $message = 'Anggota Tim Berhasil Diperbaharui.';
            $title = 'Berhasil!';

            return redirect('kamaroperasi/pelaksanaan/'.$operasi_id.'#tim')
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        } catch (\Exception $e) {
            $connection->rollback();

            $status = -1;
            $message = $e;
            $title = 'Error!';

            return redirect('kamaroperasi/pelaksanaan/'.$operasi_id.'#tim')
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        }
    }
}
