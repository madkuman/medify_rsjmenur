<?php

namespace App\Http\Controllers\Admin\Kasus\FormBuilder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
	public function create(Request $request)
	{
		DB::beginTransaction();
		try
		{
			$data = $request->all();
			$form = app('App\Http\Controllers\Kasus\Form\CreateController')->create($data['judul'],$data['deskripsi']);
			
			$array_opsi = ['dropdown','radio','checkboxes','checkboxes-score','radio-score'];
			$array_lokal_id = [];
			$array_skor_parent = [];

			foreach($data['input'] as $input)
			{
				$input = (object) $input;
				$form_input = app('App\Http\Controllers\Kasus\FormInput\CreateController')->create($form->id,$input->label,$input->caption,$input->type,$input->page,$input->order);
				$array_lokal_id[$input->id] = $form_input->id;
				if(in_array($input->type, $array_opsi))
				{
					foreach($input->opsi as $opsi)
					{
						$opsi = (object) $opsi;
						$form_input_opsi = app('App\Http\Controllers\Kasus\FormInputOpsi\CreateController')->create($form_input->id,$opsi->deskripsi,$opsi->extra_input,$opsi->skor);
					}
					
				}
				if($input->type == 'score')
				{
					$array_skor_parent[$input->id]['input_id'] = $form_input->id;
					$array_skor_parent[$input->id]['children_lokal_id'] = $input->skor_input_id;
					
				}
			}

			foreach($array_skor_parent as $parent)
			{
				$parent_id = $parent['input_id'];
				foreach($parent['children_lokal_id'] as $child_lokal_id)
				{
					$child_input_id = $array_lokal_id[$child_lokal_id];
					$form_input_opsi = app('App\Http\Controllers\Kasus\FormSkor\CreateController')->create($parent_id,$child_input_id);
				}
			}

			$status = 1;
			$message = 'Form baru berhasil dibuat!';
			$title = 'Berhasil!';

			DB::commit();

			return redirect('admin/kasus/form-builder/'.$form->id)
			->with('active_nav','diagnosis')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch(\Exception $e)
		{
			DB::rollback();

			$status = 1;
			$message = 'Form gagal diedit!';
			$title = 'Berhasil!';

			return back()
			->with('active_nav','diagnosis')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
	}


	public function edit(Request $request)
	{

		DB::beginTransaction();
		try
		{
			$data = $request->all();
			$count = count($data['id']);
			$form = app('App\Http\Controllers\Kasus\Form\EditController')->edit($data['form_id'],$data['judul'],$data['deskripsi']);
			$form_input_delete = app('App\Http\Controllers\Kasus\FormInput\DeleteController')->deletebyFormID($form->id);

			$array_opsi = ['dropdown','radio','checkboxes'];
			for($i = 0;$i<$count;$i++)
			{
				$form_input = app('App\Http\Controllers\Kasus\FormInput\CreateController')->create($form->id,$data['inputlabel'][$i],$data['inputtype'][$i],$data['inputcaption'][$i]);
				if(in_array($data['inputtype'][$i], $array_opsi))
				{
					$id = $data['id'][$i];
					$inputoption = $data['inputoption'.$id];

					foreach($inputoption as $option)
					{
						$form_input_opsi = app('App\Http\Controllers\Kasus\FormInputOpsi\CreateController')->create($form_input->id,$option);
					}
				}	
			}
			DB::commit();

			$status = 1;
			$message = 'Form berhasil diedit!';
			$title = 'Berhasil!';

			return redirect('admin/kasus/form-builder/'.$form->id)
			->with('active_nav','diagnosis')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch(\Exception $e)
		{
			DB::rollback();

			$status = 1;
			$message = 'Form gagal diedit!';
			$title = 'Berhasil!';

			return redirect('admin/kasus/form-builder/'.$form->id)
			->with('active_nav','diagnosis')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}










	/*SUBMIT FORM TANPA JSON JADI LANGSUNG DIKIRIM VIA POST SUBMIT*/
	/*public function create(Request $request)
	{
		DB::beginTransaction();
		try
		{
			$data = $request->all();
			$count = count($data['id']);
			$form = app('App\Http\Controllers\Kasus\Form\CreateController')->create($data['judul'],$data['deskripsi']);
			$array_opsi = ['dropdown','radio','checkboxes'];
			for($i = 0;$i<$count;$i++)
			{
				$form_input = app('App\Http\Controllers\Kasus\FormInput\CreateController')->create($form->id,$data['inputlabel'][$i],$data['inputtype'][$i],$data['inputcaption'][$i]);
				if(in_array($data['inputtype'][$i], $array_opsi))
				{
					$id = $data['id'][$i];
					$inputoption = $data['inputoption'.$id];

					foreach($inputoption as $option)
					{
						$form_input_opsi = app('App\Http\Controllers\Kasus\FormInputOpsi\CreateController')->create($form_input->id,$option);
					}
				}	
			}

			$status = 1;
			$message = 'Form baru berhasil dibuat!';
			$title = 'Berhasil!';

			DB::commit();

			return redirect('admin/kasus/form-builder/'.$form->id)
			->with('active_nav','diagnosis')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch(\Exception $e)
		{
			DB::rollback();
			;

			$status = 1;
			$message = 'Form gagal diedit!';
			$title = 'Berhasil!';

			return back()
			->with('active_nav','diagnosis')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
	}*/
}
