<?php

Route::get('/', ['uses' => 'AuthController@getLogin', 'as' => 'login']);
Route::post('/', ['uses' => 'AuthController@postLogin']);
Route::get('/logout', ['uses' => 'AuthController@getLogout', 'as' => 'logout']);

// Admin
Route::group(['prefix' => 'admin'], function() {
	Route::get('/', ['uses' => 'AdminController@index', 'as' => 'admin.index']);
	// Admin Resepsionist
	Route::get('/resepsionist', ['uses' => 'AdminController@adminResepsionist', 'as' => 'adminResepsionist']);
	Route::post('/resepsionist/create', ['uses' => 'AdminController@postAdminResepsionist', 'as' => 'postAdminResepsionist']);
	Route::post('/resepsionist/update', ['uses' => 'AdminController@updateAdminResepsionist', 'as' => 'updateAdminResepsionist']);
	Route::get('/resepsionist/delete', ['uses' => 'AdminController@deleteAdminResepsionist', 'as' => 'deleteAdminResepsionist']);
    	// Admin Dokter
    	Route::get('/dokter', ['uses' => 'AdminController@adminDokter', 'as' => 'adminDokter']);
    	Route::post('/dokter/create', ['uses' => 'AdminController@postAdminDokter', 'as' => 'postAdminDokter']);
    	Route::post('/dokter/addSpesialis', ['uses' => 'AdminController@addSpesialis', 'as' => 'addSpesialis']);
	Route::post('/dokter/update', ['uses' => 'AdminController@updateAdminDokter', 'as' => 'updateAdminDokter']);
	Route::get('/dokter/delete', ['uses' => 'AdminController@deleteAdminDokter', 'as' => 'deleteAdminDokter']);
	//Admin Apoteker
	Route::get('/apoteker', ['uses' => 'AdminController@adminApoteker', 'as' => 'adminApoteker']);
	Route::post('/apoteker/create', ['uses' => 'AdminController@postAdminApoteker', 'as' => 'postAdminApoteker']);
	Route::post('/apoteker/update', ['uses' => 'AdminController@updateAdminApoteker', 'as' => 'updateAdminApoteker']);
	Route::get('/apoteker/delete', ['uses' => 'AdminController@deleteAdminApoteker', 'as' => 'deleteAdminApoteker']);
});

// Respsionist
Route::group(['prefix' => 'resepsionist'], function() {
	Route::get('/', ['uses' => 'ResepsionistController@index', 'as' => 'resepsionist.index']);
	Route::post('/pendaftaran-pasien', ['uses' => 'ResepsionistController@postPendaftaranPasien', 'as' => 'postPendaftaranPasien']);
	Route::get('/pasien/hapus', ['uses' => 'ResepsionistController@getHapusPasien', 'as' => 'getHapusPasien']);
	Route::get('/pasien', ['uses' => 'ResepsionistController@getPasien', 'as' => 'getPasien']);
	Route::post('/pasien/pasien-terdaftar', ['uses' => 'ResepsionistController@postPasienTerdaftar', 'as' => 'postPasienTerdaftar']);
	Route::post('/pasien/update', ['uses' => 'ResepsionistController@postUpdatePasien', 'as' => 'postUpdatePasien']);
	Route::post('/pasien/export/{type}', ['uses' => 'ResepsionistController@exportExcelPasien', 'as' => 'exportExcelPasien']);
	Route::post('/pasien/exportPdf', ['uses' => 'ResepsionistController@exportPDFPasien', 'as' => 'exportPDFPasien']);
});

