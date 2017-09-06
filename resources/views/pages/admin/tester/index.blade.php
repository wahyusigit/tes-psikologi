@extends('layouts.admin')

@section('htmlheader_title','Data Tester')

@section('main-content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Tester</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">   
        <div id="pesan" class="callout callout-success" style="display: none">
          <h4>Informasi!</h4>
          <p id="isi_pesan"></p>
        </div>
        @if($testers->isEmpty())
          <h4 class="text-center">Tidak Ada Tester</h4>
        @else
        <div class="col-md-10">
          <div class="form-group">
            <input name="search" type="text" class="form-control input-lg" id="search" placeholder="Cari...">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <a href="{{ route('adminAddTester') }}" class="btn btn-success btn-flat btn-block btn-lg"><i class="fa fa-plus"></i> Tambah</a>
          </div>
        </div>
        <table id="tb_tester" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th class="col-md-1">No.</th>
              <th>Nama Tester</th>
              <th>No. Hp</th>
              <th class="col-md-1">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($testers as $no => $tester)
            <tr>
              <td>
                {{ $no + 1 }}
                <input type="hidden" name="id_tsr" value="{{ $tester->id }}">
              </td>
              <td class="text-capitalize" id="nama_tsr">{{ $tester->nama }}</td>
              <td id="no_hp_tsr">{{ $tester->no_hp }}</td>
              <td class="text-center">
                <div class="btn-group btn-group-xs">
                  <a href="{{ route('adminEditTester', $tester->id) }}" class="btn btn-flat btn-default"><i class="fa fa-edit"></i></a>
                  <button class="delete btn btn-flat btn-default"><i class="fa fa-trash"></i></button>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif
      </div>
    </div>
  </div>
</div>


<div id="tester_modal_delete" class="modal modal modal-danger fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-edit"></i> <span>Hapus Tester</span></h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin menghapus data ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-flat btn-danger" data-dismiss="modal">Tidak</button>
        <button id="yes" type="button" class="btn btn-flat btn-danger pull-right"><i class="fa fa-trash"></i>  <span>  Ya</span></button>
      </div>
    </div>
  </div>
</div>
@endsection


@push('script')
<script type="text/javascript">
  $('body').on('click','.delete',function(){
    $('#tester_modal_delete').modal('show');

    $id_tsr = $(this).parent().parent().parent().find('input').val();  
    $d_element = $(this).parent().parent().parent();
    $('#tester_modal_delete').modal('show');
    $('#yes').click(function(){
      $_token = $('meta[name="csrf_token"]').attr('content');
      $.ajax({
        url : '{{ route('adminAjaxDeleteTester') }}',
        type : 'POST',
        data : {'id_tsr' : $id_tsr,'_token':$_token},
        success : function(response){
          if (response == "success") {
            $('#tester_modal_delete').modal('hide');
            $d_element.remove();
            $('#isi_pesan').append("Tester " + $d_element.find('#nama_tsr').text() + "berhasil dihapus...");
            $('#pesan').show();
          }
      }});  
    });
    
  });

  $("body").on( "keyup", "#search", function() {
      $_token = $('meta[name="csrf_token"]').attr('content');
      $.ajax({
        url : '{{ route('adminAjaxSearchTester') }}',
        type : 'POST',
        data : {'_token': $_token,'search': this.value},
        success : function(response){
          $('#tb_tester').html(response);
        }
      });
    });
</script>
@endpush