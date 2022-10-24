<div id="create-modal-content-perawat-manual">
    <input type="hidden" name="kategori-tindakan" value="keperawatan">
    <div class="row">
        <div class="col-lg-3 col-md-12 col-xs-12 perawat-class">
            <label class="">Jenis Tindakan</label>
            <div class="form-group">
                <select class="form-control" id="tipe_tarif_manual" name="tipe_tarif" required="">
                    @foreach ($tarif_tipe as $item)
                    <option value="{{$item->id}}" data-slug="{{$item->slug}}">{{$item->nama}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-9 col-md-12 col-xs-12 perawat-class">
            <div class="row">
                <label class="col-12" for="">Cari Tindakan</label>
                <div class="col-12">
                    <input type="text" class="form-control form-control-lg"   placeholder="Deskripsi Tindakan" id="tindakan-perawat-manual" autocomplete="off">
                    <div>Bingung mencari tarif? <a href="javascript:void(0)" onclick="lihatDaftarTarif()">Lihat Daftar Tarif Disini</a></div>
                </div>
            </div>
        </div>

        <div class="col-12 form-group">
            <small>Menampilkan <span id="perawat-total-hasil-manual"></span> Hasil Pencarian</small>
        </div>
    </div>

    <div class="top-tindakan" id="top-tindakan-manual">

        <table table class="table table-striped table-hover">
            <tr class="header">
                <th style="width:60%">Nama Tindakan</th>
                <th class="full-only" style="width:25%">Harga</th>
                <th style="width:25%">Aksi</th>
            </tr>
        </table>
        <div class="form-group" data-toggle="slimscroll" data-height="350px" data-always-visible="true"  data-size="8px">
            <div class="hasil-pencarian hide" id="hasil-pencarian-manual">
            </div>
            <div class="pt-100 text-center " id="loading-tindakan-perawat-search-manual">
                <span class="fa fa-4x fa-spinner fa-spin text-primary text-center loader"></span>
            </div>
            <div class="block-content hasil-pencarian text-center pt-100" id="hasil-pencarian-empty-manual">
                <h4 class="mb-10">Tidak Ditemukan untuk Keyword "<span id="create-tindakan-perawat-keyword-manual"></span>" dan tipe tarif "<span id="create-tindakan-perawat-tipe-manual"></span>"</h4>
                <h5><small>Coba Gunakan Kata Kunci Lainnya</small></h5>
            </div>
        </div>
    </div>
</div>