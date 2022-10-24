<?php

namespace App\Http\Controllers\ClinicalPathway;

use App\Models\ClinicalPathway\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $time = Carbon::now();
        $file = $request->file('file');
        $original_name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $type = $file->getClientMimeType();
        $size = $file->getClientSize();
        $directory = 'clinical-pathways';
        $name = date_format($time, 'YmdGisu') . '.' . $extension;
        $uploaded_file = $file->storeAs($directory, $name, 'public');

        if ($uploaded_file) {
            # Move from storage to public. Create the dir first.
            $public_file = public_path('uploads/' . $uploaded_file);
            if (!is_dir(dirname($public_file))) {
                mkdir(dirname($public_file), 0777, true);
            }
            rename(storage_path('app/public/' . $uploaded_file), $public_file);

            $file_model = File::create([
                'name' => $name,
                'original_name' => $original_name,
                'type' => $type,
                'size' => $size
            ]);

            return response()->json($file_model->id, 200);
        } else {
            return response()->json('error', 400);
        }
    }
}