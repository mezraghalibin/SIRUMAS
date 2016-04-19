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



Route::resource('nilaiproposal', 'NilaiProposalController');

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
Route::get('/daftarproposalhibahriset/nilaiproposalriset/{id}', 'ProposalHibahController@nilaiProposalRiset');
Route::get('/daftarproposalhibahpengmas/nilaiproposalpengmas/{id}', 'ProposalHibahController@nilaiProposalPengmas');
Route::get('/daftarproposalhibahriset/sesuaikanproposalriset/{id}', 'ProposalHibahController@sesuaikanProposalRiset');
Route::get('/daftarproposalhibahpengmas/sesuaikanproposalpengmas/{id}', 'ProposalHibahController@sesuaikanProposalPengmas');
Route::get('/sesuaikanproposal', 'ProposalHibahController@sesuaikanProposal');
Route::post('/hibah/applyhibah/applyproposal', 'HibahController@storeProposal');
/**************** EO PROPOSAL HIBAH ******************/


/**************** LAPORAN ************************/
Route::get('/laporan', 'LaporanController@index');
Route::get('/laporankemajuan', 'LaporanController@laporankemajuan');
Route::get('/uploadkemajuan/{id}', 'LaporanController@uploadkemajuan');
Route::post('/uploadkemajuan/uploadprogress/{id}', 'LaporanController@uploadkemajuanstore');
Route::get('/uploadlaporanberhibah', 'LaporanController@uploadlaporanberhibah');
Route::get('/uploadlaporantdkberhibah', 'LaporanController@uploadlaporantdkberhibah');
/**************** OE LAPORAN ********************/


/**************** PENGUMUMAN ********************/
Route::get('/pengumuman', 'PengumumanController@index');
Route::get('/kelolapengumuman', 'PengumumanController@kelola');
/**************** EO PENGUMUMAN ********************/

/**************** NILAI PROPOSAL ******************/
Route::get('/nilaiproposalriset/{id}', 'NilaiProposalController@index');
Route::post('/daftarproposalhibahriset/nilaiproposalriset/menilairiset/{id}', 'NilaiProposalController@storeRiset');
Route::post('/daftarproposalhibahpengmas/nilaiproposalpengmas/menilaipengmas/{id}', 'NilaiProposalController@storePengmas');
/**************** NILAI PROPOSAL ******************/

/**************** SESUAIKAN PROPOSAL ******************/
Route::get('/sesuaikanproposal', 'SesuaikanProposalController@index');
Route::post('/daftarproposalhibahriset/sesuaikanproposalriset/sesuaikanriset/{id}', 'SesuaikanProposalController@storeRiset');
Route::post('/daftarproposalhibahpengmas/sesuaikanproposalpengmas/sesuaikanpengmas/{id}', 'SesuaikanProposalController@storePengmas');
/**************** SESUAIKAN PROPOSAL ******************/


/**************** BORANG PROPOSAL ******************/
Route::get('/borang', 'BorangController@index');
Route::post('/borang', 'BorangController@store');
Route::post('/hapusborang/{id}', 'BorangController@destroy');
Route::get('/editborang/{id}', 'BorangController@edit');
Route::post('/editborang/{id}', 'BorangController@update');
/**************** BORANG PROPOSAL ******************/