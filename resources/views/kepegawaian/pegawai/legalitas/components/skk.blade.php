<div class="col-lg-6 col-12">
    {{-- <div class="row">
        <div class="col-12 text-right float-right">
            @if(empty($pegawai->ppa_1))
            <a href="javascript:void(0)" class="btn-add-skk btn btn-alt-primary pull-right"><i
                    class="fa fa-plus mr-5 mb-10"></i> SKK</a>
                    @else
                    @endif
        </div>
    </div> --}}
    <div class="row">
        <div class="col-12 mb-30">
            <h5 class="card-title font-w400">S K K</h5>
            <hr>
            <div class="table-responsive-md">
                @if(count($data_skk) == 0) <p>Tidak ada data</p>
                    @else
                    <div class="items-info">
                        Menampilkan <code>{{ (($data_skk->currentPage()-1)*$data_skk->perPage())+1 }}</code>-<code>{{ (($data_skk->currentPage())*$data_skk->perPage()) > $data_skk->total() ? $data_skk->total() : (($data_skk->currentPage())*$data_skk->perPage()) }}</code> dari total <code>{{$data_skk->total()}}</code> data
                      </div>
                    <table id="table-education" class="table table-striped table-hover mt-10">
                        <thead>
                            <tr>
                                <th style="width: 5%" class="text-center align-middle">No</th>
                                <th style="width: 25%" class="text-center align-middle">No. SKK</th>
                                <th style="width: 30%" class="text-center align-middle">Expired</th>
                                <th style="width: 15%" class="text-center align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_skk->getCollection() as $key => $item)
                            <tr>
                                <td class="text-center">
                                    {{(($data_skk->currentPage() - 1) * $data_skk->perPage()) + ($key + 1)}}
                                </td>
                                <td class="">
                                    {{ !empty($item->nomer) ? $item->nomer : '—' }}
                                    <span class="skk hide">{{$item->nomer}}</span>
                                </td>
                                <td class="text-center ">
                                    {{ !empty($item->tanggal) ? date_format (new DateTime($item->tanggal), 'Y-m-d') : '-' }}
                                    <span class="sip-expired hide">{{date_format (new DateTime($item->tanggal), 'Y-m-d')}}</span>
                                </td>
                                <td class="d-flex justify-content-center">
                                    @if($item->file)
                                    <a href="{{route('legalitas-file-skk', ['emp' => $item->id, 'id' => $item->file])}}"
                                        class="btn btn-alt-warning btn-sm mr-5" title="Lihat Sertifikat"
                                        target="_blank"><i class="fa fa-file"></i>
                                    </a>
                                    @else
                                    <button type="button" class="btn btn-alt-warning btn-sm mr-5" disabled
                                        title="Lihat Sertifikat">
                                        <i class="fa fa-file"></i>
                                    </button>
                                    @endif
                                    {{-- <a href="javascript:void(0)" class="btn btn-alt-warning btn-sm mr-5 btn-update-skk"
                                        data-id="{{$item->id}}">
                                        <i class="fa fa-edit"></i>
                                    </a> --}}
                                    <form class="form-delete-skk" method="POST" action="" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" value="skk" name="tipe">
                                        <input type="hidden" value="{{$item->id}}" name="id">
										<button type="button" class="btn btn-alt-danger btn-sm btn-delete-skk" data-id="{{ $item->id }}" title="Hapus Data">
											<i class="fa fa-trash"></i>
										</button>
									</form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('kepegawaian.layouts.partials.pagination_bottom')
                    @endif
            </div>
        </div>
    </div>
</div>