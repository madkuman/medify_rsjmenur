<input type="hidden" name="alatbantu_id" value="">
<input type="hidden" name="kasus_id" value="{{ $kasus->id }}">

<table style="width:100%">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <h5 style="text-align: center; padding: 20px 0px">SURAT KETERANGAN PEMERIKSAAN NAPZA</h5>
        </td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1">
            <span>Nomor</span>
        </td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="nomor" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">

            </div>
        </td>
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
                        <option value="{{ $item->name }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group medify-form-genv4-view-container">

            </div>
        </td>
    </tr>
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1">
            <span>SIP</span>
        </td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="sip" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">

            </div>
        </td>
    </tr>
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1">
            <span>NIP</span>
        </td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="nip" value="">
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
            {{ $kasus->pasien->name }}
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
            {{ $kasus->pasien->address }}
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
            <h6>Pada pemeriksaan tanggal :</h6>
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
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Jam</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="time" class="form-control" name="jam" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
</table>
<table style="width: 100%">
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Parameter</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox" value="metamphethamine" id="metamphethamine"
                    name="metamphethamine">
                <label class="form-check-label" for="metamphethamine">
                    Metamphethamine
                </label>
            </div>
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox" value="amphetamine" id="amphetamine"
                    name="amphetamine">
                <label class="form-check-label" for="amphetamine">
                    Amphetamine
                </label>
            </div>
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox" value="morphine_heroin" id="morphine_heroin"
                    name="morphine_heroin">
                <label class="form-check-label" for="morphine_heroin">
                    Morphine / Heroin
                </label>
            </div>
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox" value="mariyuana_thc" id="mariyuana_thc"
                    name="mariyuana_thc">
                <label class="form-check-label" for="mariyuana_thc">
                    Mariyuana / THC
                </label>
            </div>
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox" value="benzodiazepine" id="benzodiazepine"
                    name="benzodiazepine">
                <label class="form-check-label" for="benzodiazepine">
                    Benzodiazepine
                </label>
            </div>
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox" value="coccain" id="coccain" name="coccain">
                <label class="form-check-label" for="coccain">
                    Coccain
                </label>
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
