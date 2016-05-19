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
  <title>ARTIKEL POPULER</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/artikelPopuler.css') }}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
  <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
        <ul class="left hide-on-med-and-down">
          <li id="kelola-artikel-ilmiah"><a href="/repository">Kembali</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- CONTENT KELOLA BUKU --}}
    <div class="container">
      <div id="kelola-artikel-populer-konten">
        <div class="header"><h4>Artikel Populer</h4></div>
        <div id="flash-msg">
          @if(Session::has('flash_message'))
            <div class="card-panel teal darken-2">
              <span class="white-text">{{ Session::get('flash_message') }}</span>
              <a id="clear" class="collection-item" style="cursor:pointer">
              <i class="material-icons white right">clear</i></a>
            </div>
          @endif
        </div>
        <div class="kelola-content">
          <table class="highlight centered">
            <thead> {{-- NAMA JUDUL DARI KELOLA HIBAH --}}
              <tr>
                <th data-field="judul" style="width:25%">Judul</th>
                <th data-field="penulis">Penulis</th>
                <th data-field="dimuat_pada">Nama Media</th>
                <th data-field="tahun">Tahun/Hal</th>
                <th data-field="url">Link URL</th>
                <th data-field="" style="width:6%">Unduh</th>
              </tr>
            </thead>

            <tbody>  {{-- ISI DARI TIAP HIBAH --}}
              @foreach ($dataArtikelPopuler as $artikelPopuler) 
                <tr>
                  <td>{{ $artikelPopuler->judul }}</td>
                  <td>{{ $artikelPopuler->penulis_utama }}</td>
                  <td>{{ $artikelPopuler->dimuat_di }}</td>
                  <td>{{ $artikelPopuler->tahun . "/" . $artikelPopuler->halaman }}</td>
                  <td><a href="{{ $artikelPopuler->url }}">{{ $artikelPopuler->url }}</a></td>
                  <td>
                    <a class="btn-floating" href="../../upload/artikelPopuler/{{ $artikelPopuler->bukti }}">
                    <i class="material-icons right">file_download</i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div align="center-align"> 
      {!! $dataArtikelPopuler->render() !!}
    </div>
    {{-- END OF CONTENT KELOLA BUKU --}}
  </div>
  {{-- END OF PAGE CONTENT --}}

  <script>
    $(document).ready(function(){
      $('.materialboxed').materialbox();
      $('select').material_select();  //FOR FORM SELECT
      $('.modal-trigger').leanModal(); //FOR MODAL
    });
  </script>
  @stop
</body>
</html>
