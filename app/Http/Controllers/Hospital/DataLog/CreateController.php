<?php

namespace App\Http\Controllers\Hospital\DataLog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\DataLog;
use Auth;

class CreateController extends Controller
{
    public function create($connection,$table,$id,$data,$type)
    {
        try
        {
            $log = new DataLog;
            $log->connection = $connection;
            $log->table = $table;
            $log->data_id = $id;
            $log->data = $data;
            $log->created_by = Auth::user()->id ?? 1;
            $log->type = $type;
            $log->save();
            
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
