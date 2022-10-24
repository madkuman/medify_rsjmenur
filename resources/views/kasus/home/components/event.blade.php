@if(!empty($operasi))
<div class="col-lg-12">
    <a class="block block-transparent" href="javascript:void(0)">
        <div class="block-content block-content-full bg-info">
            <div class="py-20 text-center">
                <div class="mb-20">
                        <img src="{{url('assets/icons/32/026-scalpel.png')}}">
                </div>
                <div class="font-size-h3 font-w600 text-white">Operasi</div>
                <div class="font-size-sm font-w600 text-uppercase text-warning-light">{{$operasi->diff}} Hari Lagi, {{$operasi->ruangan->name}} - Ronde {{$operasi->nomor_ronde}}</div>
            </div>
        </div>
    </a>
</div>
@endif

@if(!empty($rujuk))
<div class="col-lg-12">
    <div class="block block-transparent">
        <div class="block-content block-content-full bg-info">
            <div class="py-20">
                <div class="font-size-sm font-w600 text-uppercase text-warning-light">Informasi Rujukan</div>
                <div class="font-size-h5 font-w600 text-white">{{$rujuk->keterangan}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-warning-light">Asal Rujukan : {{$rujuk->poli_asal->nama ?? '-'}}</div>
                <br>
                <button class="btn btn-primary"  onclick="popupwindow('{{url("kasus")}}/{{$rujuk->kasus->nomor_kasus}}','Kasus Rujukan','1366','768')" >Lihat Pemeriksaan Sebelumnya</a>
            </div>
        </div>
    </div>
</div>
@endif