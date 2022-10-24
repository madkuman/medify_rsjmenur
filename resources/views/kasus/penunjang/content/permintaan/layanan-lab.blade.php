<div class="col-12 ajax-container" style="padding-top: 10px; display: none;" id="emptyContainer">
    <div class="alert alert-danger" role="alert">
        <h3 class="alert-heading font-size-h4 font-w400">Layanan Tidak Tersedia</h3>
        <p class="mb-0">Tidak ada tarif yang sesuai dengan permintaan</p>
    </div>
</div>
<div class="col-12 ajax-container" style="padding-top: 10px; display: none;" id="errorContainer">
    <div class="alert alert-warning" role="alert">
        <h3 class="alert-heading font-size-h4 font-w400">Kesalahan pada Server</h3>
        <p class="mb-0">Terjadi kesalahan pada server,
            <button type="button" onclick="changeForm();" class="btn btn-info">Coba Lagi</button>
        </p>
    </div>
</div>
<div class="col-12 ajax-container" style="padding-top: 10px; display: none;" id="layananContainer">
    <h4 style="margin-bottom: 15px;" id="judulLayanan">NAMA LAYANAN</h4>
    <!-- class="search" automagically makes an input a search field. -->
    <input class="form-control" placeholder="Cari disini..." type="text" id="searchField" onkeyup="filterLayanan(this)" />
    <!-- class="sort" automagically makes an element a sort buttons. The date-sort value decides what to sort by. -->
    <div class="form-layanan row block-content" id="layananDiv">
        <!-- KODINGANNYA HARUSNYA DISINI -->
    </div>
</div>