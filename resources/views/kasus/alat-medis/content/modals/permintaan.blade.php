<div class="modal fade show" id="modalAlatMedisBaru" tabindex="-1" role="dialog" aria-labelledby="modalAlatMedisBaru" aria-hidden="true">
    <form method="POST" action="{{url()->current()}}/permintaan">
        {{csrf_field()}}
        <div class="modal-dialog modal-dialog-popin" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Permintaan alat medis?</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div id="permintaan_alat_medis">
                            <div class="form-group row form_alat_medis" >
                                <div class="col-6">
                                    <label>Nama Alat Medis</label>
                                    <select class="js-select2 form-control items_template_dropdown" name="items_template_id[]" data-width="100%" data-placeholder="Pilih Alat Medis" required>
                                        <option value="" selected="" disabled="">Pilih</option>
                                        @foreach($item_template as $per_data)
                                            <option value="{{$per_data->id}}">{{$per_data->name}} (Tersedia : {{$per_data->item_alat_medis_count}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>Jumlah</label>
                                    <input type="number" name="jumlah[]" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-danger btn_delete form-control" onclick="delete_button(this)"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary plus_button add_more"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary btn-click-animate">
                        <i class="fa fa-check"></i>Simpan
                    </button>
                </div>
            </div>
        </div>    
    </form>
</div>