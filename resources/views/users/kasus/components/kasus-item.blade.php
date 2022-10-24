@foreach($kasus as $item)
    <li>
        <a class="pl-20" href="{{url('kasus')}}/{{$item->nomor_kasus}}">
            <div class="row no-gutters">
                <div class="col-2">
                    <img class="img-avatar" src="{{asset($item->identitas->avatar_thumb)}}" alt="">
                </div>
                <div class="col-8">
                    <span class="text-uppercase case-title"> {{$item->judul_kasus}} </span>
                    <div class="font-w400 font-size-s text-black patient-name"> {{$item->identitas->nama ?? ''}}</div>
                    <div class="font-w400 font-size-xs text-muted">{{$item->identitas->gender ?? ''}}, {{$item->identitas->age ?? ''}}</div>
                    <div class="font-w400 font-size-xs text-muted">{{$item->lokasi->lokasi->nama ?? ''}}</div>
                </div>
                <div class="col-xl-2 pt-30">
                    <span class="font-w400 font-size-s text-black">@if(!empty($item->krs_at)) (TELAH KRS) @endif</span>
                </div>
            </div>
        </a>
    </li>
@endforeach