<div class="modal" id="productDetailModal" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Detail KFA: {{ $detail_kfa->name }}</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label>KODE KFA</label>
                            <h5>{{ $detail_kfa->kode_kfa }}</h5>
                            <label>NAMA KFA</label>
                            <h5>{{ $detail_kfa->name }}</h5>
                            <label>ACTIVE</label>
                            @if ($detail_kfa->active == 1)
                                <h5>Ya</h5>
                            @else
                                <h5>Tidak</h5>
                            @endif
                            <label>UCUM</label>
                            <h5>{{ $detail_kfa->ucum }}</h5>
                            <label>NAMA DAGANG</label>
                            <h5>{{ $detail_kfa->nama_dagang }}</h5>

                        </div>
                        <div class="col">
                            <label>KODE KFA 92</label>
                            <h5>{{ $detail_kfa->kode_kfa_92 }}</h5>
                            <label>UOM</label>
                            <h5>{{ $detail_kfa->uom }}</h5>
                            <label>NIE</label>
                            <h5>{{ $detail_kfa->nie }}</h5>
                            <label>MANUFACTURER</label>
                            <h5>{{ $detail_kfa->manufacturer }}</h5>
                            <label>FIX PRICE</label>
                            <h5>{{ $detail_kfa->fix_price }}</h5>
                        </div>
                        <div class="col">
                            <label>HET Price</label>
                            <h5>{{ $detail_kfa->het_price }}</h5>
                            <label>Generik</label>
                            @if ($detail_kfa->generik == 1)
                                <h5>Ya</h5>
                            @else
                                <h5>Tidak</h5>
                            @endif
                        </div>
                    </div>
                    <hr>
                    @php
                        $value_decoded = json_decode(json_encode($detail_kfa->value));
                    @endphp
                    @foreach ($value_decoded->active_ingredients as $key => $bahan)
                        <div class="row">
                            <div class="col">
                                <label>KODE KFA 91</label>
                                <h5>{{ $bahan->kfa_code }}</h5>
                            </div>
                            <div class="col">
                                <label>ZAT AKTIF</label>
                                <h5>{{ $bahan->zat_aktif }}</h5>
                            </div>
                            <div class="col">
                                <label>KEKUATAN ZAT AKTIF</label>
                                <h5>{{ $bahan->kekuatan_zat_aktif }}</h5>
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="row">
                        <div class="col">
                            <label>DESCRIPTION</label>
                            {!! $value_decoded->description !!}
                            <hr>
                            <label>SIDE EFFECT</label>
                            {!! $value_decoded->side_effect !!}
                            <hr>
                            <label>INDICATION</label>
                            {!! $value_decoded->indication !!}
                            <hr>
                            <label>WARNING</label>
                            {!! $value_decoded->warning !!}
                            <hr>
                            @foreach ($value_decoded->identifier_ids as $key => $id)
                                <div class="row">
                                    <div class="col">
                                        <label>URL</label>
                                        @if ($id->url)
                                            <h5><a href="{{ $id->url }}">{{ $id->url ?? '-' }}</a></h5>
                                        @else
                                            <h5>-</h5>
                                        @endif
                                        <label>CODE</label>
                                        <h5>{{ $id->code }}</h5>
                                    </div>
                                    <div class="col">
                                        <label>NAME</label>
                                        <h5>{{ $id->name }}</h5>
                                        <label>SOURCE NAME</label>
                                        <h5>{{ $id->source_name }}</h5>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
