<div class="modal fade" id="modal-covid-histori" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Histori Status COVID</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-striped">
                        <tr>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Oleh</th>
                            <th>Keterangan</th>
                        </tr>
                        @foreach($kasus->covid_status_histori as $item)
                        <tr>
                            <td>{{$item->created_at->format('d M Y H:i')}}</td>
                            <td>
                                @if($item->status == 'odp')<span class="badge badge-primary">ODP</span>@endif
                                @if($item->status == 'pdp')<span class="badge badge-orange">PDP</span> @endif
                                @if($item->status == 'otg')<span class="badge badge-info">OTG</span>@endif
                                @if($item->status == 'positif')<span class="badge badge-danger"> Positif</span>@endif
                                @if($item->status == 'probable')<span class="badge badge-warning"> Probable</span>@endif
                                @if($item->status == 'negatif')<span class="badge badge-success"> Negatif</span>@endif
                            </td>
                            <td>
                                {{$item->creator->name}}
                            </td>
                            <td style="white-space: pre">{{$item->keterangan}}</td>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>