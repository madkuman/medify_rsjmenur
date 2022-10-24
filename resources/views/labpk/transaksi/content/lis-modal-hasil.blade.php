@foreach($transaksi->hasil as $h)
@if(!is_null($h->lis_result))
<?php $result = json_decode($h->lis_result);
    if(!is_array($result))
        $result = [$result]; ?>
<div class="modal fade" id="modalLIS{{$h->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-slideleft" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-slideleft" role="document">
        <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Pemeriksaan {{$h->created_at->format('d F Y h:i')}}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%;">#</th>
                                    <th style="width: 30%;">Parameter</th>
                                    <th style="width: 25%;">Hasil</th>
                                    <th style="width: 15%;">Satuan</th>
                                    <th style="width: 15%;">Referensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 0 @endphp
                                <?php $head = false; $current_head = null;?>
                                @foreach($result as $d)
                                    @if(!is_null($d->group_test) && $d->group_test != $current_head)    <?php $current_head = $d->group_test; ?>
                                        <tr><th colspan="5">{{$d->group_test}}</th></tr>
                                    @endif
                                    <tr>
                                        <th class="text-center" scope="row">{{++$count}}</th>
                                        <td>{{$d->test_name}}</td>
                                        <td>{{$d->result}}</td>
                                        <td>{{$d->unit}}</td>
                                        <td>{{$d->nilai_normal}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif
@endforeach