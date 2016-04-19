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

// Route::get('/', function () {
//     return view('welcome');
// });

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
Route::get('/hibah', 'HibahController@index');
Route::get('/applyhibah', 'HibahController@applyHibah');
Route::get('/kelolahibah', 'HibahController@kelolaHibah');
/**************** EO ROUTE HIBAH ******************/


/**************** PESAN & MOU ******************/
Route::get('/pesan', 'PesanController@index');
Route::post('/kirimpesan', 'PesanController@store');
Route::get('/mou', 'MouController@index');
/**************** EO PESAN & MOU ******************/


/**************** PROPOSAL ******************/
Route::get('/proposal', 'ProposalController@index');
Route::get('/proposalupload', 'ProposalController@uploadRevisi');
/**************** EO PROPOSAL ******************/


/**************** PROPOSAL HIBAH ******************/
Route::get('/proposalhibah', 'ProposalHibahController@index');
Route::get('/nilaiproposal', 'ProposalHibahController@nilaiProposal');
Route::get('/sesuaikanproposal', 'ProposalHibahController@sesuaikanProposal');
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
Route::get('/nilaiproposal', 'NilaiProposalController@index');
Route::post('/nilaiproposal', 'NilaiProposalController@store');


/**************** NILAI PROPOSAL ******************/

/**************** SESUAIKAN PROPOSAL ******************/
Route::get('/sesuaikanproposal', 'SesuaikanProposalController@index');
Route::post('/sesuaikanproposal', 'SesuaikanProposalController@store');
/**************** SESUAIKAN PROPOSAL ******************/


/**************** BORANG PROPOSAL ******************/
Route::get('/borang', 'BorangController@index');
Route::post('/borang', 'BorangController@store');
Route::post('/hapusborang/{id}', 'BorangController@destroy');
Route::get('/editborang/{id}', 'BorangController@edit');
Route::post('/editborang/{id}', 'BorangController@update');
/**************** BORANG PROPOSAL ******************/