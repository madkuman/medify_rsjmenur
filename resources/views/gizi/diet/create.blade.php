@extends('gizi.layouts.index')

@section('title')
Gizi Bahan Baru
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Bahan Baru
			</h3>
		</div>
		<div class="block-content">
			<!--ketika dikoding ini diganti ya action sama methodnya -->
			<form action="{{url('gizi/bahan/simpan')}}" method="POST">
			{{csrf_field()}}
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Nama Bahan</label>
							<input type="text" class="form-control" placeholder="Nama Bahan" name="nama">
						</div>
						<div class="form-group">
							<label>Satuan Bahan</label>
							<input type="text" class="form-control" placeholder="Satuan Bahan" name="satuan">
						</div>
						<div class="form-group">
							<label>Minimal Stok</label>
							<input type="text" class="form-control" placeholder="Minimal Stok" name="minimal_stok">
							<small>Sistem akan memberikan warning jika ada stok yang mencapai atau melebihi batas minimal</small>
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