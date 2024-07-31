@extends('kasus.layouts.main')
@section('title')
{{$kasus->judul_kasus}} - Rekonsiliasi Obat - Kasus
@endsection

@section('content')
<main id="main-container">
	@include('kasus.layouts.header')
	<div class="content">
		<div class="row">
			@include('kasus.layouts.sidebar')

			<!-- Updates -->
			<div class="col-lg-4 col-xl-9">
				<div class="row">
					<div class="col-lg-12">
						<div class="block rounded p-0">
							
							@include('kasus.farmasi.components.navbar')

							<div class="block-content px-20">
								<div class="row">
									<div class="col-12">
										{{-- <button type="button" class="btn-alt btn-primary min-width-125 pull-right openFormBtn" data-id="" data-method="create"><i class="fa fa-pencil mr-5"></i>Form Rekonsiliasi Obat Baru</button>
										<span data-toggle="modal" data-target="#addTTDPasien"><button type="button" class="btn-alt btn-primary min-width-125" data-id=""><i class="fa fa-signature"></i>Tanda Tangan Pasien</button></span>
										<a href="{{url()->current()}}/print" type="button" class="btn-alt btn-secondary min-width-125 pull-right" target="_blank"><i class="fa fa-print mr-5"></i>Print Rekonsiliasi Obat</a> --}}
									
                              @if(session('my_role_'.$kasus->nomor_kasus))
                              @if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
                              {{-- <a href="{{url()->current()}}/print" class="btn btn-info" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a> --}}
                              <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#addModal" style="float: right"><i class="fa fa-pencil" aria-hidden="true"></i> Formulir Pasien Pemantauan Terapi Obat Baru</button>
                              @endif
                              @endif
                           </div>
								</div>

								@php $count = count($formulir_pasien) @endphp
								@forelse($formulir_pasien as $i => $form_item)
								<hr>
								<div class="row">
									<div class="col-12 ">
										<div class="p-10">
											<div class="row">
												<div class="col-6 pt-5">
													<h5 class=" mb-0">Formulir Pemantauan {{$count}} </h5>
													<small>Dibuat Oleh : {{$form_item->creator->name ?? '-'}} | {{indonesian_date($form_item->created_at)}}</small>
												</div>
												<div class="col-6">
													<a href="{{ url()->current() }}/print/{{$form_item->id}}" target="_blank" class="btn btn-secondary mr-5 mb-5 pull-right">
														<i class="fa fa-print"></i>
													</a>
													{{-- <button  class="btn btn-secondary mr-5 mb-5 pull-right openFormBtn" data-method="edit" data-id="{{$rekon_item->id}}"  >
														<i class="fa fa-pencil"></i>
													</button>
													<button  class="btn btn-secondary mr-5 mb-5 pull-right deleteBtn" data-id="{{$rekon_item->id}}" >
														<i class="fa fa-trash"></i>
													</button> --}}
												</div>
											</div>

										</div>
									</div>
								</div>
								@empty
								<div class="row">
									<div class="col-12">
										<div class="text-center py-50">
											<h4 class="font-w400 mb-5">Belum ada Formulir Pasien Pemantauan Terapi Obat tersedia</h4>
											<p>Klik tombol <b>Formulir Pasien Pemantauan Terapi Obat Baru</b> untuk melakukan Formulir Pasien Pemantauan Terapi Obat Pasien</p>
										</div>
									</div>
								</div>
								@endforelse
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
</form>

@include('kasus.farmasi.modal.pemantauan-terapi-obat-form')
{{-- @include('kasus.farmasi.modal.rekonsiliasi-view') --}}
{{-- @include('kasus.farmasi.modal.rekonsiliasi-ttd-pasien') --}}
@endsection