<div class="row">
     <div class="col-4">
    <h6>{{$input->label}}</h6>
          <small>{{$input->caption}}</small>
     </div>
     <div class="col"> 
          @foreach($input->opsi as $opsi)
          @php $checked = 0 @endphp
          <div class="custom-control custom-radio mb-5">
               <input class="custom-control-input" type="radio" name="input-{{$input->id}}" id="input-{{$opsi->id}}"  value="{{$opsi->id}}" data-score="{{$opsi->skor}}" 
               @if(!empty($input->hasil->value))
               @if($opsi->id == $input->hasil->value)
               checked
               @php $checked = 1 @endphp
               @endif
               @endif
               @if($show_data_as == 'show') disabled @endif

               >
               <label class="custom-control-label" for="input-{{$opsi->id}}">
                   @if($checked && $show_data_as != 'edit') <strong class="text-black"> @endif
                        {{$opsi->deskripsi}} (Skor : {{$opsi->skor}})
                   @if($checked && $show_data_as != 'edit') </strong> @endif
              </label>
         </div>
         @endforeach
    </div>
</div>