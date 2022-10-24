<?php

namespace App\Http\Controllers\Admin\FormBuilder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use DB;
use Schema;

class HelperModel extends Controller
{
	public function writeModel($data, $target)
	{
	    $pascalCasedTarget = str_replace('_', '', ucwords($target, '_'));
	    $folder_model = str_replace(' ', '', ucwords($data->folder_model, ' '));
	    $target_folder = '../app/Models/'.$folder_model;

	    if(!file_exists($target_folder))
	    	File::makeDirectory($target_folder, 0777, true, true);

        $new = fopen($target_folder."/".$pascalCasedTarget.".php", "w");
        $stringRelation = $this->getRelations($data->folder_model);

        $code = 
'<?php

namespace App\\Models\\'.$folder_model.';

use Illuminate\\Database\\Eloquent\\Model;
use Illuminate\\Database\\Eloquent\\SoftDeletes;

class '.$pascalCasedTarget.' extends Model
{
    protected $connection = "'.$data->connection.'";
    protected $table = "'.$target.'";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne("App\\User", "id", "created_by");
    }
    public function updater() {
        return $this->hasOne("App\\User", "id", "updated_by");
    }
    '.$stringRelation.'
}';
        
        fwrite($new, $code);
        fclose($new);
    }


    private function getRelations($folder_model)
    {
    	return "";
    }
}