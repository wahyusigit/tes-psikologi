@extends('layouts.admin')

@section('htmlheader_title','Jadwal')

@section('main-content')
	<div class="row">
    <div class="col-md-12">
      @if (session()->has('flash_notification.message'))
          <div class="alert alert-{{ session('flash_notification.level') }}">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {!! session('flash_notification.message') !!}
          </div>
      @endif
    </div>
		<div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-list"></i>  Jadwal</a></li>
          <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-plus"></i>  Tambah Jadwal</a></li>
          <li class="pull-right col-md-3">
            <form method="POST" action="{{ route('postAdminJadwalIndex') }}">
            {{ csrf_field() }}
            <div class="input-group input-group-sm" style="margin-top: 5px">
              <input type="month" class="form-control" name="bulantahun">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-info btn-flat">Lihat</button>
                  </span>
            </div>
            </form>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            @if($jadwals->isEmpty())
            <h4 class="text-center">Tidak Ada Jadwal</h4>
            @else
            <table class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Sekolah</th>
                  <th>Tanggal</th>
                  <th>Waktu</th>
                  <th>Jml Ruang</th>
                  <th class="col-md-1 text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($jadwals as $no => $jadwal)
                  <tr>
                    <td>
                      {{ (($jadwals->currentPage() - 1 ) * $jadwals->perPage() ) + $no + 1 }}
                      <input type="hidden" name="id_tsr" value="{{ $jadwal->id }}">
                    </td>
                    <td>{{ $jadwal->sekolah->nama_sek }}</td>
                    <td>{{ $jadwal->tanggal_jad }}</td>
                    <td>{{ $jadwal->waktu_jad }}</td>
                    <td>{{ count($jadwal->detail) }}</td>
                    <td class="text-center">
                      <div class="btn-group btn-group-xs">
                        <a href="{{ route('adminEditJadwal', $jadwal->id) }}" class="btn btn-flat btn-default"><i class="fa fa-edit"></i></a>
                        <a class="delete_jadwal btn btn-flat btn-default"><i class="fa fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
            @endif
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_2">
            <div class="callout callout-success">
              <h4>Informasi!</h4>

              <p>Jika nama Sekolah tidak ada, silahkan Tambah Nama Sekolah pada Halaman <code>Sekolah => Tambah Sekolah</code></p>
            </div>
            
            <form id="form_add_jadwal" action="{{ route('adminAddJadwal') }}" method="POST" form role="form">

            {{ csrf_field() }}
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Nama Sekolah</label>
                    <select name="id_sek" id="selectize" placeholder="Select gear..." required="required">
                      <option value=""></option>
                      @foreach($sekolahs as $sekolah)
                      <option value="{{ $sekolah->id }}">{{ $sekolah->nama_sek }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Tanggal Tes</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input name="tanggal_jad" type="text" class="form-control pull-right" id="datepicker" required="required" data-validation-required-message="You must agree to the terms and conditions">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Waktu Mulai</label>
                    <input type="text" name="waktu_jad" required="required" class="form-control timepicker">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="control-label">Total Siswa Terjadwal</label>
                    <input type="number" name="total_siswa_jad" class="form-control ttl_validation" data-validation-required-message="Please fill out this field" data-validation-number-message="Must be a number" required>
                    <p class="help-block"></p>
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
                    <th>Jml Siswa</th>
                    <th class="text-center"><i class="fa fa-trash"></i></th>
                  </tr>
                </thead>
                <tbody id="append">
                  <tr>
                    <td class="text-center">1</td>
                    <td><input type="text" name="ruang[1][nama_rng]" class="form-control input-sm text-uppercase" required="required"></td>
                    <td>
                      <select name="id_tsr[]" class="form-control input-sm" required="required">
                        @foreach($testers as $no => $tester)
                        <option value="{{ $tester->id }}">{{ $no + 1 }} - {{ $tester->nama }}</option>
                        @endforeach
                      </select>
                    </td>
                    <td class="col-md-1"><input type="number" name="ruang[1][jumlah_siswa_rng]" class="form-control input-sm jml_validation" ></td>
                    <td class="text-center"><button type="button" class="remove btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i> </button></td>
                  </tr>
                </tbody>
              </table>
              <div class="form-actions box-footer">
                <button type="submit" class="btn btn-flat btn-success pull-right"><i class="fa fa-save"></i>  Simpan</button>
              </div>
            </form>

          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
    </div>
	</div>


<div id="delete_jadwal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi Hapus Data</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin menghapus data ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
        Batal</button>
        <button id="yes_confirm_delete" type="button" class="btn btn-danger btn-flat pull-right">Hapus</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/selectize/selectize.bootstrap3.css') }}">
{{-- <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"> --}}
@endpush
@push('script')
{{-- <script type="text/javascript" src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.id.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/selectize/selectize.min.js') }}"></script>
{{-- <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> --}}
<script type="text/javascript">

    $(document).ready(function(){ 
      $('body').on('keyup change','.jml_validation', function(){
        var sum = 0;
        var ttl = $('.ttl_validation').val();
        // alert(ttl);
        $('.jml_validation').each(function() {
            sum += Number($(this).val());
        });

        if (sum > ttl) {
          alert('Maaf, Jumlah Siswa perkelas melebihi Total Siswa. Silahkan Cek kembali...');
        }
      })


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
      $("#append").append('<tr><td class="text-center">'+ $numb +'</td><td><input type="text" name="ruang['+ $numb +'][nama_rng]" class="form-control input-sm text-uppercase" required="required"></td><td><select name="id_tsr[]" class="form-control input-sm" required="required">@foreach($testers as $no => $tester)<option value="{{ $tester->id }}">{{ $no + 1 }} - {{ $tester->nama }}</option>@endforeach</select></td><td class="col-md-1"><input type="number" name="ruang['+ $numb +'][jumlah_siswa_rng]" class="form-control input-sm jml_validation"></td><td class="text-center"><button type="button" class="remove btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i> </button></td></tr>');
    });
    $("body").on('click','.remove',function(){
        $(this).parent().parent().remove();
    });
    $("body").on('click','.delete_jadwal',function(){
      $('#delete_jadwal').modal('show');
      $parent = $(this).parent().parent().parent();
      $id_jad = $(this).parent().parent().parent().find('input').val();
      document.getElementById('yes_confirm_delete').onclick = function() {
        $_token = $('meta[name="csrf_token"]').attr('content');
        $.ajax({
          url : '{{ route('adminDeleteJadwal') }}',
          type : 'POST',
          data : {'id_jad': $id_jad,'_token': $_token},
          success : function(response){
            if (response == "success") {
              $('#delete_jadwal').modal('hide');
              $parent.remove();
            } else {
              alert('Maaf, Terjadi kesalahan sistem...');
            }
        }});
      };
    });
    $("body").on('click','.add_sekolah',function(){
      $('#add_sekolah').modal('show');

      document.getElementById('yes_confirm_add_sekolah').onclick = function() {
        $nama_sek = document.getElementById('nama_sek').value;
        $alamat_sek = document.getElementById('alamat_sek').value;
        $no_telp_sek = document.getElementById('no_telp_sek').value;

        $_token = $('meta[name="csrf_token"]').attr('content');
        alert($_token);
        $.ajax({
          url : '{{ route('ajaxPostAddSekolah') }}',
          type : 'POST',
          data : {'nama_sek':$nama_sek, 'alamat_sek':$alamat_sek,'no_telp_sek':$no_telp_sek,'_token': $_token},
          success : function(response){
            if (response == "success") {
              $('#add_sekolah').modal('hide');
            } else {
              alert('Maaf, Terjadi kesalahan sistem...');
            }
        }});
      };
    });
  });
</script>

{{-- Start Form Validator --}}
<script type="text/javascript">
  $(document).ready(function() {
    $('#form_add_jadwal').bootstrapValidator({
        row: {
            valid: 'field-success',
            invalid: 'field-error'
        },
        
        framework: 'bootstrap',
        icon: {
            required: 'fa fa-asterisk',
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields: {
            id_sek: {
                validators: {
                    notEmpty: {
                        message: 'Tidak boleh kosong'
                    },
                    // stringLength: {
                    //     min: 1,
                    //     max: 6,
                    //     message: 'Username tidak boleh lebih dari 6 huruf'
                    // },
                    // regexp: {
                    //     regexp: /^[a-zA-Z0-9_\.]+$/,
                    //     message: 'The username can only consist of alphabetical, number, dot and underscore'
                    // }
                }
            },
            tanggal_jad: {
                validators: {
                    notEmpty: {
                        message: 'Tidak boleh kosong'
                    },
                }
            },
            waktu_jad: {
                validators: {
                    notEmpty: {
                        message: 'Tidak boleh kosong'
                    },
                }
            },
            total_siswa_jad: {
                validators: {
                    notEmpty: {
                        message: 'Total Siswa tidak boleh kosong'
                    },
                    stringLength: {
                        min: 1,
                        max: 3,
                        message: 'Untuk saat ini Total Siswa tidak boleh lebih dari 999'
                    },
                    regexp: {
                        message: 'Total Siswa hanya boleh diisi dengan Angka',
                        regexp: /^[0-9\s\-()+\.]+$/
                    }
                }
            },
            'ruang[]': {
                validators: {
                    notEmpty: {
                        message: 'Ruang harus diisi'
                    }
                }
            },
          }
      });
  });
</script>
{{-- End Form Validator --}}
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
