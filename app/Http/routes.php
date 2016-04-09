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

Route::get('/pesan', 'PesanController@index');

Route::get('/mou', 'MouController@index');

Route::get('/proposalhibah', 'ProposalHibahController@index');

Route::get('/proposal', 'ProposalController@index');

Route::get('/proposalupload', 'ProposalController@uploadRevisi');

Route::get('/nilaiproposal', 'ProposalHibahController@nilaiProposal');

Route::get('/pengumuman', 'PengumumanController@index');
Route::get('/kelolapengumuman', 'PengumumanController@kelola');

Route::get('/sesuaikanproposal', 'ProposalHibahController@sesuaikanProposal');

