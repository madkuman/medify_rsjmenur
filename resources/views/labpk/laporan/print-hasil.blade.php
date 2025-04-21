<head>
    <title>Hasil Pemeriksaan Laboratorium Klinik</title>
</head>

<style type="text/css">
    .small-col {
        width: 20%;
        background: red;
    }

    .big-col {
        width: 30%;
        background: blue;
    }

    .bold {
        font-weight: bold;
    }

    .table-warning,
    .table-warning>td,
    .table-warning>th {
        background-color: #dcff82;
    }

    .table-danger,
    .table-danger>td,
    .table-danger>th {
        background-color: #ed554c;
    }

    .text-center {
        text-align: center;
    }

    .text-left {
        text-align: left;
    }

    .hasil-pemeriksaan {
        border-collapse: collapse;
    }

    .hasil-pemeriksaan td {
        padding: 5px;
    }

    .hasil-pemeriksaan td {
        border-bottom: solid 1px #ccc;
    }

    .title-border {
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        font-size: 17px;
    }

    hr {
        border: 1px solid #ccc;
    }
</style>
<table width="100%">
    <tr>
        <td width="20%" style="text-align: center;">
            <img src="{{ url('') }}/assets/img/pemprov-jatim.png" height="100">
        </td>
        <td width="60%" style="text-align: center; font-size: 17px;">
            <b>
                PEMERINTAH PROVINSI JAWA TIMUR<br>
                RUMAH SAKIT JIWA MENUR<br>
                Jln Menur No.120, Telp(031)5021635,5021637<br>
                Surabaya
            </b>
        </td>
        <td width="20%" style="text-align: center;">
            <img src="{{ url('') }}/assets/img/menur.png" height="100">
        </td>
    </tr>
</table>
<table width="100%">
    <tr>
        <td class="text-center title-border"><b>HASIL PEMERIKSAAN LABORATORIUM</b></td>
    </tr>
