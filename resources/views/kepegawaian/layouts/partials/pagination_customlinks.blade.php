
@if ($paginator->hasPages())
  @php
    # tampering pagination elements

    $maxbutton_most = (isset($maxbutton_most) ? intval($maxbutton_most) : 2 );
    if( empty($maxbutton_most) )
      $maxbutton_most = 2;

    $maxbutton_less = (isset($maxbutton_less) ? intval($maxbutton_less) : 2);
    if( empty($maxbutton_less) )
      $maxbutton_less = 1;

    // Filter elements
    // print_r($elements);

    if( count($elements) > 1 ){
      $tmp_elements = array_values($elements);

      $partial_element = count($tmp_elements);
      $first = $tmp_elements[0];
      $n_first = count( $first );
      $tail = $tmp_elements[$partial_element-1];
      $n_tail = count( $tail );

      $mid = [];
      $n_mid = 0;
      if( $partial_element > 3 ){
        // there is a midset
        $mid = $tmp_elements[floor($partial_element/2)];
        $n_mid = count( $mid );

        $mostbutton_pos = 'mid';
        $mostbutton = $mid;

        $lessbutton_pos = 'first';
        $lessbutton = $first;
      }
      else{
        
        $mostbutton_pos = ( $n_first > $n_tail ? 'first' : 'tail');
        $mostbutton = ( $mostbutton_pos == 'first' ? $first : $tail);
        
        $lessbutton_pos = ( $n_first < $n_tail ? 'first' : 'tail');
        $lessbutton = ( $lessbutton_pos == 'tail' ? $tail : $first);
      }


      // processing button_most
      if( $maxbutton_most < count($mostbutton) ){
        $currentPage = $paginator->currentPage();
        $akeys = array_keys($mostbutton);
        $currentPagePos = array_search($currentPage, $akeys);
        $ahalf_maxbutton_most = floor($maxbutton_most / 2);


        $akeys_picked = $akeys_picked_index = [];
        $mostbutton_picked = [];
        // To the left
        for($i=($currentPagePos-$ahalf_maxbutton_most); $i<$currentPagePos; $i++){
          if( isset($akeys[$i]) )
            $akeys_picked[] = $i;
        }
        $akeys_picked[] = $currentPagePos;

        // To the right
        for($i=$currentPagePos+1, $iL=($currentPagePos+$ahalf_maxbutton_most); $i<=$iL; $i++){
          if( isset($akeys[$i]) )
            $akeys_picked[] = $i;
        }
        // print_r($akeys_picked);
        foreach($akeys as $akind => $index){
          if(in_array($akind, $akeys_picked) )
            $akeys_picked_index[] = $index;
        }


        foreach($mostbutton as $index => $pageurl){
          if( in_array($index, $akeys_picked_index) )
            $mostbutton_picked[$index] = $pageurl;
        }
        // print_r($mostbutton_picked);
        // exit;
        
        if( $mostbutton_pos != 'mid' )
          $indexTo = ( $mostbutton_pos == 'first' ? 0 : $partial_element-1);
        else
          $indexTo = floor($partial_element/2);
        $tmp_elements[$indexTo] = $mostbutton_picked;
      }

      // processing button_less
      if( $maxbutton_less < count($lessbutton) ){

        $lessbutton = array_slice($lessbutton, 0, $maxbutton_less);

        $lessbutton_reindexed = [];
        foreach($lessbutton as $index => $pageurl){
          $assigned_index = ($index+1);
          if( preg_match("/page=(\\d+)/", $pageurl, $cucok) )
            $assigned_index = $cucok[1];

          $lessbutton_reindexed[$assigned_index] = $pageurl;
        }

        $indexTo = ( $lessbutton_pos == 'first' ? 0 : $partial_element-1);
        $tmp_elements[$indexTo] = $lessbutton_reindexed;
      }


      // manual replacement, due to array_values
      $istep = 0;
      foreach($elements as $index => $pageset){
        if( isset($tmp_elements[$istep]) )
          $elements[$index] = $tmp_elements[$istep];
      
        $istep++;
      }
    }

    // single-element of page
    else{
      $mostbutton_pos = 'first';
      $mostbutton = $elements[0];

      // processing button_most
      if( $maxbutton_most < count($mostbutton) ){
        $currentPage = $paginator->currentPage();
        $akeys = array_keys($mostbutton);
        $currentPagePos = array_search($currentPage, $akeys);
        $ahalf_maxbutton_most = floor($maxbutton_most / 2);
        
        $offset_left = ($currentPagePos - $ahalf_maxbutton_most);
        $offset_right = ($currentPagePos + $ahalf_maxbutton_most);
        
        if( $offset_left < 0 )
          $offset_left = abs( $offset_left );
        else
          $offset_left = 0;

        if( $offset_right >= count($akeys) )
          $offset_right = ($offset_right - count($akeys) + 1);
        else
          $offset_right = 0;
        


        $akeys_picked = $akeys_picked_index = [];
        $mostbutton_picked = [];
        // To the left
        for($i=($currentPagePos-$ahalf_maxbutton_most-$offset_right); $i<$currentPagePos; $i++){
          if( isset($akeys[$i]) )
            $akeys_picked[] = $i;
        }
        $akeys_picked[] = $currentPagePos;

        // To the right
        for($i=$currentPagePos+1, $iL=($currentPagePos+$ahalf_maxbutton_most+$offset_left); $i<=$iL; $i++){
          if( isset($akeys[$i]) )
            $akeys_picked[] = $i;
        }
        // print_r($akeys_picked);
        foreach($akeys as $akind => $index){
          if(in_array($akind, $akeys_picked) )
            $akeys_picked_index[] = $index;
        }


        foreach($mostbutton as $index => $pageurl){
          if( in_array($index, $akeys_picked_index) )
            $mostbutton_picked[$index] = $pageurl;
        }

        // turning back to elements
        $elements[0] = $mostbutton_picked;
      }
    }
  @endphp


  <ul class="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <li class="page-item disabled"><span>{!! isset($prev) ? $prev : '&laquo;' !!}</span></li>
    @else
      <li class="page-item">
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev">{!! isset($prev) ? $prev : '&laquo;' !!}</a>
      </li>
    @endif



    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
        <li class="page-item disabled"><span>{{ $element }}</span></li>
      @endif

      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <li class="page-item active"><span>{{ $page }}</span></li>
          @else
            <li class="page-item"><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
      @endif
    @endforeach


    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" rel="next">{!! isset($next) ? $next : '&raquo;' !!}</a></li>
    @else
      <li class="page-item disabled"><span>{!! isset($next) ? $next : '&raquo;' !!}</span></li>
    @endif
  </ul>
@endif