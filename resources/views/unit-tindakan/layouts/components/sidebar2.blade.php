<div class="js-inbox-nav d-none d-md-block">
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{$farmer}}</h3>
            <div class="block-options">
                <div class="dropdown">
                    <button type="button" class="btn-block-option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{url('farmasi')}}">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Kembali Ke Halaman Awal
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item" id="pengaturan" target="_blank">
                            <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;Pengaturan
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content">
            <ul class="nav nav-pills flex-column push">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'dashboard') active @endif" href="{{url('farmasi/'.$farm.'/dashboard')}}">
                        <span><i class="fa fa-fw fa-home mr-5"></i> Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'transaksi') active @endif" href="{{url('farmasi/'.$farm.'/transaksi')}}">
                        <span><i class="fa fa-fw fa-money mr-5"></i> Transaksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'distribusi') active @endif" href="{{url('farmasi/'.$farm.'/distribusi')}}">
                        <span><i class="fa fa-fw fa-code-fork mr-5"></i> Distribusi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'pengadaan') active @endif" href="{{url('farmasi/'.$farm.'/pengadaan')}}">
                        <span><i class="fa fa-fw fa-truck mr-5"></i> Pembelian</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'penghapusan') active @endif" href="{{url('farmasi/'.$farm.'/penghapusan')}}">
                        <span><i class="fa fa-fw fa-trash mr-5"></i> Penghapusan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'item') active @endif" href="{{url('farmasi/'.$farm.'/item')}}">
                        <span><i class="fa fa-fw fa-cube mr-5"></i> Barang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a style="padding-left: 28px;" class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'item_exp') active @endif" href="{{url('farmasi/'.$farm.'/item-exp')}}">
                        <span> -&nbsp;&nbsp;<i class="fa fa-fw fa-cube mr-5"></i> Barang Expired</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a style="padding-left: 28px;" class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'item_stok') active @endif" href="{{url('farmasi/'.$farm.'/item-stok')}}">
                        <span> -&nbsp;&nbsp;<i class="fa fa-fw fa-cube mr-5"></i> Barang Stok Kosong</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'stokopname') active @endif" href="{{url('farmasi/'.$farm.'/stokopname')}}">
                        <span><i class="fa fa-fw fa-calendar-check mr-5"></i> Stok Opname</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'laporan') active @endif" href="{{url('farmasi/'.$farm.'/laporan')}}">
                        <span><i class="fa fa-fw fa-files-o mr-5"></i> Laporan</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="modal" id="modal-large-pengaturan" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.$farm.'/edit')}}" id="form-pengaturan">
            {{csrf_field()}}
            <input type="hidden" name="farmasi_id" value="{{$farmasi->id}}">
            <input type="hidden" name="farmasi" value="{{$farm}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pengaturan Farmasi</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="keterangan">Nama Farmasi</label>
                                    <input type="text" class="form-control" id="nama" name="name" placeholder="Nama Unit" value="{{$farmer}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="keterangan">Nama Kasie</label>
                                    <input type="text" class="form-control" id="nama-kasie" name="kasie" placeholder="Nama Kasie" value="{{$farmasi->kasie}}">
                                </div>
                            </div>
                            <!-- <div class="col">
                                <div class="form-group">
                                    <label for="keterangan">Nomor Telepon <small>(Opsional)</small></label>
                                    <input type="text" class="form-control" name="phone" placeholder="Berikan Informasi Lebih" value="{{$farmasi->telepon}}">
                                </div>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="pembulatan" id="pembulatan" @if($farmasi->pembulatan) checked @endif> <span class="css-control-indicator"></span> Pembulatan Harga
                                </label>
                            </div>
                            <div class="col">
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="perharian" id="perharian"@if($farmasi->perharian) checked @endif> <span class="css-control-indicator"></span> Transaksi Obat 7-23 Hari
                                </label>
                            </div>
                            <div class="col">
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="cash" id="cash"@if($farmasi->cash) checked @endif> <span class="css-control-indicator"></span> Pasien Cash
                                </label>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div class="row pt-15">
                            <div class="col-md-5">
                                <h5>Shift</h5>
                            </div>
                            <div class="col-md-7">
                                <h5>Laba</h5>
                            </div>
                        </div>
                        <div class="row item-wrapper">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penyedia">Mulai </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penyedia">Selesai </label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penyedia">Harga Minimal </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penyedia">Harga Maksimal </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="penyedia">Laba(%) </label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div id="newShift">
                                    @php $j=0 @endphp
                                    @forelse($farmasi->aturan_shift as $row)
                                    @php $j++ @endphp
                                    <input type="hidden" name="shift[]" value="{{$row->id}}">
                                    <div class="row item-wrapper">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div>
                                                    <input type="text" name="waktu_mulai[]" class="form-control timepicker" value="{{$row->waktu_min}}" placeholder="Waktu Mulai">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div>
                                                    <input type="text" class="form-control timepicker" name="waktu_selesai[]" value="{{$row->waktu_max}}" placeholder="Waktu Selesai">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemoveShift">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="row item-wrapper">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div>
                                                    <input type="text" name="waktu_mulai[]" class="form-control timepicker" placeholder="Waktu Mulai">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div>
                                                    <input type="text" class="form-control timepicker" name="waktu_selesai[]" placeholder="Waktu Selesai">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
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
                            <div class="col-md-7">
                                <div id="newHarga">
                                    @php $j=0 @endphp
                                    @forelse($farmasi->aturan_harga as $row)
                                    @php $j++ @endphp
                                    <input type="hidden" name="refer[]" value="{{$row->id}}">
                                    <div class="row item-wrapper">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div>
                                                    <input type="number" class="form-control" name="harga_min[]" placeholder="Harga Minimal" value="{{$row->harga_min}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div>
                                                    <input type="number" class="form-control" name="harga_max[]" placeholder="Harga Maksimal" value="{{$row->harga_max}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div>
                                                    <input type="number" class="form-control" name="laba[]" placeholder="Laba" value="{{$row->laba}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemoveHarga">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="row item-wrapper">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div>
                                                    <input type="number" class="form-control" name="harga_min[]" placeholder="Harga Minimal">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div>
                                                    <input type="number" class="form-control" name="harga_max[]" placeholder="Harga Maksimal">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div>
                                                    <input type="number" class="form-control" name="laba[]" placeholder="Laba">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
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
                        <!-- <hr class="my-5">
                        <div class="row justify-content-center pt-15">
                            <h5>Laba</h5>
                        </div>
                        <div class="row justify-content-center item-wrapper">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="penyedia">Harga Minimal </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="penyedia">Harga Maksimal </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="penyedia">Laba(%) </label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    
                                </div>
                            </div>
                        </div> -->
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" id="close">Batalkan</button>
                    <button type="submit" class="btn btn-primary btn-square" id="saveBtn">
                         <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>