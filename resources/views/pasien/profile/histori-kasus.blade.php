<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center mb-10">
        <h4 class="card-title mb-0">Histori Kunjungan</h4>
        <button type="button" class="btn btn-alt-secondary" id="btnFilter">
            <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
        </button>
    </div>
    <div class="card-body">
        <form action="{{ url()->current() }}" method="GET" id="formFilter" hidden>
            <div class="row pt-10 pb-20">
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Poli</label>
                        <select name="lokasi" class="js-select2 form-control" data-size="5" data-width="100%" data-placeholder="Pilih Poli">
                            <option></option>
                            <option value="Semua">Semua</option>
                            @foreach ($poli as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Dokter</label>
                        <select name="dokter[]" multiple="multiple" class="js-select2 form-control" data-size="5" data-width="100%">
                            @foreach ($dokter as $item)
                            <option value="{{ $item->dokter_id }}">{{ $item->dokter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-alt-secondary" id="tutupFilter">Tutup</button>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div class="col-12">
                    <hr>
                </div>
            </div>
        </form>

        @if(count($kasus) > 0)

        <div class="row py-10 px-20 full-only">
            <div class="col-2 font-w600">JUDUL KASUS</div>
            <div class="col-2 font-w600">TGL MASUK</div>
            <div class="col-2 font-w600">TGL KELUAR</div>
            <div class="col-2 font-w600">KUNJUNGAN</div>
            <div class="col-2 font-w600">MENU</div>
            <div class="col-2 font-w600">KASUS</div>
        </div>
        @endif

        @foreach($kunjungan as $item)
        
        <div class="bd-callout bd-callout-primary row py-10">
            <div class="col-lg-2 col-sm-12">{{$item->judul_kasus}}</div>
            <div class="col-lg-2 col-sm-12">{{date('d F y H:i', strtotime($item->tanggal_masuk))}}</div>
            @if(!empty($item->tanggal_keluar))
            <div class="col-lg-2 col-sm-12">{{date('d F y H:i', strtotime($item->tanggal_keluar))}}</div>
            @else
            <div class="col-lg-2 col-sm-12">-</div>
            @endif
            <div class="col-lg-2 col-sm-12">
                {{$item->lokasi}}
                {{--@if($item->kasus)
                <br>ri = {{$item->tipe_ri}}<br> rj = {{$item->tipe_rj}}<br> igd = {{$item->tipe_igd}}<br> mc = {{$item->tipe_mc}}
                @endif --}}
                {{-- <br>{{$item->pembayaran->perusahaan->nama ?? $item->pembayaran}} --}}
            </div>
            <div class="col-lg-2 col-sm-12">
                @if($item->menu)
                <a class="btn btn-secondary" id="btn-histori-kasus-dropdown-{{$loop->iteration}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu<i class="fa fa-angle-down ml-5"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="btn-histori-kasus-dropdown-{{$loop->iteration}}" x-placement="bottom-end" style="position: absolute; transform: translate3d(-57px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item" href="{{$item->url_menu_edit_bayar}}">
                        <i class="fa fa-usd mr-5"></i> Ubah Metode Pembayaran
                    </a>
                </div>
                @endif
            </div>
            <div class="col-lg-2 col-sm-12">
                @if($item->kasus)
                <a class="btn btn-primary" href="{{$item->url}}">Lihat Kasus</a>
                @else
                <a class="btn btn-info" href="{{$item->url}}">Lihat Kunjungan</a>
                @endif
            </div>
        </div>
        @endforeach
        @if(count($kunjungan) == 0)
        <div class="text-center">
            <h5 class="font-w400">Pasien ini belum memiliki kunjungan</h5>
        </div>
        @endif
    </div>
</div>