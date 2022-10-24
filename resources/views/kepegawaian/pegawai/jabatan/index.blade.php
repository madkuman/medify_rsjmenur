@extends('kepegawaian.layouts.main-profile')

@section('title')
Kepegawaian | Jabatan
@endsection

@section('subtitle')
  Data Jabatan
@endsection

@section('main-content')
  <div class="card"> 
    <div class="card-body px-20">
      <div class="col-12 my-20">
        <div class="row">
          <div class="col-sm-12 col-12 pr-20">
            @include('kepegawaian.pegawai.jabatan.components.riwayat-jabatan')
          </div>
          
        </div>

        <!-- modal -->
        @include('kepegawaian.pegawai.jabatan.components.modal-tambah-riwayat-jabatan')
        @include('kepegawaian.pegawai.jabatan.components.modal-delete')
       
      </div>
    </div>
  </div>
@endsection

@section('script')
@include('kepegawaian.pegawai.jabatan.components.js')
 
@endsection