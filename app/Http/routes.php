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
Route::get('/detailpengumuman', 'BerandaController@detailPengumuman');
/**************** EO ROUTE BERANDA ****************/


/**************** ROUTE HIBAH ******************/
Route::get('/hibah', 'HibahController@index'); //FIRST TIME TO HIBAH PAGE
Route::get('/hibah/applyhibah/{id}', 'HibahController@applyhibah'); //GO TO SPECIFIC HIBAH PAGE
Route::post('/createhibah', 'HibahController@create'); //ROUTES TO CREATE HIBAH
Route::get('/hibah/kelolahibah/{id}', 'HibahController@kelolaHibah'); //GOT TO SPECIFIC HIBAH PAGE FOR EDIT
Route::post('/hibah/kelolahibah/updatehibah/{id}', 'HibahController@update'); //ROUTES TO UPDATE HIBAH
Route::get('/hibah/deletehibah/{id}', 'HibahController@delete'); //GO TO SPECIFIC HIBAH PAGE
/**************** EO ROUTE HIBAH ******************/


/**************** PESAN *************************/
Route::get('/pesan', 'PesanController@index');
Route::post('/kirimpesan', 'PesanController@store');
//Route::get('/detailPesan/{id}', 'PesanController@detailPesan');
/**************** EO PESAN ********************/

/***************** EO MOU ***************************/
Route::get('/mou', 'MouController@index');
Route::post('/uploadmou', 'MouController@upload');
/**************** EO MOU ********************/


/**************** PROPOSAL ******************/
Route::get('/proposal', 'ProposalController@index');
Route::get('/proposalupload', 'ProposalController@uploadRevisi');
/**************** EO PROPOSAL ******************/


/**************** PROPOSAL HIBAH ******************/
Route::get('/proposalhibah', 'ProposalHibahController@index');
Route::get('/daftarproposalhibahriset/{id}', 'ProposalHibahController@getProposalRiset');
Route::get('/daftarproposalhibahpengmas/{id}', 'ProposalHibahController@getProposalPengmas');
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
Route::get('/kelolapengumuman', 'PengumumanController@kelola');
/**************** EO PENGUMUMAN ********************/