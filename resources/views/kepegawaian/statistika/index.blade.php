@extends('kepegawaian.layouts.main')

@section('title')
  {{$htmlheader_title}}
@endsection

@section('subtitle')
  {{$contentheader_title}}
@endsection

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6 col-md-3 px-5">
        <div class="block rounded">
          <div class="block-content mb-10">
            <div class="text-right text-primary display-4 font-w600">{{$total_pegawai}}</div>
            <div class="block-title font-size-md font-w600 text-right text-uppercase">Jumlah Pegawai</div>
          </div>
        </div>
      </div>
      @foreach ($total_status as $item)
      <div class="col-6 col-md-3 px-5">
        <div class="block rounded">
          <div class="block-content mb-10">
            <div class="text-right text-primary display-4 font-w600">{{$item->jumlah}}</div>
            <div class="block-title font-size-md font-w600 text-right text-uppercase">Status {{$item->status}}</div>
          </div>
        </div>
      </div>
      @endforeach
      </div>
      <div class="row justify-content-center">
      @foreach ($total_jenis as $item)
      <div class="col-6 col-md-3 px-5">
        <div class="block rounded">
          <div class="block-content mb-10">
            <div class="text-right text-primary display-4 font-w600">{{$item->jumlah}}</div>
            <div class="block-title font-size-md font-w600 text-right text-uppercase">Pegawai {{$item->nama}}</div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="row justify-content-center">
      <div class="col-12 col-md-12 px-5">
        <div class="block rounded">
          <div class="block-content block-content-full">
            <div class="block-title font-size-md font-w600 text-left text-uppercase">Statistik Jumlah Pegawai Aktif Bulanan</div>
            <div id="chartpegawaiaktif" style="width: 100%; height: 400px;"></div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-12 px-5">
        <div class="block rounded">
          <div class="block-content block-content-full">
            <div class="block-title font-size-md font-w600 text-left text-uppercase">Statistik Jumlah Pegawai Keluar Bulanan</div>
            <div id="chartpegawaikeluar" style="width: 100%; height: 400px;"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 px-5">
        <div class="block rounded">
          <div class="block-content block-content-full">
            <div class="block-title font-size-md font-w600 text-left text-uppercase">Umur Pegawai</div>
            <div id="chartpieage" style="width: 100%; height: 350px;"></div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 px-5">
        <div class="block rounded">
          <div class="block-content block-content-full">
            <div class="block-title font-size-md font-w600 text-left text-uppercase">Jenis Kelamin Pegawai</div>
            <div id="chartpiegender" style="width: 100%; height: 350px;"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 px-5">
        <div class="block rounded">
          <div class="block-content block-content-full">
            <div class="block-title font-size-md font-w600 text-left text-uppercase">Jenis Pegawai</div>
            <div id="chartpiejenis" style="width: 100%; height: 350px;"></div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 px-5">
        <div class="block rounded">
          <div class="block-content block-content-full">
            <div class="block-title font-size-md font-w600 text-left text-uppercase">Status Pegawai</div>
            <div id="chartpiestatus" style="width: 100%; height: 350px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('footer-script')

@include('kepegawaian.statistika.components.js')

@endpush