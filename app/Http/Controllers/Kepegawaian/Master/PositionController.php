<?php

namespace App\Http\Controllers\Kepegawaian\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kepegawaian\Mposition;

class PositionController extends Controller
{
  protected $itemPerPage = 15;
	protected $user;
	
	function __construct(){
		$this->user = \Auth::user();
	}

  public function index(){
    $items = Mposition::paginate($this->itemPerPage);
    $htmlheader_title = 'Kepegawaian | Master Pangkat';
    $contentheader_title = 'Master Pangkat';
    $paginationParams = [];

    return view('kepegawaian.master.mpositions', compact(
      'items',
      'paginationParams',
      'htmlheader_title',
      'contentheader_title'
    ));
  }

  public function store(Request $request){
  	$postdata = $request->toArray();

  	$new_item = new Mposition;
  	$new_item->name = $postdata['name'];

  	$ret_save = $new_item->save();

  	if( !$ret_save )
  		return redirect()->route('master-positions')->with('error', 'fail');

  	return redirect()->route('master-positions')->with('success', 'save');
  }

  public function edit($id, Request $request){
    $postdata = $request->toArray();

    $item = Mposition::find($id);
    $item->name = $postdata['name'];

    $ret_update = $item->save();

    if( !$ret_update )
      return redirect()->route('master-positions')->with('error', 'fail_update');

    return redirect()->route('master-positions')->with('success', 'updated');
  }

  public function destroy($id){
  	$item = Mposition::find($id);

  	$ret_delete = $item->delete();

  	if( !$ret_delete )
  		return redirect()->route('master-positions')->with('error', 'fail_delete');

  	return redirect()->route('master-positions')->with('success', 'delete');
  }
}
