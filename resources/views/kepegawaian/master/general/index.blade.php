@extends('kepegawaian.layouts.main')

@section('title')
Pengaturan Umum
@endsection

@section('subtitle')
Pengaturan Umum
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Pengaturan Umum
			</h3>
		</div>
		<div class="block-content">
			<div class="row">
				<div class="col-lg-6 col-md-12 col-12">
					<form method="POST">
						{{csrf_field()}}
						<h5>Cuti</h5>
						<div class="form-group">
							<label>Minimal Hari Pengajuan</label>
							<input class="form-control" type="number" name="cuti_min_pengajuan_hari" value="{{$cuti_min_pengajuan_hari}}">
							<small>Jumlah hari. 30 untuk 1 bulan, 7 untuk 1 minggu</small>
						</div>
						<div class="form-group">	
							<label>Maksimal Hari Pengajuan</label>
							<input class="form-control" type="number" name="cuti_max_pengajuan_hari" value="{{$cuti_max_pengajuan_hari}}">
							<small>Jumlah hari. 30 untuk 1 bulan, 7 untuk 1 minggu</small>
						</div>
						<button class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection