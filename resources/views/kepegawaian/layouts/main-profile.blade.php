@extends('kepegawaian.layouts.main')

@section('content')

@php
  $pegawai = isset($pegawai) ? $pegawai : $item;
@endphp

<div class="container">
  <div class="row justify-content-center">
    @include('kepegawaian.layouts.partials.profile-info')
    <div class="col-12 mt-20">
      <div class="block">
        @include('kepegawaian.layouts.partials.nav-profile')
        <div class="block-content">
          @yield('main-content')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection