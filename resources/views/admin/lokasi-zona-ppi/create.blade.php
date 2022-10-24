@extends('layouts.main-dashboard')

@section('title')
Admin - Input Lokasi Baru
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				@if(empty($data))
				Input Lokasi Baru
				@else
				Edit Nama Lokasi
				@endif
			</h3>
		</div>
		<div class="block-content">
			<!--ketika dikoding ini diganti ya action sama methodnya -->
			<form action="{{url('admin/lokasi-zona-ppi/simpan')}}" method="POST" id="formSubmit" >
			{{csrf_field()}}
			@if(!empty($data))
			<input type="hidden" name="id" value="{{$data->id}}">
			@endif			
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Nama Lokasi</label>
							<input type="text" class="form-control" placeholder="Nama Lokasi" name="zona" 
							@if(!empty($data))
							value="{{$data->zona ?? ''}}"
							@endif autocomplete="off" required="">
							<small>Wajib Diisi</small>
						</div>
						<div class="form-group">
							<label>Deskripsi</label>
							<input type="text" class="form-control" placeholder="Nama Lokasi" name="deskripsi" 
							@if(!empty($data))
							value="{{$data->deskripsi ?? ''}}"
							@endif autocomplete="off" required="">
							<small>Wajib Diisi</small>
						</div>
						<div class="form-group">
							<button class="btn btn-info btn-hero pull-right btn-submit" type="submit">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('js')



<script type="text/javascript">
	jQuery('.js-dataTable-full').dataTable({
		"ordering": true,
		pageLength: 8,
		lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
		autoWidth: false
	});
</script>

@endsection