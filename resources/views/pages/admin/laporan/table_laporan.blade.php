{{-- {{dd($laporans)}} --}}


<!DOCTYPE html>
<html>
<head>
  <title>Cetak Laporan Bulan Ini</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
  <style type="text/css">
      @media print {
    body {
      font-size: 10px;
    }
    .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
      float: left;
    }
    .col-sm-12 {
      width: 100%;
    }
    .col-sm-11 {
      width: 91.66666667%;
    }
    .col-sm-10 {
      width: 83.33333333%;
    }
    .col-sm-9 {
      width: 75%;
    }
    .col-sm-8 {
      width: 66.66666667%;
    }
    .col-sm-7 {
      width: 58.33333333%;
    }
    .col-sm-6 {
      width: 50%;
    }
    .col-sm-5 {
      width: 41.66666667%;
    }
    .col-sm-4 {
      width: 33.33333333%;
    }
    .col-sm-3 {
      width: 25%;
    }
    .col-sm-2 {
      width: 16.66666667%;
    }
    .col-sm-1 {
      width: 8.33333333%;
    }
    .col-sm-pull-12 {
      right: 100%;
    }
    .col-sm-pull-11 {
      right: 91.66666667%;
    }
    .col-sm-pull-10 {
      right: 83.33333333%;
    }
    .col-sm-pull-9 {
      right: 75%;
    }
    .col-sm-pull-8 {
      right: 66.66666667%;
    }
    .col-sm-pull-7 {
      right: 58.33333333%;
    }
    .col-sm-pull-6 {
      right: 50%;
    }
    .col-sm-pull-5 {
      right: 41.66666667%;
    }
    .col-sm-pull-4 {
      right: 33.33333333%;
    }
    .col-sm-pull-3 {
      right: 25%;
    }
    .col-sm-pull-2 {
      right: 16.66666667%;
    }
    .col-sm-pull-1 {
      right: 8.33333333%;
    }
    .col-sm-pull-0 {
      right: auto;
    }
    .col-sm-push-12 {
      left: 100%;
    }
    .col-sm-push-11 {
      left: 91.66666667%;
    }
    .col-sm-push-10 {
      left: 83.33333333%;
    }
    .col-sm-push-9 {
      left: 75%;
    }
    .col-sm-push-8 {
      left: 66.66666667%;
    }
    .col-sm-push-7 {
      left: 58.33333333%;
    }
    .col-sm-push-6 {
      left: 50%;
    }
    .col-sm-push-5 {
      left: 41.66666667%;
    }
    .col-sm-push-4 {
      left: 33.33333333%;
    }
    .col-sm-push-3 {
      left: 25%;
    }
    .col-sm-push-2 {
      left: 16.66666667%;
    }
    .col-sm-push-1 {
      left: 8.33333333%;
    }
    .col-sm-push-0 {
      left: auto;
    }
    .col-sm-offset-12 {
      margin-left: 100%;
    }
    .col-sm-offset-11 {
      margin-left: 91.66666667%;
    }
    .col-sm-offset-10 {
      margin-left: 83.33333333%;
    }
    .col-sm-offset-9 {
      margin-left: 75%;
    }
    .col-sm-offset-8 {
      margin-left: 66.66666667%;
    }
    .col-sm-offset-7 {
      margin-left: 58.33333333%;
    }
    .col-sm-offset-6 {
      margin-left: 50%;
    }
    .col-sm-offset-5 {
      margin-left: 41.66666667%;
    }
    .col-sm-offset-4 {
      margin-left: 33.33333333%;
    }
    .col-sm-offset-3 {
      margin-left: 25%;
    }
    .col-sm-offset-2 {
      margin-left: 16.66666667%;
    }
    .col-sm-offset-1 {
      margin-left: 8.33333333%;
    }
    .col-sm-offset-0 {
      margin-left: 0%;
    }
    .visible-xs {
      display: none !important;
    }
    .hidden-xs {
      display: block !important;
    }
    table.hidden-xs {
      display: table;
    }
    tr.hidden-xs {
      display: table-row !important;
    }
    th.hidden-xs,
    td.hidden-xs {
      display: table-cell !important;
    }
    .hidden-xs.hidden-print {
      display: none !important;
    }
    .hidden-sm {
      display: none !important;
    }
    .visible-sm {
      display: block !important;
    }
    table.visible-sm {
      display: table;
    }
    tr.visible-sm {
      display: table-row !important;
    }
    th.visible-sm,
    td.visible-sm {
      display: table-cell !important;
    }
  }
  </style>
  <table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th style="vertical-align: middle;" rowspan="2" class="text-center">No.</th>
      <th style="vertical-align: middle;" rowspan="2">Nama Sekolah</th>
      <th style="vertical-align: middle;" rowspan="2" class="text-center">Tanggal</th>
      <th style="vertical-align: middle;" rowspan="2" class="text-center">Waktu</th>
      {{-- <th class="text-center">Jml Ruang</th> --}}
      <th style="vertical-align: middle;" rowspan="2" class="text-center">Status</th>
      <th style="vertical-align: middle;" rowspan="2" class="text-center">Ruang & Tester</th>
      <th style="vertical-align: middle;" colspan="2" class="text-center">Absensi</th>
      {{-- <th style="vertical-align: middle;" rowspan="2" class="text-center">Siswa<br>Terjadwal</th> --}}
      {{-- <th style="vertical-align: middle;" rowspan="2" class="text-center">Siswa<br>Hadir</th> --}}
      {{-- <th style="vertical-align: middle;" rowspan="2" class="text-center">Total Siswa</th> --}}
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
          {{-- <td class="text-center">{{ count($laporan->detail) }}</td> --}}
          
          <td rowspan="{{ count($laporan->detail) + 1}}" class="text-center"><span class="label label-success">Sudah</span></td>
        </tr>
        @foreach($laporan->detail as $detail) 
        <tr>
          <td>
              {{ $detail->ruang->nama_rng }} - {{ $detail->tester->nama }}
          </td>
          <td class="text-center">
              @if(empty($detail->waktu_mulai_tes))
              -
              @endif
              {{ $detail->waktu_mulai_tes }}
          </td>
          <td class="text-center">
              @if(empty($detail->waktu_mulai_tes))
              -
              @endif
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
  <script type="text/javascript">
    window.print();

  </script>
</body>
</html>


