{{-- <div class="block d-none">
        <div class="block-header block-header-default">
            <h3 class="block-title">Transaksi Obat</h3>
        </div>
        <div class="block-content" style="overflow-x: auto;">
            <table class="table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pasien</th>
                        <th>No Resep</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <!-- <th>Total Biaya</th> -->
                        <th>Detail</th>
                        <th>Print</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                	@foreach($unconfirmed as $row)
                	<tr data-href="{{url('farmasi/'.session('farmasi')->slug.'/transaksi/'.$row->slug)}}">
                		<td>{{$i++}}</td>
                		<td>{{$row->pasien_detail ? $row->pasien_detail->name : "-"}}</td>
                        <td>{{$row->final_detail->nomor_resep ? $row->final_detail->nomor_resep : "-"}}</td>
                		<td>{{date('d F Y, H:i', strtotime($row->created_at))}}</td>
                		<td>
                            <span class="p-2 badge badge-primary">Menunggu</span>
                        </td>
                        <td>
                            <a href="{{url('farmasi/'.session('farmasi')->slug.'/transaksi/'.$row->slug)}}" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>
                        </td>
                        <td>
                            <a href="{{url('farmasi/'.session('farmasi')->slug.'/resep/print/'.$row->slug)}}" class="btn btn-alt-primary btn-square btn-print-resep" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                        </td>
                	</tr>
                	@endforeach
                </tbody>
            </table>
        </div>
    </div> --}}

    <div class="row row-deck">
        <div class="col-xl-12">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-center">Statistik Transaksi Obat</h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="js-flot-lines" style="height: 340px;"></div>
                </div>
            </div>
        </div>
    </div>