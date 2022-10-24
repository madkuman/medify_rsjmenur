<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Laporan</h3>
    </div>
    <div class="block-content">
        <div class="row row-deck">
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Pelayanan Resep</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan pelayanan resep di farmasi</p>
                    </div>
                    <div class="block-content block-content-full">
                        <a href="{{url('farmasi/'.session('farmasi')->slug.'/laporan-v2/laporan-pelayanan-resep')}}" target="_blank" class="btn btn-hero btn-sm btn-noborder btn-secondary">Buat Laporan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Kecepatan Pelayanan Resep (Respon Time) - Harian</h3>
                    </div>
                    <div class="block-content">
                        <p>Data response time setiap transaksi yang dilakukan oleh farmasi, secara harian</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-response-time-harian">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Kecepatan Pelayanan Resep (Respon Time) - Tahunan</h3>
                    </div>
                    <div class="block-content">
                        <p>Data response time setiap transaksi yang dilakukan oleh farmasi, secara tahunan</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-response-time-tahunan">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Waktu Pelayanan</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan Waktu Pelayanan Racikan dan Non Racikan</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-waktu-pelayanan">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Kesesuaian Fornas atau Formularium RS Dokter Menulis Resep - Harian</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan Kesesuaian Fornas atau Formularium RS Dokter Menulis Resep - Harian</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-kesesuaian-dokter-fornas-harian">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Kesesuaian Fornas atau Formularium RS Dokter Menulis Resep - Bulanan</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan Kesesuaian Fornas atau Formularium RS Dokter Menulis Resep - Bulanan</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-kesesuaian-dokter-fornas-bulanan">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Telaah Resep</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan Telaah Resep</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-telaah-resep">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Sisa Stok</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan sisa stok berdasarkan kategori inklusi dan eksklusi</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-persediaan-farmasi">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Mutasi Stok</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan Mutasi Stok berdasarkan kategori inklusi dan eksklusi</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-perbekalan-farmasi">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div><!-- 
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Mutasi Stok Farmasi</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan Mutasi Stok Farmasi, harian, bulanan, tahunan, berdasarkan kategori inklusi dan eksklusi</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-mutasi-stok-emergensi">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div> -->
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Persediaan Stok Rumah Sakit</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan persediaan stok, harian, bulanan, tahunan, berdasarkan kategori inklusi dan eksklusi</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-stok-emergensi">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Rekap Penggunaan Barang</h3>
                    </div>
                    <div class="block-content">
                        <p>Rekap Laporan berdasarkan transaksi dan penghapusan barang</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-rekap-penggunaan-barang">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Nilai Penggunaan Barang</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan berdasarkan transaksi dan penghapusan barang. Menampilkan total nilai barang yang digunakan</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-penggunaan-barang">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Barang Telah Expired</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan barang yang masih ada stok namun telah expired</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-barang-telah-expired">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Barang Mendekati Expired</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan barang yang masih ada stok dan mendekati expired</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-barang-mendekati-expired">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Data Pelaksanaan Pelayanan Kefarmasian di Rumah Sakit Provinsi Jawa Timur</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan Pelaksanaan Pelayanan Kefarmasian di Rumah Sakit Provinsi Jawa Timur</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-pelayanan-kefarmasian-jatim">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Penggunaan Obat RS</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan Triwulan Penggunaan Obat Di Rumah Sakit</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-penggunaan-obat">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Pelayanan Obat Untuk Peserta JKN</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan Pelayanan Obat Untuk Peserta JKN</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-pelayanan-obat-jkn">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Penerimaan Barang Habis Pakai</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan Penerimaan Barang Habis Pakai</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-penerimaan-barang-habis-pakai">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Realisasi</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan Realisasi</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-realisasi">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan BPK Penerimaan</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan BPK Penerimaan</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-bpk-penerimaan">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan BPK Pemakaian</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan BPK Pemakaian</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-bpk-pemakaian">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan BPK Sumber Dana</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan BPK Sumber Dana</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-laporan-bpk-sumber-dana">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        {{--
        <div class="row row-deck">
             <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Expired Barang</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan Barang yang telah kadaluarsa</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-expired">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Kegiatan Kesehatan</h3>
                    </div>
                    <div class="block-content">
                        <p>Rekap obat masuk/keluar, stok sekarang dan stok kadaluarsa dalam rentang waktu tertentu.</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-kegiatan-kesehatan">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
             <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan PUT</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan PUT dari gudang dalam triwulan/bulan</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-put-gudang">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Rekapitulasi Per Kategori</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan barang farmasi untuk yang terbagi berdasarkan katagori</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-narkotika">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Pemakaian Obat</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan pemakaian obat kepada pasien dalam rentang waktu tertentu. Mendukung filter pemakaian obat berdasarkan jenis pembayaran pasien, kategori barang, dan shift ketika transaksi dilakukan </p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-pemakaian">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Pemberian Obat</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan pemberian obat terhadap salah satu pasien.</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-pemberian-obat">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Resep Obat</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan resep obat yang telah dibuat</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-resep">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Stok Sekarang</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan stok yang tersedia saat ini.</p>
                    </div>
                    <div class="block-content block-content-full">
                        <a href="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/stok-sekarang') }}" class="btn btn-hero btn-sm btn-noborder btn-secondary"  target="_blank">
                            Buat Laporan
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Stok Opname</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan hasil stok opname dalam rentang waktu tertentu</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-stok-opname">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Pemberian Obat Per Bangsal</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan pemberian obat </p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-pemberian-per-bangsal">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            @if(session('farmasi')->perharian)
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Pengeluaran Obat</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan pengeluaran obat oleh farmasi</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-pengeluaran">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Penjualan Obat</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan penjualan obat dalam rentang waktu tertentu</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-penjualan-obat">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Penjualan Bebas</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan penjualan bebas pada hari tertentu</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-penjualan-bebas">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Obat Masuk</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan distribusi obat yang masuk dalam rentang tanggal tertentu</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-distribusi-obat-masuk">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Obat Keluar</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan distribusi obat yang keluar dalam rentang tanggal tertentu</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-distribusi-obat-keluar">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Obat Dukungan</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan Pemakaian Obat Dukungan dalam rentang bulan tertentu</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-obat-dukungan">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            @if(session('farmasi')->kemoterapi)
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Rekapitulasi Pasien Kemoterapi</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan Rekapitulasi Pasien Kemoterapi yang melakukan transaksi obat</p>
                    </div>
                    <div class="block-content block-content-full">
                        <a href="javascript:void(0);" class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-pasien-kemoterapi">
                            Buat Laporan
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
        --}}
    </div>
</div>

@include('farmasi.laporan.modals.laporan-modals-farmasi')

@section('js')
    @include('farmasi.laporan.components.laporan-js-farmasi')
@endsection