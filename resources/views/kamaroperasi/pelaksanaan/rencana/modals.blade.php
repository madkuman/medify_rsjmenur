<div class="modal fade" id="modal-rencana-kegiatan" tabindex="-1" role="dialog" aria-labelledby="modal-popin"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popin" role="document">
        <div class="modal-content">
            <form action="rencana" method="post" id="">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-content">
                        <h3 class="block-title">Rencana Kegiatan Operasi</h3>
                        <br>
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $transaksi->id }}">
                        <textarea name="deskripsi" class="js-summernote">
                    {{ $transaksi->deskripsi_rencana }}
                  </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-alt-primary">
                        <i class="fa fa-check"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-rencana-alat" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-content">
                    <form action="rencana/submit" method="post" id="rencana_alat_form">
                        <h3 class="block-title">Rencana Alkes, Matkes, Obat & Implan</h3>
                        <div class="row form_paket">
                            <div class="col-12">
                                <label>Pilih Farmasi</label>
                                <select class="js-select2 form-control" tipe="rencana" style="width: 100%;"
                                    name="farmasi_tujuan" data-placeholder="Pilih Farmasi">
                                    @foreach ($farmasi as $f)
                                        <option value="{{ $f->id }}"
                                            @if (!empty($transaksi->transaksi_obat)) @if ($transaksi->transaksi_obat->farmasi_asal->id == $f->id) 
                      selected @endif
                                            @endif>{{ $f->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <ul class="nav nav-tabs nav-tabs-block row" data-toggle="tabs" role="tablist">
                            <li class="nav-item col-3 text-center">
                                <a class="nav-link active" href="#alkes">Alkes</a>
                            </li>
                            <li class="nav-item col-3 text-center">
                                <a class="nav-link" href="#matkes">Matkes</a>
                            </li>
                            <li class="nav-item col-3 text-center">
                                <a class="nav-link" href="#obat">Obat</a>
                            </li>
                            <li class="nav-item col-3 text-center">
                                <a class="nav-link" href="#implan">Implan</a>
                            </li>
                        </ul>
                        {{ csrf_field() }}
                        <input type="hidden" id="transaksi_id" name="id" value="{{ $transaksi->id }}">
                        <div class="block-content tab-content">
                            <div class="tab-pane active" id="alkes" role="tabpanel">


                                <div class="row form_paket">
                                    <div class="col-12">
                                        <label>Paket Alkes</label>
                                        <select class="js-select2 form-control select2_paket select2_paket_alkes"
                                            tipe="rencana" id="rencana_paket_alkes" style="width: 100%;"
                                            name="paket_alkes" data-placeholder="Pilih Paket">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="appended_form" jenis="alkes" tipe="rencana" id="form_rencana_alkes"></div>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-primary plus_button add_more_alkes"
                                            tipe="rencana"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="matkes" role="tabpanel">
                                <div class="row form_paket">
                                    <div class="col-12">
                                        <label>Paket Matkes</label>
                                        <select class="js-select2 form-control select2_paket select2_paket_matkes"
                                            tipe="rencana" id="rencana_paket_alkes" style="width: 100%;"
                                            name="paket_alkes" data-placeholder="Pilih Paket">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="appended_form" jenis="matkes" tipe="rencana" id="form_rencana_matkes">
                                </div>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-primary plus_button add_more_matkes"
                                            tipe="rencana"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="obat" role="tabpanel">
                                <div class="row form_paket">
                                    <div class="col-12">
                                        <label>Paket Obat</label>
                                        <select class="js-select2 form-control select2_paket select2_paket_obat"
                                            tipe="rencana" id="rencana_paket_alkes" style="width: 100%;"
                                            name="paket_alkes" data-placeholder="Pilih Paket">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="appended_form" jenis="obat" tipe="rencana" id="form_rencana_obat">
                                </div>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-primary plus_button add_more_obat"
                                            tipe="rencana"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="implan" role="tabpanel">
                                <div class="row form_paket">
                                    <div class="col-12">
                                        <label>Paket Implan</label>
                                        <select class="js-select2 form-control select2_paket select2_paket_implan"
                                            tipe="rencana" id="rencana_paket_alkes" style="width: 100%;"
                                            name="paket_alkes" data-placeholder="Pilih Paket">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="appended_form" jenis="implan" tipe="rencana" id="form_rencana_implan">
                                </div>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-primary plus_button add_more_implan"
                                            tipe="rencana"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary"
                                data-dismiss="modal">Batalkan</button>
                            <button type="button" class="btn btn-alt-primary submit_item" tipe="rencana">
                                <i class="fa fa-check"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-hasil-operasi" tabindex="-1" role="dialog" aria-labelledby="modal-popin"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popin" role="document">
        <div class="modal-content">
            <form action="pasca" method="post" id="">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-content">
                        <h3 class="block-title">Hasil Operasi</h3>
                        <br>
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $transaksi->id }}">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Diagnosa Awal</label>
                                    @if (!empty($transaksi->parent_id))
                                        <input type="text" name="diag_awal" class="form-control"
                                            placeholder="Diagnosa pasien sebelum operasi"
                                            value="{{ $transaksi->hasil ? $transaksi->hasil->diagnosis_awal : $transaksi->parent->diagnosis }}"
                                            required>
                                    @else
                                        <input type="text" name="diag_awal" class="form-control"
                                            placeholder="Diagnosa pasien sebelum operasi"
                                            value="{{ $transaksi->hasil ? $transaksi->hasil->diagnosis_awal : $transaksi->diagnosis }}"
                                            required>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Diagnosa Akhir</label>
                                    @if (!empty($transaksi->parent_id))
                                        <input type="text" name="diag_akhir" class="form-control"
                                            placeholder="Diagnosa pasien setelah operasi"
                                            value="{{ $transaksi->hasil ? $transaksi->hasil->diagnosis_akhir : $transaksi->parent->diagnosis }}"
                                            required>
                                    @else
                                        <input type="text" name="diag_akhir" class="form-control"
                                            placeholder="Diagnosa pasien setelah operasi"
                                            value="{{ $transaksi->hasil ? $transaksi->hasil->diagnosis_akhir : $transaksi->diagnosis }}"
                                            required>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Persiapan</label>
                                    <textarea name="persiapan" rows="3" class="form-control" placeholder="Hal yang dilakukan sebelum operasi"
                                        required>{{ $transaksi->hasil ? $transaksi->hasil->persiapan : '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Posisi Pasien</label>
                                    <input type="text" name="posisi" class="form-control"
                                        placeholder="Posisi pasien saat dioperasi"
                                        value="{{ $transaksi->hasil ? $transaksi->hasil->posisi : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Disinfektan</label>
                                    <input type="text" name="disinfektan" class="form-control"
                                        placeholder="Disinfektan yang digunakan"
                                        value="{{ $transaksi->hasil ? $transaksi->hasil->disinfektan : '' }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Incisi</label>
                                    <input type="text" name="incisi" class="form-control"
                                        placeholder="Incisi yang dilakukan"
                                        value="{{ $transaksi->hasil ? $transaksi->hasil->incisi : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Temuan Operasi</label>
                                    {{-- <input type="text" name="temuan" class="form-control"
                                        placeholder="Temuan pasca operasi"
                                        value="{{ $transaksi->hasil ? $transaksi->hasil->temuan_operasi : '' }}"
                                        required> --}}
                                    <textarea name="temuan" rows="4" class="form-control" placeholder="Temuan pasca operasi" required>{{ $transaksi->hasil ? $transaksi->hasil->temuan_operasi : '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tindakan Operasi</label>
                                    <textarea name="tindakan" rows="3" class="form-control" placeholder="Tindakan yang dilakukan saat operasi"
                                        required>{{ $transaksi->hasil ? $transaksi->hasil->tindakan : '' }}</textarea>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Pendarahan</label>
                                    <input type="text" name="pendarahan" class="form-control"
                                        placeholder="Jumlah pendarahan yang terjadi pada pasien"
                                        value="{{ $transaksi->hasil ? $transaksi->hasil->pendarahan : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Advice Post Ops</label>
                                    <textarea name="advice" rows="3" class="form-control" placeholder="Saran yang diberikan pasca operasi"
                                        required>{{ $transaksi->hasil ? $transaksi->hasil->advice_post : '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Pemeriksaan PA</label>
                                    <select class="form-control" style="width: 100%;" name="pemeriksaan_pa" required>
                                        <option value="" {{ $transaksi->hasil ? '' : 'selected' }} disabled>--
                                            Pilih --</option>
                                        <option value="ya"
                                            {{ $transaksi->hasil ? ($transaksi->hasil->pemeriksaan_pa == 'ya' ? 'selected' : '') : '' }}>
                                            Ya</option>
                                        <option value="tidak"
                                            {{ $transaksi->hasil ? ($transaksi->hasil->pemeriksaan_pa == 'tidak' ? 'selected' : '') : '' }}>
                                            Tidak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Operasi</label>
                                    <select class="form-control" style="width: 100%;" name="jenis_operasi" required>
                                        <option value="" {{ $transaksi->hasil ? '' : 'selected' }} disabled>--
                                            Pilih --</option>
                                        @foreach ($jenis_operasi as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $transaksi->hasil ? ($transaksi->hasil->jenis_operasi == $item->id ? 'selected' : '') : '' }}>
                                                {{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Operasi</label>
                                    <input type="text" class="js-datepicker form-control" name="tanggal"
                                        data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                        data-date-format="dd MM yyyy" placeholder="dd/mm/yy"
                                        value="{{ $transaksi->hasil ? $transaksi->hasil->tanggal_operasi->format('d F Y') : '' }}"
                                        required autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Waktu Mulai</label>
                                    <input type="text" class="js-masked-time form-control" name="waktu_mulai"
                                        placeholder="00:00"
                                        value="{{ $transaksi->hasil ? $transaksi->hasil->waktu_mulai : '' }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Waktu Selesai</label>
                                    <input type="text" class="js-masked-time form-control" name="waktu_selesai"
                                        placeholder="00:00"
                                        value="{{ $transaksi->hasil ? $transaksi->hasil->waktu_selesai : '' }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Lama Anastesi</label>
                                    <input type="text" class="js-masked-time form-control" name="anastesi"
                                        placeholder="00:00"
                                        value="{{ $transaksi->hasil ? $transaksi->hasil->lama_anastesi : '' }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Macam Anastesi</label>
                                    <select class="form-control" style="width: 100%;" name="macam_anestesi" required>
                                        <option value="" {{ $transaksi->hasil ? '' : 'selected' }} disabled>--
                                            Pilih --</option>
                                        <option value="general"
                                            {{ $transaksi->hasil ? ($transaksi->hasil->jenis_operasi == 'besar' ? 'selected' : '') : '' }}>
                                            General Anestesi</option>
                                        <option value="regional"
                                            {{ $transaksi->hasil ? ($transaksi->hasil->jenis_operasi == 'sedang' ? 'selected' : '') : '' }}>
                                            Regional Anestesi</option>
                                        <option value="local"
                                            {{ $transaksi->hasil ? ($transaksi->hasil->jenis_operasi == 'kecil' ? 'selected' : '') : '' }}>
                                            Local Anestesi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status Pasien</label>
                                    <select class="form-control" style="width: 100%;" name="status_pasien" required>
                                        <option value="" {{ $transaksi->hasil ? '' : 'selected' }} disabled>--
                                            Pilih --</option>
                                        <option value="Hidup"
                                            {{ $transaksi->hasil ? ($transaksi->hasil->status_pasien == 'Hidup' ? 'selected' : '') : '' }}>
                                            Hidup</option>
                                        <option value="Mati"
                                            {{ $transaksi->hasil ? ($transaksi->hasil->status_pasien == 'Mati' ? 'selected' : '') : '' }}>
                                            Mati</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-alt-primary">
                        <i class="fa fa-check"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-tim" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popin" role="document">
        <div class="modal-content">
            <form action="rencana/tim" method="post" id="submit_tim">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-content">
                        <h3 class="block-title">Tim Operasi</h3>
                        <br>
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $transaksi->id }}">
                        <div id="form_tim">
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-primary plus_button" id="add_more_tim"><i
                                        class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="button" id="tim_submit_button" class="btn btn-alt-primary">
                        <i class="fa fa-check"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-pemakaian-alat" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-content">
                    <h3 class="block-title">Pemakaian Alkes, Matkes, Obat & Implan</h3>
                    <form action="pemakaian/submit" method="post" id="pemakaian_form">
                        <div class="row form_paket">
                            <div class="col-12">
                                <label>Pilih Farmasi</label>
                                <select class="js-select2 form-control" tipe="rencana" style="width: 100%;"
                                    name="farmasi_tujuan" data-placeholder="Pilih Farmasi">
                                    @foreach ($farmasi as $f)
                                        <option value="{{ $f->id }}"
                                            @if (!empty($transaksi->transaksi_obat)) @if ($transaksi->transaksi_obat->farmasi_asal->id == $f->id) 
                      selected @endif
                                            @endif>{{ $f->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <ul class="nav nav-tabs nav-tabs-block row" data-toggle="tabs" role="tablist">
                            <li class="nav-item col-3 text-center">
                                <a class="nav-link active" href="#alkes_pemakaian">Alkes</a>
                            </li>
                            <li class="nav-item col-3 text-center">
                                <a class="nav-link" href="#matkes_pemakaian">Matkes</a>
                            </li>
                            <li class="nav-item col-3 text-center">
                                <a class="nav-link" href="#obat_pemakaian">Obat</a>
                            </li>
                            <li class="nav-item col-3 text-center">
                                <a class="nav-link" href="#implan_pemakaian">Implan</a>
                            </li>
                        </ul>
                        {{ csrf_field() }}
                        <input type="hidden" id="transaksi_id" name="id" value="{{ $transaksi->id }}">
                        <input type="hidden" name="nama_obat" id="nama_obat">
                        <div class="block-content tab-content">
                            <div class="tab-pane active" id="alkes_pemakaian" role="tabpanel">
                                <div class="row form_paket">
                                    <div class="col-12">
                                        <label>Paket Alkes</label>
                                        <select class="js-select2 form-control select2_paket select2_paket_alkes"
                                            tipe="pemakaian" id="rencana_paket_alkes" style="width: 100%;"
                                            name="paket_alkes" data-placeholder="Pilih Paket">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="appended_form" jenis="alkes" tipe="pemakaian"
                                    id="form_pemakaian_alkes">
                                </div>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-primary plus_button add_more_alkes"
                                            tipe="pemakaian"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="matkes_pemakaian" role="tabpanel">
                                <div class="row form_paket">
                                    <div class="col-12">
                                        <label>Paket Matkes</label>
                                        <select class="js-select2 form-control select2_paket select2_paket_matkes"
                                            tipe="pemakaian" id="rencana_paket_alkes" style="width: 100%;"
                                            name="paket_alkes" data-placeholder="Pilih Paket">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="appended_form" jenis="matkes" tipe="pemakaian"
                                    id="form_pemakaian_matkes"></div>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-primary plus_button add_more_matkes"
                                            tipe="pemakaian"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="obat_pemakaian" role="tabpanel">
                                <div class="row form_paket">
                                    <div class="col-12">
                                        <label>Paket Obat</label>
                                        <select class="js-select2 form-control select2_paket select2_paket_obat"
                                            tipe="pemakaian" id="rencana_paket_alkes" style="width: 100%;"
                                            name="paket_alkes" data-placeholder="Pilih Paket">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="appended_form" jenis="obat" tipe="pemakaian" id="form_pemakaian_obat">
                                </div>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-primary plus_button add_more_obat"
                                            tipe="pemakaian"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="implan_pemakaian" role="tabpanel">
                                <div class="row form_paket">
                                    <div class="col-12">
                                        <label>Paket Implan</label>
                                        <select class="js-select2 form-control select2_paket select2_paket_implan"
                                            tipe="pemakaian" id="rencana_paket_alkes" style="width: 100%;"
                                            name="paket_alkes" data-placeholder="Pilih Paket">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="appended_form" jenis="implan" tipe="pemakaian"
                                    id="form_pemakaian_implan"></div>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-primary plus_button add_more_implan"
                                            tipe="pemakaian"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary"
                                data-dismiss="modal">Batalkan</button>
                            <button type="button" class="btn btn-alt-primary submit_item" tipe="pemakaian">
                                <i class="fa fa-check"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-pengembalian-alat" role="dialog" aria-labelledby="modal-popin"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-content">
                    <h3 class="block-title">Pengembalian Alkes ke CSSD</h3>
                    <br>
                    <ul class="nav nav-tabs nav-tabs-block row" data-toggle="tabs" role="tablist">
                        <li class="nav-item col-12 text-center">
                            <a class="nav-link active" href="#alkes_pengembalian">Alkes</a>
                        </li>
                        {{--
                    <!-- <li class="nav-item col-3 text-center">
                        <a class="nav-link" href="#matkes_pengembalian">Matkes</a>
                    </li>
                    <li class="nav-item col-3 text-center">
                        <a class="nav-link" href="#obat_pengembalian">Obat</a>
                    </li>
                    <li class="nav-item col-3 text-center">
                        <a class="nav-link" href="#implan_pengembalian">Implan</a>
                    </li> -->
                    --}}
                    </ul>
                    <form action="pengembalian/submit" method="post" id="rencana_alat_form">
                        {{ csrf_field() }}
                        <input type="hidden" id="transaksi_id" name="id" value="{{ $transaksi->id }}">
                        <div class="block-content tab-content">
                            <div class="tab-pane active" id="alkes_pengembalian" role="tabpanel">
                                <div class="row form_paket">
                                    <div class="col-12">
                                        <label>Paket Alkes</label>
                                        <select class="js-select2 form-control select2_paket select2_paket_alkes"
                                            tipe="pengembalian" id="rencana_paket_alkes" style="width: 100%;"
                                            name="paket_alkes" data-placeholder="Pilih Paket">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="appended_form" jenis="alkes" tipe="pengembalian"
                                    id="form_pengembalian_alkes"></div>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-primary plus_button add_more_alkes"
                                            tipe="pengembalian"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            {{--
                      <!-- <div class="tab-pane" id="matkes_pengembalian" role="tabpanel">
                        <div class="row form_paket">
                          <div class="col-12">
                            <label>Paket Matkes</label>
                            <select class="js-select2 form-control select2_paket select2_paket_matkes" tipe="pengembalian" id="rencana_paket_alkes" style="width: 100%;" name="paket_alkes" data-placeholder="Pilih Paket">
                              <option></option>
                            </select>
                          </div>
                        </div>
                        <div class="appended_form" jenis="matkes" tipe="pengembalian" id="form_pengembalian_matkes"></div>

                        <div class="row">
                          <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary plus_button add_more_matkes" tipe="pengembalian"><i class="fa fa-plus"></i></button>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane" id="obat_pengembalian" role="tabpanel">
                        <div class="row form_paket">
                          <div class="col-12">
                            <label>Paket Obat</label>
                            <select class="js-select2 form-control select2_paket select2_paket_obat" tipe="pengembalian" id="rencana_paket_alkes" style="width: 100%;" name="paket_alkes" data-placeholder="Pilih Paket">
                              <option></option>
                            </select>
                          </div>
                        </div>
                        <div class="appended_form" jenis="obat" tipe="pengembalian" id="form_pengembalian_obat"></div>

                        <div class="row">
                          <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary plus_button add_more_obat" tipe="pengembalian"><i class="fa fa-plus"></i></button>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane" id="implan_pengembalian" role="tabpanel">
                        <div class="row form_paket">
                          <div class="col-12">
                            <label>Paket Implan</label>
                            <select class="js-select2 form-control select2_paket select2_paket_implan" tipe="pengembalian" id="rencana_paket_alkes" style="width: 100%;" name="paket_alkes" data-placeholder="Pilih Paket">
                              <option></option>
                            </select>
                          </div>
                        </div>
                        <div class="appended_form" jenis="implan" tipe="pengembalian" id="form_pengembalian_implan"></div>

                        <div class="row">
                          <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary plus_button add_more_implan" tipe="pengembalian"><i class="fa fa-plus"></i></button>
                          </div>
                        </div>
                      </div> -->
                      --}}

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary"
                                data-dismiss="modal">Batalkan</button>
                            <button type="button" class="btn btn-alt-primary submit_item" tipe="pengembalian">
                                <i class="fa fa-check"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($transaksi->kasus_id)
    <div class="modal fade" id="modal-plafon" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-popin" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-content">
                        <h3 class="block-title">Ganti Plafon</h3>
                    </div>
                    <div class="block-content">
                        <form action="ganti_plafon" method="post" id="rencana_alat_form">
                            {{ csrf_field() }}
                            <input type="hidden" name="transaksi_id" value="{{ $transaksi->id }}">
                            <select class="form-control" data-placeholder="Pilih Paket" name="sep_id">
                                @foreach ($sep_list as $sep)
                                    <option value="{{ $sep->id }}"
                                        {{ $transaksi->kasus->sep_id == $sep->id ? 'selected' : '' }}>
                                        {{ $sep->no_sep }} - Sisa Plafon {{ number_format($sep->sisa_plafon) }}
                                        {{ $transaksi->kasus->sep_id == $sep->id ? '(Aktif)' : '' }}</option>
                                @endforeach
                            </select>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-alt-secondary"
                                    data-dismiss="modal">Batalkan</button>
                                <button type="button" class="btn btn-alt-primary submit_item" tipe="pengembalian">
                                    <i class="fa fa-check"></i> Ganti
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
