<div class="col-lg-6 col-12">
    {{-- <div class="row">
        <div class="col-12 text-right float-right">
            {{-- @if(empty($pegawai->str))
            <a href="javascript:void(0)" class="btn-add-str btn btn-alt-primary pull-right"><i
                    class="fa fa-plus mr-5 mb-10"></i> STR</a>
                    @else
                    @endif
        </div>
    </div> --}}
    <div class="row">
        <div class="col-12 mb-30">
            <h5 class="card-title font-w400">S T R</h5>
            <hr>
            <div class="table-responsive-md">
                @if(count($data_str) == 0) <p>Tidak ada data</p>
                    @else
                    <div class="items-info">
                        Menampilkan <code>{{ (($data_str->currentPage()-1)*$data_str->perPage())+1 }}</code>-<code>{{ (($data_str->currentPage())*$data_str->perPage()) > $data_str->total() ? $data_str->total() : (($data_str->currentPage())*$data_str->perPage()) }}</code> dari total <code>{{$data_str->total()}}</code> data
                      </div>
                    <table id="table-education" class="table table-striped table-hover mt-10">
                        <thead>
                            <tr>
                                <th style="width: 5%" class="text-center align-middle">No</th>
                                <th style="width: 25%" class="text-center align-middle">No. STR</th>
                                <th style="width: 30%" class="text-center align-middle">Expired</th>
                                <th style="width: 15%" class="text-center align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_str->getCollection() as $key => $item)
                            <tr>
                                <td class="text-center">
                                    {{(($data_str->currentPage() - 1) * $data_str->perPage()) + ($key + 1)}}
                                </td>
                                <td class="">
                                    {{ !empty($item->nomer) ? $item->nomer : '—' }}
                                    <span class="str hide">{{$item->nomer}}</span>
                                </td>
                                <td class="text-center ">
                                    {{ !empty($item->tanggal) ? date_format (new DateTime($item->tanggal), 'Y-m-d') : '-' }}
                                    <span class="expired-str hide">{{date_format (new DateTime($item->tanggal), 'Y-m-d')}}</span>
                                </td>
                                <td class="d-flex justify-content-center">
                                    @if($item->file)
                                    <a href="{{route('legalitas-file-str', ['emp' => $item->id, 'id' => $item->file])}}"
                                        class="btn btn-alt-warning btn-sm mr-5" title="Lihat Sertifikat"
                                        target="_blank"><i class="fa fa-file"></i>
                                    </a>
                                    @else
                                    <button type="button" class="btn btn-alt-warning btn-sm mr-5" disabled
                                        title="Lihat Sertifikat">
                                        <i class="fa fa-file"></i>
                                    </button>
                                    @endif
                                    {{-- <a href="javascript:void(0)" class="btn btn-alt-warning btn-sm mr-5 btn-update-str"
                                        data-id="{{$item->id}}">
                                        <i class="fa fa-edit"></i>
                                    </a> --}}
                                    <form class="form-delete-str" method="POST" action="" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" value="str" name="tipe">
                                        <input type="hidden" value="{{$item->id}}" name="id">
										<button type="button" class="btn btn-alt-danger btn-sm btn-delete-str" data-id="{{ $item->id }}" title="Hapus Data">
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