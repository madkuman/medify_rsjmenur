


@if(!empty($my_rujuk_poli[0]))
<div class="card-header" id="permintaanRujukPoli">
    <h6 class="text-uppercase">Permintaan Rujuk Rawat Jalan</h6>
</div>
<div class="card-body mb-50">

    @forelse($my_rujuk_poli  as $item)
    @if(isset($item->kasus->active_sep->no_sep))
    <a class="block block-link-pop bg-danger-light text-danger" href="javascript:void(0)" onclick="rujukClick('{{$item->poli_tujuan->id}}','{{$item->kasus->active_sep->no_sep}}', '{{$item->kasus->active_sep->sisa_plafon}}', '{{$item->kasus->id}}', '{{$item->kasus->pasien_pembayaran_id}}','{{$item->id}}','{{$item->buat_kasus_baru}}' )">
    @else
    <a class="block block-link-pop bg-danger-light text-danger" href="javascript:void(0)" onclick="rujukClick('{{$item->poli_tujuan->id}}',null,null, '{{$item->kasus->id}}', '{{$item->kasus->pasien_pembayaran_id}}','{{$item->id}}','{{$item->buat_kasus_baru}}' )">
    @endif
        <div class="block-content pb-10">
            <div class="row">
                <div class="col-md-1">{{$loop->iteration}}
                </div>
                <div class="col-md-3">
                    <strong>Poli Tujuan</strong><br>
                    Poli Asal<br>
                    Judul Kasus<br>
                    Tipe Rujuk<br>
                    Buat Kasus Baru<br>
                    Keterangan<br>
                </div>
                <div class="col-md-1">
                    :<br>
                    :<br>
                    :<br>
                    :<br>
                    :<br>
                    :<br>
                    :<br>
                </div>
                <div class="col-md-6">
                    <strong>{{$item->poli_tujuan->name}}</strong><br>
                    {{$item->poli_asal->nama}}<br>
                    {{$item->kasus->judul_kasus}}<br>

                    @if($item->type == 1) Konsul
                    @elseif($item->type == 2) Alih Rawat
                    @else($item->type == 3) Rawat Bersama
                    @endif
                    <br>

                    @if($item->buat_kasus_baru == 1) Ya
                    @else($item->buat_kasus_baru == 2) Tidak
                    @endif
                    <br>

                    {{$item->kasus->judul_kasus}}<br>
                    {{$item->keterangan}}<br>
                </div>
            </div>
            <div class="row mt-15">
                <div class="col-md-1">
                    &nbsp;
                </div>
                <div class="col-md-11 text-right">
                    {{$item->creator->name}}<br>{{$item->created_at_formatted}}
                </div>
            </div>
        </div>
    </a>
    @empty
    <a class="block block-link-pop bg-danger-light text-danger d-none" href="javascript:void(0)">
        <div class="block-content pb-10">
            <div class="row">
                <div class="col-md-1">1
                </div>
                <div class="col-md-3">
                    <strong>Poli Tujuan</strong><br>
                    Poli Asal<br>
                    Judul Kasus<br>
                    Tipe Rujuk<br>
                    Buat Kasus Baru<br>
                    Keterangan<br>
                </div>
                <div class="col-md-1">
                    :<br>
                    :<br>
                    :<br>
                    :<br>
                    :<br>
                    :<br>
                    :<br>
                </div>
                <div class="col-md-6">
                    <strong>Mata</strong><br>
                    Poli Poli Akupuntur<br>
                    Rawat Jalan #9073<br>

                    Rawat Bersama
                    <br>

                    Ya
                    <br>

                    Rawat Jalan #9073<br>
                    Penanganan Darurat<br>
                </div>
            </div>
            <div class="row mt-15">
                <div class="col-md-1">
                    &nbsp;
                </div>
                <div class="col-md-11 text-right">
                    Khoirul Al Quzami<br>24 September 2019, 15:32
                </div>
            </div>
        </div>
    </a>
    @endforelse
</div>
@endif
