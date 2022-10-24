<?php

namespace App\Http\Controllers\Kepegawaian\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterController extends Controller
{
  public function index(){
  	$htmlheader_title = 'Kepegawaian | Master Data';
  	$contentheader_title = 'Pengaturan Master Data';
  	
  	return view('kepegawaian.master.index', compact(
  		'htmlheader_title',
  		'contentheader_title'
  	));
  }
}
