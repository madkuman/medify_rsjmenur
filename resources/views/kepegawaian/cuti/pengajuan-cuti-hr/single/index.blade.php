@extends('kepegawaian.layouts.main')

@section('title')
Form Pengajuan Cuti
@endsection

@section('subtitle')
Cuti
@endsection

@section('content')
<div class="container">
	<h3 class="mb-0">Pengajuan Cuti</h3>
	@include('kepegawaian.cuti.components.navbar-hr')
	<div class="block mt-10">
		<div class="block-header block-header-default">
			<h3 class="block-title">Form Pengajuan Cuti
				@if($cuti->status_pengajuan == 1) <span class="badge badge-success">Disetujui</span>
				@elseif ($cuti->status_pengajuan == -1) <span class="badge badge-danger">Ditolak</span>
				@else <span class="badge badge-info">Pending</span>
				@endif
			</h3>
			<hr>
		</div>
		<div class="block-content">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-12">
					@if(count($cuti_tanggal) > $cuti_sisa)
					<div class="alert alert-danger">Kuota Cuti kurang dari Cuti yang diajukan</div>
					@endif
					<table class="table table-borderless table-sm mt-10">
						<tr>
							<th style="width:150px">ID Pengajuan</th>
							<td style="width:20px">:</td>
							<td>{{str_pad($cuti->id, 8, '0', STR_PAD_LEFT)}}</td>
						</tr>
						<tr>
							<th>Nama Pegawai</th>
							<td>:</td>
							<td>{{Auth::user()->name}}</td>
						</tr>
						<tr>
							<th>Jenis Cuti</th>
							<td>:</td>
							<td>{{$cuti->master_cuti->nama ?? ''}}</td>
						</tr>
						<tr>
							<th>Tanggal Cuti</th>
							<td>:</td>
							<td>
								{{indonesian_date($cuti->date_start)}} - {{indonesian_date($cuti->date_end)}} 
								<strong>({{count($cuti_tanggal)}} Hari)</strong>
								<br>
								<a href="javascript:void(0)" class="btn btn-sm btn-secondary mt-10 mb-10" id="detail_tanggal_cuti_button">Detail Tanggal</a>
								<div class="block hide" id="detail_tanggal_cuti_container">
									<div class="block-content"> 
										<table class="table table-bordered table-striped table-sm">
											@foreach($cuti_tanggal as $item)
											<tr>
												<td style="width:50px">{{$loop->iteration}}</td>
												<td>{{indonesian_date($item)}}</td>
											</tr>
											@endforeach
										</table>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<th>Sisa Cuti</th>
							<td>:</td>
							<td>{{$cuti_sisa ?? ''}} Hari<small> (Per Tanggal Diajukan)</small></td>
						</tr>
						<tr>
							<th>Alasan Cuti</th>
							<td>:</td>
							<td>{{$cuti->master_cuti_alasan->nama ?? ''}}</td>
						</tr>
						<tr>
							<th>Keterangan</th>
							<td>:</td>
							<td style="white-space:pre">{{$cuti->keterangan_alasan_cuti ?? ''}}</td>
						</tr>
						<tr>
							<th>Unpaid Leave</th>
							<td>:</td>
							<td>{{$cuti->bersedia_unpaid_leave == 1 ? 'Ya' : 'Tidak'}}</td>
						</tr>
						<tr>
							<th>Tanggal Pengajuan</th>
							<td>:</td>
							<td>{{indonesian_date($cuti->created_at,'d F Y H:i')}}</td>
						</tr>
					</table>
				</div>
				<div class="col-lg-6 col-md-6 col-12">
					<div style="display:none" id="block-response-form">
						<h4>Response</h4>
						<form method="POST" action="{{url()->current()}}/response">
							{{csrf_field()}}
							<div class="form-group">
								<div class="col-12">
									<div class="custom-control custom-radio custom-control-inline mb-5">
										<input class="custom-control-input" type="radio" name="status_pengajuan" id="inline-radio3" value="0" @if($cuti->status_pengajuan == 0) checked @endif>
										<label class="custom-control-label" for="inline-radio3">Pending</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline mb-5">
										<input class="custom-control-input" type="radio" name="status_pengajuan" id="inline-radio1" value="1" @if($cuti->status_pengajuan == 1) checked @endif>
										<label class="custom-control-label" for="inline-radio1">Diterima</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline mb-5">
										<input class="custom-control-input" type="radio" name="status_pengajuan" id="inline-radio2" value="-1" @if($cuti->status_pengajuan == -1) checked @endif>
										<label class="custom-control-label" for="inline-radio2">Ditolak</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Keterangan</label>
								<textarea class="form-control" name="response_keterangan">{{$cuti->response_keterangan}}</textarea>
							</div>

							<button class="btn btn-primary">Submit</button>
							@if($cuti->status_pengajuan != 0)
							<button class="btn btn-secondary" type="button" onclick="showResponseResult(1)">Batal</button>
							@endif
						</form>
					</div>
					<div style="display:none" id="block-response-result">
						<h6 class="pt-10">
							<small class="text-muted">Response Oleh</small><br>
							{{$cuti->response_oleh->name ?? ''}}<br>
							<span class="font-w400"> {{indonesian_date($cuti->response_at,'d F Y H:i')}}</span><br>
						</h6>
						<h6 class="pt-10">
							<strong>Keterangan :</strong><br>
							<span class="font-w400" style="white-space: pre;">{{$cuti->response_keterangan}}</span>
						</h6>
						<button class="btn btn-secondary" type="button" onclick="showResponseResult(0)">Edit</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<form method="post" action="{{url()->current()}}/delete" id="form-delete">
	{{ csrf_field() }}
</form>

@endsection

@section('js')
<script type="text/javascript">
	@if($cuti->status_pengajuan == 0)
	$('#block-response-form').show()
	@else
	$('#block-response-result').show()
	@endif

	function showResponseResult(show)
	{
		if(show == 1)
		{
			$('#block-response-form').hide()
			$('#block-response-result').show()
		}
		else
		{
			$('#block-response-form').show()
			$('#block-response-result').hide()
		}
	}

	$('#detail_tanggal_cuti_button').click(function(){

		if($('#detail_tanggal_cuti_container').hasClass('hide')){
			$('#detail_tanggal_cuti_container').removeClass('hide')
		}
		else{
			$('#detail_tanggal_cuti_container').addClass('hide')
		}
	})

	$(document).on('click', '.btn-delete', function(){ 
		id = $(this).data("id");
		$('#id-delete').val(id);
		swal({
			title: "Hapus",
			text: "Apakah anda yakin akan menghapus data ini?",
			showCancelButton: true,
			reverseButtons: true,
			type: 'warning',
			confirmButtonClass: "btn btn-danger",
			cancelButtonClass: "btn btn-default",
			confirmButtonText: "Hapus",
			cancelButtonText: "Batal",
			closeOnConfirm: false
		}).then(function(result) {
			if(result.value)
			{
				$('#form-delete').submit();
			}
		});
	})
</script>
@endsection