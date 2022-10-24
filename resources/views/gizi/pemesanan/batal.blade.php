@extends('gizi.layouts.index')

@section('title')
Medify - Gizi Pemesanan
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Pembatalan Pesanan #{{$data['pemesanan']->id}}
			</h3>
		</div>
		<div class="block-content">
			<form action="{{url('gizi/pemesanan/batal')}}" method="POST">
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{$data['pemesanan']->id}}">
			<input type="hidden" name="jumlah" value="{{$jumlah}}">
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label>Pilih Waktu Makan</label>
						<br><br>
						@if($data['makan_pagi'] > 0)
						<div class="row">
							<div class="col-1 pt-5">
								<div class="custom-control custom-checkbox mt-5">
									<input class="custom-control-input" type="checkbox" name="waktu_pagi" id="waktu_pagi" value="1">
									<label class="custom-control-label" for="waktu_pagi"></label>
								</div>
							</div>
							<div class="col-4">
								<input type="text" class="form-control" value="Pagi" disabled="">
							</div>
						</div>
						@endif
						@if($data['makan_siang'] > 0)
						<div class="row mt-10">
							<div class="col-1 pt-5">
								<div class="custom-control custom-checkbox mt-5">
									<input class="custom-control-input" type="checkbox" name="waktu_siang" id="waktu_siang" value="2">
									<label class="custom-control-label" for="waktu_siang"></label>
								</div>
							</div>
							<div class="col-4">
								<input type="text" class="form-control" value="Siang" disabled="">
							</div>
						</div>
						@endif
						@if($data['makan_sore'] > 0)
						<div class="row mt-10">
							<div class="col-1 pt-5">
								<div class="custom-control custom-checkbox mt-5">
									<input class="custom-control-input" type="checkbox" name="waktu_sore" id="waktu_sore" value="3">
									<label class="custom-control-label" for="waktu_sore"></label>
								</div>
							</div>
							<div class="col-4">
								<input type="text" class="form-control" value="Sore" disabled="">
							</div>
						</div>
						@endif
						@if($data['snack_pagi'] > 0)
						<div class="row mt-10">
							<div class="col-1 pt-5">
								<div class="custom-control custom-checkbox mt-5">
									<input class="custom-control-input" type="checkbox" name="snack_pagi" id="snack_pagi" value="4">
									<label class="custom-control-label" for="snack_pagi"></label>
								</div>
							</div>
							<div class="col-4">
								<input type="text" class="form-control" value="Snack Pagi" disabled>
							</div>
						</div>
						@endif
						@if($data['snack_sore'] > 0)
						<div class="row mt-10">
							<div class="col-1 pt-5">
								<div class="custom-control custom-checkbox mt-5">
									<input class="custom-control-input" type="checkbox" name="snack_sore" id="snack_sore" value="5">
									<label class="custom-control-label" for="snack_sore"></label>
								</div>
							</div>
							<div class="col-4">
								<input type="text" class="form-control" value="Snack Sore" disabled>
							</div>
						</div>
						@endif
					</div>
					<div class="form-group">
						<button class="btn btn-hero btn-success btn-lg pull-left">Simpan</button>
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
</script>
@endsection