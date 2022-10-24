<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\MilitaryEducation;
use App\Models\Kepegawaian\Berkas;
use Carbon\Carbon;
use Alert;
use Auth;

class MilitaryEducationsController extends Controller
{
  protected $user;
 
	function __construct() {
		$this->user = \Auth::user();
	}

  public function store(Request $request, $id) {
  	$postdata = $request->toArray();
    if($postdata['name-military-education'] == null && $postdata['tmt-military'] == null && $postdata['military-place'] == null){
      return redirect()->route('educations', ['id' => $id, '_' => microtime(true)])->with('error', 'cannot save data');
    }

  	$new_item = new MilitaryEducation;
  	$new_item->name = $postdata['name-military-education'];
  	$new_item->employee_id = $id;
  	$new_item->tmt = (int)$postdata['tmt-military'];
  	$new_item->place = $postdata['military-place'];
    $new_item->status = false;
    $new_item->created_by = Auth::user()->id;

    if(!empty($postdata['certificate']))
      $new_item->certificate = self::uploadFile($postdata['certificate']);

  	$ret_save = $new_item->save();
    $update_pendidikan = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updatePendidikanMiliter($new_item->employee_id);

    if ( !$ret_save )
      Alert::error('Terjadi kesalahan saat menambahkan data pendidikan militer. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data pendidikan militer berhasil ditambahkan', 'Berhasil!');

  	return redirect()->route('educations', ['id' => $id, '_' => microtime(true)]);
	}
	
	public function edit(Request $request, $id) {
  	$postdata = $request->toArray();

  	$item = MilitaryEducation::find($id);
  	$item->name = $postdata['name-military-education'];
  	$item->tmt = (int)$postdata['tmt-military'];
  	$item->place = $postdata['military-place'];
    $item->status = 0;

  	$ret_update = $item->update();
    $user_id = $item->employee_id;
    $item->created_by = Auth::user()->id;
    $update_pendidikan = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updatePendidikanMiliter($item->employee_id);

    if ( !$ret_update )    
      Alert::error('Terjadi kesalahan saat mengubah data pendidikan militer. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data pendidikan militer berhasil diubah', 'Berhasil!');

  	return redirect()->route('educations', ['id' => $user_id, '_' => microtime(true)]);
	}
	
	public function destroy($id){
    $item = MilitaryEducation::find($id);
    $user_id = $item->employee_id;
  	$ret_delete = $item->delete();
    
    if ( !$ret_delete )    
      Alert::error('Terjadi kesalahan saat menghapus data pendidikan militer. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data pendidikan militer berhasil dihapus', 'Berhasil!');

    return redirect()->route('educations', ['id' => $user_id, '_' => microtime(true)]);
	}
	
	public function verification(Request $request, $id){
    $item = MilitaryEducation::find($id);
    $auth = \Auth::user();
    $verificator = Pegawai::where('user_id', $auth->id)->first();
    $item->status = true;
    $item->verificator = ($verificator ? $verificator->id : $auth->id);
    $item->verified_at = Carbon::now();

    if(!empty($request->verification_file))
      $item->verification_file = self::uploadFile($request->verification_file);

    $ret_update = $item->update();
    $user_id = $item->employee_id;

    if ( !$ret_update )    
      Alert::error('Terjadi kesalahan saat memverifikasi data pendidikan militer. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data pendidikan militer berhasil diverifikasi', 'Berhasil!');

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
      $destination_path = public_path('/uploads/kepegawaian/pendidikanmiliter');
      $thefile->move($destination_path, $filename);
      $item->save();
    }

    return $item->id;
  }

  public function getFile($emp, $id) {
    $thefile = Berkas::find($id);
    $extension = $thefile->extension;
    $filename = $id.'.'.$extension;
    $destination_path = public_path('/uploads/kepegawaian/pendidikanmiliter');

    if(file_exists($destination_path.'/'.$filename)) {
      return response()->file($destination_path.'/'.$filename);
    }
    else {
      Alert::error('Sertifikat/ijazah pendidikan militer tidak ditemukan', 'Gagal!');

      return redirect()->route('educations', ['id' => $emp]);
    }
  }
}
