<div class="modal" id="modal-penunjang" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Daftar Penunjang</h3>
                </div>
                <div class="block-content">
                    @forelse($penunjang as $item)
                    @php($item->transaksi_temp = $item->transaksi)
                    <div class="col-lg-12">
                        <div class="block block-transparent">
                            <div class="block-content ribbon ribbon-bookmark ribbon-danger">
                                @if(isset($item->transaksi_temp) && $item->transaksi_temp->status)
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
                                @if(!empty($item->transaksi_temp->detail))
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="mb-0"><strong>Permintaan no. #{{$item->id}}:
                                        </strong></p>
                                        <ul>
                                            @foreach($item->transaksi_temp->detail as $permintaan_item)

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
                                    </div>
                                    @if($item->transaksi_temp->status=='-1')
                                    <div class="col-md-4">
                                        <p class="mb-0"><strong>Status:
                                        </strong></p>
                                            <p>Dibatalkan</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mb-0"><strong>Alasan Pembatalan:
                                        </strong></p>
                                        @if(!empty($item->transaksi_temp->alasan_batal))
                                            <p>{{$item->transaksi_temp->alasan_batal}}</p>
                                        @endif
                                    </div>
                                    @else
                                    <div class="col-md-4">
                                        <p class="mb-0"><strong>Jadwal Pemeriksaan:
                                        </strong></p>
                                        @if(!empty($item->transaksi_temp->inspected_at))
                                            <p>{{$item->transaksi_temp->inspected_at_formatted}}</p>
                                        @else
                                            <p>Belum dijadwalkan</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <p class="mb-0"><strong>Pemeriksaan :</strong></p>

                                        @if(!empty($item->transaksi_temp->result_created_at))
                                            <p>{{$item->transaksi_temp->result_created_at_formatted}}</p>

                                        <ul>
                                            @foreach($item->transaksi_temp->detail as $permintaan_item)
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
                                        <p class="mb-0"><strong>Keterangan :</strong></p>
                                        {{$item->transaksi_temp->keterangan}}
                                    </div>
                                </div> 
                                <br>
                                @if($item->transaksi_temp->status)
                                    @if($item->modul_id == 6)
                                    <button class="btn btn-hero btn-alt-primary pull-right ml-15 mt-15 text-uppercase" type="button" onclick="window.open('{{url('radiologi/transaksi/cetak/permintaan/'.$item->transaksi_temp->slug)}}', 
                                         'newwindow', 
                                         `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>
                                    @elseif($item->modul_id == 10)
                                    <button class="btn btn-hero btn-alt-primary pull-right ml-15 mt-15 text-uppercase" type="button" onclick="window.open('{{url('labpk/transaksi/cetak/permintaan/'.$item->transaksi_temp->slug)}}', 
                                         'newwindow', 
                                         `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>
                                    @elseif($item->modul_id == 11)
                                    <button class="btn btn-hero btn-alt-primary pull-right ml-15 mt-15 text-uppercase" type="button" onclick="window.open('{{url('labpa/transaksi/cetak/permintaan/'.$item->transaksi_temp->slug)}}', 
                                         'newwindow', 
                                         `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>
                                    @endif
                                @else
                                    @if($item->modul_id == 6)
                                    <button class="btn btn-hero btn-alt-primary pull-right ml-15 mt-15" type="button" onclick="window.open('{{url('radiologi/transaksi/cetak/permintaan/'.$item->transaksi_temp->slug)}}', 
                                         'newwindow', 
                                         `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>
                                    @elseif($item->modul_id == 10)
                                    <button class="btn btn-hero btn-alt-primary pull-right ml-15 mt-15" type="button" onclick="window.open('{{url('labpk/transaksi/cetak/permintaan/'.$item->transaksi_temp->slug)}}', 
                                         'newwindow', 
                                         `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>
                                    @elseif($item->modul_id == 11)
                                    <button class="btn btn-hero btn-alt-primary pull-right ml-15 mt-15" type="button" onclick="window.open('{{url('labpa/transaksi/cetak/permintaan/'.$item->transaksi_temp->slug)}}', 
                                         'newwindow', 
                                         `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>
                                    @endif
                                    <button class="btn btn-hero btn-alt-danger text-uppercase float-right mt-15" 
                                    onclick="tolakTransaksi({{$item->transaksi_temp->id}},{{$item->modul_id}},'{{$item->transaksi_temp->slug}}')"> Batalkan Permintaan</button>
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
                                    @if(isset($item->transaksi_temp->nama_dokter) && !is_null($item->transaksi_temp->nama_dokter))
                                        {{$item->transaksi_temp->nama_dokter}}
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                    <!-- <button type="submit" class="btn btn-alt-primary" id="btn-simpan" disabled="true">
                        <i class="fa fa-check"></i> Simpan
                    </button> -->
            </div>
        </div>
    </div>
</div>