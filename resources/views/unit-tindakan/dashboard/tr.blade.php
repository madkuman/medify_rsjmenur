@forelse($tindakan->transaksi as $i => $r)
<tr>
    @if(!is_null($r->kasus))
        <td>{{$r->kasus->pasien->no_rm}}</td>
        <td>{{$r->kasus->pasien->name}}</td>
        <td>{{date('d F Y', strtotime($r->created_at))}}</td>
        <td>{{$r->kasus->pasien->age}} Tahun</td>
        <td>{{$r->kasus->lokasi->lokasi->nama}}</td>
        <td>{{$r->keterangan}}</td>
        <td>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" id="btnGroupDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Input Data</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a type="btn" class="dropdown-item"  href="javascript:void(0)" 
                        onclick="periksa({{$r->kasus_id}}, {{$r->id}}, this)" 
                        data-tarif_kelas="{{$r->kasus->kelas->id ?? '0'}}">
                        <i class="fa fa-medkit"></i> Tindakan
                    </a>
                    <a type="btn" class="dropdown-item"  href="javascript:void(0)" 
                    onclick="modalResep('{{$r->kasus->nomor_kasus}}', '{{$r->kasus->pasien_id}}', '{{$r->kasus->pembayaran->id}}', '{{$r->unit_tindakan->lokasi_id}}', this)">
                        <i class="fa fa-pills"></i> Resep
                    </a>
                </div>
            </div>

            <a type="btn" class="btn btn-sm btn-secondary" style="width: 100px; margin-bottom: 4px;" href="{{url('kasus/'.$r->kasus->nomor_kasus)}}">
                <i class="fa fa-search"></i> Lihat Kasus
            </a>
            <a type="btn" class="btn btn-sm btn-success" style="width: 100px; margin-bottom: 4px;" href="javascript:void(0)" onclick="selesai({{$r->id}})">
                <i class="fa fa-check"></i> Selesai
            </a>
        </td>
    @else
        <td>{{$r->pasien->no_rm}}</td>
        <td>{{$r->pasien->name}}</td>
        <td>{{$r->pasien->jenis_kelamin}}</td>
        <td>{{$r->pasien->age}} Tahun</td>
        <td> - </td>
        <td>
            <a type="btn" class="btn btn-sm btn-primary" style="width: 100px; margin-bottom: 4px;" href="{{url('unit-tindakan/'.$tindakan->slug.'/layani/'.$r->id)}}">
                <i class="fa fa-plus"></i> Layani
            </a>
        </td>
    @endif
</tr>
@empty
<tr>
    <td colspan="7">Tidak ada transaksi hari ini</td>
</tr>
@endforelse