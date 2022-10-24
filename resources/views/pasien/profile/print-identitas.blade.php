<h4 class="text-center">DATA PASIEN<br>
    No RM :{{strtoupper($identitas->no_rm_formatted)}}
</h4>
@if($identitas->photo_thumb != 'assets/img/placeholder.jpg')
<table width="100%">
    <tr>
        <th width="42.5%"></th>
        <th width="15%">
            <img src="{{url('')}}/{{$identitas->photo_thumb}}" height="100" style="border-radius: 50px;">
        </th>
        <th width="42.5%"></th>
    </tr>
</table>
@endif
<br>
<h3>IDENTITAS PASIEN</h3>

<table width="100%">
    <tr>
        <th width="20%"></th>
        <th width="30%"></th>
        <th width="20%"></th>
        <th width="30%"></th>
    </tr>
    <tr>
        <td>Nama Pasien</td>
        @if(empty($identitas->name))
        <td>: -</td>
        @else
        <td><span class="text-uppercase"> : {{strtoupper($identitas->name)}} </span></td>
        @endif
        <td>Tgl Kunjungan</td>
        <td class="capitalize">: 
            <span class="text-uppercase"> {{Date::parse($identitas->created_at)->format('d F Y')}}</span>
        </td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>: 
            @if($identitas->gender == 1) LAKI-LAKI
            @else PEREMPUAN
            @endif
        </td>
        <td>Jenis Penjamin</td>
        @if(empty($identitas->pembayaranUtama->perusahaan->nama))
        <td>: -</td>
        @else
        <td>: {{strtoupper($identitas->pembayaranUtama->perusahaan->nama)}}</td>
        @endif            
    </tr>
    <tr>
        <td>Tmpt Lahir</td>
        <td>: 
            {{strtoupper($identitas->place_of_birth)}}
        </td>
        <td>Nomor Penjamin</td>
        @if(empty($identitas->pembayaranUtama->no_asuransi))
        <td>: -</td>
        @else
        <td>: {{strtoupper($identitas->pembayaranUtama->no_asuransi)}}</td>
        @endif
    </tr>
    <tr>
        <td>Tgl Lahir</td>
        <td>: 
            <span class="text-uppercase"> {{Date::parse($identitas->date_of_birth)->format('d F Y')}}</span>
        </td>
        <td>Jenis ID</td>
        @if(empty($identitas->jenis_identitas->nama))
        <td>: -</td>
        @else
        <td>: {{strtoupper($identitas->jenis_identitas->nama)}}</td>
        @endif
    </tr>
    <tr>
        <td>Usia</td>
        <td>:  {{strtoupper($identitas->age)}} TAHUN</td>
        <td>No ID</td>
        <td>: {{strtoupper($identitas->no_identitas)}}</td>
    </tr>
    <tr>
        <td>Status Nikah</td>
        <td>: 
            @if($identitas->marriage == 1 ) SINGLE
            @elseif($identitas->marriage == 2 ) MENIKAH
            @elseif($identitas->marriage == 3 ) DUDA/JANDA
            @else -
            @endif
        </td>
    </tr>
    <tr>
        <td>Agama</td>
        <td>: {{strtoupper($identitas->agama->nama)}}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td colspan="3">: 
            {{strtoupper($identitas->address)}}, 
            @if(!empty($identitas->alamat_kecamatan))
            {{$identitas->alamat_kelurahan->nama or '-'}}, {{$identitas->alamat_kecamatan->nama or '-'}}, {{$identitas->alamat_kota->nama or '-'}}, {{$identitas->alamat_kota->provinsi->nama or '-'}}
            @endif
        </td>
    </tr>
    <tr>
        <td>No Telp</td>
        @if(empty($identitas->phone))
        <td colspan="3">: -</td>
        @else
        <td colspan="3">: {{strtoupper($identitas->phone)}}</td>
        @endif
    </tr>
    <tr>
        <td>Pendidikan</td>
        @if(empty($identitas->pendidikan->nama))
        <td colspan="3">: -</td>
        @else
        <td colspan="3">: {{strtoupper($identitas->pendidikan->nama)}}</td>
        @endif
    </tr>
    <tr>
        <td>Pekerjaan</td>
        @if(empty($identitas->job))
        <td colspan="3">: -</td>
        @else
        <td colspan="3">: {{strtoupper($identitas->job)}}</td>
        @endif
    </tr>
</table>


<br>
<br>
<h3>IDENTITAS KERABAT/KELUARGA</h3>
<table width="100%">
    <tr>
        <th width="20%"></th>
        <th width="80%"></th>
    </tr>
    <tr>
        <td>Nama Pasien</td>
        <td>: {{strtoupper($identitas->wali->name ?? '-')}}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>: 
            @if(($identitas->wali->gender ?? 0 ) == 1 ) LAKI-LAKI
            @elseif(($identitas->wali->gender ?? 0) == 2 ) PEREMPUAN
            @else -
            @endif
        </td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>: 
            {{strtoupper($identitas->wali->address ?? '-')}}, 
            @if(!empty($identitas->wali->alamat_kecamatan))
            {{$identitas->wali->alamat_kelurahan->nama ?? '-'}}, {{$identitas->wali->alamat_kecamatan->nama ?? '-'}}, {{$identitas->wali->alamat_kota->nama ?? '-'}}, {{$identitas->wali->alamat_kota->provinsi->nama ?? '-'}}
            @endif
        </td>
    </tr>
    <tr>
        <td>No HP</td>
        <td>: {{strtoupper($identitas->wali->phone ?? '-')}}</td>
    </tr>
    <tr>
        <td>Hubungan</td>
        <td>: 
            {{strtoupper($identitas->jenis_hubungan_keluarga->nama ?? '-')}}
        </td>
    </tr>



    @if(($identitas->wali->is_anggota ?? 0) == 1)
    <tr>
        <td>NRP</td>
        <td>: {{strtoupper($identitas->wali->tni_nrp ?? '-')}}</td>
    </tr>
    <tr>
        <td>Pangkat</td>
        <td>: {{strtoupper($identitas->wali->tni_pangkat->nama ?? '-')}}</td>
    </tr>
    <tr>
        <td>Keanggotaan</td>
        <td>: {{strtoupper($identitas->wali->tni_keanggotaan->nama ?? '-')}}</td>
    </tr>
    <tr>
        <td>Kotama</td>
        <td>: {{strtoupper($identitas->wali->tni_kotama->nama ?? '-')}}</td>
    </tr>
    <tr>
        <td>Satker</td>
        <td>: {{strtoupper($identitas->wali->tni_satker->nama ?? '-')}}</td>
    </tr>
    @endif
</table>