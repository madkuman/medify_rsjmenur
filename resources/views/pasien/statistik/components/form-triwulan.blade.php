<p class="mb-30">Pilih tanggal yang anda butuhkan.</p>
<div class="form-group">
    <label>Pilih Triwulan</label>
    <select name="triwulan" id="triwulan" class="form-control" required>
        <option value="1" @if($triwulan == 1) selected @endif>1</option>
        <option value="2" @if($triwulan == 2) selected @endif>2</option>
        <option value="3" @if($triwulan == 3) selected @endif>3</option>
        <option value="4" @if($triwulan == 4) selected @endif>4</option>
    </select>
</div>
@include('pasien.statistik.components.form-date-tahun')