<table class="table table-stripped table-vcenter" style="width: 100%" id="table-kategori-resep-dispensing_aseptik" data-last_index="0">
    <thead>
        <th width="1">No</th>
        <th width="150px">Permintaan Obat</th>
        <th width="150px">Dosis Yang dibutuhkan</th>
        <th width="100px">Dosis (mL)</th>
        <th width="100px">Nama Pelarut</th>
        <th width="200px">Nama IV Admx.</th>
        <th width="200px">Volume Akhir Campuran (mL)</th>
        <th width="200px">Aturan Pakai</th>
        <th width="200px">Catatan</th>
        <th width="1"></th>
    </thead>
    <tbody>
        @include('kasus.datamedis.content.resep.components.form-kategori-resep-dispensing_aseptik-row', ['index' => 0])
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td colspan="9" class="text-center">
                <button type="button" class="btn btn-primary btn-create-row"><i class="fas fa-plus"></i> Tambah Obat</button>
            </td>
        </tr>
    </tfoot>
</table>
