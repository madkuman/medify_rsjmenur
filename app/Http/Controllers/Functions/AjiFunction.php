<?php

namespace App\Http\Controllers\Functions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjiFunction extends Controller
{
    public function whereQuery($request, $query, $model)
    {
        foreach ($request as $key => $value) {
            $exploded_key = explode('_', $key);
        
            if(end($exploded_key) == 'like'){
                array_pop($exploded_key);
                $operator = '=';
            }elseif (end($exploded_key) == 'start') {
                array_pop($exploded_key);
                $operator = '>=';
            }elseif (end($exploded_key) == 'end') {
                array_pop($exploded_key);
                $operator = '<=';
            }

            $imploded_key = implode('_', $exploded_key);

            if (in_array($imploded_key, $model->getFillable())) {
                if(isset($value)){
                    $query = $query->where($imploded_key, $operator, $value);
                }
            }
        }
        
        return $query;
    }

    public function everyRequest($request, $model)
	{
		$data = [];
		foreach ($request as $key => $value) {
			if (in_array($key, $model->getFillable())) {
                $data[$key] = $value;
            }else{
                unset($request[$key]);
            }
		}

		return $data;
	}
}
