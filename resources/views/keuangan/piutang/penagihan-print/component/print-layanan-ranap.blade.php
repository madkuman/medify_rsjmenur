@foreach($kasus as $caseArr)
@if(!isset($caseArr))
@continue
@endif
@php($case = $caseArr['kasus'] ?? $caseArr)
<table class="borderless" width="100%">
    <tr>
        <td width="80%"></td>
        <td width="20%">No. RM : {{$case->pasien->no_rm}}</td>
    </tr>
</table>
<table class="borderless" width="100%">
    <tr>
        <td class="text-center big">BUKTI PELAYANAN</td>
    </tr>
    <tr>
        <td class="text-center big">{{strtoupper($case->lokasi->lokasi->departemen->nama)}}</td>
    </tr>
</table>
<table class="borderless">
    <tr>
        <td>Nama</td>
        <td>: {{$case->pasien->name}}</td>
    </tr>
    <tr>
        <td>No SEP</td>
        <td>: {{$case->activeSep->no_sep ?? '-'}}</td>
    </tr>
    <tr>
        <td>Tanggal SEP</td>
        <td>: {{isset($case->activeSep->tgl_sep) ? indonesian_date($case->activeSep->tgl_sep) :  '-'}}</td>
    </tr>
    <tr>
        <td>Diagnosa</td>
        <td>: {{$case->diagnosisUtama->icd10->code_icd ?? '-'}}</td>
    </tr>
    @if($case->rawat_inap_transaksi_last)
    <tr>
        <td>Ruangan Terakhir Pasien Dirawat</td>
        <td>: Bangsal {{$case->rawat_inap_transaksi_last->tempat_tidur->ruangan->bangsal->nama ?? '-'}}</td>
    </tr>
    @endif

    <tr>
        <td colspan="2">Sembuh - Dirujuk - Meninggal</td>
    </tr>
</table>

<table width="100%" class="table table-bordered">
    <tr>
        <th width="20%"></th>
        <th width="30%" style="text-align: center;">TANGGAL</th>
        <th width="50%" style="text-align: center;">KETERANGAN</th>
    </tr>
    <tr>
        <td>MASUK</td>
        <td>{{$case->mrs_at ? indonesian_date($case->mrs_at) : indonesian_date($case->created_at)}}</td>
        <td class="borderless-vertical"></td>
    </tr>
    <tr>
        <td>KELUAR</td>
        <td>{{indonesian_date($case->krs_at) ?? '-'}}</td>
        <td class="borderless-vertical"></td>
    </tr>
    @if(isset($case->operasiTransaksi))
    @php($transaksiOperasi = $case->operasi->sortBy('id'))
    @foreach($case->operasiTransaksi as $i => $transaksi)
    <tr>
        <td>@if($i==0) OPERASI @endif</td>
        <td> {{indonesian_date($transaksi->jadwal_operasi)}}</td>
        <td class="borderless-vertical"></td>
    </tr>
    @endforeach
    @else
    <tr>
        <td>OPERASI</td>
        <td></td>
        <td>-</td>
    </tr>
    @endif
    @php($row = -1)
    @foreach($case->diagnosis as $i => $diagnosis)
    @if($i == 0)
    <tr>
        <td class="">PEMERIKSAAN/<br>TINDAKAN LAIN</td>
        <td class="">{{$case->mrs_at ?? $case->created_at}}</td>
        <td class="">({{$diagnosis->lokasi->nama}}) {{$diagnosis->icd10->code_icd}} - {{$diagnosis->icd10->long_desc}}</td>
    </tr>
    @else
    <tr>
        <td class="no-right borderless-vertical"></td>
        <td class="no-left borderless-vertical"></td>
        <td class="">({{$diagnosis->lokasi->nama}}) {{$diagnosis->icd10->code_icd}} - {{$diagnosis->icd10->long_desc}}</td>
    </tr>
    @endif
    @php($row++)
    @endforeach

    @foreach($case->tindakan_icd9 as $i => $tindakan)
    @if($row == -1)
    <tr>
        <td class="">PEMERIKSAAN/<br>TINDAKAN LAIN</td>
        <td class="">{{$case->mrs_at ?? $case->created_at}}</td>
        <td class="">({{$tindakan->lokasi->nama}}) {{$tindakan->icd9->code_icd}} - {{$tindakan->icd9->long_desc}}</td>
    </tr>
    @else
    <tr>
        <td class="no-right borderless-vertical"></td>
        <td class="no-left borderless-vertical"></td>
        <td class="">({{$tindakan->lokasi->nama}}) {{$tindakan->icd9->code_icd}} - {{$tindakan->icd9->long_desc}}</td>
    </tr>
    @endif
    @php($row++)
    @endforeach
    @php($arrCppt)
    @if(isset($case->cpptAll))
        @foreach($case->cpptAll as $i => $cppt)
            @if(isset($arrCppt[$cppt->plan]) || $cppt->plan == '-' || $cppt->plan == '')
                @continue
            @else
                @php($arrCppt[$cppt->plan] = 1)
            @endif
            @if($row == -1)
                <tr>
                    <td class="">PEMERIKSAAN/<br>TINDAKAN LAIN</td>
                    <td class="">{{$case->mrs_at ?? $case->created_at}}</td>
                    <td class="">{{$cppt->plan}}</td>
                </tr>
            @else
                <tr>
                    <td class="no-right borderless-vertical"></td>
                    <td class="no-left borderless-vertical"></td>
                    <td class="">{{$cppt->plan}}</td>
                </tr>
            @endif
            @php($row++)
        @endforeach
    @endif
    @if($row == -1)
    <tr>
        <td>PEMERIKSAAN/<br>TINDAKAN LAIN</td>
        <td>{{$case->mrs_at ?? $case->created_at}}</td>
        <td class="borderless-vertical"></td>
    </tr>
    @php($row++)
    @endif
   <tr>
        <th colspan="3" style="text-align: center;">VERIFIKATOR</th>
    </tr>
    <tr>
        <td colspan="3" class="dummy">&nbsp;</td>
    </tr>
</table>
<br>
<table class="borderless" width="100%">
    <tr>
        <td class="text-center" width="40%">Dokter yang merawat,</td>
        <td width="20%"></td>
        <td class="text-center" width="40%">Penerima Pelayan</td>
    </tr>
    <tr>
        <td class="text-center">
            @if(isset($case->admin->user->ttd))
            <img src="{{url('')}}/{{$case->admin->user->ttd}}" style="max-width: 90px;">
            @endif
        </td>
        <td colspan="2" style="font-size: 30px; color: white">.</td>
    </tr>
    <tr>
        <td class="text-center">
            @if(isset($case->admin->user->ttd))
            {{$case->admin->user->name}}
            @else
            .....................................
            @endif
        </td>
        <td></td>
        <td class="text-center">.....................................</td>
    </tr>
</table>

@if(!$loop->last)
<div style="page-break-after: always;"></div>
@endif
@endforeach