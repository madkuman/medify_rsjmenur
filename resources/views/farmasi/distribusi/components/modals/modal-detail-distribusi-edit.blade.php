<div class="modal" id="modal-large-edit" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
            <div class="modal-dialog modal-full" role="document">
                <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/distribusi')}}/edit" id="form-distribusi">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$distribusi->id}}">
                    <input type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header">
                                <h3 class="block-title">Edit Permintaan</h3>
                            </div>
                            <div class="block-content">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="control-label">Unit Tujuan</label>
                                            <div>
                                                <select class="js-select2 form-control" id="unit-tujuan-select2" name="unit_tujuan" style="width: 100%;" data-placeholder="Pilih Penyedia" disabled>
                                                    <option value="{{$distribusi->unit_tujuan}}" data-slug="{{$distribusi->detail_tujuan->slug}}">{{$distribusi->detail_tujuan ? $distribusi->detail_tujuan->nama : "Gudang"}}</option>
                                                    {{-- <option value="0" @if($distribusi->unit_tujuan == 0) selected @endif>Gudang</option>
                                                    @foreach($pharmacy as $pharm)
                                                    <option value="{{$pharm->id}}" @if($distribusi->unit_tujuan == $pharm->id) selected @endif>{{$pharm->nama}}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="control-label">Jenis Distribusi</label>
                                            <select class="form-control" name="type" style="width: 100%;" data-placeholder="Pilih Jenis" disabled>
                                                <option value="Permintaan" @if($distribusi->kategori == "Permintaan") selected @endif>Permintaan</option>
                                                <option value="Retur" @if($distribusi->kategori == "Retur") selected @endif>Retur</option>
                                                <option value="Kiriman" @if($distribusi->kategori == "Kiriman") selected @endif>Kiriman</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan <small>(Opsional)</small></label>
                                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Berikan Informasi Lebih" value="{{$distribusi->deskripsi}}">
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-5">
                                <div class="row pt-15 item-wrapper">
                                    <div class="col-7">
                                        <div class="form-group">
                                            <label for="penyedia">Barang </label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="penyedia">Jumlah </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="newItem">
                                    @foreach($distribusi->draft as $row)
                                    @php $j++ @endphp
                                    <div class="row justify-content-center item-wrapper">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <h1 id="stok-hid-{{$j}}" hidden>{{$row->item_farmasi->stok}}</h1>
                                                <h1 id="distribusi-hid-{{$j}}" hidden>{{$row->item_farmasi->max_distribusi}}</h1>
                                                <div>
                                                    <select class="js-select2 form-control barang" id="barang-select2-{{$j}}" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
                                                        @if($distribusi->kategori == 'Permintaan')
                                                        <option value="{{$row->item_farmasi_id}}" selected>{{$row->item_farmasi->item_detail->nama.' ('.$row->item_farmasi->item_detail->satuan.') - Stok Sekarang : '.round($stok[$row->item_farmasi->item_template_id][session('farmasi')->id][0]->stok).' - Stok Tujuan : '.$row->item_farmasi->stok.' - Harga : '.$row->item_farmasi->harga}}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    @php
                                                        if ($row->item_farmasi->max_distribusi != null && $row->item_farmasi->max_distribusi != 0) {
                                                            if ($row->item_farmasi->stok > $row->item_farmasi->max_distribusi) {
                                                                $max = $row->item_farmasi->max_distribusi;
                                                            }else {
                                                                $max = $row->item_farmasi->stok;
                                                            }
                                                        }
                                                        else {
                                                            $max = $row->item_farmasi->stok;
                                                        }
                                                    @endphp
                                                    <input type="number" class="form-control" id="jumlah-{{$j}}" name="jumlah[]" placeholder="Jumlah" value="{{$row->jumlah}}" max="{{$max}}" autocomplete="off">
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
                                        <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddLog">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <center class="d-none" id="spinner"><i class="fa fa-2x fa-asterisk fa-spin text-info"></i></center>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-primary btn-square" id="saveBtn">
                             <i class="fa fa-save"></i> Simpan
                         </button>
                     </div>
                 </div>
             </form>
         </div>
        </div>