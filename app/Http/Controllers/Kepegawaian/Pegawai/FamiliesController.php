<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Family;
use Alert,Auth;

class FamiliesController extends Controller
{
  protected $itemPerPage = 10;
  protected $user;

  function __construct() {
    $this->user = \Auth::user();
  }

  public function index(Request $request, $id) {
    $pegawai = Pegawai::find($id);

    $items = Family::where('employee_id', $pegawai->id)->orderBy('birth_date', 'asc')->paginate($this->itemPerPage);

    $htmlheader_title = 'Kepegawaian | Keluarga';
    $contentheader_title = 'Data Keluarga';

    $paginationParams = [];
    $is_hrd_member = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);

    return view('kepegawaian.pegawai.keluarga.index', compact(
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
    if($postdata['name'] == null && $postdata['birth_date'] == null && $postdata['sex'] == null){
      return redirect()->route('families', ['id' => $id, '_' => microtime(true)])->with('error', 'cannot save data');
    }

    $new_item = new Family;
    $new_item->name = $postdata['name'];
    $new_item->employee_id = $id;
    $new_item->birth_date = date('Y-m-d', strtotime($postdata['birth_date']));
    $new_item->birth_place = $postdata['birth_place'];
    $new_item->sex = $postdata['sex'];
    $new_item->citizen_number = $postdata['citizen_number'];
    $new_item->bpjs = $postdata['bpjs'];
    $new_item->faskes = $postdata['faskes'];
    $new_item->relationship = $postdata['relationship'];
    // $new_item->family_registers = ($postdata['family_registers'] ? $postdata['family_registers'] : '');
    // $new_item->address = ($postdata['address'] ? $postdata['address'] : '');

    $ret_save = $new_item->save();

    if ( !$ret_save )
      Alert::error('Terjadi kesalahan saat menambahkan data keluarga. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data keluarga berhasil ditambahkan', 'Berhasil!');

    return redirect()->route('families', ['id' => $id, '_' => microtime(true)]);
  }

  public function edit(Request $request, $id){
    $postdata = $request->toArray();

    $item = Family::find($id);
    $item->name = $postdata['name'];
    $item->birth_date = date('Y-m-d', strtotime($postdata['birth_date']));
    $item->birth_place = $postdata['birth_place'];
    $item->sex = $postdata['sex'];
    $item->citizen_number = $postdata['citizen_number'];
    $item->bpjs = $postdata['bpjs'];
    $item->faskes = $postdata['faskes'];
    $item->relationship = $postdata['relationship'];
    $ret_update = $item->update();
    $user_id = $item->employee_id;

    if ( !$ret_update )    
      Alert::error('Terjadi kesalahan saat mengubah data keluarga. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data keluarga berhasil diubah', 'Berhasil!');

    return redirect()->route('families', ['id' => $user_id, '_' => microtime(true)]);
  }

  public function destroy($id){
    $item = Family::find($id);
    $user_id = $item->employee_id;
    $ret_delete = $item->delete();

    if ( !$ret_delete )    
      Alert::error('Terjadi kesalahan saat menghapus data keluarga. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data keluarga berhasil dihapus', 'Berhasil!');

    return redirect()->route('families', ['id' => $user_id, '_' => microtime(true)]);
  }

  public function create(Request $request, $id) {

    $new_item = new Family;
    $new_item->nama           = $request->nama;
    $new_item->employee_id    = $id;
    $new_item->tanggal_lahir  = date('Y-m-d', strtotime($request->tanggal_lahir));
    $new_item->tempat_lahir   = $request->tempat_lahir;
    $new_item->sex            = $request->kelamin;
    $new_item->citizen_number = $request->nik;
    $new_item->asuransi       = $request->asuransi;
    $new_item->no_asuransi    = $request->no_asuransi;
    $new_item->faskes         = $request->faskes;
    $new_item->relationship   = $request->relationship;
    $new_item->kelas          = $request->kelas;
   
    $ret_save = $new_item->save();

    if ( !$ret_save )
      Alert::error('Terjadi kesalahan saat menambahkan data keluarga. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data keluarga berhasil ditambahkan', 'Berhasil!');

    return redirect()->route('families', ['id' => $id, '_' => microtime(true)]);
  }


  public function update(Request $request, $id) {

    $new_item = Family::find($request->id);
    $new_item->nama           = $request->nama;
    $new_item->employee_id    = $id;
    $new_item->tanggal_lahir  = date('Y-m-d', strtotime($request->tanggal_lahir));
    $new_item->tempat_lahir   = $request->tempat_lahir;
    $new_item->sex            = $request->kelamin;
    $new_item->citizen_number = $request->nik;
    $new_item->asuransi       = $request->asuransi;
    $new_item->no_asuransi    = $request->no_asuransi;
    $new_item->faskes         = $request->faskes;
    $new_item->relationship   = $request->relationship;
    $new_item->kelas          = $request->kelas;
  
    $ret_save = $new_item->update();

    if ( !$ret_save )
      Alert::error('Terjadi kesalahan saat menambahkan data keluarga. Silahkan ulangi lagi', 'Gagal!');
    else 
      Alert::success('Data keluarga berhasil di update', 'Berhasil!');

    return redirect()->route('families', ['id' => $id, '_' => microtime(true)]);
  }
}
