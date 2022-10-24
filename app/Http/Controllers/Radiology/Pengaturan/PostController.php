<?php

namespace App\Http\Controllers\Radiology\Pengaturan;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;
use Auth;
use App\Models\Radiology\TemplateHasil;

class PostController extends Controller
{
    static protected $departemenId = 8;
    static protected $slug = 'radiologi';

    public function new(Request $req)
    {
        try {
            DB::connection('radiology')->beginTransaction();

            $this->clearOtherTemplate($req['tarif_id']);

            $this->generateTemplates($req);

            DB::connection('radiology')->commit();

            $status = '1';
            $title = "Berhasil";
            $message = 'Berhasil Membuat Template';
        } catch (\Exception $e) {
            DB::connection('radiology')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = '-1';
            $title = "Gagal";
            $message = 'Gagal Membuat Template';
           return back()
                    ->with('status', $status)
                    ->with('title', $title)
                    ->with('message', $message);
        }
        return redirect('radiologi/pengaturan/hasil-baca')
                ->with('status', $status)
                ->with('title', $title)
                ->with('message', $message); 
    }

    public function update(Request $req, $generic_id)
    {
        try {
            DB::connection('radiology')->beginTransaction();

            $this->clearOtherTemplate($req['tarif_id']);

            $this->generateTemplates($req, $generic_id);

            DB::connection('radiology')->commit();

            $status = '1';
            $title = "Berhasil";
            $message = 'Berhasil Mengubah Template';
        } catch (\Exception $e) {
            DB::connection('radiology')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = '-1';
            $title = "Gagal";
            $message = 'Gagal Mengubah Template';
           return back()
                    ->with('status', $status)
                    ->with('title', $title)
                    ->with('message', $message);
        }
        return redirect('radiologi/pengaturan/hasil-baca')
                ->with('status', $status)
                ->with('title', $title)
                ->with('message', $message);
    }

    private function generateTemplates($req, $generic_id = NULL)
    {
        $creator_id = Auth::user()->id;
        if(is_null($generic_id))
            $generic_id = $this->getLastGenericId()+1;

        foreach($req['tarif_id'] as $t)
        {
            $template = new TemplateHasil;
            $template->generic_id = $generic_id;
            $template->tarif_id = $t;
            $template->title = $req['title'];
            $template->konten = $req['konten'];
            $template->created_by = $creator_id;
            $template->save();
        }
    }

    public function delete(Request $req)
    {
        try {
            DB::connection('radiology')->beginTransaction();

            TemplateHasil::where('generic_id', $req['to_delete'])->delete();

            DB::connection('radiology')->commit();

            $status = '1';
            $title = "Berhasil";
            $message = 'Berhasil Mengubah Template';
        } catch (\Exception $e) {
            DB::connection('radiology')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = '-1';
            $title = "Gagal";
            $message = 'Gagal Mengubah Template';
        }
       return back()
            ->with('status', $status)
            ->with('title', $title)
            ->with('message', $message);   
    }

    private function clearOtherTemplate($tarif_id)
    {
        $template = TemplateHasil::whereIn('tarif_id', $tarif_id);
        if($template)
            $template->delete();
    }

    private function getLastGenericId()
    {
        $last = TemplateHasil::orderBy('generic_id', 'desc')->first();
        if($last)
            return $last->generic_id;
        else
            return 0;
    }
}