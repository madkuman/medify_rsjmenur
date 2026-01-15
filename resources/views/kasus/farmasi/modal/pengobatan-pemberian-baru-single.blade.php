<div class="modal" id="modalFormPemberianObatSingle" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ url()->current() }}/pemberian-post">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header ">
                        <h3 class="block-title text-center">Pemberian Obat Single</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content ">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" class="input-id" name="id">
                            <input type="hidden" class="input-method" name="method">
                            <label>Nama Obat <span id="loading-obat" style="color: gray; font-size: 8px">load atribut
                                    obat</span></label>
                            <select id="selected-obat" class="js-select2 form-control input-select-obat"
                                style="width:100%" data-close-on-select="false" name="cpo_ids">
                                @foreach ($pengobatan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_obat }}</option>
                                @endforeach
                            </select>
                            <div id="obat-badged">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jam</label>
                            <input type="text" name="jam" class="form-control time input-jam" placeholder="hh:mm"
                                id="jam-pemberian" required="" value="{{ Carbon\Carbon::now()->format('H:i') }}"
                                required="">
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control input-tanggal" autocomplete="off" name="tanggal"
                                value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required="">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control input-status" name="status">
                                <option value="sukses">Berhasil diberikan</option>
                                <option value="pasien_tolak">Pasien menolak</option>
                                <option value="kondisi">Batal karena kondisi</option>
                                <option value="alergi">Reaksi alergi</option>
                                <option value="eso">Efek samping obat</option>
                                <option value="tap">obat tidak tersedia</option>
                                <option value="belum_diberikan">Belum Diberikan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Evaluasi</label>
                            <textarea class="form-control input-evaluasi" name="evaluasi"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Verifikator 1</label>
                            <select class="form-control js-select2 input-verified-by" id="input-verified-by"
                                name="verified_by" style="width: 100%">
                                @foreach ($kolaborator as $item)
                                    <option value="{{ $item->user->id }}">{{ $item->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Verifikator 2</label>
                            <select class="form-control js-select2 input-verified-by-2"id="input-verified-by-2"
                                name="verified_by_2" style="width: 100%">
                                @foreach ($kolaborator as $item)
                                    <option value="{{ $item->user->id }}">{{ $item->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if (config('medify.kasus.info_pemberian_obat.on'))
                            <div class="form-group">
                                <label>Dibuat Oleh</label>
                                <input type="text" class="form-control input-created-by" readonly value="-">
                            </div>
                            <div class="form-group">
                                <label>Diupdate Oleh</label>
                                <input type="text" class="form-control input-updated-by" readonly value="-">
                            </div>
                        @endif

                    </div>
                </div>
                <div class="modal-footer" style="justify-content: flex-start;">
                    <div class="form-group" style="width:100%">
                        <button type="submit" class="btn btn-click-animate btn-primary btn-simple pull-right"
                            id="submit-pemberian">Simpan</button>
                        <button type="button" class="btn btn-default btn-simple pull-right mr-5"
                            data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger btn-simple deleteBtnPemberian"
                            data-id="">Hapus</button>
                    </div>
                </div>
            </div><!-- /.modal-dialog -->
        </form>
    </div><!-- /.modal -->
</div>
