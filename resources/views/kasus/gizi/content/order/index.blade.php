<div class="content pt-0">
    @if(empty($kasus->pasien_id))
    <div class="block">
        <div class="block-content tab-content overflow-hidden">
            <div class="col-12 text-center py-50">
                <h4 class="font-w400 mb-5">Data pasien belum tersinkronisasi. Silahkan lakukan Sinkronisasi dahulu</h4>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-lg-12 mb-20">

            @if(session('my_role_'.$kasus->nomor_kasus))
            <button href="javascript:void(0)" onclick="permintaan_gizi()"  
            class="btn-alt btn-primary min-width-125 float-right"><i class="fa fa-pencil"></i> Buat Order Diet</button>
            @endif
            <h4 class="pt-10">Order Diet</h4>
            <hr>
        </div>
        <?php $i = 1; $jumlah_order = count($orders)?>
        @forelse ($orders as $order)

        <div class="col-md-12">
            <div class="block block-bordered">
                <div class="block-header">
                    <h5>Order #{{$jumlah_order--}}</h5>
                    <div class="block-options">
                        <a href="javascript:void(0)" onclick="sendidtomodal('{{$order->id}}')" data-toggle="modal" data-target="#modal-mutu-gizi" class="btn btn-info">Mutu Gizi</a>
                    </div>
                </div>
                <div class="block-content">
                    @if (!empty($order->mutu_diet))
                    <h5 class="font-w400"><small>Mutu Gizi (Diet : {{$order->mutu_diet}}, Sisa makanan : {{$order->mutu_sisa}})</small></h5>
                    @endif
                    @php
                    $pagi=0;
                    $siang=0;
                    $sore=0;
                    @endphp
                    @foreach($order->pemesanan_detail as $detail)
                            <div class="block block-bordered mb-10">
                                <a class="btn btn-sm btn-circle btn-alt-danger float-right mr-5 mt-5" href="javascript:void(0)" onclick="modal_order_delete('{{$detail->id}}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <a class="btn btn-sm btn-circle btn-alt-info float-right mr-5 mt-5" href="javascript:void(0)" onclick="modal_order_edit('{{$detail->id}}')">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <div class="block-content p-10 pb-15">
                                    <p class="font-w600 font-size-md my-0">{{$detail->waktu_makan->nama ?? ''}}</p>
                                    <span class="font-w400 font-size-md mb-5">Jenis Makanan : {{$detail->jenis_makanan->nama ?? ''}}</span><br>
                                    <span class="font-w400 font-size-md mb-5">Diet : {{$detail->diet->nama ?? ''}}</span><br>
                                    <span class="font-w400 font-size-md mb-5">Makanan Tambahan : {{implode(', ',json_decode($detail->makanan_tambahan_nama))}}</span><br>
                                    <span class="font-w400 font-size-sm mb-5">Catatan : {{$detail->catatan ?? ''}}</span><br>
                                    <span class="font-w400 font-size-sm mb-5">{{indonesian_date(strtotime($detail->untuk_tanggal),'l')}}, {{indonesian_date(strtotime($detail->untuk_tanggal),'j F Y')}}</span><br>
                                    <span class="font-w400 font-size-sm mb-5">{{$detail->lokasi->nama}}</span>
                                </div>
                            </div>
                    @endforeach

                    <div class="soap-item">
                        @if(!empty($order->pembuat->avatar_thumb))
                        <div class="float-left mr-10">
                            <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($order->pembuat->avatar_thumb)}}" alt="">
                        </div>
                        @else
                        <div class="float-left mr-10">
                            <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                        </div>
                        @endif
                        <h6 class="pt-10">
                            <small class="text-muted">Dibuat Oleh</small><br>
                            {{ $order->pembuat->name }}<br>
                            {{ $order->created_at->format('d F Y') }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <?php $i++; ?>
        @empty

        <div class="col-12 text-center py-50">
            <h4 class="font-w400 mb-5">Belum ada permintaan gizi</h4><br>
            <p>Klik tombol <b>Buat Permintaan Gizi</b> untuk melakukan permintaan pada Gizi</p>
        </div>
        @endforelse

    </div>
    @endif
</div>