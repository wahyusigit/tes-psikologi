@extends('layouts.admin')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')
@include('flash::message')
<form action="{{ route('adminUpdateJadwal',$jadwal->id) }}" method="POST">
{{ csrf_field() }}
	<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Jadwal</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Nama Sekolah</label>
            <select class="form-control" name="id_sek" id="selectize" placeholder="Select gear..." required="required" disabled="disabled">
              <option value="{{ $jadwal->sekolah->id }}">{{ $jadwal->sekolah->nama_sek }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Tanggal Tes</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input name="tanggal_jad" type="text" class="form-control pull-right" id="datepicker" required="required" value="{{ $jadwal->tanggal_jad }}">
            </div>
            <!-- /.input group -->
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Waktu Mulai</label>
            <input type="text" name="waktu_jad" required="required" class="form-control timepicker">
          </div>
        </div>
      </div>
      {{-- end row --}}
      <table id="tb_detail" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center col-md-1"><button type="button" class="add btn btn-flat btn-flat btn-success"><i class="fa fa-plus"></i></button></th>
            <th>Nama Ruang</th>
            <th>Nama Tester</th>
            <th class="text-center col-md-1"><i class="fa fa-trash"></i></th>
          </tr>
        </thead>
        <tbody id="append">
          @foreach($jadwal->detail as $numb => $detail)
          <tr>
            <td class="text-center">{{ $numb + 1 }}<input id="#id_jadwal_det" type="hidden" name="id_jadwal_det[]" value="{{ $detail->id }}"></td>
            <td><input type="text" name="nama_rng[]" class="form-control input-sm" value="{{ $detail -> ruang -> nama_rng }}" readonly="readonly"></td>
            <td>
              <select name="id[]" class="form-control input-sm" required="required" disabled="disabled">
                <optgroup label="default">
                  <option value="{{ $detail->tester->id }}">{{ $detail->tester->nama }}</option>
                </optgroup>
                @foreach($testers as $tester)
                <option value="{{ $tester->id }}">{{ $tester->id }} - {{ $tester->nama }}</option>
                @endforeach
              </select>
            </td>
            <td class="text-center"><button type="button" class="delete btn btn-sm btn-danger btn-flat" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> </button></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
      <a href="{{ route('adminJadwalIndex') }}" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i>  Kembali</a>
      <button type="submit" class="btn btn-flat btn-success pull-right"><i class="fa fa-save"></i>  Simpan</button>
    </div>
    <!-- /.box-footer -->
  </div>
</form>

<!-- Modal -->
<div id="delete" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi Hapus Data</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin menghapus data ini ?</p>
        <p>Jika Anda menghapus Ruang ini maka Data Siswa / Daftar Siswa yang berada pada Ruang ini juga Terhapus...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
        Close</button>
        <button id="yes_confirm" type="button" class="btn btn-danger btn-flat pull-right">Hapus</button>
      </div>
    </div>

  </div>
</div>
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/selectize/selectize.bootstrap3.css') }}">
@endpush
@push('script')
<script type="text/javascript" src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.id.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/selectize/selectize.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){ 
      $('#datepicker').datepicker({ format: 'yyyy-mm-dd' })
    });
</script>
<script type="text/javascript">
$(document).ready(function() {
  $('#selectize').selectize({
      create: false,
      sortField: 'text'
  });
});
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(".add").click(function(){
      $numb = $('#tb_detail tbody tr').length + 1;
      $("#append").append('<tr><td class="text-center">'+ $numb +'</td><td><input type="text" name="nama_rng_new[]" class="form-control input-sm" required="required"></td><td><select name="id_tsr_new[]" class="form-control input-sm" required="required">@foreach($testers as $tester)<option value="{{ $tester->id }}">{{ $tester->id }} - {{ $tester->nama }}</option>@endforeach</select></td><td class="text-center"><button type="button" class="remove btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i> </button></td></tr>');
    });
    $("body").on('click','.remove',function(){
        $(this).parent().parent().remove();
    });

    $("body").on('click','.delete',function(){
      $parent = $(this).parent().parent();
      $id_jad_det = $(this).parent().parent().find('input').val();
      document.getElementById('yes_confirm').onclick = function() {
        $_token = $('meta[name="csrf_token"]').attr('content');
        $.ajax({
          url : '{{ route('adminAjaxDeleteJadwalDetail') }}',
          type : 'POST',
          data : {'id_jad_det': $id_jad_det,'_token': $_token},
          success : function(response){
            if (response == "success") {
              $('#delete').modal('hide');
              $parent.remove();
            } else {
              alert('Maaf, Terjadi kesalahan sistem...');
            }
        }});
      };
    });
  });
</script>
<script type="text/javascript">
$('.timepicker').timepicker({
  timeFormat: 'HH:mm',
  interval: 30,
  minTime: '06',
  maxTime: '22:00',
  defaultTime: '07',
  startTime: '06:00',
  dynamic: false,
  dropdown: true,
  scrollbar: true
});
</script>
@endpush
