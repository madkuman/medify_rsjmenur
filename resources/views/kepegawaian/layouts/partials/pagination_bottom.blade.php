<div class="row justify-content-center">
  
@if( !empty($items) && !$items->isEmpty() && empty($show_all) && $items->lastPage() > 1 )
  <div class="wrap-pagination">
    @if( $items->lastPage() > 1 )
      {!! $items->appends($paginationParams)->links(
        'kepegawaian.layouts.partials.pagination_customlinks', [
          "patternlinks" => "2.4.2",
          "prev" => "&lsaquo;",
          "next" => "&rsaquo;"
        ])
      !!}
    @endif
  </div>
@endif

</div>