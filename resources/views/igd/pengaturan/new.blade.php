@extends('igd.layouts.main')

@section('title')
Pengaturan - IGD - Medify
@endsection

@section('subtitle')
Buat Ruangan Baru - IGD
@endsection

@section('content')


<main id="main-container">
	@include('igd.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="block text-center pb-100">
					<div class="block-content block-content text-left">
						<h4>Buat Ruangan Baru IGD</h4>
						<hr>
					</div>
					<div class="row justify-content-center">
						<div class="col-md-6">
							<form method="POST" action="{{url()->current()}}" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="form-group text-left">
									<label for="nama-ruangan">Nama Ruangan</label>
									<input type="text" class="form-control" id="nama-ruangan" name="name" 
									required placeholder="Nama ruangan">
								</div>
								<div class="form-group text-left">
									<label for="level-ruangan">Level</label>
									<select class="form-control" style="width: 100%;" id="level-ruangan" name="level" required="required">
										@for ($i = 1; $i <= 5; $i++)
									        <option value="{{$i}}">{{ $i }}</option>
									    @endfor
		                            </select>
								</div>
								<div class="row justify-content-center">
									<div class="col-md-12">
										<button class="btn btn-primary btn-hero pull-right">Simpan</button>
									</div>
								</div>
							</div>
						</div>
					</form>

					
				</div>

			</div>
		</div>
	</div>
</main>
@endsection