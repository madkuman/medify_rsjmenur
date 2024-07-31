<div class="modal" id="modal-large-pengaturan" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width: 1100px">
        <div class="modal-content" >
            <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/edit')}}" id="form-pengaturan">
                {{csrf_field()}}
                <input type="hidden" name="farmasi_id" value="{{session('farmasi')->id}}">
                <input type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Pengaturan {{session('farmasi')->jenis_detail->nama}}</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="keterangan">Nama Farmasi</label>
                                        <input type="text" class="form-control" id="nama" name="name" placeholder="Nama Unit" value="{{session('farmasi')->nama}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="keterangan">Nama Kasie</label>
                                        <input type="text" class="form-control" id="nama-kasie" name="kasie" placeholder="Nama Kasie" value="{{session('farmasi')->kasie}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="keterangan">No. SIPA</label>
                                        <input type="text" class="form-control" id="no_sipa" name="no_sipa" placeholder="No. SIPA" value="{{session('farmasi')->no_sipa}}">
                                    </div>
                                </div>
                            </div>
                            @if (session('farmasi')->jenis_detail->nama != 'Gudang')
                            <div class="row">
                                <div class="col-3">
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" name="pembulatan" id="pembulatan" @if(session('farmasi')->pembulatan) checked @endif> <span class="css-control-indicator"></span> Pembulatan Harga
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" name="perharian" id="perharian"@if(session('farmasi')->perharian) checked @endif> <span class="css-control-indicator"></span> Transaksi Obat 7-23 Hari
                                    </label>
                                </div>
                                <div class="col-2">
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" name="cash" id="cash"@if(session('farmasi')->cash) checked @endif> <span class="css-control-indicator"></span> Pasien Cash
                                    </label>
                                </div>
                                {{-- <div class="col">
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" name="consis" id="consis" @if(session('farmasi')->consis) checked @endif> <span class="css-control-indicator"></span> Consis
                                    </label>
                                </div> --}}
                                <div class="col-2">
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" name="kemoterapi" id="kemoterapi" @if(session('farmasi')->kemoterapi) checked @endif> <span class="css-control-indicator"></span> Kemoterapi
                                    </label>
                                </div>
                                <div class="col-2">
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" name="is_produksi" id="is_produksi" @if(session('farmasi')->is_produksi) checked @endif> <span class="css-control-indicator"></span> Produksi
                                    </label>
                                </div>
                            </div>
                            
                            <hr class="my-5">
                            <div class="row pt-15">
                                <div class="col-5">
                                    <h5>Shift</h5>
                                </div>
                                <div class="col"></div>
                                <div class="col-6">
                                    <h5>Laba</h5>
                                </div>
                            </div>
                            <div class="row item-wrapper ">
                                <div class="col-5">
                                    <div class="row gutters-tiny">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="penyedia">Nama </label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="penyedia">Keterangan </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="penyedia">Masuk </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="penyedia">Keluar </label>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="form-group">
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col"></div>
                                <div class="col-6">
                                    <div class="row gutters-tiny">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="penyedia">Jenis Pembayaran </label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="penyedia">Harga Minimal </label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="penyedia">Harga Maksimal </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="penyedia">Laba(%) </label>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="form-group">
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-5">
                                    <div id="newShift">
                                        @php $j=0 @endphp
                                        @forelse(session('farmasi')->aturan_shift as $row)
                                        @php $j++ @endphp
                                        <input type="hidden" name="shift[]" value="{{$row->id}}">
                                        <div class="row item-wrapper gutters-tiny">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="text" name="nama_shift[]" class="form-control" value="{{$row->nama}}" placeholder="Nama Shift" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="text" class="form-control" name="keterangan_shift[]" value="{{$row->keterangan}}" placeholder="Keterangan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="text" name="waktu_mulai[]" class="form-control timepicker" value="{{$row->waktu_min}}" placeholder="Waktu Mulai">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="text" class="form-control timepicker" name="waktu_selesai[]" value="{{$row->waktu_max}}" placeholder="Waktu Selesai">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemoveShift">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <input type="hidden" name="shift[]" value="0">
                                        <div class="row item-wrapper gutters-tiny">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="text" name="nama_shift[]" class="form-control" placeholder="Nama Shift" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="text" class="form-control" name="keterangan_shift[]" placeholder="Keterangan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="text" name="waktu_mulai[]" class="form-control timepicker" placeholder="Waktu Mulai">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="text" class="form-control timepicker" name="waktu_selesai[]" placeholder="Waktu Selesai">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemoveShift">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforelse
                                    </div>
    
                                    <div class="mt-3 mb-3 pb-2" id="loader">
                                        <center>
                                            <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddShift">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            <center class="d-none" id="spinner"><i class="fa fa-2x fa-asterisk fa-spin text-info"></i></center>
                                        </center>
                                    </div>
                                </div>
                                <div class="col"></div>
                                <div class="col-6">
                                    <div id="newHarga">
                                        @php $j=0 @endphp
                                        @forelse(session('farmasi')->aturan_harga as $row)
                                        @php $j++ @endphp
                                        <div class="row item-wrapper gutters-tiny">
                                            <input type="hidden" name="refer[]" value="{{$row->id}}">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <div>
                                                        <select class="form-control js-select2" name="perusahaan_tipe_id[]"  style="width:100%"  data-placeholder="Jenis Pembayaran">
                                                            <option></option>
                                                            @foreach(session('perusahaan_tipe') as $tipe)
                                                            <option  value="{{$tipe->id}}" @if($row->perusahaan_tipe_id == $tipe->id) selected="" @endif>
                                                                {{$tipe->nama}}
                                                            </option>
                                                            @endforeach
                                                            <option value="0" @if($row->perusahaan_tipe_id == 0) selected="" @endif> Lainnya</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="number" class="form-control" name="harga_min[]" placeholder="Harga Minimal" value="{{$row->harga_min}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="number" class="form-control" name="harga_max[]" placeholder="Harga Maksimal" value="{{$row->harga_max}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="number" class="form-control" name="laba[]" placeholder="Laba" value="{{$row->laba}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemoveHarga">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="row item-wrapper gutters-tiny">
                                            <input type="hidden" name="refer[]" value="0">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <div>
                                                        <select class="form-control js-select2" name="perusahaan_tipe_id[]"  style="width:100%"  data-placeholder="Jenis Pembayaran">
                                                            <option></option>
                                                            @foreach(session('perusahaan_tipe') as $tipe)
                                                            <option  value="{{$tipe->id}}" >
                                                                {{$tipe->nama}}
                                                            </option>
                                                            @endforeach
                                                            <option value="0"> Lainnya</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="number" class="form-control" name="harga_min[]" placeholder="Harga Minimal">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="number" class="form-control" name="harga_max[]" placeholder="Harga Maksimal">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="number" class="form-control" name="laba[]" placeholder="Laba">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemoveHarga">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforelse
                                    </div>
    
                                    <div class="mt-3 mb-3 pb-2" id="loader">
                                        <center>
                                            <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddHarga">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            <center class="d-none" id="spinner"><i class="fa fa-2x fa-asterisk fa-spin text-info"></i></center>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <hr class="my-5">
                            @include('farmasi.layouts.components.setting-aturan-embalase')
                            <hr class="my-5">
                            @include('farmasi.layouts.components.setting-tipe-racikan-bud')
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary btn-square" id="close">Batalkan</button> --}}
                        <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary btn-square" id="saveBtn">
                         <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>