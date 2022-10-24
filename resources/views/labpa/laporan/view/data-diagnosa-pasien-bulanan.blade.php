<table>
    <thead>
        <tr>
            <th colspan="12">Bulan : {{$bulan}}</th>
        </tr>
        <tr>
            <th>No</th>
            <th>Kode Pasien</th>
            <th>No RM</th>
            <th>Nama</th>
            <th>L/P</th>
            <th>Usia</th>
            <th>Layanan</th>
            <th>Lokasi</th>
            <th>Pemeriksaan</th>
            <th>Diagnosa Klinis</th>
            <th>Diagnosa PA</th>
            <th>Pathologi ST</th>
            <th>Jumlah Slide</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0 ?>
        @foreach($transaksi as $row)
        <?php $i++ ?>
        <tr>
            <td>{{$i}}</td>
            <td>{{ $row->kode_sediaan }}</td>
            <td>{{ $row->transaction->pasien->no_rm }}</td>
            <td>{{ $row->transaction->pasien->name }}</td>
            <td>{{ $row->transaction->pasien->jenis_kelamin }}</td>
            <td>
                <?php
                    $to = new DateTime('today');
                    $from = new DateTime($row->transaction->pasien->date_of_birth);
                    $row->transaction->pasien->age = $from->diff($to)->y;
                        echo $row->transaction->pasien->age;
                ?>
            </td>
            <td>
                @php
                    $layanan = '-';
                    foreach($lokasi_id as $index => $lokasi_item)
                    {
                        if(in_array($row->transaction->lokasi_id,$lokasi_item)){
                            $layanan = config('const.name-'.$index);
                            break;
                        }
                    }
                @endphp
                {{$layanan}}
            </td>

            <td>{{ $row->lokasi }}</td>
            <td>{{ $row->tarif->deskripsi }}</td>
            <td>@if(!is_null($row->result))
                    {{{ strip_tags(json_decode($row->result)->kesimpulan) }}}
                @else
                    -
                @endif</td>
            <td>{{ $row->transaction->diagnosis }}</td>
            <td>{{$row->transaction->pemeriksa->name ?? '-'}}</td>
            <td>{{ $row->slide }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
