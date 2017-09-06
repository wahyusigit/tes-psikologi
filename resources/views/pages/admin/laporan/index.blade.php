@extends('layouts.admin')

@section('htmlheader_title','Laporan')

@section('main-content')
	<div class="row">
		<div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-list"></i>  Tester</a></li>
          <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-archive"></i></a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div id="pesan" class="callout callout-success" style="display: none">
              <h4>Informasi!</h4>
              <p id="isi_pesan"></p>
            </div>
            <div class="row">
              <form class="form-inline col-md-10" action="{{ route('postAdminLaporanIndex') }}" method="POST">
              {{ csrf_field() }}
                <div class="form-group">
                  <label>Bulan</label>
                  <input type="month" name="yearmonth" class="form-control">                
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary form-control btn-flat">Lihat</button>
                </div>
              </form>
            </div>
            <br>
            <legend>Laporan Bulan</legend>
            <a href="{{ route('adminLaporanPrint') }}" class="btn btn-primary btn-flat pull-right" target="_blank">Cetak Laporan Bulan Ini</a>
            @if($laporans->isEmpty())
              <h4 class="text-center">Tidak Ada Laporan</h4>
            @else
            <table class="table table-bordered table-striped" media="print">
              <thead>
                <tr>
                  <th style="vertical-align: middle;" rowspan="2" class="text-center">No.</th>
                  <th style="vertical-align: middle;" rowspan="2">Nama Sekolah</th>
                  <th style="vertical-align: middle;" rowspan="2" class="text-center">Tanggal</th>
                  <th style="vertical-align: middle;" rowspan="2" class="text-center">Waktu</th>
                  <th style="vertical-align: middle;" rowspan="2" class="text-center">Status</th>
                  <th style="vertical-align: middle;" rowspan="2" class="text-center">Ruang & Tester</th>
                  <th style="vertical-align: middle;" colspan="2" class="text-center">Absensi</th>

                </tr>
                <tr>
                  <th class="text-center">Waktu Mulai</th>
                  <th class="text-center">Waktu Selesai</th>
                </tr>
              </thead>
              <tbody>
                @foreach($laporans as $no => $laporan)
                  @if(count($laporan->detail) > 1)
                    <tr>
                      <td rowspan="{{ count($laporan->detail)  + 1}}">{{ $no + 1 }}</td>
                      <td rowspan="{{ count($laporan->detail)  + 1}}">{{ $laporan->sekolah->nama_sek }}</td>
                      <td rowspan="{{ count($laporan->detail)  + 1}}" class="text-center">{{ $laporan->tanggal_jad }}</td>
                      <td rowspan="{{ count($laporan->detail)  + 1}}" class="text-center">{{ $laporan->waktu_jad }}</td>
                      <td rowspan="{{ count($laporan->detail) + 1}}" class="text-center"><span class="label label-success">Sudah</span></td>
                    </tr>
                    @foreach($laporan->detail as $detail) 
                    <tr>
                      <td>
                          <span>{{ $detail->ruang->nama_rng }} - {{ $detail->tester->nama }}
                      </td>
                      <td class="text-center">
                          {{ $detail->waktu_mulai_tes }}
                      </td>
                      <td class="text-center">
                          {{ $detail->waktu_selesai_tes }}
                      </td>

                    </tr>
                    @endforeach

                  @else
                  <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $laporan->sekolah->nama_sek }}</td>
                    <td class="text-center">{{ $laporan->tanggal_jad }}</td>
                    <td class="text-center">{{ $laporan->waktu_jad }}</td>
                    {{-- <td class="text-center">{{ count($laporan->detail) }}</td> --}}
                    
                    <td class="text-center"><span class="label label-success">Sudah</span></td>
                    <td>
                      @foreach($laporan->detail as $detail) 
                        {{ $detail->ruang->nama_rng }} - {{ $detail->tester->nama }}
                      @endforeach
                    </td>
                    <td class="text-center"> 
                      @foreach($laporan->detail as $detail) 
                        {{ $detail->waktu_mulai_tes }}
                      @endforeach
                    </td>
                    <td class="text-center"> 
                      @foreach($laporan->detail as $detail) 
                        {{ $detail->waktu_selesai_tes }}
                      @endforeach
                    </td>
                  </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
            @endif
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
    </div>
	</div>
@endsection
