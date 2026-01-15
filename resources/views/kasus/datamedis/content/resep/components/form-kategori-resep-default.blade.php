<table class="table table-stripped" style="width: 100%" id="table-kategori-resep-default" data-last_index="0">
    <thead>
        <th width="1">#</th>
        <th width="150px">Kategori</th>
        <th>Nama</th>
        <th width="200px">Dosis</th>
        <th width="100px" class="only-bpjs">Restriksi</th>
        <th width="100px">Kekuatan</th>
        <th width="200px">Jumlah Obat</th>
        <th width="200px">Satuan/Tipe</th>
        <th width="200px">Aturan Penggunaan</th>
        <th width="200px">Harga Total</th>
        <th width="1"></th>
    </thead>
    <tbody>
        @include('kasus.datamedis.content.resep.components.form-kategori-resep-default-row', ['index' => 0])
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td colspan="10" class="text-center">
                <button type="button" class="btn btn-primary btn-create-row"><i class="fas fa-plus"></i> Tambah Obat</button>
            </td>
        </tr>
    </tfoot>
</table>
