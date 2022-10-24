<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">REKAP TAGIHAN INACBG</h3>
        <div class="block-option">
            <button class="btn btn-info" type="button" onclick="popupwindow('{{url('')}}/keuangan/piutang/{{$piutang->id}}/print-inacbg','Rekap Tagihan INACBG',500,1000) "><i class="fa fa-print mr-5"></i> Print Rekap Tagihan INACBG</button>
        </div>
    </div>
    <div class="block-content block-content-full">
        <div class="table-responsive push">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-center" style="width: 60px;">#</th>
                    <th>Kategori</th>
                    <th class="text-right" style="width: 200px;">Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @php $total = 0 @endphp
                @foreach($inacbg as $key => $item)
                    <tr>
                        <td class="text-center">
                            {{$loop->iteration}}
                        </td>
                        <td>
                            <span style="text-transform: uppercase;">{{$item->kategori}}</span>
                        </td>
                        <td class="text-right">
                            Rp {{number_format($item->subtotal,0)}}
                        </td>
                    </tr>
                    @php $total += $item->subtotal @endphp
                @endforeach
                <tr class="table-warning">
                    <td></td>
                    <td class="text-right font-w700 ">TOTAL</td>
                    <td class="text-right font-w700 ">Rp {{number_format($total,0)}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>