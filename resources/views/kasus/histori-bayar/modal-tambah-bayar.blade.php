<div class="modal fade" id="tambahPembayaran" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{url()->current()}}/tambahbayar" method="POST" id="formTambahBayar">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header ">
                        <h3 class="block-title">Tambah Pembayaran</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content px-0 row">
                        {{csrf_field()}}
                        <input type="hidden" name="dp" id="" value="1">
                        <input type="hidden" name="judul" value="Pembayaran - DP">
                        <input type="hidden" name="pasien_id" value="{{$kasus->pasien_id}}">
                        <input type="hidden" name="pihak_3" value="TUNAI">
                        <input type="hidden" name="kategori" value="107">
                        <input type="hidden" name="pasien_pembayaran_id" value="{{$kasus->pasien_pembayaran_id}}">
                        <input type="hidden" name="lokasi_id" value="{{$kasus->lokasi->lokasi->id}}">
                        <input type="hidden" name="departemen_id" value="{{$kasus->lokasi->lokasi->departemen->id}}">
                        <input type="hidden" name="perusahaan_id" value="{{$kasus->pembayaran->perusahaan_id}}">
                        <input type="hidden" name="kasus_id" value="{{$kasus->id}}">
                        <input type="hidden" name="asal_layanan" value="{{$kasus->lokasi->lokasi->nama}}">
                        <input type="hidden" name="kelas_id" value="{{$kasus->kelas->nama}}">
                        <input type="hidden" name="alldiskon" value="0">
                        <div class="form-group col-md-12">
                            <label>Kasir Tujuan</label>
                            <select name="kasir_id" id="selectKasir" class="form-control js-select2" style="width: 100%;" data-size="2" data-placeholder="Pilih Kasir Tujuan" required>
                                <option></option>
                                @foreach($kasir as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Pilih Akun</label>
                            <select name="akun_id" id="selectAkun" class="form-control js-select2" style="width: 100%;" data-size="2" data-placeholder="Pilih Akun" required>
                            <option></option>
                            @foreach($akun as $ak)
                            <option value="{{$ak->id}}">{{$ak->nama}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Jumlah Pembayaran</label>
                            <input type="number" class="form-control" placeholder="Masukkan jumlah pembayaran" name="alljumlah" required="">
                        </div>
                    </div>
                </div>
                <div class="text-center py-10">
                    <button type="submit" class="btn-alt btn-grass min-width-100 float-right" id="submitCheckout">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                    <button type="button" data-dismiss="modal" class="btn-alt btn-hero btn-regular min-width-100 float-right">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>