<div class="modal" id="modal-normal" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <input type="hidden" name="id" value="{{$transaksi->id}}">
        <input type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">
        <input type="hidden" name="total_harga" id="total" value="{{$total}}">
        <input type="hidden" name="asal_pelayanan" value="{{$transaksi->lokasi->nama}}">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Konfirmasi Pembayaran</h3>
                </div>
                <div class="block-content">
                    {{-- <div class="mb-20">
                        <label class="css-control css-control-lg css-control-primary css-checkbox" id="input-tagihan">
                            <input type="checkbox" class="css-control-input" name="status_pembayaran" id="status_pembayaran" onchange="changePembayaran()" 
                            @if($transaksi->kasus) checked=""
                            @endif> <span class="css-control-indicator"></span> Kirim ke Tagihan
                        </label>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="penyedia">Total Biaya</label>
                            <label for="penyedia" class="form-control"><span id="total-bayar">{{number_format($total)}}</span></label>
                        </div>
                    </div>
                    <div class="form-group row" id="input-bayar">
                        <div class="col-12">
                            <label for="penyedia">Masukkan Jumlah Bayar</label>
                            <input type="number" class="form-control" id="dibayar" name="pembayaran" placeholder="Jumlah Bayar">
                        </div>
                    </div> --}}
                    {{-- <div class="mb-20">
                        <div class="col-12">
                            <div class="row">
                                <label for="tipe_layanan">Tujuan Pembayaran</label>
                            </div>
                            <br>
                            <div class="row">
                            <label class="css-control css-control-primary css-radio">
                                <input type="radio" class="css-control-input" name="kirim_tagihan" value="0" required="" checked>
                                <span class="css-control-indicator"></span>Kasir
                            </label>
                            <label class="css-control css-control-primary css-radio">
                                <input type="radio" class="css-control-input" name="kirim_tagihan" value="1" required="">
                                <span class="css-control-indicator"></span>Kasus
                            </label>
                            <label class="css-control css-control-primary css-radio">
                                <input type="radio" class="css-control-input" name="kirim_tagihan" value="2" required="">
                                <span class="css-control-indicator"></span>Farmasi
                            </label>
                            </div>
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <div class="col-12">
                            <h4 class="text-center">Pastikan Semua data sudah benar!</h4>
                            {{-- <label for="penyedia">Pilih Shift</label>
                            <select class="js-select2 form-control" id="select_shift" name="shift_id" style="width: 100%;" required="required">
                                <option>- Pilih Shift -</option>
                                @forelse(session('farmasi')->aturan_shift as $item)
                                <option value="{{$item->id}}" @if($item->id == $active_shift) selected @endif>{{$item->nama}}</option>
                                @empty
                                @endforelse
                            </select>
                            @if(empty(session('farmasi')->aturan_shift)) <small>Jika kosong, tambahkan shift di pengaturan</small> @endif --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-alt-primary" id="btn-simpan-konfirmasi-pesanan">
                    <i class="fa fa-check"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>