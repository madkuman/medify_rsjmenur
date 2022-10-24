    <table>
    <tr>
        <td colspan="14"><b>DAFTAR PENDERITA BARU KANKER DI SURABAYA</b></td>
    </tr>
    <tr>
        <td colspan="14">PERIODE : {{$start->format('d-m-Y')}} s/d {{$end->format('d-m-Y')}}</td>
    </tr>
    <tr>
        <td colspan="14"></td>
    </tr>
    <tr>
        <td rowspan="2"><b>NO</b></td>
        <td rowspan="2"><b>NIK</b></td>
        <td rowspan="2"><b>NAMA</b></td>
        <td rowspan="2"><b>ALAMAT</b></td>
        <td rowspan="2"><b>UMUR</b></td>
        <td colspan="2"><b>JENIS KELAMIN</b></td>
        <td colspan="5"><b>JENIS PEMBIAYAAN</b></td>
        <td rowspan="2"><b>DIAGNOSA KANKER</b></td>
        <td rowspan="2"><b>STADIUM</b></td>
    </tr>
    <tr>
        <td><b>L</b></td>
        <td><b>P</b></td>
        <td><b>UMUM</b></td>
        <td><b>BPJS MANDIRI</b></td>
        <td><b>PBJS PBI</b></td>
        <td><b>ASURANSI</b></td>
        <td><b>LAIN-LAIN</b></td>
    </tr>
    @php
        $count_lk = 0;
        $count_pr = 0;
    @endphp

    @foreach($data as $kasus)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$kasus->pasien->no_identitas}}</td>
        <td>{{$kasus->pasien->name}}</td>
        <td>{{$kasus->pasien->text_alamat}} </td>
        <td>{{$kasus->identitas->umur}}</td>
        <td>
            @if($kasus->identitas->jenis_kelamin == 'L') 
            X 
            @php $count_lk++ @endphp
            @endif
        </td>
        <td>
            @if($kasus->identitas->jenis_kelamin == 'P') 
            X 
            @php $count_pr++ @endphp
            @endif
        </td>
            @php $echo_perusahaan = 0 @endphp

        <td>
            @if($kasus->pembayaran->perusahaan->tipe->slug == 'tunai')
            X
            @php $echo_perusahaan = 1 @endphp
            @endif
        </td>
        @php $perusahaan_nama = $kasus->pembayaran->perusahaan->nama ?? '-' @endphp
        
        <td>
            @if($kasus->pembayaran->perusahaan->tipe->slug == 'bpjs')
            @if(strpos($perusahaan_nama, 'BPJS PBI') === false)
            X
            @php $echo_perusahaan = 1 @endphp
            @endif
            @endif
        </td>
        <td>
            @if($kasus->pembayaran->perusahaan->tipe->slug == 'bpjs')
            @if(strpos($perusahaan_nama, 'BPJS PBI') !== false)
            X
            @php $echo_perusahaan = 1 @endphp
            @endif
            @endif
        </td>
        <td>
            @if($echo_perusahaan == 0) X @endif
        </td>
        <td></td>
        <td>
            @foreach($kasus->diagnosis as $dx)
            @php
                $dx_tags = $dx->icd10->tags ?? '-'
            @endphp

            @if(strpos($dx_tags, 'kanker') !== false)
            {{$dx->icd10->code_icd}}
            @if(!$loop->last),@endif
            @endif
            @endforeach
        </td>
        <td>
            @foreach($kasus->diagnosis as $dx)
            @php
                $dx_tags = $dx->icd10->tags ?? '-'
            @endphp

            @if(strpos($dx_tags, 'kanker') !== false)
            {{$dx->kanker_stadium}}
            @if(!$loop->last),@endif
            @endif
            @endforeach
        </td>
    </tr>
    @endforeach
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr>
        <td colspan="4">JUMLAH LAKI LAKI</td>
        <td>{{$count_lk ?? '0'}}</td>
    </tr>
    <tr>
        <td colspan="4">JUMLAH PEREMPUAN</td>
        <td>{{$count_pr ?? '0'}}</td>
    </tr>
    <tr>
        <td colspan="4">JUMLAH</td>
        <td>{{count($data)}}</td>
    </tr>
</table>
