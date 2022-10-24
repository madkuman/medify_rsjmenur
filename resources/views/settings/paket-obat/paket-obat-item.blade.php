
<div class="col-md-4">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h6 class="block-title font-w600">{{$paket->nama}}</h6>
            @if($is_subscribe == 0)
            <button type="button" class="btn-block-option deleteBtn" data-toggle="tooltip" data-placement="top" title="Hapus"  data-id="{{$paket->id}}">
                <i class="si si-trash"></i>
            </button>
            <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Edit" onclick="resepEdit({{$paket->id}})">
                <i class="si si-pencil"></i>
            </button>
            @else
            <button type="button" class="btn-block-option unsubscribeBtn" data-toggle="tooltip" data-placement="top" title="Unsubscribe"data-id="{{$paket->id}}">
                <i class="si si-trash"></i>
            </button>
            @endif
        </div>

        <div class="block-content">
            @if($is_subscribe == 1)
            <span class="badge badge-success">Subscribe</span><br><br> 
            @endif
            @foreach ( $paket->detail as $item )
            <span class="text-muted font-w400"> {{ $item->type }} </span>
            @if($item->kategori == 'racikan')
                <h6 class="font-w600 mb-0" style="overflow:hidden; display:block;">{{ $item->racikan }} </h6>
                @foreach($item->racikan_detail as $racikan)
                <span>{{$racikan->nama_obat ?? '-'}}<br></span>
                @endforeach
                <br>
            @else
            <h6 class="font-w600 mb-5 mt-5"> {{ $item->item_detail->nama ?? "-"}} </h6>
            @endif

            <span>Jumlah : {{ $item->jumlah }}</span><br>
            <span style="overflow:hidden; display:block;">Aturan : {{ $item->aturan }}</span>
            <hr>

            @endforeach

            <h6 class="pt-10">
                <small class="text-muted">Diperbarui Terakhir</small><br>
                <span class=""> {{ $paket->updated_at->format('d F Y, H:i') }}</span><br><br>
                <small class="text-muted">Dibuat Oleh</small><br>
                {{ $paket->creator->name }}
            </h6>
        </div>
    </div>
</div>