<?php

namespace App\Http\Controllers\Esakip\Dashboard;

use App\Models\Esakip\Dokumen;
use App\Models\Esakip\Kategori;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Jabatan;
use App\User;
use Auth;
use DataTables;

class ReadController extends Controller
{
    public function dataTable(Request $request)
    {
        $admin = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserAdminInGroup(Grup::where('slug','e-sakip')->first()->id,Auth::user()->id);
        $data = Dokumen::where('tahun',$request->tahun)->with('kategori','user');
        if  ($admin == 0) {
            $data->where('user_id',Auth::user()->id);
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
                if(!empty($data->verified_at)) $content .= '<span class="badge badge-primary">Sudah Terverifikasi Atasan</span><br> ';
                else $content .= '<span class="badge badge-warning">Belum Terverifikasi Atasan</span>';
                if(!empty($data->verified_admin_at)) $content .= '<span class="badge badge-primary">Sudah Terverifikasi Admin</span><br> ';
                else $content .= '<span class="badge badge-warning">Belum Terverifikasi Admin</span>';
                return $content;
            })
            ->addColumn('aksi', function ($data) {
                $handler = '';
                if(!empty($data->verified_at) || !empty($data->verified_admin_at)) $handler = 'disabled';
                $aksi = '<div class="btn-group">
                            <button type="button" class="btn btn-sm btn-primary js-tooltip-enabled mr-5" onclick="lihatDokumen(this)" data-toggle="tooltip" title="Lihat File" data-original-title="Ubah" data-path="'.$data->path.'">
                                   Lihat File
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-edit mr-5" '.$handler.' onclick="editDokumen(this)" data-toggle="tooltip" title="Ubah" data-original-title="Ubah" data-id="'.$data->id.'" data-kategori="'.$data->title.'" data-pegawai="'.$data->user->name.'" data-tahun="'.$data->tahun.'">
                                   <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled btn-delete" '.$handler.' onclick="deleteDokumen(this)" data-toggle="tooltip" title="Hapus" data-original-title="Hapus" data-id="'.$data->id.'">
                                   <i class="fa fa-trash"></i>
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

    public function validation($data)
    {
        $user_id = isset($data->user_id) ? $data->user_id : Auth::user()->id;
        $kategori = Kategori::find($data->kategori_id);
        $tahun = $data->tahun;
        $dokumen = Dokumen::where('user_id',$user_id)->where('tahun',$tahun)->where('kategori_id',$kategori->id)->get();
        if(count($dokumen) < $kategori->max) return count($dokumen) + 1;
        else return 'Gagal! Melebih batas upload pada kategori tersebut';

    }
}
