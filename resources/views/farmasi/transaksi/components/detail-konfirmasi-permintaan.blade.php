<form method="POST" action="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/konfirmasi-permintaan') }}">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $transaksi->id }}">
    <div class="container-kategori-resep">
        @if ($transaksi->ori_detail->kategori_resep == 'tpn')
            @include('farmasi.transaksi.components.kategori-resep-tpn-container')
        @elseif ($transaksi->ori_detail->kategori_resep == 'dispensing_aseptik')
            @include('farmasi.transaksi.components.kategori-resep-dispensing_aseptik-container')
        @else
            @include('farmasi.transaksi.components.kategori-resep-default-container')
        @endif
    </div>
    @php
        $tipe_perusahaan = $transaksi->pembayaran_detail->perusahaan->tipe->slug ?? null;
        $tujuan = 'kasir';
        if ($tipe_perusahaan == 'bpjs') {
            $tujuan = "kasus";
        } elseif ($tipe_perusahaan == 'tunai') {
            $tujuan = "kasir";
        }
    @endphp

    @if (empty($transaksi->final_detail->konfirmasi_permintaan_at) && count($transaksi->copy_resep) == 0)
        <div class="block mt-3">
            <div class="block-content mb-0">
                @if ($transaksi->status_kasir == 0)
                    <div class="form-group">
                        <label>Tujuan Pembayaran</label>
                        <br>
                        <label class="css-control css-control-primary css-radio">
                            <input type="radio" class="css-control-input" name="tujuan_pembayaran" value="kasir" @if ($tujuan == "kasir") checked @endif>
                            <span class="css-control-indicator"></span>Kasir
                        </label>
                        @if (!empty($kasus))
                            <label class="css-control css-control-primary css-radio">
                                <input type="radio" class="css-control-input" name="tujuan_pembayaran" value="kasus" @if ($tujuan == "kasus") checked @endif>
                                <span class="css-control-indicator"></span>Kasus
                            </label>
                        @endif
                        <label class="css-control css-control-primary css-radio">
                            <input type="radio" class="css-control-input" name="tujuan_pembayaran" value="farmasi">
                            <span class="css-control-indicator"></span>Farmasi
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-tujuan-pembayaran-kirim-kasir" name="submit" value="kirim_kasir">Kirim ke Tagihan</button>
                @else
                    <div class="alert alert-success" role="alert" id="notif-kasir">
                        <p>Tagihan berhasil dikirim ke Kasir.</p>
                        @php 
                            $status_bayar = 0;
                            $total_pemasukan = count($transaksi->piutang->pemasukan ?? []);
                            if($total_pemasukan > 0) $status_bayar = 1;
                            else $status_bayar = 0;
                        @endphp
                        @if($status_bayar == 0)
                        <button type="button" class="btn btn-danger" id="btnBatalKirimKasir">Batalkan Transaksi Kasir</button>
                        @else
                        <button class="btn btn-success" disabled>Tagihan telah dibayar</button>
                        @endif
                    </div>
                    <input type="hidden" name="tujuan_pembayaran" value="kasir">
                @endif
            </div>
        </div>
        <div class="mt-2">
            <div class="form-group row">
                <div class="col-12">
                    <button type="submit" name="submit" value="konfirmasi_permintaan" class="btn btn-primary btn-square float-right"
                        id="btn-konfirmasi-pesanan">Konfirmasi Pesanan</button>
                </div>
            </div>
        </div>
    @endif
</form>
