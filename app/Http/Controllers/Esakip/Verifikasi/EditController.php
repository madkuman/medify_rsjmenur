<?php

namespace App\Http\Controllers\Esakip\Verifikasi;

use App\Models\Esakip\Dokumen;
use App\Models\Hospital\Grup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class EditController extends Controller
{
    public function verifikasi($id)
    {
        $dokumen = Dokumen::find($id);
        $admin = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserAdminInGroup(Grup::where('slug','e-sakip')->first()->id,Auth::user()->id);
        if($admin ==  1) {
            $dokumen->verified_admin_at = Carbon::now();
            $dokumen->verified_admin_by = Auth::user()->id;
            $user_jabatan = $dokumen->user->employee->MasterJabatan->parent->id ?? -2;
            $auth_jabatan = Auth::user()->employee->MasterJabatan->id ?? -1;
            if($user_jabatan == $auth_jabatan){
                $dokumen->verified_at = Carbon::now();
                $dokumen->verified_by = Auth::user()->id;
            }
        }else {
            $dokumen->verified_at = Carbon::now();
            $dokumen->verified_by = Auth::user()->id;
        }
        $dokumen->save();
        return $dokumen;
    }

    public function batalVerifikasi($id)
    {
        $dokumen = Dokumen::find($id);
        $admin = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserAdminInGroup(Grup::where('slug','e-sakip')->first()->id,Auth::user()->id);
        if($admin ==  1) {
            $dokumen->verified_admin_at = null;
            $dokumen->verified_admin_by = null;
            $user_jabatan = $dokumen->user->employee->MasterJabatan->parent->id ?? -2;
            $auth_jabatan = Auth::user()->employee->MasterJabatan->id ?? -1;
            if($user_jabatan == $auth_jabatan){
                $dokumen->verified_at = null;
                $dokumen->verified_by = null;
            }
        }else {
            $dokumen->verified_at = null;
            $dokumen->verified_by = null;
        }
        $dokumen->save();
        return $dokumen;
    }
}
