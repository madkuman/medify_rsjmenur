<?php

namespace App\Http\Controllers\Admin\FormBuilder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Schema\Blueprint;
use DB;
use Schema;



class HelperDB extends Controller
{

	private $EXCLUDED_TYPE = ['score', 'h2', 'h3', 'h4', 'h5', 'notes'];

	public function insertColumn(Blueprint $table, $inputs)
	{
		foreach ($inputs as $input) {
			if(in_array($input['type'], $this->EXCLUDED_TYPE))
				continue;
			$snake_cased_label = str_replace(" ", "_", strtolower($input['label']));
			if($input['type'] == 'number')
				$table->double($snake_cased_label)->nullable();
			elseif($input['type'] == 'checkboxes'){
				foreach ($input['opsi'] as $opsi) {
					$snake_cased_opsi = str_replace(" ", "_", strtolower($opsi['deskripsi']));
					$table->tinyInteger($snake_cased_label.'_'.$snake_cased_opsi)->nullable();
				}
			}elseif($input['type'] == 'textarea')
				$table->text($snake_cased_label)->nullable();
			elseif($input['type'] == 'datepicker')
				$table->timestamp($snake_cased_label)->nullable();
			else
				$table->string($snake_cased_label, 50)->nullable();

		}
	}
}