// Dokter
Route::group(['prefix' => 'dokter'], function() {
	// Periksa Pasien
	Route::get('/', ['uses' => 'DokterController@index', 'as' => 'dokter.index']);
	Route::get('/periksa/pasien/id={id}&nama={nama}&tgl={tgl}', ['uses' => 'DokterController@getRekamMedisPasien', 'as' => 'getRekamMedisPasien']);
	Route::post('/periksa/pasien', ['uses' => 'DokterController@postRekamMedisPasien', 'as' => 'postRekamMedisPasien']);
	Route::get('/getObat', ['uses' => 'DokterController@getObat', 'as' => 'getObat']);

	// Rekam Medis
	Route::get('/rekam-medis', ['uses' => 'DokterController@getRekamMedis', 'as' => 'getRekamMedis']);
	Route::post('/rekam-medis', ['uses' => 'DokterController@postUpdateRekamMedis', 'as' => 'postUpdateRekamMedis']);
	Route::post('/rekam-medis/excel/{type}', ['uses' => 'DokterController@exportExcelRekamMedis', 'as' => 'exportExcelRekamMedis']);
	Route::post('/rekam-medis/export/pdf', ['uses' => 'DokterController@exportPDFRekamMedis', 'as' => 'exportPDFRekamMedis']);
	Route::get('/rekam-medis/delete', ['uses' => 'DokterController@getDeleteRekamMedis', 'as' => 'getDeleteRekamMedis']);

	// Resep Dokter
	Route::get('/resep', ['uses' => 'DokterController@getResep', 'as' => 'getResep']);
	Route::post('/resep/excel/{type}', ['uses' => 'DokterController@excelResep', 'as' => 'excelResep']);
	Route::post('/resep/export/pdf', ['uses' => 'DokterController@PDFResep', 'as' => 'PDFResep']);
	Route::get('/resep/print/detail/{id}', ['uses' => 'DokterController@printDetailResep', 'as' => 'printDetailResep']);
	Route::get('/resep/detail', ['uses' => 'DokterController@getIsiResep', 'as' => 'getIsiResep']);


});

// Apoteker
Route::group(['prefix' => 'apoteker'], function() {
	Route::get('/', ['uses' => 'ApotekerController@index', 'as' => 'apoteker.index']);
	Route::get('/obat', ['uses' => 'ApotekerController@getObat', 'as' => 'getObat']);
	Route::post('/obat', ['uses' => 'ApotekerController@postObat', 'as' => 'postObat']);
	Route::post('/obat/update', ['uses' => 'ApotekerController@postUpdateObat', 'as' => 'postUpdateObat']);
	Route::get('/obat/getHapusObat', ['uses' => 'ApotekerController@getHapusObat', 'as' => 'getHapusObat']);
	Route::get('/obat/excel/{type}', ['uses' => 'ApotekerController@exportExcelObat', 'as' => 'exportExcelObat']);
	Route::post('/obat/export/Pdf', ['uses' => 'ApotekerController@exportPDFObat', 'as' => 'exportPDFObat']);
	Route::get('/DetailResep/dokter_id={dokter_id}&pasien_id={pasien_id}', ['uses' => 'ApotekerController@getDataResep', 'as' => 'getDataResep']);
	Route::post('/DetailResep/postResep', ['uses' => 'ApotekerController@postResep', 'as' => 'postResep']);
	Route::post('/DetailResep/dokter_id={dokter_id}&pasien_id={pasien_id}/Print', ['uses' => 'ApotekerController@PrintDetailResep', 'as' => 'PrintDetailResep']);
	Route::get('/getDetailResep', ['uses' => 'ApotekerController@getDetailResep', 'as' => 'getDetailResep']);
	Route::get('/getKategori', ['uses' => 'ApotekerController@getKategori', 'as' => 'getKategori']);
	Route::post('/postKategori', ['uses' => 'ApotekerController@postKategori', 'as' => 'postKategori']);
	Route::get('/getHapusKategori', ['uses' => 'ApotekerController@getHapusKategori', 'as' => 'getHapusKategori']);
	Route::post('/postUpdateKategori', ['uses' => 'ApotekerController@postUpdateKategoriObat', 'as' => 'postUpdateKategori']);

});

