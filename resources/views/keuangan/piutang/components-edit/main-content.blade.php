<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Edit Piutang</h3>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="d-none">
                <input type="text" class="d-none" id="idtransaksi" value="{{$piutang->id}}">
                <input type="text" class="d-none" id="countdetail" value="{{count($piutang->detail)}}">
                <small class="text-danger hide" id="error_main_tanggal">Tidak Boleh Kosong</small>
            </div>
            <div class="col-3">
                <label for="example-datepicker1">Tanggal Transaksi</label>
                <input type="text" class="js-datepicker form-control" id="tanggaltransaksi" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal"  value="{{date('d-m-Y', strtotime($piutang->tanggal_transaksi))}}">
            </div>
            <div class="col-5" id="input-judul-container">
                <label>Judul Piutang</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul Piutang" value="{{$piutang->judul}}">
                <small class="text-danger hide" id="error_judul_kosong">Tidak Boleh Kosong</small>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3" id="input-pihak3-container">
                <label>Penanggung Jawab Pembayaran</label>
                <input type="text" class="form-control" id="pihak3" name="pihak3" placeholder="Masukkan Nama Penanggung Jawab Pembayaran" value="{{$piutang->pihak_ketiga}}" >
            </div>
            <div class="col-3" id="input-pasien-container">
                <label>Pasien</label>
                <select class="js-select2 form-control" id="pasien" name="pasien" style="width: 100%;">
                @if($piutang->pasien_id != null)
                <option value="{{$piutang->pasien->id}}" selected>{{$piutang->pasien->name}}</option>
                @endif
                </select>
            </div>
            <div class="col-3" id="input-pasien-pembayaran-container">
                <label>Jenis Pembayaran <i class="fa fa-spin fa-spinner text-primary" style="display: none" id="pasien_pembayaran_loading"></i></label>
                <select class="js-select2 form-control" id="pasien-pembayaran" name="pasien-pembayaran" style="width: 100%;" data-placeholder="Pilih Jenis Pembayaran"> 
                    <option hidden value="{{$piutang->pasien_pembayaran_id}}" selected></option>
                </select>
            </div>
            <div class="col-3">
                <label>Perusahaan</label>
                <select class="js-select2 form-control" id="perusahaan" name="perusahaan" style="width: 100%;" data-placeholder="Pilih Perusahaan">
                    <option></option>
                    @foreach($perusahaan as $item)
                    <option value="{{$item->id}}" @if($item->id == $piutang->perusahaan_id) selected @endif>{{$item->nama}}</option>
                    @endforeach
                </select>
                <small class="text-danger hide" id="error_perusahaan_kosong">Tidak Boleh Kosong</small>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3" id="input-pasien-pembayaran-container">
                <label>Lokasi</label>
                <select class="js-select2 form-control" id="lokasi" name="lokasi" style="width: 100%;" data-placeholder="Pilih Lokasi">
                    @foreach($lokasi as $item)
                        @if($item->id == $piutang->lokasi_id)
                            <option value="{{$item->id}}" data-kategori="{{$item->kategori_keuangan_id}}" selected>{{$item->nama}}</option>
                        @else
                            <option value="{{$item->id}}" data-kategori="{{$item->kategori_keuangan_id}}">{{$item->nama}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-3">
                <label>Kategori</label>
                <select class="js-select2 form-control" id="kategori" name="kategori" style="width: 100%;" data-placeholder="Pilih Kategori Transaksi">
                    @foreach($kategori as $item)
                    <option value="{{$item->id}}" @if($item->id == $piutang->kategori_id) selected @endif>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3">
                <label>Kasus Tagihan ID</label>
                <input type="text" id="kasus_tagihan_id" value="{{$piutang->kasus_tagihan_id}}" class="form-control" readonly>
            </div>
            <div class="col-3">
                <label>Piutang Parent ID</label>
                <input type="text" id="piutang_parent_id" value="{{$piutang->piutang_parent_id}}" class="form-control" readonly>
            </div>
            <div class="col-3">
                <label>Keterangan</label>
                <input type="text" id="keterangan" value="{{$piutang->keterangan}}" class="form-control" readonly>
            </div>
            <div class="col-3">
                <label>Kasir ID</label>
                <input type="text" id="kasir_id" value="{{$piutang->kasir_id}}" class="form-control" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary" id="btnOpen"><i class="fa fa-plus"></i> Tambah Transaksi</button>
                <hr>         
            </div>
            <div class="col-12">
                <table class="main-table table table-hover table-striped table-borderless table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th style="width: 19%;">Deskripsi Transaksi</th>
                            <th style="width: 10%;">Keterangan</th>
                            <th class="text-center" style="width: 9%;">Jumlah</th>
                            <th class="text-right" style="width: 12%;">Harga</th>
                            <th class="text-center" style="width: 9%;">Diskon</th>
                            <th class="text-right" style="width: 18%;">SubTotal</th>
                            <th class="text-right" style="width: 7%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $count = 0 @endphp
                    @foreach($piutang_details as $tanggal => $item_tanggal)
                        <tr class="table-warning">
                            <td colspan="8" class="text-center">
                            {{$tanggal}}
                            </td>
                        </tr>
                        @foreach($item_tanggal as $item)
                            @php $count++ @endphp
                            <tr id="transaksi-{{$count}}" data-id="{{$count}}">
                                <input type="text" class="d-none" id="detail_id{{$count}}" value="{{$item->id}}">
                                <input type="text" class="d-none" id="created_by{{$count}}" value="{{$item->created_by}}">
                                <input type="text" class="d-none" id="kategori_id{{$count}}" value="{{$item->kategori_id}}">
                                <input type="text" class="d-none" id="lokasi_id{{$count}}" value="{{$item->lokasi_id}}">
                                <input type="text" class="d-none" id="tarif_id{{$count}}" value="{{$item->tarif_id}}">
                                <input type="text" class="d-none" id="kelas_id{{$count}}" value="{{$item->kelas_id}}">
                                <input type="text" class="d-none" id="tarif_tipe_id{{$count}}" value="{{$item->tarif_tipe_id}}">
                                <input type="text" class="d-none" id="deskripsi{{$count}}" value="{{$item->deskripsi}}">
                                <input type="text" class="d-none" id="keterangan{{$count}}" value="{{$item->keterangan}}">
                                <input type="text" class="d-none" id="jumlah{{$count}}" value="{{$item->jumlah}}">
                                <input type="text" class="d-none" id="harga{{$count}}" value="{{$item->harga}}">
                                <input type="text" class="d-none" id="diskon{{$count}}" value="{{$item->diskon}}">
                                <input type="text" class="d-none" id="subtotal{{$count}}" value="{{$item->subtotal}}">
                                <input type="text" class="d-none" id="creator_name{{$count}}" value="{{$item->creator->name ?? '-'}}">
                                <td class="text-center" style="width: 5%;">{{$count}}</td>
                                <td id="deskripsi-{{$count}}" style="width: 19%;">{{$item->deskripsi}}</td>
                                <td id="keterangan-{{$count}}" style="width: 10%;">{{$item->keterangan}}</td>
                                <td id="jumlah-{{$count}}" class="text-center" style="width: 9%;">{{$item->jumlah}}</td>
                                <td id="harga-{{$count}}" class="text-right" style="width: 12%;">{{number_format($item->harga,0)}}</td>
                                <td id="diskon-{{$count}}" class="text-center" style="width: 9%;">{{number_format($item->diskon,0)}}</td>
                                <td id="subtotal-{{$count}}" class="text-right" style="width: 18%;">{{number_format($item->subtotal,0)}}</td>
                                <td class="text-right" style="width: 7%;">
                                    <button class="btn btn-circle btn-outline-danger btn-sm btnDelete"><i class="fa fa-trash"></i></button>
                                    <button class="btn btn-circle btn-outline-info btn-sm btnEdit"><i class="fa fa-pencil"></i></button>
                                </td>
                            </tr>
                        @endforeach

                    @endforeach
                        <tr id="emptyTable" style="display:none">
                            <td colspan="8" class="text-center"><h4 class="mb-0 mt-10">Tidak Ada Transaksi</h4><br>Klik <strong>Tambah Transaksi</strong> untuk menambahkan data</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            </div>
            <div class="col-12">
                <table class="table table-borderless table-vcenter">
                    <tbody>
                        <tr>
                            <td style="width: 80%" class="text-right">Jumlah</td>
                            <td class="text-right  "  style="width: 20%" id="allJumlah">Rp 0</td>
                        </tr>
                        <tr>
                            <td style="width: 80%" class="text-right">Diskon</td>
                            <td class="text-right "  style="width: 20%" id="allDiskon">Rp 0</td>
                        </tr>
                        <tr>
                            <td style="width: 80%" class="text-right font-w700">Total</td>
                            <td class="text-right font-w700"  style="width: 20%" id="allTotal">Rp 0</td>
                        </tr>
                        <tr>
                            <td style="width: 60%" class="text-right font-w700"></td>
                            <td class="text-right font-w700"  style="width: 40%" id="allTotal">
                                <button class="btn btn-success btn-hero btn-block" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                                <button class="btn btn-alt-success btn-hero btn-block" style="display: none" id="buttonLoading">
                                    <i class="fa fa-asterisk fa-spin"></i> Loading
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>