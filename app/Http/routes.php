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

/**************** ROUTE BERANDA ****************/
Route::get('/', 'BerandaController@index');
Route::get('/detailpengumuman', 'BerandaController@detailPengumuman');

/**************** ROUTE HIBAH ******************/
Route::get('/hibah', 'HibahController@index');
Route::get('/applyhibah', 'HibahController@applyHibah');
Route::get('/kelolahibah', 'HibahController@kelolaHibah');

/**************** PESAN & MOU ******************/
Route::get('/pesan', 'PesanController@index');
Route::get('/mou', 'MouController@index');

<<<<<<< HEAD
Route::get('/proposalhibah', 'ProposalHibahController@index');

=======
/**************** PROPOSAL ******************/
>>>>>>> c3935214254484df199d5e1e34c92f087456637e
Route::get('/proposal', 'ProposalController@index');
Route::get('/proposalupload', 'ProposalController@uploadRevisi');

/**************** PROPOSAL HIBAH ******************/
Route::get('/proposalhibah', 'ProposalHibahController@index');
Route::get('/nilaiproposal', 'ProposalHibahController@nilaiProposal');
<<<<<<< HEAD

Route::get('/pengumuman', 'PengumumanController@index');
Route::get('/kelolapengumuman', 'PengumumanController@kelola');

Route::get('/sesuaikanproposal', 'ProposalHibahController@sesuaikanProposal');

=======
Route::get('/sesuaikanproposal', 'ProposalHibahController@sesuaikanProposal');

/**************** BORANG ************************/
Route::get('/borang', 'BorangController@index');

/**************** LAPORAN ************************/
Route::get('/laporan', 'LaporanController@index');
Route::get('/laporankemajuan', 'LaporanController@laporankemajuan');
Route::get('/uploadkemajuan', 'LaporanController@uploadkemajuan');
Route::get('/uploadlaporanberhibah', 'LaporanController@uploadlaporanberhibah');
Route::get('/uploadlaporantdkberhibah', 'LaporanController@uploadlaporantdkberhibah');
>>>>>>> c3935214254484df199d5e1e34c92f087456637e
