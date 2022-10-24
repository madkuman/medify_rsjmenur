@extends('kasus.alatbantu.edukasi-pasien.form.master')

@section('table-tag')
<table class="table table-hover table-striped table-borderless table-vcenter" id="dpjpTable">
@overwrite

@section('add-button')
<button class="btn btn-block btn-alt-primary tambahRecord" id="tambahDpjp" type="button">Tambah Record</button>
@overwrite

@section('jenis-form')
<input type="hidden" name="jenis" value="Dokter Spesialis/DPJP">
@overwrite

@section('tr')
<tr>
    <td>
        <input type="hidden" name="materi[]" value="Perjalanan penyakit">
        Perjalanan penyakit
    </td>
    <td>
        <input type="text" class="js-datepicker form-control" name="tanggal[]" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" value="{{date('d/m/Y', time())}}" required="">
    </td>
    <td>
        <input type="text" autocomplete="off" name="durasi[]" class="form-control" required="">
    </td>
    <td>
        <select name="metode[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Diskusi" selected>A. Diskusi</option>
            <option value="Ceramah">B. Ceramah</option>
            <option value="Praktek">C. Praktek</option>
            <option value="Demo">D. Demo</option>
        </select>
    </td>
    <td>
        <select name="evaluasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Mengerti" selected>A. Mengerti</option>
            <option value="Kurang Mengerti">B. Kurang Mengerti</option>
            <option value="Tidak Mengerti">C. Tidak Mengerti</option>
        </select>
    </td>
    <td>
        <input type="text" autocomplete="off" name="sasaran[]" class="form-control" required="">
    </td>
    <td>
        <select name="alat_edukasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Leaflet/Banner" selected>A. Leaflet/Banner</option>
            <option value="Model/Peraga">B. Model/Peraga</option>
        </select>
    </td>
    <td></td>
</tr>
<tr>
    <td>
        <input type="hidden" name="materi[]" value="Diagnosa">
        Diagnosa
    </td>
    <td>
        <input type="text" class="js-datepicker form-control" name="tanggal[]" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" value="{{date('d/m/Y', time())}}" required="">
    </td>
    <td>
        <input type="text" autocomplete="off" name="durasi[]" class="form-control" required="">
    </td>
    <td>
        <select name="metode[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Diskusi" selected>A. Diskusi</option>
            <option value="Ceramah">B. Ceramah</option>
            <option value="Praktek">C. Praktek</option>
            <option value="Demo">D. Demo</option>
        </select>
    </td>
    <td>
        <select name="evaluasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Mengerti" selected>A. Mengerti</option>
            <option value="Kurang Mengerti">B. Kurang Mengerti</option>
            <option value="Tidak Mengerti">C. Tidak Mengerti</option>
        </select>
    </td>
    <td>
        <input type="text" autocomplete="off" name="sasaran[]" class="form-control" required="">
    </td>
    <td>
        <select name="alat_edukasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Leaflet/Banner" selected>A. Leaflet/Banner</option>
            <option value="Model/Peraga">B. Model/Peraga</option>
        </select>
    </td>
    <td></td>
</tr>
<tr>
    <td>
        <input type="hidden" name="materi[]" value="Hasil pemeriksaan">
        Hasil pemeriksaan
    </td>
    <td>
        <input type="text" class="js-datepicker form-control" name="tanggal[]" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" value="{{date('d/m/Y', time())}}" required="">
    </td>
    <td>
        <input type="text" autocomplete="off" name="durasi[]" class="form-control" required="">
    </td>
    <td>
        <select name="metode[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Diskusi" selected>A. Diskusi</option>
            <option value="Ceramah">B. Ceramah</option>
            <option value="Praktek">C. Praktek</option>
            <option value="Demo">D. Demo</option>
        </select>
    </td>
    <td>
        <select name="evaluasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Mengerti" selected>A. Mengerti</option>
            <option value="Kurang Mengerti">B. Kurang Mengerti</option>
            <option value="Tidak Mengerti">C. Tidak Mengerti</option>
        </select>
    </td>
    <td>
        <input type="text" autocomplete="off" name="sasaran[]" class="form-control" required="">
    </td>
    <td>
        <select name="alat_edukasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Leaflet/Banner" selected>A. Leaflet/Banner</option>
            <option value="Model/Peraga">B. Model/Peraga</option>
        </select>
    </td>
    <td></td>
</tr>
<tr>
    <td>
        <input type="hidden" name="materi[]" value="Tindakan medis">
        Tindakan medis
    </td>
    <td>
        <input type="text" class="js-datepicker form-control" name="tanggal[]" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" value="{{date('d/m/Y', time())}}" required="">
    </td>
    <td>
        <input type="text" autocomplete="off" name="durasi[]" class="form-control" required="">
    </td>
    <td>
        <select name="metode[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Diskusi" selected>A. Diskusi</option>
            <option value="Ceramah">B. Ceramah</option>
            <option value="Praktek">C. Praktek</option>
            <option value="Demo">D. Demo</option>
        </select>
    </td>
    <td>
        <select name="evaluasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Mengerti" selected>A. Mengerti</option>
            <option value="Kurang Mengerti">B. Kurang Mengerti</option>
            <option value="Tidak Mengerti">C. Tidak Mengerti</option>
        </select>
    </td>
    <td>
        <input type="text" autocomplete="off" name="sasaran[]" class="form-control" required="">
    </td>
    <td>
        <select name="alat_edukasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Leaflet/Banner" selected>A. Leaflet/Banner</option>
            <option value="Model/Peraga">B. Model/Peraga</option>
        </select>
    </td>
    <td></td>
