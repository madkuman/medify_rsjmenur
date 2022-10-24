<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">

            @if(session('my_role_'.$kasus->nomor_kasus))
            <a href="javascript:void(0)" onclick="permintaan_gizi()"  
            class="btn-alt btn-primary min-width-125 float-right"><i class="fa fa-pencil"></i> Buat Permintaan Gizi</a>
            @endif 
            
        </div>
        <?php $i = 1; ?>
        @forelse ($orders as $o)

        <div class="col-md-12">
            <div class="block block-bordered">
                <div class="block-content block-header-default">
                    <h5>Order #{{$loop->iteration}}</h5>
                </div>
                <div class="block-content">
                    <a href="javascript:void(0)" onclick="detail('{{$o->id}}')" class="btn btn-primary pull-right">Lihat Detail Pemesanan</a>
                    <h5 class="font-w400 mb-5">Diet: {{ $o->diet->nama }}</h5>
                    <h5 class="font-w400"><small>Untuk Tanggal: {{ $o->jadwal_pengantaran->format('d F Y') }}</small></h5>
                    <div class="soap-item">
                    @if(!empty($o->pembuat->avatar_thumb))
                    <div class="float-left mr-10">
                        <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($o->pembuat->avatar_thumb)}}" alt="">
                    </div>
                    @else
                    <div class="float-left mr-10">
                        <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                    </div>
                    @endif
                        <h6 class="pt-10">
                            <small class="text-muted">Dibuat Oleh</small><br>
                            {{ $o->pembuat->name }}<br>
                            {{ $o->created_at->format('d F Y') }}
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
</div>