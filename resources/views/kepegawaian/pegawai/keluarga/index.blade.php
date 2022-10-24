@extends('kepegawaian.layouts.main-profile')

@section('title')
  {{$htmlheader_title}}
@endsection

@section('subtitle')
  {{$contentheader_title}}
@endsection

@section('main-content')
<div class="card">
  <div class="card-body px-20">
    <div class="col-12 my-20">
      <div class="row">
        <div class="col-12 text-right float-right">
          @if($is_hrd_member)
          <button id="button-add-family" type="button" class="btn btn-alt-primary pull-right" data-toggle="modal" data-target="#modal-create-keluarga">
            <i class="fa fa-plus mr-5 mb-10"></i> Tambah
          </button>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-12 mb-30">
          <h5 class="card-title font-w400">DATA KELUARGA</h5>
          <hr>
          <div class="table-responsive-md">
            @if($items->total() < 1)
              <p>Tidak ada data</p>
            @else
              @include('kepegawaian.layouts.partials.pagination')
              <table id="table-family" class="table table-striped table-hover mt-10"> 
                <thead>
                  <tr>
                    <th style="width: 5%" class="align-middle text-center">No</th>
                    <th style="width: 12%" class="align-middle text-center">Nama</th>
                    <th style="width: 10%" class="align-middle text-center">Jenis Kelamin</th>
                    <th style="width: 10%" class="align-middle text-center">Tempat Lahir</th>
                    <th style="width: 13%" class="align-middle text-center">Tanggal Lahir</th>
                    <th style="width: 8%" class="align-middle text-center">Hubungan</th>
                    <th style="width: 10%" class="align-middle text-center">NIK</th>
                    <th style="width: 12%" class="align-middle text-center">Asuransi</th>
                    <th style="width: 12%" class="align-middle text-center">Faskes</th>
                    <th style="width: 8%" class="align-middle text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($items->getCollection() as $key => $item)
                  <tr>
                    <td class="text-center">{{(($items->currentPage() - 1) * $items->perPage()) + ($key + 1)}}</td>
                    <td class="nama">{{ $item->nama }}</td>
                    <td class="kelamin">{{ $item->gender == 'L' ? 'Laki-laki' : 'Peremnpuan' }}</td>
                    <td class="tempat-lahir">{{ $item->tempat_lahir }}</td>
                    <td class="tanggal-lahir">{{ $item->tanggal_lahir }}</td>
                    <td class="relasi">{{ $item->hubungan }}</td>
                    <td class="nik">{{ $item->nik }}</td>
                    <td class="asuransi">{{ $item->asuransi }}</td>
                    <td class="">{{ $item->faskes }}
                      <span class="faskes hide">{{$item->faskes}}</span>
                      <span class="kelas hide">{{$item->kelas}}</span>
                      <span class="no-asuransi hide">{{$item->no_asuransi}}</span>
                    </td>
                    <td class=" d-flex justify-content-center">
                      @if($is_hrd_member)
                      <div class="row">
                        <button type="button" class="btn btn-alt-success btn-sm mr-5 btn-update" data-id="{{ $item->id }}" title="Edit Data">
                          <i class="fa fa-pencil"></i>
                        </button>
                        <form class="form-delete-family" method="POST" action="" enctype="multipart/form-data">
                        {{csrf_field()}}
                          <button type="button" class="btn btn-alt-danger btn-sm delete-family-button" data-id="{{ $item->id }}" title="Hapus Data">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
                      </div>
                      @endif
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
      @include('kepegawaian.pegawai.keluarga.components.modal-create')
      @include('kepegawaian.pegawai.keluarga.components.modal-update')
    </div>
  </div>
</div>
@endsection

@section('script')
@include('kepegawaian.pegawai.keluarga.components.js')

@endsection