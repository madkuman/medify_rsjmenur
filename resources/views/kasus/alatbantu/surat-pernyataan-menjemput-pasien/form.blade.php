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
            <h5 style="text-align: center; padding: 20px 0px">SURAT PERNYATAAN MENJEMPUT PASIEN</h5>
        </td>
    </tr>
</table>

<table style="width: 100%">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <h6>IDENTITAS PASIEN</h6>
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
            {{ ucwords(strtolower($kasus->pasien->address)) }}
    </tr>
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>NIK</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            {{ ucwords(strtolower($kasus->pasien->no_identitas)) }}
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td class="position-relative" colspan="1" rowspan="1">
            <h6>Kami yang bertanda tangan dibawah ini :</h6>
        </td>
    </tr>
</table>
<table style="width: 100%">
     <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Nama</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="nama" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Tanggal Lahir</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="date" class="form-control" name="tanggal_lahir" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
   
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Alamat</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="alamat" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Nomor Telepon yang dapat dihubungi</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="no_telepon" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
    <tr>
        <td width="20%" class="position-relative" colspan="1" rowspan="1"><span>Hubungan dengan Pasien</span></td>
        <td width="2%" class="position-relative" colspan="1" rowspan="1"><span>:</span></td>
        <td class="position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="hubungan" value="">
            </div>
            <div class="form-group medify-form-genv4-view-container">
            </div>
        </td>
    </tr>
    
</table>
{{--  <table style="width: 100%">
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
</table>  --}}
{{-- @TODO: create validation --}}
