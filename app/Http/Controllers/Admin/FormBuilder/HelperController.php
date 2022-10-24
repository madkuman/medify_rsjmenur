<?php

namespace App\Http\Controllers\Admin\FormBuilder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class HelperController extends Controller
{
	private $EXCLUDED_TYPE = ['score', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'notes'];

	public function writeController($data, $target, $inputs)
	{
		$connection = $data->connection;
	    $pascalCasedTarget = str_replace(" ", "", ucwords($target, " "));
	    $target_folder = "../app/Http/Controllers/".$data->folder_controller."/".$pascalCasedTarget;
	    $namespace_controller = str_replace('/', '\\', $data->folder_controller);
	    $model = str_replace('/', '\\', $data->folder_model."/".$pascalCasedTarget);
		$snake_cased_target = str_replace(" ", "_", strtolower($target));
		$set_attributes = "";

	    foreach ($inputs as $input) {
			if(in_array($input["type"], $this->EXCLUDED_TYPE))
				continue;

			$snake_cased_label = str_replace(" ", "_", strtolower($input["label"]));
            
            if($input['type'] == 'checkboxes') {
                foreach ($input['opsi'] as $opsi) {
                    $snake_cased_label = str_replace(" ", "_", strtolower($input["label"].'_'.$opsi["deskripsi"]));

                    $set_attributes.=
'
        $'.$snake_cased_target.'->'.$snake_cased_label.' = $req->'.$snake_cased_label.';';
                }
            }

            if($input['type'] == 'datepicker') {
                $set_attributes.= 
'
        if(!empty($req->'.$snake_cased_label.')){        
            $'.$snake_cased_target.'->'.$snake_cased_label.' = Carbon::createFromFormat("d/m/Y", $req->'.$snake_cased_label.');
        } else {
            $'.$snake_cased_target.'->'.$snake_cased_label.' = null;
        }';
            }
            else {
    			$set_attributes.=    
'
        $'.$snake_cased_target.'->'.$snake_cased_label.' = $req->'.$snake_cased_label.';';
            }
		}

        File::makeDirectory($target_folder, 0777, true, true);

        $this->writeCreateController($target_folder, $namespace_controller, $model, $pascalCasedTarget, $target, $set_attributes);
        $this->writeReadController($target_folder, $namespace_controller, $model, $pascalCasedTarget, $target);
        $this->writeEditController($target_folder, $namespace_controller, $model, $pascalCasedTarget, $target, $set_attributes);
        $this->writeDeleteController($target_folder, $namespace_controller, $model, $pascalCasedTarget, $target);
        $this->writeViewController($target_folder, $namespace_controller, $model, $pascalCasedTarget, $target, $data->folder_view);
        $this->writePostController($target_folder, $namespace_controller, $model, $pascalCasedTarget, $target);
	}
	
