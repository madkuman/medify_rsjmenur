<?php

namespace App\Http\Controllers\Admin\FormBuilder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

define("EXCLUDED_TYPE", ["score", "h1", "h2", "h3", "h4", "h5", "h6", "notes"]);

class HelperView extends Controller
{
	public function writeView($data, $request)
	{
		$satayCasedFolder = str_replace(' ', '-', strtolower($data->folder_view));
	    $satayDotCasedFolder = str_replace('/', '.', strtolower($satayCasedFolder));
	    $satayCasedTarget = str_replace(' ', '-', strtolower($request->judul));
		$snake_cased_judul = str_replace(" ", "_", strtolower($request->judul));
		$target_folder = '../resources/views/'.$satayCasedFolder.'/'.$satayCasedTarget;

	    if(!file_exists($target_folder))
	    	File::makeDirectory($target_folder, 0777, true, true);
 		File::makeDirectory($target_folder, 0777, true, true);

		$this->generateKasusAsesmenIndexView($target_folder, $snake_cased_judul, $satayDotCasedFolder, $satayCasedTarget, $request);
		$this->generateHasilView($target_folder, $snake_cased_judul,  $satayCasedTarget, $request);
		$this->generateModalView($target_folder, $snake_cased_judul, $satayDotCasedFolder, $satayCasedTarget, $request);
		$this->generateModalHasil($target_folder, $snake_cased_judul, $satayDotCasedFolder, $satayCasedTarget, $request);
		$this->generateFormView($target_folder, $snake_cased_judul,  $satayCasedTarget, $request);
		$this->generatePrintView($target_folder, $snake_cased_judul,  $satayCasedTarget, $request);
	}

	private function generatePrintView($target_folder, $snake_cased_judul, $satayDotCasedFolder, $request)
	{
		$new = fopen($target_folder."/print.blade.php", "w");
		$generated_view = '
		<!DOCTYPE html>
			<html>
			<head>
			    <title>'.$request->judul.'</title>
			    <style type="text/css">
				    table {
				        border-collapse: collapse;
				        width : 100%;
				        font-family : sans-serif;
				    }
				</style>
			</head>
			<body>
			<table>
				<tr>
					<td>Fitur Print Belum Tersedia</td>
				</tr>
			</table>
			</body>
			</html>';

        fwrite($new, $generated_view);
        fclose($new);
	}

	private function generateHasilView($target_folder, $snake_cased_judul, $satayDotCasedFolder, $request)
	{
		$new = fopen($target_folder."/hasil.blade.php", "w");
		$generated_field = $this->generateField($request->input);
		$generated_view = 
		'
		'.$generated_field.'';

        fwrite($new, $generated_view);
        fclose($new);
	}

