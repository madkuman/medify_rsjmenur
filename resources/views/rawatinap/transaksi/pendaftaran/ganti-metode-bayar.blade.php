@extends('rawatinap.layouts.main')

@section('title')
Ganti Metode Bayar - Pendaftaran Pasien ke Rawat Inap
@endsection

@section('subtitle')
Ganti Metode Bayar - Pendaftaran Pasien ke Rawat Inap
@endsection

@section('content')

<main id="main-container">
	@include('rawatinap.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-xl-12 text-center py-20">
				<h3 class="mb-5">Konfirmasi Metode Pembayaran</h3>
				<h5 class="text-muted font-w400">Pendaftaran Pasien ke Rawat Inap</h5>
			</div>
		</div>
		<div class="row row-deck justify-content-center">
			<div class="col-md-3">
				<div class="block text-center" href="javascript:void(0)">
					<div class="block-content block-content-full block-content-sm bg-pulse">
						<span class="font-w600 text-white">Pasien</span>
					</div>
					<div class="block-content block-content-full bg-pulse-lighter">
						<img class="img-avatar img-avatar-thumb" src="{{asset($pasien->photo_thumb)}}" alt="">
					</div>
					<div class="block-content">
						<h4 class="mb-5">{{$pasien->name}}</h4>
						<h6 class="font-w400">
							@if($pasien->gender == 1) Laki laki
							@else Perempuan
							@endif, {{$pasien->age}}
						</h6>
						<ul class="list-unstyled text-left">
							<li><i class="fa fa-address-card mr-5" data-toggle="tooltip" data-placement="top" title="Nomor Rekam Medis">
								
							</i> {{$pasien->no_rm}}</li>
							<li><i class="fa fa-map-pin mr-10" data-toggle="tooltip" data-placement="top" title="Alamat"></i> {{$pasien->address}}</li>
						</ul>

					</div>
				</div>
			</div>
			<div class="col-lg-9 col-sm-12">
				<div class="block rounded block-transparent mb-20">
	                	<div class="block-header">
		                    <h3 class="block-title">Edit Pembayaran</h3>
	                	</div>
	                	<div class="block-content py-0">
		                    <form class="js-validation-be-contact" action="{{url('rawatinap/transaksi/pendaftaran/ganti-metode-bayar')}}" method="post">
		                    	<input type="hidden" value="{{$transaksi}}" name="transaksi">
		                        {{ csrf_field() }}
		                        <div class="form-group row">
		                            <div class="col-8">
		                                <label for="be-contact-name">Pembayaran Utama</label>
		                                <select class="form-control" data-size="5" id="identitas-edit-asuransi" name="pembayaran_utama_id" style="width: 100%;">
		                                    @foreach($metode as $item)
		                                    @if($item->id == $kasus->pasien_pembayaran_id)
		                                        <option value="{{$item->id}}" selected="selected">{{$item->perusahaan->nama}} - {{$item->no_asuransi}}</option>
		                                    @else
		                                        <option value="{{$item->id}}">{{$item->perusahaan->nama}} - {{$item->no_asuransi}}</option>
		                                    @endif
		                                    @endforeach
		                                </select>
		                            </div>
		                        </div>
		                        <hr>
		                        <h5 class="mb-0">Pembayaran Tambahan</h5>
		                        <p>Digunakan jika pasien melakukan IUR, naik kelas, atau pihak penjamin utama <br class="full-only">tidak dapat memenuhi seluruh tagihan pasien.</p>
		                       
		                        @if(count($kasus->pembayaranTambahan) > 0)
		                            @foreach($kasus->pembayaranTambahan as $item)
		                                @include('kasus.datamedis.content.identitas.components.select-edit-pembayaran-tambahan',['active_select_pembayaran_tambahan' => $item->pasien_pembayaran_id])
		                            @endforeach
		                        @else
		                            @include('kasus.datamedis.content.identitas.components.select-edit-pembayaran-tambahan',['active_select_pembayaran_tambahan' => 0])
		                        @endif
		                        <div id="append-pembayaran-tambahan-container">
		                        </div>
		                        <div class="row">
		                            <div class="col-lg-10 col-sm-12 text-center mt-20 mb-20">
		                                <button type="button" class="btn btn-primary btn-circle" id="btn-add-edit-pembayaran-tambahan"><i class="fa fa-plus"></i></button>
		                            </div>
		                            <div class="col-lg-10 col-sm-12 text-center">
		                            	<p>Jika informasi pembayaran kurang lengkap atau menambahkan pembayaran <a href="{{url('pasien/'.$pasien->id)}}">Klik Disini</a></p>
		                            </div>
		                        </div>
		                        <hr>
		                        <div class="form-group row">
		                            <div class="col-12 text-center">
		                                <button type="submit" class="btn-alt btn-click-animate btn-hero btn-primary min-width-175 pull-right">
		                                    <i class="fa fa-send mr-5"></i> Simpan
		                                </button>
		                            </div>
		                        </div>
		                    </form>
		                </div>
	            	</div>
			</div>
		</div>
	</div>
</main>



@endsection

@section('js')
<script type="text/javascript">
	$('#btn-add-edit-pembayaran-tambahan').click(function(){
		content = `@include('kasus.datamedis.content.identitas.components.select-edit-pembayaran-tambahan',['active_select_pembayaran_tambahan' => 0])`
		$('#append-pembayaran-tambahan-container').append(content)
	})
	$(document).on("click", ".btn-delete-edit-pembayaran-pembayaran", function(){ 
		$(this).parent().parent().remove();
	})
</script>
@endsection