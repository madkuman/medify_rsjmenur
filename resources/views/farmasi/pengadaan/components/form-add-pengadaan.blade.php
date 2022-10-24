<tr class="item-row item-wrapper">
                                        <td style="position:sticky; left:0px; background-color: white;">
                                            <div class="form-group">
                                                <h1 id="harga-hid-{{$index}}" hidden></h1>
                                                <select class="js-select2 form-control barang-select" id="barang-select2-{{$index}}" name="barang[]"  style="width: 100%;" data-placeolder="Cari Barang">
                                                    <option value=""></option>
                                                @if(isset($row))
                                                    <option value="{{$row->detail_item->item_farmasi_id}}" selected>{{$row->detail_item->detail_item->item_detail->nama}} ({{$row->detail_item->detail_item->item_detail->satuan}})</option>
                                                @endif
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" class="form-control" id="harga-beli-sebelum-{{$index}}" onchange="changeSubtotal({{$index}})" name="harga_beli_sebelum[]" placeholder="Harga Jual" value="{{$row->detail_item->detail_item->item_detail->harga ?? 0}}" step=".001" readonly="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="jumlah-besar-{{$index}}" onchange="changeSubtotal({{$index}},'jumlah')" name="jumlah_besar[]" placeholder="Jumlah Besar" autocomplete="off" value="{{$row->jumlah_besar ?? ''}}">
                                                <input type="hidden" class="form-control" id="jumlah-{{$index}}" name="jumlah[]" placeholder="Jumlah" autocomplete="off" readonly value="{{$row->jumlah ?? ''}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="jumlah-kecil-{{$index}}" onchange="changeSubtotal({{$index}},'jumlah')" name="jumlah_kecil[]" placeholder="Jumlah Kecil" autocomplete="off" value="{{$row->jumlah_kecil ?? ''}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" class="form-control" id="diskon-{{$index}}" onchange="changeSubtotal({{$index}})" name="diskon[]" placeholder="Diskon" step=".001" value="{{$row->diskon ?? '0'}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" class="form-control" id="ppn-{{$index}}" onchange="changeSubtotal({{$index}})" name="ppn[]" placeholder="PPN" value="{{$row->ppn ?? '0'}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="harga-box-{{$index}}" name="harga_box[]" placeholder="Harga Per Box" onchange="changeSubtotal({{$index}})" value="{{$row->harga_box ?? ''}}">
                                            </div>
                                        </td>
                                       
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="harga-{{$index}}" name="harga_satuan[]" placeholder="Harga Satuan" onchange="changeSubtotal({{$index}})" readonly="" value="{{$row->harga_saat_itu ?? ''}}">
                                            </div>
                                        </td>
                                        <td>

                            @if(isset($row))
                            @php
                            $subtotal_diskon = $row->harga_box * $row->jumlah_besar * $row->diskon / 100.0;
                            $subtotal_belum_ppn = $row->harga_box * $row->jumlah_besar;
                            $subtotal_ppn = $row->harga_box * $row->jumlah_besar * ($row->ppn) * (100-$row->diskon) /10000.0;
                            $subtotal = $row->harga_box * $row->jumlah_besar * (100+$row->ppn) * (100-$row->diskon) /10000.0;
                            @endphp
                            @endif
                                            <div class="form-group subtotal-group">
                                                <input type="text" class="form-control subtotal" id="subtotal-{{$index}}" name="subtotal[]" placeholder="Subtotal" readonly="" value="{{$subtotal ?? ''}}">
                                                <input type="hidden" class="form-control subtotal-belum-ppn" id="subtotal-belum-ppn-{{$index}}" name="subtotal-belum-ppn[]" value="{{$subtotal_belum_ppn ?? ''}}">
                                                <input type="hidden" class="form-control subtotal-diskon" id="subtotal-diskon-{{$index}}" name="subtotal-diskon[]" value="{{$subtotal_diskon ?? ''}}">
                                                <input type="hidden" class="form-control subtotal-ppn" id="subtotal-ppn-{{$index}}" name="subtotal-ppn[]" value="{{$subtotal_ppn ?? ''}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="js-datepicker form-control datepicker" name="expired[]" placeholder="Tanggal Expired" autocomplete="off" @if(isset($row)) value="{{$row->detail_item->kadaluarsa ? date('d/m/Y', strtotime($row->detail_item->kadaluarsa)) : ''}}" @endif>
                                                <p class="text-warning txt-date"></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control js-select2 produsen-select2" id="produsen-select2-{{$index}}" name="produsen[]"  style="width: 100%;">
                                                @if(isset($row->produsen_id))
                                                <option value="{{$row->produsen->id ?? ''}}" selected>{{$row->produsen->nama}}</option>
                                                @endif
                                            </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="batch[]" placeholder="Batch" autocomplete="off" value="{{$row->batch ?? ''}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>