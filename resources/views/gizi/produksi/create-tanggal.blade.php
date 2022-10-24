@extends('gizi.layouts.index')

@section('title')
Gizi Produksi
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				@if(!empty($id))
				Edit @else Buat @endif Produksi <small>Pilih Tanggal</small>
			</h3>
		</div>
		<div class="block-content pt-0">
			<hr>
			<form action="{{url('gizi/produksi/baru/catat-makanan')}}" method="GET">
				{{csrf_field()}}
				<input type="hidden" name="pagi" value="0">
				<input type="hidden" name="siang" value="0">
				<input type="hidden" name="sore" value="0">
				<input type="hidden" name="bantuanrekap" value="0">
				@if(!empty($id))
				<input type="hidden" name="produksi_id" value="{{$id}}">
				@endif
				<div class="row">
					<div class="col-6">
						<h6>Pilih Tanggal dan Waktu Makan<br>
							<small>Pemilihan tanggal dan waktu akan membantu anda untuk merekap hasil produksi</small>
						</h6>
						<div class="form-group">
							<label>Tanggal</label>
							<input type="text" class="js-datepicker form-control" id="filter-tanggal" name="tanggal" 
							data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" 
							autocomplete="off"
							@if($auto == 1) 
							value="{{$date}}" 
							@elseif(in_array('1',$flag)) value="{{$date}}" 
							@elseif(in_array('2',$flag)) value="{{$date}}" 
							@elseif(in_array('3',$flag)) value="{{$date}}"
							@endif 
							>
						</div>
						<div class="form-group">
							<label>Waktu Makan</label>
							<div class="custom-control custom-checkbox mb-5">
								<input class="custom-control-input" type="checkbox" name="pagi" id="filter-pagi" value="1"
								@if($auto == 1) checked 
								@elseif(in_array('1',$flag)) checked @endif 
								>
								<label class="custom-control-label" for="filter-pagi">Pagi</label>
							</div>
							<div class="custom-control custom-checkbox mb-5">
								<input class="custom-control-input" type="checkbox" name="siang" id="filter-siang" value="1"
								@if($auto == 1) checked 
								@elseif(in_array('2',$flag)) checked @endif
								>
								<label class="custom-control-label" for="filter-siang">Siang</label>
							</div>
							<div class="custom-control custom-checkbox mb-5">
								<input class="custom-control-input" type="checkbox" name="sore" id="filter-sore" value="1"
								@if($auto == 1) checked 
								@elseif(in_array('3',$flag)) checked @endif
								>
								<label class="custom-control-label" for="filter-sore">Sore</label>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<h6 class="mb-0">Bantuan Rekap Makanan</h6>
							<p>Kami dapat membantu anda untuk merekapkan makanan sehingga anda tidak perlu input makanan ulang</p>
							<div class="custom-control custom-checkbox mb-5">
								<input class="custom-control-input" type="checkbox" name="bantuanrekap" id="filter-auto" value="1"
								@if($auto == 1) checked @endif
								>
								<label class="custom-control-label" for="filter-auto">Ya Bantu Saya</label>
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-hero btn-success pull-right">Selanjutnya</button>
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