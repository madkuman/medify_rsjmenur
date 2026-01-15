@php
    $is_rawat_inap = ($transaksi->lokasi->departemen->slug ?? null) == 'rawat-inap';
@endphp
<form method="POST" action="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/telaah-obat') }}">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $transaksi->id }}">
    <div class="row">
        <div class="col-12 col-md-8">
            <table class="table table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center">Telaah Obat</th>
                        <th class="text-center">Penyiapan</th>
                        <th class="text-center">Pengemasan</th>
                        <th class="text-center">Penyerahan</th>
                        @if ($is_rawat_inap)
                            <th class="text-center">Penerimaan Perawat</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $list_telaah = [
                            'nama_pasien' => 'Nama Pasien',
                            'no_rm' => 'No. Rekam Medis',
                            'tanggal_lahir' => 'Tanggal Lahir',
                            'nama_obat' => 'Nama Obat',
                            'dosis_bentuk_kekuatan_sediaan' => 'Dosis, bentuk, kekuatan sediaan',
                            'jumlah' => 'Jumlah',
                            'rute_pemberian' => 'Rute Pemberian',
                            'waktu_frekuensi_aturan_pakai' => 'Waktu/frekuensi aturan pakai',
                        ];
                    @endphp
                    @foreach ($list_telaah as $key => $value)
                        <tr>
                            <td width="200px">{{ $value }}</td>
                            <td class="text-center">
                                @if (!empty($transaksi->transaksi_obat_telaah_obat_penyiapan))
                                    @if (!empty($transaksi->transaksi_obat_telaah_obat_penyiapan->$key))
                                        &#10003;
                                    @endif
                                @else
                                    <input type="checkbox" name="telaah[penyiapan][{{ $key }}]" value="1"
                                        checked>
                                @endif
                            </td>
                            <td class="text-center">
                                @if (!empty($transaksi->transaksi_obat_telaah_obat_pengemasan))
                                    @if (!empty($transaksi->transaksi_obat_telaah_obat_pengemasan->$key))
                                        &#10003;
                                    @endif
                                @else
                                    <input type="checkbox" name="telaah[pengemasan][{{ $key }}]" value="1"
                                        checked>
                                @endif
                            </td>
                            <td class="text-center">
                                @if (!empty($transaksi->transaksi_obat_telaah_obat_penyerahan))
                                    @if (!empty($transaksi->transaksi_obat_telaah_obat_penyerahan->$key))
                                        &#10003;
                                    @endif
                                @else
                                    <input type="checkbox" name="telaah[penyerahan][{{ $key }}]" value="1"
                                        checked>
                                @endif
                            </td>
                            @if ($is_rawat_inap)
                                <td class="text-center">
                                    @if (!empty($transaksi->transaksi_obat_telaah_obat_penerimaan_perawat))
                                        @if (!empty($transaksi->transaksi_obat_telaah_obat_penerimaan_perawat->$key))
                                            &#10003;
                                        @endif
                                    @else
                                        {{-- <input type="checkbox" name="telaah[penerimaan_perawat][{{ $key }}]" value="1" checked> --}}
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Paraf</th>
                        <th style="text-align: center">
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyiapan->user_telaah->ttd))
                                <img src="{{ asset($transaksi->transaksi_obat_telaah_obat_penyiapan->user_telaah->ttd) }}"
                                    alt="" style="width: 80px; max-width: 80px;">
                            @endif
                        </th>
                        <th style="text-align: center">
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_pengemasan->user_telaah->ttd))
                                <img src="{{ asset($transaksi->transaksi_obat_telaah_obat_pengemasan->user_telaah->ttd) }}"
                                    alt="" style="width: 80px; max-width: 80px;">
                            @endif
                        </th>
                        <th style="text-align: center">
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyerahan->user_telaah->ttd))
                                <img src="{{ asset($transaksi->transaksi_obat_telaah_obat_penyerahan->user_telaah->ttd) }}"
                                    alt="" style="width: 80px; max-width: 80px;">
                            @endif
                        </th>
                        @if ($is_rawat_inap)
                            <th></th>
                        @endif
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <th>{{ $transaksi->transaksi_obat_telaah_obat_penyiapan->user_telaah->name ?? '' }}</th>
                        <th>{{ $transaksi->transaksi_obat_telaah_obat_pengemasan->user_telaah->name ?? '' }}</th>
                        <th>{{ $transaksi->transaksi_obat_telaah_obat_penyerahan->user_telaah->name ?? '' }}</th>
                        @if ($is_rawat_inap)
                            <th>{{ $transaksi->transaksi_obat_telaah_obat_penerimaan_perawat->user_telaah->name ?? '' }}
                            </th>
                        @endif
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyiapan))
                                <small>{{ $transaksi->transaksi_obat_telaah_obat_penyiapan->telaah_at->format('Y-m-d') }}</small>
                            @else
                                <button type="submit" class="btn btn-sm btn-block btn-primary" name="submit"
                                    value="penyiapan">Simpan</button>
                            @endif
                        </th>
                        <th>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_pengemasan))
                                <small>{{ $transaksi->transaksi_obat_telaah_obat_pengemasan->telaah_at->format('Y-m-d') }}</small>
                            @else
                                <button type="submit" class="btn btn-sm btn-block btn-primary" name="submit"
                                    value="pengemasan">Simpan</button>
                            @endif
                        </th>
                        <th>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyerahan))
                                <small>{{ $transaksi->transaksi_obat_telaah_obat_penyerahan->telaah_at->format('Y-m-d H:i:s') }}</small>
                            @else
                                @if ($transaksi->dikerjakan_at != null)
                                    <button type="submit" class="btn btn-sm btn-block btn-primary" name="submit"
                                        value="penyerahan">Simpan</button>
                                @else
                                    <button type="button" class="btn btn-sm btn-block btn-primary"
                                        data-toggle="tooltip" title="Konfirmasi Pemesanan Terlebih Dahulu"
                                        disabled>Simpan</button>
                                @endif
                            @endif
                        </th>
                        @if ($is_rawat_inap)
                            <th>
                                @if (!empty($transaksi->transaksi_obat_telaah_obat_penerimaan_perawat))
                                    <small>{{ $transaksi->transaksi_obat_telaah_obat_penerimaan_perawat->telaah_at->format('Y-m-d H:i:s') }}</small>
                                @endif
                            </th>
                        @endif
                    </tr>
                </tfoot>
            </table>
            @if ($is_rawat_inap)
                <div class="float-right">
                    <div class="form-group">
                        <label for="">Kirim Ke Ruangan</label>
                        <br>
                        @if ($transaksi->telaah_kirim_ruangan !== null)
                            <h4>{{ $transaksi->telaah_kirim_ruangan ? 'Ya' : 'Tidak' }}</h4>
                        @else
                            <div class="btn-group">
                                <button type="submit" class="btn btn-sm btn-outline-primary" style="width: 100px"
                                    name="submit" value="kirim_ruangan_ya">Ya</button>
                                <button type="submit" class="btn btn-sm btn-outline-primary" style="width: 100px"
                                    name="submit" value="kirim_ruangan_tidak">Tidak</button>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    @include('farmasi.transaksi.components.tindak-lanjut-container')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @include('farmasi.transaksi.components.ttd-pasien-container')
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-12">
        @include('farmasi.transaksi.components.kirim-pesan-whatsapp')
    </div>
</div>
