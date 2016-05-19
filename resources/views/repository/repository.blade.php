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
  <title>REPORSITORY</title>
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
      //CLEAR FLASH MESSAGE
      $("#clear").click(function(){
        $("#flash-msg").fadeOut(1000);
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

    {{-- SEARCH --}}
    <div class="container">
      <div id="repository">
        <div class="header"><h4>Repository</h4></div>
        <div id="flash-msg">
          @if(Session::has('flash_message'))
            <div class="card-panel teal darken-2">
              <span class="white-text">{{ Session::get('flash_message') }}</span>
              <a id="clear" class="collection-item" style="cursor:pointer">
              <i class="material-icons white right">clear</i></a>
            </div>
          @endif
        </div>
        <div class="repository-content">
          <div class="row">
            <div class="col s4 m4">
              <div class="card">
                <div class="card-image">
                  <img src="../images/buku.jpg">
                  <span class="card-title">BUKU</span>
                </div>
                <div class="card-action">
                  <a href="/repository/buku/daftar">Daftar</a>
                </div>
              </div>
            </div>
            <div class="col s4 m4">
              <div class="card">
                <div class="card-image">
                  <img src="../images/artikel_ilmiah.jpeg">
                  <span class="card-title">ARTIKEL ILMIAH</span>
                </div>
                <div class="card-action">
                  <a href="/repository/artikelIlmiah/daftar">Daftar</a>
                </div>
              </div>
            </div>
            <div class="col s4">
              <div class="card">
                <div class="card-image">
                  <img src="../images/artikel_populer.jpg">
                  <span class="card-title">ARTIKEL POPULER</span>
                </div>
                <div class="card-action">
                  <a href="/repository/artikelPopuler/daftar">Daftar</a>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col s4">
              <div class="card">
                <div class="card-image">
                  <img src="../images/penelitian.jpg">
                  <span class="card-title">PENELITIAN</span>
                </div>
                <div class="card-action">
                  <a href="/repository/penelitian/daftar">Daftar</a>
                </div>
              </div>
            </div>
            <div class="col s4">
              <div class="card">
                <div class="card-image">
                  <img src="../images/pengabdian_masyarakat.jpg">
                  <span class="card-title">PENGABDIAN MASYARAKAT</span>
                </div>
                <div class="card-action">
                  <a href="/repository/pengmas/daftar">Daftar</a>
                </div>
              </div>
            </div>
            <div class="col s4">
              <div class="card">
                <div class="card-image">
                  <img src="../images/kegiatan_ilmiah.jpg">
                  <span class="card-title">KEGIATAN ILMIAH</span>
                </div>
                <div class="card-action">
                  <a href="/repository/kegiatanIlmiah/daftar">Daftar</a>
                </div>
              </div>
            </div>
          </div>

          <div id="search-bar" class="row search-bar">
            <div class="col s12">
              <ul class="tabs">
                <li class="tab col s2"><a class="active" href="#publikasi">PUBLIKASI</a></li>
                <li class="tab col s2"><a href="#kegiatan">KEGIATAN</a></li>
              </ul>      
            </div>

            <div id="publikasi" class="publikasi"> {{-- SEARCH PUBLIKASI --}}
              <div class="col s12"> 
                <form method="post" action="/repository/searchPublikasi" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <div class="header center-align"><h5>Search Publikasi</h5></div>
                  <div class="row">
                    <div class="input-field col s6 offset-s3">
                      <input placeholder="Judul" id="judul" name="judul" type="text" value="">
                      <label>Judul Publikasi</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s6 offset-s3">
                      <input placeholder="Indrosuwandi" id="penulis" name="penulis" type="text" value="">
                      <label for="penulis">Penulis Utama</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s6 offset-s3">
                      <input placeholder="Andi" id="anggota" name="anggota" type="text" value="">
                      <label for="anggota">Anggota</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s6 offset-s3">
                      <input placeholder="PT. ABC" id="penerbit" name="penerbit" type="text" value="">
                      <label>Penerbit</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s6 offset-s3">
                      <input placeholder="20.." id="tahun" name="tahun" type="text" value="">
                      <label>Tahun Terbit</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12 center">
                      <button class="btn waves-effect waves-light" type="submit" name="action">
                        <span class="white-text">Search</span>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>            
            <div id="kegiatan" class="row"> {{-- SEARCH KEGIATAN --}}
              <div class="col s12">
                <form method="post" action="/repository/searchKegiatan" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <input type="hidden" name="kategori" value="kegiatan">
                  <div class="header center-align"><h5>Search Kegiatan</h5></div>
                  <div class="row">
                    <div class="input-field col s6 offset-s3">
                      <input placeholder="Judul" id="judul" name="judul" type="text">
                      <label>Judul Penelitian / Nama Kegiatan</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s6 offset-s3">
                      <input placeholder="Indrosuwandi" id="ketua" name="ketua" type="text">
                      <label for="penulis">Ketua Penelitian / Ketua Kegiatan (Penelitian/Pengabdian Masyarakat</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s6 offset-s3">
                      <input placeholder="Joko Widodo" id="pembicara" name="pembicara" type="text">
                      <label>Pembicara (Kegiatan Ilmiah)</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12 center">
                      <button class="btn waves-effect waves-light teal darken-2" type="submit" name="action">
                        <span class="white-text">Search</span>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
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