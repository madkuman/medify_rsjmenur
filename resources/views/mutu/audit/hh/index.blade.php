@extends('mutu.layouts.main')

@section('title')
Mutu - Audit - Medify
@endsection

@section('subtitle')
Audit (HH)
@endsection

@section('css')
<style type="text/css">
	table.dataTable td, table.dataTable th {
		box-sizing: border-box;
		font-size: 80%;
	}
</style>
@endsection

@section('content')


<main id="main-container">
	@include('mutu.layouts.navbar')
	<div class="content">
		<div class="row">
			<div class="col-12">
				<div class="block">
					<div class="content pt-20">
						<div class="row">
							<div class="col-lg-4">
								<a class="pl-20" href="{{url()->previous()}}"><i class="si si-action-undo"></i>&nbsp;&nbsp;&nbsp;Kembali ke halaman sebelumnya</a>
							</div>
							<div class="col-lg-4">
								<select class="form-control js-select2"  data-placeholder="Pilih User" name="user_id" id="selectUserID">
									<option value=""></option>
									@if(!empty($user))
									<option value="{{$user->id}}" selected>{{$user->name}}</option>
									@endif
								</select>
							</div>
							<div class="col-lg-4 mb-20">
								<button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-hh" @if(empty($user)) disabled="" @endif><i class="fa fa-pencil" ></i>Buat Audit HH</button>
							</div>
							<div class="col-12 autoscroll-x" style="">
								<table class="table table-bordered table-vcenter js-dataTable-full">
									<thead>
										<tr>
											<th rowspan="2" style="width: 25px">#</th>
											<th rowspan="2" style="width: 200px">Tgl</th>
											<th rowspan="2" style="width: 50px">Mulai</th>
											<th rowspan="2" style="width: 50px">Selesai</th>
											<th colspan="5" class="text-center">Indikasi</th>
											<th colspan="4" class="text-center">Tindakan HH</th>
											<th rowspan="2" style="min-width: 120px" class="text-right">Info</th>
										</tr>
										<tr>
											<th style="width: 100px; border-top: 1px solid gainsboro;">Sebelum Kontak</th>
											<th style="width: 100px; border-top: 1px solid gainsboro;">Sebelum Aseptic</th>
											<th style="width: 100px; border-top: 1px solid gainsboro;">Setelah darah c.tubuh</th>
											<th style="width: 100px; border-top: 1px solid gainsboro;">Setelah kontak</th>
											<th style="width: 100px; border-top: 1px solid gainsboro;">Setelah lingkungan pasien</th>
											<th style="width: 100px; border-top: 1px solid gainsboro;">HR</th>
											<th style="width: 100px; border-top: 1px solid gainsboro;">HW</th>
											<th style="width: 100px; border-top: 1px solid gainsboro;">Tidak HH</th>
											<th style="width: 100px; border-top: 1px solid gainsboro;">Glove</th>
										</tr>
									</thead>
									<tbody>
										@if(isset($hh))
										@forelse($hh as $item)
										<tr>
											<td>{{$loop->iteration}}</td>
											<td>{{indonesian_date($item->tanggal)}}</td>
											<td class="text-center">{{$item->jam_mulai}}</td>
											<td class="text-center">{{$item->jam_selesai}} </td>
											<td class="text-center">@if($item->sebelum_kontak) <i class="fa fa-check"></i> @endif </td>
											<td class="text-center">@if($item->sebelum_aseptik) <i class="fa fa-check"></i> @endif </td>
											<td class="text-center">@if($item->setelah_darah) <i class="fa fa-check"></i> @endif </td>
											<td class="text-center">@if($item->setelah_kontak) <i class="fa fa-check"></i> @endif </td>
											<td class="text-center">@if($item->setelah_lingkungan_px) <i class="fa fa-check"></i> @endif </td>
											<td class="text-center">@if($item->tindakan_hr) <i class="fa fa-check"></i> @endif </td>
											<td class="text-center">@if($item->tindakan_hw) <i class="fa fa-check"></i> @endif </td>
											<td class="text-center">@if($item->tindakan_tidak_hh) <i class="fa fa-check"></i> @endif </td>
											<td class="text-center">@if($item->tindakan_glove) <i class="fa fa-check"></i> @endif </td>
											<td>
												<button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right deleteBtn" data-id="{{$item->id}}">
													<i class="fa fa-trash"></i>
												</button>
												<button type="button" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 float-right edit-button" data-id="{{$item->id}}" data-no="{{$loop->iteration}}">
													<i class="fa fa-pencil"></i>
												</button>
												<button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 float-right" data-toggle="tooltip" data-html="true" title="@include('mutu.audit.hh.components.tooltip')" data-placement="left">
													<i class="fa fa-info"></i>
												</button>
											</td>
										</tr>
										@empty
										@endforelse
										@else
										<tr>
											<td colspan="14" class="text-center" rowspan="3">
												<br>
												<h4 class="font-w400 mb-5">Belum ada Audit HH</h4>
												<p>Klik tombol <b>Buat Audit HH</b> untuk menambahkan Audit HH baru</p>
											</td>
										</tr>
										@endif
									</tbody>
								</table>
								@include('mutu.audit.hh.components.modal-create')
								@include('mutu.audit.hh.components.modal-edit')
							</div>
						</div>
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
@endsection

