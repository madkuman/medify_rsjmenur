
<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">
            <a href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/form-transfer-internal-rumah-sakit" class="btn-alt btn-primary min-width-125 float-right" onclick="adimeCreate()"><i class="fa fa-pencil"></i> Form Transfer Pasien </a>
        </div>
    </div>

    <div class="row">
        <?php $i = 1; ?>
        @foreach ($lokasi as $l)
        <div class="col-md-8">
            <div class="block block-transparent">
                <div class="block-content">
                    <h5 class="font-w600">{{ $l->lokasi->nama }} @if($i==1) <small>(Lokasi Saat Ini)</small>  @endif</h5>
                    <p class="font-w300">{{ $l->alasan }}</p>
                    <h6>
                        <small class="text-muted">Dibuat Oleh</small><br>
                        {{ $l->creator->name }}
                        <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{ $l->tanggal }}</span>
                    </h6>
                    <hr>
                </div>
            </div>
        </div>
        <?php $i++; ?>
        @endforeach


    </div>
</div>