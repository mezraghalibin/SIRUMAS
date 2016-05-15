
<?php 
  //CHECK USER'S ROLE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role'];
?>

@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>KELOLA REPORSITORY</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/repository.css') }}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
  <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> 
  <!--FOR MATERIALIZE DONT DELETE THIS-->

  <script>
    $(document).ready(function(){
      //$("#search-bar").hide(); //HIDE APPLY HIBAH PAGE

      $("#search").click(function(){
          $("#search-bar").fadeIn(800);
      });
    });
  </script>
</head>
<body>
  @section('main_content')
  {{-- PAGE CONTENT --}}
  <div class="page-content">
    {{-- SECOND NAVBAR --}}
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}


    {{-- NAVIGATION KELOLA REPOSITORY --}}
    <div class="container">
      <div class="header"><h4>KELOLA REPOSITORY</h4></div>
      <div class="row">
        <div class="col s6 publikasi">
          <ul class="collection with-header">
            <li class="collection-header"><h4>PUBLIKASI</h4></li>
            <li class="collection-item"><a href="#">Buku</a></li>
            <li class="collection-item"><a href="#">Artikel Ilmiah</a></li>
            <li class="collection-item"><a href="#">Artikel Populer</a></li>
          </ul>
        </div>

        <div class="col s6 kegiatan">
          <ul class="collection with-header">
            <li class="collection-header"><h4>KEGIATAN</h4></li>
            <li class="collection-item"><a href="#">Penelitian</a></li>
            <li class="collection-item"><a href="#">Pengabdian Masyarakat</a></li>
            <li class="collection-item"><a href="#">Kegiatan Ilmiah</a></li>
          </ul>
        </div>
      </div>
    </div>
    {{-- END OF NAVIGATION KELOLA REPOSITORY --}}

    {{-- BUTTON TO SHOW FORM OF APPLY HIBAH --}}
    <div class="container center-align">
      <button class="btn waves-effect waves-light card-panel red darken-2" id="search">
        <span class="white-text">Search Content</span>
      </button>
    </div>
    {{-- END OF BUTTON TO SHOW FORM OF APPLY HIBAH --}}

    {{-- SEARCH --}}
    <div id="search-bar" class="row search-bar">
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s2"><a class="active" href="#buku">Buku</a></li>
          <li class="tab col s2"><a href="#artikelIlmiah">Artikel Ilmiah</a></li>
          <li class="tab col s2"><a href="#artikelPopuler">Artikel Populer</a></li>
          <li class="tab col s2"><a href="#penelitian">Penelitian</a></li>
          <li class="tab col s2"><a href="#pengabdianMasyarakat">Pengabdian Masyarkat</a></li>
          <li class="tab col s2"><a href="#kegiatanIlmiah">Kegiatan Ilmiah</a></li>
        </ul>      
      </div>

      <div id="buku" class="col s12"> {{-- CONTENT SEARCH BUKU  --}}
        <div class="row">
          <form method="post" action="/kelolaRepository/searchBuku" class="col s12" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            {{-- FIRST ROW = PENULIS PENERBIT --}}
            <div class="row">
              <div class="input-field offset-s3 col s3">
                <input placeholder="Joko Susilo" name="penulis" type="text" class="validate">            
                <label for="penulis">Penulis</label>
              </div>
              <div class="input-field col s3">
                <input placeholder="Gramedia" name="penerbit" type="text" class="validate">            
                <label for="penerbit">Penerbit</label>
              </div>
            </div>

            {{-- SECOND ROW = ISBN TAHUN KOTA TERBIT --}}
            <div class="row">
              <div class="input-field offset-s3 col s2">
                <input placeholder="123XXXXXXXXX" name="isbn" type="text" class="validate">            
                <label for="penerbit">ISBN</label>
              </div>
              <div class="input-field col s2">
                <input placeholder="2016" name="tahun" type="text" class="validate">            
                <label for="penerbit">Tahun Terbit</label>
              </div>
              <div class="input-field col s2">
                <input placeholder="Jakarta" name="kota_terbit" type="text" class="validate">            
                <label for="penerbit">Kota Terbit</label>
              </div>
            </div>

            {{-- BUTTON SUMBIT --}}
            <div class="center-align">
              <button class="btn card-panel red darken-2" type="submit" name="action">
                <span class="white-text">Search</span>
                <i class="material-icons right">search</i>
              </button>
            </div>
          </form>
        </div>
      </div>
      <div id="artikelIlmiah" class="col s12"> {{-- CONTENT SEARCH ARTIKEL ILMIAH --}}
        <div class="row">
          <form method="post" action="/kelolaRepository/searchArtikelIlmiah" class="col s12" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            {{-- FIRST ROW = JUDUL PENULIS LEVEL --}}
            <div class="row">
              <div class="input-field offset-s1 col s4">
                <input placeholder="Judul Artikel" name="judul" type="text" class="validate">            
                <label for="penulis">Judul</label>
              </div>
              <div class="input-field col s3">
                <input placeholder="Nama Jurnal" name="nama_jurnal" type="text" class="validate">            
                <label for="penerbit">Nama Jurnal</label>
              </div>
              <div class="input-field col s3">
                <select name="level" required>
                  <option value="all">Level Ilmiah</option>
                  <option value="nasionalTidakTerakreditasi">Nasional Tidak Terakreditasi</option>
                  <option value="nasionalTerakreditasi">Nasional Terakreditasi</option>
                  <option value="internasional">Internasional</option>
                </select>
              </div>
            </div>

            {{-- SECOND ROW = ISBN TAHUN KOTA TERBIT --}}
            <div class="row">
              <div class="input-field offset-s1 col s4">
                <input placeholder="Penulis" name="penulis_utama" type="text" class="validate">            
                <label for="penerbit">Penulis Utama</label>
              </div>
              <div class="input-field col s6">
                <input placeholder="Andi;Budi;Caca" name="nama_anggota" type="text" class="validate">            
                <label for="penerbit">Penulis Anggota</label>
              </div>
            </div>

            {{-- THIRD ROW = ISBN TAHUN KOTA TERBIT --}}
            <div class="row">
              <div class="input-field offset-s1 col s2">
                <input placeholder="No. Artikel" name="no" type="text" class="validate">            
                <label for="penerbit">No. Artikel</label>
              </div>
              <div class="input-field col s2">
                <input placeholder="Volume" name="volume" type="text" class="validate">            
                <label for="penerbit">Volume</label>
              </div>
              <div class="input-field col s2">
                <input placeholder="123XXXXXXXXX" name="issn" type="text" class="validate">            
                <label for="penerbit">ISSN</label>
              </div>
              <div class="input-field col s2">
                <input placeholder="2016" name="tahun" type="text" class="validate">            
                <label for="penerbit">Tahun Terbit</label>
              </div>
              <div class="input-field col s2">
                <input placeholder="Gramedia" name="penerbit" type="text" class="validate">            
                <label for="penerbit">Penerbit</label>
              </div>
            </div>

            {{-- BUTTON SUMBIT --}}
            <div class="center-align">
              <button class="btn card-panel red darken-2" type="submit" name="action">
                <span class="white-text">Search</span>
                <i class="material-icons right">search</i>
              </button>
            </div>
          </form>
        </div>
      </div>
      <div id="artikelPopuler" class="col s12"> {{-- CONTENT SEARCH ARTIKEL POPULER --}}
        <div class="row">
          <form method="post" action="/hibah/buatHibah" class="col s12" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            {{-- FIRST ROW = PENULIS PENERBIT --}}
            <div class="row">
              <div class="input-field offset-s3 col s3">
                <input placeholder="Joko Susilo" name="penulis" type="text" class="validate">            
                <label for="penulis">Penulis</label>
              </div>
              <div class="input-field col s3">
                <input placeholder="Gramedia" name="penerbit" type="text" class="validate">            
                <label for="penerbit">Penerbit</label>
              </div>
            </div>

            {{-- SECOND ROW = ISBN TAHUN KOTA TERBIT --}}
            <div class="row">
              <div class="input-field offset-s3 col s2">
                <input placeholder="123XXXXXXXXX" name="isbn" type="text" class="validate">            
                <label for="penerbit">ISBN</label>
              </div>
              <div class="input-field col s2">
                <input placeholder="2016" name="tahun" type="text" class="validate">            
                <label for="penerbit">Tahun Terbit</label>
              </div>
              <div class="input-field col s2">
                <input placeholder="Jakarta" name="kota_terbit" type="text" class="validate">            
                <label for="penerbit">Kota Terbit</label>
              </div>
            </div>

            {{-- BUTTON SUMBIT --}}
            <div class="center-align">
              <button class="btn card-panel red darken-2" type="submit" name="action">
                <span class="white-text">Search</span>
                <i class="material-icons right">search</i>
              </button>
            </div>
          </form>
        </div>
      </div>
      <div id="penelitian" class="col s12"> {{-- CONTENT SEARCH PENELITIAN --}}
        <div class="row">
          <form method="post" action="/hibah/buatHibah" class="col s12" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            {{-- FIRST ROW = PENULIS PENERBIT --}}
            <div class="row">
              <div class="input-field offset-s3 col s3">
                <input placeholder="Joko Susilo" name="penulis" type="text" class="validate">            
                <label for="penulis">Penulis</label>
              </div>
              <div class="input-field col s3">
                <input placeholder="Gramedia" name="penerbit" type="text" class="validate">            
                <label for="penerbit">Penerbit</label>
              </div>
            </div>

            {{-- SECOND ROW = ISBN TAHUN KOTA TERBIT --}}
            <div class="row">
              <div class="input-field offset-s3 col s2">
                <input placeholder="123XXXXXXXXX" name="isbn" type="text" class="validate">            
                <label for="penerbit">ISBN</label>
              </div>
              <div class="input-field col s2">
                <input placeholder="2016" name="tahun" type="text" class="validate">            
                <label for="penerbit">Tahun Terbit</label>
              </div>
              <div class="input-field col s2">
                <input placeholder="Jakarta" name="kota_terbit" type="text" class="validate">            
                <label for="penerbit">Kota Terbit</label>
              </div>
            </div>

            {{-- BUTTON SUMBIT --}}
            <div class="center-align">
              <button class="btn card-panel red darken-2" type="submit" name="action">
                <span class="white-text">Search</span>
                <i class="material-icons right">search</i>
              </button>
            </div>
          </form>
        </div>
      </div>
      <div id="pengabdianMasyarakat" class="col s12"> {{-- CONTENT SEARCH PENGABDIAN MASYARKAT --}}
        <div class="row">
          <form method="post" action="/hibah/buatHibah" class="col s12" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            {{-- FIRST ROW = PENULIS PENERBIT --}}
            <div class="row">
              <div class="input-field offset-s3 col s3">
                <input placeholder="Joko Susilo" name="penulis" type="text" class="validate">            
                <label for="penulis">Penulis</label>
              </div>
              <div class="input-field col s3">
                <input placeholder="Gramedia" name="penerbit" type="text" class="validate">            
                <label for="penerbit">Penerbit</label>
              </div>
            </div>

            {{-- SECOND ROW = ISBN TAHUN KOTA TERBIT --}}
            <div class="row">
              <div class="input-field offset-s3 col s2">
                <input placeholder="123XXXXXXXXX" name="isbn" type="text" class="validate">            
                <label for="penerbit">ISBN</label>
              </div>
              <div class="input-field col s2">
                <input placeholder="2016" name="tahun" type="text" class="validate">            
                <label for="penerbit">Tahun Terbit</label>
              </div>
              <div class="input-field col s2">
                <input placeholder="Jakarta" name="kota_terbit" type="text" class="validate">            
                <label for="penerbit">Kota Terbit</label>
              </div>
            </div>

            {{-- BUTTON SUMBIT --}}
            <div class="center-align">
              <button class="btn card-panel red darken-2" type="submit" name="action">
                <span class="white-text">Search</span>
                <i class="material-icons right">search</i>
              </button>
            </div>
          </form>
        </div>
      </div>
      <div id="kegiatanIlmiah" class="col s12"> {{-- CONTENT SEARCH KEGIATAN ILMIAH --}}
        <div class="row">
          <form method="post" action="/hibah/buatHibah" class="col s12" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            {{-- FIRST ROW = PENULIS PENERBIT --}}
            <div class="row">
              <div class="input-field offset-s3 col s3">
                <input placeholder="Joko Susilo" name="penulis" type="text" class="validate">            
                <label for="penulis">Penulis</label>
              </div>
              <div class="input-field col s3">
                <input placeholder="Gramedia" name="penerbit" type="text" class="validate">            
                <label for="penerbit">Penerbit</label>
              </div>
            </div>

            {{-- SECOND ROW = ISBN TAHUN KOTA TERBIT --}}
            <div class="row">
              <div class="input-field offset-s3 col s2">
                <input placeholder="123XXXXXXXXX" name="isbn" type="text" class="validate">            
                <label for="penerbit">ISBN</label>
              </div>
              <div class="input-field col s2">
                <input placeholder="2016" name="tahun" type="text" class="validate">            
                <label for="penerbit">Tahun Terbit</label>
              </div>
              <div class="input-field col s2">
                <input placeholder="Jakarta" name="kota_terbit" type="text" class="validate">            
                <label for="penerbit">Kota Terbit</label>
              </div>
            </div>

            {{-- BUTTON SUMBIT --}}
            <div class="center-align">
              <button class="btn card-panel red darken-2" type="submit" name="action">
                <span class="white-text">Search</span>
                <i class="material-icons right">search</i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- END OF SEARCH --}}
    
  </div>
  {{-- END OF PAGE CONTENT --}}
  <script>
    $('ul.tabs').tabs();
    $('ul.tabs').tabs('select_tab', 'tab_id');
    $('select').material_select();  //FOR FORM SELECT
  </script>
  @stop
</body>
</html>

{{-- 
Buku
Judul
Penulis
Tahun Terbit
Penerbit

artikl ilmiah
Judul
Penulis
Tahun Terbit
Penerbit

Artikel Populer
Judul
Penulis
Tahun Terbit
Penerbit

Artikel Konferensi
Judul
Penulis

KEGIATAN
Judul/Nama Kegiatan

 --}}

 transisi
 probingnya kurang
 masih kecepetan dodo