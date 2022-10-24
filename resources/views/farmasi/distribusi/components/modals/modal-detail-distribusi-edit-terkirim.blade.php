<div class="modal" id="modal-large-terkirim" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/distribusi')}}/editTerkirim" id="form-distribusi">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$distribusi->id}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Edit Kiriman</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="penyedia">Keterangan <small>(Opsional)</small></label>
                                    <input type="text" class="form-control" name="keterangan" placeholder="Berikan Informasi Lebih" value="{{$distribusi->deskripsi}}">
                                </div>
                            </div>
                        </div>

                        <hr class="my-5">
                        <div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="penyedia">Barang </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="penyedia">Tanggal Kadaluarsa </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="penyedia">Jumlah </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="penyedia">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="newItem">
                            @php $j=0 @endphp
                            @foreach($distribusi->log as $row)
                            @php $j++ @endphp
                            <div class="row item-wrapper">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div>
                                            <select class="js-select2 form-control barang" id="barang-select2-{{$j}}" name="template[]" style="width: 100%;" data-placeholder="Pilih Barang">
                                                <option></option>
                                                <option value="{{$row->detail_item->detail_item->item_detail->id}}" selected>{{$row->detail_item->detail_item->item_detail->nama.' ('.$row->detail_item->detail_item->item_detail->satuan.') - Stok Sekarang : '.round($row->detail_item->detail_item->stok).' - Stok Tujuan : '.round($stok[$row->detail_item->detail_item->item_template_id][$distribusi->unit_tujuan][0]->stok).' - Harga : '.$row->detail_item->detail_item->harga}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div>
                                            <select class="js-select2 form-control" id="items-select2-{{$j}}" name="barang[]" onchange="changeJumlah({{$j}})" style="width: 100%;" data-default="{{$row->item_id}}">
                                                <option value="{{$row->item_id}}" selected>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            @php
                                            // dd($row);
                                            if ($row->detail_item->detail_item->max_distribusi != null && $row->detail_item->detail_item->max_distribusi != 0) {
                                                if ($row->detail_item->detail_item->stok > $row->detail_item->detail_item->max_distribusi) {
                                                    $max = $row->detail_item->detail_item->max_distribusi;
                                                }else {
                                                    $max = $row->detail_item->detail_item->stok;
                                                }
                                            }
                                            else {
                                                $max = $row->detail_item->detail_item->stok;
                                            }
                                            @endphp
                                            <input type="number" class="form-control" id="jumlah-{{$j}}" name="jumlah[]" placeholder="Jumlah" value="{{$row->jumlah}}" max="{{$max}}" autocomplete="off" data-default="{{$max}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Max: {{$max}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-3 mb-3 pb-2" id="loader">
                            <center>
                                <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddItems">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <center class="d-none" id="spinner"><i class="fa fa-2x fa-asterisk fa-spin text-info"></i></center>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" id="close" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary btn-square">
                     <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>