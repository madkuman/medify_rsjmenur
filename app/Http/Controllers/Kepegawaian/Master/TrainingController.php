<?php

namespace App\Http\Controllers\Kepegawaian\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kepegawaian\Mtraining;

class TrainingController extends Controller
{
	protected $itemPerPage = 15;
	protected $user;
	
	function __construct(){
		$this->user = \Auth::user();
	}

  public function index(){
  	$items = Mtraining::paginate($this->itemPerPage);
    $htmlheader_title = 'Kepegawaian | Master Pelatihan';
    $contentheader_title = 'Master Pelatihan';
    $paginationParams = [];

    return view('kepegawaian.master.mtrainings', compact(
      'items',
      'paginationParams',
      'htmlheader_title',
      'contentheader_title'
    ));
  }

  public function store(Request $request){
  	$postdata = $request->toArray();

  	$new_item = new Mtraining;
  	$new_item->name = $postdata['name'];

  	$ret_save = $new_item->save();

  	if( !$ret_save )
  		return redirect()->route('master-trainings')->with('error', 'fail');

  	return redirect()->route('master-trainings')->with('success', 'save');
  }

  public function edit($id, Request $request){
    $postdata = $request->toArray();

    $item = Mtraining::find($id);
    $item->name = $postdata['name'];

    $ret_update = $item->save();

    if( !$ret_update )
      return redirect()->route('master-trainings')->with('error', 'fail_update');

    return redirect()->route('master-trainings')->with('success', 'updated');
  }

  public function destroy($id){
  	$item = Mtraining::find($id);

  	$ret_delete = $item->delete();

  	if( !$ret_delete )
  		return redirect()->route('master-trainings')->with('error', 'fail_delete');

  	return redirect()->route('master-trainings')->with('success', 'delete');
  }
}
