@extends('layouts.admin')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')
  <div class="row">
    <form action="{{ route('adminUpdateTester') }}" method="POST" enctype="multipart/form-data">
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
          <input type="hidden" name="id" value="{{ $tester->id }}">
          <div class="row">
            <div class="col-md-3">
              <label>Foto Profil</label>
              <img src="{{ asset($tester->avatar) }}" class="img img-responsive" alt="User Image">
              <input type="file" name="avatar" class="form-control">
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" readonly="readonly" value="{{ $tester->username }}">  
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nama lengkap</label>
                    <input type="text" name="nama" class="form-control text-capitalize" value="{{ $tester->nama }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $tester->email }}">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>No. HP</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ $tester->no_hp }}">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>No. Telp</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ $tester->no_hp }}">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" rows="3" class="form-control text-capitalize">{{ $tester->alamat }}</textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <div class="form-group">
            <a href="{{ route('adminTesterIndex') }}" class="btn btn-danger btn-flat pull-left"><i class="fa fa-arrow-left"></i>  Kembali</a>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success btn-flat pull-right"><i class="fa fa-save"></i>  Simpan</button>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>
@endsection
