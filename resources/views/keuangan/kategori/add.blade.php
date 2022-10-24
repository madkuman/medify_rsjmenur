@extends('keuangan.layouts.main')

@section('title')
Tambah Kategori - Keuangan
@endsection

@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Kategori Baru
			</h3>
		</div>
		<div class="block-content">
			<!--ketika dikoding ini diganti ya action sama methodnya -->
			<form action="{{url('keuangan/pengaturan/kategori/baru/simpan')}}" method="POST">
			{{csrf_field()}}
				@if(!empty($data))
				<input type="hidden" value="{{$data->id}}" name="id">
				@endif
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Nama Kategori</label>
							<input type="text" class="form-control" placeholder="Nama Kategori" name="nama" required
							autocomplete="off"
							@if(!empty($data))
							value="{{$data->name}}"
							@endif>
						</div>
						<div class="form-group">
							<label>Sub Kategori Dari</label>
							<select name="parent" class="form-control js-select2" style="width: 100%;" data-size="5" required>   
							<option value="0" 
							@if(empty($nama))
							selected 
							@endif disabled>Pilih Kategori</option>
							@if(!empty($nama))
							<option value="{{$nama->id}}" selected>{{$nama->name}}</option>
							@endif
							@foreach($kategori as $item)
							<option value="{{$item->id}}">{{$item->name}}</option>
							@endforeach
						</select>
						</div>
						<div class="form-group">
							<label>Jenis Kategori</label>
							<select name="type" class="form-control js-select2" style="width: 100%;" data-size="5" required>   
							<option value="0" 
							@if(empty($data))
							selected 
							@endif disabled>Pilih Jenis Kategori</option>
							<option 
							@if(!empty($data))
							@if($data->type == 2)
							selected
							@endif
							@endif
							value="2">Pengeluaran</option>
							<option 
							@if(!empty($data))
							@if($data->type == 1)
							selected
							@endif
							@endif
							value="1">Pemasukan</option>
						</select>
						</div>						
						<div class="form-group">
							<label>Kode Anggaran</label>
							<input type="text" class="form-control" placeholder="Masukkan Kode Anggaran" 
							name="kode" autocomplete="off"
							@if(!empty($data))
							value="{{$data->kode_anggaran}}"
							@endif>
						</div>
						<div class="form-group">
							<label>Total Anggaran</label>
							<input type="number" class="form-control" placeholder="Masukkan Total Anggaran" 
							name="anggaran" autocomplete="off"
							@if(!empty($data))
							value="{{$data->total_anggaran}}"
							@endif>
						</div>
						<div class="form-group">
							<button class="btn btn-success btn-hero pull-right">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('js')

@endsection