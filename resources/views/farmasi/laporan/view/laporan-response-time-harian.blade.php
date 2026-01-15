<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="17">LAPORAN RESPONSE TIME HARIAN</th>
        </tr>
        <tr>
            <th colspan="17">Periode : {{indonesian_date($date_start,'d F Y')}} - {{indonesian_date($date_end,'d F Y')}}</th>
        </tr>
        <tr>
            <th colspan="17">Farmasi : {{$farmasi}}</th>
        </tr>
        <tr>
            <th colspan="17">Asal Pelayanan : {{$lokasi}}</th>
        </tr>
        <tr>
            <th colspan="17">
                Jenis Resep :
                @if($jenis_resep == 'all') Semua
                @elseif($jenis_resep == 'racikan') Racikan
                @elseif($jenis_resep == 'non-racikan') Non Racikan
                @endif
            </th>
        </tr>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>NO</th>
            <th>Dokter</th>
            <th>NAMA PASIEN</th>
            <th>NO RM</th>
            <th>ASAL</th>
            <th>RESEP</th>
            <th>JUMLAH</th>
            <th>SATUAN</th>
            <th>JAM MASUK</th>
            <th>JAM SELESAI</th>
            <th>RESPON TIME</th>
            <th>ANALISA RESEP</th>
            <th>PENERIMAAN</th>
            <th>PENGERJAAN</th>
            <th>PENGEMASAN</th>
            <th>PENYERAHAN</th>
            <th>PENERIMAAN</th>
        </tr>
        @php
            $last_row = 8;
        @endphp
        @foreach($data as $item)
        @php
            $rowspan = $item->final_detail->resep_detail->count();
            if ($rowspan < 1) {
                $rowspan = 1;
            }
            $last_row += $rowspan;
        @endphp
        <tr>
            <td rowspan="{{ $rowspan }}">{{$loop->iteration}}</td>
            <td rowspan="{{ $rowspan }}">{{ empty($item->dokter_nama) ? '-' : $item->dokter_nama}}</td>
            <td rowspan="{{ $rowspan }}">{{$item->pasien_detail->name}}</td>
            <td rowspan="{{ $rowspan }}">{{$item->pasien_detail->no_rm}}</td>
            <td rowspan="{{ $rowspan }}">{{$item->lokasi->nama}}</td>
            <td>
                {{ $item->final_detail->resep_detail->first()->nama_obat }}
            </td>
            <td>
                {{ $item->final_detail->resep_detail->first()->jumlah }}
            </td>
            <td>
                {{ $item->final_detail->resep_detail->first()->satuan }}
            </td>
            <td rowspan="{{ $rowspan }}">{{!empty($item->dikerjakan_at) ? date('H:i',strtotime($item->dikerjakan_at)) : '-'}}</td>
            <td rowspan="{{ $rowspan }}">{{!empty($item->lima_benar_at) ? date('H:i',strtotime($item->lima_benar_at)) : '-'}}</td>
            <td rowspan="{{ $rowspan }}">
                @php
                    $diff = 0;
                    if(!empty($item->dikerjakan_at) && !empty($item->lima_benar_at)){
                        $diff = $item->dikerjakan_at->diffInMinutes($item->lima_benar_at);
                    }
                @endphp
                {{$diff}}
            </td>
            <td rowspan="{{ $rowspan }}">{{ $item->analisa_resep_creator->name ?? "-" }}</td>
            <td rowspan="{{ $rowspan }}">{{ $item->transaksi_obat_telaah_obat_penyiapan->user_telaah->name ?? '' }}</td>
            <td rowspan="{{ $rowspan }}">{{ $item->transaksi_obat_telaah_obat_pengemasan->user_telaah->name ?? '' }}</td>
            <td rowspan="{{ $rowspan }}">{{ $item->transaksi_obat_telaah_obat_penyerahan->user_telaah->name ?? '' }}</td>
            <td rowspan="{{ $rowspan }}"></td> 
            <td rowspan="{{ $rowspan }}">{{ $item->transaksi_obat_telaah_obat_penerimaan_perawat->user_telaah->name ?? '' }}</td>
        </tr>
        @foreach ($item->final_detail->resep_detail as $resep_detail)
            @php
                if ($loop->first) continue;
            @endphp
            <tr>
                <td>{{ $resep_detail->nama_obat }}</td>
                <td>{{ $resep_detail->jumlah }}</td>
                <td>{{ $resep_detail->satuan }}</td>
            </tr>
        @endforeach
        @endforeach
        <tr>
            <th colspan="10">RERATA</th>
            <th>=AVERAGE(K9:K{{$last_row}})</th>
        </tr>
    </tbody>
</table>
