@extends('layouts.admin')

@section('htmlheader_title','Sekolah')

@section('main-content')
	<div class="row">
		<div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-list"></i>  Sekolah</a></li>
          <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-plus"></i>  Tambah Sekolah</a></li>
          <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-building"></i></a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div id="pesan" class="callout callout-success" style="display: none">
              <h4>Informasi!</h4>
              <p id="isi_pesan"></p>
            </div>
            @if($sekolahs->isEmpty())
              <h4 class="text-center">Tidak Ada Sekolah</h4>
            @else
            <div class="form-group">
              <input name="search" type="text" class="form-control input-lg" id="search" placeholder="Cari...">
            </div>
            <table id="tb_sekolah" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Sekolah</th>
                  <th>Alamat Lengkap</th>
                  <th>No. Telp</th>
                  <th class="col-md-1">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($sekolahs as $no => $sekolah)
                <tr>
                  <td>
                    {{ (($sekolahs->currentPage() - 1 ) * $sekolahs->perPage() ) + $no + 1 }}
                    <input type="hidden" name="id_sek" value="{{ $sekolah->id }}">
                  </td>
                  <td class="text-uppercase" id="nama_sek">{{ $sekolah->nama_sek }}</td>
                  <td class="text-capitalize" id="alamat_sek">{{ $sekolah->alamat_sek }}</td>
                  <td id="no_telp_sek">{{ $sekolah->no_telp_sek }}</td>
                  <td class="text-center">
                    <div class="btn-group btn-group-xs">
                      <a href="{{ route('adminShowSekolah', $sekolah->id) }}" class="show btn btn-flat btn-default"><i class="fa fa-eye"></i></a>
                      <button class="edit btn btn-flat btn-default"><i class="fa fa-edit"></i></button>
                      <button class="delete btn btn-flat btn-default"><i class="fa fa-trash"></i></button>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $sekolahs->links() }}
            @endif
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_2">
            <form action="{{ route('adminAddSekolah') }}" method="POST">
            {{ csrf_field() }}
              <div class="form-group">
                <label>Nama Sekolah</label>
                <input type="text" name="nama_sek" class="form-control text-uppercase">
              </div>
              <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea class="form-control text-capitalize" rows="3" name="alamat_sek"></textarea>
              </div>
              <div class="form-group">
                <label>No. Telpon</label>
                <input type="text" name="no_telp_sek" class="form-control">
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-flat btn-success pull-right"><i class="fa fa-save"></i>  Simpan</button>
              </div>
            </form>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_3">

          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
    </div>
	</div>

  <!-- Modal -->
<div id="sekolah_modal_edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-edit"></i> <span>Edit Sekolah</span></h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Sekolah</label>
          <input id="inp_nama_sek" type="text" name="nama_sek" class="form-control">
        </div>
        <div class="form-group">
          <label>Alamat Lengkap</label>
          <textarea id="inp_alamat_sek" class="form-control" rows="3" name="alamat_sek"></textarea>
        </div>
        <div class="form-group">
          <label>No. Telpon</label>
          <input id="inp_no_telp_sek" type="text" name="no_telp_sek" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
        <button id="save" type="button" class="btn btn-flat btn-success pull-right"><i class="fa fa-save"></i>  <span>  Simpan</span></button>
      </div>
    </div>
  </div>
</div>
<div id="sekolah_modal_delete" class="modal modal modal-danger fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-edit"></i> <span>Hapus Sekolah</span></h4>
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
  $('body').on('click','.edit',function(){
    $id_sek = $(this).parent().parent().parent().find('input').val();  
    $d_element = $(this).parent().parent().parent();
    $nama_sek = $(this).parent().parent().parent().find('#nama_sek').text();  
    $alamat_sek = $(this).parent().parent().parent().find('#alamat_sek').text();  
    $no_telp_sek = $(this).parent().parent().parent().find('#no_telp_sek').text();  

    document.getElementById('inp_nama_sek').value = $nama_sek;
    document.getElementById('inp_alamat_sek').value = $alamat_sek;
    document.getElementById('inp_no_telp_sek').value = $no_telp_sek;

    $('#sekolah_modal_edit').modal('show');

    $('#save').click(function(){
      $_token = $('meta[name="csrf_token"]').attr('content');

      $nama_sek = document.getElementById('inp_nama_sek').value;
      $alamat_sek = document.getElementById('inp_alamat_sek').value;
      $no_telp_sek = document.getElementById('inp_no_telp_sek').value;
      $.ajax({
        url : '{{ route('adminAjaxUpdateSekolah') }}',
        type : 'POST',
        data : {'id_sek' : $id_sek,'nama_sek':$nama_sek,'alamat_sek':$alamat_sek,'no_telp_sek':$no_telp_sek,'_token':$_token},
        success : function(response){
          $('#sekolah_modal_edit').modal('hide');
          // $d_element.html('<td></td><td>'+ response.nama_sek +'</td><td>'+ response.alamat_sek +'</td><td>'+ response.no_telp_sek +'</td><td class="text-center"><div class="btn-group btn-group-xs"><button class="edit btn btn-flat btn-default"><i class="fa fa-edit"></i></button><button class="delete btn btn-flat btn-default"><i class="fa fa-trash"></i></button></div></td>');
          location.reload();
          // $('#isi_pesan').append("Sekolah " + $d_element.find('#nama_sek').text() + "berhasil diupdate...");
          // $('#pesan').show();
      }});  
    });

  });

  $('body').on('click','.delete',function(){
    $('#sekolah_modal_delete').modal('show');

    $id_sek = $(this).parent().parent().parent().find('input').val();  
    $d_element = $(this).parent().parent().parent();
    $('#sekolah_modal_delete').modal('show');
    $('#yes').click(function(){
      $_token = $('meta[name="csrf_token"]').attr('content');
      $.ajax({
        url : '{{ route('adminAjaxDeleteSekolah') }}',
        type : 'POST',
        data : {'id_sek' : $id_sek,'_token':$_token},
        success : function(response){
          if (response == "success") {
            $('#sekolah_modal_delete').modal('hide');
            $d_element.remove();
            $('#isi_pesan').append("Sekolah " + $d_element.find('#nama_sek').text() + "berhasil dihapus...");
            $('#pesan').show();
          }
      }});  
    });
    
  });

  $('body').on('click','.add',function(){
    $('#sekolah_modal_delete').modal('show');

    $id_sek = $(this).parent().parent().parent().find('input').val();  
    $d_element = $(this).parent().parent().parent();
    $('#sekolah_modal_delete').modal('show');
    $('#yes').click(function(){
      $_token = $('meta[name="csrf_token"]').attr('content');
      $.ajax({
        url : '{{ route('adminAjaxDeleteSekolah') }}',
        type : 'POST',
        data : {'id_sek' : $id_sek,'_token':$_token},
        success : function(response){
          if (response == "success") {
            $('#sekolah_modal_delete').modal('hide');
            $d_element.remove();
            $('#isi_pesan').append("Sekolah " + $d_element.find('#nama_sek').text() + "berhasil dihapus...");
            $('#pesan').show();
          }
      }});  
    });
    
  });

  $("body").on( "keyup", "#search", function() {
      $.ajax({
        url : '{{ route('adminAjaxSearchSekolah') }}',
        type : 'GET',
        data : {'search': $(this).val()},
        success : function(response){
          $('#tb_sekolah').html(response);
        }
      });
    });
</script>
@endpush