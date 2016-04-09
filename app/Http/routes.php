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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/master', function () {
    return view('master');
});

Route::get('/hibah', 'HibahController@index');

Route::get('/proposalhibah', 'ProposalHibahController@index');

Route::get('/proposal', 'ProposalController@index');

Route::get('/proposalupload', 'ProposalController@uploadRevisi');

Route::get('/nilaiproposal', 'ProposalHibahController@nilaiProposal');

Route::get('/sesuaikanproposal', 'ProposalHibahController@sesuaikanProposal');
