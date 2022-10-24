@extends('kepegawaian.layouts.main-profile')

@section('title')
{{$htmlheader_title}}
@endsection

@section('subtitle')
{{$contentheader_title}}
@endsection

@section('main-content')
<div class="card"> 
  <div class="card-body px-20">
    <div class="row">
      <div class="col-12 text-right float-right">
          <a href="javascript:void(0)" class="btn-add btn btn-alt-primary pull-right"><i
                  class="fa fa-plus mr-5 mb-10"></i> Tambah Legalitas
          </a>
      </div>
    </div>
    <div class="col-12 my-20">
      <div class="row">
        @include('kepegawaian.pegawai.legalitas.components.sip')
        @include('kepegawaian.pegawai.legalitas.components.str')
      </div>
      <div class="row">
        @include('kepegawaian.pegawai.legalitas.components.skk')
        @include('kepegawaian.pegawai.legalitas.components.evkin')
      </div>
      <div class="row">
        @include('kepegawaian.pegawai.legalitas.components.kredensial')
      </div>
      <!-- modal -->
      @include('kepegawaian.pegawai.legalitas.components.modal-create')
    </div>
  </div>
</div>

<form method="POST" action="" id="formDelete">
  {{csrf_field()}}
</form>
@endsection 

@section('script')
<!-- All javascript function's files are included at main layout -->
@include('kepegawaian.pegawai.legalitas.components.js')
@endsection