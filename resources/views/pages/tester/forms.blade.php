@extends('layouts.tester')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')
  
  <div class="row">
    <div class="col-md-12">
      @if($jadwals->isEmpty())
        <div class="box-body">
          <h4 class="text-center">Tidak ada jadwal hari ini</h4>
        </div>
      @else
      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
        @foreach($jadwals as $i => $jadwal)
          <li @if($i == 0)  class="active" @else @endif ><a href="#tab_{{ $i }}" data-toggle="tab"><i class="fa fa-list"></i>  Ruang: {{ $jadwal->nama_rng }}</a></li>
        @endforeach
          {{-- <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-plus"></i>  Tambah Sekolah</a></li> --}}
          {{-- <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-building"></i></a></li> --}}
        </ul>
        <div class="tab-content">
        @foreach($jadwals as $i => $jadwal)
          <div class="tab-pane @if($i == 0) active @else @endif" id="tab_{{ $i }}">
            <div class="row">
            <div class="col-md-12">
            <form id="form_{{$i}}" action="{{ route('postTesterForm',$jadwal->id) }}" method="POST">
            {{ csrf_field() }}
              <div class="col-md-4 col-xs-12">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nama Sekolah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><strong>{{ $jadwal->nama_sek }}</strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-4 col-xs-12">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Tanggal Jadwal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><strong>{{$jadwal->tanggal_jad}}</strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-4 col-xs-12">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th id="{{ $i+1 }}" class="text-center"><h4>Status Tes: <br><br><span class="label label-info status_tes">{{  $jadwal->status_jad_det }}</span></h4></th>
                      <td style="vertical-align: middle;">
                        @if($jadwal->status_jad_det == "Belum Dimulai")
                          <a href="{{ route('testerStatusTes', ['id'=>$jadwal->id,'status'=>'1']) }}" class="btn btn-primary btn-flat btn-lg btn-block">Mulai</a>
                          <input id="status_jad_det_{{$i}}" type="hidden" value="1">
                        @elseif($jadwal->status_jad_det == "Sedang Berlangsung")
                          <a href="{{ route('testerStatusTes', ['id'=>$jadwal->id,'status'=>'2']) }}" class="btn btn-danger btn-flat btn-lg btn-block">Selesai</a>
                          <input id="status_jad_det_{{$i}}" type="hidden" value="2">
                        @elseif($jadwal->status_jad_det == "Sudah Selesai")
                          <button href="#" class="btn btn-default btn-flat btn-lg btn-block" disabled="disabled">-</button>
                          <input id="status_jad_det_{{$i}}" type="hidden" value="0">
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <legend></legend>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Nama Tester</label>
                  <input type="text" name="nama" class="form-control" value="{{ $tester->nama }}" readonly="readonly">
                </div>
                <div class="form-group">
                  <label>Nama Ruang</label>
                  <input type="text" name="nama_ruang" class="form-control" value="{{ $jadwal->nama_rng }}" readonly="readonly">
                </div>
                <div class="form-group">
                  <label>Jumlah Siswa Terjadwal</label>
                  <input type="number" name="jumlah_siswa_terjadwal" class="form-control" value="{{ $jadwal->jumlah_siswa_rng }}" readonly="readonly">
                </div>
                
                <div class="form-group">
                  <label>Jumlah Siswa Hadir</label>
                  <input type="text" name="jumlah_siswa_jad_det" class="form-control" required="required" value="{{ $jadwal -> jumlah_siswa_jad_det }}">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Waktu Mulai</label>
                      <input type="time" name="waktu_mulai_tes" class="form-control" readonly="readonly" value="{{ $jadwal -> waktu_mulai_tes }}" readonly="readonly">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Waktu Selesai</label>
                      <input type="time" name="waktu_selesai_tes" class="form-control" readonly="readonly" value="{{ $jadwal -> waktu_selesai_tes }}">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea class="form-control" rows="5" placeholder="Contoh: Siswa yang tidak hadir : 1.Ahmad "></textarea>
                </div>
              </div>
              <div class="col-md-8">
                <div class="table-responsive">
                <table id="tes_detail" class="table table-hover">
                  <thead>
                    <tr>
                      <th class="col-md-1">No.</th>
                      <th>Jenis Tes</th>
                      <th class="col-md-2">Jumlah Buku</th>
                      <th>Waktu Mulai</th>
                      <th>Waktu Selesai</th>
                      <th>Timer</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @if($tesdetails[$i]->isEmpty())
                      @for($i=1;$i<=10;$i++)
                      <tr>
                        <td>{{$i}}</td>
                        <td><input type="text" name="data[{{$i}}][jenis_tes]" class="form-control text-uppercase disable"></td>
                        <td><input type="number" name="data[{{$i}}][jumlah_buku_tes]" class="form-control disable"></td>
                        <td><input id="waktu_mulai_{{$i}}" type="text" name="data[{{$i}}][waktu_mulai_tes_det]" class="form-control disable"></td>
                        <td><input id="waktu_selesai_{{$i}}" type="text" name="data[{{$i}}][waktu_selesai_tes_det]" class="form-control disable"></td>
                        <td><button onclick="timerxxx(this)" type="button" class="btn btn-default btn-flat btn-sm b_timer disable" id="b_timer" value="{{ $i }}">Timer</button></td>
                      </tr>
                      @endfor
                    @else
                      @foreach($tesdetails[$i] as $no => $detail)
                      <tr>
                        <td>{{$no+1}}</td>
                        <td><input type="text" name="data[{{$no+1}}][jenis_tes]" class="form-control text-uppercase" value="{{ $detail -> jenis_tes}}"></td>
                        <td><input type="number" name="data[{{$no+1}}][jumlah_buku_tes]" class="form-control" value="{{ $detail -> jumlah_buku_tes}}"></td>
                        <td><input id="waktu_mulai_{{$no+1}}" type="text" name="data[{{$no+1}}][waktu_mulai_tes_det]" class="form-control" value="{{ $detail -> waktu_mulai_tes_det}}"></td>
                        <td><input id="waktu_selesai_{{$no+1}}" type="text" name="data[{{$no+1}}][waktu_selesai_tes_det]" class="form-control" value="{{ $detail -> waktu_selesai_tes_det }}"></td>
                        <td><button  onclick="timerxxx(this)"  type="button" class="btn btn-default btn-flat btn-sm b_timer" id="b_timer" value="{{ $no+1 }}">Timer</button></td>
                      </tr>
                      @endforeach

                      @for($i=count($tesdetails[$i])+1;$i<=10;$i++)
                      <tr>
                        <td>{{$i}}</td>
                        <td><input type="text" name="data[{{$i}}][jenis_tes]" class="form-control text-uppercase"></td>
                        <td><input type="number" name="data[{{$i}}][jumlah_buku_tes]" class="form-control"></td>
                        <td><input id="waktu_mulai_{{$i}}" type="text" name="data[{{$i}}][waktu_mulai_tes_det]" class="form-control" value=""></td>
                        <td><input id="waktu_selesai_{{$i}}" type="text" name="data[{{$i}}][waktu_selesai_tes_det]" class="form-control" value=""></td>
                        <td><button  onclick="timerxxx(this)"  type="button" class="btn btn-default btn-flat btn-sm b_timer" id="b_timer" value="{{ $i }}">Timer</button></td>
                      </tr>
                      @endfor
                    @endif
                    
                  </tbody>
                </table>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-flat pull-right simpan">Simpan</button>
              </div>
            </form>
            </div>
            </div>
          </div>
          <!-- /.tab-pane -->
        @endforeach
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
      @endif
    </div>
  </div>
@endsection

@push('script')
<script type="text/javascript" src="{{ asset('plugins/timer/timer.jquery.min.js') }}"></script>
<script type="text/javascript">
function timerxxx(data) {
    $('.hs').remove();
    $(data).closest('tr').after('<tr id="timer" class="hs"><td colspan="3"></td><td><input type="text" name="timer" class="form-control timer" placeholder="0 sec"></td><td colspan="2"><div class="btn-group"><button onclick="startTimer(' + data.value + ')" type="button" class="btn btn-default btn-flat start-timer-btn' + data.value + '"><i class="fa fa-play"></i></button><button onclick="resumeTimer(' + data.value + ')" type="button" class="btn btn-default btn-flat resume-timer-btn' + data.value + ' hidden"><i class="fa fa-play"></i></button><button  onclick="pauseTimer(' + data.value + ')" type="button" class="btn btn-default btn-flat pause-timer-btn' + data.value + ' hidden"><i class="fa fa-pause"></i></button><button  onclick="removeTimer(' + data.value + ')" type="button" class="btn btn-default btn-flat remove-timer-btn' + data.value + ' hidden"><i class="fa fa-stop"></i></button></div></td></tr>');
  };

// for (var i = 0; i < {{ count($jadwals) }}; i++) {
//   if ($('#status_jad_det_'+i).val() == "1") {
//     $('#form_'+i).find(":input").prop('readonly', true);
//     $('#form_'+i).find(".b_timer").prop('disabled', true);
//     $('#form_'+i).find(".simpan").prop('disabled', true);
//   } else {
//     $('#form_'+i).find(":input").prop('readonly', false);
//     $('#form_'+i).find(".b_timer").prop('disabled', false);
//     $('#form_'+i).find(".simpan").prop('disabled', false);
//   }
// };

  
  
    var hasTimer = false;
    // Init timer start
    function startTimer(data) {
      date = new Date();
      currentTime = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
      document.getElementById('waktu_mulai_'+data).value = currentTime;

      hasTimer = true;
      $('.timer').css('');
      $('.timer').timer({
        editable: false
      });
      $('.start-timer-btn'+data).addClass('hidden');
      $('.pause-timer-btn'+data).removeClass('hidden');
      $('.remove-timer-btn'+data).removeClass('hidden');

      // disable button timer
      $('.b_timer').prop('disabled', true);
    };

    // Init timer resume
    function resumeTimer(data) {
      $('.timer').timer('resume');
      $('.resume-timer-btn'+data).addClass('hidden');
      $('.pause-timer-btn'+data).removeClass('hidden');
      $('.remove-timer-btn'+data).removeClass('hidden');
    };


     // Init timer pause
    function pauseTimer(data) {
      $('.timer').timer('pause');
      $('.pause-timer-btn'+data).addClass('hidden');
      $('.resume-timer-btn'+data).removeClass('hidden');
    };

     // Remove timer
    function removeTimer(data) {
      date = new Date();
      currentTime = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
      document.getElementById('waktu_selesai_'+data).value = currentTime;

      hasTimer = false;
      $('.timer').timer('remove');
      $('.remove-timer-btn'+data).addClass('hidden');
      $('.start-timer-btn'+data).removeClass('hidden');
      $('.pause-timer-btn'+data).addClass('hidden');
      $('.resume-timer-btn'+data).addClass('hidden');
      $('#timer').remove();
      $('.b_timer').prop('disabled', false);
    };

    // // Additional focus event for this demo
    // $('body').on('focus','.timer', function() {
    //   if(hasTimer) {
    //     $('.pause-timer-btn').addClass('hidden');
    //     $('.resume-timer-btn').removeClass('hidden');
    //   }
    // });

    // // Additional blur event for this demo
    // $('body').on('blur','.timer', function() {
    //   if(hasTimer) {
    //     $('.pause-timer-btn').removeClass('hidden');
    //     $('.resume-timer-btn').addClass('hidden');
    //   }
    // });
  // })();
  
  
</script>
{{-- Untuk Status Tes --}}
{{-- <script type="text/javascript">
  status_tes = $('.status_tes').text();
  console.log(status_tes);
  if (status_tes == "Belum Dimulai") {
    $('.disable').prop('disabled',true);
  } else {
    $('.disable').prop('disabled',false);
  }
</script> --}}
@endpush