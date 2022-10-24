<div class="modal fade" id="modal-create-feces" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Pemeriksaan Feces Lengkap</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/pemeriksaanlab/feces/create" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="block-content">
                                <h5 style="margin-bottom: 0px;">Makroskopis</h5>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Parameter</label>
                                    <div class="col-lg-4 col-form-label text-center">Hasil</div>
                                    <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                    <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                    <div class="col-12"><hr></div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Warna</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="warna" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Konsistensi</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="konsistensi" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Bau</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="bau" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Lendir</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="lendir" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Darah</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="darah" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>    
                                </div>
                                <hr>
                                <h5 style="margin-bottom: 0px; margin-top: 80px;">Mikroskopis</h5>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Parameter</label>
                                    <div class="col-lg-4 col-form-label text-center">Hasil</div>
                                    <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                    <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                    <div class="col-12"><hr></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Lekosit</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="lekosit" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Eritrosit</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="eritrosit" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Amoeba</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="amoeba" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Kista</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="kista" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Telur Cacing</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="telur_cacing" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <hr>
                            </div>                
                            <div class="block-content">
                                <h5 style="margin-bottom: 0px; margin-top: 80px;">Pencernaan</h5>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Parameter</label>
                                    <div class="col-lg-4 col-form-label text-center">Hasil</div>
                                    <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                    <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                    <div class="col-12"><hr></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Protein</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="protein" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Lemak</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="lemak" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Karbohidrat</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="karbohidrat" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Serat</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="serat" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Amylum</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="amylum" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Bakteri</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="bakteri" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <hr>
                                <h5 style="margin-bottom: 0px; margin-top: 80px;">Lain Lain</h5>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Parameter</label>
                                    <div class="col-lg-4 col-form-label text-center">Hasil</div>
                                    <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                    <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                    <div class="col-12"><hr></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Benzidin Test</label>
                                    <div class="col-lg-4">
                                        <input  type="text" class="form-control" name="benzidin_test" autocomplete="off">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">-</label>
                                    <label class="col-lg-3 col-form-label text-center">-</label>
                                </div>
                                <hr>       
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn-alt btn-hero btn-primary min-width-175 float-right">
                                            <i class="fa fa-send mr-5"></i> Simpan
                                        </button>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>