
<div class="content pt-0">
  <div class="row">
    <div class="col-lg-12">
      <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-gigi"><i class="fa fa-pencil"></i> Buat Pemeriksaan Gigi</button>
    </div>
  </div>
  <div class="row">
    @if(count($gigi)==0)

    <div class="col-12 text-center py-50">
      <h4 class="font-w400 mb-5">Belum ada Pemeriksaan Gigi</h4><br>
      <p>Klik tombol <b>Buat Pemeriksaan Gigi</b> untuk menambahkan Evaluasi Pemeriksaan Gigi baru</p>
    </div>

    @endif
    @foreach ($gigi as $key => $value)
    <div class="col-md-8">
      <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-delete-gigi{{$key}}">
        <i class="fa fa-trash"></i>
      </button>
      <button type="button" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-edit-gigi{{$key}}">
        <i class="fa fa-pencil"></i>
      </button>
      <h5 class="font-w600 mb-5">EVALUASI {{$key+1}}</h5>
      <h5 class="font-w400 mb-0"><small>DMF</small></h5>
      <h5 class="mb-15 font-w400">{{$value->dmf}}</h5>
      <h5 class="font-w400 mb-0"><small>Jumlah Gigi Vital</small></h5>
      <h5 class="mb-15 font-w400">{{$value->jml_gigi_vital}}</h5>
      <h5 class="font-w400 mb-0"><small>Jumlah titik kontak oki sentris</small></h5>
      <h5 class="mb-15 font-w400">{{$value->jml_titik}}</h5>
      <h5 class="font-w400 mb-0"><small>Kelainan Gigi</small></h5>
      <h5 class="mb-15 font-w400">{{$value->kelainan_gigi}}</h5>
      <h5 class="font-w400 mb-0"><small>Kelainan dalam Mulut</small></h5>
      <h5 class="mb-15 font-w400">{{$value->kelainan_mulut}}</h5>
      <h5 class="font-w400 mb-0"><small>Kelainan Rahang</small></h5>
      <h5 class="mb-15 font-w400">{{$value->kelainan_rahang}}</h5>
      <h5 class="font-w400 mb-0"><small>Kebersihan mulut</small></h5>
      <h5 class="mb-15 font-w400">{{$value->kebersihan_mulut}}</h5>
      <h6>
        <small class="text-muted">Dibuat Oleh</small><br>
        {{$value->user->name}}
        <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{date('l, j F Y H:i',strtotime($value->updated_at))}}</span>
      </h6>
    </div>
    @if ($key != count($gigi)-1)
    <div class="col-lg-12 mb-15"><hr></div>
    @endif
    @endforeach
  </div>
</div>