<div class="card">
    <div class="card-header">
        <h4 class="card-title">Histori Penunjang</h4>
    </div>
    <div class="card-body">

        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#permintaan">Permintaan Penunjang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#galeri">Galeri Hasil Penunjang</a>
                </li>

            </ul>
            <div class="block-content tab-content overflow-hidden">
                <div class="tab-pane fade fade-left show active" id="permintaan" role="tabpanel">
                    @include('pasien.profile.content-penunjang.permintaan')
                </div>
                <div class="tab-pane fade fade-left" id="galeri" role="tabpanel">
                    @include('pasien.profile.content-penunjang.galeri')
                </div>

            </div>
        </div>
    </div>
</div>