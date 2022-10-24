@foreach($histori as $i => $r)
<tr>
    <td>{{$r->kasus->pasien->no_rm}}</td>
    <td>{{$r->kasus->pasien->name}}</td>
    <td>{{$r->kasus->pasien->jenis_kelamin}}</td>
    <td>{{$r->kasus->pasien->age}} Tahun</td>
    <td>{{$r->kasus->lokasi->lokasi->nama}}</td>
    <td>{{$r->createdAtFormatted()}}</td>
    <td>
        <a type="btn" class="btn btn-sm btn-primary" href="{{url('kasus/'.$r->kasus->nomor_kasus)}}">
            <i class="fa fa-search"></i> Lihat Kasus
        </a>
    </td>
</tr>
@endforeach