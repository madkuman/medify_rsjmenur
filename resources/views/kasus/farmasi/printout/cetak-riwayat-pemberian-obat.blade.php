<head>
    <title>Print Riwayat Pemberian Obat</title>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        tr {
            page-break-inside: auto !important;
        }

        td,
        th {
            font-size: 12px;
        }

        .bold {
            font-weight: bold;
        }

        .centered {
            text-align: center;
        }

        .bot {
            border-bottom: 1px solid black;
        }

        .righted {
            text-align: right;
        }

        .bg {
            background-color: #D0D0D0;
        }

        .bordered {
            border: 1px solid black;
            padding: 10px 5px;
            white-space: pre-line;
        }

        .bordered-y {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            padding: 10px 5px;
            white-space: pre-line;
        }

        .bordered-right {
            border-right: 1px solid black;
            padding: 10px 5px;
            white-space: pre-line;
        }

        .bordered-left {
            border-left: 1px solid black;
            padding: 10px 5px;
            white-space: pre-line;
        }

        .big {
            font-weight: bold;
            font-size: 16px;
            vertical-align: middle;
            text-align: center;
        }

        .un-bot {
            border-bottom: 1px solid white !important;
        }

        .un-top {
            border-top: 1px solid white !important;
        }

        .table-border-collapse {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table-border-collapse td,
        th {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .check {
            font-family: ZapfDingbats, sans-serif;
            text-align: center;
            vertical-align: middle;
        }

        .text-left {
            text-align: left;
        }

        .high-alert {
            border: 1px solid red;
            margin: 3px;
            padding: 2px;
            color: red;
        }

        .bg-danger {
            background-color: #fcd5b4;
        }
    </style>
</head>

<body>
    <h4 style="text-align: center">RIWAYAT PEMBERIAN OBAT</h4>
    <table width="100%" class="table-border-collapse" style="text-align: center">
        <thead style="background-color: #ddd9c4">
            <tr class="border-table">
                <th rowspan="3">NO.</th>
                <th rowspan="3" width="200px">BARANG</th>
                <th rowspan="3" width="50px">Sisa Obat</th>
                <th colspan="25">{{ $carbon_tanggal->format('d/m/Y') }}</th>
            </tr>
            <tr class="border-table">
                <th colspan="5">1 <br>(07.00)</th>
                <th colspan="5">2 <br>(13.00)</th>
                <th colspan="5">3 <br>(19.00)</th>
                <th colspan="5">4 <br>(24.00)</th>
                <th colspan="5">5 <br>(22.00)</th>
            </tr>
            <tr class="border-table">
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
            </tr>
        </thead>
        <tbody>
            @php
                $rowspan = 12;
                if ($format != 'dengan_telaah_obat') {
                    $rowspan = 4;
                }
            @endphp
            @forelse ($list_pemberian_obat as $item)
                <tr>
                    <td rowspan="{{ $rowspan }}">
                        {{ $item['catatan_pengobatan_pasien']->nama_obat }}<br>
                        Satuan : {{ $item['catatan_pengobatan_pasien']->item_master->satuan }}<br>
                        Rute : {{ $item['catatan_pengobatan_pasien']->rute }}<br>
                        Aturan Pakai : {{ $item['catatan_pengobatan_pasien']->aturan_pemakaian }}<br>
                        
                    </td>
                    <td class="bg-danger">SISA OBAT</td>
                    <td class="bg-danger">{{ $item['total_obat'] }}</td>
                    <td class="bg-danger" colspan="5">
                        @if (count($item['aturan_pakai_1']['resep_detail']) != 0)
                            {{ count($item['aturan_pakai_1']['resep_detail']) }}
                        @endif
                    </td>
                    <td class="bg-danger" colspan="5">
                        @if (count($item['aturan_pakai_2']['resep_detail']) != 0)
                            {{ count($item['aturan_pakai_2']['resep_detail']) }}
                        @endif
                    </td>
                    <td class="bg-danger" colspan="5">
                        @if (count($item['aturan_pakai_3']['resep_detail']) != 0)
                            {{ count($item['aturan_pakai_3']['resep_detail']) }}
                        @endif
                    </td>
                    <td class="bg-danger" colspan="5">
                        @if (count($item['aturan_pakai_4']['resep_detail']) != 0)
                            {{ count($item['aturan_pakai_4']['resep_detail']) }}
                        @endif
                    </td>
                    <td class="bg-danger" colspan="5">
                        @if (count($item['aturan_pakai_5']['resep_detail']) != 0)
                            {{ count($item['aturan_pakai_5']['resep_detail']) }}
                        @endif
                    </td>
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
                    if ($format != 'dengan_telaah_obat') {
                        $list_telaah = [];
                    }
                @endphp
                @foreach ($list_telaah as $key_telaah => $item_telaah)
                    <tr>
                        <td colspan="2" class="text-left">{{ $item_telaah }}</td>
                        @foreach (['aturan_pakai_1', 'aturan_pakai_2', 'aturan_pakai_3', 'aturan_pakai_4', 'aturan_pakai_5'] as $aturan)
                            @php
                                $transaksi = $item[$aturan]['resep_detail'][0]->resep->transaksi ?? null;
                            @endphp
                            <td>
                                @if (!empty($transaksi->transaksi_obat_telaah_obat_penyiapan->$key_telaah))
                                    <span class="check">4</span>
                                @endif
                            </td>
                            <td>
                                @if (!empty($transaksi->transaksi_obat_telaah_obat_pengemasan->$key_telaah))
                                    <span class="check">4</span>
                                @endif
                            </td>
                            <td>
                                @if (!empty($transaksi->transaksi_obat_telaah_obat_penyerahan->$key_telaah))
                                    <span class="check">4</span>
                                @endif
                            </td>
                            <td>
                                @if (!empty($transaksi->transaksi_obat_telaah_obat_penerimaan_perawat->$key_telaah))
                                <span class="check">4</span>
                                @endif
                            </td>
                            <td>
                                @if (!empty($transaksi->transaksi_obat_telaah_obat_penerimaan_perawat->$key_telaah))
                                    <span class="check">4</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" class="text-left bg-danger">Jam</td>
                    @foreach (['aturan_pakai_1', 'aturan_pakai_2', 'aturan_pakai_3', 'aturan_pakai_4', 'aturan_pakai_5'] as $aturan)
                        @php
                            $transaksi = $item[$aturan]['resep_detail'][0]->resep->transaksi ?? null;
                        @endphp
                        <td class="bg-danger">
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyiapan))
                                {{ $transaksi->transaksi_obat_telaah_obat_penyiapan->created_at->format('H:i') }}
                            @endif
                        </td>
                        <td class="bg-danger">
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_pengemasan))
                                {{ $transaksi->transaksi_obat_telaah_obat_pengemasan->created_at->format('H:i') }}
                            @endif
                        </td>
                        <td class="bg-danger">
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyerahan))
                                {{ $transaksi->transaksi_obat_telaah_obat_penyerahan->created_at->format('H:i') }}
                            @endif
                        </td>
                        <td class="bg-danger">
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penerimaan_perawat))
                            {{ $transaksi->transaksi_obat_telaah_obat_penerimaan_perawat->created_at->format('H:i') }}
                            @endif
                        </td>
                        <td class="bg-danger">
                            @if (!empty($item[$aturan]['catatan_pengobatan_pasien_detail']))
                                {{ $item[$aturan]['catatan_pengobatan_pasien_detail']->pemberian_at->format('H:i') }}
                            @endif
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td colspan="2" class="text-left">Paraf</td>
                    @foreach (['aturan_pakai_1', 'aturan_pakai_2', 'aturan_pakai_3', 'aturan_pakai_4', 'aturan_pakai_5'] as $aturan)
                        @php
                            $transaksi = $item[$aturan]['resep_detail'][0]->resep->transaksi ?? null;
                        @endphp
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyiapan))
                                {{-- should be paraf --}}
                            @endif
                        </td>
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_pengemasan))
                                {{-- should be paraf --}}
                            @endif
                        </td>
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyerahan))
                                {{-- should be paraf --}}
                            @endif
                        </td>
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penerimaan_perawat))
                            {{-- should be paraf --}}
                            @endif
                        </td>
                        <td>
                            @if (!empty(0))
                            
                            @endif
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td colspan="2" class="text-left">Nama</td>
                    @foreach (['aturan_pakai_1', 'aturan_pakai_2', 'aturan_pakai_3', 'aturan_pakai_4', 'aturan_pakai_5'] as $aturan)
                        @php
                            $transaksi = $item[$aturan]['resep_detail'][0]->resep->transaksi ?? null;
                        @endphp
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyiapan))
                                {{ $transaksi->transaksi_obat_telaah_obat_penyiapan->user_telaah->name }}
                            @endif
                        </td>
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_pengemasan))
                                {{ $transaksi->transaksi_obat_telaah_obat_pengemasan->user_telaah->name }}
                            @endif
                        </td>
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyerahan))
                                {{ $transaksi->transaksi_obat_telaah_obat_penyerahan->user_telaah->name }}
                            @endif
                        </td>
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penerimaan_perawat))
                            {{ $transaksi->transaksi_obat_telaah_obat_penerimaan_perawat->user_telaah->name }}
                            @endif
                        </td>
                        <td>
                            @if (!empty($item[$aturan]))
                                {{ $item[$aturan]['catatan_pengobatan_pasien_detail']->creator->name }}
                            @endif
                        </td>
                    @endforeach
                </tr>
                @if ($item['catatan_pengobatan_pasien']->item_master->attr_is_obat_high_alert)
                <tr>
                    <td rowspan="3">
                        <div class="high-alert">
                            Waspada Obat High Alert
                        </div>
                    </td>
                    <td colspan="2" class="text-left bg-danger">Jam</td>
                    @foreach (['aturan_pakai_1', 'aturan_pakai_2', 'aturan_pakai_3', 'aturan_pakai_4', 'aturan_pakai_5'] as $aturan)
                        @php
                            $transaksi = $item[$aturan]['resep_detail'][0]->resep->transaksi ?? null;
                        @endphp
                        <td class="bg-danger">
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyiapan))
                                {{ $transaksi->transaksi_obat_telaah_obat_penyiapan->created_at->format('H:i') }}
                            @endif
                        </td>
                        <td class="bg-danger">
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_pengemasan))
                                {{ $transaksi->transaksi_obat_telaah_obat_pengemasan->created_at->format('H:i') }}
                            @endif
                        </td>
                        <td class="bg-danger">
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyerahan))
                                {{ $transaksi->transaksi_obat_telaah_obat_penyerahan->created_at->format('H:i') }}
                            @endif
                        </td>
                        <td class="bg-danger">
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penerimaan_perawat))
                            {{ $transaksi->transaksi_obat_telaah_obat_penerimaan_perawat->created_at->format('H:i') }}
                            @endif
                        </td>
                        <td class="bg-danger">
                            @if (!empty($item[$aturan]['catatan_pengobatan_pasien_detail']))
                                {{ $item[$aturan]['catatan_pengobatan_pasien_detail']->pemberian_at->format('H:i') }}
                            @endif
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td colspan="2" class="text-left">Paraf Double Check</td>
                    @foreach (['aturan_pakai_1', 'aturan_pakai_2', 'aturan_pakai_3', 'aturan_pakai_4', 'aturan_pakai_5'] as $aturan)
                        @php
                            $transaksi = $item[$aturan]['resep_detail'][0]->resep->transaksi ?? null;
                        @endphp
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyiapan))
                                {{-- should be paraf --}}
                            @endif
                        </td>
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_pengemasan))
                                {{-- should be paraf --}}
                            @endif
                        </td>
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyerahan))
                                {{-- should be paraf --}}
                            @endif
                        </td>
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penerimaan_perawat))
                            {{-- should be paraf --}}
                            @endif
                        </td>
                        <td>
                            @if (!empty(0))
                            
                            @endif
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td colspan="2" class="text-left">Nama Double Check</td>
                    @foreach (['aturan_pakai_1', 'aturan_pakai_2', 'aturan_pakai_3', 'aturan_pakai_4', 'aturan_pakai_5'] as $aturan)
                        @php
                            $transaksi = $item[$aturan]['resep_detail'][0]->resep->transaksi ?? null;
                        @endphp
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyiapan))
                                {{ $transaksi->transaksi_obat_telaah_obat_penyiapan->user_telaah->name }}
                            @endif
                        </td>
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_pengemasan))
                                {{ $transaksi->transaksi_obat_telaah_obat_pengemasan->user_telaah->name }}
                            @endif
                        </td>
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penyerahan))
                                {{ $transaksi->transaksi_obat_telaah_obat_penyerahan->user_telaah->name }}
                            @endif
                        </td>
                        <td>
                            @if (!empty($transaksi->transaksi_obat_telaah_obat_penerimaan_perawat))
                            {{ $transaksi->transaksi_obat_telaah_obat_penerimaan_perawat->user_telaah->name }}
                            @endif
                        </td>
                        <td>
                            @if (!empty($item[$aturan]))
                                {{ $item[$aturan]['catatan_pengobatan_pasien_detail']->creator->name }}
                            @endif
                        </td>
                    @endforeach
                </tr>
                @endif
            @empty
            <tr>
                <td colspan="28" style="text-align: center">Belum ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div style="font-size: 8pt">
        Keterangan:
        <ol type="a">
            <li>Penyiapan</li>
            <li>Pengecekan</li>
            <li>Penyerahan</li>
            <li>Penerimaan Perawat</li>
            <li>Pemberian Kepada Pasien</li>
        </ol>
    </div>
</body>
