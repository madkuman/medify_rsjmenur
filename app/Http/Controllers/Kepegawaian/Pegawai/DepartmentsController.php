<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\RiwayatJabatan;
use App\Models\Kepegawaian\KasalPosition;
use App\Models\Kepegawaian\InternPosition;
use App\Models\Kepegawaian\MasterJabatanKasal;
use App\Models\Kepegawaian\MasterJabatanIntern;
use App\Models\Kepegawaian\PNS;

use Alert,Auth;

class DepartmentsController extends Controller
{
  protected $itemPerPage = 10;
  protected $user;

  function __construct() {
    $this->user = \Auth::user();
  }

  public function index(Request $request, $id) {
    $pegawai = Pegawai::find($id);

    $items = RiwayatJabatan::where('employee_id', $pegawai->id)->orderBy('tmt', 'desc')->paginate($this->itemPerPage);

    $htmlheader_title = 'Kepegawaian | Jabatan';
    $contentheader_title = 'Data Jabatan';
    $master_jabatan_kasal = MasterJabatanKasal::all();
    $master_jabatan_intern = MasterJabatanIntern::all();

    $paginationParams = [];
    $is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);

    return view('kepegawaian.pegawai.jabatan.index', compact(
      'is_hrd_member',
      'pegawai',
      'items',
      'paginationParams',
      'htmlheader_title',
      'master_jabatan_intern',
      'master_jabatan_kasal',
      'contentheader_title'
    ));
  }

  public function store(Request $request, $id) {
    $postdata = $request->toArray();
    if($postdata['nama'] == null && $postdata['tmt'] == null && $postdata['st_number'] == null){
      return redirect()->route('departments', ['id' => $id, '_' => microtime(true)])->with('error', 'cannot save data');
    }

    $new_item = new RiwayatJabatan;
    $new_item->nama = $postdata['nama'];
    $new_item->tmt = date('Y-m-d', strtotime($postdata['tmt']));
    $new_item->st_number = $postdata['st_number'];
    $new_item->employee_id = $id;

    $ret_save = $new_item->save();

    if ( !$ret_save )
      Alert::error('Terjadi kesalahan saat menambahkan data jabatan. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data jabatan berhasil ditambahkan', 'Berhasil!');
    
    return back();
  }

  public function edit(Request $request, $id) {
    $postdata = $request->toArray();

    $item = RiwayatJabatan::find($id);
    $item->st_number = $postdata['st_number'];
    $item->tmt = date('Y-m-d', strtotime($postdata['tmt']));
    $item->nama = $postdata['nama'];

    $ret_update = $item->update();
    $user_id = $item->employee_id;

    if ( !$ret_update )    
      Alert::error('Terjadi kesalahan saat mengubah data jabatan. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data jabatan berhasil diubah', 'Berhasil!');

    return back();
  }

  public function destroy($id) {
    $item = RiwayatJabatan::find($id);
    $user_id = $item->employee_id;
    $ret_delete = $item->delete();

    if ( !$ret_delete )    
      Alert::error('Terjadi kesalahan saat menghapus data jabatan. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data jabatan berhasil dihapus', 'Berhasil!');

    return back();
  }


  public function editKasal(Request $request, $id) {
    $postdata = $request->toArray();

    $jabatan_kasal = MasterJabatanKasal::where('nama',$postdata['jabatan'])->first();
    if(!empty($jabatan_kasal->order)) $jabatan_kasal_order = $jabatan_kasal->order;
    else $jabatan_kasal_order = 99;

    $item = Pegawai::find($id);
    $item->departemen = $postdata['departemen'];
    $item->jabatan = $postdata['jabatan'];
    $item->st_kasal_no_st = $postdata['st_kasal_no_st'];
    $item->st_kasal_no_sp = $postdata['st_kasal_no_sp'];
    $item->st_kasal_tgl_sp = date('Y-m-d', strtotime($postdata['sp_date']));
    $item->print_order = $jabatan_kasal_order;

    $ret_update = $item->update();
    $user_id = $item->employee_id;
    $create = app('App\Http\Controllers\Kepegawaian\MasterJabatanKasal\CreateController')->new($postdata['jabatan']);


    if ( !$ret_update )    
      Alert::error('Terjadi kesalahan saat mengubah data jabatan sesuai ST KASAL. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data jabatan sesuai ST KASAL berhasil diubah', 'Berhasil!');

    return back();
  }

  public function editIntern(Request $request, $id){
    $postdata = $request->toArray();

    $item = Pegawai::find($id);
    $item->intern_dep = $postdata['intern_dep'];
    $item->intern_jabatan = $postdata['intern_jabatan'];
    $item->intern_no_sp = $postdata['intern_no_sp'];
    $item->intern_tgl_sp = date('Y-m-d', strtotime($postdata['intern_tgl_sp']));

    $ret_update = $item->update();
    $user_id = $item->employee_id;
    $create = app('App\Http\Controllers\Kepegawaian\MasterJabatanIntern\CreateController')->new($postdata['intern_jabatan']);

    if ( !$ret_update )    
      Alert::error('Terjadi kesalahan saat mengubah data jabatan intern. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data jabatan intern berhasil diubah', 'Berhasil!');

    return back();
  }

  public function editPns(Request $request, $id){
    $postdata = $request->toArray();

    $item = Pegawai::find($id);
    $item->departemen = $postdata['departemen'];
    $item->jabatan = $postdata['jabatan'];
    $item->pns_jabatan_fungsional = $postdata['pns_jabatan_fungsional'];

    $ret_update = $item->update();
    $user_id = $item->employee_id;

    if ( !$ret_update )    
      Alert::error('Terjadi kesalahan saat mengubah data jabatan khusus PNS. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data jabatan khusus PNS berhasil diubah', 'Berhasil!');

    return back();
  }
}
