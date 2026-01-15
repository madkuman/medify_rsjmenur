<div class="modal fade" id="preview-modal-{{ $loop_iteration_cppt }}-{{ $loop->iteration }}" tabindex="-1" aria-hidden="true" style="z-index: 1000000000 !important;" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Preview File</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" style="text-align: center;">
            @php
               $path = explode(".", $value->path);
               $extension = $path[1];
            @endphp
            @if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif')
            <img id="img-preview-modal" src="{{ url($value->path) }}" alt="" style="max-width: 460px;">
            @else
            <video width="460" height="460" controls>
               <source src="{{ url($value->path) }}" type="video/mp4">
               Your browser does not support the video tag.
            </video>
            @endif           
         </div>
      </div>
   </div>
</div>