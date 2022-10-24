<div id="modal-paket" class="modal fade" role="dialog">
    <div class="modal-dialog modal modal-lg modal-dialog-centered">
        <div class="modal-content ">
          <div class="modal-body">
            <div name="modal-title" class="font-size-lg font-w600 mb-20 text-center">Informasi Paket Layanan</div>
            @if(!empty($paket))
            <nav class="custom-tabbable tabbable">
                <div class="nav nav-tabs custom-nav-tabs" role="tablist">
                    @foreach($paket as $item)
                    <a class="nav-item nav-link @if($loop->iteration==1)active @endif" id="nav-tab{{$item->id}}" data-toggle="tab" href="#nav{{$item->id}}" role="tab" aria-controls="nav{{$item->id}}" aria-selected="true" style="white-space: nowrap;">{{str_replace("Paket", "", $item->nama)}}</a>
                    @endforeach
                </div>
            </nav>
            <div class="tab-content" id="paket-tabContent">
                @foreach($paket as $item)
                <div class="tab-pane fade show @if($loop->iteration==1)active @endif"" id="nav{{$item->id}}" role="tabpanel" aria-labelledby="nav-home-tab">
                    <ul class="m-10 row">
                    @forelse($item->tarifPaket as $tp)
                        <li class="col-6">{{$tp->tarifMaster->deskripsi}}</li>
                    @empty
                    @endforelse
                    </ul>
                </div>
                @endforeach
            </div>
            @else
            @endif
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
        </div>
    </div>
</div>