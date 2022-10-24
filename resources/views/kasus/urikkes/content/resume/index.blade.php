<div class="content pt-0">
  <div class="row">
    <div class="col-lg-12">
      <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-resume"><i class="fa fa-pencil"></i> Buat Resume</button>
    </div>
  </div>
  <div class="row">
    @if(count($resume)==0)

    <div class="col-12 text-center py-50">
      <h4 class="font-w400 mb-5">Belum ada Resume Urikkes</h4><br>
      <p>Klik tombol <b>Buat Resume</b> untuk menambahkan Resume Urikkes baru</p>
    </div>

    @endif
    @foreach ($resume as $key => $value)
    <div class="col-md-8">
      <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-delete-resume{{$key}}">
        <i class="fa fa-trash"></i>
      </button>
      <button type="button" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-edit-resume{{$key}}">
        <i class="fa fa-pencil"></i>
      </button>
      <h5 class="font-w600 mb-5">EVALUASI {{$key+1}}</h5>
      <h5 class="font-w400 mb-0"><small>Status Kesehatan</small></h5>
      <div class="table-responsive">
        <table class="table">
          <tr>
            <td>U</td>
            <td>A</td>
            <td>B</td>
            <td>D</td>
            <td>L</td>
            <td>G</td>
            <td>J</td>
            <td>Stakes</td>
          </tr>
          <tr>
            <td>{{$value->u}}</td>
            <td>{{$value->a}}</td>
            <td>{{$value->b}}</td>
            <td>{{$value->d}}</td>
            <td>{{$value->l}}</td>
            <td>{{$value->g}}</td>
            <td>{{$value->j}}</td>
            <td>{{$value->stakes}}</td>
          </tr>
        </table>
      </div>
      <h5 class="font-w400 mb-0"><small>Bacaan Pemeriksaan Jiwa / MMPI</small></h5>
      <h5 class="mb-15 font-w400" style="white-space: pre-line">{!! $value->jiwa !!}</h5>
      <h5 class="font-w400 mb-0"><small>Resume</small></h5>
      <h5 class="mb-15 font-w400" style="white-space: pre-line;">{!! $value->resume !!}</h5>
      <h5 class="font-w400 mb-0"><small>Saran</small></h5>
      <h5 class="mb-15 font-w400" style="white-space: pre-line">{!! $value->saran !!}</h5>
      <h5 class="font-w400 mb-0"><small>Kualifikasi</small></h5>
      <h5 class="mb-15 font-w400" style="white-space: pre-line">{!! $value->kualifikasi !!}</h5>
      <h5 class="font-w400 mb-0"><small>Catatan Hasil Lab</small></h5>
      <h5 class="mb-15 font-w400" style="white-space: pre-line">{!! $value->catatan_lab !!}</h5>
      <h6>
        <small class="text-muted">Dibuat Oleh</small><br>
        {{$value->user->name}}
        <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{date('l, j F Y H:i',strtotime($value->updated_at))}}</span>
      </h6>
    </div>
    @if ($key != count($resume)-1)
    <div class="col-lg-12 mb-15"><hr></div>
    @endif
    @endforeach
  </div>
</div>