<?php

namespace App\Http\Controllers\Esakip\Verifikasi;

use App\Models\Esakip\Dokumen;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use App\Models\Kepegawaian\Pegawai;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Jabatan;
use Auth;
use DataTables;

class ReadController extends Controller
{
    public function dataTable(Request $request)
    {
        $admin = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserAdminInGroup(Grup::where('slug','e-sakip')->first()->id,Auth::user()->id);
        $data = Dokumen::where('tahun',$request->tahun)->with('kategori','user');
        $child = Auth::user()->employee->MasterJabatan->child->id ?? 0;
        $pegawai_id = Pegawai::where('jabatan_id',$child)->pluck('id') ?? [];
        $user_id = User::whereIn('employee_id',$pegawai_id)->pluck('id') ?? [];
        if($admin == 0){
            $data= $data->whereIn('user_id',$user_id);
        } else {
            $auth_group = UserGroup::where('group_id',Grup::where('slug','e-sakip')->first()->id)->where('users_id',Auth::user()->id)->first();
            if($auth_group->e_sakip){
                $auth_group = json_decode($auth_group->e_sakip);
            }else{
                $auth_group = [];
            }
            $user_group = UserGroup::where('group_id',Grup::where('slug','e-sakip')->first()->id)->get()->pluck('users_id')->toArray();
            $user_id = User::whereIn('id',$user_group)->where('fake_account',0)->get()->pluck('id')->toArray();
            $data->whereIn('user_id',$user_id)->whereIn('kategori_id',$auth_group);
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('pegawai', function ($data) {
                return $data->user->name;
            })
            ->addColumn('status', function ($data) {
                $content = '';
                if(!empty($data->verified_at)) $content .= '<span class="badge badge-primary">Sudah Terverifikasi Atasan</span> <br>';
                else $content .= '<span class="badge badge-warning">Belum Terverifikasi Atasan</span><br>';
                if(!empty($data->verified_admin_at)) $content .= '<span class="badge badge-primary">Sudah Terverifikasi Admin</span> ';
                else $content .= '<span class="badge badge-warning">Belum Terverifikasi Admin</span>';
                return $content;
            })
            ->addColumn('aksi', function ($data) {
                $admin = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserAdminInGroup(Grup::where('slug','e-sakip')->first()->id,Auth::user()->id);
                if($admin == 0) {
                    if (!empty($data->verified_at)) {
                        $verifikasi = 'd-none';
                        $batal_verifikasi = '';
                    } else {
                        $verifikasi = '';
                        $batal_verifikasi = 'd-none';
                    }
                }else{
                    if (!empty($data->verified_admin_at)) {
                        $verifikasi = 'd-none';
                        $batal_verifikasi = '';
                    } else {
                        $verifikasi = '';
                        $batal_verifikasi = 'd-none';
                    }
                }
                $aksi = '<div class="btn-group">
                            <button type="button" class="btn btn-sm btn-primary js-tooltip-enabled mr-5" onclick="lihatDokumen(this)" data-toggle="tooltip" title="Lihat File" data-original-title="Ubah" data-path="'.$data->path.'">
                                   Lihat File
                            </button>
                            <button type="button" class="btn btn-sm btn-success btn-verifikasi '.$verifikasi.'"  onclick="verifikasi(this)" data-toggle="tooltip" title="verifikasi" data-original-title="Ubah" data-id="'.$data->id.'">
                                   <i class="fa fa-check"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger btn-batal-verifikasi '.$batal_verifikasi.'"  onclick="batalVerifikasi(this)" data-toggle="tooltip" title="batal-verifikasi" data-original-title="Ubah" data-id="'.$data->id.'">
                                   <i class="fa fa-close"></i>
                            </button>
                         </div';

                return $aksi;
            })
            ->filterColumn('pegawai', function ($query, $keyword) {
                $query->whereHas('user', function ($subquery) use ($keyword) {
                    $subquery->from(config('app.db_name') . '.users')->where('name', 'LIKE', "%$keyword%")
                        ->orWhere('name', 'LIKE', "%$keyword%");
                });
            })
            ->escapeColumns([])
            ->make(true);
    }
}
