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
			<form action="{{url('gizi/seed/kirimkode')}}" method="POST">
			{{csrf_field()}}
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Jenis Makanan</label>
							<select name="JenisMakanan" id="select-jenismakanan" class="form-control js-select2" style="width: 100%;" 
							data-size="5" required="true">   
							@foreach($data['JenisMakanan'] as $JM)
							<option value="{{$JM->id}}" selected>{{$JM->nama}}</option>
							@endforeach
							<option value="" selected disabled>Pilih Jenis</option>
						</select>
						</div>
						<div class="form-group">
							<label>Kategori Makanan</label>
							<select name="KategoriMakanan" id="select-kategorimakanan" class="form-control js-select2" style="width: 100%;" 
							data-size="5" required="true">   
							@foreach($data['KategoriMakanan'] as $KM)
							<option value="{{$KM->id}}" selected>{{$KM->nama}}</option>
							@endforeach
							<option value="" selected disabled>Pilih Jenis</option>
						</select>
						</div>
						<div class="form-group">
							<label>Diet</label>
							<select name="Diet" id="select-diet" class="form-control js-select2" style="width: 100%;" 
							data-size="5" required="true">   
							@foreach($data['Diet'] as $q)
							<option value="{{$q->id}}" selected>{{$q->nama}}</option>
							@endforeach
							<option value="" selected disabled>Pilih Jenis</option>
						</select>
						</div>
						<div class="form-group">
							<label>Bentuk Makanan</label>
							<select name="BentukMakanan" id="select-bentukmakanan" class="form-control js-select2" style="width: 100%;" 
							data-size="5" required="true">   
							@foreach($data['BentukMakanan'] as $BM)
							<option value="{{$BM->id}}" selected>{{$BM->nama}}</option>
							@endforeach
							<option value="" selected disabled>Pilih Jenis</option>
						</select>
						</div>
						<div class="form-group">
							<label>Kode Diet</label>
							<input type="text" name="KodeDiet" autocomplete="off">
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
<script type="text/javascript">
	$('.js-select2').select2();
</script>
@endsection