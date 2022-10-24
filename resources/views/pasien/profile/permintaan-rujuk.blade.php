<div class="card">
    <div class="card-header">
        <h4 class="card-title">Permintaan Rujuk Rawat Jalan</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-1"><h6 class="text-uppercase">No</h6>
            </div>
            <div class="col-md-3"><h6 class="text-uppercase">Judul Kasus</h6>
            </div>
            <div class="col-md-2"><h6 class="text-uppercase">Asal Poli</h6>
            </div>
            <div class="col-md-2"><h6 class="text-uppercase">Tujuan Poli</h6>
            </div>
            <div class="col-md-2"><h6 class="text-uppercase">Dibuat Oleh</h6>
            </div>
            <div class="col-md-2"><h6 class="text-uppercase">Keterangan</h6>
            </div>
        </div>

        @forelse($permintaan_rujuk as $item)
        <div class="row">
            <div class="col-md-1">{{$loop->iteration}}
            </div>
            <div class="col-md-3">{{$item->kasus->judul_kasus}}
            </div>
            <div class="col-md-2">{{$item->poli_asal->nama}}
            </div>
            <div class="col-md-2">{{$item->poli_tujuan->name ?? '-'}}
            </div>
            <div class="col-md-2">{{$item->creator->name}} <br> {{$item->created_at_formatted}}
            </div>
            <div class="col-md-2">{{$item->keterangan}}
            </div>
        </div>
        @empty
        <div class="row">
            <div class="col-md-12 text-center py-20">
                <h5 class="font-w400">Pasien ini belum memiliki permintaan rujukan</h5>
            </div>
        </div>
        @endforelse
        

           
    </div>
</div>
