<!-- Page Content -->
<div class="content p-0" id="print-content">
    <!-- Invoice -->
    <div class="block">
        <div class="block-content">
            <!-- Invoice Info -->
            <div class="row">
                <div class="col-12">
                    <h3 class="block-title mb-20">Deposit <strong>{{$deposit->pasien->name}}</strong></h3>
                    <h5 style="margin-bottom:0">Total Deposit : Rp {{number_format($deposit->jumlah,0)}}</h5>
                </div>
            </div>
            <hr>
            <h6>HISTORI DEPOSIT</h6>

            <div class="table-full-width spinner-container" id=""> 
                <div class="spinner-back">
                    <table class="table table-striped table-hover table-pointer dataTable no-footer" id="histori-deposit"> 
                        <thead>
                            <tr class="header" ng-click="getCurrentPage()">
                                <th style="width:5%">No</th>
                                <th style="width:20%">Tanggal</th>
                                <th>Jumlah</th>
                                <th>Referensi</th>
                                <th>Print Kwitansi</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                            <tr>
                                <td class="py-10 px-10">{{$loop->iteration}}</td>
                                <td>{{$log->created_at->format('d F Y')}}</td>
                                <td>Rp {{number_format($log->jumlah)}}</td>
                                <td>
                                    @if(!empty($log->pemasukan_id))
                                    <a href="{{url('')}}/keuangan/pemasukan/{{$log->pemasukan_id}}" class="btn btn-alt-primary btn-sm">
                                        Detail
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    @if(empty($log->pemasukan_id))
                                    <button onclick="popupwindow('{{url('')}}/keuangan/deposit-log/print/{{$log->id}}','DP',500,1000) " class="btn btn-primary btn-sm">Print Kwitansi</button>
                                    @endif
                                </td>
                                <td>
                                    @if(empty($log->pemasukan_id))
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-delete" data-id="{{$log->id}}">Hapus</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-delete-confirmation" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed">
                <div class="block-header bg-primary">
                    <h5 class="block-title">Apakah Anda Yakin?</h5>
                </div>
                <div class="block-content">
                    <form action="{{url('')}}/keuangan/deposit-log/delete" method="POST">
                        {{ csrf_field() }}

                        <input value="" type="hidden" id="modal-input-id" name="deposit_log_id">
                        <p>
                            Apakah anda yakin untuk menghapus deposit ini? Jumlah deposit pasien akan dikurangi sesuai histori deposit yang anda hapus.
                        </p>
                        <button class="btn btn-primary pull-right ml-10">Hapus</button>
                        <button type="button" class="btn btn-outline-primary pull-right" data-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>        
    </div>
</div>