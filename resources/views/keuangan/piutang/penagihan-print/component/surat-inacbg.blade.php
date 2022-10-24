@php $page=1; @endphp
<table>
    <tr>
        <td><img src="{{url('assets/img')}}/kemenkes.png" height="50" style="float: left;margin-right: 5px">
        </td>
        <td>
            <h4>KEMENTRIAN KESEHATAN REPUBLIK INDONESIA</h4>
            <h5><i>Berkas Klaim Individual Pasien</i></h5>
        </td>
    </tr>
</table>
<hr style="height:2px;border:none;color:#333;background-color:#333;">
<table width="100%" style="font-size: 11px;">
    <tr>
        <th width="20%"></th>
        <th width="30%"></th>
        <th width="15%"></th>
        <th width="35%"></th>
    </tr>
    <tr>
        <td>Kode Rumah Sakit</td>
        <td>: 3578020</td>
        <td>Kelas Rumah Sakit</td>
        <td>: A</td>
    </tr>
    <tr>
        <td>Nama RS</td>
        <td>: {{$rs}}</td>
        <td>Jenis Tarif</td>
        <td>: TARIF RS KELAS A PEMERINTAH</td>
    </tr>
</table>
<hr>
<table width="100%" style="font-size: 11px;">
    <tr>
        <td width="20%">Nomor Peserta</td>
        <td width="30%">: {{$kasus->active_sep->no_bpjs ?? '-'}}</td>
        <td width="15%">Nomor SEP</td>
        <td width="35%">: {{$kasus->active_sep->no_sep ?? '-'}}</td>
    </tr>
    <tr>
        <td>Nomor Rekam Medis</td>
        <td>: {{$kasus->pasien->no_rm}}</td>
        <td>Tanggal Masuk</td>
        <td>: {{is_null($kasus->mrs_at) ? $kasus->created_at->format('d/m/Y') : $kasus->mrs_at->format('d/m/Y')}}</td>
    </tr>
    <tr>
        <td>Umur Tahun</td>
        <td>: {{$kasus->pasien->age}}</td>
        <td>Tanggal Keluar</td>
        <td>: {{is_null($kasus->krs_at) ? date('d/m/Y') : $kasus->krs_at->format('d/m/Y')}}</td>
    </tr>
    <tr>
        <td>Umur Hari</td>
        <td>: {{$kasus->pasien->age_day}}</td>
        <td>Jenis Perawatan</td>
        <td>: {{$kasus->lokasi->lokasi->lokasi_departemen_id == config('const.rawat_inap') ? "1 Rawat Inap" : "2 Rawat Jalan"}}</td>
    </tr>
    <tr>
        <td>Tanggal Lahir</td>
        <td>: {{date('d/m/Y', strtotime($kasus->pasien->date_of_birth))}}</td>
        <td>Cara Pulang</td>
        <td>: {{$kasus->krs_alasan}}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>: {{$kasus->pasien->gender}} - {{$kasus->pasien->jenis_kelamin}}</td>
        <td>LOS</td>
        <td>: @if(is_null($kasus->krs_at))
            {{\Carbon\Carbon::now()->diffInDays($kasus->created_at)}}
            @else
            {{$kasus->krs_at->diffInDays($kasus->created_at)}}
        @endif Hari</td>
    </tr>
    <tr>
        <td>Kelas Perawatan</td>
        <td>: Kelas {{$kasus->pembayaran->kelas->nama}}</td>
        <td>Berat Lahir</td>
        <td>: </td>
    </tr>
