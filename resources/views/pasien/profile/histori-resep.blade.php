<div class="card">
    <div class="card-header">
        <h4 class="card-title">Histori Resep</h4>
    </div>
    <div class="card-body">
        <div class="row row-deck">
            @foreach ($resep as $r)
            <div class="col-md-4">
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Resep</h3>
                    </div>

                    <div class="block">
                        <div class="block-content">
                            @foreach ( $r->resepDetail as $resepDetail )

                            <h6 class="font-w400">{{ $resepDetail->type }} - {{ $resepDetail->obat_name }}, {{ $resepDetail->nomor }}, {{ $resepDetail->aturan }}</h6>

                            @endforeach

                            <div class="">
                                @if(!empty($r->creator->avatar_thumb))
                                <div class="float-left mr-10">
                                    <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
                                </div>
                                @else
                                <div class="float-left mr-10">
                                    <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                                </div>
                                @endif
                                <h6 class="pt-10">
                                    <small class="text-muted">Dibuat Oleh</small><br>
                                    {{ $r->doctor['name'] }}<br>
                                    {{ $r->created_at }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        @endforeach
        @if(count($resep) == 0)
        <div class="col-12">
            <h5 class="font-w400">Pasien ini belum memiliki resep</h5>
        </div>
        @endif
    </div>
</div>
</div>