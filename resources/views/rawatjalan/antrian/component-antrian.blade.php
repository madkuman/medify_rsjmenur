<div class="form-group">
    <div class="input-group input-group-lg">
        <input type="text" id="myInput" class="js-icon-search form-control" placeholder="Cari Pasien" autofocus>
    </div>
</div>
@forelse($antrians as $antrian_key => $antrian)
<div class="block toSearch">
    <div class="block-content pb-20">
        <div class="row p-0 m-0">
            <div class="col-md-1 text-center h-100 d-flex align-self-center">
                <h3 class="mb-0">{{$antrian->nomor_antrian}}</h3>
            </div>
            <div class="col-md-3 h-100 d-flex align-self-center">
                <h5 class="mb-0">{{$antrian->pasien_detail->name}}<br>
                    <small class="font-w400">No.RM: {{$antrian->pasien_detail->no_rm}}</small><br>
                    <small class="font-w400">
                        @if($antrian->pasien_detail->gender == 1) Laki laki
                        @else Perempuan
                        @endif

                        , {{$antrian->pasien_detail->age}}
                    </small>
                </h5>
            </div>
            <div class="col-md-1 h-100 d-flex align-self-center text-center">
                @if(!empty($antrian->nomor_sep))
                <div class="badge badge-success" style="white-space:normal">
                    BPJS
                </div>
                @endif
            </div>
            <div class="col-md-2 h-100 d-flex align-self-center">
                <h6 class="mb-0"><small class="font-w400">Waktu Pendaftaran</small><br>
                    {{date('d F y, H:i', strtotime($antrian->waktu_masuk))}}
                    @if($antrian->is_video == 1)
                        <br><br><small class="font-w400">Waktu Estimasi Pelayanan</small><br>
                        {{date('d F y, H:i', strtotime($antrian->ordered_at))}}
                    @endif
                </h6>
            </div>
            <div class="col-md-2 h-100 d-flex align-self-center keterangan-krs">
                @if($antrian->status == 2)
                <h6 class="mb-0"><small class="font-w400">Waktu KRS</small><br>
                    {{$antrian->waktu_keluar->format('d F y, H:i')}}
                </h6>
                @elseif($antrian->status == 1)
                <h6 class="mb-0"><small class="font-w400">Waktu KRS</small><br>
                    Sedang Pemeriksaan
                </h6>
                @endif
            </div>
            <div class="col-md-3 h-100 d-flex align-self-center">
                <form method="POST" action="{{url('rawatjalan/transaksi/layani')}}" target="_blank">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$antrian->id}}" name="transaksi_id">
                    <div id="btn_layani_{{$antrian->id}}">
                        @if($antrian->status == 1 || $antrian->status == 2)
                            @php
                                $antrians->forget($antrian_key);
                            @endphp
                        <button class="btn btn-alt-success btn-hero" type="submit">Lihat Hasil Pemeriksaan</button>
                        @elseif($antrian->status == -1)
                            @php
                                $antrians->forget($antrian_key);
                            @endphp
                        <button class="btn btn-alt-danger" disabled>Transaksi Dibatalkan</button>
                        @elseif($antrian->status == 3)
                            @php
                                $antrians->forget($antrian_key);
                            @endphp
                        <button class="btn btn-alt-warning" disabled>Transaksi Belum di Verifikasi</button>
                        @else
                            @if (Auth::user()->profesi == 1)
                                <button class="btn btn-primary btn-hero px-20 btn-click-animate button-layani" data-id="{{$antrian->id}}" type="submit">Layani Pasien</button>
                            @else
                                <button class="btn btn-info btn-hero px-20 btn-click-animate button-layani" data-id="{{$antrian->id}}" type="submit">Input Asesmen</button>
                            @endif
                            @if (count($antrians ?? []) > 0 && count($master_tv ?? []) > 0)
                                <button type="button" class="js-notify btn btn-success btn-hero px-20 button-call-antrian" data-transaksi="{{$antrian->id}}" data-ruangan="{{$antrian->ruangan_poli->id}}" data-type="info" data-icon="fa fa-bullhorn" data-message="Pasien telah dipanggil"><i class="fa fa-bullhorn"></i></button>
                            @endif
                        @endif
                    </div>
                </form>
            </div>
            <div class="col-md-3 h-100 d-flex align-self-center">
                <button style="display:none" type="button" class="btn btn-success" onclick="video({{$antrian->id}})">Video</button>
            </div>
        </div>
        @if($antrian->is_video == 1)
            <div class="row p-0 m-0">
                <div class="col-md-8 h-100 d-flex align-self-center"></div>
                <div class="col-md-2 h-100 d-flex align-self-center">
                    <button type="button" class="btn btn-sm btn-primary btn-hero btn-click-animate px-20" onclick="mod({{$antrian->id}})">Video Call</button>
                </div>
                @if(!$antrian->transaksi_video->is_ended)
                    <div class="col-md-2 h-100 d-flex align-self-center">
                        <button type="button" class="btn btn-primary btn-danger btn-click-animate px-20" onclick="end({{$antrian->id}})">End Session</button>
                    </div>
                @else
                    <div class="col-md-2 h-100 d-flex align-self-center">
                        <button type="button" class="btn btn-primary btn-success btn-click-animate px-20" onclick="restore({{$antrian->id}})">Restore Session</button>
                    </div>
                @endif
            </div>
        @endif
        <div class="row p-0 m-0">
            <div class="col-12"> <hr></div>
            <div class="col-md-4 full-only">
                @if($antrian->status == 0)
                <button class="btn btn btn-danger" id="btn_batalkan_{{$antrian->id}}" onclick="confirmSwalBatalkan({{$antrian->id}})">Batalkan</button>
                @elseif($antrian->status == -1)
                <h6 class="mb-0"><small class="font-w400">TRANSAKSI DIBATALKAN</small><br>
                    Waktu : {{$antrian->cancel_at->format('d F y, H:i')}}<br>
                    Oleh : {{$antrian->cancel_user->name}}<br>
                    Keterangan : {{$antrian->cancel_keterangan}}
                </h6>
                @endif
            </div>
            <div class="col-md-4 text-center ml-auto">
                @if(!empty($antrian->rm_transaksi_id) && empty($antrian->rm_transaksi_pengembalian_id))
                @if($antrian->rm_transaksi->status == 1)
                <form method="POST" action="{{url('rawatjalan/transaksi/rekam-medis/konfirmasi')}}/{{$antrian->id}}">
                    {{csrf_field()}}
                    <button class="btn btn-primary text-center" type="submit">File RM : Konfirmasi File</button>
                </form>
                @elseif($antrian->rm_transaksi->status == 2)
                <form method="POST" action="{{url('rawatjalan/transaksi/rekam-medis/kembalikan')}}/{{$antrian->id}}">
                    {{csrf_field()}}
                    <button class="btn btn-success text-center" type="submit">File RM : Kembalikan File</button>
                </form>
                @elseif($antrian->rm_transaksi->status == 0)
                <button class="btn btn-alt-primary text-center disabled full-only" type="submit">File RM : Dalam Proses Pengiriman</button>
                <a class="badge badge-info mobile-block" href="javascript:void(0)">File RM : Dalam Proses Pengiriman</a>
                @endif
                @endif

                @if(!empty($antrian->rm_transaksi_pengembalian_id))
                @if($antrian->rm_transaksi_pengembalian->status == 1)
                <button class="btn btn-primary text-center full-only" type="submit" disabled>File RM : Dalam Proses Pengembalian</button>
                <a class="badge badge-primary mobile-block" href="javascript:void(0)">File RM : Dalam Proses Pengembalian</a>
                @elseif($antrian->rm_transaksi_pengembalian->status == 2)
                <button class="btn btn-success text-center full-only" type="submit" disabled> File RM : Selesai Dikembalikan</button>
                <a class="badge badge-success mobile-block" href="javascript:void(0)">File RM : Selesai Dikembalikan</a>
                @endif
                @endif
            </div>
            <div class="col-md-4 mobile-block mt-5">
                @if($antrian->status == 0)
                <button class="btn btn btn-danger" id="btn_mobile_batalkan_{{$antrian->id}}" onclick="confirmSwalBatalkan({{$antrian->id}})" style="width: 100%">Batalkan</button>
                @elseif($antrian->status == -1)
                <h6 class="mb-0"><small class="font-w400">TRANSAKSI DIBATALKAN</small><br>
                    Waktu : {{$antrian->cancel_at->format('d F y, H:i')}}<br>
                    Oleh : {{$antrian->cancel_user->name}}<br>
                    Keterangan : {{$antrian->cancel_keterangan}}
                </h6>
                @endif
            </div>
        </div>
    </div>
</div>


@empty
<div class="block">
    <div class="block-content text-center pb-20">
        <h5>Antrian {{$poli->name}} untuk hari ini masih kosong</h5>
        <a href="{{url('pasien')}}" class="btn btn-outline-primary">+ Daftarkan Pasien ke Poli</a>
    </div>
</div>
@endforelse

<form id="formEndSession" method="POST" action="{{url('rawatjalan/video/transaksi/end-session')}}">
    {{csrf_field()}}
    <input type="hidden" name="transaksi_id" id="end_transaksi_id"></input>
</form>

<form id="formRestoreSession" method="POST" action="{{url('rawatjalan/video/transaksi/restore-session')}}">
    {{csrf_field()}}
    <input type="hidden" name="transaksi_id" id="restore_transaksi_id"></input>
</form>