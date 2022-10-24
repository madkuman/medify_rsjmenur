@extends('kepegawaian.layouts.main')

@section('title')
Master Jabatan
@endsection

@section('subtitle')
Master Jabatan
@endsection

@section('content')
<div class="content px-0">
	<div class="row">
		<div class="col-12">
			<div class="block rounded p-0">
				<div class="block-content">
					<div class="row">
						<div class="col-12">
							<h3 class="text-center">JABATAN</h3>
						</div>
					</div>
					<div class="row justify-content-center px-20">
						<div class="col-xs-12 col-md-3 px-10">
							<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/pengaturan">
								<div class="block-content">
									<p><i class="fa fa-stethoscope fa-4x text-muted"></i></p>
									<p class="text-uppercase font-w600 font-size-lg mb-0">Jabatan</p>
								</div>
							</a>
						</div>
						<div class="col-xs-12 col-md-3 px-10">
							<a class="block rounded block-link-shadow text-center" href="{{url()->current()}}/pengaturan-jenis">
								<div class="block-content">
									<p><i class="fa fa-stethoscope fa-4x text-muted"></i></p>
									<p class="text-uppercase font-w600 font-size-lg mb-0">Jenis Jabatan</p>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection