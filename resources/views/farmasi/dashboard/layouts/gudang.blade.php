<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Permintaan Distribusi Obat</h3>
    </div>
    <div class="block-content">
        <table class="table table-hover table-vcenter">
            <thead>
                <tr>
                    <th width="30px">ID</th>
                    <th width="100px">Unit Tujuan</th>
                    <th width="80px">Kategori</th>
                    <th width="160px">Waktu</th>
                    <th width="110px">Status</th>
                    <th width="150px">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @forelse($unconfirmed as $row)
                <tr class="clickable-row" data-href="{{url('farmasi/'.session('farmasi')->slug.'/distribusi/'.$row->slug)}}">
                    <td>{{$i++}}</td>
                    <td>{{$row->detail_tujuan->nama}}</td>
                    <td>{{$row->kategori}}</td>
                    <td>{{date('d F Y, H:i', strtotime($row->created_at))}}</td>
                    <td>
                        @if($row->status == 0)
                            <span class="p-2 badge badge-info">Konfirmasi</span>
                        @else
                            <span class="p-2 badge badge-success">Selesai</span>
                        @endif
                    </td>
                    <td>{{$row->deskripsi}}</td>
                </tr>
                @empty Tidak ada permintaan yang belum dikonfirmasi
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="row row-deck">
    <div class="col-xl-8">
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><center>Statistik Permintaan</center></h3>
            </div>
            <div class="block-content block-content-full">
                <div class="js-flot-lines" style="height: 340px;"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><center>Persebaran Permintaan</center></h3>
            </div>
            <div class="block-content block-content-full">
                <div class="js-flot-pie4" style="height: 250px;"></div>
            </div>
        </div>
    </div>
</div>