<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/master', function () {
    return view('master');
});

/**************** ROUTE BERANDA ****************/
Route::get('/login', 'SSOController@index');
Route::get('/logout', 'SSOController@logout');
/**************** EO ROUTE BERANDA ****************/

/**************** ROUTE BERANDA ****************/
Route::get('/', 'BerandaController@index');
Route::get('/detailpengumuman/{id}', 'BerandaController@show');
/**************** EO ROUTE BERANDA ****************/


/**************** ROUTE HIBAH ******************/
Route::get('/hibah', 'HibahController@index'); //FIRST TIME TO HIBAH PAGE
//APPLY
Route::get('/hibah/applyhibah/{id}', 'HibahController@applyhibah'); //GO TO SPECIFIC HIBAH PAGE
//CREATE
Route::post('/createhibah', 'HibahController@create'); //ROUTES TO CREATE HIBAH
//KELOLA
Route::get('/hibah/kelolahibah/{id}', 'HibahController@kelolaHibah'); //GOT TO SPECIFIC HIBAH PAGE FOR EDIT
Route::post('/hibah/kelolahibah/updatehibah/{id}', 'HibahController@update'); //ROUTES TO UPDATE HIBAH
//DELETE
Route::get('/hibah/deletehibah/{id}', 'HibahController@delete'); //GO TO SPECIFIC HIBAH PAGE
/**************** EO ROUTE HIBAH ******************/


/**************** PESAN *************************/
Route::get('/pesan', 'PesanController@index');
Route::post('/kirimpesan', 'PesanController@create');
/**************** EO PESAN ********************/

/***************** EO MOU ***************************/
Route::get('/detailPesan/{id}', 'PesanController@detailPesan');
Route::get('/mou', 'MouController@index');
//CREATE
Route::post('/uploadmou', 'MouController@upload');
//UPDATE
Route::get('/mou/kelolamou/{id}', 'MouController@kelolaMoU');
Route::post('/mou/kelolamou/updatemou/{id}', 'MouController@update');
//DELETE
Route::get('/mou/deletemou/{id}', 'MouController@delete');
//DOWNLOAD
Route::get('/mou/downloadmou/{id}', 'MouController@getDownload');
/**************** EO MOU ********************/


/**************** PROPOSAL ******************/
Route::get('/proposal', 'ProposalController@index');
Route::get('/proposalupload/{id}', 'ProposalController@uploadRevisi');
Route::post('/proposalupload/uploadrevisi/{id}', 'ProposalController@revisi');
/**************** EO PROPOSAL ******************/


/**************** PROPOSAL HIBAH ******************/
Route::get('/proposalhibah', 'ProposalHibahController@index');
Route::get('/nilaiproposal', 'ProposalHibahController@nilaiProposal');
Route::get('/sesuaikanproposal', 'ProposalHibahController@sesuaikanProposal');
Route::post('/hibah/applyhibah/applyproposal', 'HibahController@storeProposal');
/**************** EO PROPOSAL HIBAH ******************/


/**************** BORANG ************************/
Route::get('/borang', 'BorangController@index');
/**************** EO BORANG ************************/


/**************** LAPORAN ************************/
Route::get('/laporan', 'LaporanController@index');
Route::get('/laporankemajuan', 'LaporanController@laporankemajuan');
Route::get('/uploadkemajuan', 'LaporanController@uploadkemajuan');
Route::get('/uploadlaporanberhibah', 'LaporanController@uploadlaporanberhibah');
Route::get('/uploadlaporantdkberhibah', 'LaporanController@uploadlaporantdkberhibah');
/**************** OE LAPORAN ********************/


/**************** PENGUMUMAN ********************/
Route::get('/pengumuman', 'PengumumanController@index');
Route::get('/kelolapengumumansingle/{id}', 'PengumumanController@edit');
Route::get('/hapuspengumuman/{id}', 'PengumumanController@delete');
Route::post('/kelolapengumumansingle/{id}', 'PengumumanController@update');
Route::post('/buatpengumuman', 'PengumumanController@create');
Route::get('/publishpengumuman/{id}', 'PengumumanController@publikasi');
/**************** EO PENGUMUMAN ********************/