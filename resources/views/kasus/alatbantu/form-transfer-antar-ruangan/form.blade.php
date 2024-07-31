<input type="hidden" name="alatbantu_id" value="">
<input type="hidden" name="kasus_id" value="{{ $kasus->id }}">
<table style="width:100%" cellpadding="3">
    <tr>
        <td width="80%" class="position-relative" colspan="1" rowspan="1"> </td>
        <td class="position-relative" colspan="1" rowspan="1" style="border: 1px solid #000; text-align: center">
            <span>RM. 09</span>
        </td>
    </tr>
</table>

<table style="width:100%">
    <tr>
        <td width="50%" class="position-relative" colspan="1" rowspan="4"
            style="vertical-align: middle; padding: 10px 0">
            <table width="100%">
                <tr>
                    <td width="18%" style="text-align: right;">
                        <img src="{{ url('') }}/assets/img/pemprov-jatim.png" height="55">
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
                        <img src="{{ url('') }}/assets/img/menur.png" height="55">
                    </td>
                </tr>
            </table>
        </td>
        <td width="15%" class="position-relative" colspan="1" rowspan="1"><span>No. RM</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1"> {{ $kasus->pasien->no_rm }} </td>
    </tr>
    <tr>
        <td class="position-relative" colspan="1" rowspan="1"><span>Nama</span></td>
        <td class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1"> {{ $kasus->pasien->name }} </td>
    </tr>
    <tr>
        <td class="position-relative" colspan="1" rowspan="1"><span>Tgl lahir / umur</span></td>
        <td class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1"> {{ indonesian_date($kasus->pasien->date_of_birth) }} / {{ $kasus->identitas->age }} </td>
    </tr>
    <tr>
        <td class="position-relative" colspan="1" rowspan="1"><span>Jenis kelamin</span></td>
        <td class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1"> {{ $kasus->pasien->jenis_kelamin }}</td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <h5 style="text-align: center; padding: 20px 0px">FORM TRANSFER INTERNAL RUMAH SAKIT</h5>
        </td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>DPJP</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td width="28%" class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control js-select2" style="width: 80%" name="dpjp">
                    <option value="">-</option>
                    @foreach ($dokter as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <span class="medify-form-genv4-view-container"></span>
        </td>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Tanggal MRS</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td width="28%" class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="date" class="form-control" name="tgl_mrs">
            </div>
            <div class="form-group medify-form-genv4-view-container"></div>
        </td>
    </tr>
    <tr>
        <td class="position-relative" colspan="1" rowspan="1"><span>Dokter Spesialis Lain</span></td>
        <td class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control js-select2" style="width: 80%" name="dokter_spesialis_lain">
                    <option value="">-</option>
                    @foreach ($dokter as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <span class="medify-form-genv4-view-container"></span>
        </td>
        <td class="position-relative" colspan="1" rowspan="1"><span>Tanggal Pindah</span></td>
        <td class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="date" class="form-control" name="tgl_pindah" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container"></div>
        </td>
    </tr>
    <tr>
        <td class="position-relative" colspan="1" rowspan="1"><span>Diagnosis MRS</span></td>
        <td class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control js-select2" style="width: 80%" name="diagnosis_mrs">
                    <option value="">-</option>
                    @foreach ($kasus->diagnosis as $diagnosis)
                        <option value="{{ $diagnosis->icd10->long_desc }}">
                            {{ $diagnosis->icd10->long_desc }}
                        </option>
                    @endforeach
                </select>
            </div>
            <span class="medify-form-genv4-view-container"></span>
        </td>
        <td class="position-relative" colspan="1" rowspan="1"><span>Alergi</span></td>
        <td class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control input-tags" name="alergi" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container"></div>
        </td>
    </tr>
    <tr>
        <td class="position-relative" colspan="1" rowspan="1"><span>Alasan Admisi</span></td>
        <td class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="4" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="alasan_admisi" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
</table>
<table style="width:100%; margin-top: 10px">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <h6>I. RINGKASAN RIWAYAT PASIEN</h6>
        </td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1">
            <span>Anamnesis</span>
        </td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="anamnesis" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">

            </div>
        </td>
    </tr>
    <tr>
        <td class="position-relative" colspan="1" rowspan="1"><span>Keluhan Utama</span></td>
        <td class="position-relative" colspan="1" rowspan="1"> </td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <textarea class="form-control" name="keluhan_utama"></textarea>
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
    <tr>
        <td class="position-relative" colspan="1" rowspan="1"><span>Riwayat Penyakit</span></td>
        <td class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <textarea class="form-control" name="riwayat_penyakit"></textarea>
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
    <tr>
        <td class="position-relative" colspan="1" rowspan="1"><span>Pemeriksaan Fisik</span></td>
        <td class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <textarea class="form-control" name="pemeriksaan_fisik"></textarea>
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
    <tr>
        <td class="position-relative" colspan="1" rowspan="1"><span>Keadaan Umum</span></td>
        <td class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <textarea class="form-control" name="keadaan_umum"></textarea>
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
</table>
<table style="width:100%; margin-top: 10px">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <h6>II. PEMERIKSAAN PENUNJANG</h6>
        </td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <textarea class="form-control" name="pemeriksaan_penunjang"></textarea>
            </div>
            <div class="form-group medify-form-genv4-view-container"></div>
        </td>
    </tr>
</table>
<table style="width:100%; margin-top: 10px">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <h6>III. TINDAKAN MEDIS YANG SUDAH DILAKUKAN</h6>
        </td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <textarea class="form-control" name="tindakan_medis"></textarea>
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
</table>
<table style="width:100%; margin-top: 10px">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <h6>IV. PEMBERIAN TERAPI</h6>
        </td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <textarea class="form-control" name="pemberian_terapi"></textarea>
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
</table>
<table style="width:100%; margin-top: 10px">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <h6>V. LAIN-LAIN</h6>
        </td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <textarea class="form-control" name="lain_lain"></textarea>
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
</table>
<table style="width:100%; margin-top: 10px">
    <tr>
        <td class=" position-relative" colspan="8" rowspan="1">
            <h6>VI. KONDISI PASIEN</h6>
        </td>
    </tr>
    <tr>
        <td width="20%" class=" position-relative" colspan="1" rowspan="1"> <span>Dari Ruang</span>
        </td>
        <td width="2%" class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td width="20%" class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="dari_ruang" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td width="5%"></td>
        <td width="20%" class=" position-relative" colspan="1" rowspan="1"> <span>Ke Ruang</span> </td>
        <td width="2%" class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td width="20%" class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="ke_ruang" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Sebelum Transfer, jam</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="transfer_sebelum" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td width="5%"></td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Setelah Transfer, jam</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="transfer_sesudah" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Keadaan Umum</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="keadaan_umum_sebelum" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td width="5%"></td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Keadaan Umum</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="keadaan_umum_sesudah" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container"></div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Kesadaran</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="kesadaran_sebelum" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td width="5%"></td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Kesadaran</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="kesadaran_sesudah" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Pemeriksaan tanda-tanda vital
                :</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> </td>
        <td width="5%"></td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Pemeriksaan tanda-tanda vital
                :</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Tensi</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="tensi_sebelum" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span style="padding-left: 10px">mmHg</span>
        </td>
        <td width="5%"></td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Tensi</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="tensi_sesudah" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span style="padding-left: 10px">mmHg</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Suhu</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="number" min="-100" max="100" step="0.1" class="form-control"
                    name="suhu_sebelum" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span style="padding-left: 10px">&deg;
                C</span> </td>
        <td width="5%"></td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Suhu</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="number" min="-100" max="100" step="0.1" class="form-control"
                    name="suhu_sesudah" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span style="padding-left: 10px">&deg;
                C</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Nadi</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="number" min="0" max="200" step="1" class="form-control"
                    name="nadi_sebelum" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span style="padding-left: 10px">x /
                mnt</span> </td>
        <td width="5%"></td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Nadi</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="number" min="0" max="200" step="1" class="form-control"
                    name="nadi_sesudah" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span style="padding-left: 10px">x /
                mnt</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Respirasi</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="number" min="0" max="100" step="1" class="form-control"
                    name="resp_sebelum" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span style="padding-left: 10px">x /
                mnt</span> </td>
        <td width="5%"></td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Respirasi</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>:</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="number" min="0" max="100" step="1" class="form-control"
                    name="resp_sesudah" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span style="padding-left: 10px">x /
                mnt</span> </td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Catatan Penting :</span> </td>
        <td width="5%"></td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Catatan Penting :</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <textarea class="form-control" name="catatan_sebelum"></textarea>
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td width="5%"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <textarea class="form-control" name="catatan_sesudah"></textarea>
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Petugas yang menyerahkan</span> </td>
        <td width="5%"></td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>Petugas yang menyerahkan</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select name="petugas_sebelum" class="form-control js-select2" style="width: 100%">
                    <option value="">-</option>
                    @foreach ($petugas as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td width="5%"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select name="petugas_sesudah" class="form-control js-select2" style="width: 100%">
                    <option value="">-</option>
                    @foreach ($petugas as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
</table>
{{-- @TODO: create validation --}}
