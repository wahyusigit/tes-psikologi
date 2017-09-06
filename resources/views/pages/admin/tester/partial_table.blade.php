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
        {{ $no + 1 }}
        <input type="hidden" name="id_tsr" value="{{ $tester->id }}">
      </td>
      <td id="nama_tsr">{{ $tester->nama }}</td>
      <td id="no_hp_tsr">{{ $tester->no_hp }}</td>
      <td class="text-center">
        <div class="btn-group btn-group-xs">
          <a href="{{ route('adminEditTester', $tester->id) }}" class="btn btn-flat btn-default"><i class="fa fa-edit"></i></a>
          <button class="delete btn btn-flat btn-default"><i class="fa fa-trash"></i></button>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endif