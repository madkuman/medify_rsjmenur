<div class="content pt-0">
  <div class="row">
    <div class="col-lg-12">
      <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-mata"><i class="fa fa-pencil"></i> Buat Pemeriksaan Mata</button>
    </div>
  </div>
  <div class="row">
    @if(count($mata)==0)

    <div class="col-12 text-center py-50">
      <h4 class="font-w400 mb-5">Belum ada Evaluasi Pemeriksaan Mata</h4><br>
      <p>Klik tombol <b>Buat Pemeriksaan Mata</b> untuk menambahkan Evaluasi Pemeriksaan Mata baru</p>
    </div>

    @endif
    @foreach ($mata as $key => $value)
    <div class="col-md-8">
      <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-delete-mata{{$key}}">
        <i class="fa fa-trash"></i>
      </button>
      <button type="button" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-edit-mata{{$key}}">
        <i class="fa fa-pencil"></i>
      </button>
      <h5 class="font-w600 mb-5">EVALUASI {{$key+1}}</h5>
      <h5 class="font-w400 mb-0"><small>OD</small></h5>
      <h5 class="mb-15 font-w400">{{$value->od}}</h5>
      <h5 class="font-w400 mb-0"><small>OS</small></h5>
      <h5 class="mb-15 font-w400">@if($value->os == 1) Normal @else Tidak Normal, {{$value->ket_os}} @endif</h5>
      <h5 class="font-w400 mb-0"><small>Visus OD</small></h5>
      <h5 class="mb-15 font-w400">{{$value->visus_od}}</h5>
      <h5 class="font-w400 mb-0"><small>Visus OS</small></h5>
      <h5 class="mb-15 font-w400">{{$value->visus_os}}</h5>
      <h5 class="font-w400 mb-0"><small>Visus ODS</small></h5>
      <h5 class="mb-15 font-w400">{{$value->visus_ods}}</h5>
      <h5 class="font-w400 mb-0"><small>Bentuk Pupil</small></h5>
      <h5 class="mb-15 font-w400">{{$value->bentuk_pupil}}</h5>
      <h5 class="font-w400 mb-0"><small>Membedakan Warna</small></h5>
      <h5 class="mb-15 font-w400">{{$value->membedakan_warna}}</h5>
      <h5 class="font-w400 mb-0"><small>Koreksi Sampai OD</small></h5>
      <h5 class="mb-15 font-w400">{{$value->koreksi_od}}</h5>
      <h5 class="font-w400 mb-0"><small>Koreksi Sampai OS</small></h5>
      <h5 class="mb-15 font-w400">{{$value->koreksi_os}}</h5>
      <h5 class="font-w400 mb-0"><small>Add</small></h5>
      <h5 class="mb-15 font-w400">{{$value->add}}</h5>
      <h5 class="font-w400 mb-0"><small>Pemeriksaan Perimetris</small></h5>
      <h5 class="mb-15 font-w400">{{$value->pemeriksaan_perimetris}}</h5>
      <h5 class="font-w400 mb-0"><small>Tekanan Intraokulair</small></h5>
      <h5 class="mb-15 font-w400">{{$value->tekanan_intraokulair}}</h5>
      <h6>
        <small class="text-muted">Dibuat Oleh</small><br>
        {{$value->user->name}}
        <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{date('l, j F Y H:i',strtotime($value->updated_at))}}</span>
      </h6>
    </div>
    @if ($key != count($mata)-1)
    <div class="col-lg-12 mb-15"><hr></div>
    @endif
    @endforeach
  </div>
</div>
