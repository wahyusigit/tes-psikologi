@extends('layouts.admin')

@section('htmlheader_title','Data Tes')

@section('main-content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Tes</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">   
        @if($jadwals->isEmpty())
          <h4 class="text-center">Maaf, Tidak Ada Jadwal Tes Untuk Hari Ini</h4>
        @else
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Nama Sekolah</th>
              <th>Jumlah Ruang</th>
              <th>Siswa Terjadwal</th>
              <th>Tester</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($jadwals as $jadwal)
            <tr>
              <td>{{ $jadwal -> sekolah->nama_sek }}</td>
              <td>{{ count($jadwal -> detail) }}</td>
              <td>{{ $jadwal -> total_siswa_jad }}</td>
              <td>
                @foreach($jadwal->detail as $detail)
                  - {{ $detail->tester->nama }} <br>
                @endforeach
              </td>
              <td><a href="{{ route('adminEditTes', $jadwal->id) }}" class="btn btn-default btn-flat btn-xs"><i class="fa fa-edit"></i></a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
