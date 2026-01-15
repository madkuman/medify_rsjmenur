<div class="modal fade" id="modal-list-permintaan">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="block-title text-light">Daftar Permintaan Gizi</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option text-light" data-dismiss="modal" aria-label="Close">
                        <i class="si si-close"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    @php
                    $permintaan_count = $permintaan_group->count();
                    @endphp
                    @forelse ($permintaan_group as $item)
                    @php
                    $item_first = $item->first();
                    @endphp
                    <div class="col-md-12">
                        <div class="block block-bordered">
                            <div class="block-header">
                                <h5>
                                    Permintaan #{{ $permintaan_count-- }}
                                    @if ($item_first->status == 1)
                                    <span class="badge badge-primary">Aktif</span>
                                    @endif
                                </h5>
                            </div>
                            <div class="block-content">
                                @foreach($item as $detail)
                                    <div class="block block-bordered mb-10">
                                        @if (empty($detail->pemesanan_detail) && $detail->status == 1)
                                        <a class="btn btn-sm btn-circle btn-alt-danger float-right mr-5 mt-5 btn-permintaan-delete" href="javascript:void(0)" data-id="{{ $detail->id }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <a class="btn btn-sm btn-circle btn-alt-info float-right mr-5 mt-5 btn-permintaan-edit" href="javascript:void(0)" data-id="{{ $detail->id }}" data-batch="{{ $detail->batch }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        @elseif (!empty($detail->pemesanan_detail))
                                        <span class="badge badge-info pull-right mt-10 mr-5">Sudah Dipesankan Oleh Gizi</span>
                                        @endif
                                        <div class="block-content p-10 pb-15">
                                            <p class="font-w600 font-size-md my-0">{{$detail->waktu_makan->nama ?? ''}}</p>
                                            <span class="font-w400 font-size-sm mb-5">Diet : {{$detail->diet->nama ?? ''}}</span><br>
                                            <span class="font-w400 font-size-sm mb-5">Bentuk Makanan : {{$detail->bentuk_makanan->nama ?? ''}}</span><br>
                                            <span class="font-w400 font-size-sm mb-5">Catatan : {{$detail->catatan ?? ''}}</span><br>
                                            <span class="font-weight-bold font-size-sm mb-5">{{$detail->lokasi->nama}}</span>
                                        </div>
                                    </div>
                                @endforeach
            
                                <div class="soap-item">
                                    @if(!empty($item_first->creator->avatar_thumb))
                                    <div class="float-left mr-10">
                                        <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item_first->creator->avatar_thumb)}}" alt="">
                                    </div>
                                    @else
                                    <div class="float-left mr-10">
                                        <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                                    </div>
                                    @endif
                                    <h6 class="pt-10">
                                        <small class="text-muted">Dibuat Oleh</small><br>
                                        {{ $item_first->creator->name }}<br>
                                        {{ $item_first->created_at->format('d F Y, H:i') }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
            
                    <div class="col-12 text-center py-50">
                        <h4 class="font-w400 mb-5">Belum ada permintaan gizi</h4><br>
                        <p>Klik tombol <b>Buat Permintaan Gizi</b> untuk melakukan permintaan pada Gizi</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>