@foreach($data as $each_data)
    <table class="my-50">
        <tr>
            <td class="centered" width="45%">KESEHATAN DAERAH MILITER IV/DIPONEGORO</td>
            
        </tr>
        <tr>
            <td class="border-bot centered">RUMAH SAKIT Tk. II 04.05.01 dr. SOEDJONO</td>
        </tr>
    </table>
    <br>
    <table class="my-50">
        <tr>
            <td class="centered title">Hasil Pemeriksaan Ultrasonografi</td>
        </tr>
    </table>
    <br>
    <table class="my-50">
        <tr>
            <td width="3%">1. </td>
            <td width="30%">Identitas Pasien</td>
            <td>:&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td>a. Nama Pasien</td>
            <td>:&nbsp;{{$each_data->kasus['pasienV1']['name']}}</td>
        </tr>
        <tr>
            <td></td>
            <td>b. Alamat</td>
            <td>:&nbsp;{{$each_data->kasus['pasienV1']['address']}}</td>
        </tr>
        <tr>
            <td></td>
            <td>c. No. RM</td>
            <td>:&nbsp;{{$each_data->kasus['pasienV1']['no_rm']}}</td>
        </tr>
        <tr>
            <td></td>
            <td>d. Ruangan / Poli</td>
            <td>:&nbsp;{{$each_data->kasus['lokasi']['lokasi']['nama']}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td width="3%" valign="top">2. </td>
            <td width="30%" valign="top">Diagnosa Klinik</td>
            <td>:
                @foreach($each_data->kasus->diagnosis as $each_diagnosis)
                    &nbsp;{{$each_diagnosis['icd10']['code_icd']}} - {{$each_diagnosis['icd10']['long_desc']}}<br>
                @endforeach
                @if(count($each_data->kasus->diagnosis) - 8 < 0)
                    @for($i=0; $i < count($each_data->kasus->diagnosis); $i++)
                        &nbsp;<br>
                    @endfor
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @php
            $val = json_decode($each_data->val);
        @endphp
        <tr>
            <td width="3%" valign="top">3. </td>
            <td width="30%" valign="top">Tujuan Pemeriksaan</td>
            <td>:&nbsp;{{$val->tujuan}}</td>
        </tr>
        <tr>
            <td><br><br><br><br><br><br></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td width="3%" valign="top">4. </td>
            <td width="30%" valign="top">Hasil Pemeriksaan</td>
            <td>:&nbsp;{{$val->hasil}}</td>
        </tr>
        <tr>
            <td><br><br><br><br><br><br></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <br>
    <table class="my-50">
        <tr>
            <td width="40%" align="center">Magelang, ........................................</td>
            <td width="20%"></td>
            <td width="40%"></td>
        </tr>
        <tr>
            <td align="center">Dokter yang meminta</td>
            <td></td>
            <td class="centered">Dokter yang memeriksa</td>
        </tr>
        <tr>
            <td><br><br><br><br></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td align="center">............................................</td>
            <td></td>
            <td align="center">............................................</td>
        </tr>

    </table>
    @if(!$loop->last)
        <div style="page-break-after: always;"></div>
    @endif
@endforeach