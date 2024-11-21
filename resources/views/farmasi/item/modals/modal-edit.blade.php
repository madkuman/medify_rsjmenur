<div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="POST" enctype="multipart/form-data"
            action="{{ url('farmasi/' . session('farmasi')->slug . '/item') }}/edit">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $item->id }}">
            <input type="hidden" name="farmasi" value="{{ session('farmasi')->slug }}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Ubah Barang</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Barang"
                                        value="{{ $item->item_detail->nama }}"
                                        @if (session('farmasi')->jenis_detail->nama != 'Gudang') disabled @endif>
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Harga Pasar Barang</label>
                                    @if (count($item->item_detail->harga_perusahaan) > 0)
                                        <select class="form-control js-select2" name="harga"
                                            placeholder="Harga Pasar Barang" required style="width: 100%;"
                                            @if (session('farmasi')->jenis_detail->nama != 'Gudang') disabled @endif>
                                            <option></option>
                                            @forelse($item->item_detail->harga_perusahaan as $harga)
                                                <option @if ($harga->selected) selected @endif
                                                    value="{{ $harga->id }}">{{ $harga->harga }}
                                                    ({{ $harga->supplier->nama ?? '-' }})
                                                </option>
                                            @empty
                                                <option selected="">{{ $item->item_detail->harga }}</option>
                                            @endforelse
                                        </select>
                                    @else
                                        <input type="text" class="form-control" name="harga_default"
                                            placeholder="Harga Pasar Barang" value="{{ $item->item_detail->harga }}"
                                            required="" @if (session('farmasi')->jenis_detail->nama != 'Gudang') disabled @endif>
                                    @endif
                                </div>

                                @if (session('farmasi')->jenis_detail->nama == 'Gudang')
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label for="penyedia">Jenis Barang</label>
                                            <select class="form-control js-select2" name="jenis" style="width: 100%">
                                                <option value="Obat"
                                                    @if ($item->item_detail->jenis == 'Obat') selected @endif>Obat</option>
                                                <option value="Matkes"
                                                    @if ($item->item_detail->jenis == 'Matkes') selected @endif>Matkes</option>
                                                <option value="Alkes"
                                                    @if ($item->item_detail->jenis == 'Alkes') selected @endif>Alkes</option>
                                                <option value="Implan"
                                                    @if ($item->item_detail->jenis == 'Implan') selected @endif>Implan</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="penyedia">Satuan</label>
                                            <input type="text" class="form-control" name="satuan"
                                                placeholder="Satuan Barang" value="{{ $item->item_detail->satuan }}">
                                        </div>
                                        <div class="col-4">
                                            <label for="rute">Rute</label>
                                            <select class="js-select2 form-control" id="rute" name="rute"
                                                style="width: 100%;">
                                                @foreach ($rute as $rute_item)
                                                    @if ($rute_item->id == $rute_id)
                                                        <option value="{{ $rute_item->id }}" selected>
                                                            {{ $rute_item->nama }}</option>
                                                    @else
                                                        <option value="{{ $rute_item->id }}">{{ $rute_item->nama }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="bahan-aktif">Bahan Aktif</label>
                                        <select class="js-select2 form-control" id="bahan-aktif" name="bahan_aktif"
                                            style="width: 100%;">
                                            <option value="" selected disabled>Pilih Bahan Aktif</option>
                                            @foreach ($bahan_aktif as $bahan_aktif_item)
                                                @if ($bahan_aktif_item->id == $bahan_aktif_id)
                                                    <option value="{{ $bahan_aktif_item->id }}" selected>
                                                        {{ $bahan_aktif_item->nama }}</option>
                                                @else
                                                    <option value="{{ $bahan_aktif_item->id }}">
                                                        {{ $bahan_aktif_item->nama }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="kekuatan-sediaan">Kekuatan Sediaan</label>
                                                <input class="form-control" type="number" name="kekuatan_sediaan"
                                                    id="kekuatan-sediaan" step="0.1" autocomplete="off"
                                                    value="{{ $kekuatan_sediaan }}">
                                            </div>
                                            <div class="col-6">
                                                <label for="satuan-kekuatan">Satuan Kekuatan</label>
                                                <select class="js-select2 form-control" id="satuan-kekuatan"
                                                    name="satuan_kekuatan" style="width: 100%;">
                                                    <option value="" selected disabled>Pilih Satuan Kekuatan
                                                    </option>
                                                    @foreach ($satuan_kekuatan as $satuan_kekuatan_item)
                                                        @if ($satuan_kekuatan_item->id == $satuan_kekuatan_id)
                                                            <option value="{{ $satuan_kekuatan_item->id }}" selected>
                                                                {{ $satuan_kekuatan_item->nama }}</option>
                                                        @else
                                                            <option value="{{ $satuan_kekuatan_item->id }}">
                                                                {{ $satuan_kekuatan_item->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Kategori Barang</label>
                                        @php
                                            $kategori_item = $item->item_detail->kategori_item
                                                ->pluck('kategori_id')
                                                ->toArray();
                                        @endphp
                                        <select class="js-select2-multiple form-control" name="kategori[]"
                                            placeholder="Pilih Kategori" multiple="multiple" style="width: 100%;">
                                            @foreach ($kategori as $gori)
                                                <option value="{{ $gori->id }}"
                                                    {{ in_array($gori->id, $kategori_item) ? 'selected' : '' }}>
                                                    {{ $gori->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="kode_barang">Kode Barang</label>
                                        <input type="text" class="form-control" id="kode_barang"
                                            name="kode_barang" placeholder="Kode Barang"
                                            value="{{ $item->item_detail->kode_barang ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="kode_atc">Kode Atc</label>
                                        <input type="text" class="form-control" id="kode_atc" name="kode_atc"
                                            placeholder="Kode Atc" value="{{ $item->item_detail->kode_atc ?? '' }}">
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="penyedia">Satuan</label>
                                        <input type="text" class="form-control" name="satuan"
                                            placeholder="Satuan Barang" value="{{ $item->item_detail->satuan }}"
                                            disabled>
                                    </div>
                                @endif

                                @if (session('farmasi')->consis)
                                    <div class="form-group">
                                        <label class="css-control css-control-lg css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input" name="consis"
                                                id="consis" @if ($item->consis) checked @endif> <span
                                                class="css-control-indicator"></span> Consis
                                        </label>
                                    </div>
                                @endif
                            </div>

                            <!-- apabila gudang farmasi -->
                            @if (session('farmasi')->jenis_detail->nama == 'Gudang')
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kelas-terapi">Kelas Terapi</label>
                                        <select class="js-select2 form-control" id="kelas-terapi" name="kelas_terapi"
                                            style="width: 100%;">
                                            @foreach ($kategori as $kategori_item)
                                                @if ($kategori_item->id == $kelas_terapi_id)
                                                    <option value="{{ $kategori_item->id }}" selected>
                                                        {{ $kategori_item->nama }}</option>
                                                @else
                                                    <option value="{{ $kategori_item->id }}">
                                                        {{ $kategori_item->nama }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="kelas-terapi-fornas">Kelas Terapi Fornas</label>
                                        <select class="js-select2 form-control" id="kelas-terapi-fornas"
                                            name="kelas_terapi_fornas" style="width: 100%;">
                                            @foreach ($kategori as $kategori_item)
                                                @if ($kategori_item->id == $kelas_terapi_fornas_id)
                                                    <option value="{{ $kategori_item->id }}" selected>
                                                        {{ $kategori_item->nama }}</option>
                                                @else
                                                    <option value="{{ $kategori_item->id }}">
                                                        {{ $kategori_item->nama }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="rak-obat">Rak Obat</label>
                                        <select class="js-select2 form-control" id="rak-obat" name="rak_obat"
                                            style="width: 100%;">
                                            @foreach ($rak_obat as $rak_obat_item)
                                                @if ($rak_obat_item->id == $rak_obat_id)
                                                    <option value="{{ $rak_obat_item->id }}" selected>
                                                        {{ $rak_obat_item->nama }}</option>
                                                @else
                                                    <option value="{{ $rak_obat_item->id }}">
                                                        {{ $rak_obat_item->nama }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="formularium-rs">Formularium RS</label>
                                        <select class="js-select2 form-control" id="formularium-rs"
                                            name="is_formularium_rs" style="width: 100%;">
                                            <option value="0">Tidak</option>
                                            <option value="1" @if ($is_formularium_rs) selected @endif>
                                                Ya</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fornas">Fornas</label>
                                        <select class="js-select2 form-control" id="fornas" name="is_fornas"
                                            style="width: 100%;">
                                            <option value="0">Tidak</option>
                                            <option value="1" @if ($is_fornas) selected @endif>
                                                Ya</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Kode Rekening</label>
                                        <select class="js-select2 form-control" id="select-kode-rekening"
                                            name="kode_rekening_id" style="width: 100%;">
                                            <option value=""></option>
                                            @foreach ($master_kode_rekening as $item_temp)
                                                @php $selected = '' @endphp
                                                @if ($item_temp->id == $item->item_detail->kode_rekening_id)
                                                    @php $selected = 'selected' @endphp
                                                @endif
                                                <option value="{{ $item_temp->id }}" {{ $selected }}>
                                                    {{ $item_temp->kode }} - {{ $item_temp->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Kode Bidang</label>
                                        <select class="js-select2 form-control" id="select-kode-bidang"
                                            name="kode_bidang_id" style="width: 100%;">
                                            <option value=""></option>
                                            @foreach ($master_kode_bidang as $item_temp)
                                                @php $selected = '' @endphp
                                                @if ($item_temp->id == $item->item_detail->kode_bidang_id)
                                                    @php $selected = 'selected'; @endphp
                                                @endif
                                                <option value="{{ $item_temp->id }}" {{ $selected }}>
                                                    {{ $item_temp->kode }} - {{ $item_temp->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Dosis Maksimal</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" name="dosis_maksimal"
                                                    placeholder=""
                                                    value="{{ $item->item_detail->dosis_maksimal ?? '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control"
                                                    name="dosis_maksimal_satuan" placeholder="Satuan"
                                                    value="{{ $item->item_detail->dosis_maksimal_satuan ?? '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="div-main-indikasi">
                                        <label>Indikasi</label>
                                        @php
                                            $indikasi = [];
                                            if (!empty($item->item_detail->indikasi)) {
                                                $indikasi = json_decode($item->item_detail->indikasi);
                                            }
                                        @endphp
                                        @if (count($indikasi) > 0)
                                            @foreach ($indikasi as $ind)
                                                <div class="form-group div-item-indikasi">
                                                    <input type="text" class="form-control" name="indikasi[]"
                                                        placeholder="Indikasi" value="{{ $ind }}">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="form-group div-item-indikasi">
                                                <input type="text" class="form-control" name="indikasi[]"
                                                    placeholder="Indikasi">
                                            </div>
                                        @endif
                                    </div>
                                    <span class="btn btn-primary" id="btn-tambah-indikasi"><i class="fa fa-plus"
                                            aria-hidden="true"></i> Tambah</span>

                                </div>
                            @endif

                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">Batasan Low Stock <small>(Opsional)</small></label>
                                    <input type="text" class="form-control" name="batasan_stok"
                                        placeholder="Isi Batasan Low Stock" value="{{ $item->min_stok }}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Batasan Expired <small>(Opsional)</small></label>
                                    <div class="form-inline">
                                        <input type="text" class="form-control mr-sm-2" name="batasan_kadaluarsa"
                                            placeholder="Isikan Angka" value="{{ $item->min_kadaluarsa / $waktu }}">
                                        <select class="form-control mr-sm-2" id="expired-select2" name="satuan_waktu"
                                            data-placeholder="Bulan">
                                            <option value="1"
                                                @if ($waktu == 1) selected @endif)>Hari</option>
                                            <option value="30" @if ($waktu == 30) selected @endif>
                                                Bulan</option>
                                            <option value="365" @if ($waktu == 365) selected @endif>
                                                Tahun</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="batasan_distribusi">Batasan Distribusi
                                        <small>(Opsional)</small></label>
                                    <input type="text" class="form-control" name="batasan_distribusi"
                                        placeholder="Isi Batasan Distribusi Farmasi"
                                        value="{{ $item->max_distribusi }}">
                                </div>
                                @if (session('farmasi')->jenis_detail->nama == 'Gudang')
                                    <div class="form-group">
                                        <label for="penyedia">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan"
                                            placeholder="Keterangan Lebih Lanjut" value="{{ $item->deskripsi }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="retriksi-bpjs">Retriksi BPJS Jumlah</label>
                                        <input class="form-control" type="number" name="retriksi_bpjs_jumlah"
                                            id="retriksi-bpjs" step="0.1" value="{{ $retriksi_bpjs_jumlah }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="retriksi-bpjs-data-lab">Retriksi BPJS Data Lab</label>
                                        <select id="select-retriksi-bpjs-data-lab"
                                            class="js-example-basic-multiple form-control"
                                            name="retriksi_bpjs_data_lab[]" multiple="multiple" style="width: 100%;">
                                            @foreach ($form_lab_pk as $data_lab)
                                                <option value="{{ $data_lab->id }}">{{ $data_lab->parameter }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu/dosage Maksimal</label>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input type="number" class="form-control" name="waktu_dosage_max_1"
                                                    placeholder=""
                                                    value="{{ $item->item_detail->waktu_dosage_max_1 ?? '' }}">
                                            </div>
                                            <div class="col-md-1">
                                                <p style="padding-top: 10px; font-size: 10pt">x</p>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="number" class="form-control" name="waktu_dosage_max_2"
                                                    placeholder=""
                                                    value="{{ $item->item_detail->waktu_dosage_max_2 ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="retriksi-bpjs-data-lab">Mapping Obat BPJS</label>
                                        <select id="select-retriksi-bpjs-data-lab"
                                            class="js-example-basic-multiple form-control" name="mapping_obat_bpjs"
                                            multiple="multiple" style="width: 100%;">
                                            @foreach ($form_lab_pk as $data_lab)
                                                <option value="{{ $data_lab->id }}">{{ $data_lab->parameter }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="retriksi-bpjs-data-lab">Kode Obat BPJS</label>
                                        <input type="text" class="form-control" name="kode_obat_bpjs"
                                            placeholder="Kode Obat BPJS" value="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="retriksi-bpjs-data-lab">Nama Obat BPJS</label>
                                        <input type="text" class="form-control" name="nama_obat_bpjs"
                                            placeholder="Nama Obat BPJS" value="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="retriksi-bpjs-data-lab">Harga Obat BPJS</label>
                                        <input type="text" class="form-control" name="harga_obat_bpjs"
                                            placeholder="Harga Obat BPJS" value="" disabled>
                                    </div>
                                @endif
                            </div>
                        </div>


                        @if (session('farmasi')->jenis_detail->nama == 'Gudang')

                            <!-- interaksi kelas terapi -->
                            <h5 class="mt-2">Interaksi Kelas Terapi</h5>
                            <div class="row" id="row-interaksi-kelas-terapi">
                                @forelse ($item_jenis_interaksi_kelas_terapi as $jenis_interaksi_kelas_terapi_item)
                                    <div class="col-12 main-div-interaksi-kelas-terapi">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label>Nama</label>
                                                    <select class="nama-interaksi-kelas-terapi form-control"
                                                        name="nama_interaksi_kelas_terapi[]" style="width: 100%;">
                                                        @foreach ($kategori as $kategori_item)
                                                            @if ($kategori_item->id == $jenis_interaksi_kelas_terapi_item->kategori_id)
                                                                <option value="{{ $kategori_item->id }}" selected>
                                                                    {{ $kategori_item->nama }}</option>
                                                            @else
                                                                <option value="{{ $kategori_item->id }}">
                                                                    {{ $kategori_item->nama }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label>Jenis Interaksi</label>
                                                    <select class="jenis-interaksi-kelas-terapi form-control"
                                                        name="jenis_interaksi_kelas_terapi[]" style="width: 100%;">
                                                        @foreach ($jenis_interaksi as $jenis_interaksi_item)
                                                            @if ($jenis_interaksi_item->id == $jenis_interaksi_kelas_terapi_item->master_jenis_interaksi_id)
                                                                <option value="{{ $jenis_interaksi_item->id }}"
                                                                    selected>
                                                                    {{ $jenis_interaksi_item->nama }}</option>
                                                            @else
                                                                <option value="{{ $jenis_interaksi_item->id }}">
                                                                    {{ $jenis_interaksi_item->nama }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label>Keterangan</label>
                                                    <input class="form-control" type="text"
                                                        name="keterangan_interaksi_kelas_terapi[]"
                                                        value="{{ $jenis_interaksi_kelas_terapi_item->keterangan }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 main-div-interaksi-kelas-terapi">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label>Nama</label>
                                                    <select class="nama-interaksi-kelas-terapi form-control"
                                                        name="nama_interaksi_kelas_terapi[]" style="width: 100%;">
                                                        @foreach ($kategori as $kategori_item)
                                                            <option value="{{ $kategori_item->id }}">
                                                                {{ $kategori_item->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label>Jenis Interaksi</label>
                                                    <select class="jenis-interaksi-kelas-terapi form-control"
                                                        name="jenis_interaksi_kelas_terapi[]" style="width: 100%;">
                                                        @foreach ($jenis_interaksi as $jenis_interaksi_item)
                                                            <option value="{{ $jenis_interaksi_item->id }}">
                                                                {{ $jenis_interaksi_item->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label>Keterangan</label>
                                                    <input class="form-control" type="text"
                                                        name="keterangan_interaksi_kelas_terapi[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            <span class="btn btn-primary" id="btn-tambah-interaksi-kelas-terapi"><i
                                    class="fa fa-plus" aria-hidden="true"></i> Tambah</span>

                            <!-- interaksi obat -->
                            <br>
                            <br>
                            <h5 class="mt-2">Interaksi Obat</h5>
                            <div class="row" id="row-interaksi-obat">
                                @forelse ($item_jenis_interaksi_obat as $jenis_interaksi_obat_item)
                                    <div class="col-12 main-div-interaksi-obat">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label>Nama</label>
                                                    <select class="nama-interaksi-obat form-control"
                                                        name="nama_interaksi_obat[]" style="width: 100%;">
                                                        @foreach ($item_template as $template_item)
                                                            @if ($template_item->id == $jenis_interaksi_obat_item->item_template_interaksi_id)
                                                                <option value="{{ $template_item->id }}" selected>
                                                                    {{ $template_item->nama }}</option>
                                                            @else
                                                                <option value="{{ $template_item->id }}">
                                                                    {{ $template_item->nama }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label>Jenis Interaksi</label>
                                                    <select class="jenis-interaksi-obat form-control"
                                                        name="jenis_interaksi_obat[]" style="width: 100%;">
                                                        @foreach ($jenis_interaksi as $jenis_interaksi_item)
                                                            @if ($jenis_interaksi_item->id == $jenis_interaksi_obat_item->master_jenis_interaksi_id)
                                                                <option value="{{ $jenis_interaksi_item->id }}"
                                                                    selected>
                                                                    {{ $jenis_interaksi_item->nama }}</option>
                                                            @else
                                                                <option value="{{ $jenis_interaksi_item->id }}">
                                                                    {{ $jenis_interaksi_item->nama }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label>Keterangan</label>
                                                    <input class="form-control" type="text"
                                                        name="keterangan_interaksi_obat[]"
                                                        value="{{ $jenis_interaksi_obat_item->keterangan }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 main-div-interaksi-obat">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label>Nama</label>
                                                    <select class="nama-interaksi-obat form-control"
                                                        name="nama_interaksi_obat[]" style="width: 100%;">
                                                        @foreach ($item_template as $template_item)
                                                            <option value="{{ $template_item->id }}">
                                                                {{ $template_item->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label>Jenis Interaksi</label>
                                                    <select class="jenis-interaksi-obat form-control"
                                                        name="jenis_interaksi_obat[]" style="width: 100%;">
                                                        @foreach ($jenis_interaksi as $jenis_interaksi_item)
                                                            <option value="{{ $jenis_interaksi_item->id }}">
                                                                {{ $jenis_interaksi_item->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label>Keterangan</label>
                                                    <input class="form-control" type="text"
                                                        name="keterangan_interaksi_obat[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            <span class="btn btn-primary" id="btn-tambah-interaksi-obat"><i class="fa fa-plus"
                                    aria-hidden="true"></i> Tambah</span>
                            <!-- end interaksi obat -->
                        @endif

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square"
                        data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary btn-square">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
