@section('css')
    <style>
        table {
            width: 100%
        }

        td {
            padding: 3px 6px;
        }

        h4,
        h5 {
            margin-bottom: 0
        }

        .bordered {
            border: 1px solid #414141;
        }

        .bordered-full table,
        .bordered-full tr,
        .bordered-full th,
        .bordered-full td {
            border: 1px solid #414141;
        }

        .border-bottom-0 {
            border-bottom: none;
        }

        .px-2 {
            padding: 0 6px;
        }

        .py-2 {
            padding: 6px 0;
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
                <span>RM.30.2</span>
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
                <table>
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
                <h4>FORM B</h4>
                <h5>CATATAN IMPLEMENTASI MANAJER PELAYANAN PASIEN (MPP)</h5>
            </td>
        </tr>
    </table>

    <table class="bordered border-bottom-0 py-2">
        <tr>
            <td width="20%">Diagnosa Medis</td>
            <td width="2%">:</td>
            <td><input type="text" name="diagnosa_medis" class="form-control" required></td>
        </tr>

        <tr>
            <td>MPP</td>
            <td>:</td>
            <td><input type="text" name="mpp" class="form-control" required></td>
        </tr>
    </table>

    <table class="bordered-full">
        <tr class="text-center">
            <th width="20%">TANGGAL/JAM</th>
            <th width="20%">IMPLEMENTASI</th>
            <th>EVALUASI</th>
            <th>PARAF</th>
        </tr>
        @foreach ($data_asesmen as $index => $item)
            <tr>
                <td>
                    <div class="input-group">
                        <input name="data[{{ $index }}][tgl]" type="date" class="form-control data-tgl">

                        <input name="data[{{ $index }}][jam]" type="text" class="form-control data-jam time">
                    </div>
                </td>
                <td>
                    {{-- {{ $item }}
                    <input name="data[{{ $index }}][implementasi]" type="hidden" value="{{ $item }}" class="data-implementasi"> --}}
                    <textarea name="data[{{ $index }}][implementasi]" class="form-control data-implementasi"></textarea>
                </td>
                <td>
                    <textarea name="data[{{ $index }}][evaluasi]" class="form-control data-evaluasi"></textarea>
                </td>
                <td>
                    <textarea name="data[{{ $index }}][paraf]" class="form-control data-paraf"></textarea>
                </td>
            </tr>
        @endforeach
    </table>

    <small>RSJM / Revisi 00 / 08.2018</small>
</div>
