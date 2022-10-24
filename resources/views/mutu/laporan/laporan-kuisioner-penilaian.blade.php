<table>
    <tr>
        <td colspan="7">LAPORAN HASIL PENILAIAN</td>
    </tr>
    <tr>
        <td colspan="7">{{$title}}</td>
    </tr>
    <tr>
        <td colspan="7"></td>
    </tr>
    <tr>
        <td rowspan="2">No</td>
        <td rowspan="2">Nama Bagian</td>
        <td colspan="4">Penilaian</td>
        <td rowspan="2">Hasil Penilaian</td>
    </tr>
    <tr>
        <td>Jumlah Pertanyaan</td>
        <td>Negatif</td>
        <td>Netral</td>
        <td>Positif</td>
    </tr>
    @php
    $pertanyaan = 0;
    $nilai = 0;
    @endphp
    @forelse($data as $key => $item)
    @if ($key == 'persentase' || $key == 'total_respon' || $key == 'kuisioner_publik' || $key == 'jawaban_sent') @php continue; @endphp @endif
    @php
    $pertanyaan += $item['num_pertanyaan'];
    $nilai += $item['nilai'];
    @endphp
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$key}}</td>
        <td>{{$item['num_pertanyaan']}}</td>
        <td>{{$item['negatif']}}</td>
        <td>{{$item['netral']}}</td>
        <td>{{$item['positif']}}</td>
        @php
        $total_respon_bagian = $item['num_pertanyaan'] * $data['total_respon'];
        @endphp
        <td>{{$item['nilai'] > 0 ? round(($item['nilai'] / $total_respon_bagian) * 100) : 0}} %</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2"><b>Data Pertanyaan</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
        @forelse ($item['data_pertanyaan'] as $value)
        <tr>
            <td></td>
            <td colspan="2">{{$value['pertanyaan_text']}}</td>
            <td>{{$value['negatif']}}</td>
            <td>{{$value['netral']}}</td>
            <td>{{$value['positif']}}</td>
            <td>{{$value['persentase']}} %</td>
        </tr>
        @empty

        @endforelse
    @empty
    <tr>
        <td colspan="7" rowspan="2">Data Tidak Ditemukan</td>
    </tr>
    @endforelse
    @if ($pertanyaan > 0)
    <tr>
        <td colspan="2">Hasil Kuisioner Total</td>
        <td>{{$pertanyaan}}</td>
        <td colspan="3"></td>
        @php
        $total_respon = $pertanyaan * $data['total_respon'];
        @endphp
        <td>{{$nilai > 0 ? round(($nilai / $total_respon) * 100) : 0}} %</td>
    </tr>
    <tr>
        <td colspan="2">Jumlah Respon</td>
        <td colspan="4"></td>
        <td>
            @if ($data['kuisioner_publik'])
            {{$data['total_respon']}} Respon / {{$data['jawaban_sent'] ?? '0'}} Kuisioner            
            @else
            {{$data['total_respon']}} Respon
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">Persentase Respon</td>
        <td colspan="4"></td>
        <td>{{$data['persentase']}} %</td>
    </tr>
    @endif
</table>