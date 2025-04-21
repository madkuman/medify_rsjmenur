<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal"
                data-target="#modal-create-pemeriksaan"><i class="fa fa-pencil"></i> Buat Pemeriksaan Umum</button>
        </div>
    </div>
    <div class="row">
        @if (count($pemeriksaan) == 0)
            <div class="col-12 text-center py-50">
                <h4 class="font-w400 mb-5">Belum ada pemeriksaan umum</h4><br>
                <p>Klik tombol <b>Buat Pemeriksaan Umum</b> untuk menambahkan Pemeriksaan Umum baru</p>
            </div>
        @endif
        @foreach ($pemeriksaan as $key => $check)
            <div class="col-md-8">
                <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right"
                    data-toggle="modal" data-target="#modal-delete-pemeriksaan{{ $key }}">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5 float-right"
                    data-toggle="modal" data-target="#modal-edit-pemeriksaan{{ $key }}">
                    <i class="fa fa-pencil"></i>
                </button>

                <h5 class="font-w600 mb-5">PEMERIKSAAN {{ $key + 1 }}</h5>
                <h5 class="font-w400 mb-0"><small>Anamnesa</small></h5>
                <h5 class="mb-15 font-w400">{{ $check->anamnesa }}</h5>

                <h5 class="font-w400 mb-0"><small>Tujuan Pemeriksaan</small></h5>
                <h5 class="mb-15 font-w400">{{ $check->tujuan_pemeriksaan }}</h5>

                <!-- <h5 class="font-w400 mb-0"><small>Keluhan Utama</small></h5>
                                            <h5 class="mb-15 font-w400">{{ $check->keluhan_utama }}</h5> -->
                <h6>
                    <small class="text-muted">Dibuat Oleh</small><br>
                    {{ $check->user->name }}
                    <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i>
                        {{ date('l, j F Y H:i', strtotime($check->updated_at)) }}</span>
                </h6>
            </div>
            @if ($loop->last)
                <div class="col-lg-12 mb-15">
                    <hr>
                </div>
            @endif
        @endforeach


    </div>
</div>
