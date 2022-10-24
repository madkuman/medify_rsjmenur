@section('css')

@endsection
<div class="row">
    <div class="col-sm-12"> 
        <form class="mb-50" id="logbookSearchForm">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari..." id="logbookSearch" autofocus="true">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-secondary">Cari</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-sm-12">
    	<table class="table table-bordered table-striped table-vcenter no-footer" id="logbookTable" style="width: 100%">
            <thead>
                <tr style="text-align: center">
                    <th class="text-center">#</th>
                    <th class="text-center">Lokasi</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Kronologi Kejadian</th>
                    <th class="text-center">Fatility</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>