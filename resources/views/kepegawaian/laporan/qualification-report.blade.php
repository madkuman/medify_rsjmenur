@extends('kepegawaian.layouts.main-print')

@section('title', 'Daftar Personel Berdasarkan Kualifikasi')

@section('main-content')
<table width="100%">
  <tr>
    <td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
  </tr>
</table>

<table class="table-custom" style="width: 100%">
  <thead>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="7">Daftar Personel Berdasarkan Kualifikasi</td>
    </tr>
    <tr>
      <td colspan="7">Bulan {{$month_year}}</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>

    <tr>
      <th class="table-custom text-center" style="width: 7%">No</th>
      <th class="table-custom text-center" style="width: 22%">Nama</th>
      <th class="table-custom text-center" style="width: 9%">Pangkat Korp</th>
      <th class="table-custom text-center" style="width: 10%">NRP</th>
      <th class="table-custom text-center" style="width: 12%">Kualifikasi SDM/DikUm Terakhir</th>
      <th class="table-custom text-center" style="width: 20%">Pendidikan Umum</th>
      <th class="table-custom text-center" style="width: 20%">Riwayat Pelatihan</th>
    </tr>
    <tr>
      @for ($i = 1; $i < 8; $i++)
      <th class="table-custom text-center">{{$i}}</th>
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
      <td class="table-custom pad-left">{{$item->nrp}}&nbsp;</td>
      @if ($item->educations->count() > 0)
      @php
      $education = $item->educations->first();
      @endphp
      <td class="table-custom pad-left">{{$education->name}}</td>
      @else
      <td class="table-custom text-center"> — </td>
      @endif

      @if ($item->educations->count() > 0)
      <td class="table-custom pad-left">
        @foreach ($item->educations as $education)
        @if($loop->last)
        {{$education->name}}
        @else
        {{$education->name}},
        @endif
        @endforeach
      </td>
      @else
      <td class="table-custom text-center"> — </td>
      @endif

      @if ($item->trainings->count() > 0)
      <td class="table-custom pad-left">
        @foreach ($item->trainings as $training)
        @if ($loop->last)
        {{$training->name}}
        @else
        {{$training->name}}, 
        @endif
        @endforeach
      </td>
      @else
      <td class="table-custom text-center"> — </td>
      @endif
    </tr>
    @endforeach

    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    @if($signed['isHead'] && $signed['signBy']->jabatan_kasal->position != 'Karumkital')
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>a.n. Kepala {{config('app.name')}}</td>
    </tr>
    @endif
    @if($signed['signBy']->jabatan_kasal->position == 'Karumkital')
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>Kepala {{config('app.name')}},</td>
    </tr>

    @elseif($signed['signBy']->jabatan_kasal->position == 'Kabagminpers')
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>Dansatma</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>U.b.</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>Kabagminpers,</td>
    </tr>

    @else

    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>{{$signed['signBy']->jabatan_kasal->position}},</td>
    </tr>

    @endif


    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    @php
    $position = $signed['signBy']->last_position->name;
    $position = !empty($signed['signBy']->last_position->name) ? $signed['signBy']->last_position->name : '';
    @endphp

    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>{{$signed['signBy']->name}}</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>{{$position}} NRP {{$signed['signBy']->nrp}}</td>
    </tr>

  </tbody>
</table>

@endsection