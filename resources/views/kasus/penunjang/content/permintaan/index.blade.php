<div class="content pt-0">
	<div class="row">
		<div class="col-lg-12 mb-10">
			@if(session('my_role_'.$kasus->nomor_kasus))
			<a href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/penunjang/form" class="btn btn-primary min-width-125 float-right ml-10"><i class="fa fa-pencil"></i> Buat Permintaan</a>
			@endif
			<button onclick="historiPermintaan()" class="btn btn-warning min-width-125 float-right ml-10">Histori Permintaan</button>
		</div>
		@forelse($permintaan as $item)
		<div class="col-lg-12">
			<div class="block block-transparent">
				<div class="block-content ribbon ribbon-bookmark ribbon-danger">
					@php $current_transaksi = [] @endphp
					@if(isset($item->transaksi))
					@php $current_transaksi = $item->transaksi @endphp
					@endif

					@if(!empty($current_transaksi) && $current_transaksi->status)
						<div class="ribbon-box">
	                        <i class="fa fa-fw fa-check"></i> <span><b>SELESAI</b></span>
	                    </div>
	                @endif
					<h4 class="text-info font-w600 badges">
						# 
						@if($item->modul_id == 6) 
						Radiologi
						@elseif($item->modul_id == 10)
						Lab PK
						@elseif($item->modul_id == 11)
						Lab PA
						@else
						Penunjang Lain
						@endif
					</h4>
					@if(!empty($current_transaksi->detail))
					<div class="row">
						<div class="col-md-4">
							<p class="mb-0"><strong>Permintaan no. #{{$item->id}}:
							</strong></p>
							<ul>
								@foreach($current_transaksi->detail as $permintaan_item)

									@if($item->modul_id == 6) 
										@if($permintaan_item->status == 'ask' || $permintaan_item->status == 'done')
										<li>
											{{$permintaan_item->tarif->deskripsi}}
										</li>
										@endif

									@elseif($item->modul_id == 10) 
										@if($permintaan_item->status == 'ask' || $permintaan_item->status == 'done')
										<li>
											{{$permintaan_item->tarif->deskripsi}} 
											@if(!empty($permintaan_item->barcode)) 
												<a href="javascript:void(0)" onclick="cetakBarcode('{{$permintaan_item->barcode}}','{{$permintaan_item->slug}}')">
													Cetak Barcode
												</a>
											@endif
										</li>
										@endif

									@elseif($item->modul_id == 11) 
										@if($permintaan_item->status == 'ask' || $permintaan_item->status == 'done')
										<li>
											{{$permintaan_item->tarif->deskripsi}}
										</li>
										@endif
									@endif
								@endforeach
							</ul>

							@if(!empty($current_transaksi->spesimen))
							@if(count($current_transaksi->spesimen) > 0)
							<p class="mb-0"><strong>Spesimen:</strong></p>
							<ul>
								@foreach($current_transaksi->spesimen as $spesimen_item)
									<li>
                            			{{$spesimen_item->spesimen->kategori->nama}} - {{$spesimen_item->spesimen->nama}}
                            			
                                        @if(!empty($spesimen_item->keterangan))
                                        : {{$spesimen_item->keterangan}}
                                        @endif
									</li>
								@endforeach
							</ul>
							@endif
							@endif
						</div>
						@if($current_transaksi->status=='-1')
						<div class="col-md-4">
							<p class="mb-0"><strong>Status:
							</strong></p>
								<p>Dibatalkan</p>
						</div>
						<div class="col-md-4">
							<p class="mb-0"><strong>Alasan Pembatalan:
							</strong></p>
							@if(!empty($current_transaksi->alasan_batal))
								<p>{{$current_transaksi->alasan_batal}}</p>
							@endif
						</div>
						@else
						<div class="col-md-4">
							<p class="mb-0"><strong>Jadwal Pemeriksaan:
							</strong></p>
							@if(!empty($current_transaksi->inspected_at))
								<p>{{$current_transaksi->inspected_at_formatted}}</p>
							@else
								<p>Belum dijadwalkan</p>
							@endif
						</div>
						<div class="col-md-4">
							<p class="mb-0"><strong>Waktu Pemeriksaan :</strong></p>

							@if(!empty($current_transaksi->result_created_at))
								<p>{{$current_transaksi->result_created_at_formatted}}</p>

							<p class="mb-0"><strong>Pemeriksaan Yang Telah Dilakukan:</strong></p>
							<ul>
								@foreach($current_transaksi->detail as $permintaan_item)
									@if($item->modul_id == 6) 
										@if($permintaan_item->status != 'ask')
										<li>
											{{$permintaan_item->tarif->deskripsi}}
										</li>
										@endif

									@elseif($item->modul_id == 10) 
										@if($permintaan_item->status != 'ask')
										<li>
											{{$permintaan_item->tarif->deskripsi}}
										</li>
										@endif

									@elseif($item->modul_id == 11) 
										@if($permintaan_item->status != 'ask')
										<li>
											{{$permintaan_item->tarif->deskripsi}}
										</li>
										@endif
									@endif
								@endforeach
							</ul>
							@else
								<p>Belum ada pemeriksaan</p>
							@endif
						</div>
						@endif
					</div>
					<div class="row">
						<div class="col-md-12">
							<p class="mb-0"><strong>Klinis :</strong></p>
							{{$current_transaksi->keterangan}}
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<p class="mb-0"><strong>Keterangan Permintaan :</strong></p>
							{{$current_transaksi->keterangan_permintaan}}
						</div>
					</div>
						<br>
					@if($current_transaksi->status)
						@if($item->modul_id == 6)
						<button class="btn btn-hero btn-alt-primary pull-right ml-15 mt-15 text-uppercase" type="button" onclick="window.open('{{url('radiologi/transaksi/cetak/permintaan/'.$current_transaksi->slug)}}', 
                             'newwindow', 
                             `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>
						@elseif($item->modul_id == 10)
						<button class="btn btn-hero btn-alt-primary pull-right ml-15 mt-15 text-uppercase" type="button" onclick="window.open('{{url('labpk/transaksi/cetak/permintaan/'.$current_transaksi->slug)}}', 
                             'newwindow', 
                             `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>
						@elseif($item->modul_id == 11)
						<button class="btn btn-hero btn-alt-primary pull-right ml-15 mt-15 text-uppercase" type="button" onclick="window.open('{{url('labpa/transaksi/cetak/permintaan/'.$current_transaksi->slug)}}', 
                             'newwindow', 
                             `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>
						@endif
					@else
						@if($item->modul_id == 6)
						<button class="btn btn-hero btn-alt-primary pull-right ml-15 mt-15" type="button" onclick="window.open('{{url('radiologi/transaksi/cetak/permintaan/'.$current_transaksi->slug)}}', 
                             'newwindow', 
                             `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>
						@elseif($item->modul_id == 10)
						<button class="btn btn-hero btn-alt-primary pull-right ml-15 mt-15" type="button" onclick="window.open('{{url('labpk/transaksi/cetak/permintaan/'.$current_transaksi->slug)}}', 
                             'newwindow', 
                             `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>
 						@elseif($item->modul_id == 11)
						<button class="btn btn-hero btn-alt-primary pull-right ml-15 mt-15" type="button" onclick="window.open('{{url('labpa/transaksi/cetak/permintaan/'.$current_transaksi->slug)}}', 
                             'newwindow', 
                             `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>
						@endif
						<button class="btn btn-hero btn-alt-danger text-uppercase float-right mt-15" 
                        onclick="tolakTransaksi({{$current_transaksi->id}},{{$item->modul_id}},'{{$current_transaksi->slug}}')"> Batalkan Permintaan</button>
					@endif
					@else
					<h5 class="font-w400 text-danger">Transaksi #{{$item->transaksi_id}} tidak ditemukan</h5>
					@endif

					@if(isset($item->creator->avatar_thumb) && !empty($item->creator->avatar_thumb))
					<div class="float-left mr-10">
						<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
					</div>
					@else
					<div class="float-left mr-10">
						<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
					</div>
					@endif
					<h6 class="pt-10">
						<small class="text-muted">Dibuat Oleh</small><br>
						@if(isset($current_transaksi->nama_dokter) && !is_null($current_transaksi->nama_dokter))
							{{$current_transaksi->nama_dokter}}
						@else
							{{$item->creator->name}}
						@endif
						<br>
						{{date('d F y, H:i', strtotime($item->created_at))}}
					</h6>


					<hr>
				</div>
			</div>

			
		</div>
		@empty
		<div class="col-12 text-center py-50">
                <h4 class="font-w400 mb-5">Belum ada permintaan</h4><br>
                <p>Klik tombol <b>Buat Permintaan</b> untuk menambahkan permintaan baru</p>
            </div>
		@endforelse
		
	</div>
	<form method="post" action="" id="formTolak">
            {{csrf_field()}}
            <input type="hidden" name="dariKasus" value="1">
            <input type="hidden" name="modulID" id="modulId">
            <input type="hidden" id="tolakId" name="id">
            <input type="hidden" id="tolakketerangan" name="alasan_batal">
    </form>
</div>