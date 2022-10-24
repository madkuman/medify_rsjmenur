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
			<form action="{{url('admin/lokasi/simpan')}}" method="POST" id="formSubmit" >
			{{csrf_field()}}
			@if(!empty($data))
			<input type="hidden" name="id" value="{{$data->id}}">
			@endif			
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Nama Lokasi</label>
							<input type="text" class="form-control" placeholder="Nama Lokasi" name="nama" 
							@if(!empty($data))
							value="{{$data->nama ?? ''}}"
							@endif autocomplete="off" required="">
							<small>Wajib Diisi</small>
						</div>
						<div class="form-group">
							@php $selected = $data->lokasi_departemen_id ?? ''@endphp
							<label>Departemen</label>
							<select class="js-select2 form-control" name="lokasi_departemen_id" required="">
								<option value="" disabled="" selected="">Pilih Departemen</option>
								@foreach($lokasi_departemen as $item)
								<option value="{{$item->id}}" @if($item->id == $selected) selected @endif>{{$item->nama}}</option>
								@endforeach
							</select>
							<small>Wajib Diisi</small>
						</div>
						<div class="form-group">
							@php $selected = $data->kategori_keuangan_id ?? '' @endphp
							<label>Kategori Keuangan</label>
							<select class="js-select2 form-control" name="kategori_keuangan_id" required="">
								<option value="" disabled="" selected="">Pilih Kategori</option>
								@foreach($kategori_keuangan as $item)
								<option value="{{$item->id}}" @if($item->id == $selected) selected @endif>{{$item->name}}</option>
								@endforeach
							</select>
							<small>Wajib Diisi</small>
						</div>
						<div class="form-group">
							@php $selected = $data->zona_ppi_id ?? '' @endphp
							<label>Zona PPI</label>
							<select class="js-select2 form-control" name="zona_ppi_id">
								<option value="" disabled="" selected="">Pilih Zona</option>
								@foreach($zona_ppi as $item)
								<option value="{{$item->id}}" @if($item->id == $selected) selected @endif>{{$item->zona}}</option>
								@endforeach
							</select>
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