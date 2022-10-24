@extends('layouts.print')

@section('title')
Print Pegawai - {{$item->name}}
@endsection

@section('content')
<table width="100%">
    <tr>
        <td width="100%"><img src="{{config('app.kop_lg')}}" height="50"></td>
    </tr>
</table>


<hr>
<h4 class="text-center">DATA PEGAWAI<br>
    NRP : {{strtoupper($item->nrp)}}
</h4>
<table width="100%">
    <tr>
        <th width="42.5%"></th>
        <th width="15%">
            <img src="" height="100" style="border-radius: 50px;">
        </th>
        <th width="42.5%"></th>
    </tr>
</table>

<br>
<h3>DATA UMUM</h3>

<table width="100%">
    <tr>
        <th width="20%"></th>
        <th width="30%"></th>
        <th width="20%"></th>
        <th width="30%"></th>
    </tr>
    <tr>
        <td>Nama Pegawai</td>
        <td><span class="text-uppercase"> : {{strtoupper($item->name)}} </span></td>
        <td>Kualifikasi</td>
        <td>: {{!empty($item->masterKualifikasi->nama) ? $item->masterKualifikasi->nama : '-'}}</td>
    </tr>
    <tr>
        <td>NRP</td>
        <td>: 
            {{!empty($item->nrp) ? $item->nrp : '-'}}
        </td>
        <td>SUB Kualifikasi</td>
        <td>: {{!empty($item->masterSubkualifikasi->nama) ? $item->masterSubkualifikasi->nama : '-'}}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>: 
            @if($item->gender == "L") LAKI-LAKI
            @else PEREMPUAN
            @endif
        </td> 
    </tr>
    <tr>
        <td>Tempt Lahir</td>
        <td>: {{$item->birth_place}}</td>
    </tr>
    <tr>
        <td>Tgl Lahir</td>
        <td>: 
            <span class="text-uppercase"> {{Date::parse($item->birth_date)->format('d F Y')}}</span>
        </td>
    </tr>
    <tr>
        <td>Usia</td>
        <td>:  
            {{-- {{!empty($item->age) ? $item->age : '-'}} --}}
        </td>
    </tr>
</table>


<br>
<br>
<h3>DATA PERSONAL</h3>
<table width="100%">
    <tr>
        <th width="30%"></th>
        <th width="70%"></th>
    </tr>
    <tr>
        <td>KTP</td>
        <td>: {{!empty($item->identity_card) ? $item->identity_card : '-'}}</td>
    </tr>
    <tr>
        <td>NO. Kartu Keluarga</td>
        <td>: 
            {{!empty($item->family_registers) ? $item->family_registers : '-'}}
        </td>
    </tr>
    <tr>
        <td>Agama</td>
        <td>: {{ $item->agama->nama ?? '-'}}</td>
    </tr>
    <tr>
        <td>No. HP</td>
        <td>: {{!empty($item->phone) ? $item->phone : '-'}}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>: 
            {{!empty($item->email) ? $item->email : '-'}}
        </td>
    </tr>
    <tr>
        <td>NPWP</td>
        <td>:
            {{!empty($item->npwp) ? $item->npwp : '-'}}
        </td>
    </tr>
    <tr>
        <td>No. SIM</td>
        <td>:
            {{ !empty($item->driver_license) ? $item->driver_license.( !empty($item->driver_license_number) ? ' - '.$item->driver_license_number : '' ) : '-' }}
        </td>
    </tr>
    <tr>
        <td>No. Kendaraan</td>
        <td>:
            {{!empty($item->license_plate) ? $item->license_plate : '-'}}
        </td>
    </tr>
    <tr>
        <td>No. Rekening</td>
        <td>:
            {{ !empty($item->bank) ? $item->masterNamaBank->nama.(!empty($item->bank_account) ? ' - '.$item->bank_account : '') : '-' }}
        </td>
    </tr>
</table>

<br>
<br>
<h3>DATA DOMISILI</h3>
<table width="100%">
    <tr>
        <th width="30%"></th>
        <th width="70%"></th>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>: {{!empty($item->address) ? $item->address : '-'}}</td>
    </tr>
    <tr>
        <td>RT/RW</td>
        <td>: 
            {{!empty($item->rt_rw) ? $item->rt_rw : '-'}}
        </td>
    </tr>
    <tr>
        <td>Kecamatan</td>
        <td>: {{!empty($item->district->name) ? $item->district->name : '-'}}</td>
    </tr>
    <tr>
        <td>Kota/Kabupaten</td>
        <td>: {{ $item->city->name ?? '-'}}</td>
    </tr>
</table>

{{-- <br>
<br>
<h3>DATA PERNIKAHAN</h3>
<table width="100%">
    <tr>
        <th width="30%"></th>
        <th width="70%"></th>
    </tr>
    <tr>
        <td>Status</td>
        @php
				$marriages = [
				'K' => 'Menikah',
				'TK' => 'Belum Menikah',
				'D' => 'Duda',
				'J' => 'Janda'
				];

				$status = '-';
				if(!empty($marriage->status))
				$status = $marriages[$marriage->status];
				@endphp
        <td>: {{$status}}</td>
    </tr>
    <tr>
        <td>Jumlah Anak</td>
        <td>: 
            {{!empty($marriage->total_child) ? $marriage->total_child : '-'}}
        </td>
    </tr>
    <tr>
        <td>No. Surat Nikah</td>
        <td>: {{!empty($marriage->marriage_certificate_number) ? $marriage->marriage_certificate_number : '-'}}</td>
    </tr>
</table> --}}


<br>
<br>
{{-- <h3>DATA STAFF MEDIS</h3>
<table width="100%">
    <tr>
        <th width="30%"></th>
        <th width="70%"></th>
    </tr>
    <tr>
        <td>No. SIP</td>
        <td>: {{!empty($item->sip) ? $item->sip : '-'}}</td>
    </tr>
    <tr>
        <td>SIP EXPIRED</td>
        <td>:
            <span>{{!empty($item->sip) ? Date::parse($item->sip_expired_at)->format('d F Y') : '-'}}</span>
        </td>
    </tr>
    <tr>
        <td>File SIP</td>
        <td>: 
            @if(!empty($item->sip_file))
					<a href="{{asset('uploads/kepegawaian/profile')}}/{{$item->sip_file}}"
						@if(strpos($item->sip_file, '.zip')) download @else target="_blank"@endif>Lihat File</a>
					@else
					Tidak Tersedia
					@endif
        </td>
    </tr>

    <tr>
        <td>No. STR</td>
        <td>: {{!empty($item->str) ? $item->str : '-'}}</td>
    </tr>
    <tr>
        <td>STR EXPIRED</td>
        <td>: 
            <span>{{!empty($item->str) ? Date::parse($item->str_expired_at)->format('d F Y') : '-'}}</span>
        </td>
    </tr>
    <tr>
        <td>File STR</td>
        <td>: 
            @if(!empty($item->str_file))
					<a href="{{asset('uploads/kepegawaian/profile')}}/{{$item->str_file}}"
						@if(strpos($item->str_file, '.zip')) download @else target="_blank"@endif>Lihat File</a>
					@else
					Tidak Tersedia
					@endif
        </td>
    </tr>
</table> --}}

@endsection