@section('js')
<script type="text/javascript">
	
	$('#selectUserID').select2({
		ajax: {
			url: API_URL+'/users/search',
			data: function(params){
				return {
					keyword: params.term, 
				};
			},
			processResults: function (data, params) {
				var  res = JSON.parse(data);
				return {
					results: $.map(res, function(obj) {
						return { id: obj.id, text: obj.name };
					})
				};
			},
			cache: true
		}
	});
	$('#selectUserID').change(function(){
		var user_id = $('#selectUserID').val()
		window.location.href = "{{url()->current()}}?user_id="+user_id;
	})
	count = 0;
	addCheckboxes()
	$('.btn-tambah-kesempatan').click(function(){
		addCheckboxes()
	})

	function addCheckboxes()
	{
		count += 1
		content = 
				`
				<div class="row">
					<div class="col-md-12 pt-20">
						<h5>Kesempatan #`+count+`</h5>
						<input type='hidden' value='{{$user->id ?? 0}}' name="user_id">
						<input type='hidden' value='`+count+`' name="index[]">
						<hr>
					</div>
					<div class="col-md-6">
						<h6>Parameter</h6>
						<div class="form-group mb-5">
							<label class="css-control css-control-primary css-checkbox">
								<input type="checkbox" class="css-control-input sebelum-checkbox" name="sebelum_kontak_`+count+`" value="1">
								<span class="css-control-indicator"></span>Sebelum Kontak
							</label>
						</div>
						<div class="form-group mb-5">
							<label class="css-control css-control-primary css-checkbox">
								<input type="checkbox" class="css-control-input sebelum-checkbox" name="sebelum_aseptik_`+count+`" value="1">
								<span class="css-control-indicator"></span>Sebelum Aseptic
							</label>
						</div>
						<div class="form-group mb-5">
							<label class="css-control css-control-primary css-checkbox">
								<input type="checkbox" class="css-control-input setelah-checkbox" name="setelah_darah_`+count+`" value="1">
								<span class="css-control-indicator"></span>Setelah darah c.tubuh
							</label>
						</div>	
						<div class="form-group mb-5">
							<label class="css-control css-control-primary css-checkbox">
								<input type="checkbox" class="css-control-input setelah-checkbox" name="setelah_kontak_`+count+`" value="1">
								<span class="css-control-indicator"></span>Setelah kontak
							</label>
						</div>
						<div class="form-group mb-5">
							<label class="css-control css-control-primary css-checkbox">
								<input type="checkbox" class="css-control-input setelah-checkbox" name="setelah_lingkungan_px_`+count+`" value="1">
								<span class="css-control-indicator"></span>Setelah lingkungan pasien
							</label>
						</div>
					</div>
					<div class="col-md-4">
						<h6>Tindakan</h6>
						<div class="form-group mb-5">
							<label class="css-control css-control-primary css-checkbox">
								<input type="checkbox" class="css-control-input" name="tindakan_hr_`+count+`" value="1">
								<span class="css-control-indicator"></span>HR
							</label>
						</div>
						<div class="form-group mb-5">
							<label class="css-control css-control-primary css-checkbox">
								<input type="checkbox" class="css-control-input" name="tindakan_hw_`+count+`" value="1">
								<span class="css-control-indicator"></span>HW
							</label>
						</div>
						<div class="form-group mb-5">
							<label class="css-control css-control-primary css-checkbox">
								<input type="checkbox" class="css-control-input" name="tindakan_tidak_hh_`+count+`" value="1">
								<span class="css-control-indicator"></span>Tidak HH
							</label>
						</div>
						<div class="form-group mb-5">
							<label class="css-control css-control-primary css-checkbox">
								<input type="checkbox" class="css-control-input" name="tindakan_glove_`+count+`" value="1">
								<span class="css-control-indicator"></span>Glove
							</label>
						</div>
					</div>
					<div class="col-md-1">
						<button class="btn btn-danger deleteKesempatan">Hapus</button>
					</div>
				</div>
				`
		
		$('#tindakan-checkboxes-container').append(content)
		$('#modal-create-hh #count').val(count)
	}
</script>

