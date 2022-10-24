<div class="content pt-0">
  <div class="row">
    <div class="col-lg-12">
      <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-telinga"><i class="fa fa-pencil"></i> Buat Pemeriksaan Telinga</button>
    </div>
  </div>
  <div class="row">
    @if (count($telinga)==0)

    <div class="col-12 text-center py-50">
      <h4 class="font-w400 mb-5">Belum ada Pemeriksaan Telinga</h4><br>
      <p>Klik tombol <b>Buat Pemeriksaan Telinga</b> untuk menambahkan Evaluasi Pemeriksaan Telinga baru</p>
    </div>

    @endif
    @foreach ($telinga as $key => $value)
    <div class="col-md-8">
      <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-delete-telinga{{$key}}">
        <i class="fa fa-trash"></i>
      </button>
      <button type="button" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-edit-telinga{{$key}}">
        <i class="fa fa-pencil"></i>
      </button>
      <h5 class="font-w600 mb-5">EVALUASI {{$key+1}}</h5>
      <h5 class="font-w400 mb-0"><small>Audiometri (AD)</small></h5>
      <h5 class="mb-15 font-w400">{{$value->audio_ad}}</h5>
      <h5 class="font-w400 mb-0"><small>Audiometri (AS)</small></h5>
      <h5 class="mb-15 font-w400">{{$value->audio_as}}</h5>
      <h5 class="font-w400 mb-0"><small>Suara Bisikan (AD)</small></h5>
      <h5 class="mb-15 font-w400">{{$value->suara_ad}}</h5>
      <h5 class="font-w400 mb-0"><small>Suara Bisikan (AS)</small></h5>
      <h5 class="mb-15 font-w400">{{$value->suara_as}}</h5>
      <h5 class="font-w400 mb-0"><small>Liang</small></h5>
      <h5 class="mb-15 font-w400">{{$value->liang}}</h5>
      <h5 class="font-w400 mb-0"><small>Tajam Pendengaran</small></h5>
      <h5 class="mb-15 font-w400">{{$value->tajam_pendengaran}}</h5>
      <h5 class="font-w400 mb-0"><small>Gendang Kanan</small></h5>
      <h5 class="mb-15 font-w400">{{$value->gendang_kanan}}</h5>
      <h5 class="font-w400 mb-0"><small>Gendang Kiri</small></h5>
      <h5 class="mb-15 font-w400">{{$value->gendang_kiri}}</h5>
      <h6>
        <small class="text-muted">Dibuat Oleh</small><br>
        {{$value->user->name}}
        <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{date('l, j F Y H:i',strtotime($value->updated_at))}}</span>
      </h6>
    </div>
    @if ($key != count($telinga)-1)
    <div class="col-lg-12 mb-15"><hr></div>
    @endif
    @endforeach
  </div>
</div>