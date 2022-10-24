<div class="block">
	<div class="block-header block-header-default">
        <h3 class="block-title">Daftar Riwayat Listrik Mati</h3>
        <div class="block-options">
            <button type="button" class="btn btn-primary min-width-125" id="btn-add">
                <i class="fa fa-plus mr-2"></i> Tambah Data
            </button>
        </div>
    </div>
    <div class="block-content block-content-full">
        @include('harmat.listrik-mati.components.filter')

        <div class="table-responsive">
        	<table class="table table-striped table-vcenter" id="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Tanggal Listrik Mati</th>
                        <th class="text-center">Jam Listrik Mati</th>
                        <th class="text-center">Jam Listrik Nyala</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
