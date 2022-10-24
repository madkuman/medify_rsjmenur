<div class="content pt-0">
  <div class="row">
    <div class="col-lg-12">
      <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-jiwa"><i class="fa fa-pencil"></i> Buat Pemeriksaan Psikologis</button>
    </div>
  </div>
  <div class="row">
    @if(count($bacaan)==0)

    <div class="col-12 text-center py-50">
      <h4 class="font-w400 mb-5">Belum ada Pemeriksaan Jiwa</h4><br>
      <p>Klik tombol <b>Buat Pemeriksaan Psikologis</b> untuk menambahkan Evaluasi Pemeriksaan Jiwa baru</p>
    </div>

    @endif
    @foreach ($bacaan as $key => $value)
    <div class="col-md-8">
      <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-delete-jiwa{{$key}}">
        <i class="fa fa-trash"></i>
      </button>
      <button type="button" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-edit-jiwa{{$key}}">
        <i class="fa fa-pencil"></i>
      </button>
      <h5 class="font-w600 mb-5">EVALUASI {{$key+1}}</h5>
      <h5 class="mb-15 font-w400">{!! $value->hasil_bacaan !!}</h5>
      <h6>
        <small class="text-muted">Dibuat Oleh</small><br>
        {{$value->user->name}}
        <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{date('l, j F Y H:i',strtotime($value->updated_at))}}</span>
      </h6>
    </div>
    @if ($key != count($bacaan)-1)
    <div class="col-lg-12 mb-15"><hr></div>
    @endif
    @endforeach
  </div>
</div>
