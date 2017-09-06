@if($sekolahs->isEmpty())
  <h4 class="text-center">Data Tidak Ditemukan</h4>
@else

<table id="tb_sekolah" class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th>No.</th>
      <th>Nama Sekolah</th>
      <th>Alamat Lengkap</th>
      <th>No. Telp</th>
      <th class="col-md-1">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($sekolahs as $no => $sekolah)
    <tr>
      <td>
        {{ (($sekolahs->currentPage() - 1 ) * $sekolahs->perPage() ) + $no + 1 }}
        <input type="hidden" name="id_sek" value="{{ $sekolah->id }}">
      </td>
      <td id="nama_sek">{{ $sekolah->nama_sek }}</td>
      <td id="alamat_sek">{{ $sekolah->alamat_sek }}</td>
      <td id="no_telp_sek">{{ $sekolah->no_telp_sek }}</td>
      <td class="text-center">
        <div class="btn-group btn-group-xs">
          <a href="{{ route('adminShowSekolah', $sekolah->id) }}" class="show btn btn-flat btn-default"><i class="fa fa-eye"></i></a>
          <button class="edit btn btn-flat btn-default"><i class="fa fa-edit"></i></button>
          <button class="delete btn btn-flat btn-default"><i class="fa fa-trash"></i></button>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endif