</table>
<br>
<table width="100%" style="margin-bottom: 20px; page-break-after: avoid;">
    <tr>
        <td style="width:20%">Pasien</td>
        <td style="width:30%">: {{ $transaksi->pasien->name }}</td>
        <td style="width:20%">No. Transaksi</td>
        <td style="width:30%">: {{ $transaksi->id }}</td>
    </tr>
    <tr>
        <td>No. RM</td>
        <td>: {{ $transaksi->pasien->no_rm }}</td>
        <td>Tgl. Order</td>
        <td>: {{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
    </tr>
    <tr>
        <td>Tgl. Lahir</td>
        <td>: {{ date('d/m/Y', strtotime($transaksi->pasien->date_of_birth)) }}</td>
        <td>Tgl. Periksa</td>
        <td>:
            @if (!empty($transaksi->verified_at))
                {{ $transaksi->verified_at->format('d/m/Y H:i') }}
            @endif
        </td>
    </tr>
    <tr>
        <td>Jam Diperiksa</td>
        <td>: {{ $transaksi->jam_diperiksa ?? '' }}</td>
        <td>Jam Selesai</td>
        <td>: {{ $transaksi->jam_selesai ?? '' }}</td>
    </tr>
    <tr>
        <td>Usia</td>
        <td>: {{ $transaksi->pasien->age }} Tahun</td>
        <td>Dokter Pengirim</td>
        <td>: {{ $transaksi->creator->name ?? '-' }}</td>
    </tr>
    <tr>
        <td>Jns. Kelamin</td>
        <td>: {{ $transaksi->pasien->jenis_kelamin }}</td>
        <td>Dokter Lab</td>
        <td>: @if (!empty($transaksi->verified_at))
                {{ $transaksi->verificator->name ?? '-' }}
            @else
                -
            @endif
        </td>
    </tr>
    <tr>
        <td>Asuransi</td>
        <td>: {{ $transaksi->pembayaran->perusahaan->nama }}</td>
        <td>Analis</td>
        <td>: {{ $transaksi->result_creator->name ?? '-' }}</td>
    </tr>
    <tr>
        <td>Pelayanan</td>
        <td>: {{ $transaksi->asal['nama'] }}</td>
    </tr>
</table>

<?php $no = 1; ?>
<?php if ($jumlah < 18) {
    $jumlah_halaman = 1;
} else {
    $jumlah_halaman = ceil(($jumlah - 17) / 34 + 1);
} ?>
<?php if ($jumlah < 18) {
    $sisa = $jumlah % 17;
} else {
    $sisa = ($jumlah - 17) % 34;
} ?>
<?php if ($jumlah < 18) {
    $kosongan = (17 - $sisa) % 17;
} else {
    $kosongan = (34 - $sisa) % 34;
} ?>
@if (count($result_parameter) > 0)
    <table style="width: 100vw" class="hasil-pemeriksaan">
        <thead style="border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;padding:5px; ">
            <tr>
                <th class="text-left">Pemeriksaan</th>
                <th class="text-center">Hasil</th>
                <th class="text-center">Satuan</th>
                <th class="text-center">Nilai Rujukan</th>
                <th class="text-center">Nilai Kritis</th>
                <th class="text-center">Metode</th>
            </tr>
        </thead>
        <tbody>
            <?php $current_head = null; ?>
            @foreach ($result_parameter as $index => $result)
                @if (count($result) > 0)
                    <tr>
                        <td colspan="6" class="bold">{{ $hasil[$index]->tarif->deskripsi }}</td>
                    </tr>
                @endif
                @foreach ($result as $row)
                    @if (!empty($row->keterangan_result))
                        @if ($row->keterangan_result == 'kritis')
                            <tr class="table-danger">
                            @elseif($row->keterangan_result == 'bahaya')
                            <tr class="table-warning">
                            @else
                            <tr>
                        @endif
                    @endif
                    <td class="text-left">&nbsp;{{ $row->parameter }}</td>
                    <td class="text-center">{{ $row->value }}</td>
                    <td class="text-center">{{ $row->satuan }}</td>
                    @if ($row->form_type == 'parameter-number')
                        <td class="text-center">{{ $row->referensi_min }} - {{ $row->referensi_max }}</td>
                        <td class="text-center">{{ isset($row->kritis_min) ? "< $row->kritis_min" : '' }} dan
                            {{ isset($row->kritis_max) ? "> $row->kritis_max" : '' }}</td>
                    @elseif($row->form_type == 'parameter-number-greatherthan')
                        <td class="text-center">{{ '>' . $row->referensi_min }}</td>
                        <td class="text-center">
                            @if (!empty($row->kritis_min))
                                {{ '<' . $row->kritis_min }}
                            @endif
                        </td>
                    @elseif($row->form_type == 'parameter-number-lessthan')
                        <td class="text-center">{{ '<' . $row->referensi_max }}</td>
                        <td class="text-center">
                            @if (!empty($row->kritis_max))
                                {{ '>' . $row->kritis_max }}
                            @endif
                        </td>
                    @else
                        <td class="text-center">{{ $row->referensi_lainnya }}</td>
                        <td class="text-center"></td>
                    @endif
                    <td class="text-center">{{ $row->metode ?? '-' }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@endif
@if (count(array_collapse($result_text)) > 0)
    <table style="width: 100vw" class="hasil-pemeriksaan">
        <thead style="border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;padding:5px; ">
            <tr>
                <th class="text-left" style="width: 15%">Pemeriksaan</th>
                <th class="text-left">Hasil</th>
            </tr>
        </thead>
        <tbody>
            <?php $current_head = null; ?>
            @foreach ($result_text as $index => $result)
                @if (count($result) > 0)
                    <tr>
                        <td colspan="2" class="bold">{{ $hasil[$index]->tarif->deskripsi }}</td>
                    </tr>
                @endif
                @foreach ($result as $row)
                    <tr>
                        <td class="text-left" style="vertical-align: top">&nbsp;{{ $row->parameter }}</td>
                        <td class="text-left">{!! nl2br($row->value) !!}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@endif
<p>
    <b>Diagnosa : </b><br>
    {{ $transaksi->diagnosis ?? '' }}
</p>
<p>
    <b>Keterangan Spesimen :</b><br>
    {{ $transaksi->spesimen_terima_keterangan ?? '' }}
</p>
<br><br><br><br>
<table width="100%" style="page-break-inside: avoid;">
    <tr>
        <td width="50%"></td>
        <td width="50%" class="text-center">Dokter Penanggung Jawab Laboratorium</td>
    </tr>
    @if (!empty($transaksi->verified_at))
        @if (isset($transaksi->verificator->ttd) && !empty($transaksi->verificator->ttd))
            <tr>
                <td></td>
                <td class="text-center">
                    <img src="{{ $transaksi->verificator->ttd }}" height="50px">
                </td>
            </tr>
        @else
            <tr>
                <td colspan="2"><br><br><br><br></td>
            </tr>
        @endif
        <tr>
            <td></td>
            <td class="text-center">{{ $transaksi->verificator->name ?? '-' }}</td>
        </tr>
    @else
        <tr>
            <td colspan="2"><br><br><br><br></td>
        </tr>
        <tr>
            <td></td>
            <td class="text-center"></td>
        </tr>
    @endif
</table>
<script type="text/php">
		if ( isset($pdf) ) {
		$x = 475;
		$y = 800;
		$text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
		$font = $fontMetrics->get_font("Arial", "bold");
		$size = 11;
		$color = array(0,0,0);
		$word_space = 0.0;  //  default
		$char_space = 0.0;  //  default
		$angle = 0.0;   //  default
		$pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);

		$x = 30;
		$y = 800;
		$text = "Dicetak pada ".date('d-m-Y h:i', time());
		$font = $fontMetrics->get_font("Arial", "bold");
		$size = 11;
		$color = array(0,0,0);
		$word_space = 0.0;  //  default
		$char_space = 0.0;  //  default
		$angle = 0.0;   //  default
		$pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
	}
</script>
