
<div class="modal" id="modal-resep" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Resep Original {{$transaksi->ori_detail->nomor_resep}}</h3>
                </div>
                <div class="block-content">
                    <div class="col-12">
                        <table class="table table-vcenter">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $j=1; $total=0 @endphp
                                @foreach($transaksi->final_detail->resep_detail as $detail)
                                @if(is_null($detail->obat_detail))
                                <tr>
                                    <td>{{$j++}}</td>
                                    <td>{{$detail->nama_obat}} <br> @if(!$detail->tipe)(Obat Tidak Tersedia di Farmasi Ini)@endif</td>
                                    <td>{{$detail->jumlah}} {{ $detail->satuan }}</td>
                                </tr>
                                @else
                                <tr>
                                    <td>{{$j++}}</td>
                                    <td>{{$detail->nama_obat}}</td>
                                    <td>{{$detail->jumlah}} {{ $detail->satuan }} </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>