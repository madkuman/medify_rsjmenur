    <div style="page-break-after: always;"></div>
    <div class="row">
        <br><br>
        <table>
            <tr>
                <td style="text-align: center; width: 400px; border: 1px solid white;"> </td>
                <td style="text-align: center; width: 300px; border: 1px solid white;"> </td>
            </tr>
            <tr>
                <td style="border: 1px solid white">{{config('app.name')}}</td>
                <td style="border: 1px solid white">Lab Patologi Klinis</td>
            </tr>
            <tr>
                <td style="border: 1px solid white; text-decoration: underline;">Subdep Patologi Klinik</td>
                <td style="border: 1px solid white">Nomor B/45/IX/{{date("Y")}}/PATKLIN</td>
            </tr>
        </table>
        <!-- <br> -->
        <?php $finalTotal = array_fill(0, 10, 0); ?>
        <div class="col-lg-12">
            <div class="text-center" style="text-align: center; text-decoration: underline;"><h4>RINGKASAN REKAPITULASI {{$title}}</h4></div>
            <div style="font-size: 10">(HANK=HANKAM/PURN, ANH=ASKES NON HANKAM, JMK=JAMKESMAS, MADR=BPJS MANDIRI)</div>
            <div class="text-center">
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
                        <tr style="text-align: center;">
                            <td style="font-size: 10"></td>
                            <td style="font-size: 10; text-align: left"><b>PATOLOGI KLINIK</b></td>
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
                        <?php $counter = 0; ?>
                            @foreach($konten as $key => $subkonten)
                            @if(!is_array($subkonten))
                                <tr class="bg-primary-light">
                                    <td style="font-size: 10; text-align: center;"><b>{{strtoupper($numbering[$counter])}}</b></td>
                                    <td style="font-size: 10; text-align: center;"><b>{{str_replace('_', ' ', $key)}}</b></td>
                                    <td style="font-size: 10; text-align: center;"><b>{{$result[$key][AL]}}</b></td>
                                    <td style="font-size: 10; text-align: center;"><b>{{$result[$key][S_AL]}}</b></td>
                                    <td style="font-size: 10; text-align: center;"><b>{{$result[$key][KEL_AL]}}</b></td>
                                    <td style="font-size: 10; text-align: center;"><b>{{$result[$key]['NON_AL']}}</b></td>
                                    <td style="font-size: 10; text-align: center;"><b>{{$result[$key][HANK]}}</b></td>
                                    <td style="font-size: 10; text-align: center;"><b>{{$result[$key][ANH]}}</b></td>
                                    <td style="font-size: 10; text-align: center;"><b>{{$result[$key][JMK]}}</b></td>
                                    <td style="font-size: 10; text-align: center;"><b>{{$result[$key][MADR]}}</b></td>
                                    <td style="font-size: 10; text-align: center;"><b>{{$result[$key][UMUM]}}</b></td>
                                    <td style="font-size: 10; text-align: center;"><b>{{$result[$key]['JUMLAH']}}</b></td>
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
                            @endif
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
                            <?php $counter++; ?>
                        @endforeach
                        <tr class="bg-primary-light">
                            <td style="font-size: 10; text-align: center;"><b></b></td>
                            <td style="font-size: 10; text-align: center;"><b>JUMLAH</b></td>
                            <td style="font-size: 10; text-align: center;"><b>{{$perusahaan_main[AL]}}</b></td>
                            <td style="font-size: 10; text-align: center;"><b>{{$perusahaan_main[S_AL]}}</b></td>
                            <td style="font-size: 10; text-align: center;"><b>{{$perusahaan_main[KEL_AL]}}</b></td>
                            <td style="font-size: 10; text-align: center;"><b>{{$perusahaan_main['NON_AL']}}</b></td>
                            <td style="font-size: 10; text-align: center;"><b>{{$perusahaan_main[HANK]}}</b></td>
                            <td style="font-size: 10; text-align: center;"><b>{{$perusahaan_main[ANH]}}</b></td>
                            <td style="font-size: 10; text-align: center;"><b>{{$perusahaan_main[JMK]}}</b></td>
                            <td style="font-size: 10; text-align: center;"><b>{{$perusahaan_main[MADR]}}</b></td>
                            <td style="font-size: 10; text-align: center;"><b>{{$perusahaan_main[UMUM]}}</b></td>
                            <td style="font-size: 10; text-align: center;"><b>{{$perusahaan_main['JUMLAH']}}</b></td>
                        </tr>
                    </tbody>
                </table>
                <br><br>
            
                </div>
            