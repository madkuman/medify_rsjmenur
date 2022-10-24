<div class="block">
	<div class="block-header block-header-default">
        <h3 class="block-title">Daftar Riwayat Perbaikan Alat</h3>
        <div class="block-options">
            <button type="button" class="btn btn-primary min-width-125" id="btn-add">
                <i class="fa fa-plus mr-2"></i> Tambah Data
            </button>
        </div>
    </div>
    <div class="block-content">
        @include('harmat.perbaikan-alat.components.filter')

        <div class="table-responsive">
        	<table class="table table-striped table-vcenter" id="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nama Alat</th>
                        <th class="text-center">Asal Ruangan</th>
                        <th class="text-center">Tanggal Lapor</th>
                        <th class="text-center">Tanggal Identifikasi</th>
                        <th class="text-center">Tanggal Service</th>
                        <th class="text-center">Tanggal Selesai</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Alasan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
