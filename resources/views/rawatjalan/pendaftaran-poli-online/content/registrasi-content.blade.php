<div class="pt-50 pb-10 px-5 text-center">
	<h2 class=" font-w700 my-10 text-light"></h2>
	<h3 class=" font-w600 mb-5 text-light">Silahkan pilih poliklinik yang ingin anda daftar</h3>
</div>

<div class="row justify-content-center px-5">
	<div class="col-sm-8 col-md-7 col-xl-10">
		{!! csrf_field() !!}
		<div class="slick-slider mb-0 mt-20">
			{{-- @php 
				$id = 1; 
				$numb = 0;
				$count = 1;
				$iterasi = 0;
				$totalPoli = count($poli);
			@endphp
			@foreach($poli as $poliData)
				@php $iterasi++; @endphp
				@if($numb == 0)
					<div class="row setup-content" id="step-{{$count}}">
						@if($count != 1)
						<button class="slick-prev slick-arrow prevBtn btn-secondary" aria-label="Previous" type="button" style="">Previous</button>
						@endif
					@php $count++ @endphp
				@endif

                <div class="col-4">
                    <label class="labl">
                        <input type="radio" name="radioname" value="{{$poliData->id}}" {{$id == $poliData->id ? 'checked="checked"' : '' }}>
                        <div class="block block-bordered block-link-shadow text-center">
                            <div class="block-content">
                            	<h5 class="title mb-5 font-21">{{$poliData->name}}</h5>
							</div>
						</div>
                    </label>
                </div>

                @php $numb++; @endphp

				@if($numb == 12 || $iterasi == $totalPoli)
						@if($count != 6)
						<button class="slick-next slick-arrow nextBtn btn-secondary" aria-label="Next" type="button" style="">Next</button>
						@endif
					</div>
					@php $numb = 0 @endphp
				@endif
				
			@endforeach --}}
			<div id="poli_pasien"></div>
		</div>
	</div>

	<div class="col-sm-8 col-md-7 col-xl-5">
		<div class="form-group mt-40">
			<div class="alert alert-danger text-center d-none" id="error-message-registrasi">
			</div>
			<a href="javascript:void(0)" type="btn" class="btn btn-block btn-hero btn-noborder big-button btn-primary" id="btn-registrasi">
				<i class="fa fa-paper-plane mr-10"></i> Lanjutkan Mendaftar
			</a>
			<a href="{{url('')}}/rawatjalan/pendaftaran-poli-online" type="btn" class="btn btn-block btn-hero btn-noborder big-button btn-secondary" id="btn-registrasi-kembali">
				<i class="si si-action-undo mr-10"></i> Kembali
			</a>
		</div>
	</div>
</div>