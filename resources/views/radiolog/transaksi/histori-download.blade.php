<table>
    <thead>
        <tr>
            <th colspan="3">{{indonesian_date($tgl_start)}}</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>No</th>
            <th>RM</th>
            <th>Pasien</th>
            <th>Jenis Permintaan</th>
            <th>Jenis Pasien</th>
            <th>Lokasi</th>
            <th>SEP/ Bulan</th>
            <th>Layanan</th>
            <th>Permintaan Oleh</th>
        </tr>
    </thead>
    <tbody>
        @php $iter = 1 @endphp
        @foreach($invoices as $trans)
            @foreach($trans->detail as $row)  
                @if(!is_null($trans->no_sep))
                @php    $no_sep = $trans->no_sep @endphp
                @elseif(!empty($trans->kasus->active_sep->no_sep))
                @php $no_sep = $trans->kasus->active_sep->no_sep @endphp
                @else
                @php $no_sep = '-' @endphp
                @endif

                @if(!empty($trans->kasus->active_sep->created_at))
                @php $bulan_sep = date('M', strtotime($trans->kasus->active_sep->created_at)) @endphp
                @else
                @php $bulan_sep = '-' @endphp
                @endif
                <tr>
                    <td>{{ $iter++ }}</td>
                    <td>{{ $trans->pasien->no_rm }}</td>
                    <td>{{ $trans->pasien->name }}</td>
                    <td>{{ $trans->tarif_tipe->nama ?? '-'}}</td>
                    <td>{{ $trans->pembayaran['perusahaan']['tipe']['nama'] ?? '-'}}</td>
                    <td>{{ substr($trans->asal->nama ?? '-' ,0,20)}}</td>
                    <td>
                        @if(strlen($no_sep) < 4) 
                        {{$no_sep}} 
                        @else 
                        {{substr($no_sep, strlen($no_sep)-4, strlen($no_sep))}}
                        @endif
                        /{{$bulan_sep}}
                    </td>
                    <td>
                        {{$row->tarif->deskripsi ?? '-'}}
                    </td>
                    <td>
                        {{$trans->creator->name ?? '-'}}
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>