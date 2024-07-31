<div class="block-content block-hasil" style="padding-left: 25px; padding-right: 25px;">
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
            <td width="60%" style="padding: 10px 0; border-right: none">
                <table class="ms-table-borderless">
                    <tr>
                        <td width="18%" style="text-align: right;">
                            <img src="{{ url('') }}/assets/img/pemprov-jatim.png" height="55" loading="lazy">
                        </td>
                        <td width="62%" style="text-align: center;">
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
            <td style="border-left: none">
                <table class="ms-table-borderless">
                    <tr>
                        <td><span>No. RM</span></td>
                        <td width="2%"><span>:</span></td>
                        <td> {{ $kasus->pasien->no_rm }} </td>
                    </tr>
                    <tr>
                        <td><span>Nama</span></td>
                        <td><span>:</span></td>
                        <td> {{ $kasus->pasien->name }} </td>
                    </tr>
                    <tr>
                        <td><span>Tgl lahir / umur</span></td>
                        <td><span>:</span></td>
                        <td> {{ $kasus->identitas->age }} </td>
                    </tr>
                    <tr>
                        <td><span>Jenis kelamin</span></td>
                        <td><span>:</span></td>
                        <td> {{ $kasus->pasien->jenis_kelamin }}
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
            <td>` + val.dx_medis + `</td>
        </tr>

        <tr>
            <td width="20%">Tanggal</td>
            <td width="5%">:</td>
            <td>` + formatDate(val.tanggal) + `</td>
        </tr>

        <tr>
            <td width="20%">MPP</td>
            <td width="5%">:</td>
            <td>` + val.mpp + `</td>
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

        {{-- # Semua nilai dari input, checkbox dan textarea dibawah ini di handle oleh JS # --}}
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
                        <div class="form-check ml-2">
                            <!-- checkbox -->
                            <input class="form-check-input risiko-check" type="checkbox"
                                name="risiko[row_{{ $index }}_col_{{ $list_index }}][check]"
                                data-row="{{ $index }}" data-col="{{ $list_index }}" readonly>

                            @if ($list_item)
                                <label class="form-check-label">
                                    {{ $list_item }}
                                </label>
                            @else
                                <div class="risiko-text" data-row="{{ $index }}"
                                    data-col="{{ $list_index }}">........................</div>
                            @endif

                            @if ($index === 3 && $list_index === 1)
                                <span id="waktu-prediksi"></span>
                            @endif
                        </div>
                    </td>

                    @if ($list_index === 0)
                        <td rowspan="{{ count($list) }}" style="vertical-align: top">
                            <div class="risiko-ket" data-row="{{ $index }}" data-col="{{ $list_index }}"></div>
                        </td>
                    @endif
                </tr>
            @endforeach
        @endforeach
    </table>

    <div style="margin-bottom: 2rem">* Coret yang tidak perlu</div>
    <small>RSJM / Revisi 00 / 08.2018</small>
</div>
