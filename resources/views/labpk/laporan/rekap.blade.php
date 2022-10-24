<?php $numbering = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q',
'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z']; ?>
<head>
    <style>
    table {
        border-collapse: collapse;
    }

    table, td, th {
        border: 1px solid black;
    }
</style>
</head>
<div class="content" id="toPrint" style="font-family: Arial">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
                <table>
                    <tr>
                        <td style="text-align: center; width: 400px; border: 1px solid white;"> </td>
                        <td style="text-align: center; width: 300px; border: 1px solid white;"> </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border: 1px solid white; color: white">blank</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid white">{{config('app.name')}}</td>
                        <td style="border: 1px solid white"></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid white; text-decoration: underline;">Lab Patologi Klinik</td>
                        <td style="border: 1px solid white">Nomor B/45/IX/{{date("Y")}}/PATKLIN</td>
                    </tr>
                </table>
                <br>
                <div class="text-center" style="text-align: center; text-decoration: underline;"><h4>RINGKASAN REKAPITULASI {{$title}}</h4></div>
                <div style="font-size: 10">(HANK=HANKAM/PURN, ANH=ASKES NON HANKAM, JMK=JAMKESMAS, MADR=BPJS MANDIRI)</div>
                <table class="table-bordered thead-light" style="width: 100%;">
                    <thead>
                        <tr class="bg-primary-light" style="background-color: #6495ED!important">
                            <th rowspan="2" style="width: 20px; font-size: 10; text-align: center;"><b>NO</b></th>
                            <th rowspan="2" style="width: 180px; font-size: 10; text-align: center;"><b>PEMERIKSAAN</b></th>
                            <th colspan="8" style="width: 400px; font-size: 10; text-align: center;"><b>BPJS</b></th>
                            <th rowspan="2" style="width: 50px; font-size: 10; text-align: center;"><b>UMUM</b></th>
                            <th rowspan="2" style="width: 50px; font-size: 10; text-align: center;"><b>JUMLAH</b></th>
                        </tr>
                        <tr class="bg-primary-light" style="background-color: #6495ED!important">
                            <th style="font-size: 10; text-align: center;"><b>AL</b></th>
                            <th style="font-size: 10; text-align: center;"><b>S.AL</b></th>
                            <th style="font-size: 10; text-align: center;"><b>KEL.AL</b></th>
                            <th style="font-size: 10; text-align: center;"><b>NON AL</b></th>
                            <th style="font-size: 10; text-align: center;"><b>HANK</b></th>
                            <th style="font-size: 10; text-align: center;"><b>ANH</b></th>
                            <th style="font-size: 10; text-align: center;"><b>JMK</b></th>
                            <th style="font-size: 10; text-align: center;"><b>MADR</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $counter = 0;
                        ?>
                        @foreach($konten as $key => $subkonten)
                            @if(!is_array($subkonten))
                                <tr class="bg-primary-light">
                                    <td style="font-size: 10; text-align: center;">{{strtoupper($numbering[$counter])}}</td>
                                    <td style="font-size: 10; text-align: center;">{{str_replace('_', ' ', $key)}}</td>
                                    <td style="font-size: 10; text-align: center;">{{$result[$key][AL]}}</td>
                                    <td style="font-size: 10; text-align: center;">{{$result[$key][S_AL]}}</td>
                                    <td style="font-size: 10; text-align: center;">{{$result[$key][KEL_AL]}}</td>
                                    <td style="font-size: 10; text-align: center;">{{$result[$key]['NON_AL']}}</td>
                                    <td style="font-size: 10; text-align: center;">{{$result[$key][HANK]}}</td>
                                    <td style="font-size: 10; text-align: center;">{{$result[$key][ANH]}}</td>
                                    <td style="font-size: 10; text-align: center;">{{$result[$key][JMK]}}</td>
                                    <td style="font-size: 10; text-align: center;">{{$result[$key][MADR]}}</td>
                                    <td style="font-size: 10; text-align: center;">{{$result[$key][UMUM]}}</td>
                                    <td style="font-size: 10; text-align: center;">{{$result[$key]['JUMLAH']}}</td>
                                </tr>
                            @else
                                <tr class="bg-primary-light">
                                    <td style="font-size: 10; text-align: center;"><b>{{strtoupper($numbering[$counter])}}</b></td>
                                    <td style="font-size: 10; text-align: center;"><b>{{str_replace('_', ' ', $key)}}</b></td>
                                    <td style="font-size: 10; text-align: center;"><b></b></td>
                                    <td style="font-size: 10; text-align: center;"><b></b></td>
                                    <td style="font-size: 10; text-align: center;"><b></b></td>
                                    <td style="font-size: 10; text-align: center;"><b></b></td>
                                    <td style="font-size: 10; text-align: center;"><b></b></td>
                                    <td style="font-size: 10; text-align: center;"><b></b></td>
                                    <td style="font-size: 10; text-align: center;"><b></b></td>
                                    <td style="font-size: 10; text-align: center;"><b></b></td>
                                    <td style="font-size: 10; text-align: center;"><b></b></td>
                                    <td style="font-size: 10; text-align: center;"><b></b></td>
                                </tr>
                                @foreach($subkonten as $i => $detail)
                                    <tr class="bg-primary-light">
                                        <td style="font-size: 10; text-align: center;"><b>{{$i+1}}</b></td>
                                        <td style="font-size: 10; text-align: center;"><b>{{$detail->header}}</b></td>
                                        <td style="font-size: 10; text-align: center;"><b></b></td>
                                        <td style="font-size: 10; text-align: center;"><b></b></td>
                                        <td style="font-size: 10; text-align: center;"><b></b></td>
                                        <td style="font-size: 10; text-align: center;"><b></b></td>
                                        <td style="font-size: 10; text-align: center;"><b></b></td>
                                        <td style="font-size: 10; text-align: center;"><b></b></td>
                                        <td style="font-size: 10; text-align: center;"><b></b></td>
                                        <td style="font-size: 10; text-align: center;"><b></b></td>
                                        <td style="font-size: 10; text-align: center;"><b></b></td>
                                        <td style="font-size: 10; text-align: center;"><b></b></td>
                                    </tr>
                                    @foreach($detail->detail as $index => $d)
                                        <tr class="bg-primary-light">
                                            <td style="font-size: 10; text-align: center;">{{$numbering[$index] ?? $numbering[($index%26)].'.'.(string)($index%26)}}</td>
                                            <td style="font-size: 10; text-align: center;">{{$d->nama}}</td>
                                            <td style="font-size: 10; text-align: center;">{{$result[$d->id][AL]}}</td>
                                            <td style="font-size: 10; text-align: center;">{{$result[$d->id][S_AL]}}</td>
                                            <td style="font-size: 10; text-align: center;">{{$result[$d->id][KEL_AL]}}</td>
                                            <td style="font-size: 10; text-align: center;">{{$result[$d->id]['NON_AL']}}</td>
                                            <td style="font-size: 10; text-align: center;">{{$result[$d->id][HANK]}}</td>
                                            <td style="font-size: 10; text-align: center;">{{$result[$d->id][ANH]}}</td>
                                            <td style="font-size: 10; text-align: center;">{{$result[$d->id][JMK]}}</td>
                                            <td style="font-size: 10; text-align: center;">{{$result[$d->id][MADR]}}</td>
                                            <td style="font-size: 10; text-align: center;">{{$result[$d->id][UMUM]}}</td>
                                            <td style="font-size: 10; text-align: center;">{{$result[$d->id]['JUMLAH']}}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="bg-primary-light">
                                        <td style="font-size: 10; text-align: center;"><b></b></td>
                                        <td style="font-size: 10; text-align: center;"><b>JUMLAH</b></td>
                                        <td style="font-size: 10; text-align: center;"><b>{{$perusahaan[$key][$detail->header][AL]}}</b></td>
                                        <td style="font-size: 10; text-align: center;"><b>{{$perusahaan[$key][$detail->header][S_AL]}}</b></td>
                                        <td style="font-size: 10; text-align: center;"><b>{{$perusahaan[$key][$detail->header][KEL_AL]}}</b></td>
                                        <td style="font-size: 10; text-align: center;"><b>{{$perusahaan[$key][$detail->header]['NON_AL']}}</b></td>
                                        <td style="font-size: 10; text-align: center;"><b>{{$perusahaan[$key][$detail->header][HANK]}}</b></td>
                                        <td style="font-size: 10; text-align: center;"><b>{{$perusahaan[$key][$detail->header][ANH]}}</b></td>
                                        <td style="font-size: 10; text-align: center;"><b>{{$perusahaan[$key][$detail->header][JMK]}}</b></td>
                                        <td style="font-size: 10; text-align: center;"><b>{{$perusahaan[$key][$detail->header][MADR]}}</b></td>
                                        <td style="font-size: 10; text-align: center;"><b>{{$perusahaan[$key][$detail->header][UMUM]}}</b></td>
                                        <td style="font-size: 10; text-align: center;"><b>{{$perusahaan[$key][$detail->header]['JUMLAH']}}</b></td>
                                    </tr>
                                @endforeach
                                <tr style="text-align: center;">
                                <td style="font-size: 10; color: white">blank</td>
                                <td style="font-size: 10; text-align: left"></td>
                                <td style="font-size: 10"></td>
                                <td style="font-size: 10"></td>
                                <td style="font-size: 10"></td>
                                <td style="font-size: 10"></td>
                                <td style="font-size: 10"></td>
                                <td style="font-size: 10"></td>
                                <td style="font-size: 10"></td>
                                <td style="font-size: 10"></td>
                                <td style="font-size: 10"></td>
                                <td style="font-size: 10"></td>
                            </tr>
                            @endif
                            <?php $counter++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('labpk.laporan.ringkasan-rekap')
    @include('labpk.laporan.signature-rekap')