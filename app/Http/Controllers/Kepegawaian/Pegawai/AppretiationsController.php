<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Penghargaan;
use App\Models\Kepegawaian\Berkas;
use Carbon\Carbon;
use Alert,Auth;

class AppretiationsController extends Controller
{
  protected $itemPerPage = 10;
  protected $user;

  function __construct() {
    $this->user = \Auth::user();
  }

  public function index(Request $request, $id) {
    $pegawai = Pegawai::find($id);

    $items = Penghargaan::where('employee_id', $pegawai->id)->orderBy('tmt', 'desc')->paginate($this->itemPerPage);
    
    $htmlheader_title = 'Kepegawaian | Tanda Jasa';
    $contentheader_title = 'Data Tanda Jasa';

    $paginationParams = [];
    $is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);
    
    return view('kepegawaian.pegawai.tandajasa.index', compact(
      'pegawai',
      'items',
      'paginationParams',
      'htmlheader_title',
      'contentheader_title',
      'is_hrd_member'
    ));
  }

  public function store(Request $request, $id) {
  	$postdata = $request->toArray();
    if($postdata['name'] == null && $postdata['tmt'] == null && $postdata['st_number'] == null){
      return redirect()->route('appretiations', ['id' => $id, '_' => microtime(true)])->with('error', 'cannot save data');
    }

    $new_item = new Penghargaan;
    $new_item->name = $postdata['name'];
    $new_item->tmt = date('Y-m-d', strtotime($postdata['tmt']));
    $new_item->st_number = $postdata['st_number'];
    $new_item->status = false;
    $new_item->employee_id = $id;
    $new_item->created_by = \Auth::user()->id;
    if(!empty($postdata['certificate']))
      $new_item->certificate = self::uploadFile($postdata['certificate']);

    $ret_save = $new_item->save();

    if ( !$ret_save )
      Alert::error('Terjadi kesalahan saat menambahkan data tanda jasa. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data tanda jasa berhasil ditambahkan', 'Berhasil!');

    return redirect()->route('appretiations', ['id' => $id, '_' => microtime(true)]);
  }

  public function edit(Request $request, $id){
    $postdata = $request->toArray();

    $item = Penghargaan::find($id);
    $item->name = $postdata['name'];
    $item->tmt = date('Y-m-d', strtotime($postdata['tmt']));
    $item->st_number = $postdata['st_number'];
    $item->created_by = \Auth::user()->id;
    $ret_update = $item->update();
    $user_id = $item->employee_id;

    if ( !$ret_update )    
      Alert::error('Terjadi kesalahan saat mengubah data tanda jasa. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data tanda jasa berhasil diubah', 'Berhasil!');

    return redirect()->route('appretiations', ['id' => $user_id, '_' => microtime(true)]);
  }

  public function destroy($id){
    $item = Penghargaan::find($id);
    $user_id = $item->employee_id;
    $ret_delete = $item->delete();

    if ( !$ret_delete )    
      Alert::error('Terjadi kesalahan saat menghapus data tanda jasa. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data tanda jasa berhasil dihapus', 'Berhasil!');

    return redirect()->route('appretiations', ['id' => $user_id, '_' => microtime(true)]);
  }

  public function verification($id){
    $item = Penghargaan::find($id);
    $auth = \Auth::user();
    $verificator = Pegawai::where('user_id', $auth->id)->first();
    $item->status = true;
    $item->verificator = ($verificator ? $verificator->id : $auth->id);
    $item->is_employee = ($verificator ? true : false);
    $item->verified_at = Carbon::now();
    $ret_update = $item->update();
    $user_id = $item->employee_id;

    if ( !$ret_update )    
      Alert::error('Terjadi kesalahan saat memverifikasi data tanda jasa. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data tanda jasa berhasil diverifikasi', 'Berhasil!');

    return redirect()->route('appretiations', ['id' => $user_id, '_' => microtime(true)]);
  }

  private function uploadFile($thefile){
    $item = new Berkas();
    $item->filename = $thefile->getClientOriginalName();
    $item->mime = $thefile->getClientMimeType();
    $item->path = hash('sha256', time());
    $item->size = $thefile->getClientSize();
    $item->extension = $thefile->getClientOriginalExtension();
    $item->save();

    if($thefile) {
      $filename = (string)$item->id.'.'.$thefile->getClientOriginalExtension();
      $destination_path = public_path('/uploads/kepegawaian/tandajasa');
      $thefile->move($destination_path, $filename);
      $item->save();
    }

    return $item->id;
  }

  public function getFile($emp, $id) {
    $thefile = Berkas::find($id);
    $extension = $thefile->extension;
    $filename = $id.'.'.$extension;
    $destination_path = public_path('/uploads/kepegawaian/tandajasa');

    if(file_exists($destination_path.'/'.$filename)) {
      return response()->file($destination_path.'/'.$filename);
    }
    else {
      Alert::error('Sertifikat tanda jasa tidak ditemukan', 'Gagal!');

      return redirect()->route('appretiations', ['id' => $emp]);
    }
  }
}