</tr>
<tr>
    <td>
        <input type="hidden" name="materi[]" value="Komplikasi">
        Komplikasi
    </td>
    <td>
        <input type="text" class="js-datepicker form-control" name="tanggal[]" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" value="{{date('d/m/Y', time())}}" required="">
    </td>
    <td>
        <input type="text" autocomplete="off" name="durasi[]" class="form-control" required="">
    </td>
    <td>
        <select name="metode[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Diskusi" selected>A. Diskusi</option>
            <option value="Ceramah">B. Ceramah</option>
            <option value="Praktek">C. Praktek</option>
            <option value="Demo">D. Demo</option>
        </select>
    </td>
    <td>
        <select name="evaluasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Mengerti" selected>A. Mengerti</option>
            <option value="Kurang Mengerti">B. Kurang Mengerti</option>
            <option value="Tidak Mengerti">C. Tidak Mengerti</option>
        </select>
    </td>
    <td>
        <input type="text" autocomplete="off" name="sasaran[]" class="form-control" required="">
    </td>
    <td>
        <select name="alat_edukasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Leaflet/Banner" selected>A. Leaflet/Banner</option>
            <option value="Model/Peraga">B. Model/Peraga</option>
        </select>
    </td>
    <td></td>
</tr>
<tr>
    <td>
        <input type="hidden" name="materi[]" value="Perkiraan hari perawatan">
        Perkiraan hari perawatan
    </td>
    <td>
        <input type="text" class="js-datepicker form-control" name="tanggal[]" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" value="{{date('d/m/Y', time())}}" required="">
    </td>
    <td>
        <input type="text" autocomplete="off" name="durasi[]" class="form-control" required="">
    </td>
    <td>
        <select name="metode[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Diskusi" selected>A. Diskusi</option>
            <option value="Ceramah">B. Ceramah</option>
            <option value="Praktek">C. Praktek</option>
            <option value="Demo">D. Demo</option>
        </select>
    </td>
    <td>
        <select name="evaluasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Mengerti" selected>A. Mengerti</option>
            <option value="Kurang Mengerti">B. Kurang Mengerti</option>
            <option value="Tidak Mengerti">C. Tidak Mengerti</option>
        </select>
    </td>
    <td>
        <input type="text" autocomplete="off" name="sasaran[]" class="form-control" required="">
    </td>
    <td>
        <select name="alat_edukasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Leaflet/Banner" selected>A. Leaflet/Banner</option>
            <option value="Model/Peraga">B. Model/Peraga</option>
        </select>
    </td>
    <td></td>
</tr>
<tr>
    <td>
        <input type="hidden" name="materi[]" value="Alternatif pengobatan dan pelayanan">
        Alternatif pengobatan dan pelayanan
    </td>
    <td>
        <input type="text" class="js-datepicker form-control" name="tanggal[]" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" value="{{date('d/m/Y', time())}}" required="">
    </td>
    <td>
        <input type="text" autocomplete="off" name="durasi[]" class="form-control" required="">
    </td>
    <td>
        <select name="metode[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Diskusi" selected>A. Diskusi</option>
            <option value="Ceramah">B. Ceramah</option>
            <option value="Praktek">C. Praktek</option>
            <option value="Demo">D. Demo</option>
        </select>
    </td>
    <td>
        <select name="evaluasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Mengerti" selected>A. Mengerti</option>
            <option value="Kurang Mengerti">B. Kurang Mengerti</option>
            <option value="Tidak Mengerti">C. Tidak Mengerti</option>
        </select>
    </td>
    <td>
        <input type="text" autocomplete="off" name="sasaran[]" class="form-control" required="">
    </td>
    <td>
        <select name="alat_edukasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Leaflet/Banner" selected>A. Leaflet/Banner</option>
            <option value="Model/Peraga">B. Model/Peraga</option>
        </select>
    </td>
    <td></td>
</tr>
<tr>
    <td>
        <input type="hidden" name="materi[]" value="Hasil yang tidak diharapkan">
        Hasil yang tidak diharapkan
    </td>
    <td>
        <input type="text" class="js-datepicker form-control" name="tanggal[]" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" value="{{date('d/m/Y', time())}}" required="">
    </td>
    <td>
        <input type="text" autocomplete="off" name="durasi[]" class="form-control" required="">
    </td>
    <td>
        <select name="metode[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Diskusi" selected>A. Diskusi</option>
            <option value="Ceramah">B. Ceramah</option>
            <option value="Praktek">C. Praktek</option>
            <option value="Demo">D. Demo</option>
        </select>
    </td>
    <td>
        <select name="evaluasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Mengerti" selected>A. Mengerti</option>
            <option value="Kurang Mengerti">B. Kurang Mengerti</option>
            <option value="Tidak Mengerti">C. Tidak Mengerti</option>
        </select>
    </td>
    <td>
        <input type="text" autocomplete="off" name="sasaran[]" class="form-control" required="">
    </td>
    <td>
        <select name="alat_edukasi[]" class="js-select2 form-control" style="width: 100%" required="">
            <option value="Leaflet/Banner" selected>A. Leaflet/Banner</option>
            <option value="Model/Peraga">B. Model/Peraga</option>
        </select>
    </td>
    <td></td>
</tr>
@overwrite
