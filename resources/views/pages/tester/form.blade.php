@extends('layouts.tester')

@section('htmlheader_title')
  Home
@endsection

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Tes Hari Ini</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        @if(is_null($jadwal))

          <div class="box-body">
            <h4 class="text-center">Tidak ada jadwal hari ini</h4>
          </div>
        @else
        {{-- @if($jadwals->isEmpty())
          <div class="box-body">
            <h4 class="text-center">Tidak ada jadwal hari ini</h4>
          </div>
        @else --}}
        {{-- @foreach($jadwals as $jadwal) --}}
        <div class="box-body">
        <form action="{{ route('postTesterForm',$jadwal->id) }}" method="POST">
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
                  <th class="text-center"><h4>Status Tes: <br><br><span class="label label-info">{{  $jadwal->status_jad_det }}</span></h4></th>
                  <td style="vertical-align: middle;">
                    @if($jadwal->status_jad_det == "Belum Dimulai")
                      <a href="{{ route('testerStatusTes', ['id'=>$jadwal->id,'status'=>'1']) }}" class="btn btn-primary btn-flat btn-lg btn-block">Mulai</a>
                    @elseif($jadwal->status_jad_det == "Sedang Berlangsung")
                      <a href="{{ route('testerStatusTes', ['id'=>$jadwal->id,'status'=>'2']) }}" class="btn btn-danger btn-flat btn-lg btn-block">Selesai</a>
                    @elseif($jadwal->status_jad_det == "Sudah Selesai")
                      <button href="#" class="btn btn-default btn-flat btn-lg btn-block" disabled="disabled">-</button>
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
            <table class="table table-hover">
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
                @if($tesdetail->isEmpty())

                  @for($i=1;$i<=10;$i++)
                  <tr>
                    <td>{{$i}}</td>
                    <td><input type="text" name="data[{{$i}}][jenis_tes]" class="form-control text-uppercase"></td>
                    <td><input type="number" name="data[{{$i}}][jumlah_buku_tes]" class="form-control"></td>
                    <td><input id="waktu_mulai_{{$i}}" type="text" name="data[{{$i}}][waktu_mulai_tes_det]" class="form-control"></td>
                    <td><input id="waktu_selesai_{{$i}}" type="text" name="data[{{$i}}][waktu_selesai_tes_det]" class="form-control"></td>
                    <td><button type="button" class="btn btn-default btn-flat btn-sm b_timer" id="b_timer" value="{{ $i }}">Timer</button></td>
                  </tr>
                  @endfor
                @else
                  @foreach($tesdetail as $no => $detail)
                  <tr>
                    <td>{{$no+1}}</td>
                    <td><input type="text" name="data[{{$no+1}}][jenis_tes]" class="form-control text-uppercase" value="{{ $detail -> jenis_tes}}"></td>
                    <td><input type="number" name="data[{{$no+1}}][jumlah_buku_tes]" class="form-control" value="{{ $detail -> jumlah_buku_tes}}"></td>
                    <td><input id="waktu_mulai_{{$no+1}}" type="text" name="data[{{$no+1}}][waktu_mulai_tes_det]" class="form-control" value="{{ $detail -> waktu_mulai_tes_det}}"></td>
                    <td><input id="waktu_selesai_{{$no+1}}" type="text" name="data[{{$no+1}}][waktu_selesai_tes_det]" class="form-control" value="{{ $detail -> waktu_selesai_tes_det }}"></td>
                    <td><button type="button" class="btn btn-default btn-flat btn-sm b_timer" id="b_timer" value="{{ $no+1 }}">Timer</button></td>
                  </tr>
                  @endforeach

                  @for($i=count($tesdetail)+1;$i<=10;$i++)
                  <tr>
                    <td>{{$i}}</td>
                    <td><input type="text" name="data[{{$i}}][jenis_tes]" class="form-control text-uppercase"></td>
                    <td><input type="number" name="data[{{$i}}][jumlah_buku_tes]" class="form-control"></td>
                    <td><input id="waktu_mulai_{{$i}}" type="text" name="data[{{$i}}][waktu_mulai_tes_det]" class="form-control" value=""></td>
                    <td><input id="waktu_selesai_{{$i}}" type="text" name="data[{{$i}}][waktu_selesai_tes_det]" class="form-control" value=""></td>
                    <td><button type="button" class="btn btn-default btn-flat btn-sm b_timer" id="b_timer" value="{{ $i }}">Timer</button></td>
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
        {{-- @endforeach --}}
        @endif
        <!-- /.box-body -->
      </div>
    </div>
  </div>


          {{-- <div class="row">
            <div class="col-md-3">
              <input type="text" name="timer" class="form-control timer" placeholder="0 sec">
            </div>
            <div class="col-md-9">
              <button class="btn btn-success start-timer-btn">Mulai</button>
              <button class="btn btn-success resume-timer-btn hidden">Lanjutkan</button>
              <button class="btn pause-timer-btn hidden">Berhenti Sebentar</button>
              <button class="btn btn-danger remove-timer-btn hidden">Berhenti</button>
            </div>
          </div> --}}
