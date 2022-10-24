@extends('kepegawaian.layouts.main-print')

@section('title', 'Laporan Nominatif Personel')

@section('main-content')

<table class="table-custom" style="width: 100%">
  <thead>
    <tr>
      <td colspan="4">{{config('app.name')}}</td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td>
      <td colspan="4">LAMPIRAN SURAT</td>
    </tr>
    <tr>
      <td colspan="4"></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td>
      <td colspan="4">Kepala {{config('app.name')}}</td>
    </tr>
    <tr>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td>
      <td colspan="3">Nomor Sprin/</td>
      <td colspan="1"> </td>
    </tr>
    <tr>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td>
      <td colspan="3">Tanggal</td>
      <td colspan="1">{{$month_year}}</td>
    </tr>
    <tr>
      <td colspan="15">Nominatif Personel {{$judul}}</td>
    </tr>
    <tr>
      <td colspan="15">Bulan {{$month_year}}</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="table-custom text-center" style="width: 3%">No</td>
      <td class="table-custom text-center" style="width: 12%">Nama<br>Tgl Lahir</td>
      <td class="table-custom text-center" style="width: 8%">Pangkat Korp</td>
      <td class="table-custom text-center" style="width: 5%">NRP</td>
      <td class="table-custom text-center" style="width: 5%">Tmt. TNI/AL</td>
      <td class="table-custom text-center" style="width: 5%">Tmt. PA</td>
      <td class="table-custom text-center" style="width: 5%">Tmt. Kat Akhir</td>
      <td class="table-custom text-center" style="width: 10%">Jabatan</td>
      <td class="table-custom text-center" style="width: 5%">Tmt. Jabatan</td>
      <td class="table-custom text-center" style="width: 10%">Umum</td>
      <td class="table-custom text-center" style="width: 10%">Militer</td>
      <td class="table-custom text-center" style="width: 4%">K/<br>TK</td>
      <td class="table-custom text-center" style="width: 5%">Agama</td>
      <td class="table-custom text-center" style="width: 3%">Status Rmh</td>
      <td class="table-custom text-center" style="width: 15%">Alamat</td>
    </tr>
    <tr>
      @for ($i = 1; $i < 16; $i++)
      <td class="table-custom text-center">{{$i}}</td>
      @endfor
    </tr>
  </thead>
  <tbody>
    @foreach ($items as $key => $item)
    <tr>
      <td class="table-custom text-center">{{$key+1}}</td>
      <td class="table-custom pad-left">{{$item->name}}<br>{{$item->kelahiran_report_formatted}}</td>
      @if($item->positions->count() > 0)
      @php
      $position = $item->positions->first();
      @endphp
      <td class="table-custom pad-left">{{$position->mposition['name']}}</td>
      @else
      <td class="table-custom text-center"> — </td>
      @endif
      <td class="table-custom pad-left">{{$item->nrp}}&nbsp;</td>
      <td class="table-custom pad-left">{{($item->tmt_formatted_report ? $item->tmt_formatted_report : ' — ')}}</td>
      <td class="table-custom pad-left">{{($item->tmt_pa_pns_report_formatted ? $item->tmt_pa_pns_report_formatted : ' — ')}}</td>

      @if($item->positions->count() > 0)
      <td class="table-custom pad-left">{{$position->tmtFormattedReport}}</td>
      @else
      <td class="table-custom text-center"> — </td>
      @endif

      @if(!empty($item->jabatan_kasal->position))
      <td class="table-custom pad-left">{{$item->jabatan_kasal->position}}</td>
      @else
      <td class="table-custom text-center"> — </td>
      @endif
      @if(!empty($item->jabatan_kasal->position))
      <td class="table-custom pad-left">{{ date('d/m/y', strtotime( $item->jabatan_kasal->sp_date))}}</td>
      @else
      <td class="table-custom text-center"> — </td>
      @endif
      @if($item->educations->count() > 0)
      <td class="table-custom pad-left">
        @foreach($item->educations as $education)
        @if ($loop->last)
        {{$education->name}}
        @else
        {{$education->name}},
        @endif
        @endforeach
      </td>
      @else
      <td class="table-custom text-center"> — </td>
      @endif

      @if($item->militaries->count() > 0)
      <td class="table-custom pad-left">
        @foreach($item->militaries as $military)
        @if ($loop->last)
        {{$military->name}}
        @else
        {{$military->name}},
        @endif
        @endforeach
      </td>
      @else
      <td class="table-custom text-center"> — </td>
      @endif

      @if($item->marriages->count() > 0)
      @php
      $marriage = $item->marriages->first();
      @endphp
      <td class="table-custom text-center">{{ !empty($marriage) ? $marriage->status . '/' . $marriage->total_child : '-' }}</td>
      @else
      <td class="table-custom text-center"> — </td>
      @endif
      <td class="table-custom pad-left">{{$item->religion['name']}}</td>
      <td class="table-custom pad-left">{{$item->living_type}}</td>
      <td class="table-custom pad-left">{{$item->address}}</td>
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
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td>Kepala {{config('app.name')}}</td>
    </tr>

    @elseif($signed['signBy']->jabatan_kasal->position == 'Kabagminpers')
    <tr>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td>Dansatma</td>
    </tr>
    <tr>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td>U.b.</td>
    </tr>
    <tr>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td>Kabagminpers,</td>
    </tr>

    @else

    <tr>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
      <td></td><td></td>
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
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>{{$signed['signBy']->name}}</td>
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