<table>
    <thead>
        <tr>
            <th colspan="8">LAPORAN ICD10</th>
        </tr>
        <tr>
        </tr>
        <tr>
            <th>NO</th>
            <th>NAMA</th>
            <th>NO RM</th>
            <th>TGL MASUK</th>
            <th>TGL KELUAR</th>
            <th>USIA</th>
            <th>JENIS KELAMIN</th>
            <th>LOKASI</th>
            <th>DIAGNOSIS</th>
        </tr>
        @foreach($trans as $key => $item)
        <tr>
            <th>{{$key+1}}</th>
            <th>{{$item->laporan_transaksi->pasien->name}}</th>
            <th>{{$item->laporan_transaksi->pasien->no_rm}}</th>
            <th>
                @if($item->laporan_transaksi->kasus->tipe_ri)
                    @if(!empty($item->laporan_transaksi->kasus->mrs_at))
                        {{indonesian_date($item->laporan_transaksi->kasus->mrs_at,'d-m-Y')}}
                    @else
                        {{indonesian_date($item->laporan_transaksi->kasus->created_at,'d-m-Y')}}
                    @endif
                @elseif($item->laporan_transaksi->kasus->tipe_rj)
                    @if(!empty($item->laporan_transaksi->waktu_pemeriksaan))
                        {{indonesian_date($item->laporan_transaksi->waktu_pemeriksaan,'d-m-Y')}}
                    @else
                        {{indonesian_date($item->laporan_transaksi->kasus->created_at,'d-m-Y')}}
                    @endif
                @else
                {{indonesian_date($item->laporan_transaksi->kasus->created_at,'d-m-Y')}}
                @endif
            </th>
            <th>
                @if(!empty($item->laporan_transaksi->kasus->krs_at))
                {{indonesian_date($item->laporan_transaksi->kasus->krs_at,'d-m-Y')}}
                @endif
            </th>
            <th>{{$item->laporan_transaksi->usia_masuk_th}}</th>
            <th>{{$item->laporan_transaksi->jenis_kelamin == 1 ? 'L' : 'P'}}</th>
            <th>{{$item->laporan_transaksi->kasus->lokasi->lokasi->nama ?? '-'}}</th>
            <th>
                @if(count($item->laporan_transaksi->diagnosis) > 0)
                @foreach($item->laporan_transaksi->diagnosis as $d)
                    {{$d->icd10->code_icd ?? '-'}}
                    @if(!$loop->last), @endif
                @endforeach
                @endif
            </th>
        </tr>
        @endforeach
    </thead>
</table>
