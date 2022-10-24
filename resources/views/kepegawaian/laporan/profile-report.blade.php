@extends('kepegawaian.layouts.main-print')

@section('title', 'Data Riwayat Personel')

@section('main-content')
<page size="A4" layout="portrait">
  <div>
    <div class="header-left text-center">
      <p class="header">{{config('app.name')}}</p>
    </div>
  </div>
  <div class="text-center judul">
    <h4><span class="text-bold">DATA RIWAYAT</span></h4>
    <h4>PERSONEL</h4>
  </div>
  <div style="margin-left: 10px">
    <table style="width: 100%">
      <tbody>
        <tr>
          <td style="vertical-align: top; width: 4%; text-align: center;">1.</td>
          <td style="vertical-align: top; width: 21%;">Nama</td>
          <td style="vertical-align: top; width: 2%;">:</td>
          <td style="vertical-align: top; width: 43%">{{$item->name}}</td>
          <td style="width: 30%" rowspan="12">
            @php
            $path = public_path('/uploads/kepegawaian/profile/');
            @endphp 
            @if (file_exists($path.$item->photo.".png"))
            <img src="{{ $path.$item->photo.'.png' }}" style="width: 150px">
            @elseif(file_exists($path.$item->photo.".jpg"))
            <img src="{{ $path.$item->photo.'.jpg' }}" style="width: 150px">
            @elseif(file_exists($path.$item->photo.".jpeg"))
            <img src="{{ $path.$item->photo.'.jpeg' }}" style="width: 150px">
            @else
            <img src="{{ URL::asset('assets/img/avatars/avatar9.jpg') }}" style="width: 150px">
            @endif
          </td>
        </tr>
        <tr>
          <td style="vertical-align: top; text-align: center;">2.</td>
          <td style="vertical-align: top;">Tempat/Tgl. Lahir</td>
          <td class="text-center" style="vertical-align: top; width: 2%">:</td>
          <td>{{ !empty($item->kelahiran) ? $item->kelahiran : '-'}}</td>
        </tr>
        <tr>
          <td style="vertical-align: top; text-align: center;">3.</td>
          <td style="vertical-align: top;">Pangkat/Korps</td>
          <td class="text-center" style="vertical-align: top; width: 2%">:</td>
          @php
          $position = $item->positions->first();
          @endphp
          <td>{{ !empty($position) ? $position->mposition->name : '-' }}</td>
        </tr>
        <tr>
          <td style="vertical-align: top; text-align: center;">4.</td>
          <td style="vertical-align: top;">Nrp</td>
          <td class="text-center" style="vertical-align: top; width: 2%">:</td>
          <td>{{ !empty($item->nrp) ? $item->nrp : '-' }}</td>
        </tr>
        <tr>
          <td style="text-align: center;">5.</td>
          <td>Jenis Kelamin</td>
          <td class="text-center" style="width: 2%">:</td>
          <td>{{ !empty($item->gender) ? $item->gender : '-' }}</td>
        </tr>
        <tr>
          <td style="vertical-align: top; text-align: center;">6.</td>
          <td style="vertical-align: top;">Gol. Darah</td>
          <td class="text-center" style="vertical-align: top; width: 2%">:</td>
          <td>{{ !empty($item->blood_type) ? $item->blood_type : '-' }}</td>
        </tr>
        <tr>
          <td style="vertical-align: top; text-align: center;">7.</td>
          <td style="vertical-align: top;">Status Keluarga</td>
          <td class="text-center" style="vertical-align: top; width: 2%">:</td>
          @php
          $marriage = $item->marriages->first();
          @endphp
          <td>{{ !empty($marriage) ? $marriage->status . '/' . $marriage->total_child : '-' }}</td>
        </tr>
        <tr>
          <td style="vertical-align: top; text-align: center;">8.</td>
          <td style="vertical-align: top;">Jabatan</td>
          <td class="text-center" style="vertical-align: top; width: 2%">:</td>
          @if(!empty($item->jabatan_kasal->position))
          <td>{{$item->jabatan_kasal->position}}</td>
          @endif
        </tr>
        <tr>
          <td style="vertical-align: top; text-align: center;">9.</td>
          <td style="vertical-align: top;">Tmt. Jab</td>
          <td class="text-center" style="vertical-align: top; width: 2%">:</td>
          @if(!empty($item->jabatan_kasal->position))
          <td>{{ date('d/m/y', strtotime( $item->jabatan_kasal->sp_date))}}</td>
          @endif
        </tr>
        <tr>
          <td style="vertical-align: top; text-align: center;">10.</td>
          <td style="vertical-align: top;">Alamat</td>
          <td class="text-center" style="vertical-align: top; width: 2%">:</td>
          <td>{{ !empty($item->address) ? $item->address : '-' }}</td>
        </tr>
        <tr>
          <td style="vertical-align: top; text-align: center;">11.</td>
          <td style="vertical-align: top;">No. Tlp</td>
          <td class="text-center" style="vertical-align: top; width: 2%">:</td>
          <td>{{ !empty($item->phone) ? $item->phone : '-' }}</td>
        </tr>
        <tr>
          <td style="vertical-align: top; text-align: center;">12.</td>
          <td style="vertical-align: top;">Tmt Masuk</td>
          <td class="text-center" style="vertical-align: top; width: 2%">:</td>
          <td>{{ !empty($item->tmtFormattedReport) ? $item->tmtFormattedReport : '-' }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  {{-- Riwayat Pangkat --}}
  <div>
    <h5 class="subjudul text-bold">Riwayat Pangkat</h5>
  </div>
  @if ($item->positions->count() > 0)
  <div style="margin-left: 10px">
    <table style="width: 100%">
      <tbody>
        @foreach ($item->positions as $key => $pangkat)
        <tr>
          <td style="width: 4%">{{$key+1}}.</td>
          <td style="width: 24%">{{ !empty($item->positions[$key]->mposition_id) ? $item->positions[$key]->mposition->name : '-' }}</td>
          <td style="width: 22%">{{ !empty($item->positions[$key]->tmtFormattedReport) ? $item->positions[$key]->tmtFormattedReport : '-' }}</td>
          <td style="width: 4%">{{(int)ceil($item->positions->count()/2)+$key+1}}.</td>
          <td style="width: 24%">{{!empty($item->positions[(int)ceil($item->positions->count()/2)+$key]->mposition_id) ? $item->positions[(int)ceil($item->positions->count()/2)+$key]->mposition->name : '-' }}</td>
          <td style="width: 22%">{{ !empty($item->positions[(int)ceil($item->positions->count()/2)+$key]->tmtFormattedReport) ? $item->positions[(int)ceil($item->positions->count()/2)+$key]->tmtFormattedReport : '-' }}</td>
        </tr>
        <?php if($key+1 == (int)ceil($item->positions->count()/2)) { break; } ?>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <div style="margin-left: 30px">
    <p>Tidak ada data.</p>
  </div>
  @endif

 

  

  

  

{{-- Riwayat Jabatan --}}
<div>
  <h5 class="subjudul text-bold">Riwayat Jabatan/Penugasan</h5>
</div>
@if ($item->departments->count() > 0)  
<div>
  <div style="margin-left: 10px">
    <table style="width: 100%">
      <tbody>
        @foreach ($item->departments as $key => $department)
        <tr>
          <td style="vertical-align: top; width: 4%">{{$key+1}}.</td>
          <td style="vertical-align: top; width: 50%">{{ !empty($department->mdepartment_id) ? $department->mdepartment['name'] : '-' }}</td>
          <td style="vertical-align: top; width: 19%; text-align: center;">{{ !empty($department->tmtFormattedReport) ? $department->tmtFormattedReport : '-' }}</td>
          <td style="vertical-align: top; width: 25%; text-align: center;">{{ !empty($department->st_number) ? $department->st_number : '-' }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@else
<div style="margin-left: 30px">
  <p>Tidak ada data.</p>
</div>
@endif
<br><br><br>
{{-- Tanda tangan --}}
@include('kepegawaian.laporan.sign')

</page>
@endsection