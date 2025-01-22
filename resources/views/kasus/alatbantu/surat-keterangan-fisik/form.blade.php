<input type="hidden" name="alatbantu_id" value="">
<input type="hidden" name="kasus_id" value="{{ $kasus->id }}">

{{-- <table width="100%">
    <tr>
        <td width="100%"><img src="{{ config('app.kop_lg') }}" height="50"></td>
    </tr>
</table> --}}
<table style="width:100%">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <h5 style="text-align: center; padding: 20px 0px">SURAT KETERANGAN SEHAT FISIK</h5>
        </td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1">
            <span>Nomor</span>
        </td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td width="6%">400.7 /</td>
        <td width="10%"><input type="number" class="form-control" name="nomor" value=""></td>
        <td> / 1 / 102.8 / {{ date('Y') }}</td>
    </tr>
</table>
<table style="width: 100%">
    <tr>
        <td>
            <h6>Yang bertanda tangan di bawah ini :</h6>
        </td>
    </tr>
</table>
<table style="width: 100%">
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1">
            <span>Dokter Pemeriksa</span>
        </td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
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
            <div class="form-group medify-form-genv4-view-container">

            </div>
        </td>
    </tr>
</table>
<table style="width: 100%">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <h6>Menerangkan dengan sebenarnya bahwa :</h6>
        </td>
    </tr>
</table>
<table style="width: 100%">
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Nama</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1">:</td>
        <td class="position-relative" colspan="1" rowspan="1">
            {{ ucwords(strtolower($kasus->pasien->name)) }}
        </td>
    </tr>
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Jenis Kelamin</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            {{ $kasus->pasien->jenis_kelamin }}
        </td>
    </tr>
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Tanggal Lahir</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            {{ indonesian_date($kasus->pasien->date_of_birth) }}
        </td>
    </tr>
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Alamat</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            {{ ucwords(strtolower($kasus->pasien->address)) }}, Kel.
            {{ ucwords(strtolower($kasus->pasien->alamat_kelurahan->nama)) }}, Kec.
            {{ ucwords(strtolower($kasus->pasien->alamat_kecamatan->nama)) }},
            {{ ucwords(strtolower($kasus->pasien->alamat_kota->nama)) }}
        </td>
    </tr>
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Pendidikan</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pendidikan" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <h6>Pada pemeriksaan fisik tanggal</h6>
        </td>
    </tr>
</table>
<table style="width: 100%">
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Tanggal</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="date" class="form-control" name="tanggal_pemeriksaan" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Tensi</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="tensi" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span style="padding-left: 10px">mmHg</span>
        </td>
    </tr>
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Berat Badan</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="number" class="form-control" name="berat_badan" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span style="padding-left: 10px">Kg</span>
        </td>
    </tr>
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Tinggi Badan</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="number" class="form-control" name="tinggi_badan" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span style="padding-left: 10px">cm</span>
        </td>
    </tr>
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Visus</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="visus" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
</table>
<table style="width: 100%">
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Surat keterangan ini dibuat
                sebagai </span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <textarea class="form-control" name="syarat"></textarea>
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
</table>
{{-- @TODO: create validation --}}
