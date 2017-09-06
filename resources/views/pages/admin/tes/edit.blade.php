@extends('layouts.admin')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')
  <div class="row">
    <form action="{{ route('adminUpdateTes') }}" method="POST">
    {{ csrf_field() }}
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Profil</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">   
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Nama Ruang</th>
                <th>Nama Tester</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Status Tes</th>
              </tr>
            </thead>
            <tbody>
              @foreach($jadwal as $detail)
              {{-- {{ dd($detail) }} --}}
              <tr>
                <td>{{ $detail -> ruang -> nama_rng }}</td>
                <td>{{ $detail -> tester -> nama }}</td>
                <td>{{ $detail -> waktu_mulai_tes }}</td>
                <td>{{ $detail -> waktu_selesai_tes }}</td>
                <td>{{ $detail -> status_jad_det }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="box-footer">
          <div class="form-group">
            <a href="{{ route('adminTesIndex') }}" class="btn btn-danger btn-flat pull-left"><i class="fa fa-arrow-left"></i>  Kembali</a>
          </div>
          {{-- <div class="form-group">
            <button type="submit" class="btn btn-success btn-flat pull-right"><i class="fa fa-save"></i>  Simpan</button>
          </div> --}}
        </div>
      </div>
    </div>
    </form>
  </div>
@endsection
