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
//READ
Route::get('/hibah/daftarHibah', 'HibahController@indexDosen'); //FIRST TIME TO BUAT HIBAH PAGE
Route::get('/hibah/buatHibah', 'HibahController@index'); //FIRST TIME TO BUAT HIBAH PAGE
Route::get('/hibah/kelolaHibah', 'HibahController@index'); //FIRST TIME TO KELOLAHIBAH PAGE
//APPLY
Route::get('/hibah/applyHibah/{id}', 'HibahController@applyhibah'); //GO TO SPECIFIC HIBAH PAGE
//CREATE
Route::post('/hibah/buatHibah', 'HibahController@create'); //ROUTES TO CREATE HIBAH
//UPDATE
Route::get('/hibah/editHibah/{id}', 'HibahController@edit'); //GOT TO SPECIFIC HIBAH PAGE FOR EDIT
Route::post('/hibah/updateHibah/{id}', 'HibahController@update'); //ROUTES TO UPDATE HIBAH
//DELETE
Route::get('/hibah/deleteHibah/{id}', 'HibahController@delete'); //GO TO SPECIFIC HIBAH PAGE
//PUBLISH
Route::get('/hibah/publishHibah/{id}', 'HibahController@publikasi');
//NON AKTIF
Route::get('/hibah/nonAktifHibah/{id}', 'HibahController@nonAktif');
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
//READ
Route::get('/proposal/daftarProposal', 'ProposalController@index'); //TO PAGE DAFTAR PROPOSAL
Route::get('/proposal/uploadRevisiProposal', 'ProposalController@index'); //TO PAGE DAFTAR PROPOSAL
//APPLY HIBAH
Route::post('/proposal/applyHibah', 'ProposalController@create'); //Create Hibah
//REVISI PROPOSAL
Route::get('/proposal/revisiProposal/{id}', 'ProposalController@revisiProposal'); //TO REVISI PAGE
Route::post('/proposal/revisi/{id}', 'ProposalController@revisi'); //TO REVISI PAGE
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
//READ BY DOSEN
Route::get('/laporan/laporanKemajuan', 'LaporanController@index'); // dosen
Route::get('/laporan/laporanAkhir', 'LaporanController@index'); // dosen
//UPLOAD KEMAJUAN BY DOSEN
Route::get('/laporan/uploadKemajuan/{id}', 'LaporanController@uploadKemajuan');
Route::post('/laporan/uploadKemajuan/upload/{id}', 'LaporanController@uploadLaporanKemajuanStore');
//UPLOAD AKHIR BY DOSEN
Route::get('/laporan/uploadLaporanAkhir/{id}', 'LaporanController@uploadLaporanAkhir');
Route::post('/laporan/uploadLaporanAkhir/upload/{id}', 'LaporanController@uploadLaporanAkhirStore');
//READ BY RISET
Route::get('/laporan/readLaporanKemajuan', 'LaporanController@laporankemajuan'); //staf riset
Route::get('/laporan/readLaporanAkhir', 'LaporanController@laporanakhir'); //staf riset
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
Route::get('/kelolapenelitian', 'PenelitianController@index');
//CREATE
Route::get('/buatpenelitian', 'PenelitianController@index');
Route::post('/tomakepenelitian', 'PenelitianController@store');
//UPDATE
Route::get('/editpenelitian/{id}', 'PenelitianController@edit');
Route::post('/updatepenelitian/{id}', 'PenelitianController@update');
//DELETE
Route::get('/deletepenelitian/{id}', 'PenelitianController@delete');
/**************** PENELITIAN ******************/

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

/**************** KONTAK ******************/
Route::get('/kontak/buatKontak', 'KontakController@index'); //FIRST TIME TO BUAT KONTAK PAGE
Route::get('/kontak/kelolaKontak', 'KontakController@index'); //FIRST TIME TO KELOLA KONTAK PAGE
//Create New Kontak
Route::post('/kontak/create', 'KontakController@create'); //CREATE NEW CONTACT IN DATABASE
//Delete Kontak
Route::get('/kontak/delete/{id}', 'KontakController@delete'); //DELETE CONTACT IN DATABASE
//Edit Kontak
Route::get('/kontak/editKontak/{id}', 'KontakController@edit'); //GO TO EDIT CONTACT PAGE
Route::post('/kontak/update/{id}', 'KontakController@update'); //UPDATE CONTACT
//Search Kontak
Route::post('/kontak/search', 'KontakController@search'); //UPDATE CONTACT
/**************** KONTAK ******************/

