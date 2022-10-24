<div class="block-content ">
    <div class="row">
        <div class="col-lg-12 mb-10">
            @if(session('my_role_'.$kasus->nomor_kasus))
            @if(!empty($diagnosis))
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modalOperasiBaru"><i class="fa fa-plus"></i> Permintaan Operasi Baru</button>  
            @else  
            <button type="button" class="btn-alt btn-danger min-width-125 float-right" onclick="permintaanGagal()"><i class="fa fa-plus"></i> Permintaan Operasi Baru</button>
            @endif
            <h4>Permintaan dan Jadwal Operasi</h4>
            @endif
        </div>
        @forelse($permintaan as $item)
        <div class="col-lg-12">
            <div class="block block-transparent">
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-12 mb-10">
                            <h5 class="mb-10"><strong>Permintaan no. #{{$item->transaksi_id}} ({{$item->transaksi->jenis_spesialis->nama ?? 'Spesialis Tidak Disebutkan'}}) :
                            </strong></h5>
                        </div>
                        @if(!empty($item->transaksi->deleted_at))
                        @if(!empty($item->deleted_by))
                        <div class="col-md-3 mb-10">
                            <label class="mb-0">Status</label>
                            <p class="mt-0"><span class="badge badge-danger mb-20">Permintaan Dibatalkan</span></p>
                        </div>
                        @else
                        <div class="col-md-3 mb-10">
                            <label class="mb-0">Status</label>
                            <p class="mt-0"><span class="badge badge-danger mb-20">Permintaan Ditolak</span></p>
                        </div>
                        @endif
                        @else
                        <div class="col-md-3 mb-10">
                            <label class="mb-0">Masa Tunggu</label>
                            @if(!empty($item->transaksi->masa_tunggu))
                            <p class="mt-0">{{date('d F Y', strtotime($item->transaksi->masa_tunggu))}}</p>
                            @else
                            <p class="mt-0"><span class="badge badge-warning mb-20">Belum Dijadwalkan</span></p>
                            @endif
                        </div>
                        <div class="col-md-3 mb-10">
                            <label class="mb-0">Jadwal Operasi</label>
                            @if(!empty($item->transaksi->jadwal_operasi))
                            <p class="mt-0">{{date('d F Y', strtotime($item->transaksi->jadwal_operasi))}}</p>
                        </div>
                        <div class="col-md-3 mb-10">
                            <label class="mb-0">Ruang Operasi</label>
                            <p class="mt-0">{{$item->transaksi->ruangan->name}}</p>
                            @else
                            <p class="mt-0"><span class="badge badge-warning mb-20">Belum Dijadwalkan</span></p>
                            @endif
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-10">
                            <label class="mb-0">Keterangan</label>
                            <br>
                            {{$item->transaksi->keterangan}}
                        </div>
                    </div>

                    @if($item->transaksi->status == 1)
                    <a onclick="hasil_operasi({{$item->transaksi->id}})" class="btn btn-hero btn-alt-success text-uppercase float-right mt-15">Lihat Hasil Operasi</a> 
                    @elseif(!empty($item->transaksi->deleted_at))
                    @if(!empty($item->deleted_by))
                    <btn class="btn btn-hero btn-alt-danger text-uppercase float-right mt-15" disabled >Dibatalkan</btn>
                    @else
                    <btn class="btn btn-hero btn-alt-danger text-uppercase float-right mt-15" disabled >Ditolak</btn> 
                    @endif
                    @else
                    <a class="btn btn-hero btn-alt-warning text-uppercase float-right mt-15"
                    @if(!empty($item->transaksi->jadwal_operasi))
                    onclick="rencana_operasi({{$item->transaksi->id}})"
                    @endif>Dalam Perencanaan</a> 
                    @endif
                    @if(empty($item->transaksi->jadwal_operasi) && empty($item->transaksi->deleted_at))
                    <button class="btn btn-hero btn-outline-danger text-uppercase pull-right mr-10 mt-15" 
                    onclick="tolakTransaksi({{$item->id}})">Batalkan</button>
                    @endif
                    @if(!empty($item->creator->avatar_thumb))
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
                        {{$item->creator->name}}<br>
                        {{date('d F Y, H:i', strtotime($item->created_at))}}
                    </h6>

                   
                    @if(!empty($item->deleted_by))
                     @if(!empty($item->pembatal->avatar_thumb))
                    <div class="float-left mr-10">
                        <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->pembatal->avatar_thumb)}}" alt="">
                    </div>
                    @else
                    <div class="float-left mr-10">
                        <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                    </div>
                    @endif
                    <h6 class="pt-10">
                        <small class="text-muted">Dibatalkan Oleh</small><br>
                        {{$item->pembatal->name}}<br>
                        {{date('d F Y, H:i', strtotime($item->transaksi->deleted_at))}}
                    </h6>
                    @endif

                    
                    @if(!empty($item->transaksi->deleted_by))
                    @if(!empty($item->transaksi->penolak->avatar_thumb))
                    <div class="float-left mr-10">
                        <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->transaksi->penolak->avatar_thumb)}}" alt="">
                    </div>
                    @else
                    <div class="float-left mr-10">
                        <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                    </div>
                    @endif
                    <h6 class="pt-10">
                        <small class="text-muted">Ditolak Oleh</small><br>
                        {{$item->transaksi->penolak->name}}<br>
                        {{date('d F Y, H:i', strtotime($item->transaksi->deleted_at))}}
                        @if(!empty($item->transaksi->alasan_batal))
                        <br><small class="text-muted">Alasan:</small><br>
                        {{$item->transaksi->alasan_batal}}
                        @endif
                    </h6>
                    @endif
                    <hr>
                </div>
            </div>
        </div>
        @empty

        <div class="col-12 text-center py-50">
            <h4 class="font-w400 mb-5">Belum ada Permintaan Operasi</h4>
            <p>Klik tombol <b>Permintaan Operasi Baru</b> untuk melakukan permintaan jadwal operasi</p>
        </div>
        @endforelse

    </div>
</div>