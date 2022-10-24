
<div class="row @if(isset($is_hrd_member) && !$is_hrd_member)  d-none @endif" >
  <div class="col-12">
    <div class="block" style="background-color: #FCFCFD">
      <div class="block-content container">
        <h4><span class="text-muted font-w400">Kepegawaian / </span> @yield('subtitle')</h4>
        @php
          $cekPrefix = explode('/', Route::getCurrentRoute()->getPrefix())[1];
        @endphp
        <ul class="nav nav-tabs-alt">
          <li class="nav-item">
            <a class="nav-link @if(Route::currentRouteName() == 'employees') active @endif" href="{{ route('pegawai') }}"><i class="fas fa-fw fa-users mr-5"></i>Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if($cekPrefix == 'cuti') active @endif" href="{{url('/kepegawaian/cuti')}}"><i class="fa fa-forward fa-files-o mr-5"></i>Cuti</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if($cekPrefix == 'laporan') active @endif" href="{{ route('report') }}"><i class="fa fa-fw fa-files-o mr-5"></i>Laporan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if($cekPrefix == 'master') active @endif" href="{{ route('master-kepegawaian') }}"><i class="fa fa-fw fa-cogs mr-5"></i>Pengaturan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if($cekPrefix == 'statistika') active @endif" href="{{ route('statistika') }}"><i class="fa fa-fw fa-bar-chart mr-5"></i>Statistik</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if($cekPrefix == 'user-control') active @endif" href="{{ route('user-control') }}"><i class="fa fa-fw fa-user-times mr-5"></i>User Control</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if($cekPrefix == 'hasil-kuisioner') active @endif" href="{{ route('hasil-kuisioner') }}"><i class="fa fa-fw fa-pencil-square-o mr-5"></i>Hasil Kuisioner</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" id="toolbarDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-bars"></i> Menu</a>
            <div class="dropdown-menu" aria-labelledby="toolbarDrop">
              <a class="dropdown-item" href="#modalImport" data-toggle="modal" >
                <i class="fa fa-fw fa-file-import mr-5"></i>Import Excel</a>
              </a>
              <a class="dropdown-item" href="{{route('export-file')}}">
                <i class="fa fa-fw fa-file-export mr-5"></i>Export Excel</a>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div id="modalImport" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Data Pegawai</h4>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <a href="{{route('download-contoh-file')}}"><button class="btn btn-warning">Download Contoh Format File</button></a>
              </div>
            </div>
            <form action="{{route('pegawai-import')}}" enctype="multipart/form-data" autocomplete="off" method="POST">
                {{csrf_field()}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Masukkan File</label>
                        <input class="form-control" id="nama" type="file" name="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-batal" data-dismiss="modal">Batal</button>
                    <a id="del-btn">
                        <button type="submit" class="btn btn-primary pull-right btn-submit" style="margin-left: 4px ;"> <i class="fa fa-spin fa-spinner fa-1x btn-spin"></i> Simpan</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
  </div>
