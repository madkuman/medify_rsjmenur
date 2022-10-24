@if(count($photos))
<div class="col-12 px-0">
    <!-- Colorful Scrollbar -->
    <div id="lightgallery" class="block-content bg-flat-light row">
        @if(isset($photos)) @forelse($photos as $item)

        <div class="caption" id="caption{{$item->id}}" style="display: none;">
            <div class="fb-comments text-left">
                <div class="pt-30 px-50" style="min-height: 500px;">
                    <div class="row">
                        <div class="col-3">
                            <img src="{{!is_null($item->creator) ? url($item->creator->avatar_thumb) : url('assets/img/placeholder.jpg')}}" style="height: 50px">
                        </div>
                        <div class="col-9 text-left">
                            @if(!is_null($item->sent_by))
                                <h5 class="mb-0">{{$item->sent_by}}<br>
                            @else
                                <h5 class="mb-0">{{!is_null($item->updater) ? $item->creator->name : '-'}}<br>
                            @endif
                                <small class="text-muted">{{$item->updated_at->diffForHumans()}}</small>
                            </h5>
                        </div>
                    </div>
                    <hr>
                    @if(!isset($item->flag_penunjang))
                    <button class="btn btn-sm btn-outline-primary pull-right" type="button" onclick="editPenunjang({{$item->id}})"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-sm btn-outline-danger pull-right mr-5" type="button" onclick="deletePenunjang({{$item->id}})"><i class="fa fa-trash"></i></button>
                    @endif
                    <br>
                    <div class="show-container-{{$item->id}}">
                        <h5>{{$item->title}}</h5>
                        @php $caption = $item->transaksi_radiolgy->caption ?? ''; @endphp
                        <p style=" white-space: pre-line;">{{$item->caption ?? $caption}}</p>
                        <p style=" color: red">
                                Gambar ini dikirimkan ke penunjang
                        </p>
                    </div>
                    <div class="edit-container-{{$item->id}}" style="display: none">
                        <form method="POST" action="{{url($link.'/transaksi/update/penunjang')}}" id="editFormPenunjang_{{$item->id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <input type="hidden" name="penunjang_id" value="{{$item->penunjang_id}}">
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" class="form-control edit-title" value="{{$item->title}}" name="title" data-target="liveTitle_{{$item->id}}">
                            </div>
                            <div class="form-group">
                                <label>Caption</label>
                                <textarea class="form-control edit-caption" name="caption" rows="9" data-target="liveCaption_{{$item->id}}">{{$item->caption}}</textarea>
                            </div>
                            <div class="form-group">
                                <input class="edit-check" name="kirim" id="checkPenunjang{{$item->id}}" value="true" type="checkbox" checked="" data-target="liveCheck_{{$item->id}}">
                                <label>Kirim gambar ini ke penunjang</label>
                            </div>
                            <input type="hidden" name="live_title" value="{{$item->title}}" id="liveTitle_{{$item->id}}">
                            <input type="hidden" name="live_caption" value="{{$item->caption}}" id="liveCaption_{{$item->id}}">
                            <input type="hidden" name="live_check" value="true" id="liveCheck_{{$item->id}}">
                            <button class="btn btn-primary" type="button" onclick="submitEditPenunjang({{$item->id}})">Simpan</button>
                            <button type="button" class="btn btn-secondary" onclick="cancelEditPenunjang({{$item->id}})">Batalkan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-12 item-gallery animated fadeIn photo-preview katalog">
            <div class="options-container four-col" style="height: 100px; margin: 1%; overflow: hidden;">
                <img class="img-fluid options-item mx-auto d-block" src="{{asset($item->thumbnail_path)}}" alt="" style="max-width: 100%; max-height: 100%;">
                <div class="options-overlay bg-black-op-75">
                    <div class="options-overlay-content">
                        <h6 class="h6 text-white mb-5 text-uppercase">{{$item->title}}</h6>
                        <a class="btn btn-sm btn-rounded btn-alt-info selector full-only" href="{{$item->type == 'image' ? asset($item->path) : asset($item->thumbnail_path)}}" data-download-url="{{asset($item->path)}}" data-sub-html="#caption{{$item->id}}">
                            <i class="fa fa-pencil"></i> Detail
                        </a>
                        @if($item->type == 'pdf')
                            <a class="btn btn-sm btn-rounded btn-alt-warning mx-50 mt-5" href="javascript:void(0)" onclick="window.open('{{asset($item->path)}}', 
                             'newwindow', 
                             `width=${screen.width},height=${screen.height}`); return false;" style="display: block;">
                                <i class="fa fa-eye"></i> View PDF
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        @endforeach 
        @else
        <h4>Tidak Ada Dokumen</h4> 
        @endif
    </div>
    <!-- END Colorful Scrollbar -->
</div>
<form id="deleteForm" action="{{url($link.'/transaksi/delete/penunjang')}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="id" id="deleteId">
</form>
@endif