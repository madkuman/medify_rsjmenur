<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Pangkat;
use App\Models\Kepegawaian\MasterPangkat;
use Carbon\Carbon;
use Alert,Auth;

class PositionsController extends Controller
{
  protected $itemPerPage = 10;
  protected $user;

  function __construct() {
    $this->user = \Auth::user();
  }

  public function index(Request $request, $id) {
    $pegawai = Pegawai::find($id);
    $master_pangkat = MasterPangkat::get();

    $items = Pangkat::where('employee_id', $pegawai->id)->orderBy('tmt', 'DESC')->paginate($this->itemPerPage);

    $htmlheader_title = 'Kepegawaian | Pangkat';
    $contentheader_title = 'Data Pangkat';

    $paginationParams = [];
    $is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);

    return view('kepegawaian.pegawai.pangkat.index', compact(
      'is_hrd_member',
      'pegawai',
      'master_pangkat',
      'items',
      'paginationParams',
      'htmlheader_title',
      'contentheader_title'
    ));
  }

  public function store(Request $request, $id) {
    $postdata = $request->toArray();
    if($postdata['mposition_id'] == null && $postdata['tmt'] == null && $postdata['salary'] == null){
      return redirect()->route('positions', ['id' => $id, '_' => microtime(true)])->with('error', 'cannot save data');
    }

    $new_item = new Pangkat;
    $new_item->nama = $postdata['mposition_id'];
    $new_item->employee_id = $id;
    $new_item->korps = $postdata['korps'];
    $new_item->tmt = date('Y-m-d', strtotime($postdata['tmt']));
    $new_item->salary = str_replace(',','',$postdata['salary']);
    $new_item->supervisor = $postdata['supervisor'];
    $new_item->letter_number = $postdata['letter_number'];
    $new_item->letter_date = date('Y-m-d', strtotime($postdata['letter_date']));
    $ret_save = $new_item->save();

    $update_pangkat_employee = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updateLastPangkat($new_item->employee_id);


    if ( !$ret_save )
      Alert::error('Terjadi kesalahan saat menambahkan data pangkat. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data pangkat berhasil ditambahkan', 'Berhasil!');

    return redirect()->route('positions', ['id' => $id, '_' => microtime(true)]);
  }

  public function edit(Request $request, $id){
    $postdata = $request->toArray();


    $item = Pangkat::find($id);
    $item->nama = $postdata['mposition_id'];
    $item->korps = $postdata['korps'];
    $item->tmt = date('Y-m-d', strtotime($postdata['tmt']));
    $item->salary = $postdata['salary'];
    $item->supervisor = $postdata['supervisor'];
    $item->letter_number = $postdata['letter_number'];
    $item->letter_date = date('Y-m-d', strtotime($postdata['letter_date']));
    $ret_update = $item->update();
    $user_id = $item->employee_id;

    $update_pangkat_employee = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updateLastPangkat($item->employee_id);

    if ( !$ret_update )    
      Alert::error('Terjadi kesalahan saat mengubah data pangkat. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data pangkat berhasil diubah', 'Berhasil!');

    return redirect()->route('positions', ['id' => $user_id, '_' => microtime(true)]);
  }

  public function destroy($id){
    $item = Pangkat::find($id);
    $user_id = $item->employee_id;
    $ret_delete = Pangkat::find($id)->delete();

    $update_pangkat_employee = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updateLastPangkat($item->employee_id);


    if ( !$ret_delete )    
      Alert::error('Terjadi kesalahan saat menghapus data pangkat. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data pangkat berhasil dihapus', 'Berhasil!');

    return redirect()->route('positions', ['id' => $user_id, '_' => microtime(true)]);
  }
}
