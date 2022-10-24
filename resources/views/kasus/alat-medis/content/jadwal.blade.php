<div class="block-content ">
    <div class="row">
        <div class="col-12" style="overflow-x: scroll;">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center">NO PERMINTAAN</th>
                        <th class="d-none d-sm-table-cell">TANGGAL</th>
                        <th class="d-none d-sm-table-cell">KAMAR OK</th>
                        <th class="d-none d-sm-table-cell">RONDE</th>
                        <th class="d-none d-sm-table-cell">DOKTER</th>
                        <th class="d-none d-sm-table-cell">DIAGNOSIS</th>
                        <th class="d-none d-sm-table-cell">JENIS SPESIALIS</th>
                        <th class="d-none d-sm-table-cell">STATUS</th>
                        <th class="d-none d-sm-table-cell">DIJADWALKAN OLEH</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permintaan as $key => $item)
                    @if(!empty($item->transaksi->jadwal_operasi) && empty($item->transaksi->deleted_at))
                    <tr>
                        <td>#{{$item->transaksi->id}}</td>
                        <td>{{$item->transaksi->jadwal_operasi->format('d F Y')}}</td>
                        <td>{{$item->transaksi->ruangan->name}}</td>
                        <td>{{$item->transaksi->nomor_ronde}}</td>
                        <td>{{$item->transaksi->dokter->name}}</td>
                        <td>{{$item->transaksi->diagnosis}}</td>
                        <td>{{!empty($item->transaksi->jenis_spesialis->nama) ? $item->transaksi->jenis_spesialis->nama : '-'}}</td>
                        <td>
                            @if($item->transaksi->status == 1)
                            <span class="badge badge-success">Terlaksana</span>
                            @else
                            <span class="badge badge-info">Perencanaan</span>
                            @endif
                        </td>
                        <td>{{!empty($item->transaksi->dijadwalkan_oleh) ? $item->transaksi->pembuat_jadwal->name : '-'}}</td>
                        <td>
                            <button type="button" class="btn btn-secondary dropdown-toggle" id="toolbarDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>
                            <div class="dropdown-menu" aria-labelledby="toolbarDrop">
                                <a href="{{url('kamaroperasi/pelaksanaan')}}/{{$item->transaksi->id}}" class="btn btn-primary dropdown-item">Detail</a>
                                <a href="{{url('kamaroperasi/pendaftaran')}}/{{$item->transaksi->id}}" class="btn btn-warning dropdown-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ubah Jadwal">
                                    Ubah Jadwal
                                </a>
                            </div>
                        </td>
                    </tr>
                    @else
                    @endif
                    @empty
                    <tr>
                        <td colspan="10">
                            <p>Belum ada jadwal operasi</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>