<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');
	});

	$('.edit-button').click(function(){
		id = $(this).data("id");
		no = $(this).data("no");
		$('#modal-edit-hh').modal('show')
		$('#modal-edit-hh .block-container').hide()
		$('#modal-edit-hh .block-loading').show()
		
		$.ajax({
			type: "GET",
			url: API_URL+'/mutu/audit/hh/'+id,
			dataType : "json",
			processData: false,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function (response) {
				$('#tindakan-checkboxes-container-edit').empty()
				$('.input-edit-tanggal').val(response.tanggal_format)
				$('.input-edit-jam-mulai').val(response.jam_mulai)
				$('.input-edit-jam-selesai').val(response.jam_selesai)
				content = 
				`
				<div class="col-md-12 pt-20">
				<h5>Kesempatan #`+no+`</h5>
				<input type='hidden' value='{{$user->id ?? 0}}' name="user_id">
				<hr>
				</div>
				<div class="col-md-6">
					<h6>Parameter</h6>
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-checkbox">
							<input type="checkbox" class="css-control-input" name="sebelum_kontak" value="1" `+((response.sebelum_kontak) ? 'checked' : '')+`>
							<span class="css-control-indicator"></span>Sebelum Kontak
						</label>
					</div>
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-checkbox">
							<input type="checkbox" class="css-control-input" name="sebelum_aseptik" value="1" `+((response.sebelum_aseptik) ? 'checked' : '')+`>
							<span class="css-control-indicator"></span>Sebelum Aseptic
						</label>
					</div>
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-checkbox">
							<input type="checkbox" class="css-control-input" name="setelah_darah" value="1" `+((response.setelah_darah) ? 'checked' : '')+`>
							<span class="css-control-indicator"></span>Setelah darah c.tubuh
						</label>
					</div>	
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-checkbox">
							<input type="checkbox" class="css-control-input" name="setelah_kontak" value="1" `+((response.setelah_kontak) ? 'checked' : '')+`>
							<span class="css-control-indicator"></span>Setelah kontak
						</label>
					</div>
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-checkbox">
							<input type="checkbox" class="css-control-input" name="setelah_lingkungan_px" value="1" `+((response.setelah_lingkungan_px) ? 'checked' : '')+`>
							<span class="css-control-indicator"></span>Setelah lingkungan pasien
						</label>
					</div>
				</div>
				<div class="col-md-6 pt-20">
					<h6>Tindakan</h6>
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-checkbox">
							<input type="checkbox" class="css-control-input" name="tindakan_hr" value="1" `+((response.tindakan_hr) ? 'checked' : '')+`>
							<span class="css-control-indicator"></span>HR
						</label>
					</div>
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-checkbox">
							<input type="checkbox" class="css-control-input" name="tindakan_hw" value="1" `+((response.tindakan_hw) ? 'checked' : '')+`>
							<span class="css-control-indicator"></span>HW
						</label>
					</div>
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-checkbox">
							<input type="checkbox" class="css-control-input" name="tindakan_tidak_hh" value="1" `+((response.tindakan_tidak_hh) ? 'checked' : '')+`>
							<span class="css-control-indicator"></span>Tidak HH
						</label>
					</div>
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-checkbox">
							<input type="checkbox" class="css-control-input" name="tindakan_glove" value="1" `+((response.tindakan_glove) ? 'checked' : '')+`>
							<span class="css-control-indicator"></span>Glove
						</label>
					</div>
				</div>
				`
		
				$('#tindakan-checkboxes-container-edit').append(content)
				$('#formEdit').attr('action', '{{url()->current()}}/edit/'+id);
				$('#modal-edit-hh .block-container').show()
				$('#modal-edit-hh .block-loading').hide()
			},
			error: function (response) {
				alert('Error!'+response);  
			}
		});


	});


	$(document).ready(function(){
		$(".deleteBtn").click(function(e){
			e.preventDefault();
			id = $(this).data("id");
			$('#deleteInputId').val(id);
			swal({
				title: "Hapus",
				text: "Apakah anda yakin akan menghapus data ini?",
				showCancelButton: true,
				reverseButtons: true,
				type: 'warning',
				confirmButtonClass: "btn btn-danger",
				cancelButtonClass: "btn btn-default",
				confirmButtonText: "Hapus",
				cancelButtonText: "Kembali",
				closeOnConfirm: false
			}).then(function(result) {
				if(result.value)
				{
					$('#formDelete').submit();
				}
			});
		});
	});

	$(document).on('click', '.sebelum-checkbox', function(){
		var checkIfChecked = $(this).parent().parent().parent().find('.sebelum-checkbox:checked').length > 0;
		if(checkIfChecked)
		{
			$(this).parent().parent().parent().find('.setelah-checkbox').attr("disabled", true);
			$(this).parent().parent().parent().find('.setelah-checkbox').parent().addClass("disabled");
		}
		else
		{
			$(this).parent().parent().parent().find('.setelah-checkbox').attr("disabled", false);
			$(this).parent().parent().parent().find('.setelah-checkbox').parent().removeClass("disabled")
		}
	});

	$(document).on('click', '.setelah-checkbox', function(){
		var checkIfChecked = $(this).parent().parent().parent().find('.setelah-checkbox:checked').length > 0;
		if(checkIfChecked)
		{
			$(this).parent().parent().parent().find('.sebelum-checkbox').attr("disabled", true);
			$(this).parent().parent().parent().find('.sebelum-checkbox').parent().addClass("disabled");
		}
		else
		{
			$(this).parent().parent().parent().find('.sebelum-checkbox').attr("disabled", false);
			$(this).parent().parent().parent().find('.sebelum-checkbox').parent().removeClass("disabled")
		}
	});

	$(document).on('click', '.deleteKesempatan', function(){
		$(this).parent().parent().remove()
		count -= 1
		$('#modal-create-hh #count').val(count)
	});



</script>




<script type="text/javascript">
    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false
    });
</script>
@endsection