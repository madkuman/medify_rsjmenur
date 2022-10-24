 {{-- Data Keluarga --}}
  <div>
    <h5 class="subjudul text-bold">Data Keluarga</h5>
  </div>
  @if ($pegawai->families->count() > 0)
  <div style="margin-left: 10px">
    <table class="table-custom" style="width: 100%">
      <thead>
        <tr>
          <th class="table-custom text-center" style="text-align: left; width: 4%">No</th>
          <th class="table-custom" style="text-align: center; width: 27%">Nama</th>
          <th class="table-custom" style="text-align: center; width: 11%">Lk/Pr</th>
          <th class="table-custom text-center" style="width: 25%">Tempat<br>Tgl Lahir</th>
          <th class="table-custom text-center" style="width: 20%">Umur</th>
          <th class="table-custom text-center" style="width: 14%">Pertalian Keluarga</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pegawai->families as $key => $family)
        <tr>
          <td class="table-custom text-center">{{$key+1}}</td>
          <td class="table-custom pad-left">{{ !empty($family->name) ? $family->name : '-'}}</td>
          <td class="table-custom" style="text-align: center;">{{ !empty($family->sex) ? $family->sex : '-' }}</td>
          <td class="table-custom pad-left" style="text-align: center;">{{ !empty($family->birth_place) ? $family->birth_place . ',' : '' }} {{ !empty($family->birth_date_report) ? $family->birth_date_report : '-'}}</td>
          <td class="table-custom text-center" style="text-align: center;">{{ !empty($family->age) ? $family->age : '-' }}</td>
          <td class="table-custom text-center" style="text-align: center;">{{ !empty($family->relationship) ? $family->relationship : '-'}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <div style="margin-left: 30px">
    <p>Tidak ada data.</p>
  </div>
  @endif