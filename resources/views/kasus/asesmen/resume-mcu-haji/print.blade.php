<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Pemeriksaan Kesehatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-no-border,
        .table-no-border td,
        .table-no-border th {
            border: none;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }

        .no-border td {
            border: none;
        }

        .section-title {
            font-weight: bold;
            text-align: center;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        .highlight {
            color: red;
        }

        .nested-table td {
            border: none;
            padding: 2px;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <img src="{{ config('app.kop_lg') }}" height="165">
    <h3 style="text-align:center">BERKAS RESUME MCU HAJI RS JIWA MENUR</h3>

    <div class="row">
        <div class="col">
            <table class="table-no-border">
                <tr>
                    <td style="width: 13%">No. RM</td>
                    <td style="width: 2%">:</td>
                    <td style="width: 35%"> {{ $kasus->pasien->no_rm }}</td>
                    <td style="width: 5%"></td>
                    <td style="width: 13%">Tgl Periksa</td>
                    <td style="width: 2%">:</td>
                    <td style="width: 30%">{{ indonesian_date((string) $hasil_data->tanggal_pemeriksaan) ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td>Nama Pasien</td>
                    <td>:</td>
                    <td> {{ $kasus->pasien->name }}</td>
                    <td></td>
                    <td>Psikolog</td>
                    <td>:</td>
                    <td>{{ $hasil_data->psikolog ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Usia</td>
                    <td>:</td>
                    <td> {{ $kasus->identitas->age }}</td>
                    <td></td>
                    <td>Dokter Umum</td>
                    <td>:</td>
                    <td>{{ $hasil_data->dokter_umum ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td> {{ $kasus->identitas->jenis_kelamin }}</td>
                    <td></td>
                    <td>Dokter SpPD</td>
                    <td>:</td>
                    <td>{{ $hasil_data->dokter_sppd ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td> {{ $kasus->pasien->text_alamat }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>No. HP</td>
                    <td>:</td>
                    <td> {{ $kasus->identitas->no_hp }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>No. Porsi</td>
                    <td>:</td>
                    <td>{{ $hasil_data->nomor_porsi ?? '' }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section-title">ANAMNESIS</div>
    <table>
        <tr>
            <td style="width: 5%">1</td>
            <td style="width: 45%">Keluhan saat ini / Riwayat kesehatan sekarang:</td>
            <td colspan="2">{{ $hasil_data->keluhan_saat_ini ?? '-' }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Riwayat penyakit dahulu, beserta obat yang rutin diminum (DM, HT, Jantung, Asma, Stroke, Alergi, dll):
            </td>
            <td colspan="2">{{ $hasil_data->riwayat_penyakit_dahulu ?? '-' }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Obat yang rutin dikonsumsi:
            </td>
            <td colspan="2">{{ $hasil_data->obat_yang_rutin_dikonsumsi ?? '-' }}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Data alergi obat:
            </td>
            <td colspan="2">{{ $hasil_data->data_alergi_obat ?? '-' }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Riwayat penyakit keluarga:</td>
            <td colspan="2">
                {{ implode(', ', (array) ($hasil_data->riwayat_penyakit_keluarga ?? ($hasil_data->riwayat_penyakit_keluarga_lainnya ?? []))) }}
            </td>
        </tr>
        <tr>
            <td>6</td>
            <td>Apakah ada riwayat serangan jantung sebelumnya?</td>
            <td>{{ $hasil_data->is_riwayat_jantung ?? '-' }}</td>
            <td>terakhir kali serangan : {{ $hasil_data->terakhir_kali_serangan ?? '-' }}</td>
        </tr>
        <tr>
            <td>7</td>
            <td>Riwayat sosial / kebiasaan :</td>
            <td colspan="2">
                {{ implode(', ', (array) ($hasil_data->riwayat_sosial ?? ($hasil_data->riwayat_sosial_lainnya ?? []))) }}
            </td>
        </tr>
    </table>

    <div class="section-title">PEMERIKSAAN FISIK</div>
    <table>
        <tr>
            <td style="width: 25%">Tensi: {{ $hasil_data->sistol ?? '-' }}/{{ $hasil_data->diastol ?? '-' }} mmHg</td>
            <td>Nadi: {{ $hasil_data->nadi ?? '-' }} x/mnt</td>
            <td>Suhu: {{ $hasil_data->suhu ?? '-' }} °C</td>
            <td>RR: {{ $hasil_data->rr ?? '-' }} x/mnt</td>
        </tr>
        <tr>
            <td colspan="2">Lingkar perut: {{ $hasil_data->lingkar_perut ?? '-' }} cm</td>
            <td>Visus OD: {{ $hasil_data->visus_od ?? '-' }}</td>
            <td>Visus OS: {{ $hasil_data->visus_os ?? '-' }}</td>
        </tr>
        <tr>
            <td>BB: {{ $hasil_data->bb ?? '-' }} Kg</td>
            <td>TB: {{ $hasil_data->tb ?? '-' }} cm</td>
            <td colspan="2">BMI: {{ $hasil_data->bmi ?? '-' }} ({{ $hasil_data->kategori_bmi ?? '-' }})</td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="width: 50%">Inspeksi dan Palpasi head to toe:</td>
            <td colspan="2">{{ $hasil_data->inspeksi_dan_palpasi ?? '-' }}</td>
        </tr>
        <tr>
            <td>Kekuatan otot ekstremitas: </td>
            <td>Upper: {{ $hasil_data->kekuatan_otot_ekstremitas_upper ?? '-' }}</td>
            <td>Lower: {{ $hasil_data->kekuatan_otot_ekstremitas_lower ?? '-' }}</td>
        </tr>
        <tr>
            <td>Refleks: </td>
            <td colspan="2">{{ $hasil_data->refleks ?? '-' }}</td>
        </tr>
        <tr>
            <td>Pemeriksaan EKG: </td>
            <td colspan="2">{{ $hasil_data->pemeriksaan_ekg ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">PEMERIKSAAN MENTAL</div>
    <table>
        <thead>
            <tr>
                <th style="width: 4%">No</th>
                <th style="width: 35%">Pemeriksaan</th>
                <th style="width: 25%">Panduan Interpretasi</th>
                <th style="width: 10%">Hasil</th>
                <th>Interpretasi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Pemeriksaan Kesehatan Jiwa (SRQ-20)<br>
                    <i>(dirasakan dalam 30 hari terakhir)</i><br>
                    Berapa jumlah jawaban Ya?
                </td>
                <td>
                    0-5: Normal<br>
                    6-20: Indikasi gx psikiatri
                </td>
                <td>{{ $hasil_data->srq ?? '-' }}</td>
                <td>{{ $srq->category ?? '-' }}</td>
            </tr>
            <tr>
                <td rowspan="3">2</td>
                <td>
                    <div class="bold">Pemeriksaan Kognitif</div>
                    a. Minicog 1: mengulang sebutkan kata BOLA, MELATI, KURSI
                </td>
                <td>Tidak diskor</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    b. Clock drawing test<br>
                    - gambar lingkaran utuh<br>
                    - tulis angka 1-12 dlm lingkaran<br>
                    - angka berurutan dan tepat letaknya<br>
                    - jarum jam menunjukkan jam 11.10
                </td>
                <td>
                    1 skor untuk tiap langkah yang benar (total skor 4)<br>
                    Skor 4: normal<br>
                    Skor &lt; 4: menurun
                </td>
                <td>{{ $hasil_data->clockTestInput ?? '-' }}</td>
                <td>{{ $hasil_data->clockTestStatus ?? '-' }}</td>
            </tr>
            <tr>
                <td>
                    c. Sebutkan 3 kata yang tadi disebutkan (BOLA, MELATI, KURSI)
                </td>
                <td>
                    1 skor untuk tiap kata yang benar<br>
                    Skor 3: normal<br>
                    Skor &lt; 3: menurun
                </td>
                <td>{{ $hasil_data->kataTestInput ?? '-' }}</td>
                <td>{{ $hasil_data->kataTestStatus ?? '-' }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>
                    Pemeriksaan Kesehatan Mental <i>lanjutan</i><br>
                    The Abbreviated Mental Test (AMT)
                </td>
                <td>
                    Tidak depresi:<br>
                    ≥ 8 benar DAN SRQ-20 rendah<br><br>
                    Depresi:<br>
                    &lt; 8 benar DAN/atau SRQ-20 tinggi
                </td>
                <td>{{ $hasil_data->amt ?? '-' }}</td>
                <td>{{ $hasil_data->category_amt ?? '-' }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>
                    Activity Daily Living (ADL) dengan Barthel Index
                </td>
                <td>
                    Mandiri:<br>
                    100<br>
                    Ketergantungan ringan:<br>
                    91-99<br>
                    Ketergantungan sedang:<br>
                    61-90<br>
                    Ketergantungan berat:<br>
                    total skor ADL ≤ 60, atau<br>
                    ada nilai 0 pada salah satu ADL: BAB, BAK, Toileting, Berpindah, Mobilisasi.
                    &lt; 8 benar DAN/atau SRQ-20 tinggi
                </td>
                <td>{{ $hasil_data->barthel ?? '-' }}</td>
                <td>{{ $hasil_data->category_barthel ?? '-' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">PEMERIKSAAN PENUNJANG (terlampir)</div>
    <table>
        <tr>
            <td colspan="2">Pemeriksaan DL, LED, Golongan darah, HbA1c, GDP, 2JPP, Kolesterol total, TG, SGOT, SGPT,
                BUN, SK, UL
            </td>
        </tr>
        <tr>
            <td style="width: 50%">Hasil Lab Abnormal:</td>
            <td>{{ $hasil_data->hasil_lab_abnormal ?? '-' }}</td>
        </tr>
        <tr>
            <td>Hasil Plano Test (khusus wanita usia subur):</td>
            <td>{{ $hasil_data->hasil_plano_test ?? '-' }}</td>
        </tr>
        <tr>
            <td>Hasil CXR:</td>
            <td>{{ $hasil_data->hasil_cxr ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">RESUME</div>
    <table>
        <tr>
            <td>{{ $hasil_data->resume ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">DIAGNOSIS</div>
    <table class="table-no-border">
        <tr>
            <td style="width: 10%">ICD10 1 :</td>
            <td style="width: 35%">{{ $hasil_data->icd10_1 ?? '-' }}</td>
            <td></td>
            <td style="width: 10%">ICD10 4 :</td>
            <td style="width: 35%">{{ $hasil_data->icd10_4 ?? '-' }}</td>
        </tr>
        <tr>
            <td style="width: 10%">ICD10 2 :</td>
            <td style="width: 35%">{{ $hasil_data->icd10_2 ?? '-' }}</td>
            <td></td>
            <td style="width: 10%">ICD10 5 :</td>
            <td style="width: 35%">{{ $hasil_data->icd10_5 ?? '-' }}</td>
        </tr>
        <tr>
            <td style="width: 10%">ICD10 3 :</td>
            <td style="width: 35%">{{ $hasil_data->icd10_3 ?? '-' }}</td>
            <td></td>
            <td style="width: 10%">ICD10 6 :</td>
            <td style="width: 35%">{{ $hasil_data->icd10_6 ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">APAKAH DIDAPATKAN KECURIGAAN PADA PENYAKIT :</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Penyakit</th>
                <th>Ya / Tidak</th>
                <th>Tindak Lanjut (Bila Ya)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>PPOK dan Emfisema</td>
                <td style="text-align: center">{{ $hasil_data->ppok_dan_emfisema ?? '-' }}</td>
                <td>Spirometri atau skala sesak mMRC dengan six minute walking test (SMWT)</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Stroke</td>
                <td style="text-align: center">{{ $hasil_data->stroke ?? '-' }}</td>
                <td>CT scan kepala</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Tumor (keganasan)</td>
                <td style="text-align: center">{{ $hasil_data->tumor ?? '-' }}</td>
                <td>USG/CT scan dan ECOG Score</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Gagal jantung, PJK, Cardiomegali</td>
                <td style="text-align: center">{{ $hasil_data->gagal_jantung ?? '-' }}</td>
                <td>Echo atau skala NYHA dengan six minute walking test (SMWT)</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Tuberkulosis</td>
                <td style="text-align: center">{{ $hasil_data->tuberkulosis ?? '-' }}</td>
                <td>TCM atau sputum BTA</td>
            </tr>
            <tr>
                <td>6</td>
                <td>HIV/AIDS</td>
                <td style="text-align: center">{{ $hasil_data->hiv_aids ?? '-' }}</td>
                <td>HIVrapid atau HIV Elisa</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Fraktur tungkai</td>
                <td style="text-align: center">{{ $hasil_data->fraktur_tungkai ?? '-' }}</td>
                <td>X-ray</td>
            </tr>
        </tbody>
    </table>
    <p>Bila ada, maka perlu tindak lanjut : {{ $hasil_data->tindak_lanjut ?? '-' }}</p>
    <p>Tanggal tindak lanjut : {{ indonesian_date((string) $hasil_data->tgl_hasil_tindak_lanjut) ?? '-' }} :
        {{ $hasil_data->hasil_tindak_lanjut ?? '-' }}</p>

    {{-- <div class="section-title">STATUS ISTITAAH</div>
    <table>
        <tr>
            <td style="text-align: center">{{ $hasil_data->status_istitaah }} <br> dengan alasan
                {{ $hasil_data->alasan_tidak_memenuhi_syarat_istitaah_kesehatan_haji_sementara ?? '' }} <br>
                {{ $hasil_data->alasan_tidak_memenuhi_syarat_istitaah_kesehatan_haji ?? '' }}</td>
        </tr>
    </table>

    <div class="section-title">SARAN</div>
    <table>
        <tr>
            <td>{{ $hasil_data->saran ?? '' }}</td>
        </tr>
    </table> --}}

</body>

</html>