	private function generateKasusAsesmenIndexView($target_folder, $snake_cased_judul, $satayDotCasedFolder, $satayCasedTarget, $request)
	{
		$fill_js_field = '';
		$empty_js_field = "";

		foreach ($request->input as $input) {
			$snake_cased_label = str_replace(" ", "_", strtolower($input['label']));

			switch ($input['type']) {
				case 'h1':
				case 'h2':
				case 'h3':
				case 'h4':
				case 'h5':
				case 'h6':
    				$fill_js_field.= '';
					$empty_js_field.='';
					break;
    			case 'radio':
    				$fill_js_field.= 
'
	$(`:radio[name="'.$snake_cased_label.'"][value="${item.'.$snake_cased_label.'}"]`).prop("checked", true);';
					$empty_js_field.=
'
	$(`:radio[name="'.$snake_cased_label.'"]`).prop("checked", false);';
					break;
				case 'textarea':
					$fill_js_field.=
'
	$(`textarea[name="'.$snake_cased_label.'"]`).val(item.'.$snake_cased_label.');';
					$empty_js_field.=
'
	$(`textarea[name="'.$snake_cased_label.'"]`).val("");';
					break;
    			case 'checkboxes':
    				foreach ($input['opsi'] as $opsi) {
						$snake_cased_opsi = str_replace(" ", "_", strtolower($opsi['deskripsi']));
   						$fill_js_field.=
'
	$(`:checkbox[name="'.$snake_cased_label.'_'.$snake_cased_opsi.'"]`).prop("checked", item.'.$snake_cased_label.'_'.$snake_cased_opsi.' != null);';
			   			
			   			$empty_js_field.=
'
	$(`:checkbox[name="'.$snake_cased_label.'_'.$snake_cased_opsi.'"]`).prop("checked", false);';
    				}
    				break;
    			case 'datepicker':
    				$fill_js_field.=
'
	$(`:text[name="'.$snake_cased_label.'"]`).val(formatDate(item.'.$snake_cased_label.'));';

					$empty_js_field.=
'
	$(`:text[name="'.$snake_cased_label.'"]`).val("");';
    				break;
    			case 'dropdown':
    				$fill_js_field.=
'
	$(`#'.$snake_cased_label.'`).val(item.'.$snake_cased_label.');
	$(`#'.$snake_cased_label.'`).select2().trigger("change");';

    				$empty_js_field.=
'
	$(`#'.$snake_cased_label.'`).val("");
	$(`#'.$snake_cased_label.'`).select2().trigger("change");';
    				break;
    			case 'number':
    				$fill_js_field.=
'
	$(`input[name="'.$snake_cased_label.'"]`).val(item.'.$snake_cased_label.');';
					$empty_js_field.=
'
	$(`input[name="'.$snake_cased_label.'"]`).val("");';
    				break;
    			default:
    				$fill_js_field.= 
'
	$(`:text[name="'.$snake_cased_label.'"]`).val(item.'.$snake_cased_label.');';
		    		$empty_js_field.= 
'
	$(`:text[name="'.$snake_cased_label.'"]`).val("");';
    				break;
    		}
    	}
        
        $new = fopen($target_folder."/index.blade.php", "w");
		$generated_view = 
'@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - '.$request->judul.' - Kasus
@endsection

@section("content")

<main id="main-container">
	@include("kasus.layouts.header")

	<div class="content">
		<div class="row">
			@include("kasus.layouts.sidebar")

			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content">
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> '.$request->judul.' Baru</button>
						
						<h4>'.$request->judul.'</h4>
						<hr>
						@php $count = count($'.$snake_cased_judul.') @endphp
						@forelse($'.$snake_cased_judul.' as $item)

						@if(session("my_role_".$kasus->nomor_kasus))
						@if(session("my_role_".$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						@endif
						<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-search"></i>
						</button>
						<a type="btn" href="{{url()->current()}}/print/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" target="_blank">
							<i class="fa fa-print"></i>
						</a>
						<h5 class="mb-5 pl-5">#'.$request->judul.' {{$count}}</h5>
						
						@if(!empty($item->creator->avatar_thumb))
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
						</div>
						@else
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url("assets/img/placeholder.jpg")}}" alt="">
						</div>
						@endif
						<div class="creator">
							<h6 class="pt-10">
								<small class="text-muted">Dibuat Oleh</small><br>
								{{$item->creator->name}}<br>
								{{date("d F y, H:i", strtotime($item->created_at))}}
							</h6>
						</div>

						<hr class="my-20">
						@php $count-- @endphp
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen '.$request->judul.' tersedia</h4>
							<p>Klik tombol <b>'.$request->judul.' Baru</b> untuk melakukan asesmen '.$request->judul.'</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>
@include("'.$satayDotCasedFolder.'.'.$satayCasedTarget.'.modal")
@include("'.$satayDotCasedFolder.'.'.$satayCasedTarget.'.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "\'", $'.$snake_cased_judul.'))!!});

	$(document).ready(function(){
		$(".time").mask("00:00");
	});


	function nl2br (str, is_xhtml) {   
	    var breakTag = (is_xhtml || typeof is_xhtml === "undefined") ? "<br />" : "<br>";    
	    return (str + "").replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "$1"+ breakTag +"$2");
	}


	$(".deleteBtn").click(function(e){
		e.preventDefault();
		id = $(this).data("id");
		$("#deleteInputId").val(id);
		swal({
			title: "Hapus",
			text: "Apakah anda yakin akan menghapus data ini?",
			showCancelButton: true,
			reverseButtons: true,
			type: "warning",
			confirmButtonClass: "btn btn-danger",
			cancelButtonClass: "btn btn-default",
			confirmButtonText: "Hapus",
			cancelButtonText: "Kembali",
			closeOnConfirm: false
		}).then(function(result) {
			if(result.value)
			{
				$("#formDelete").submit();
			}
		});
	});

	$(".editBtn").click(function(e){
		id = $(this).data("id");
		var item = data[$(this).data("index")];
		if (item != "" && item != undefined) {
			$("#id").val(item.id);
			@include("'.$satayDotCasedFolder.'.'.$satayCasedTarget.'.js-form-edit")
		} else {
			$("#id").val(0);
			@include("'.$satayDotCasedFolder.'.'.$satayCasedTarget.'.js-form-create")
		}
		$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];';

			foreach ($request->input as $input) {
				$snake_cased_label = str_replace(" ", "_", strtolower($input['label']));
	    		switch ($input['type']) {
	    			case 'h1':
					case 'h2':
					case 'h3':
					case 'h4':
					case 'h5':
					case 'h6':
						$generated_view .= "";
	    				break;
	    			case 'textarea':
	    				$generated_view .=
'
		var '.$snake_cased_label.' = item.'.$snake_cased_label.' ? nl2br(item.'.$snake_cased_label.') : "-";';
	    				break;
	    			case 'datepicker':
	    				$generated_view .= 
'
		var '.$snake_cased_label.' = item.'.$snake_cased_label.' ? formatDate(item.'.$snake_cased_label.') : "-";';
	    				break;
	    			case 'checkboxes':
	    				foreach ($input['opsi'] as $opsi) {
							$snake_cased_opsi = str_replace(" ", "_", strtolower($opsi['deskripsi']));
	   						$generated_view .=
'
		var '.$snake_cased_label.'_'.$snake_cased_opsi.' = item.'.$snake_cased_label.'_'.$snake_cased_opsi.' ? "✔️" : "-";';
	    				}
	    				break;
	    			default:
	    				$generated_view .=
'
		var '.$snake_cased_label.' = item.'.$snake_cased_label.' ? item.'.$snake_cased_label.' : "-";'; 
	    				break;
	    		}
	    	}

			$generated_view .=	
		'
		
		var hasil = `@include("'.$satayDotCasedFolder.'.'.$satayCasedTarget.'.hasil")`;
		$("#showModalHasil #myModalBody").html(hasil);
		$("#showModalHasil").modal("toggle");
	});

