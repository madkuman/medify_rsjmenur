@section('css')
    <style>
        table {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        table tr,
        table td {
            padding: .2rem;
            vertical-align: middle;
        }

        h6 {
            margin-bottom: 0;
        }

        .ms-table-bordered,
        .ms-table-bordered tr,
        .ms-table-bordered td {
            border: 1px solid #000;
        }

        .ms-bordered {
            border: 1px solid #000;
        }

        .ms-border-bottom-0 {
            border-bottom: none !important;
        }

        .ms-text-center {
            text-align: center;
        }
    </style>
@endsection

<input type="hidden" name="id" value="" id="id">
<div style="overflow: hidden; ">
    <div class="block-content block-form" style="padding-left: 25px; padding-right: 25px; overflow-x: scroll">
        {{ csrf_field() }}

        <table>
            <tr>
                <td width="80%"> </td>
                <td class="ms-bordered ms-border-bottom-0 ms-text-center">
                    <span>RM.21.K3</span>
                </td>
            </tr>
        </table>

        {{-- KOP --}}
        <table class="ms-bordered ms-border-bottom-0">
            <tr>
                <td width="60%" style="vertical-align: middle; padding: 10px 0">
                    <table>
                        <tr>
                            <td width="18%" style="text-align: right;">
                                <img src="{{ url('') }}/assets/img/pemprov-jatim-100px.png" height="55">
                            </td>
                            <td width="62%" style="text-align: center; font-size: 11px;">
                                <b>
                                    PEMERINTAH PROVINSI JAWA TIMUR<br>
                                    RUMAH SAKIT JIWA MENUR<br>
                                    Jl Menur No.120, Telp(031) 5021635, 5021637<br>
                                    Surabaya
                                </b>
                            </td>
                            <td width="20%" style="text-align: left;">
                                <img src="{{ url('') }}/assets/img/menur-100px.png" height="55">
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
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

        <table class="ms-bordered ms-border-bottom-0">
            <tr style="background-color: #d0d0d0">
                <td class="ms-text-center">
                    <h6>ASESMEN ULANG RAWAT INAP</h6>
                    <h6>(RESIKO MELARIKAN DIRI)</h6>
                </td>
            </tr>
        </table>

        <table class="ms-table-bordered ms-border-bottom-0">
            <tr>
                <td width="20%"><strong>Tanggal Masuk</strong></td>
                <td colspan="20"><input class="form-control" type="date" name="tanggal_masuk"></td>
            </tr>
            <tr>
                <td width="20%"><strong>Ruang</strong></td>
                <td colspan="20"><input class="form-control" type="text" name="ruang"></td>
            </tr>
            <tr>
                <td width="20%"><strong>DPJP</strong></td>
                <td colspan="20"><input class="form-control" type="text" name="dpjp"></td>
            </tr>
            <tr>
                <td width="20%"><strong>Diagnosa Medis</strong></td>
                <td colspan="20"><input class="form-control" type="text" name="diagnosa_medis"></td>
            </tr>
            <tr>
                <td width="20%">Faktor Dinamis</td>
                <td colspan="20"><input class="form-control" type="text" name="faktor_dinamis"></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                @for ($i = 0; $i < 7; $i++)
                    @if ($i === 0)
                        <td colspan="2"></td>
                    @else
                        <td colspan="3">
                            <input class="form-control" type="date" name="tanggal[]">
                        </td>
                    @endif
                @endfor
            </tr>

            <tr>
                <td width="20%">Shift Jaga</td>
                @php
                    // P: pagi, S: siang, M: malam
                    $letters = ['P', 'S', 'M'];
                    $idx = 0;
                @endphp
                @for ($i = 0; $i < 20; $i++)
                    @if ($i > 1)
                        <td width="3%" class="ms-text-center">{{ $letters[$idx] }}</td>
                        @php $idx = $idx >= 2 ? 0 : $idx + 1 @endphp
                    @else
                        <td></td>
                    @endif
                @endfor
            </tr>

            <tr>
                <td width="20%"><strong>FAKTOR RESIKO</strong></td>
                <td width="13%" class="ms-text-center"><strong>SKALA</strong></td>
                <td width="13%" class="ms-text-center"><strong>Poin</strong></td>
                @for ($i = 0; $i < 18; $i++)
                    <td width="3%" class="ms-text-center"></td>
                @endfor
            </tr>

            @php
                $faktor = [
                    'Menolak Perawatan/Insight Jelek',
                    'Memiliki Keinginan Kuat/Kepentingan di Luar Rumah Sakit',
                    'Kebosanan',
                    'Perintah Halusinasi untuk Melarikan diri',
                    'Berkurang / kehilangan kontrol diri',
                    'Kemarahan, Frustasi',
                    'Perilaku seksual tidak wajar',
                    'Ketakutan terhadap pasien lain, NaKes dan Pengobatan',
                    'Penggunaan Napza',
                ];
                $skala = ['Ya', 'Tidak', 'Tidak Tahu'];
                $poins = [2, 0, 1];
            @endphp

            @foreach ($faktor as $faktor_index => $faktor_value)
                @foreach ($skala as $skala_index => $skala_value)
                    @php
                        $style = $faktor_index % 2 === 0 ? 'background-color: #f1f1f1' : '';
                    @endphp

                    <tr class="faktor-resiko">
                        @if ($skala_index === 0)
                            <td width="20%" rowspan="3">{{ $faktor_value }}</td>
                        @endif

                        <td class="ms-text-center">{{ $skala_value }}</td>
                        <td class="ms-text-center">{{ $poins[$skala_index] }}</td>

                        @php
                            $shift = 0; // 0 = pagi, 1 = siang, 2 = malam
                            $group = 0; // group by date (tanggal)
                        @endphp

                        @for ($i = 0; $i < 18; $i++)
                            <td style="{{ $style }}" width="3%" class="ms-text-center">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input position-static"
                                        name="skoring[f{{ $faktor_index }}][g{{ $group }}][s{{ $shift }}]"
                                        value="{{ $poins[$skala_index] }}">
                                </div>
                            </td>

                            @php
                                if ($shift >= 2) {
                                    $shift = 0;
                                    $group += 1;
                                } else {
                                    $shift += 1;
                                }
                            @endphp
                        @endfor
                    </tr>
                @endforeach
            @endforeach

            @php
                $skor_judul = ['Skor Saat ini (Dinamis)', 'Skor Asesmen Awal (Statis)', 'Total Skor'];
                $skor_class = ['skor-saat-ini', 'skor-asesmen', 'skor-total'];
            @endphp

            @foreach ($skor_judul as $idx => $judul)
                <tr>
                    <td colspan="2">{{ $judul }}</td>
                    <td></td>
                    @php
                        $shift = 0;
                        $skor_group = 0;
                    @endphp

                    @for ($i = 0; $i < 18; $i++)
                        <td width="3%" class="ms-text-center {{ $skor_class[$idx] }}"
                            data-group="g{{ $skor_group }}" data-shift="s{{ $shift }}"></td>

                        @php
                            if ($shift >= 2) {
                                $shift = 0;
                                $skor_group += 1;
                            } else {
                                $shift += 1;
                            }
                        @endphp
                    @endfor
                </tr>
            @endforeach

            <tr>
                <td colspan="2">Initial Perawat Penilai</td>
                <td></td>
                @for ($i = 0; $i < 18; $i++)
                    <td width="3%" class="ms-text-center">
                        <input class="form-control" type="text" maxlength="1" name="perawat_penilai[]"
                            value="" style="text-transform: uppercase;">
                    </td>
                @endfor
            </tr>

            <tr>
                <td colspan="2">Paraf</td>
                <td></td>
                @for ($i = 0; $i < 18; $i++)
                    <td width="3%" class="ms-text-center">
                        <input class="form-control" type="text" maxlength="1" name="paraf[]" value=""
                            style="text-transform: uppercase;">
                    </td>
                @endfor
            </tr>

            <tr>
                <td colspan="2">LEVEL RISIKO MELARIKAN DIRI Total Skor :</td>
                <td></td>
                <td colspan="18">
                    <label for="level-resiko" style="padding: 8px">
                        <input type="radio" name="level_resiko" id="level-resiko" value="Rendah">
                        <span>Rendah (&lt;7)</span>
                    </label>
                    <label for="level-resiko" style="padding: 8px">
                        <input type="radio" name="level_resiko" id="level-resiko" value="Sedang">
                        <span>Sedang (7-14)</span>
                    </label>
                    <label for="level-resiko" style="padding: 8px">
                        <input type="radio" name="level_resiko" id="level-resiko" value="Tinggi">
                        <span>Tinggi (&gt;14)</span>
                    </label>
                </td>
            </tr>

            <tr>
                <td></td>
                <td class="ms-text-center"><strong>Resiko</strong></td>
                <td colspan="19" class="ms-text-center"><strong>Manajemen Plan</strong></td>
            </tr>

            <tr>
                <td rowspan="10" class="ms-text-center"><strong>Skoring</strong></td>
                <td rowspan="3" class="ms-text-center">Rendah</td>
                <td colspan="19">1. Rawat jalan dan pemberian terapi</td>
            </tr>

            <tr>
                <td colspan="19">2. Advise untuk mengenali tanda-tanda perburukan dan segera kontrol</td>
            </tr>

            <tr>
                <td colspan="19">3. Psikoterapi</td>
            </tr>

            <tr>
                <td rowspan="2" class="ms-text-center">Sedang</td>
                <td colspan="19">1. Lapor DPJP</td>
            </tr>

            <tr>
                <td colspan="19">2. Pemakaian gelang risiko</td>
            </tr>

            <tr>
                <td rowspan="5" class="ms-text-center">Berat</td>
                <td colspan="19">1. Pemakaian gelang risiko</td>
            </tr>

            <tr>
                <td colspan="19">2. Lapor DPJP</td>
            </tr>

            <tr>
                <td colspan="19">3. Rawat Inap dengan dan perawatan instensif</td>
            </tr>

            <tr>
                <td colspan="19">4. Ruang Isolasi/Restraint</td>
            </tr>

            <tr>
                <td colspan="19">5. Observasi Ketat</td>
            </tr>

            <tr>
                <td width="20%" rowspan="5" class="ms-text-center">Petunjuk Pengisian :</td>
                <td colspan="20">1. Tanggal di isi sesuai pelaksanaan asesmen ulang</td>
            </tr>

            <tr>
                <td colspan="20">2. Pengukuran asesmen ulang pasien berrisiko dilakukan 3x sehari sesuai shift kerja
                </td>
            </tr>

            <tr>
                <td colspan="20">3. Isi dengan angka sesuai poin</td>
            </tr>

            <tr>
                <td colspan="20">4. Hasil ditulis dalam kotak sesuai skala/skore pengukuran yang didapatkan</td>
            </tr>

            <tr>
                <td colspan="20">5. Tulis initial nama dan paraf perawat yang memalukan</td>
            </tr>
        </table>
    </div>
</div>
