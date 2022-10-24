@extends('kepegawaian.layouts.main')

@section('title')
Master Pendidikan
@endsection

@section('subtitle')
Master Pendidikan
@endsection

@section('content')
<div class="content px-0">
	<div class="row">
		<div class="col-12">
			<div class="block rounded p-0">
				<div class="block-content">
					<div class="row">
						<div class="col-12">
							<h3 class="text-center">Pendidikan</h3>
						</div>
					</div>
					<div class="row justify-content-center px-20">
						<div class="col-xs-12 col-md-3 px-10">
                            <a class="block rounded block-link-shadow text-center" href="{{url('kepegawaian/master')}}/gelar-pendidikan">
                                <div class="block-content">
                                    <p><i class="si si-badge fa-5x text-muted"></i></p>
                                    <p class="text-uppercase font-w600 font-size-lg mb-0">Gelar Pendidikan</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-md-3 px-10">
                            <a class="block rounded block-link-shadow text-center" href="{{url('kepegawaian/master')}}/strata-pendidikan">
                                <div class="block-content">
                                    <p><i class="fa fa-anchor fa-5x text-muted"></i></p>
                                    <p class="text-uppercase font-w600 font-size-lg mb-0">Strata Pendidikan</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-md-3 px-10">
                            <a class="block rounded block-link-shadow text-center" href="{{url('kepegawaian/master')}}/jenis-pendidikan">
                                <div class="block-content">
                                    <p><i class="fa fa-stethoscope fa-5x text-muted"></i></p>
                                    <p class="text-uppercase font-w600 font-size-lg mb-0">Jenis Pendidikan</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-md-3 px-10">
                            <a class="block rounded block-link-shadow text-center" href="{{url('kepegawaian/master')}}/institusi-pendidikan">
                                <div class="block-content">
                                    <p><i class="fa fa-university fa-5x text-muted"></i></p>
                                    <p class="text-uppercase font-w600 font-size-lg mb-0">Institusi</p>
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