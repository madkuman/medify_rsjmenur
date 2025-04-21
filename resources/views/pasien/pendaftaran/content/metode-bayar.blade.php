<div class="row">
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-group">
                    <label> Asal Rujukan </label>
                    <select class="form-control asal-rujukan-select" name="asal_rujukan">
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Metode Pembayaran</label>
                    <select name="metode" class="form-control js-select2" data-size="5" id="selectPembayaran"
                        style="width: 100%;">
                        @foreach ($metode as $item)
                            @if (!empty($item->kelas_id))
                                @if (empty($item->perusahaan))
                                    <option value="{{ $item->id }}" data-bpjs="no" data-tunai='yes'
                                        {{ $item->utama ? 'selected' : '' }}>Umum</option>
                                @else
                                    @if ($item->perusahaan->tipe->slug == 'bpjs')
                                        <option value="{{ $item->id }}" data-bpjs="yes" data-tunai='no'
                                            {{ $item->utama ? 'selected' : '' }}>BPJS - {{ $item->perusahaan->nama }}
                                        </option>
                                    @elseif($item->perusahaan->tipe->slug == 'tunai')
                                        <option value="{{ $item->id }}" data-bpjs="no" data-tunai='yes'
                                            {{ $item->utama ? 'selected' : '' }}>Umum - {{ $item->perusahaan->nama }}
                                        </option>
                                    @else
                                        <option value="{{ $item->id }}" data-bpjs="no" data-tunai='no'
                                            {{ $item->utama ? 'selected' : '' }}>Asuransi -
                                            {{ $item->perusahaan->nama }}</option>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="block block-bordered">
                        <div class="block-content">
                            <div id="InfoPembayaran" class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (config('app.bpjs_enable', false))
                @include('pasien.pendaftaran.content.bpjs_sep_form')
            @endif
            <div class="col-md-12">
                <div class="block block-bordered" id="infoSEP" style="display: none">
                    <div class="block-content">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="mb-5 text-muted text-uppercase">Sisa Plafon</h6>
                                <h3 id="sisaPlafon"></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 pilih-poli">
                <div class="form-group">
                    <label class="control-label">Kelas</label>
                    <select name="metode" class="form-control js-select2 select-kelas" data-size="5"
                        id="selectKelasPoli" style="width: 100%;">
                        @foreach ($kelas_rj as $item)
                            <option value="{{ $item->id }}" @if ($loop->first) selected @endif>
                                {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12 pilih-igd">
                <div class="form-group">
                    <label class="control-label">Kelas</label>
                    <select name="metode" class="form-control js-select2 select-kelas" data-size="5"
                        id="selectKelasIGD" style="width: 100%;">
                        @foreach ($kelas_igd as $item)
                            <option value="{{ $item->id }}" @if ($loop->first) selected @endif>
                                {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12 pilih-medical-checkup">
                <div class="form-group">
                    <label class="control-label">Kelas</label>
                    <select name="metode" class="form-control js-select2 select-kelas" data-size="5"
                        id="selectKelasMedicalCheckup" style="width: 100%;">
                        @foreach ($kelas_medical_checkup as $item)
                            <option value="{{ $item->id }}" @if ($loop->first) selected @endif>
                                {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="py-10 text-center font-w600 bg-danger text-white mb-20 align-middle"
                    id="error-wrapper-kelas" style="display: none;">
                    <i class="fa fa-exclamation-circle mr-5"></i>
                    <span></span>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="form-group">
                    <input class="form-control" type="hidden" name="pasien_id" id="pasien_id"
                        value="{{ $identitas->id }}" />
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="form-group">
                    <label> Jenis Kunjungan BPJS </label><br>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kunjungan" value="1">
                        <label class="form-check-label" required>
                            Rujukan FKTP
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kunjungan" value="4">
                        <label class="form-check-label" required>
                            Rujukan RS
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kunjungan" value="3">
                        <label class="form-check-label" required>
                            Kontrol
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kunjungan" value="2">
                        <label class="form-check-label" required>
                            Rujukan Internal
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kunjungan" value="5">
                        <label class="form-check-label" required>
                            Tunai
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label> Nomor Referensi </label><br>
                    <i>(Wajib diisi untuk pasien rujukan. Pasien Tunai dan Kontrol kasih "-" aja gpp.)</i>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="nomor_referensi" id="nomor_referensi"
                            placeholder="Masukkan nomor rujukan">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-alt-primary" id="cariRujukan" disabled>
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
