@if(!empty($piutang->kasusTagihan->kasus->id))
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">KOLABORATOR KASUS</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-6">
                    <div class="row"> 
                        @if(!empty($piutang->kasusTagihan->kasus->admin->user->name))
                        <div class="col-2">
                            <h6>DPJP</h6>
                        </div>
                        <div class="col-4">
                            - {{$piutang->kasusTagihan->kasus->admin->user->name}}
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <h6>Anggota</h6>
                        </div>
                        <div class="col-4">
                            @foreach($piutang->kasusTagihan->kasus->kolaboratorExceptAdmin as $kolaborator)
                            - {{$kolaborator->user->name or '-'}}<br>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <h6>HISTORI TEMPAT PELAYANAN</h6>
                            <ul>
                                @foreach($piutang->kasusTagihan->kasus->lokasiAll as $lokasi)
                                <li>{{$lokasi->lokasi->nama}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif