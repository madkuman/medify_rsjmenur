@php
    global $flag;
@endphp
<form method="POST" action="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/payment') }}" id="form-payment">
    {{ csrf_field() }}

    <div class="autoscroll-x" style="display: none">
        <table class="table table-vcenter">
            <thead>
                <tr>
                    <th style="min-width: 50px;">No.</th>
                    <th style="min-width: 280px;">Barang</th>
                    <th style="min-width: 100px;">Jumlah</th>
                    <th style="min-width: 80px;">Aturan</th>
                    @if (!empty($transaksi->dikerjakan_at))
                        <th style="min-width: 100px;">Kadaluarsa</th>
                    @endif
                    <th style="min-width: 100px;" class="text-right">Harga.Jual</th>
                    @if (empty($transaksi->dikerjakan_at))
                        <th style="min-width: 150px;" class="text-center">Laba</th>
                    @endif
                    <th style="min-width: 100px;" class="text-right">Embalase</th>
                    <th style="min-width: 100px;" class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $total = 0;
                    $flag = 0;
                    $retur = 0;
                    $total_harga_7 = 0;
                @endphp
                @if (empty($transaksi->dikerjakan_at))
                    @foreach ($transaksi->final_detail->resep_detail as $detail)
                        @if ($detail->tipe)
                            <tr>
                                @php
                                    $laba = 0;
                                    $laba_default = 0;
                                    $is_laba_set = false;
                                    $harga_racikan = 0;
                                    $stok_racikan = 0;
                                    $jumlah_racikan = 0;
                                    $r = 0;
                                @endphp
                                <td>{{ ++$i }}</td>
                                <td>
                                    <div>
                                        <div style="white-space: pre-line">{{ $detail->nama_obat }}</div>
                                        @if ($detail->resep_detail->is_kemo)
                                            Infus: {{ $detail->obat_detail->item_detail->nama }} (vol :
                                            {{ $detail->volume_infus }})
                                            @if ($detail->obat_detail->stok < $detail->jumlah)
                                                @php $stok_racikan++ @endphp
                                            @endif
                                            Vol pelarut: {{ $detail->volume_pelarut }}
                                            Dosis: {{ $detail->dosis }}
                                            Cara Pemberian: {{ $detail->satuan_penggunaan }}
                                            {{ $detail->lama_pemberian }}
                                            Nama Dagang: {{ $detail->dagang }}
                                            Nama Pabrik: {{ $detail->pabrik }}
                                            Batch: {{ $detail->batch }}
                                            ED: {{ $detail->exp_date }}
                                            Penyimpanan: {{ $detail->kondisi }} {{ $detail->penyimpanan }}
                                            Stabilitas:{{ $detail->stabilitas_time }} {{ $detail->stabilitas_date }}
                                        @endif
                                        @if (
                                            $transaksi->pembayaran_detail &&
                                                $transaksi->pembayaran_detail->perusahaan->tipe->slug == 'bpjs' &&
                                                $farmasi->perharian)
                                    </div>
                                    (7 Hari : {{ $detail->hari7 }}, 23 Hari : {{ $detail->hari23 }}, Dukungan RS :
                                    {{ $detail->dukunganrs ? $detail->dukunganrs : '-' }})
                        @endif
                        <hr class="py-0 my-0">
                        <div>
                            @forelse($detail->racikan as $kan)
                                <div>{{ $kan->obat_detail->item_detail->nama }} : {{ $kan->jumlah }} @if ($kan->obat_detail->stok < $kan->jumlah)
                                        (Stok Kurang)
                                    @endif
                                </div>
                                @php $harga_racikan += $kan->obat_detail->item_detail->harga * $kan->jumlah @endphp
                                @if ($kan->obat_detail->stok < $kan->jumlah)
                                    @php $stok_racikan++ @endphp
                                @endif
                                <span id="jumlah-{{ $i }}-{{ $r }}"
                                    style="display: none">{{ $kan->jumlah }}</span>
                                <span id="harga-beli-{{ $i }}-{{ $r }}"
                                    style="display: none">{{ $kan->obat_detail->item_detail->harga }}</span>
                                @php
                                    $r++;
                                    $total_harga_7 += $detail->hari7 * $kan->obat_detail->item_detail->harga;
                                @endphp
                            @empty - @php $flag++ @endphp
                            @endforelse
                        </div>
                        </td>
                        @foreach (session('farmasi')->aturan_harga as $atur)
                            @if ($detail->jumlah == 0)
                                @php
                                    $laba = 0;
                                    break;
                                @endphp
                            @elseif(
                                $transaksi->pembayaran_detail &&
                                    $harga_racikan / $detail->jumlah >= $atur->harga_min &&
                                    $harga_racikan / $detail->jumlah <= $atur->harga_max &&
                                    $transaksi->pembayaran_detail->perusahaan->type == $atur->perusahaan_tipe_id)
                                @php
                                    $is_laba_set = true;
                                    $laba = $atur->laba;
                                    break;
                                @endphp
                            @endif
                            @if (
                                $harga_racikan / $detail->jumlah >= $atur->harga_min &&
                                    $harga_racikan / $detail->jumlah <= $atur->harga_max &&
                                    0 == $atur->perusahaan_tipe_id)
                                @php $laba_default=$atur->laba;@endphp
                            @endif
                        @endforeach
                        @if (!$is_laba_set)
                            @php $laba = $laba_default; @endphp
                        @endif
                        <td>
                            {{ $detail->jumlah }} {{ $detail->satuan ? $detail->satuan : '-' }}
                            @if (!empty($detail->jumlah_diambil))
                                <br>
                                <b>Jumlah Awal: {{ $detail->jumlah_awal }} {{ $detail->satuan ?? '' }}</b>
                                <br>
                                <b>Telah Diambil: {{ $detail->jumlah_diambil }} {{ $detail->satuan ?? '' }}</b>
                            @endif
                            @if ($stok_racikan)
                                <br> (Stok Kurang)
                                @php $flag++ @endphp
                            @endif
                            <h5 id="racik-{{ $i }}" hidden>{{ $r }}</h5>
                            <h5 id="jumlah-{{ $i }}" hidden>{{ $detail->jumlah }}</h5>
                            <h5 id="jumlah-asal-{{ $i }}" hidden>{{ $detail->detail_asal->jumlah }}</h5>
                        </td>
                        <td style="white-space: pre">{{ $detail->aturan }} {{ $detail->satuan_penggunaan }}</td>
                        <td class="text-right" id="harga-{{ $i }}">
                        </td>
                        <td class="text-center">
                            <input type="number" class="form-control input-diskon d-none"
                                id="diskon-{{ $i }}" name="laba[]" value="{{ $laba }}"
                                placeholder="Diskon" onchange="changeTotal()">
                            <a href="javascript:void(0)" class="no-border editable editable-click">{{ $laba }}
                                %</a>
                        </td>
                        <td class="text-center">
                            <input type="number" class="form-control input-embalase d-none"
                                id="embalase-{{ $i }}" name="embalase[]" value="{{ $detail->embalase }}"
                                placeholder="Embalase" onchange="changeTotal()">
                            <a href="javascript:void(0)"
                                class="no-border editable editable-click">{{ $detail->embalase }}</a>
                        </td>
                        <td class="text-right" id="subtotal-{{ $i }}">

                        </td>
                        </tr>
                    @elseif(is_null($detail->obat_detail))
                        <tr>
                            @php $flag++ @endphp
                            <td>{{ ++$i }}</td>
                            <td>{{ $detail->nama_obat }} <br> (Obat Tidak Tersedia di Farmasi Ini)</td>
                            <td>
                                {{ $detail->jumlah }} {{ $detail->satuan }}
                            </td>
                            <td style="white-space: pre">{{ $detail->aturan }} {{ $detail->satuan_penggunaan }}</td>
                            <td class="text-right">Rp.-</td>
                            <td class="text-right">0%</td>
                            <td class="text-right">Rp.-</td>
                            <td class="text-right">Rp.-</td>
                        </tr>
                    @else
                        <tr>
                            @php
                                $laba = 0;
                                $laba_default = 0;
                                $is_laba_set = false;
                            @endphp
                            @foreach (session('farmasi')->aturan_harga as $atur)
                                @if (
                                    $transaksi->pembayaran_detail &&
                                        $detail->obat_detail->item_detail->harga >= $atur->harga_min &&
                                        $detail->obat_detail->item_detail->harga <= $atur->harga_max &&
                                        $transaksi->pembayaran_detail->perusahaan->type == $atur->perusahaan_tipe_id)
                                    @php
                                        $is_laba_set = true;
                                        $laba = $atur->laba;
                                        break;
                                    @endphp
                                @endif
                                @if (
                                    $detail->obat_detail->item_detail->harga >= $atur->harga_min &&
                                        $detail->obat_detail->item_detail->harga <= $atur->harga_max &&
                                        0 == $atur->perusahaan_tipe_id)
                                    )
                                    @php $laba_default=$atur->laba;@endphp
                                @endif
                            @endforeach
                            @if (!$is_laba_set)
                                @php $laba = $laba_default; @endphp
                            @endif
                            <td>{{ ++$i }}</td>
                            <td>
                                {{ $detail->nama_obat }}
                                @if (
                                    $transaksi->pembayaran_detail &&
                                        $transaksi->pembayaran_detail->perusahaan->tipe->slug == 'bpjs' &&
                                        $farmasi->perharian)
                                    <br>(7 Hari : {{ $detail->hari7 }}, 23 Hari : {{ $detail->hari23 }}, Dukungan RS :
                                    {{ $detail->dukunganrs ? $detail->dukunganrs : '-' }})
                                @endif
                            </td>
                            <td>
                                {{ $detail->jumlah }} {{ $detail->satuan ?? '' }}
                                @if (!empty($detail->jumlah_diambil))
                                    <br>
                                    <b>Jumlah Awal: {{ $detail->jumlah_awal }} {{ $detail->satuan ?? '' }}</b>
                                    <br>
                                    <b>Telah Diambil: {{ $detail->jumlah_diambil }} {{ $detail->satuan ?? '' }}</b>
                                @endif
                                @if ($detail->obat_detail->stok < $detail->jumlah)
                                    <br> (Stok Kurang)
                                    @php $flag++ @endphp
                                @endif
                                <h5 id="jumlah-{{ $i }}" hidden>{{ $detail->jumlah }}</h5>
                                <h5 id="harga-beli-{{ $i }}" hidden>
                                    {{ $detail->obat_detail->item_detail->harga }}</h5>
                            </td>
                            <td style="white-space: pre">{{ $detail->aturan }} {{ $detail->satuan_penggunaan }}</td>
                            <td class="text-right" id="harga-{{ $i }}">
                                Rp. {{ number_format(($detail->obat_detail->item_detail->harga * (100 + $laba)) / 100) }}
                            </td>
                            @php
                                $subtotal = 0;
                                $subtotal =
                                    (($detail->obat_detail->item_detail->harga * (100 + $laba)) / 100) *
                                    $detail->jumlah;
                            @endphp
                            <td class="text-center">
                                {{-- <input type="number" class="editable editable-click" id="diskon-{{$i}}" value="0" onchange="changeSubtotal({{$i}})"> --}}
                                <input type="number" class="form-control input-diskon d-none"
                                    id="diskon-{{ $i }}" name="laba[]" value="{{ $laba }}"
                                    placeholder="Diskon" onchange="changeTotal()">
                                <a href="javascript:void(0)"
                                    class="no-border editable editable-click">{{ $laba }} %</a>
                            </td>
                            <td class="text-center">
                                <input type="number" class="form-control input-embalase d-none"
                                    id="embalase-{{ $i }}" name="embalase[]"
                                    value="{{ $detail->embalase }}" placeholder="Embalase" onchange="changeTotal()">
                                <a href="javascript:void(0)"
                                    class="no-border editable editable-click">{{ $detail->embalase }}</a>
                            </td>
                            <td class="text-right" id="subtotal-{{ $i }}">
                                Rp.
                                {{ number_format((($detail->obat_detail->item_detail->harga * (100 + $laba)) / 100) * $detail->jumlah) }}
                            </td>
                            @php
                                $total += $subtotal;
                                if ($detail->hari7) {
                                    $total_harga_7 +=
                                        ($detail->hari7 * $detail->obat_detail->item_detail->harga * (100 + $laba)) /
                                        100;
                                }
                            @endphp
                        </tr>
                    @endif
                @endforeach
            @elseif(!empty($transaksi->dikerjakan_at))
                @foreach ($transaksi->final_detail->resep_detail as $detail)
                    @if ($detail->tipe)
                        @php
                            $laba = 0;
                            $laba_default = 0;
                        @endphp
                        @php $laba = empty($detail->laba) ? 0 : $detail->laba; @endphp
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>
                                {{ $detail->nama_obat }}
                                @forelse($detail->racikan as $kan)
                                    <li>{{ $kan->obat_detail->item_detail->nama }} : {{ $kan->jumlah }} </li>
                                @empty
                                @endforelse
                                @if ($detail->hari7)
                                    <br>(7 Hari : {{ $detail->hari7 }}, 23 Hari :
                                    {{ $detail->hari23 ? $detail->hari23 : '-' }}, Dukungan RS :
                                    {{ $detail->dukunganrs ? $detail->dukunganrs : '-' }})
                                @endif
                            </td>
                            <td>
                                {{ $detail->jumlah }} {{ $detail->satuan }}
                            </td>
                            <td style="white-space: pre">{{ $detail->aturan }} {{ $detail->satuan_penggunaan }}</td>
                            <td>-</td>
                            <td class="text-right">
                                Rp. {{ number_format($detail->harga) }}
                            </td>
                            <td class="text-rigth">
                                Rp. {{ number_format($detail->embalase) }}
                            </td>
                            @php
                                $subtotal = 0;
                                $subtotal = $detail->subtotal;
                            @endphp
                            <td class="text-right">
                                Rp. {{ number_format($detail->subtotal) }}
                            </td>
                            @php
                                $total += $subtotal;
                                if ($detail->hari7) {
                                    $total_harga_7 += $detail->hari7 * $detail->harga;
                                }
                            @endphp
                        </tr>
                    @else
                        @php $laba=0; @endphp
                        @php $laba = empty($detail->laba) ? 0 : $detail->laba; @endphp
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>
                                {{ $detail->nama_obat }}
                                @if (
                                    $transaksi->pembayaran_detail &&
                                        $transaksi->pembayaran_detail->perusahaan->tipe->slug == 'bpjs' &&
                                        $farmasi->perharian)
                                    <br>(7 Hari : {{ $detail->hari7 }}, 23 Hari :
                                    {{ $detail->hari23 ? $detail->hari23 : '-' }}, Dukungan RS :
                                    {{ $detail->dukunganrs ? $detail->dukunganrs : '-' }})
                                @endif
                            </td>
                            <td>
                                @php $ctr = 0 @endphp
                                @foreach ($detail->log as $row)
                                    @if ($ctr)
                                        <br>
                                    @endif
                                    {{ $row->jumlah - $row->jumlah_retur }} {{ $detail->satuan }}
                                    @php $ctr++ @endphp
                                @endforeach
                            </td>
                            <td style="white-space: pre">{{ $detail->aturan }}</td>
                            <td>
                                @php $ctr = 0 @endphp
                                @foreach ($detail->log as $row)
                                    @if (!is_null($row->jumlah_retur))
                                        @php $retur++ @endphp
                                    @endif
                                    @if ($ctr)
                                        <br>
                                    @endif
                                    {{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}
                                    @php $ctr++ @endphp
                                @endforeach
                            </td>
                            <td class="text-right">
                                Rp. {{ number_format($detail->harga) }}
                            </td>
                            <td class="text-rigth">
                                Rp. {{ number_format($detail->embalase) }}
                            </td>
                            @php $subtotal = 0; @endphp
                            <td class="text-right">
                                @php $ctr = 0 @endphp
                                @foreach ($detail->log as $row)
                                    @if ($ctr)
                                        <br>
                                    @endif
                                    @php
                                        $subtotal = 0;
                                        $subtotal = $detail->subtotal;
                                    @endphp
                                    Rp. {{ number_format(($row->jumlah - $row->jumlah_retur) * $detail->harga) }}
                                    @php $ctr++ @endphp
                                @endforeach
                            </td>
                            @php
                                $total += $subtotal;
                                if ($detail->hari7) {
                                    $total_harga_7 += $detail->hari7 * $detail->harga;
                                }
                            @endphp
                        </tr>
                    @endif
                @endforeach
                @endif
                <tr class="table-success">
                    {{-- @if ($transaksi->status == 1) <td></td> @endif --}}
                    <td colspan="7" class="text-right font-w600">GRAND TOTAL :</td>
                    <td class="text-right" id="subtotal-harga">Rp. {{ number_format($transaksi->total_biaya_obat) }}
                    </td>
                </tr>
                <tr>
                    {{-- @if ($transaksi->status == 1) <td></td> @endif --}}
                    <td colspan="7" class="text-right font-w600">SUBTOTAL EMBALASE :</td>
                    <td class="text-right">
                        @if (empty($transaksi->dikerjakan_at))
                            <span id="total-embalase">Rp {{ $transaksi->embalase }}</span>
                        @else
                            Rp. {{ number_format($transaksi->embalase) }}
                        @endif
                    </td>
                </tr>
                @if (!empty($transaksi->status_retur))
                    <tr>
                        <td colspan="7" class="text-right font-w600">TOTAL RETUR:</td>
                        <td class="text-right">Rp.
                            {{ $transaksi->total_retur ? number_format($transaksi->total_retur) : '-' }}</td>
                    </tr>
                @endif
                <tr>
                    {{-- @if ($transaksi->status == 1) <td></td> @endif --}}
                    <td colspan="7" class="text-right font-w600">SUBTOTAL OBAT :</td>
                    <td class="text-right" id="subtotal-obat-harga">Rp.
                        {{ number_format($transaksi->total_biaya_obat - $transaksi->embalase + $transaksi->total_retur) }}
                    </td>
                </tr>
                @if (
                    $transaksi->pembayaran_detail &&
                        $transaksi->pembayaran_detail->perusahaan->tipe->slug == 'bpjs' &&
                        $farmasi->perharian)
                    <tr>
                        {{-- @if ($transaksi->status == 1) <td></td> @endif --}}
                        <td colspan="7" class="text-right font-w600">Total 7 HARI:</td>
                        <td class="text-right" id="subtotal-harga">Rp. {{ number_format($total_harga_7) }}</td>
                    </tr>
                @endif
                @if (!empty($transaksi->dikerjakan_at))
                    <tr>
                        {{-- @if ($transaksi->status == 1) <td></td> @endif --}}
                        <td colspan="7" class="text-right font-w600">TUJUAN PEMBAYARAN :</td>
                        <td class="text-right">
                            @if ($transaksi->status_kasir == 1) KASIR
                            @elseif(!empty($transaksi->final_detail->resep_detail[0]->kasus_tagihan_detail_id))
                                KASUS
                            @else
                                FARMASI
                            @endif
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    @include('farmasi.transaksi.modals.modal-normal')


    @if (!empty($transaksi->dikerjakan_at) && 0)
        <div class="row">
            <div class="col-12">
                <div class="block">
                    <div class="block-content">
                        @php $lima_benar_done = 0 @endphp
                        @if (!empty($transaksi->lima_benar_at)) @php $lima_benar_done = 1 @endphp
                        @endif
                        <div class="mb-10">
                            <span class="h5 mr-10">5 Benar</span>
                            <button type="button" class="btn btn-secondary" id="btn-edit-5-benar"
                                @if (!$lima_benar_done && Auth::user()->id != $transaksi->lima_benar_created_by) style="display: none" @endif>Edit</button>
                            @if ($lima_benar_done)
                                <span>
                                    {{ $transaksi->lima_benar_creator->name }},
                                    {{ $transaksi->lima_benar_at->format('d F Y, H :i') }}
                                </span>
                            @endif
                            <hr>
                        </div>
                        @if ($lima_benar_done)
                            <div class="row" id="lima-benar-display">
                                <div class="col-12">
                                    @if ($transaksi->lima_benar_pasien == 1) <i
                                            class="fa fa-check"></i>
                                    @else
                                        <i class="fa fa-remove"></i>
                                    @endif Pasien<br>
                                    @if ($transaksi->lima_benar_obat == 1) <i
                                            class="fa fa-check"></i>
                                    @else
                                        <i class="fa fa-remove"></i>
                                    @endif Obat<br>
                                    @if ($transaksi->lima_benar_dosis == 1) <i
                                            class="fa fa-check"></i>
                                    @else
                                        <i class="fa fa-remove"></i>
                                    @endif Dosis<br>
                                    @if ($transaksi->lima_benar_aturan == 1) <i
                                            class="fa fa-check"></i>
                                    @else
                                        <i class="fa fa-remove"></i>
                                    @endif Aturan Makan<br>
                                    @if ($transaksi->lima_benar_waktu == 1) <i
                                            class="fa fa-check"></i>
                                    @else
                                        <i class="fa fa-remove"></i>
                                    @endif Waktu Pemberian Obat<br>
                                </div>
                            </div>
                        @endif

                        <div class="row" id="lima-benar-form"
                            @if ($lima_benar_done) style="display: none" @endif>
                            <div class="col-12">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input benar_pasien_yes"
                                        name="benar_pasien" value="yes"
                                        @if ($lima_benar_done) disabled 
                                @if ($transaksi->lima_benar_pasien == 1) checked="" @endif
                                    @else checked @endif
                                    >
                                    <span class="css-control-indicator"></span> Pasien
                                </label>
                            </div>
                            <div class="col-12">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input benar_dosis_yes"
                                        name="benar_dosis" value="yes"
                                        @if ($lima_benar_done) disabled 
                                @if ($transaksi->lima_benar_dosis == 1) checked="" @endif
                                    @else checked @endif
                                    >
                                    <span class="css-control-indicator"></span> Dosis
                                </label>
                            </div>
                            <div class="col-12">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input benar_wpo_yes" name="benar_wpo"
                                        value="yes"
                                        @if ($lima_benar_done) disabled 
                                @if ($transaksi->lima_benar_waktu == 1) checked="" @endif
                                    @else checked @endif
                                    >
                                    <span class="css-control-indicator"></span> Waktu Pemberian Obat
                                </label>
                            </div>
                            <div class="col-12">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input benar_obat_yes" name="benar_obat"
                                        value="yes"
                                        @if ($lima_benar_done) disabled 
                                @if ($transaksi->lima_benar_obat == 1) checked="" @endif
                                    @else checked @endif
                                    >
                                    <span class="css-control-indicator"></span> Obat
                                </label>
                            </div>
                            <div class="col-12">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input benar_am_yes" name="benar_am"
                                        value="yes"
                                        @if ($lima_benar_done) disabled 
                                @if ($transaksi->lima_benar_aturan == 1) checked="" @endif
                                    @else checked @endif
                                    >
                                    <span class="css-control-indicator"></span> Aturan Minum
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 pt-10">
                                <button type="button" class="btn btn-secondary" id="btn-edit-cancel-5-benar"
                                    @if (!$lima_benar_done) style="display: none" @endif
                                    style="display: none">Batal</button>
                                <button type="button" class="btn btn-primary" id="btn-submit-5-benar"
                                    @if ($lima_benar_done) style="display: none" @endif>Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @php $status_bayar = 1 @endphp
    @if ($transaksi->status_kasir == 1)
        @php
            $status_bayar = 0;
            $total_pemasukan = count($transaksi->piutang->pemasukan ?? []);
            if ($total_pemasukan > 0) {
                $status_bayar = 1;
            } else {
                $status_bayar = 0;
            }
        @endphp
    @endif

    @if ($transaksi->status_kasir == 1)
        @if (empty($transaksi->dikerjakan_at))
            <div class="alert alert-success" role="alert" id="notif-kasir">
                <p>Tagihan berhasil dikirim ke Kasir.</p>
                @if ($status_bayar == 0)
                    <button type="button" class="btn btn-danger" id="btnBatalKirimKasir">Batalkan Transaksi
                        Kasir</button>
                @else
                    <button class="btn btn-success" disabled>Tagihan telah dibayar</button>
                @endif
            </div>
        @endif
    @else
        @if (empty($transaksi->dikerjakan_at) && count($transaksi->copy_resep) == 0)
            <div class="row" id="tujuan-pembayaran">
                <div class="col-12">
                    <div class="block">
                        <div class="block-content">
                            <div class="form-group" id="tujuan-bayar">
                                <label for="tipe_layanan">Tujuan Pembayaran</label>
                                <br>
                                <label class="css-control css-control-primary css-radio">
                                    <input type="radio" class="css-control-input" name="kirim_tagihan"
                                        id="tagihanKasir" value="0" required="">
                                    <span class="css-control-indicator"></span>Kasir
                                </label>
                                @if (!empty($kasus))
                                    <label class="css-control css-control-primary css-radio">
                                        <input type="radio" class="css-control-input" name="kirim_tagihan"
                                            id="tagihanKasus" value="1" required="">
                                        <span class="css-control-indicator"></span>Kasus
                                    </label>
                                @endif
                                <label class="css-control css-control-primary css-radio">
                                    <input type="radio" class="css-control-input" name="kirim_tagihan"
                                        id="tagihanFarmasi" value="2" required="">
                                    <span class="css-control-indicator"></span>Farmasi
                                </label>
                            </div>
                            @if ($transaksi->status_kasir == 0)
                                <div class="row">
                                    <div class="col-2 pt-10">
                                        <button type="button" class="btn btn-primary" id="btn-kirim-kasir">Kirim ke
                                            Tagihan</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif



    @if (empty($transaksi->dikerjakan_at) && count($transaksi->copy_resep) == 0)
        <div class="mt-30 ">
            <div class="form-group row">
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-square float-right"
                        @if ($status_bayar == 0) disabled @else id="btnConfirm" @endif>
                        Konfirmasi Pesanan
                    </button>

                    @if ($transaksi->status_kasir != 1)
                        <button type="submit" class="btn btn-warning" form="form-batal-konfirmasi-permintaan">Batal
                            Konfirmasi Permintaan</button>
                    @endif
                </div>
                @if ($transaksi->status_kasir == 1)
                    @if ($status_bayar == 0)
                        <div class="col-12 mt-5">
                            <div class="badge badge-danger float-right">Tagihan Kasir Belum Lunas</div>
                        </div>
                    @else
                        <div class="col-12 mt-5">
                            <div class="badge badge-success float-right">Tagihan Kasir Telah Lunas</div>
                        </div>
                    @endif
                @endif
                @if ($fyi)
                    <div class="col-12">
                        <div class="bg-warning float-right">*Pasien ini telah melakukan transaksi hari ini</div>
                    </div>
                @endif

            </div>
        </div>
    @endif
</form>
@if (!empty($transaksi->dikerjakan_at))
    <div style="position: relative;">
        <img src="{{ asset('assets/img/paid_stamp.png') }}" width="130"
            style="position: absolute; top: -90px; left: 20px;z-index:1004">
    </div>
@endif
@if (count($transaksi->copy_resep) == 0 && $transaksi->retur->count() == 0)
    @if ($transaksi->status_kasir != 1)
        <br>
        <button type="submit" class="btn btn-warning mt-3" form="form-batal-konfirmasi-pemesanan">Batal Konfirmasi
            Pemesanan</button>
    @endif
@endif
<form method="POST"
    action="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/batal-konfirmasi-permintaan') }}"
    id="form-batal-konfirmasi-permintaan">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $transaksi->id }}">
</form>
<form method="POST"
    action="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/batal-konfirmasi-pemesanan') }}"
    id="form-batal-konfirmasi-pemesanan">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $transaksi->id }}">
</form>