</table>
<hr>
<br>
<table width="100%" style="font-size: 11px;">
    <tr>
        <th width="20%"></th>
        <th width="5%"></th>
        <th width="10%"></th>    
        <th width="65%"></th>
    </tr>
    @if(!is_null($kasus->diagnosisUtamaBpjs))
        <tr>
            <td>Diagnosis Utama </td>
            <td>:</td>
            <td>{{$kasus->diagnosisUtamaBpjs->icd10->code_icd}}</td>
            <td>{{$kasus->diagnosisUtamaBpjs->icd10->long_desc}}</td>
        </tr>
    @endif
    @if(count($kasus->diagnosisTambahanBpjs) > 0)
        <tr>
            <td rowspan="{{count($kasus->diagnosisTambahanBpjs)}}">Diagnosis Sekunder </td>
            <td rowspan="{{count($kasus->diagnosisTambahanBpjs)}}">:</td>
            <td>{{$kasus->diagnosisTambahanBpjs[0]->icd10->code_icd}}</td>
            <td>{{$kasus->diagnosisTambahanBpjs[0]->icd10->long_desc}}</td>
        </tr>
        @foreach($kasus->diagnosisTambahanBpjs as $i => $d)
        @if($i == 0)
        @continue
        @endif
        <tr>
            <td>{{$d->icd10->code_icd}}</td>
            <td>{{$d->icd10->long_desc}}</td>
        </tr>
        @endforeach
    @endif
    @if(count($kasus->tindakan_icd9_bpjs) > 0)
        <tr>
            <td rowspan="{{count($kasus->tindakan_icd9_bpjs)}}">Prosedur</td>
            <td rowspan="{{count($kasus->tindakan_icd9_bpjs)}}">:</td>
            <td>{{$kasus->tindakan_icd9_bpjs[0]->icd9->code_icd}}</td>
            <td>{{$kasus->tindakan_icd9_bpjs[0]->icd9->long_desc}}</td>
        </tr>
        @foreach($kasus->tindakan_icd9_bpjs as $i => $d)
        @if($i == 0)
        @continue
        @endif
        <tr>
            <td>{{$d->icd9->code_icd}}</td>
            <td>{{$d->icd9->long_desc}}</td>
        </tr>
        @endforeach
    @endif

</table>
<table width="100%" style="font-size: 11px;">
    <tr>
        <th width="15%"></th> 
        <th width="5%"></th> 
        <th width="30%"></th>
        <th width="15%"></th> 
        <th width="5%"></th> 
        <th width="30%"></th>
    </tr>
    <tr>
        <td>ADL Sub Acute</td>
        <td>: </td>
        <td>-</td>
        <td>ADL Sub Chronic</td>
        <td>: </td>
        <td>-</td>
    </tr>
</table>
<br><br>
<table>
    <tr>
        <td><b>Hasil Grouping</b></td>
    </tr>
</table>
<?php $payload = json_decode($kasus->inacbg_latest->payload); $total = 0;
$cmg = $payload->response->special_cmg ?? null;?>
<hr class="line-dashed">
<table width="100%" style="font-size: 11px;">
    <tr>
        <th width="16%"></th>
        <th width="3%"></th>
        <th width="14%"></th>
        <th width="45%"></th>
        <th width="22%"></th>        
    </tr>
    @if(isset($payload->response->cbg->tariff))
        <tr>
            <td>INA-CBG</td>
            <td>:</td>
            <td>{{$payload->response->cbg->code}}</td>
            <td>{{$payload->response->cbg->description}}</td>
            <td>Rp {{number_format($payload->response->cbg->tariff)}}</td>
            <?php $total += $payload->response->cbg->tariff; ?>
        </tr>
    @endif
    <tr>
        <td>Sub Acute</td>
        <td>:</td>
        <td>-</td>
        <td>-</td>
        <td>Rp {{number_format(0)}}</td>
    </tr>
    <tr>
        <td>Chronic</td>
        <td>:</td>
        <td>-</td>
        <td>-</td>
        <td>Rp {{number_format(0)}}</td>
    </tr>
    @if(is_null($cmg))
        <tr>
            <td>Special CMG</td>
            <td>:</td>
            <td>-</td>
            <td>-</td>
            <td>Rp {{number_format(0)}}</td>
        </tr>
    @else
        <tr>
            <td rowspan="{{count($cmg)}}">Special CMG</td>
            <td rowspan="{{count($cmg)}}">:</td>
            <td>{{$cmg[0]->code}}</td>
            <td>{{$cmg[0]->description}}</td>
            <td>Rp {{number_format($cmg[0]->tariff)}}</td>
        </tr>
        <?php $total += $cmg[0]->tariff; ?>
        @foreach($cmg as $i => $val)
        @if($i == 0)
        @continue
        @endif
        <tr>
            <td>{{$val->code}}</td>
            <td>{{$val->description}}</td>
            <td>Rp {{number_format($val->tariff)}}</td>
        </tr>
        <?php $total += $val->tariff; ?>
        @endforeach
    @endif
</table>
<hr class="line-dashed">
<table width="100%" style="font-size: 11px;">
    <tr>
        <th width="16%"></th>
        <th width="3%"></th>
        <th width="14%"></th>
        <th width="45%"></th>
        <th width="22%"></th>        
    </tr>
    <tr>
        <td>Total Tarif</td>
        <td>:</td>
        <td></td>
        <td></td>
        <td>Rp {{number_format($total)}}</td>
    </tr>
</table>
@php $page++ @endphp