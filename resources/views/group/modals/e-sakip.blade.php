<div class="modal fade" id="modal-esakip" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{url()->current()}}/admin-kontrol-esakip" method="POST">
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
                        <input type="hidden" name="id" id="esakip_member_id" value="">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="mb-3">Pengaturan Kategori Admin Esakip</label><br>
                                    @foreach($e_sakip_kategori as $item)
                                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                                            <input class="custom-control-input" type="checkbox" name="{{str_replace('-','_',$item->slug)}}" id="{{$item->slug}}" value="{{$item->id}}">
                                            <label class="custom-control-label" for="{{$item->slug}}">{{$item->nama}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-submit btn-click-animate" type="submit" id="btnSubmit">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>