@foreach($transaksi->retur as $index => $resep)
<div class="modal" id="modal-edit-retur-{{$index}}" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/transaksi/edit-retur')}}">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$transaksi->id}}">
            <input type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">
            <input type="hidden" name="resep_id" value="{{$resep->id}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Retur Barang</h3>
                    </div>
                    <div class="block-content">
                        <div class="col-12">
                            <table class="table table-vcenter">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Kadaluarsa</th>
                                    <th>Harga</th>
                                    <th>Potongan (%)</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $r=0;
                                    $subtotal_retur = 0;
                                @endphp
                                @foreach($resep->resep_detail as $detail)
                                    @foreach($detail->log as $log)
                                        @if(!is_null($log->jumlah_retur))
                                            @php $subtotal_retur += $log->subtotal_retur @endphp
                                <tr>
                                    <td>
                                        {{++$r}}
                                        <h5 id="harga-jual-{{$r}}" hidden>{{$detail->harga}}</h5>
                                        <input type="hidden" name="detail[]" value="{{$detail->id}}">
                                        <input type="hidden" name="log[]" value="{{$log->id}}">
                                        <input type="hidden" name="old_subtotal[]" value="{{$log->subtotal_retur}}">
                                        <input type="hidden" name="old_jumlah[]" value="{{$log->jumlah_retur}}">
                                    </td>
                                    <td>{{$detail->nama_obat}}</td>
                                    <td>
                                        <input type="number" name="jumlah[]" class="form-control input-diskon input-jumlah-retur d-none" value="{{$log->jumlah_retur}}" max="{{$log->jumlah_retur + $max[$r]}}" id="jumlah-edit-retur-{{$r}}" onchange="changeEditRetur({{$index}})">
                                        <a href="javascript:void(0)" class="no-border editable editable-click">{{$log->jumlah_retur}} {{ $detail->satuan }}</a>
                                        <input type="hidden" class="satuan" value="{{ $detail->satuan }}">
                                    </td>
                                    <td>{{ date('d F Y', strtotime($log->detail_item->kadaluarsa)) }}</td>
                                    <td>Rp. {{number_format($detail->harga)}}</td>
                                    <td>
                                        <input type="number" class="form-control input-diskon d-none" name="potongan[]" value="0" onchange="changeEditRetur({{$index}})" id="diskon-edit-retur-{{$r}}">
                                        <a href="javascript:void(0)" class="no-border editable editable-click">0 %</a>
                                        <input type="hidden" class="satuan" value="%">
                                    </td>
                                    <td class="text-right" id="subtotal-edit-retur-{{$r}}">Rp. {{number_format($log->subtotal_retur)}}</td>
                                </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                                <tr>
                                    <td colspan="6" class="text-right font-w600">TOTAL KEMBALI :</td>
                                    <td class="text-right" id="total-edit-retur">Rp. {{number_format($subtotal_retur)}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn-simpan-retur btn btn-alt-primary" id="btn-simpan-edit-retur">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach