<ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary" data-toggle="tabs" role="tablist"">
    <li class="nav-item">
        <a class="nav-link
      @if (session('active_nav') == 'layanan' || empty(session('active_nav'))) active @endif
      " href="#layanan"
            id="nav-layanan">Layanan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link
      @if (session('active_nav') == 'evaluasi') active @endif
      " href="#evaluasi"
            id="nav-evaluasi">Fisik</a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link
      @if (session('active_nav') == 'mata') active @endif
      " href="#mata" id="nav-mata">Mata</a>
  </li> -->
    <li class="nav-item">
        <a class="nav-link
      @if (session('active_nav') == 'gigi') active @endif
      " href="#gigi"
            id="nav-gigi">Gigi</a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link
      @if (session('active_nav') == 'telinga') active @endif
      " href="#telinga" id="nav-telinga">Telinga</a>
  </li> -->
    <li class="nav-item">
        <a class="nav-link
      @if (session('active_nav') == 'resume') active @endif
      " href="#resume" id="nav-resume">
            Saran/Resume
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link
      @if (session('active_nav') == 'laporan') active @endif
      " href="#laporan"
            id="nav-laporan">Buku / Hasil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link
    @if (session('active_nav') == 'surat-keterangan') active @endif
    " href="#laporan"
            id="nav-laporan">Surat Keterangan</a>
    </li>
</ul>
