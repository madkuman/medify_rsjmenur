<div class="modal fade" id="modal-create" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-absensi" enctype="multipart/form-data">
				<div class="block block-themed block-transparent mb-0">
				    <div class="block-header">
				        <h3 class="block-title" id="title-modal"></h3>
				        <div class="block-options">
				            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
				                <i class="si si-close"></i>
				            </button>
				        </div>
				    </div>
                    
					<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
						<input type="hidden" name="id" id="id" value="">
                        <div class="row">
                                <div class="col-12">
                                    <label for="example-datepicker1">Tahun</label>
                                    <div class="form-inline">
                                        <input type="text" name="tahun" class="form-control js-datepicker-year" value="{{date('Y')}}" data-date-autoclose="true" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label>Kategori</label>
                                    <select class="js-select2 form-control" id="kategori-select2" name="kategori_id" style="width: 100%;" onchange="changeKategori(this)" data-placeholder="Pilih Kategori" required>
                                        @foreach($kategori as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 triwulan d-none">
                                    <label>Triwulan</label>
                                    <select class="js-select2 form-control" id="counter-select2" name="counter" disabled="disabled" style="width: 100%;" data-placeholder="Pilih Triuwlan">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                    </select>
                                </div>
                                @if($admin)
                                <div class="col-12">
                                    <label>Nama</label>
                                    <select class="js-select2 form-control" id="user-select" name="user_id" style="width: 100%;" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                <div class="col-12">
                                    <label>Input File</label>
                                    <input type="file" class="form-control" id="example-file-input" name="file" required="required">
                                </div>
                        </div>
                    </div>
				</div><br>
				<div class="modal-footer">
				    <div class="form-group">
				        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-submit" type="submit" id="btnSubmit"><i class="fa fa-plus"></i> Simpan</button>
                            <button class="btn btn-alt-primary btn-simple" style="display: none" type="button"  id="btnLoading">
                                <i class="fa fa-asterisk fa-spin"></i> Loading
                            </button>
				    </div>
				</div>
            </form>
        </div>
    </div>
</div>