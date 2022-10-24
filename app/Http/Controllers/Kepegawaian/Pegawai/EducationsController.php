<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Education;
use App\Models\Kepegawaian\Meducation;
use App\Models\Kepegawaian\MilitaryEducation;
use App\Models\Kepegawaian\Berkas;
use Carbon\Carbon;
use Alert,Auth;

class EducationsController extends Controller 
{
  protected $itemPerPage = 10;
  protected $user;

  function __construct() {
    $this->user = \Auth::user();
  }

  public function index(Request $request, $id) {
    $pegawai = Pegawai::find($id);

    $items = Education::where('employee_id', $pegawai->id)->orderBy('tmt', 'desc')->paginate($this->itemPerPage);
    $items2 = MilitaryEducation::where('employee_id', $pegawai->id)->orderBy('tmt', 'desc')->paginate($this->itemPerPage);

    $htmlheader_title = 'Kepegawaian | Pendidikan';
    $contentheader_title = 'Data Pendidikan';

    $paginationParams = [];

    $is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);

    return view('kepegawaian.pegawai.pendidikan.index', compact(
      'pegawai',
      'items',
      'items2',
      'paginationParams',
      'htmlheader_title',
      'contentheader_title',
      'is_hrd_member'
    ));
  }

  public function store(Request $request, $id) {
  	$postdata = $request->toArray();
    if($postdata['name'] == null && $postdata['tmt'] == null && $postdata['place'] == null){
      return redirect()->route('educations', ['id' => $id, '_' => microtime(true)])->with('error', 'cannot save data');
    }

    $new_item = new Education;
    $new_item->name = $postdata['name'];
    $new_item->employee_id = $id;
    $new_item->tmt = (int)$postdata['tmt'];
    $new_item->place = $postdata['place'];
    $new_item->status = false;
    $new_item->created_by = \Auth::user()->id;

    if(!empty($postdata['certificate']))
      $new_item->certificate = self::uploadFile($postdata['certificate']);

    $ret_save = $new_item->save();

    $update_pendidikan = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updatePendidikan($new_item->employee_id);


    if ( !$ret_save )
      Alert::error('Terjadi kesalahan saat menambahkan data pendidikan umum. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data pendidikan umum berhasil ditambahkan', 'Berhasil!');

    return redirect()->route('educations', ['id' => $id, '_' => microtime(true)]);
  }

  public function edit(Request $request, $id) {
  	$postdata = $request->toArray();

    $item = Education::find($id);
    $item->name = $postdata['name'];
    $item->tmt = (int)$postdata['tmt'];
    $item->place = $postdata['place'];
    $item->status = 0;
    $item->created_by = \Auth::user()->id;

    $ret_update = $item->update();
    $user_id = $item->employee_id;

    $update_pendidikan = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updatePendidikan($item->employee_id);


    if ( !$ret_update )    
      Alert::error('Terjadi kesalahan saat mengubah data pendidikan umum. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data pendidikan umum berhasil diubah', 'Berhasil!');

    return redirect()->route('educations', ['id' => $user_id, '_' => microtime(true)]);
  }

  public function destroy($id){
    $item = Education::find($id);
    $user_id = $item->employee_id;
    $ret_delete = $item->delete();
    
    $update_pendidikan = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updatePendidikan($user_id);

    if ( !$ret_delete )    
      Alert::error('Terjadi kesalahan saat menghapus data pendidikan umum. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data pendidikan umum berhasil dihapus', 'Berhasil!');

    return redirect()->route('educations', ['id' => $user_id, '_' => microtime(true)]);
  }

  public function verification(Request $request, $id){
    $item = Education::find($id);
    $auth = \Auth::user();
    $verificator = Pegawai::where('user_id', $auth->id)->first();
    $item->status = true;
    $item->verificator = ($verificator ? $verificator->id : $auth->id);
    $item->is_employee = ($verificator ? true : false);
    $item->verified_at = Carbon::now();

    if(!empty($request->verification_file))
      $item->verification_file = self::uploadFile($request->verification_file);

    $ret_update = $item->update();
    $user_id = $item->employee_id;
    
    $update_pendidikan = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updatePendidikan($user_id);

    if ( !$ret_update )    
      Alert::error('Terjadi kesalahan saat memverifikasi data pendidikan umum. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data pendidikan umum berhasil diverifikasi', 'Berhasil!');

    return redirect()->route('educations', ['id' => $user_id, '_' => microtime(true)]);
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
      $destination_path = public_path('/uploads/kepegawaian/pendidikanumum');
      $thefile->move($destination_path, $filename);
      $item->save();
    }

    return $item->id;
  }

  public function getFile($emp, $id) {
    $thefile = Berkas::find($id);
    $extension = $thefile->extension;
    $filename = $id.'.'.$extension;
    $destination_path = public_path('/uploads/kepegawaian/pendidikan');

    if(file_exists($destination_path.'/'.$filename)) {
      return response()->file($destination_path.'/'.$filename);
    }
    else {
      Alert::error('Sertifikat/ijazah pendidikan tidak ditemukan', 'Gagal!');

      return redirect()->route('educations', ['id' => $emp]);
    }
  }
}
