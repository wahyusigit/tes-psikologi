@extends('layouts.tester')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')
	<div class="row">
		<div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Jadwal Tester</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div>
            @if($details->isEmpty())
              <h4 class="text-center">Tidak Ada Jadwal</h4>
            @else
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td>No.</td>
                  <th>Tanggal</th>
                  <th>Sekolah</th>
                  <th>Nama Ruang</th>
                  <th>Waktu</th>
                </tr>
              </thead>
              <tbody>
                @foreach($details as $no => $detail)
                <tr @if($detail->jadwal->tanggal_jad == $carbon->toDateString()) class="success" @else @endif>
                  <td>{{ (($details->currentPage() - 1 ) * $details->perPage() ) + $no + 1 }}</td>
                  <td>{{ $carbon->createFromFormat('Y-m-d', $detail->jadwal->tanggal_jad)->format('d F Y') }}</td>
                  <td>{{ $detail->jadwal->sekolah->nama_sek }}</td>
                  <td>{{ $detail->ruang->nama_rng }}</td>
                  <td>{{ $carbon->createFromFormat('h:i:s', $detail->jadwal->waktu_jad)->format('h:i') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $details->links() }}
            @endif
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
      </div>
    </div>
	</div>
@endsection
