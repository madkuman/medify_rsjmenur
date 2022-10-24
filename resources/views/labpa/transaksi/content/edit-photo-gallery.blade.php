<div class="col-12">
    <!-- Colorful Scrollbar -->
    <div class="block">
        <div id="lightgallery" class="block-content" data-toggle="slimscroll" data-color="#42a5f5" data-opacity="1" data-always-visible="true">
            <?php $count = 1; ?>
            <div class="row">
                @foreach($photos as $row)
                <div class="col-md-3" id="photo{{$row->id}}">
                    @if($row->type == 'png' || $row->type == 'jpg' || $row->type == 'jpeg' || $row->type == 'gif' || $row->type == 'bmp')
                    <div class="photo-preview katalog" data-src="{{URL::asset('assets/app/labpa/'.$row->path)}}" data-sub-html="<h4>{{$row->title}}</h4><p>{{$row->caption}}</p>">
                        <a class="img-link img-link-zoom-in img-thumb img-lightbox">
                            <img src="{{URL::asset('assets/app/labpa/'.$row->path)}}" class="four-col">
                        </a>
                    </div>
                    <button onclick="deleteConfirmation({{$row->id}});" class="btn btn-danger mr-5 mb-5 close-button delete-btn" style="position: absolute;">Hapus</button>
                    @else
                    <div class="photo-preview katalog" data-src="{{URL::asset('assets/app/labpa/'.$row->path)}}" data-sub-html="<h4>{{$row->title}}</h4><p>{{$row->caption}}</p>">
                        <a class="img-link img-link-zoom-in img-thumb img-lightbox">
                            <img src="{{URL::asset('assets/img/filetype.png')}}" class="four-col">
                        </a>
                    </div>
                    <button onclick="deleteConfirmation({{$row->id}});" class="btn btn-danger mr-5 mb-5 close-button delete-btn">Hapus</button>
                    @endif
                    <?php $count++; ?>
                </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- END Colorful Scrollbar -->
</div>

