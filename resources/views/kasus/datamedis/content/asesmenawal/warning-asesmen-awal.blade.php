@if(!empty($last_asesmen_awal))
    <div class="col-12 pt-20">
    @if($last_asesmen_awal['wajib_isi'] == 1) 
        <div class="bg-danger p-20 mb-0 text-white">
            <h5 class="text-white mb-10">Asesmen Awal Wajib Diisi</h5>
            <p class="mb-0"> 
                @if(!empty($last_asesmen_awal['asesmen_awal_terakhir']->created_at))
                    Asesmen Awal diisi terakhir pada :
                    @php
                    $url = url('')."/kasus/".$last_asesmen_awal['asesmen_awal_terakhir']->kasus->nomor_kasus."/datamedis/asesmenawal";
                    @endphp
                    {{indonesian_date($last_asesmen_awal['asesmen_awal_terakhir']->created_at)}}
                    <a class="text-white font-w700" href="javascript:void(0)" onclick="popupwindow('{{$url}}','asesmen-awal',600,800)">Lihat disini</a>
                @else
                    Asesmen Awal untuk diagnosis ini belum pernah ada sebelumnya.
                @endif
                <br>
                <strong>Diagnosis ini termasuk {{$last_asesmen_awal['jenis_penyakit']}}. Asesmen awal wajib diisi setiap {{$last_asesmen_awal['batas_hari']}} hari.</strong>
            </p>
        </div>
    @else
        @if(!empty($last_asesmen_awal['asesmen_awal_terakhir']))
        <div class="alert alert-info mb-0">
            Asesmen Awal diisi terakhir pada :
                @php
                $url = url('')."/kasus/".$last_asesmen_awal['asesmen_awal_terakhir']->kasus->nomor_kasus."/datamedis/asesmenawal";
                @endphp
                {{indonesian_date($last_asesmen_awal['asesmen_awal_terakhir']->created_at)}}
                <a class="font-w700" href="javascript:void(0)" onclick="popupwindow('{{$url}}','asesmen-awal',600,800)">Lihat disini</a>
            <br>
            <strong>Diagnosis ini termasuk {{$last_asesmen_awal['jenis_penyakit']}}. Asesmen awal wajib diisi setiap {{$last_asesmen_awal['batas_hari']}} hari.</strong>
        </div>
        @endif
    @endif
    </div>
@endif