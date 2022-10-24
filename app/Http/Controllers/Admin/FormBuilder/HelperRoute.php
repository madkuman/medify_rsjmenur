<?php

namespace App\Http\Controllers\Admin\FormBuilder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelperRoute extends Controller
{
    public function writeRoute($data, $target)
    {
        $pascalCasedConnection = str_replace(' ', '', ucwords($data->base_route, ' '));
        $pascalCasedTarget = str_replace(' ', '', ucwords($target, ' '));
        $satayCasedTarget = str_replace(' ', '-', strtolower($target));
        $satayCasedConnection = str_replace(' ', '-', strtolower($data->base_route));
        $namespace_controller = str_replace('/', '\\', $data->folder_controller);
        $default_string =
'<?php


';

        $generated_content =
'<?php

Route::get("/'.$satayCasedConnection.'/'.$satayCasedTarget.'/", "'.$namespace_controller.'\\'.$pascalCasedTarget.'\\ViewController@index");
Route::post("/'.$satayCasedConnection.'/'.$satayCasedTarget.'/save", "'.$namespace_controller.'\\'.$pascalCasedTarget.'\\PostController@save");
Route::post("/'.$satayCasedConnection.'/'.$satayCasedTarget.'/delete", "'.$namespace_controller.'\\'.$pascalCasedTarget.'\\PostController@delete");

';

        if(!file_exists(base_path().'/routes/modules/'.$data->route_file.'.php')){

            file_put_contents(base_path('/routes/modules/'.$data->route_file.'.php'), $default_string);
        }

        $str=file_get_contents(base_path('/routes/modules/'.$data->route_file.'.php'));
        $str=str_replace("<?php",$generated_content, $str);

        file_put_contents(base_path('/routes/modules/'.$data->route_file.'.php'), $str);
    }
}