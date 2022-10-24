<tr id="layanan_{{$index}}" data-index="0" class="single-layanan">
    <input type="hidden" name="form_id[]" value="{{$row->id}}">
    <input type="hidden" name="form_action[]" id="layanan_{{$index}}" data-index="{{$index}}">
    <td>
        <input type="number" name="form_referensi_min[]" class="form-control" placeholder="Minimal" value="{{$row->referensi_min}}">
    </td>
    <td class="border-right">
        <input type="number" name="form_referensi_max[]" class="form-control" placeholder="Maksimal" value="{{$row->referensi_max}}">
    </td>
    <td>
        <input type="number" name="form_kritis_min[]" class="form-control" placeholder="Batas Bawah" value="{{$row->kritis_min}}">
    </td>
    <td class="border-right">
        <input type="number" name="form_kritis_max[]" class="form-control" placeholder="Batas Atas" value="{{$row->kritis_max}}">
    </td>

    <td class="border-right text-center">
        <input type="hidden" name="form_jk_pria-{{$index}}" value="0" >
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" type="checkbox" name="form_jk_pria-{{$index}}" value="1" id="form-checkbox-pria-{{$index}}" @if($row->jk_pria == 1) checked @endif >
            <label class="custom-control-label" for="form-checkbox-pria-{{$index}}"></label>
        </div>
    </td>
    <td class="text-center border-right">
        <div class="custom-control custom-checkbox mb-5">
            <input type="hidden" name="form_jk_wanita-{{$index}}" value="0" >
            <input class="custom-control-input" type="checkbox" name="form_jk_wanita-{{$index}}" value="1" id="form-checkbox-wanita-{{$index}}"  @if($row->jk_wanita == 1) checked @endif >
            <label class="custom-control-label" for="form-checkbox-wanita-{{$index}}"></label>
        </div>
    </td>
    <td>
        <input type="text" name="usia_min[]" class="form-control" placeholder="Min" value="{{$row->usia_min}}">
    </td>
    <td class="border-right">
        <input type="text" name="usia_max[]" class="form-control" placeholder="Max" value="{{$row->usia_max}}">
    </td>
    <td>
        <button type="button" class="btn btn-danger" onclick="removeForm({{$index}}, {{$row->id}})">
            <i class="fa fa-times"></i>
        </button>
    </td>
</tr> 