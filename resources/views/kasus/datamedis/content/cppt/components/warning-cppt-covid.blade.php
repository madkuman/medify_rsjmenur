
<div class="col-lg-12">
    <div class="block block-transparent">
        <div class="block-content block-content-full bg-{{$tipe_bg}} py-0">
            <div class="py-20 row">
                <div class="col-8">
                    <div class="font-size-sm font-w600 text-uppercase {{$text_color}}">{{$title}}</div>
                    <div class="font-size-sm {{$text_color}}">{{$subtitle}}<br>
                        Keterangan : {{$kasus->covid_status->keterangan  ?? '' }}</div>
                </div>
                @if (!isset($view_only))
                    <div class="col-4">
                        <button type="button" class="btn btn-alt-{{$tipe_bg}} float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-angle-down"></i> Menu COVID19
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            @if($allow_crud)
                                <button class="dropdown-item" data-toggle="modal" data-target="#modal-covid-form"><i class="fa fa-pencil"></i> Update Status Pasien</button>
                            @endif
                            <button class="dropdown-item" data-toggle="modal" data-target="#modal-covid-histori"><i class="fa fa-history"></i> Histori Status COVID19</button>
                            <button class="dropdown-item" onclick="popupwindow('{{$button_url}}','Histori Asesmen COVID19','600','1250')"><i class="fa fa-history"></i> Lihat Asesmen COVID19</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>