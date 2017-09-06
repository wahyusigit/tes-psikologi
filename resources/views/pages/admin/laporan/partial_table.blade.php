@if($testers->isEmpty())
  <h4 class="text-center">Data Tidak Ditemukan</h4>
@else

<table id="tb_tester" class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th>No.</th>
      <th>Nama Tester</th>
      <th>No. HP</th>
      <th class="col-md-1">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($testers as $no => $tester)
    <tr>
    <td>
                    {{ (($testers->currentPage() - 1 ) * $testers->perPage() ) + $no + 1 }}
                    <input type="hidden" name="id_tsr" value="{{ $tester->id }}">
                  </td>
      <td id="nama_tsr">{{ $tester->nama_tsr }}</td>
      <td id="no_hp_tsr">{{ $tester->no_hp_tsr }}</td>
      <td class="text-center">
        <div class="btn-group btn-group-xs">
          <button class="edit btn btn-flat btn-default"><i class="fa fa-edit"></i></button>
          <button class="delete btn btn-flat btn-default"><i class="fa fa-trash"></i></button>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endif