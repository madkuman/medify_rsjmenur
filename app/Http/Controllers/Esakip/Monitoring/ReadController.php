<?php

namespace App\Http\Controllers\Esakip\Monitoring;

use App\Models\Esakip\Dokumen;
use App\Models\Esakip\Kategori;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use App\Models\Kepegawaian\Pegawai;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DataTables;
use App\Support\Collection;

class ReadController extends Controller
{
    public function dataTable(Request $request)
    {
        $admin = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserAdminInGroup(Grup::where('slug','e-sakip')->first()->id,Auth::user()->id);
        $child = Auth::user()->employee->MasterJabatan->child->id ?? 0;
        $pegawai_id = Pegawai::where('jabatan_id',$child)->pluck('id') ?? [];
        if($admin == 0){
            $user_ids = User::whereIn('employee_id',$pegawai_id)->pluck('id') ?? [];
        }elseif ($admin == 1 && isset($request->atasan) && $request->atasan != 'all'){
            $child = User::find($request->atasan)->employee->MasterJabatan->child->id ?? 0;
            $pegawai_id = Pegawai::where('jabatan_id',$child)->pluck('id') ?? [];
            $user_ids = User::whereIn('employee_id',$pegawai_id)->pluck('id') ?? [];
        }
        else{
            $user_group = UserGroup::where('group_id',Grup::where('slug','e-sakip')->first()->id)->where('show',1)->get()->pluck('users_id')->toArray();
            $user_ids = User::whereIn('id',$user_group)->where('fake_account',0)->get()->pluck('id')->toArray();
        }

        //dd($data->get());
        $users= User::whereIn('id',$user_ids);

        //dd($$request->all());
        if(!empty($request->keyword)){
            $keyword = preg_replace("/[^[:alnum:][:space:]]/u", ' ', $request->keyword);
            $search = User::search($keyword)->take(10)->get()->pluck('id')->toArray();
            $users = $users->whereIn('id',$search);
        }

        $kategori = Kategori::find($request->kategori);
        if($request->status == 'belum'){
            $users = $users->whereHas('dokumenEsakip',function($cat) use($kategori,$request){
                $cat->from(config('app.db_name').'_esakip.dokumen')->where('kategori_id', $kategori->id)->where('tahun',$request->tahun);
            },'<',$kategori->max);
        }else{
            $users = $users->whereHas('dokumenEsakip',function($cat) use($kategori,$request){
                $cat->from(config('app.db_name').'_esakip.dokumen')->where('kategori_id', $kategori->id)->where('tahun',$request->tahun);
            },'=',$kategori->max);
        }

        $users = $users->with(['dokumenEsakip' => function ($q) use($request){
            $q->from(config('app.db_name').'_esakip.dokumen')->where('tahun',$request->tahun)->where('kategori_id',$request->kategori);
        },'dokumenEsakip.creator','dokumenEsakip.verified_admin','dokumenEsakip.verified_atasan','dokumenEsakip.kategori'])->paginate(10);

        $kategori = Kategori::all();
        $new_data = [];
        foreach ($users as $user){
            $new_data[$user->name] = [];
                foreach ($user->dokumenEsakip as $dokumen) {
                    if (!empty($dokumen->counter)) $new_data[$user->name][$dokumen->kategori->nama][$dokumen->counter - 1] = $dokumen;
                    else $new_data[$user->name][$dokumen->kategori->nama][] = $dokumen;
                }
        }

        $data['data'] = $new_data;
        $data['kategori'] = $kategori;
        $data['total'] = $users->total();
        return json_encode($data);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('pegawai', function ($data) {
                return $data->name;
            })
            ->addColumn('perjanjian_kinerja_dokumen', function ($data) {
                $dokumen = $data->dokumenEsakip->where('kategori_id',1) ?? [];
                $counter= 3 - count($dokumen);
                $content ='';
                foreach ($dokumen as $item) {
                    if ($item)
                        $content .= '<button type="button" class="btn btn-sm btn-circle btn-outline-primary " data-toggle="tooltip" data-html="true" title="Oleh : '.$item->creator->name.','.indonesian_date($item->created_at).','.date('H:i',strtotime($item->created_at)).'" data-placement="left">
                                                <i class="fa fa-check"></i>
                                            </button><br>';
                    else $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                for($i=0;$i<$counter;$i++){
                    $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                return $content;
            })
            ->addColumn('perjanjian_kinerja_verif1', function ($data) {
                $dokumen = $data->dokumenEsakip->where('kategori_id',1) ?? [];
                $counter= 3 - count($dokumen);
                $content ='';
                foreach ($dokumen as $item) {
                    if ($item && !empty($item->verified_at))
                        $content .= '<button type="button" class="btn btn-sm btn-circle btn-outline-primary " data-toggle="tooltip" data-html="true" title="Oleh : '.$item->verified_atasan->name.','.indonesian_date($item->verified_at).','.date('H:i',strtotime($item->verified_at)).'" data-placement="left">
                                                <i class="fa fa-check"></i>
                                            </button><br>';
                    else $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                for($i=0;$i<$counter;$i++){
                    $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                return $content;
            })
            ->addColumn('perjanjian_kinerja_verif2', function ($data) {
                $dokumen = $data->dokumenEsakip->where('kategori_id',1) ?? [];
                $counter= 3 - count($dokumen);
                $content ='';
                foreach ($dokumen as $item) {
                    if ($item && !empty($item->verified_admin_at))
                        $content .= '<button type="button" class="btn btn-sm btn-circle btn-outline-primary " data-toggle="tooltip" data-html="true" title="Oleh : '.$item->verified_admin->name.','.indonesian_date($item->verified_admin_at).','.date('H:i',strtotime($item->verified_admin_at)).'" data-placement="left">
                                                <i class="fa fa-check"></i>
                                            </button><br>';
                    else $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                for($i=0;$i<$counter;$i++){
                    $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                return $content;
            })
            ->addColumn('realisasi_kinerja_triwulan_dokumen', function ($data) {
                $dokumen = $data->dokumenEsakip->where('kategori_id',2) ?? [];
                $counter= 4;
                $content ='';
                for($i=1;$i<=$counter;$i++){
                    $check = 0;
                    foreach ($dokumen as $item) {
                        if ($item && $item->counter == $i) {
                            $content .= '<button type="button" class="btn btn-sm btn-circle btn-outline-primary " data-toggle="tooltip" data-html="true" title="Oleh : ' . $item->creator->name . ',' . indonesian_date($item->created_at) . ',' . date('H:i', strtotime($item->created_at)) . '" data-placement="left">
                                                    <i class="fa fa-check"></i>
                                                </button><br>';
                            $check ++;
                        }
                    }
                    if($check == 0)
                    $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                return $content;
            })
            ->addColumn('realisasi_kinerja_triwulan_verif1', function ($data) {
                $dokumen = $data->dokumenEsakip->where('kategori_id',2) ?? [];
                $counter= 4;
                $content ='';
                for($i=1;$i<=$counter;$i++){
                    $check = 0;
                    foreach ($dokumen as $item) {
                        if ($item && !empty($item->verified_at) && $item->counter == $i) {
                            $content .= '<button type="button" class="btn btn-sm btn-circle btn-outline-primary " data-toggle="tooltip" data-html="true" title="Oleh : ' . $item->verified_atasan->name . ',' . indonesian_date($item->verified_at) . ',' . date('H:i', strtotime($item->verified_at)) . '" data-placement="left">
                                                    <i class="fa fa-check"></i>
                                                </button><br>';
                        $check++;
                        }
                    }
                    if($check == 0)
                    $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                return $content;
            })
            ->addColumn('realisasi_kinerja_triwulan_verif2', function ($data) {
                $dokumen = $data->dokumenEsakip->where('kategori_id',2) ?? [];
                $counter= 4;
                $content ='';
                for($i=1;$i<=$counter;$i++){
                    $check = 0;
                    foreach ($dokumen as $item) {
                        if ($item && !empty($item->verified_admin_at) && $item->counter == $i) {
                            $content .= '<button type="button" class="btn btn-sm btn-circle btn-outline-primary " data-toggle="tooltip" data-html="true" title="Oleh : ' . $item->verified_admin->name . ',' . indonesian_date($item->verified_admin_at) . ',' . date('H:i', strtotime($item->verified_admin_at)) . '" data-placement="left">
                                                    <i class="fa fa-check"></i>
                                                </button><br>';
                            $check++;
                        }
                    }
                    if($check == 0)
                    $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                return $content;
            })
            ->addColumn('pengukuran_kinerja_dokumen', function ($data) {
                $dokumen = $data->dokumenEsakip->where('kategori_id',3) ?? [];
                $counter= 1 - count($dokumen);
                $content ='';
                foreach ($dokumen as $item) {
                    if ($item)
                        $content .= '<button type="button" class="btn btn-sm btn-circle btn-outline-primary " data-toggle="tooltip" data-html="true" title="Oleh : '.$item->creator->name.','.indonesian_date($item->created_at).','.date('H:i',strtotime($item->created_at)).'" data-placement="left">
                                                <i class="fa fa-check"></i>
                                            </button><br>';
                    else $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                for($i=0;$i<$counter;$i++){
                    $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                return $content;
            })
            ->addColumn('pengukuran_kinerja_verif1', function ($data) {
                $dokumen = $data->dokumenEsakip->where('kategori_id',3) ?? [];
                $counter= 1 - count($dokumen);
                $content ='';
                foreach ($dokumen as $item) {
                    if ($item && !empty($item->verified_at))
                        $content .= '<button type="button" class="btn btn-sm btn-circle btn-outline-primary " data-toggle="tooltip" data-html="true" title="Oleh : '.$item->verified_atasan->name.','.indonesian_date($item->verified_at).','.date('H:i',strtotime($item->verified_at)).'" data-placement="left">
                                                <i class="fa fa-check"></i>
                                            </button><br>';
                    else $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                for($i=0;$i<$counter;$i++){
                    $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                return $content;
            })
            ->addColumn('pengukuran_kinerja_verif2', function ($data) {
                $dokumen = $data->dokumenEsakip->where('kategori_id',3) ?? [];
                $counter= 1 - count($dokumen);
                $content ='';
                foreach ($dokumen as $item) {
                    if ($item && !empty($item->verified_admin_at))
                        $content .= '<button type="button" class="btn btn-sm btn-circle btn-outline-primary " data-toggle="tooltip" data-html="true" title="Oleh : '.$item->verified_admin->name.','.indonesian_date($item->verified_admin_at).','.date('H:i',strtotime($item->verified_admin_at)).'" data-placement="left">
                                                <i class="fa fa-check"></i>
                                            </button><br>';
                    else $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                for($i=0;$i<$counter;$i++){
                    $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                return $content;
            })
            ->addColumn('laporan_kinerja_dokumen', function ($data) {
                $dokumen = $data->dokumenEsakip->where('kategori_id',4) ?? [];
                $counter= 1 - count($dokumen);
                $content ='';
                foreach ($dokumen as $item) {
                    if ($item)
                        $content .= '<button type="button" class="btn btn-sm btn-circle btn-outline-primary " data-toggle="tooltip" data-html="true" title="Oleh : '.$item->creator->name.','.indonesian_date($item->created_at).','.date('H:i',strtotime($item->created_at)).'" data-placement="left">
                                                <i class="fa fa-check"></i>
                                            </button><br>';
                    else $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                for($i=0;$i<$counter;$i++){
                    $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                return $content;
            })
            ->addColumn('laporan_kinerja_verif1', function ($data) {
                $dokumen = $data->dokumenEsakip->where('kategori_id',4) ?? [];
                $counter= 1 - count($dokumen);
                $content ='';
                foreach ($dokumen as $item) {
                    if ($item && !empty($item->verified_at))
                        $content .= '<button type="button" class="btn btn-sm btn-circle btn-outline-primary " data-toggle="tooltip" data-html="true" title="Oleh : '.$item->verified_atasan->name.','.indonesian_date($item->verified_at).','.date('H:i',strtotime($item->verified_at)).'" data-placement="left">
                                                <i class="fa fa-check"></i>
                                            </button><br>';
                    else $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                for($i=0;$i<$counter;$i++){
                    $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                return $content;
            })
            ->addColumn('laporan_kinerja_verif2', function ($data) {
                $dokumen = $data->dokumenEsakip->where('kategori_id',4) ?? [];
                $counter= 1 - count($dokumen);
                $content ='';
                foreach ($dokumen as $item) {
                    if ($item && !empty($item->verified_admin_at))
                        $content .= '<button type="button" class="btn btn-sm btn-circle btn-outline-primary " data-toggle="tooltip" data-html="true" title="Oleh : '.$item->verified_admin->name.','.indonesian_date($item->verified_admin_at).','.date('H:i',strtotime($item->verified_admin_at)).'" data-placement="left">
                                                <i class="fa fa-check"></i>
                                            </button><br>';
                    else $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                for($i=0;$i<$counter;$i++){
                    $content .= '<span class="btn btn-sm btn-circle btn-outline-danger fa fa-close"></span><br>';
                }
                return $content;
            })
            ->escapeColumns([])
            ->make(true);
    }
}