@endsection

@push('script')
<script type="text/javascript" src="{{ asset('plugins/timer/timer.jquery.min.js') }}"></script>
<script type="text/javascript">
@if(!is_null($jadwal) && $jadwal->status_jad_det == "Belum Dimulai")
  $(":input").prop('readonly', true);
  $(".b_timer").prop('disabled', true);
  $(".simpan").prop('disabled', true);
@else
  $(":input").prop('readonly', false);
  $(".b_timer").prop('disabled', false);
  $(".simpan").prop('disabled', false);
@endif


  $('body').on('click','#b_timer', function(){
    $('#timer').remove();
    var val = this;
    $(this).parent().parent().after('<tr id="timer"><td colspan="3"></td><td><input type="text" name="timer" class="form-control timer" placeholder="0 sec"></td><td colspan="2"><div class="btn-group"><button type="button" class="btn btn-default btn-flat start-timer-btn"><i class="fa fa-play"></i></button><button type="button" class="btn btn-default btn-flat resume-timer-btn hidden"><i class="fa fa-play"></i></button><button type="button" class="btn btn-default btn-flat pause-timer-btn hidden"><i class="fa fa-pause"></i></button><button type="button" class="btn btn-default btn-flat remove-timer-btn hidden"><i class="fa fa-stop"></i></button></div></td></tr>');
    $('.start-timer-btn').on('click', function(){
      date = new Date();
      currentTime = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
      document.getElementById('waktu_mulai_'+val.value).value = currentTime;
    });
    $('.remove-timer-btn').on('click', function(){
      date = new Date();
      currentTime = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
      document.getElementById('waktu_selesai_'+val.value).value = currentTime;
      $('#timer').remove();
    });
    
  });
  (function(){
    var hasTimer = false;
    // Init timer start
    $('body').on('click','.start-timer-btn', function() {
      hasTimer = true;
      $('.timer').timer({
        editable: false
      });
      $(this).addClass('hidden');
      $('.pause-timer-btn, .remove-timer-btn').removeClass('hidden');
    });

    // Init timer resume
    $('body').on('click','.resume-timer-btn', function() {
      $('.timer').timer('resume');
      $(this).addClass('hidden');
      $('.pause-timer-btn, .remove-timer-btn').removeClass('hidden');
    });


    // Init timer pause
    $('body').on('click','.pause-timer-btn', function() {
      $('.timer').timer('pause');
      $(this).addClass('hidden');
      $('.resume-timer-btn').removeClass('hidden');
    });

    // Remove timer
    $('body').on('click','.remove-timer-btn', function() {
      hasTimer = false;
      $('.timer').timer('remove');
      $(this).addClass('hidden');
      $('.start-timer-btn').removeClass('hidden');
      $('.pause-timer-btn, .resume-timer-btn').addClass('hidden');
    });

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
  })();
  
  
</script>
@endpush