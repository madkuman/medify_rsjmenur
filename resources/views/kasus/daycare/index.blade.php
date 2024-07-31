@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Day Care Rehabilitasi Psikososial - Kasus
@endsection

@section('content')
<main id="main-container">
  @include('kasus.layouts.header')
  <div class="content">
    <div class="row">
      @include('kasus.layouts.sidebar')
      <div class="col-lg-9 col-xl-9">
        <div class="block">
          <ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary" data-toggle="tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" href="#asesmen" id="nav-asesmen">Asesmen</a>
            </li>
          </ul>
          <div class="block-content tab-content overflow-hidden">
            <div class="tab-pane fade fade-left active show" id="asesmen" role="tabpanel">
              <div class="block-content">
                <ul class="list row row-deck">
                  <li class="col-md-4 text-center">
                    <a target="_blank" class="block block-link-pop block-themed" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/pengantar-pengiriman-pasien">
                      <div class="block-header">
                        <h3 class="block-title">Pengantar Pengiriman Pasien</h3>
                      </div>
                      <div class="block-content">
                        <p class="mt-5 mb-10">
                          <i class="fa fa-calculator fa-4x "></i>
                        </p>
                        <h5 class="mb-5 title">Pengantar Pengiriman Pasien</h5>
                        <p class="desc">Pengantar Pengiriman Pasien</p>
                      </div>
                    </a>
                  </li>

                  <li class="col-md-4 text-center">
                    <a style="pointer-events:none;" target="_blank" class="block block-link-pop block-themed" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/?/?">
                      <div class="block-header">
                        <h3 class="block-title">Hasil Seleksi</h3>
                      </div>
                      <div class="block-content">
                        <p class="mt-5 mb-10">
                          <i class="fa fa-calculator fa-4x "></i>
                        </p>
                        <h5 class="mb-5 title">Hasil Seleksi</h5>
                        <p class="desc">Hasil Seleksi</p>
                      </div>
                    </a>
                  </li>

                  <li class="col-md-4 text-center">
                    <a target="_blank" class="block block-link-pop block-themed" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-bantu/surat-persetujuan-dirawat">
                      <div class="block-header">
                        <h3 class="block-title">Surat Persetujuan Dirawat</h3>
                      </div>
                      <div class="block-content">
                        <p class="mt-5 mb-10">
                          <i class="fa fa-calculator fa-4x "></i>
                        </p>
                        <h5 class="mb-5 title">Surat Persetujuan Dirawat</h5>
                        <p class="desc">Surat Persetujuan Dirawat</p>
                      </div>
                    </a>
                  </li>

                  <li class="col-md-4 text-center">
                    <a style="pointer-events:none;" target="_blank" class="block block-link-pop block-themed" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/?/?">
                      <div class="block-header">
                        <h3 class="block-title">Form Evaluasi Perkembangan Vokasional</h3>
                      </div>
                      <div class="block-content">
                        <p class="mt-5 mb-10">
                          <i class="fa fa-calculator fa-4x "></i>
                        </p>
                        <h5 class="mb-5 title">Form Evaluasi Perkembangan Vokasional</h5>
                        <p class="desc">Form Evaluasi Perkembangan Vokasional</p>
                      </div>
                    </a>
                  </li>

                  <li class="col-md-4 text-center">
                    <a style="pointer-events:none;" target="_blank" class="block block-link-pop block-themed" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/?/?">
                      <div class="block-header">
                        <h3 class="block-title">Form Evaluasi Perkembangan Non-Vokasional</h3>
                      </div>
                      <div class="block-content">
                        <p class="mt-5 mb-10">
                          <i class="fa fa-calculator fa-4x "></i>
                        </p>
                        <h5 class="mb-5 title">Form Evaluasi Perkembangan Non-Vokasional</h5>
                        <p class="desc">Form Evaluasi Perkembangan Non-Vokasional</p>
                      </div>
                    </a>
                  </li>
                  
                  <li class="col-md-4 text-center">
                    <a style="pointer-events:none;" target="_blank" class="block block-link-pop block-themed" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/?/?">
                      <div class="block-header">
                        <h3 class="block-title">Hasil Evaluasi (step)</h3>
                      </div>
                      <div class="block-content">
                        <p class="mt-5 mb-10">
                          <i class="fa fa-calculator fa-4x "></i>
                        </p>
                        <h5 class="mb-5 title">Hasil Evaluasi (step)</h5>
                        <p class="desc">Hasil Evaluasi (step)</p>
                      </div>
                    </a>
                  </li>
            
                  <li class="col-md-4 text-center">
                    <a target="_blank" class="block block-link-pop block-themed" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/skoring-panss-ec">
                      <div class="block-header">
                        <h3 class="block-title">Skoring PANSS EC</h3>
                      </div>
                      <div class="block-content">
                        <p class="mt-5 mb-10">
                          <i class="fa fa-calculator fa-4x "></i>
                        </p>
                        <h5 class="mb-5 title">Skoring PANSS EC</h5>
                        <p class="desc">Skoring PANSS EC</p>
                      </div>
                    </a>
                  </li>
            
                  <li class="col-md-4 text-center">
                    <a target="_blank" target="_blank" class="block block-link-pop block-themed" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-bantu/mini-mental-state-examination">
                      <div class="block-header">
                        <h3 class="block-title">Mini Mental State Examination</h3>
                      </div>
                      <div class="block-content">
                        <p class="mt-5 mb-10">
                          <i class="fa fa-calculator fa-4x "></i>
                        </p>
                        <h5 class="mb-5 title">Mini Mental State Examination</h5>
                        <p class="desc">Mini Mental State Examination</p>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection