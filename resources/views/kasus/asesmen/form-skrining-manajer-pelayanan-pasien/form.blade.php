@section('css')
    <style type="text/css">
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            width: 100%;
        }

        table,
        tr,
        td {
            vertical-align: middle;
            border-collapse: collapse;
        }

        td {
            padding: 0 10px;
        }

        .table-padding td {
            padding: 5px 10px;
        }

        .table-bordered tr,
        .table-bordered td {
            border: 1px solid #000;
        }

        .bordered {
            border: 1px solid #000;
        }

        .border-bottom-0 {
            border-bottom: none;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .border-bottom-0 {
            border-bottom: none;
        }

        label {
            font-weight: 400;
        }
    </style>
@endsection

<input type="hidden" name="id" value="" id="id">
<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
    {{ csrf_field() }}

    <table>
        <tr>
            <td width="80%"> </td>
            <td class="bordered border-bottom-0 text-center">
                <span>RM.30</span>
            </td>
        </tr>
        <tr>
            <td width="80%"> </td>
            <td class="bordered border-bottom-0 text-center">
                <span><em>Halaman 1/1</em></span>
            </td>
        </tr>
    </table>

    <!-- HEADER -->
    <table class="bordered border-bottom-0">
        <tr>
            <td width="60%" style="">
                <table class="">
                    <tr>
                        <td width="18%" style="text-align: right;">
                            <img src="{{ url('') }}/assets/img/pemprov-jatim.png" height="55" loading="lazy">
                        </td>
                        <td width="62%" style="text-align: center; font-size: 11px;">
                            <b>
                                PEMERINTAH PROVINSI JAWA TIMUR<br>
                                RUMAH SAKIT JIWA MENUR<br>
                                Jl Menur No.120, Telp(031) 5021635-5021637<br>
                                Surabaya
                            </b>
                        </td>
                        <td width="20%" style="text-align: left;">
                            <img src="{{ url('') }}/assets/img/menur.png" height="55" loading="lazy">
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td><span>No. RM</span></td>
                        <td width="2%"><span>:</span></td>
                        <td> {{ optional($kasus->pasien)->no_rm }} </td>
                    </tr>
                    <tr>
                        <td><span>Nama</span></td>
                        <td><span>:</span></td>
                        <td> {{ optional($kasus->pasien)->name }} </td>
                    </tr>
                    <tr>
                        <td><span>Tgl lahir / umur</span></td>
                        <td><span>:</span></td>
                        <td> {{ optional($kasus->identitas)->tanggal }} / {{ optional($kasus->identitas)->age }} </td>
                    </tr>
                    <tr>
                        <td><span>Jenis kelamin</span></td>
                        <td><span>:</span></td>
                        <td> {{ optional($kasus->pasien)->jenis_kelamin }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="bordered border-bottom-0">
        <tr>
            <td class="text-center">
                <h5 class="mb-0">FORM SKRINING MANAJER PELAYANAN PASIEN (MPP)</h5>
            </td>
        </tr>
    </table>

    <table class="bordered border-bottom-0">
        <tr>
            <td width="20%">Dx Medis</td>
            <td width="5%">:</td>
            <td>
                <input type="text" name="dx_medis" class="form-control">
            </td>
        </tr>

        <tr>
            <td width="20%">Tanggal</td>
            <td width="5%">:</td>
            <td>
                <input type="date" name="tanggal" class="form-control">
            </td>
        </tr>

        <tr>
            <td width="20%">MPP</td>
            <td width="5%">:</td>
            <td>
                <input type="text" name="mpp" class="form-control">
            </td>
        </tr>
    </table>

    @php
        $risiko = [['Pelayanan inadequat', 'Risiko readmisi', 'Risiko komplain', ''], ['Pasien tanpa asuransi dengan sumber daya tinggi', 'Pasien dengan asuransi kesehatan dengan minimal coverage', 'Pasien dengan pembayar yang belum jelas', ''], ['Kasus multidiagnosis', 'Kasus multiprovider', 'Mendapatkan banyak tindakan medis', ''], ['Rencana rawat lebih dari rencana rawat dalam Clinical Pathway', 'Kasus yang diprediksi membutuhkan waktu lebih dari ', ''], ['Ada riwayat dan risiko penelantaran', 'Pasien tanpa identitas', 'Pasien upaya bunuh diri, riwayat lari, pasung*', '']];
    @endphp

    <table class="table-bordered table-padding">
        <tr>
            <td colspan="3">
                <strong>Berikan tanda √ pada pilihan data risiko yang sesuai</strong>
            </td>
        </tr>

        <tr class="text-center">
            <td><strong>NO</strong></td>
            <td><strong>DATA RISIKO</strong></td>
            <td><strong>KET.</strong></td>
        </tr>

        @foreach ($risiko as $index => $list)
            @foreach ($list as $list_index => $list_item)
                <tr class="risiko-input">
                    <!-- nomor urut -->
                    @if ($list_index === 0)
                        <td rowspan="{{ count($list) }}" class="text-center">
                            {{ $index + 1 }}
                        </td>
                    @endif

                    <td>
                        <div class="form-check ml-2" style="vertical-align: middle">
                            <!-- checkbox -->
                            <input class="form-check-input risiko-check @if ($index === 3 && $list_index === 1) mt-3 @endif" type="checkbox"
                                name="risiko[row_{{ $index }}][col_{{ $list_index }}][check]"
                                data-row="{{ $index }}" data-col="{{ $list_index }}">

                            @if (!empty($list_item))
                                <input class="risiko-text" type="hidden"
                                    name="risiko[row_{{ $index }}][col_{{ $list_index }}][text]"
                                    value="{{ $list_item }}" data-row="{{ $index }}"
                                    data-col="{{ $list_index }}">

                                <label class="form-check-label">
                                    {{ $list_item }}
                                </label>

                                @if ($index === 3 && $list_index === 1)
                                    <input type="text" class="form-control d-inline" name="waktu_prediksi" style="width: 80px">
                                @endif
                            @else
                                <!-- menampilkan textbox jika text kosong -->
                                <input type="text" class="form-control risiko-text"
                                    name="risiko[row_{{ $index }}][col_{{ $list_index }}][text]"
                                    value="{{ $list_item }}" data-row="{{ $index }}"
                                    data-col="{{ $list_index }}">
                            @endif
                        </div>
                    </td>

                    @if ($list_index === 0)
                        <td rowspan="{{ count($list) }}">
                            <textarea class="form-control risiko-ket" name="risiko[row_{{ $index }}][col_{{ $list_index }}][ket]"
                                id="check-ket-{{ $list_index }}" cols="30" rows="3" maxlength="1000" data-row="{{ $index }}"
                                data-col="{{ $list_index }}"></textarea>
                        </td>
                    @endif
                </tr>
            @endforeach
        @endforeach
    </table>

    <div style="margin-bottom: 2rem">* Coret yang tidak perlu</div>
    <small>RSJM / Revisi 00 / 08.2018</small>
</div>
