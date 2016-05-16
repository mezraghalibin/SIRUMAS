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
      <div id="kelola-repository">
        <div class="header"><h4>Kelola Repository</h4></div>
        <div class="kelola-repository-content">
          <div id="search-bar" class="row search-bar">
            <div class="col s12">
              <ul class="tabs">
                <li class="tab col s2"><a class="active" href="#publikasi">PUBLIKASI</a></li>
                <li class="tab col s2"><a href="#kegiatan">KEGIATAN</a></li>
              </ul>      
            </div>

            <div id="publikasi" class="row"> {{-- CONTENT SEARCH BUKU  --}}
              <div class="col s6 publikasi">
                <ul class="collection with-header center-align">
                  <li class="collection-item"><a href="/kelolaRepository/buku/kelola">Buku</a></li>
                  <li class="collection-item"><a href="/kelolaRepository/artikelIlmiah/kelola">Artikel Ilmiah</a></li>
                  <li class="collection-item"><a href="/kelolaRepository/artikelPopuler/kelola">Artikel Populer</a></li>
                </ul>
              </div>
            </div>
            <div id="kegiatan" class="row"> {{-- CONTENT SEARCH ARTIKEL ILMIAH --}}
              <div class="offset-s6 col s6 kegiatan">
                <ul class="collection with-header center-align">
                  <li class="collection-item"><a href="/kelolaRepository/penelitian/kelola">Penelitian</a></li>
                  <li class="collection-item"><a href="/kelolaRepository/pengmas/kelola">Pengabdian Masyarakat</a></li>
                  <li class="collection-item"><a href="/kelolaRepository/kegiatanIlmiah/kelola">Kegiatan Ilmiah</a></li>
                </ul>
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
{{-- 
 transisi
 probingnya kurang
 masih kecepetan dodo --}}