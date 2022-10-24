<div class="modal fade" id="modal-data-gagal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-xl" role="document">
        <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title" id="title-modal">Data Gagal Import</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content" style="padding-left: 25px; padding-right: 25px; ; overflow-x: scroll; overflow-y: scroll;">
                        <table class="table table-vcenter">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Katerangan</th>
                                <th>Akun Rekening</th>
                                <th>Barang</th>
                                <th>Kegiatan</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Link</th>
                                <th>Spesifikasi</th>
                                <th>Justifikasi</th>
                                <th>Harga Satuan</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=0;
                            @endphp
                            @foreach($usulan->detail_gagal as $row)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$row->keterangan}}</td>
                                    <td>{{$row->akun_rekening_nama}}</td>
                                    <td>{{$row->barang_nama}}</td>
                                    <td>{{$row->kegiatan}}</td>
                                    <td>{{$row->jumlah}}</td>
                                    <td>{{$row->satuan}}</td>
                                    <td>
                                        @if(!is_null($row->link)) <a href="javascript:void(0)" onclick="popupwindow('{{$row->link}}')" class="text-primary">#Link Produk 1</a><br> @endif
                                        @if(!is_null($row->link2)) <a href="javascript:void(0)" onclick="popupwindow('{{$row->link2}}')" class="text-primary">#Link Produk 2</a><br> @endif
                                        @if(!is_null($row->link3)) <a href="javascript:void(0)" onclick="popupwindow('{{$row->link3}}')" class="text-primary">#Link Produk 3</a><br> @endif
                                    </td>
                                    <td>{{$row->spesifikasi}}</td>
                                    <td>{{$row->justifikasi}}</td>
                                    <td>Rp. {{number_format($row->harga,2)}}</td>
                                    <td>Rp. {{number_format($row->harga * $row->jumlah,2)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>