@extends('layouts.admin')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')
	<div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Sekolah : <strong>{{ $tester->nama_sek }}</strong></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <legend>Jadwal</legend>
          <table class="table table-hover table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Jumlah Ruang</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tester->jadwal as $tester)
              <tr>  
                <td>
                  {{ (($testers->currentPage() - 1 ) * $testers->perPage() ) + $no + 1 }}
                  <input type="hidden" name="id_tsr" value="{{ $tester->id }}">
                </td>
                <td>{{ $tester->tanggal_jad }}</td>
                <td>{{ count($tester->detail) }}</td>
                <td></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
          <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
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
