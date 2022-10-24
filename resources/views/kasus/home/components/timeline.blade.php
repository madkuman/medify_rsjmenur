<div class="col-lg-6 pl-5">
    <div class="block mb-0">
        <div class="block-header block-header-default">
            <h3 class="block-title">Aktivitas Terakhir</h3>
            <div class="block-options">
            </div>
        </div>
        <div class="block-content block-content-full">
            <ul class="list list-timeline list-timeline-modern pull-t">
                <!-- Twitter Notification -->

                @php $showEmptyActivity = 0 @endphp
                @forelse($activities as $item)
                <li>
                    <div class="list-timeline-time">{{$item->tanggal}} yang lalu</div>
                    <i class="list-timeline-icon fa {{$item->icon}} bg-info"></i>
                    <div class="list-timeline-content">
                        <p class="font-w600">{{$item->tab_string}}</p>
                        <p><strong>{{$item->creator->name}}</strong> {{$item->type_string}} {{$item->tab_string}}</p>
                    </div>
                </li>
                @empty
                @php $showEmptyActivity = 1 @endphp
                @endforelse
                <!-- END Twitter Notification -->

                

                
            </ul>
            @if($showEmptyActivity)
            <div class="text-center py-50">
                <h4 class="font-w400 mb-5">Tidak ada aktivitas pada hari ini</h4>
            </div>
            @endif
        </div>
    </div>
</div>
