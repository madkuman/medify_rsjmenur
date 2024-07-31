<div class="row">
    <div class="col-md-6">
        <table class="table-vcenter" cellpadding="5px" style="width: 100%">
            <tr>
                <th width="200px">Kategori</th>
                <td><input type="text" name="kategori_resep_tpn[header][nama_obat]" value="Sediaan TPN" class="form-control has-required"></td>
            </tr>
            <tr>
                <th>Alergi Obat</th>
                <td><input type="text" name="kategori_resep_tpn[header][alergi]" class="form-control"></td>
            </tr>
            <tr>
                <th>BB</th>
                <td>
                    <div class="input-group">
                        <input type="number" name="kategori_resep_tpn[header][berat_badan]" min="0" step="0.01" class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text">Kg</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Diagnosis</th>
                <td><input type="text" name="kategori_resep_tpn[header][diagnosis]" value="{{ $kasus->diagnosisUtama->icd10->long_desc }}" class="form-control"></td>
            </tr>
            <tr>
                <th>Jumlah TPN</th>
                <td><input type="number" name="kategori_resep_tpn[header][jumlah_tpn]" min="0.1" step="0.1" class="form-control has-required"></td>
            </tr>
            <tr>
                <th>Kemasan</th>
                <td><input type="text" name="kategori_resep_tpn[header][kemasan]" class="form-control"></td>
            </tr>
            <tr>
                <th>Rute Pemberian</th>
                <td><input type="text" name="kategori_resep_tpn[header][rute_pemberian]" class="form-control"></td>
            </tr>
            <tr>
                <th>Aturan Penggunaan</th>
                <td><input type="text" name="kategori_resep_tpn[header][aturan_penggunaan]" class="form-control"></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <table class="table table-stripped table-vcenter" style="width: 100%" id="table-kategori-resep-tpn" data-last_index="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th width="200px" style="max-width: 200px">Nama Obat</th>
                    <th>Dosis yang dibutuhkan (ml)</th>
                    <th>Catatan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @include('kasus.datamedis.content.resep.components.form-kategori-resep-tpn-row', ['index' => 0])
            </tbody>
            <tfoot>
                <tr class="table-warning">
                    <th></th>
                    <th>VOLUME TOTAL</th>
                    <th class="total-dosis"></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="total-obat">Rp 0</th>
                    <th></th>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="4" class="text-center">
                        <button type="button" class="btn btn-primary btn-create-row"><i class="fas fa-plus"></i> Tambah Obat</button>
                    </td>
                </tr>
            </tfoot>

        </table>
    </div>
</div>
<hr>

