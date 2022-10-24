@extends('kepegawaian.layouts.main-print')

@section('title', 'Daftar Keluar Masuk Personel')

@section('main-content')
<page size="A4" layout="portrait">
  <div>
    <div class="header-left text-center">
      <p class="header">{{config('app.name')}}</p>
    </div>
  </div>
  <div class="text-center judul">
    <h4>Daftar Keluar Masuk Personel</h4>
    <h5>Bulan {{$month}} {{$year}}</h5>
  </div>
  <div>
    <div>
      <table class="table-custom" style="width: 100%">
        <thead>
          <tr>
            <th class="table-custom text-center" style="width: 8%">No</th>
            <th class="table-custom text-center" style="width: 27%">Nama</th>
            <th class="table-custom text-center" style="width: 20%">Pangkat Korp</th>
            <th class="table-custom text-center" style="width: 15%">NRP</th>
            <th class="table-custom text-center" style="width: 15%">Tmt Masuk Satuan</th>
            <th class="table-custom text-center" style="width: 15%">Tmt Keluar Satuan</th>
          </tr>
          <tr>
            @for ($i = 1; $i < 7; $i++)
              <td class="table-custom text-center">{{$i}}</th>
            @endfor
          </tr>
        </thead>
        <tbody>
          @foreach ($items as $key => $item)
            <tr>
              <td class="table-custom text-center">{{$key+1}}</td>
              <td class="table-custom pad-left">{{$item->name}}</td>
              @if ($item->positions->count() > 0)
                @php
                  $position = $item->positions->first();
                @endphp
                <td class="table-custom pad-left">{{$position->mposition['name']}}</td>
              @else
                <td class="table-custom text-center"> — </td>
              @endif
              <td class="table-custom pad-left">{{$item->nrp}}</td>
              <td class="table-custom pad-left">{{($item->tmtFormattedReport ? $item->tmtFormattedReport : ' — ')}}</td>
              <td class="table-custom pad-left">{{($item->tmtOutFormattedReport ? $item->tmtOutFormattedReport : ' — ')}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  {{-- Tanda tangan --}}
  @include('kepegawaian.laporan.sign')
</page>
@endsection