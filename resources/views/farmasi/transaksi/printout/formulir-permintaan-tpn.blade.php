<!DOCTYPE html>
<html>

<head>
    <title>PELAYANAN OBAT SEDIAAN TPN (TOTAL PARENTERAL NUTRITION)</title>
    <style type="text/css">
        table {
            font-family: sans-serif;
            width: 100%;
            font-size: 11pt;
            border-collapse: collapse;
        }

        .bordered td,
        .bordered th {
            border: 1px solid black;
            padding-left: 5px;
            padding-right: 5px;
        }

        td {
            vertical-align: top;
        }

        .centered td,
        .centered {
            text-align: center;
        }

        .big {
            font-size: 15px;
        }

        .va-mid {
            vertical-align: middle;
        }

        .text-center {
            text-align: center;
        }

        .check {
            font-family: ZapfDingbats, sans-serif;
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <table width="100%">
        <tr>
            <td width="60%">
                <img src="{{ config('app.kop_lg') }}" style="width: 100%">
            </td>
            <td width="40%">
                <table class="bordered centered" style="font-weight: bold">
                    <tr>
                        <td style="padding:15px 0">{{ $transaksi->pembayaran_detail->perusahaan->tipe->nama ?? 'UMUM' }}</td>
                        <td style="padding:15px 0">{{ $transaksi->nomor_antrian }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <hr style="border-top: 3px double black">
    <h4 class="centered">PELAYANAN OBAT SEDIAAN TPN (TOTAL PARENTERAL NUTRITION)</h4>

    <table style="width: 100%;font-size:9pt">
        <tr>
            <td width="100px">Nama Lengkap</td>
            <td width="1">:</td>
            <td width="200px">{{ $transaksi->pasien_detail->name ?? $transaksi->nama_pasien }}</td>
            <td width="100px">Tanggal Permintaan</td>
            <td width="1">:</td>
            <td width="100px">{{ $transaksi->created_at->format('d/M/Y') }}</td>
        </tr>
        <tr>
            <td>Tgl Lahir / No. RM</td>
            <td>:</td>
            <td>{{ $transaksi->pasien_detail->date_of_birth }} / {{ $transaksi->pasien_detail->no_rm ?? '-' }}</td>
            <td>Diagnosis</td>
            <td>:</td>
            <td>{{ $transaksi->kasus->diagnosisUtama->icd10->long_desc }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $transaksi->address }}</td>
            <td>Alergi Obat</td>
            <td>:</td>
            <td>{{ $transaksi->final_detail->resep_detail->first()->tpn_alergi }}</td>
        </tr>
        <tr>
            <td>Ruangan</td>
            <td>:</td>
            <td>{{ $transaksi->kasus->lokasi->lokasi->nama ?? '-' }}</td>
            <td>Berat Badan</td>
            <td>:</td>
            <td>{{ $transaksi->final_detail->resep_detail->first()->tpn_berat_badan ?? '-' }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Status Pembayaran</td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td width="50%" style="padding:0 50px;text-align:center">
                <table border="1" style="text-align: center">
                    <tr>
                        <td>Nama & Paraf Dokter</td>
                    </tr>
                    <tr>
                        <td style="height: 40px;vertical-align: bottom">
                            {{ $transaksi->dokter->name }}
                        </td>
                    </tr>
                </table>
            </td>
            <td width="50%" style="padding:0 50px;text-align:center">
                <table border="1" style="text-align: center">
                    <tr>
                        <td>Nama & Paraf Apoteker</td>
                    </tr>
                    <tr>
                        <td style="height: 40px;vertical-align: bottom">
                            {{ $transaksi->transaksi_obat_telaah_obat_pengemasan->user_telaah->name }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table border="1">
        <tr>
            <th>No</th>
            <th>PERMINTAAN OBAT</th>
            <th>DOSIS</th>
            <th>CATATAN</th>
        </tr>
        @php
            $list_resep_detail = $transaksi->ori_detail->resep_detail;
            # sometimes ori gk punya detail, aneh gaming
            if ($list_resep_detail->count() == 0) {
                if (isset($transaksi->final_detail)) {
                    $list_resep_detail = $transaksi->final_detail->resep_detail;
                }
            }
        @endphp
        @foreach ($list_resep_detail->first()->racikan ?? [] as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->obat_detail->item_detail->nama }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->tpn_catatan }}</td>
            </tr>
        @endforeach
        <tr>
            <td style="background: #ddd" colspan="2">VOLUME TOTAL</td>
            <td style="background: #ddd">{{ $list_resep_detail->first() != null ? $list_resep_detail->first()->racikan->sum('jumlah') : '' }}</td>
            <td></td>
        </tr>
    </table>
    <br>
    <table border="1">
        <tr>
            <th>No</th>
            <th>PENYIAPAN OBAT</th>
            <th>DOSIS YANG DIBUTUHKAN</th>
            <th>CATATAN</th>
        </tr>
        @foreach ($transaksi->final_detail->resep_detail->first()->racikan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->obat_detail->item_detail->nama }}</td>
                <td>{{ $item->dosis }}</td>
                <td></td>
            </tr>
        @endforeach
        <tr>
            <td style="background: #ddd" colspan="2">VOLUME TOTAL</td>
            <td style="background: #ddd">{{ $transaksi->final_detail->resep_detail->first()->racikan->sum('jumlah') }}</td>
            <td></td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td width="60%">
                <table style="font-size: 8pt" border="1">
                    <tr>
                        <th class="text-center">Telaah Obat</th>
                        <th class="text-center">Penyiapan</th>
                        <th class="text-center">Pengemasan</th>
                        <th class="text-center">Penyerahan</th>
                        <th class="text-center">Penerimaan Perawat</th>
                    </tr>
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
                                        <span class="check">4</span>
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                @if (!empty($transaksi->transaksi_obat_telaah_obat_pengemasan))
                                    @if (!empty($transaksi->transaksi_obat_telaah_obat_pengemasan->$key))
                                        <span class="check">4</span>
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                @if (!empty($transaksi->transaksi_obat_telaah_obat_penyerahan))
                                    @if (!empty($transaksi->transaksi_obat_telaah_obat_penyerahan->$key))
                                        <span class="check">4</span>
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                @if (!empty($transaksi->transaksi_obat_telaah_obat_penerimaan_perawat))
                                    @if (!empty($transaksi->transaksi_obat_telaah_obat_penerimaan_perawat->$key))
                                        <span class="check">4</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th>Paraf</th>
                        <th style="height: 30px"></th>
                        <th style="height: 30px"></th>
                        <th style="height: 30px"></th>
                        <th style="height: 30px"></th>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <th>{{ $transaksi->transaksi_obat_telaah_obat_penyiapan->user_telaah->name }}</th>
                        <th>{{ $transaksi->transaksi_obat_telaah_obat_pengemasan->user_telaah->name }}</th>
                        <th>{{ $transaksi->transaksi_obat_telaah_obat_penyerahan->user_telaah->name }}</th>
                        <th>{{ $transaksi->transaksi_obat_telaah_obat_penerimaan_perawat->user_telaah->name }}</th>
                    </tr>
                </table>
            </td>
            <td width="40%">
                <table style="font-size: 8pt">
                    <tr>
                        <td width="100px">BUD / Pukul</td>
                        <td width="1">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Rute Pemberian</td>
                        <td>:</td>
                        <td>{{ $transaksi->final_detail->resep_detail->first()->tpn_rute_pemberian }}</td>
                    </tr>
                    <tr>
                        <td>Aturan Pemakaian</td>
                        <td>:</td>
                        <td>{{ $transaksi->final_detail->resep_detail->first()->tpn_aturan_penggunaan }}</td>
                    </tr>
                    <tr>
                        <td>Obat Selesai Penyiapan</td>
                        <td>:</td>
                        <td>{{ $transaksi->transaksi_obat_telaah_obat_penyiapan->created_at }}</td>
                    </tr>
                    <tr>
                        <td>Obat Diterima Ruangan</td>
                        <td>:</td>
                        <td>{{ $transaksi->transaksi_obat_telaah_obat_penerimaan_perawat->created_at }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
