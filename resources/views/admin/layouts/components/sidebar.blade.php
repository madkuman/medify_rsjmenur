<nav id="sidebar">
     <div id="sidebar-scroll">
          <div class="sidebar-content">
               @include('layouts.components2.sidebar-header')
               <div class="content-side content-side-full">
                    <ul class="nav-main">
                         <li>
                              <a href="{{url('admin/hospital')}}"><i class="fa fa-hospital"></i>
                                   <span class="sidebar-mini-hide">Akun Rumah Sakit</span>
                              </a>
                         </li>
                         <li>
                              <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-user"></i><span class="sidebar-mini-hide">User Control</span></a>
                              <ul>
                                   <li>
                                       <a href="{{url('admin/user-control')}}">User</a>
                                   </li>
                                   <li>
                                       <a href="{{url('admin/hak-akses')}}">Hak Akses</a>
                                   </li>
                              </ul>
                         </li>
                         <!-- <li>
                              <a href="{{url('admin/user-control')}}"><i class="fa fa-user"></i>
                                   <span class="sidebar-mini-hide"> User</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/hak-akses')}}"><i class="fa fa-user"></i>
                                   <span class="sidebar-mini-hide"> Hak Akses</span>
                              </a>
                         </li> -->
                         <li>
                              <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-heart"></i><span class="sidebar-mini-hide">SIRS</span></a>
                              <ul>
                                   <li>
                                       <a href="{{url('admin/tempat-tidur-jenis')}}">Tempat Tidur Jenis</a>
                                   </li>
                                   <li>
                                       <a href="{{url('admin/tempat-tidur-kelas')}}">Tempat Tidur Kelas</a>
                                   </li>
                                   <li>
                                       <a href="{{url('admin/sirs-spesialisasi-bedah')}}">Spesialisasi Bedah</a>
                                   </li>
                                   <li>
                                       <a href="{{url('admin/sirs-kegiatan-radiologi')}}">Kegiatan Radiologi</a>
                                   </li>
                                   <li>
                                       <a href="{{url('admin/sirs-kegiatan-lab')}}">Kegiatan Lab</a>
                                   </li>
                                   <li>
                                        <a href="{{url('admin/sirs-kegiatan-perinatologi')}}">Kegiatan Perinatologi</a>
                                    </li>
                                   <li>
                                       <a href="{{url('admin/sirs-kegiatan-gigi-mulut')}}">Kegiatan Gigi Mulut</a>
                                   </li>
                                   <li>
                                       <a href="{{url('admin/sirs-kegiatan-rehab-medik')}}">Kegiatan Rehab Medik</a>
                                   </li>
                                   <li>
                                       <a href="{{url('admin/sirs-kegiatan-pelayanan-khusus')}}">Kegiatan Pelayanan Khusus</a>
                                   </li>
                                   <li>
                                       <a href="{{url('admin/sirs-kegiatan-kesehatan-jiwa')}}">Kegiatan Kesehatan Jiwa</a>
                                   </li>
                                   <li>
                                       <a href="{{url('admin/sirs-cara-bayar')}}">Cara Bayar</a>
                                   </li>
                                   <li>
                                       <a href="{{url('admin/sirs-kunjungan-kegiatan')}}">Kunjungan Kegiatan</a>
                                   </li>
                                   <li>
                                       <a href="{{url('admin/sirs-spesialisasi-rujukan')}}">Spesialisasi Rujukan</a>
                                   </li>
                                   <li>
                                       <a href="{{url('admin/sirs-kegiatan-kebidanan')}}">Kegiatan Kebidanan</a>
                                   </li>
                              </ul>
                         </li>
                        @if (config('medify.third-party.sirs_v3.on'))
                            <li>
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-heart"></i><span class="sidebar-mini-hide">SIRS V3</span></a>
                                <ul>
                                    <li>
                                        <a href="{{url('admin/third-party/sirs-v3/pekerjaan')}}">Pekerjaan</a>
                                    </li>
                                    <li>
                                        <a href="{{url('admin/third-party/sirs-v3/status-keluar')}}">Status Keluar</a>
                                    </li>
                                    <li>
                                        <a href="{{url('admin/third-party/sirs-v3/sync-master-data')}}">Auto Sync Master Data</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                         <li>
                              <a href="{{url('admin/lokasi')}}"><i class="fa fa-map"></i>
                                   <span class="sidebar-mini-hide"> Lokasi</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/lokasi-zona-ppi')}}"><i class="fa fa-map-pin"></i>
                                   <span class="sidebar-mini-hide"> Lokasi Zona PPI</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/dokter')}}"><i class="fa fa-stethoscope"></i>
                                   <span class="sidebar-mini-hide">Dokter</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/agama')}}"><i class="fa fa-moon-o"></i>
                                   <span class="sidebar-mini-hide">Agama</span>
                              </a>
                         </li>
                         <li>
                              <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fas fa-briefcase-medical"></i><span class="sidebar-mini-hide">Kasus</span>
                              </a>
                              <ul>
                                   <li>
                                        <a href="{{url('admin/kasus/informed-consent')}}">Informed Consent</a>
                                   </li>
                              </ul>
                         </li>
                         <li>
                              <a href="{{url('admin/kelas')}}"><i class="fa fa-layer-group"></i>
                                   <span class="sidebar-mini-hide">Jenis Kelas</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/identitas')}}"><i class="fa fa-id-card"></i>
                                   <span class="sidebar-mini-hide">Jenis Kartu Identitas</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/keluarga')}}"><i class="fa fa-child"></i>
                                   <span class="sidebar-mini-hide">Hubungan Keluarga</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/pernikahan')}}"><i class="fa fa-transgender"></i>
                                   <span class="sidebar-mini-hide">Jenis Pernikahan</span>
                              </a>
                         </li>
                         {{--<li>
                              <a href="{{url('admin/pembayaran')}}"><i class="fa fa-credit-card-front"></i>
                                   <span class="sidebar-mini-hide">Jenis Pembayaran</span>
                              </a>
                         </li>
                         --}}
                         <li>
                              <a href="{{url('admin/pekerjaan')}}"><i class="fa fa-briefcase"></i>
                                   <span class="sidebar-mini-hide">Jenis Pekerjaan</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/pembayaran-perusahaan')}}"><i class="fa fa-building"></i>
                                   <span class="sidebar-mini-hide">Pembayaran Perusahaan</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/pembayaran-perusahaan-type')}}"><i class="fal fa-building"></i>
                                   <span class="sidebar-mini-hide">Tipe Pembayaran Perusahaan</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/tarif')}}"><i class="fa fa-money"></i>
                                   <span class="sidebar-mini-hide">Tarif</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/tarif-tipe')}}"><i class="fa fa-money"></i>
                                   <span class="sidebar-mini-hide">Tarif Tipe</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/tarif-kategori')}}"><i class="fa fa-money"></i>
                                   <span class="sidebar-mini-hide">Tarif Kategori</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/tarif-kategori-inacbg')}}"><i class="fa fa-money"></i>
                              <span class="sidebar-mini-hide">Tarif Kategori INACBG</span></a>
                         </li>
                        <li>
                            <a href="{{url('admin/cara-pulang')}}"><i class="fa fa-sign-out"></i>
                                <span class="sidebar-mini-hide">Cara Pulang</span></a>
                        </li>
                        <li>
                            <a href="{{url('admin/cara-pulang-inacbg')}}"><i class="fa fa-sign-out"></i>
                                <span class="sidebar-mini-hide">Cara Pulang INACBG</span></a>
                        </li>
                        <li>
                            <a href="{{url('admin/status-pulang')}}"><i class="fa fa-sign-out"></i>
                                <span class="sidebar-mini-hide">Status Pulang</span></a>
                        </li>
                         <li>
                              <a href="{{url('admin/obat-tipe')}}"><i class="fa fa-pills"></i>
                                   <span class="sidebar-mini-hide">Obat Tipe</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/obat-aturan')}}"><i class="fa fa-pills"></i>
                                   <span class="sidebar-mini-hide">Obat Aturan</span>
                              </a>
                         </li>
                         <li>
                              <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fas fa-cloud"></i><span class="sidebar-mini-hide">Pendaftaran Online</span>
                              </a>
                              <ul>
                                   <li>
                                        <a href="{{url('admin/pendaftaran-online/tarif-kembali')}}">Tarif Kembali</a>
                                   </li>
                              </ul>
                         </li>
                         @if(config('app.is_military'))
                         <li>
                              <a href="{{url('admin/tni-korps')}}"><i class="fa fa-shield"></i>
                                   <span class="sidebar-mini-hide">TNI Korps</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/tni-satker')}}"><i class="fa fa-shield"></i>
                                   <span class="sidebar-mini-hide">TNI Satker</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/tni-keanggotaan')}}"><i class="fa fa-shield"></i>
                                   <span class="sidebar-mini-hide">TNI Keanggotaan</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/tni-pangkat')}}"><i class="fa fa-shield"></i>
                                   <span class="sidebar-mini-hide">TNI Pangkat</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/tni-kotama')}}"><i class="fa fa-shield"></i>
                                   <span class="sidebar-mini-hide">TNI Kotama</span>
                              </a>
                         </li>
                         <li>
                              <a href="{{url('admin/tni-pangkat-jenjang')}}"><i class="fa fa-shield"></i>
                                   <span class="sidebar-mini-hide">Jenjang Pangkat TNI</span>
                              </a>
                         </li>
                         @endif
                    </ul>
                    <ul class="nav-main">
                         <a href="#pengaturan-fitur" data-toggle="collapse"><i class="fa fa-cog"></i>
                              <span class="sidebar-mini-hide">Pengaturan Fitur</span><span class="pull-right"><i class="fas fa-chevron-down"></i></span>
                         </a>
                         <div class="collapse ml-4" id="pengaturan-fitur">
                             <li>
                                 <a href="{{url('admin/pengaturan-fitur/rawatjalan')}}"><i class="fa fa-hospital"></i>
                                     <span class="sidebar-mini-hide"> Rawat Jalan</span></a>
                             </li>
                              <li>
                                        <a href="{{url('admin/pengaturan-fitur/third-party')}}"><i class="fa fa-hospital"></i>
                                        <span class="sidebar-mini-hide"> Third Party</span></a>
                              </li>
                         </div>
                    </ul>
                    <ul class="nav-main">
                         <li>
                              <a href="{{url('admin/data-import')}}"><i class="fa fa-upload"></i>
                                   <span class="sidebar-mini-hide">Data Import</span>
                              </a>
                         </li>
                    </ul>
               </div>
          </div>
     </div>
</nav>
@section('js')
    <script>
         $(document).ready(function () {
               var url = location.href;
               
               $(`a[href='${url}']`).addClass('active');
               $(`a[href='${url}']`).parents('.collapse').addClass('show');

               $(`a[href='${url}']`).parentsUntil('.nav-main','div').each(function () { 
                    $(this).prev().find('.fas').removeClass("fa-chevron-down");
                    $(this).prev().find('.fas').addClass("fa-minus");
               });
         });

          $("[data-toggle='collapse']").click(function(){
               if ($(this).next().hasClass("show")) {
                    $(this).find(".fas").removeClass("fa-minus")
                    $(this).find(".fas").addClass("fa-chevron-down")
               } else {
                    $(this).find(".fas").removeClass("fa-chevron-down")
                    $(this).find(".fas").addClass("fa-minus")
               }               
          })
    </script>
     @parent
@endsection