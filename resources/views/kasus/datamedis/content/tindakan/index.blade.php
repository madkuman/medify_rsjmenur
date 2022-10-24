
<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">
            @if($allow_crud)
            <button data-keyboard="false" type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-tindakan"><i class="fa fa-pencil"></i> Buat Tindakan Tarif</button>

            <div class="btn-group pull-right" role="group" style="display: inline-block;">
                <button type="button" class="btn-alt btn-info min-width-125 dropdown-toggle" id="btnGroupDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu&nbsp;&nbsp;&nbsp;</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modal-create-tindakan-manual">
                        <i class="fa fa-edit mr-5"></i>Buat Tindakan Manual
                    </a>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="historiTindakan()">
                        <i class="fa fa-file-text mr-5"></i>Lihat Histori Tindakan
                    </a>
                    <!-- <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#modal-terjadi-kesalahan">
                        <i class="fa fa-times mr-5"></i>Terjadi Kesalahan Tindakan
                    </a> -->
                </div>
            </div>


            @endif
        </div>

        <?php $i = 1; ?>


        @forelse ($tindakan as $t)

        <div class="col-md-12">
            <div class="block block-transparent">
                <div class="block-content p-0">
                    <div class="row"> 
                        <div class="col-md-8"> 

                            @if($allow_crud)

                            @if($my_role_admin == 1 || $t->created_by == Auth::user()->id || $t->subscribed_by == Auth::user()->id)
                            {{--<button type="button" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 float-right" onclick="tindakanEditModal({{$t->id}})" data-toggle="tooltip" data-placement="top" title="Ubah">
                                <i class="fa fa-pencil"></i>
                            </button>--}}
                            <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" onclick="tindakanDeleteModal({{$t->id}})" data-toggle="tooltip" data-placement="top" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                            @endif
                            @if(empty($t->icd_9) && 
                            ($my_role_admin == 1 || $t->created_by == Auth::user()->id || $t->subscribed_by == Auth::user()->id))
                            @if($t->subscribe == 0 && empty($t->subscribed_by))
                            <button type="button" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5 float-right" data-toggle="tooltip" data-placement="top" title="Jadwalkan Rutin" onclick="tindakanSubscribeModal({{$t->id}})">
                                <i class="fa fa-calendar-check-o"></i>
                            </button>
                            @elseif($t->subscribe == 1)
                            <button type="button" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5 float-right" data-toggle="tooltip" data-placement="top" title="Hentikan Jadwal Rutin" onclick="tindakanUnsubscribeModal({{$t->id}})">
                                <i class="fa fa-calendar-times-o"></i>
                            </button>
                            @endif
                            @if($t->kesalahan_tindakan !=1)
                            <button type="button" id_data="{{$t->id}}" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right button-kesalahan" data-content="{{json_encode($t)}}" data-toggle="tooltip" data-placement="top" title="Laporkan Kejadian Komplikasi Luka Bakar">
                                <i class="fab fa-hotjar"></i>
                            </button>
                            @endif
                            @endif
                            @endif


                            @if(!empty($t->icd_9))
                            <h6 class="font-w400 text-muted mb-5">Tindakan ICD9</h6>
                            @else
                            <h6 class="font-w400 text-muted mb-5" style="display: inline;">Kolaborasi
                            </h6><br>
                            @if($t->subscribe == 1)
                            <span class="badge badge-success"><i class="fa fa-calendar mr-5"></i>Dijadwalkan rutin</span>
                            @endif
                            @if($t->kesalahan_tindakan == 1)
                            <span class="badge badge-danger"><i class="fa fa-warning mr-5"></i>Terjadi Komplikasi Luka Bakar</span>
                            @endif
                            @endif
                            <h5 class=" mb-0"><span class="font-w400">{{ $t->desc}}</span></h5>
                            <h5 class="mb-15"><small class="font-w400">Biaya : Rp {{ number_format($t->price,0) }}</small></h5>
                            <div class="row">
                                <h6 class="col-4">
                                    <small class="text-muted">Dibuat Oleh</small><br>
                                    {{ $t->creator->name }} <br>
                                    <span class="font-w400">{{ $t->tanggal }}</span>
                                </h6>
                                @if(!empty($t->subscribed_by) && $t->subscribe == 1)
                                <h6 class="col-4">
                                    <small class="text-muted">Dijadwalkan Rutin Oleh </small><br>
                                    {{ $t->subscriber->name }}
                                </h6>
                                @endif
                                @if($t->kesalahan_tindakan == 1)<h6 class="col-4">
                                    <small class="text-muted">Ditandai Sebagai Komplikasi Luka Bakar Oleh </small><br>
                                    {{$t->kesalahanTindakanBy->name}}<br>
                                    <span class="font-w400">{{date('d M Y',strtotime($t->kesalahan_tindakan_at))}}</span>
                                </h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <?php $i++; ?>
        @empty

        <div class="col-12 text-center py-50">
            <h4 class="font-w400 mb-5">Belum ada tindakan</h4>
            <p>Klik tombol <b>Buat Tindakan</b> untuk menambahkan tagihan baru</p>
        </div>

        @endforelse


    </div>
</div>

<div data-keyboard="false" class="modal fade" id="modal-terjadi-kesalahan" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-danger">
                    <h3 class="block-title">Terjadi Komplikasi Luka Bakar</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content pb-5">
        <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/tindakan/kesalahan-tindakan" method="post">
                    {{ csrf_field() }}
            <input type="hidden" class="form-control form-control-lg" id="tindakan-id" name="id" value="" placeholder="">
            <div class="form-group">
            <label class="css-control css-control-lg css-control-danger css-checkbox">
                <input type="checkbox" id="kesalahan_tindakan" name="kesalahan_tindakan" class="css-control-input" checked="">
                <span class="css-control-indicator"></span>
                <strong>Anda melaporkan telah terjadi komplikasi luka bakar</strong>
            </label>
            </div>
                    <h6 class="mt-25 mb-0">(Setelah disimpan data tidak dapat diubah lagi)</h6>
            <div class="modal-footer">
                <div class="form-group row">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-paper-plane mr-10"></i> Simpan
                </button>
                </div>
            </div>
        </form>
            </div>
        </div>
    </div>
</div>
</div>

