<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Carbon\Carbon;

Route::get('/authRedirect', ['uses'=>'LoginRedirectController@check','as'=>'loginRedirect']);

Route::get('cc', function(){
	dd(Carbon::now());
});
Route::get('/artisan', function()
{
	//    Artisan::call('cache:clear');
	//    Artisan::call('config:clear');
	//    Artisan::call('config:cache');
	//    Artisan::call('vendor:publish');
	Artisan::call('serve');
    dd(Artisan::output());
});


Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/login');
});


Route::get('/home', 'LoginRedirectController@check');

// Route::group(['prefix' => 'root', 'middleware' => ['role:root']], function() {
//     Route::get('/', function() {
//         return "root";
//     });
// });

// Route::group(['prefix' => 'admin', 'middleware' => ['role:root|admin']], function() {
//     Route::get('/', function() {
//         return "admin";
//     });
// });

Route::group(['prefix' => 'root'], function() {
    return "hai min";
});

Route::group(['prefix'=>'admin','middleware'=>['auth','role:admin']],function(){
	Route::get('',['uses'=>'Admin\AdminController@index','as'=>'adminIndex']);

	Route::get('/profile', ['uses'=>'Admin\AdminController@profile','as'=>'adminProfile']);
	Route::post('/profile', ['uses'=>'Admin\AdminController@postProfile','as'=>'postAdminProfile']);

	Route::get('/chart', ['uses'=>'Admin\AdminController@chart','as'=>'chart']);

	Route::group(['prefix'=>'jadwal'],function(){
		Route::get('/',['uses'=>'Admin\JadwalController@index','as'=>'adminJadwalIndex']);
		Route::post('/',['uses'=>'Admin\JadwalController@postIndex','as'=>'postAdminJadwalIndex']);
		Route::post('/add',['uses'=>'Admin\JadwalController@postAddJadwal','as'=>'adminAddJadwal']);
		Route::post('/ajax/add/sekolah',['uses'=>'Admin\JadwalController@ajaxPostAddSekolah','as'=>'ajaxPostAddSekolah']);

		Route::get('/edit/{id}',['uses'=>'Admin\JadwalController@getEditJadwal'
			,'as'=>'adminEditJadwal']);
		Route::post('/update/{id}',['uses'=>'Admin\JadwalController@postUpdateJadwal','as'=>'adminUpdateJadwal']);
		Route::post('/delete',['uses'=>'Admin\JadwalController@postDeleteJadwal','as'=>'adminDeleteJadwal']);
		Route::post('/delete/ajax',['uses'=>'Admin\JadwalController@postAjaxDeleteJadwalDetail','as'=>'adminAjaxDeleteJadwalDetail']);
	});

	Route::group(['prefix'=>'sekolah'],function(){
		Route::get('',['uses'=>'Admin\SekolahController@index','as'=>'adminSekolahIndex']);
		Route::get('/ajax/search',['uses'=>'Admin\SekolahController@getAjaxSearchSekolah','as'=>'adminAjaxSearchSekolah']);
		Route::post('/add',['uses'=>'Admin\SekolahController@postAddSekolah','as'=>'adminAddSekolah']);
		Route::get('/show/{id}',['uses'=>'Admin\SekolahController@getShowSekolah','as'=>'adminShowSekolah']);
		Route::post('/update/ajax',['uses'=>'Admin\SekolahController@postAjaxUpdateSekolah','as'=>'adminAjaxUpdateSekolah']);
		Route::post('/delete/ajax',['uses'=>'Admin\SekolahController@postAjaxDeleteSekolah','as'=>'adminAjaxDeleteSekolah']);
	});

	Route::group(['prefix'=>'tester'],function(){
		Route::get('',['uses'=>'Admin\TesterController@index','as'=>'adminTesterIndex']);
		Route::post('/ajax/search',['uses'=>'Admin\TesterController@postAjaxSearchTester','as'=>'adminAjaxSearchTester']);

		Route::post('/get/username',['uses'=>'Admin\TesterController@getUsernameTester','as'=>'adminUsernameTester']);
		Route::get('/add',['uses'=>'Admin\TesterController@getAddTester','as'=>'adminAddTester']);
		Route::post('/add',['uses'=>'Admin\TesterController@postAddTester','as'=>'adminPostAddTester']);
		Route::get('/show/{id}',['uses'=>'Admin\TesterController@getShowTester','as'=>'adminShowTester']);

		Route::get('/edit/{id}',['uses'=>'Admin\TesterController@getEditTester','as'=>'adminEditTester']);
		Route::post('/update',['uses'=>'Admin\TesterController@postUpdateTester','as'=>'adminUpdateTester']);
		// Route::post('/update/ajax',['uses'=>'Admin\TesterController@postAjaxUpdateTester','as'=>'adminAjaxUpdateTester']);
		Route::post('/delete/ajax',['uses'=>'Admin\TesterController@postAjaxDeleteTester','as'=>'adminAjaxDeleteTester']);
	});

	Route::group(['prefix'=>'tes'],function(){
		Route::get('/',['uses'=>'Admin\TesController@index','as'=>'adminTesIndex']);
		// Route::post('/ajax/search',['uses'=>'Admin\TesController@postAjaxSearchTes','as'=>'adminAjaxSearchTes']);

		// Route::post('/get/username',['uses'=>'Admin\TesController@getUsernameTes','as'=>'adminUsernameTes']);
		// Route::get('/add',['uses'=>'Admin\TesController@getAddTes','as'=>'adminAddTes']);
		// Route::post('/add',['uses'=>'Admin\TesController@postAddTes','as'=>'adminPostAddTes']);
		// Route::get('/show/{id}',['uses'=>'Admin\TesController@getShowTes','as'=>'adminShowTes']);

		Route::get('/edit/{id}',['uses'=>'Admin\TesController@edit','as'=>'adminEditTes']);
		Route::post('/update',['uses'=>'Admin\TesController@update','as'=>'adminUpdateTes']);
		// Route::post('/update/ajax',['uses'=>'Admin\TesController@postAjaxUpdateTes','as'=>'adminAjaxUpdateTes']);
		// Route::post('/delete/ajax',['uses'=>'Admin\TesController@postAjaxDeleteTes','as'=>'adminAjaxDeleteTes']);
	});

	Route::group(['prefix'=>'laporan'],function(){
		Route::get('/',['uses'=>'Admin\LaporanController@index','as'=>'adminLaporanIndex']);
		Route::post('/',['uses'=>'Admin\LaporanController@postIndex','as'=>'postAdminLaporanIndex']);
		Route::get('/print',['uses'=>'Admin\LaporanController@print','as'=>'adminLaporanPrint']);
		Route::get('/downloadexcel',['uses'=>'Admin\LaporanController@downloadExcel','as'=>'adminLaporanDownloadExcel']);
	});
});

Route::group(['prefix'=>'tester','middleware'=>['auth','role:tester']],function(){
	Route::get('',['uses'=>'TesterController@index','as'=>'testerIndex']);
	Route::get('/tes',['middleware' => ['permission:get-jadwal-tester'],'uses'=>'TesterController@form','as'=>'testerForm']);
	Route::post('/tes/{id}',['middleware' => ['permission:get-jadwal-tester'],'uses'=>'TesterController@postForm','as'=>'postTesterForm']);
	Route::get('/tes/status/{id}/{status}',['middleware' => ['permission:get-jadwal-tester'],'uses'=>'TesterController@statusTes','as'=>'testerStatusTes']);
	Route::get('/profile', ['uses'=>'TesterController@profile','as'=>'testerProfile']);
	Route::post('/profile', ['uses'=>'TesterController@postProfile','as'=>'postTesterProfile']);
});

Auth::routes();
