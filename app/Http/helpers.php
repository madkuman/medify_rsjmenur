<?php 

/**
 * get object classname
 */
if(!function_exists('get_className')):
function get_className($classObject) {
	$dis = str_replace('\\', '/', get_class($classObject));

	return basename($dis);
}
endif;

/**
 * Check if given field is required upon set of field validation
 */
if(!function_exists('is_required_field')):
function is_required_field($field_name, $fieldsets=array(), $matchvalue="") {
	if(empty($fieldsets))
		return false;
	else {
		if(!$matchvalue && strlen($matchvalue) == 0)
			$matchvalue = "\brequired\b";

		$rule_str = '';
		if(isset($fieldsets[$field_name])){
			$rule_str = $fieldsets[$field_name];

			if(!is_string($rule_str))
				$rule_str = json_encode($rule_str);
		}

		return ($rule_str && preg_match("/{$matchvalue}/", $rule_str));
	}
}
endif;

/**
 * get KA Rumkit
 */
if(!function_exists('get_karumkit')):
function get_karumkit() {
	$items = \App\Models\Kepegawaian\Pegawai::select('*')
		->where('status_aktif', 'Aktif')->where(function($q) {
			$month = \Carbon\Carbon::now()->format('m');
			$year = \Carbon\Carbon::now()->format('Y');

			$q->whereMonth('tmt_out', '<', $month)->whereYear('tmt_out', '<', $year)
        ->orWhere('tmt_out', '0000-00-00 00:00:00');
		})->where('signed', 1)->get();

	$ret = null;
	if(!$items->isEmpty()) {
		foreach ($items as $item) {
			if($item->jabatan_kasal->position == 'Karumkital')
				$ret = $item->id;
		}
	}

	return $ret;
}
endif;