	function formatDate (input) {
		if (input === null) {
			return null;
		} else {
			var datePart = input.match(/\d+/g),
			year = datePart[0],
			month = datePart[1], day = datePart[2];

			return day+'.'"/"'.'+month+'.'"/"'.'+year;
		}
	}
</script>
@endsection';

        fwrite($new, $generated_view);
        fclose($new);

        $new_form_edit = fopen($target_folder."/js-form-edit.blade.php", "w");
        fwrite($new_form_edit, $fill_js_field);
        fclose($new_form_edit);

        $new_form_edit = fopen($target_folder."/js-form-create.blade.php", "w");
        fwrite($new_form_edit, $empty_js_field);
        fclose($new_form_edit);
    }

    private function generateField($inputs)
    {
    	$fields ="";
    	$fields.='
<table width="100%">
	<tr>
		<td width="25%"></td>
		<td width="2%"></td>
		<td width="73%"></td>
	</tr>';
    	foreach ($inputs as $input) {
			$snake_cased_label = str_replace(" ", "_", strtolower($input['label']));
    		switch ($input['type']) {
    			case 'h1':
    				$fields.= '
	<tr>
		<td class="align-top border-bottom" colspan="3"><h1 class="mb-0 mt-20">'.$input['label'].'</h1></td>
	</tr>';
					break;
				case 'h2':
    				$fields.='
	<tr>
		<td class="align-top border-bottom" colspan="3"><h2 class="mb-0 mt-20">'.$input['label'].'</h2></td>
	</tr>';	
					break;
				case 'h3':
    				$fields.='
	<tr>
		<td class="align-top border-bottom" colspan="3"><h3 class="mb-0 mt-20">'.$input['label'].'</h3></td>
	</tr>';	
					break;
    			case 'h4':
    				$fields.='
	<tr>
		<td class="align-top border-bottom" colspan="3"><h4 class="mb-0 mt-20">'.$input['label'].'</h4></td>
	</tr>';	
					break;
				case 'h5':
    				$fields.='
	<tr>
		<td class="align-top border-bottom" colspan="3"><h5 class="mb-0 mt-20">'.$input['label'].'</h5></td>
	</tr>';	
					break;
				case 'h6':
    				$fields.='
	<tr>
		<td class="align-top border-bottom" colspan="3"><h6 class="mb-0 mt-20">'.$input['label'].'</h6></td>
	</tr>';	
					break;
    			case 'checkboxes':
    				$fields.='
	<tr>
		<td class="align-top border-bottom" colspan="3"><h6 class="mb-0 mt-20">'.$input['label'].'</h6></td>
	</tr>';
    				foreach ($input['opsi'] as $opsi) {
						$snake_cased_opsi = str_replace(" ", "_", strtolower($opsi['deskripsi']));
   						$fields.='
	<tr>
		<td class="align-top border-bottom">'.$opsi['deskripsi'].'</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ '.$snake_cased_label.'_'.$snake_cased_opsi.' + `</td>
	</tr>';}
    				break;
    			default:
    				$fields.='
	<tr>
		<td class="align-top border-bottom">'.$input['label'].'</td>
		<td class="align-top border-bottom">:</td>
		<td class="align-top border-bottom">`+ '.$snake_cased_label.' + `</td>
	</tr>';
    				break;
    		}
    	}
    	$fields.='
</table>';
    	return $fields;
    }

    private function generateModalView($target_folder, $snake_cased_judul, $satayDotCasedFolder, $satayCasedTarget, $request)
    {
        $new = fopen($target_folder."/modal.blade.php", "w");
		$generated_view = 
'<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/save">
				<div class="block block-themed block-transparent mb-0">
				    <div class="block-header">
				        <h3 class="block-title">'.$request->judul.'</h3>
				        <div class="block-options">
				            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
				                <i class="si si-close"></i>
				            </button>
				        </div>
				    </div>
					@include("'.$satayDotCasedFolder.'.'.$satayCasedTarget.'.form")
				</div>
				<div class="modal-footer">
				    <div class="form-group">
				        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
				    </div>
				</div>
            </form>
        </div>
    </div>
</div>';

        fwrite($new, $generated_view);
        fclose($new);
    }

    private function generateModalHasil($target_folder, $snake_cased_judul, $satayDotCasedFolder, $satayCasedTarget, $request)
    {
        $new = fopen($target_folder."/modal-hasil.blade.php", "w");
		$generated_view = 
'<div class="modal fade" id="showModalHasil" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
			    <div class="block-header">
			        <h3 class="block-title">'.$request->judul.'</h3>
			        <div class="block-options">
			            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
			                <i class="si si-close"></i>
			            </button>
			        </div>
			    </div>
			    <div class="block-content">
				    <div id="myModalBody">
				       
				    </div>
			    </div>						
			</div>
			<div class="modal-footer">
			    <div class="form-group">
			        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Tutup</button>
			    </div>
			</div>
        </div>
    </div>
</div>';

        fwrite($new, $generated_view);
        fclose($new);
    }

    private function generateFormView($target_folder, $snake_cased_judul, $satayCasedTarget, $request)
    {
    	$new = fopen($target_folder."/form.blade.php", "w");
        $generated_field = $this->generateModalField($request->input);
    	$generated_view = 
    	'<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	'.$generated_field.'
	    </div>
	</div>';

        fwrite($new, $generated_view);
        fclose($new);
    }

    public function generateModalField($inputs)
    {
    	$fields ="";
    	foreach ($inputs as $input) {
			$snake_cased_label = str_replace(" ", "_", strtolower($input['label']));

    		switch ($input['type']) {
    			case 'number':
    				$fields.='
			<div class="form-group col-md-3 col-sm-12">
			    <label>'.$input['label'].'</label>
			    <input type="number" class="form-control" name="'.$snake_cased_label.'" autocomplete="off">
			</div>';
    				break;
    			case 'time':
    				$fields.='
			<div class="form-group col-md-3 col-sm-12">
			    <label>'.$input['label'].'</label>
			    <input type="text" class="form-control time" name="'.$snake_cased_label.'" autocomplete="off">
			</div>';
    				break;
    			case 'datepicker':
    				$fields.='	
			<div class="form-group col-md-3 col-sm-12">
			    <label>'.$input['label'].'</label>
			    <input type="text" class="form-control js-datepicker" name="'.$snake_cased_label.'" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>';
    				break;
    			case 'h1':
    				$fields.='
			<div class="col-12">
				<h1 class="pt-15">'.$input['label'].'</h1>
			</div>';
					break;
    			case 'h2':
    				$fields.='
			<div class="col-12">
				<h2 class="pt-15">'.$input['label'].'</h2>
			</div>';
					break;
    			case 'h3':
    				$fields.='
			<div class="col-12">
				<h3 class="pt-15">'.$input['label'].'</h3>
			</div>';
					break;
    			case 'h4':
    				$fields.='
			<div class="col-12">
				<h4 class="pt-15">'.$input['label'].'</h4>
			</div>';
					break;
				case 'h5':
    				$fields.='
			<div class="col-12">
				<h5 class="pt-15">'.$input['label'].'</h5>
			</div>';
					break;
				case 'h6':
    				$fields.='
			<div class="col-12">
				<h6 class="pt-15">'.$input['label'].'</h6>
			</div>';
					break;
    			case 'catatan':
    				$fields.='
			<div class="col-12">
				<p>'.$input['label'].'</p>
			</div>';
					break;
				case 'textarea':
    				$fields.='
    		<div class="col-12 full-only"></div>
			<div class="form-group col-md-7 col-sm-12">
			    <label>'.$input['label'].'</label>
			    <textarea class="form-control" name="'.$snake_cased_label.'" rows="5"> </textarea>
			</div>
			<div class="col-12 full-only"></div>';
					break;
    			case 'checkboxes':
    				$fields.='
			<div class="col-12">
				<h5 class="pt-15">'.$input['label'].'</h5>
			</div>';

    				foreach ($input['opsi'] as $opsi) {
						$snake_cased_opsi = str_replace(" ", "_", strtolower($opsi['deskripsi']));
   						$fields.='
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="'.$snake_cased_label.'_'.$snake_cased_opsi.'">
			            <span class="css-control-indicator"></span> '.$opsi['deskripsi'].'
			        </label>
			    </div>
			</div>';
    				}
    				$fields.='
			<div class="col-12">
				&nbsp;
			</div>';
    				break;
    			case 'radio':
    				$fields.='
			<div class="col-12">
				<h5 class="pt-15">'.$input['label'].'</h5>
			</div>';

    				foreach ($input['opsi'] as $opsi) {
   						$fields.='
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="'.$snake_cased_label.'" value="'.$opsi['deskripsi'].'">
			            <span class="css-control-indicator"></span> '.$opsi['deskripsi'].'
			        </label>
			    </div>
			</div>';
    				}
    				$fields.='
			<div class="col-12">
				&nbsp;
			</div>';
    				break;
    			case 'dropdown':
					$fields.='
			<div class="form-group col-md-3 col-sm-12">
			    <label>'.$input['label'].'</label>
	            <select name="'.$snake_cased_label.'" class="form-control form-control-lg js-select2" id="'.$snake_cased_label.'" data-placeholder="Pilih '.$input['label'].'" style="width: 100%;">
	                <option value="">Silahkan Pilih</option>';
	                        foreach ($input['opsi'] as $opsi) {
								$snake_cased_opsi = str_replace(" ", "_", strtolower($opsi['deskripsi']));
		   						$fields.='
					<option value="'.$opsi['deskripsi'].'">'.$opsi['deskripsi'].'</option>';
		    				}

		    			$fields.= '
    			</select>
			</div>';
    				break;
    			default:
    				$fields.='
			<div class="form-group col-md-3 col-sm-12">
			    <label>'.$input['label'].'</label>
			    <input type="text" class="form-control" name="'.$snake_cased_label.'" >
			</div>';
    				break;
    		}
    	}
    	return $fields;
    }
}