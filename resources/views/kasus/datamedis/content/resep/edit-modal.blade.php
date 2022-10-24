<div class="modal fade" id="resepModalEdit" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Ubah Resep</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="main-form-container" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/resep/edit" id="form_edit_resep" method="post">
                        <input type="hidden" id="resepEditId" name="id">
                        <input type="hidden" name="pasien" value="{{$kasus->pasien_id}}">
                        <input type="hidden" name="metode_pembayaran" value="{{$kasus->pasien_pembayaran_id}}">
                        <input type="hidden" name="kasus_id" value="{{$kasus->id}}">
                        <input type="hidden" name="sep_id" value="{{$kasus->sep_id}}">
                        <input type="hidden" name="nomor_resep" id="nomorResep">
                        <input type="hidden" name="nama-apotek" id="resepEditApotekID">
                        <input type="hidden" id="resepEditId2" name="resep_id">
                        <input type="hidden" id="id-obat" name="id-obat">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Jenis Resep</label>
                                    <select class="form-control input-jenis-resep" name="jenis_resep">
                                        <option value="standard">Pelayanan</option>
                                        <option value="pulang">Pulang</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        @include('kasus.datamedis.content.resep.components.form', ['extra_id' => "-edit"])
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <label class="css-control css-control-primary css-checkbox div-override-checkbox">
                                    <input type="checkbox" class="override-checkbox css-control-input"/>
                                    <span class="css-control-indicator"></span> <strong>Abaikan Peringatan</strong>
                                </label>
                                <button type="submit" class="btn btn-hero btn-click-animate btn-alt-primary min-width-175 submit-resep">
                                    <i class="fa fa-send mr-5"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>