<div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <form action="{{url('farmasi/'.session('farmasi')->slug.'/distribusi/new')}}" method="POST" id="form-distribusi">
            {{csrf_field()}}
            <input type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Distribusi Baru</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="control-label">Unit Tujuan</label>
                                    <div>
                                        {{-- <h1 id="farm-tujuan" hidden>{{$pharmacy->first()->slug}}</h1> --}}
                                        <select class="js-select2 form-control" id="unit-tujuan-select2" name="unit_tujuan" style="width: 100%;" data-placeholder="Pilih Penyedia">
                                            @foreach($pharmacy as $pharm)
                                                <option value="{{$pharm->id}}" data-slug="{{$pharm->slug}}">{{$pharm->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="control-label">Jenis Distribusi</label>
                                    <select class="form-control" id="jenis-distribusi" name="type" style="width: 100%;" onchange="changeJenis()" data-placeholder="Pilih Jenis">
                                        <option value="Permintaan" selected>Permintaan</option>
                                        <option value="Retur">Retur</option>
                                        <option value="Kiriman">Kiriman</option>
                                        <option value="Pengembalian">Pengembalian</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Keterangan <small>(Opsional)</small></label>
                                    <input type="text" class="form-control" name="keterangan" placeholder="Berikan Informasi Lebih">
                                </div>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div class="row pt-15 item-wrapper" id="heading-item">
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
                        <div class="row pt-15 item-wrapper d-none" id="heading-retur">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="penyedia">Barang </label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="penyedia">Tanggal Kadaluarsa</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="penyedia">Jumlah </label>
                                </div>
                            </div>
                        </div>
                        <div id="newItem">
                            <div class="row justify-content-center item-wrapper">
                                <div class="col-7">
                                    <div class="form-group">
                                        <div>
                                            <h1 id="stok-hid-1" hidden></h1>
                                            <h1 id="distribusi-hid-1" hidden></h1>
                                            <select class="js-select2 form-control template-select" id="barang-select2-1" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
                                                <option></option>
                                            </select>
                                            <p class="text-danger" id="alert-1" hidden>Stok kurang</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah" autocomplete="off">
                                            {{-- <div class="input-group-append">
                                                <span class="input-group-text">Max: 0</span>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove" disabled="disabled">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 mb-3 pb-2" id="loader">
                            <center>
                                <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddItems">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddRetur" hidden>
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