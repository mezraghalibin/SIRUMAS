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

Route::get('/test', function () {
    return view('test');
});

//Route::resource('nilaiproposal', 'NilaiProposalController');

/**************** ROUTE LOGIN/LOGOUT ****************/
Route::get('/login', 'SSOController@index');
Route::get('/logout', 'SSOController@logout');
/**************** EO ROUTE LOGIN/LOGOUT ****************/


/**************** ROUTE BERANDA ****************/
Route::get('/', 'BerandaController@index');
Route::get('/detailpengumuman/{id}', 'BerandaController@show');
/**************** EO ROUTE BERANDA ****************/


/**************** ROUTE HIBAH ******************/
Route::get('/hibah', 'HibahController@index'); //FIRST TIME TO HIBAH PAGE
Route::get('/hibah/buathibah', 'HibahController@hibah'); //FIRST TIME TO BUAT HIBAH PAGE
Route::get('/hibah/kelolahibah', 'HibahController@hibah'); //FIRST TIME TO KELOLAHIBAH PAGE
//APPLY
Route::get('/hibah/applyhibah/{id}', 'HibahController@applyhibah'); //GO TO SPECIFIC HIBAH PAGE
//CREATE
Route::post('/hibah/createhibah', 'HibahController@create'); //ROUTES TO CREATE HIBAH
//KELOLA
Route::get('/hibah/kelolahibah/detail/{id}', 'HibahController@kelolaHibah'); //GOT TO SPECIFIC HIBAH PAGE FOR EDIT
Route::post('/hibah/kelolahibah/detail/updatehibah/{id}', 'HibahController@update'); //ROUTES TO UPDATE HIBAH
//DELETE
Route::get('/hibah/deletehibah/{id}', 'HibahController@delete'); //GO TO SPECIFIC HIBAH PAGE
//PUBLISH
Route::get('/publishhibah/{id}', 'HibahController@publikasi');
//NON AKTIF
Route::get('hibah/nonaktifhibah/{id}', 'HibahController@nonAktif');
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
Route::get('/kelolapengumumansingle/{id}', 'PengumumanController@edit');
Route::get('/hapuspengumuman/{id}', 'PengumumanController@delete');
Route::post('/kelolapengumumansingle/{id}', 'PengumumanController@update');
Route::post('/buatpengumuman', 'PengumumanController@create');
Route::get('/publishpengumuman/{id}', 'PengumumanController@publikasi');
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
/**************** EO SESUAIKAN PROPOSAL ******************/


/**************** BORANG PROPOSAL ******************/
Route::get('/borang', 'BorangController@index');
Route::post('/borang', 'BorangController@store');
Route::post('/hapusborang/{id}', 'BorangController@destroy');
Route::get('/editborang/{id}', 'BorangController@edit');
Route::post('/editborang/{id}', 'BorangController@update');
/**************** EO BORANG PROPOSAL ******************/

/**************** REPOSITORY ******************/
Route::get('/publikasi', 'PublikasiController@index');
Route::get('/kelolapublikasi', 'PublikasiController@kelola');
/**************** REPOSITORY ******************/

/**************** PENELITIAN ******************/
Route::get('/penelitian', 'PenelitianController@index');
Route::get('/kelolapenelitian', 'PenelitianController@kelola');
Route::get('/editpenelitian', 'PenelitianController@edit');
/**************** PENELITIAN ******************/

/**************** PENGMAS ******************/
Route::get('/pengmas', 'PengmasController@index');
Route::get('/kelolapengmas', 'PengmasController@kelola');
Route::get('/editpengmas', 'PengmasController@edit');
/**************** PENGMAS ******************/

/**************** BUKU ******************/
Route::get('/buku', 'BukuController@index');
Route::get('/kelolabuku', 'BukuController@kelola');
Route::get('/editbuku', 'BukuController@edit');
/**************** BUKU ******************/

/**************** ARTIKEL ILMIAH ******************/
Route::get('/artikelilmiah', 'ArtikelIlmiahController@index');
Route::get('/kelolaartikelilmiah', 'ArtikelIlmiahController@kelola');
Route::get('/editartikelilmiah', 'ArtikelIlmiahController@edit');
/**************** ARTIKEL ILMIAH ******************/

/**************** ARTIKEL POPULER ******************/
Route::get('/artikelpopuler', 'ArtikelPopulerController@index');
Route::get('/kelolaartikelpopuler', 'ArtikelPopulerController@kelola');
Route::get('/editartikelpopuler', 'ArtikelPopulerController@edit');
/**************** ARTIKEL POPULER ******************/

/**************** KEGIATAN ILMIAH ******************/
Route::get('/kegiatanilmiah', 'KegiatanIlmiahController@index');
Route::get('/kelolakegiatanilmiah', 'KegiatanIlmiahController@kelola');
Route::get('/editkegiatanilmiah/{id}', 'KegiatanIlmiahController@edit');
Route::get('/buatkegiatanilmiah', 'KegiatanIlmiahController@buat');
Route::post('/buatkegiatanilmiah', 'KegiatanIlmiahController@store');
Route::get('/hapuskegilmiah/{id}', 'KegiatanIlmiahController@destroy');
Route::post('/editkegiatanilmiah/{id}', 'KegiatanIlmiahController@update');
/**************** KEGIATAN ILMIAH ******************/

/**************** KONTAK ******************/
Route::get('/kontak/buatkontak', 'KontakController@index'); //FIRST TIME TO BUAT KONTAK PAGE
Route::get('/kontak/kelolakontak', 'KontakController@index'); //FIRST TIME TO KELOLA KONTAK PAGE
//Create New Kontak
Route::post('/kontak/create', 'KontakController@create'); //CREATE NEW CONTACT IN DATABASE
//Delete Kontak
Route::get('/kontak/delete/{id}', 'KontakController@delete'); //CREATE NEW CONTACT IN DATABASE
//Edit Kontak
Route::get('/kontak/editkontak/{id}', 'KontakController@edit'); //CREATE NEW CONTACT IN DATABASE
Route::post('/kontak/update/{id}', 'KontakController@update'); //CREATE NEW CONTACT IN DATABASE
/**************** KONTAK ******************/

/**************** PRESENTASI ******************/
Route::get('/presentasi', 'PresentasiController@index');
Route::get('/editpresentasi', 'PresentasiController@edit');
/**************** PRESENTASI ******************/