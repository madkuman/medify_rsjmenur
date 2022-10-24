<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/save">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Penandaan Area Operasi</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="" id="id">
                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
                        <div class="row">

                            <div class="form-group col-md-3 col-sm-12">
                                <label>Tanggal Operasi</label>
                                <input type="text" class="form-control js-datepicker" name="tanggal_operasi" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off">
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Jenis Operasi</label>
                                <select type="text" class="form-control" name="jenis_operasi" >
                                    <option value="kecil">Kecil</option>
                                    <option value="sedang">Sedang</option>
                                    <option value="besar">Besar</option>
                                    <option value="khusus">Khusus</option>
                                    <option value="khusus">Canggih</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <img class="image-human-body" src="{{url('assets/img/asesmen/penandaan_daerah_operasi.jpg')}}" style="width: 100%">

                                <img src="{{url('assets/js/plugins/img-notes/dist/images/marker_black.png')}}" id="marker" style="display: none; position: absolute;" />
                            </div>
                            <div class="col-12">
                                <div align="center">
                                    <button id="toggleEdit" type="button">Edit</button> <button  type="button" id="export">Export</button> <button type="button" id="clear">Clear</button> <button type="button" id="toggleZoom">Zoom On</button>    <button type="button" id="toggleDrag">Drag On</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