	private function writeCreateController($target_folder, $namespace_controller, $model, $pascalCasedTarget, $target, $set_attributes)
    {
        $new = fopen($target_folder."/CreateController.php", "w");
		$snake_cased_target = str_replace(" ", "_", strtolower($target));

        $code = 
'<?php

namespace App\\Http\\Controllers\\'.$namespace_controller.'\\'.$pascalCasedTarget.';

use Illuminate\\Http\\Request;
use App\\Http\\Controllers\\Controller;
use App\\Models\\'.$model.';
use DB;
use Auth;
use Carbon\\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$'.$snake_cased_target.' = new '.$pascalCasedTarget.';
    	'.$set_attributes.'
    	$'.$snake_cased_target.'->created_by = Auth::user()->id;
    	$'.$snake_cased_target.'->kasus_id = $kasus_id;
    	$'.$snake_cased_target.'->save();
    }
}';

        fwrite($new, $code);
        fclose($new);
    }

    private function writeReadController($target_folder, $namespace_controller, $model, $pascalCasedTarget, $target)
    {
        $new = fopen($target_folder."/ReadController.php", "w");

        $code = 
'<?php

namespace App\\Http\\Controllers\\'.$namespace_controller.'\\'.$pascalCasedTarget.';

use Illuminate\\Http\Request;
use App\\Http\\Controllers\\Controller;
use App\\Models\\'.$model.';
use DB;

class ReadController extends Controller
{
    public function all(){
    	return '.$pascalCasedTarget.'::all();
    }
}';

        fwrite($new, $code);
        fclose($new);
    }

    private function writeEditController($target_folder, $namespace_controller, $model, $pascalCasedTarget, $target, $set_attributes)
    {
        $new = fopen($target_folder."/EditController.php", "w");
		$snake_cased_target = str_replace(" ", "_", strtolower($target));
        $code = 
'<?php

namespace App\\Http\\Controllers\\'.$namespace_controller.'\\'.$pascalCasedTarget.';

use Illuminate\\Http\\Request;
use App\\Http\\Controllers\\Controller;
use App\\Models\\'.$model.';
use DB;
use Auth;
use Carbon\\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$'.$snake_cased_target.' = '.$pascalCasedTarget.'::find($req->id);
    	'.$set_attributes.'
        $'.$snake_cased_target.'->updated_by = Auth::user()->id;
    	$'.$snake_cased_target.'->save();
    }
}';

        fwrite($new, $code);
        fclose($new);
    }

    private function writeDeleteController($target_folder, $namespace_controller, $model, $pascalCasedTarget, $target)
    {
        $new = fopen($target_folder."/DeleteController.php", "w");

		$snake_cased_target = str_replace(" ", "_", strtolower($target));
        $code = 
'<?php

namespace App\\Http\\Controllers\\'.$namespace_controller.'\\'.$pascalCasedTarget.';

use Illuminate\\Http\\Request;
use App\\Http\\Controllers\\Controller;
use App\\Models\\'.$model.';
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $'.$snake_cased_target.' = '.$pascalCasedTarget.'::find($id);
        if($'.$snake_cased_target.')
        {
            $'.$snake_cased_target.'->deleted_by = Auth::user()->id;
            $'.$snake_cased_target.'->save();
            $'.$snake_cased_target.'->delete();
        }
    }
}';

        fwrite($new, $code);
        fclose($new);
    }

    private function writePostController($target_folder, $namespace_controller, $model, $pascalCasedTarget, $target)
    {
        $new = fopen($target_folder."/PostController.php", "w");

        $code = 
'<?php

namespace App\\Http\\Controllers\\'.$namespace_controller.'\\'.$pascalCasedTarget.';

use Illuminate\\Http\\Request;
use App\\Http\\Controllers\\Controller;
use DB;
use App\\Models\\Kasus\\Kasus;

class PostController extends Controller
{
    public function delete(Request $req){
    	DB::connection("kasus")->beginTransaction();
        try
        {  
	   		app("App\\Http\\Controllers\\'.$namespace_controller.'\\'.$pascalCasedTarget.'\\DeleteController")->delete($req);

            $status = 1;
            $message = "'.$target.' berhasil dihapus!";
            $title = "Berhasil!";

            DB::connection("kasus")->commit();
            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        } catch (\\Exception $e) {
            app("App\\Http\\Controllers\\Error\\Handler")->bugsnag($e);
            DB::connection("kasus")->rollback();

            $status = -1;
            $message = "'.$target.' gagal dihapus!";
            $title = "Gagal!";

            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        }
    }

    public function save(Request $req, $nomor_kasus){
 		DB::connection("kasus")->beginTransaction();
        try
        {

			$kasus = Kasus::where("nomor_kasus",$nomor_kasus)->first();
            if(isset($req->id) && $req->id != 0){
            	app("App\\Http\\Controllers\\'.$namespace_controller.'\\'.$pascalCasedTarget.'\\EditController")->edit($req);
            }else{
           		app("App\\Http\\Controllers\\'.$namespace_controller.'\\'.$pascalCasedTarget.'\\CreateController")->create($req, $kasus->id);
            }


            $status = 1;
            $message = "'.$target.' berhasil ditambahkan!";
            $title = "Berhasil!";
           
            DB::connection("kasus")->commit();
            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);

        } catch (\\Exception $e) {
            app("App\\Http\\Controllers\\Error\\Handler")->bugsnag($e);
            DB::connection("kasus")->rollback();

            $status = -1;
            $message = "'.$target.' gagal ditambahkan!";
            $title = "Gagal!";

            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        }
    }
}';

        fwrite($new, $code);
        fclose($new);
    }

    private function writeViewController($target_folder, $namespace_controller, $model, $pascalCasedTarget, $target, $folder_view)
    {
        $new = fopen($target_folder."/ViewController.php", "w");
		$snake_cased_target = str_replace(" ", "_", strtolower($target));
	    $satayCasedFolder = str_replace(' ', '-', strtolower($folder_view));
 		$satayDotCasedFolder = str_replace('/', '.', strtolower($satayCasedFolder));
	    $satayCasedTarget = str_replace(' ', '-', strtolower($target));
	    $view = $satayDotCasedFolder.'.'.$satayCasedTarget;
        
        $code = 
'<?php

namespace App\\Http\\Controllers\\'.$namespace_controller.'\\'.$pascalCasedTarget.';

use Illuminate\\Http\\Request;
use App\\Http\\Controllers\\Controller;
use App\Models\Kasus\Kasus;
use App\\Models\\'.$model.';
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $'.$snake_cased_target.' = '.$pascalCasedTarget.'::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["'.$snake_cased_target.'"] = $'.$snake_cased_target.';
        $data["sidebar_active"] = "alat";

        return view("'.$view.'.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $'.$snake_cased_target.' = '.$pascalCasedTarget.'::with(["creator"])->where("kasus_id",$kasus->id)->where("id",$id)
                ->orderBy("id","desc")->first();

        $data["'.$snake_cased_target.'"] = $'.$snake_cased_target.';
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("'.$view.'.print", $data);
        return $pdf->stream("print.pdf");
    }
}';

        fwrite($new, $code);
        fclose($new);
    }
}