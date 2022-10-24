@extends('kepegawaian.layouts.main-profile')

@section('title')
Kepegawaian | Penghargaan
@endsection

@section('subtitle')
Data Penghargaan
@endsection

@section('main-content')
<div class="card">
  <div class="card-body px-20">
    <div class="col-12 my-20">
      <div class="row">
        <div class="col-12 text-right float-right">

          @if($is_hrd_member)
          {{-- <button id="button-add-appretiation" type="button" class="btn btn-alt-primary pull-right" data-toggle="modal" data-target="#modal-add-appretiation">
            <i class="fa fa-plus mr-5 mb-10"></i> Tambah
          </button> --}}
          <a href="javascript:void(0)" class="btn-add btn btn-alt-primary pull-right"><i class="fa fa-plus mr-5 mb-10"></i> Tambah</a>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-12 mb-30">
          <h5 class="card-title font-w400">PENGHARGAAN</h5>
          <hr>
          <div class="table-responsive-md">
            @if($items->total() < 1)
            <p>Tidak ada data</p>
            @else
            @include('kepegawaian.layouts.partials.pagination')
            <table id="table-appretiation" class="table table-striped table-hover mt-10"> 
              <thead>
                <tr>
                  <th style="width: 10%" class="text-center">No</th>
                  <th style="width: 20%" class="text-center">Nama</th>
                  <th style="width: 25%" class="text-center">No.ST/Kep</th>
                  <th style="width: 20%" class="text-center">Pemberi Penghargaan</th>
                  <th style="width: 10%" class="text-center">Status</th>
                  <th style="width: 15%" class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($items->getCollection() as $key => $item)
                <tr>
                  <td class="text-center">{{(($items->currentPage() - 1) * $items->perPage()) + ($key + 1)}}</td>
                  <td class="nama @if (empty($item->masterPenghargaan->nama)) text-center @endif">{{ $item->masterPenghargaan->nama }}</td>
                  <td class="st-number @if (empty($item->masterPenghargaan->st_number)) text-center @endif">{{ !empty($item->masterPenghargaan->st_number) ? $item->masterPenghargaan->st_number : '—'}}</td>
                  <td class="pemberi">{{$item->masterPenghargaan->pemberi}}</td>
                  <td class="text-center">
                    <span class="badge {{ $item->status == 0 ? 'badge-danger' : 'badge-success'}}">{{ $item->status == 0 ? 'Belum Diverifikasi' : 'Sudah diverifikasi' }}</span>
                    <span class="tgl-terbit hide">{{$item->masterPenghargaan->tgl_terbit}}</span>
                  </td>
                  <td class="d-flex justify-content-center">
                    <div class="row">
                      <a href="javascript:void(0)" class="btn-detail btn btn-alt-warning btn-sm mr-5 pull-right" data-id="{{$item->id}}" data-status="{{$item->status}}"><i class="fas fa-search-plus"></i></a>
                      @if(!empty($item->masterPenghargaan->sertifikat))
                      <a href="{{route('file-penghargaan', ['emp' => $item->pegawai_id, 'id' => $item->masterPenghargaan->sertifikat])}}" class="btn btn-alt-warning btn-sm mr-5" title="Lihat Sertifikat" target="_blank"><i class="fa fa-file"></i></a>
                      @else
                      <button type="button" class="btn btn-alt-warning btn-sm mr-5" disabled title="Lihat Detail">
                        <i class="fa fa-file"></i></button>
                        @endif
                        @if($is_hrd_member)
                        <a href="javascript:void(0)" class="btn-update btn btn-alt-success btn-sm mr-5 pull-right" data-id="{{$item->id}}" data-masterid="{{$item->master_penghargaan_id}}" title="Edit Data"><i class="fas fa-pencil"></i></a>
                        {{-- <form class="form-delete-appretiation" method="POST" action="" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <button type="button" class="btn btn-alt-danger btn-sm delete-appretiation-button" data-id="{{ $item->id }}" title="Hapus Data">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form> --}}
                        @endif
                      </div>
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
        <!-- modal -->
        @include('kepegawaian.pegawai.penghargaan.components.modal')
        @include('kepegawaian.pegawai.penghargaan.components.modal-detail')
        @include('kepegawaian.pegawai.penghargaan.components.modal-delete')
      </div>
    </div>
  </div>
  @endsection

  @section('script')
    @include('kepegawaian.pegawai.penghargaan.components.js')
 
  @endsection