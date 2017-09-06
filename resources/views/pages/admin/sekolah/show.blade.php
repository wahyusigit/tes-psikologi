@extends('layouts.admin')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')
	<div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Sekolah : <strong>{{ $sekolah->nama_sek }}</strong></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <legend>Jadwal</legend>
          @if($sekolah->jadwal->isEmpty())
            <table id="tb_tester" class="table table-bordered table-hover table-striped"><h4 class="text-center">Tidak Ada Jadwal untuk Sekolah ini</h4>
            </table>
          @else
          <table class="table table-hover table-bordered table-striped">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Jumlah Ruang</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($sekolah->jadwal as $jadwal)
              <tr>
                <td>{{ $jadwal->tanggal_jad }}</td>
                <td>{{ count($jadwal->detail) }}</td>
                <td></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="{{ route('adminSekolahIndex') }}" class="btn btn-default btn-flat pull-left"><i class="fa fa-arrow-left"></i>  Kembali</a>
        </div>
        <!-- /.box-footer -->
      </div>
    </div>
	</div>

  <!-- Modal -->
<div id="sekolah_modal_edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-edit"></i> <span>Edit Sekolah</span></h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Sekolah</label>
          <input id="inp_nama_sek" type="text" name="nama_sek" class="form-control">
        </div>
        <div class="form-group">
          <label>Alamat Lengkap</label>
          <textarea id="inp_alamat_sek" class="form-control" rows="3" name="alamat_sek"></textarea>
        </div>
        <div class="form-group">
          <label>No. Telpon</label>
          <input id="inp_no_telp_sek" type="text" name="no_telp_sek" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
        <button id="save" type="button" class="btn btn-flat btn-success pull-right"><i class="fa fa-save"></i>  <span>  Simpan</span></button>
      </div>
    </div>
  </div>
</div>
<div id="sekolah_modal_delete" class="modal modal modal-danger fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-edit"></i> <span>Hapus Sekolah</span></h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin menghapus data ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-flat btn-danger" data-dismiss="modal">Tidak</button>
        <button id="yes" type="button" class="btn btn-flat btn-danger pull-right"><i class="fa fa-trash"></i>  <span>  Ya</span></button>
      </div>
    </div>
  </div>
</div>
@endsection
