@extends('adminlte::layouts.errors')

@section('htmlheader_title')
    Oops...
@endsection

@section('main-content')

    <div class="error-page col-md-10 col-md-offset-2">
        <h2 class="headline text-red"> 403</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! Maaf anda tidak bisa mengakses halaman ini...</h3>
            <p>
                Anda tidak memiliki Hak Akses untuk memuat halaman ini, silahkan <a class="btn btn-flat btn-xs btn-success" href="{{ URL::to('/login') }}">Login</a> dengan akun yang sesuai.
            </p>
        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
@endsection