/**************** PRESENTASI ******************/
Route::get('/presentasi', 'PresentasiController@index'); //FIRST TIME TO PRESENTASI PAGE
Route::get('/kelolapresentasi', 'PresentasiController@index'); //FIRST TIME TO KELOLAPRESENTASI PAGE
Route::get('/buatpresentasi', 'PresentasiController@index'); //FIRST TIME TO BUAT JADWALPRESENTASI PAGE
Route::post('/knpsi', 'PresentasiController@store'); // CREATE 
Route::get('/jadwalpresentasi/delete/{id}', 'PresentasiController@delete'); //DELETE
Route::get('/editpresentasi/{id}', 'PresentasiController@edit');
Route::post('/updatepresentasi/{id}', 'PresentasiController@update');
/**************** PRESENTASI ******************/

/**************** DEPAN REPO ******************/
Route::get('/repository', 'RepositoryController@index');
/**************** DEPAN REPO  ******************/

/**************** KELOLA REPOSITORY ******************/
Route::get('/kelolaRepository', 'RepositoryController@indexKelolaRepository');

/** ------------------  BUKU ------------------------- **/
//--------------- DIVISI RISET ---------------//
//READ 
Route::get('/kelolaRepository/buku/kelola', 'BukuController@index');
Route::get('/kelolaRepository/buku/buat', 'BukuController@index');
//CREATE
Route::post('/kelolaRepository/buku/buat', 'BukuController@store');
//UPDATE
Route::get('/kelolaRepository/buku/edit/{id}', 'BukuController@edit');
Route::post('/kelolaRepository/buku/update/{id}', 'BukuController@update');
//DELETE
Route::get('/kelolaRepository/buku/delete/{id}', 'BukuController@delete');

/** ------------------  PENELITIAN ------------------------- **/
//--------------- DIVISI RISET ---------------//
//READ 
Route::get('/kelolaRepository/penelitian/kelola', 'PenelitianController@index');
Route::get('/kelolaRepository/penelitian/buat', 'PenelitianController@index');
//CREATE
Route::post('/kelolaRepository/penelitian/buat', 'PenelitianController@store');
//UPDATE
Route::get('/kelolaRepository/penelitian/edit/{id}', 'PenelitianController@edit');
Route::post('/kelolaRepository/penelitian/update/{id}', 'PenelitianController@update');
//DELETE
Route::get('/kelolaRepository/penelitian/delete/{id}', 'PenelitianController@delete');

/** ------------------  KEGIATAN ILMIAH ------------------------- **/
//--------------- DIVISI RISET ---------------//
//READ
Route::get('/kelolaRepository/kegiatanIlmiah/kelola', 'KegiatanIlmiahController@index');
Route::get('/kelolaRepository/kegiatanIlmiah/buat', 'KegiatanIlmiahController@index');
//CREATE
Route::post('/kelolaRepository/kegiatanIlmiah/buat', 'KegiatanIlmiahController@store');
//EDIT
Route::get('kelolaRepository/kegiatanIlmiah/edit/{id}', 'KegiatanIlmiahController@edit');
Route::post('kelolaRepository/kegiatanIlmiah/update/{id}', 'KegiatanIlmiahController@update');
//DELETE
Route::get('kelolaRepository/kegiatanIlmiah/delete/{id}', 'KegiatanIlmiahController@destroy');

/** ------------------  PENGMAS ------------------------- **/
//--------------- DIVISI RISET ---------------//
//READ
Route::get('/kelolaRepository/pengmas/kelola', 'PengmasController@index');
Route::get('/kelolaRepository/pengmas/buat', 'PengmasController@index');
//CREATE
Route::post('/kelolaRepository/pengmas/buat', 'PengmasController@store');
//EDIT
Route::get('kelolaRepository/pengmas/edit/{id}', 'PengmasController@edit');
Route::post('kelolaRepository/pengmas/update/{id}', 'PengmasController@update');
//DELETE
Route::get('kelolaRepository/pengmas/delete/{id}', 'PengmasController@destroy');


/**************** EO KELOLA REPOSITORY ******************/


/**************** PENGMAS ******************/
Route::get('/pengmas', 'PengmasController@index');
Route::get('/kelolapengmas', 'PengmasController@kelola');
Route::get('/editpengmas/{id}', 'PengmasController@edit');
Route::post('/editpengmas/{id}', 'PengmasController@update');
Route::get('/buatpengmas', 'PengmasController@buat');
Route::post('/buatpengmas', 'PengmasController@store');
Route::get('/hapuspengmas/{id}', 'PengmasController@destroy');
/**************** PENGMAS ******************/