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
  <title>KELOLA ARTIKEL POPULER</title>
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
          <li id="kelola-artikel-populer"><a href="/kelolaRepository/artikelPopuler/kelola">Kelola Artikel Populer</a></li>
          <li id="buat-artikel-populer"><a href="/kelolaRepository/artikelPopuler/buat">Buat Artikel Populer</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- FLASH MESSAGE AFTER UPLOAD MOU --}}
    <div id="flash-msg">
      @if(Session::has('flash_message'))
        <div class="card-panel teal">
          <span class="white-text">
            {{ Session::get('flash_message') }}<a id="clear" class="btn-flat transparent right">
            <i class="material-icons">clear</i></a>
          </span>
        </div>
      @endif 
    </div>
    {{-- END OF FLASH MESSAGE AFTER UPLOAD MOU --}}

    {{-- CONTENT KELOLA BUKU --}}
    <div class="container">
      <div id="kelola-artikel-populer-konten">
        <div class="header"><h4>Kelola Artikel Populer</h4></div>
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
                <th data-field="" style="width:5%">Edit</th>
                <th data-field="" style="width:6%">Delete</th>
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
                  <td> {{-- BUTTON ICON UNTUK EDIT HIBAH --}}
                    <a class="btn-floating" href="/kelolaRepository/artikelPopuler/edit/{{ $artikelPopuler->id }}">
                    <i class="material-icons right">mode_edit</i></a>
                  </td>
                  <td> {{-- BUTTON ICON UNTUK HAPUS HIBAH --}}
                    <!-- Modal Trigger -->
                    <button data-target="artikelPopuler{{ $artikelPopuler->id }}" class="btn-floating btn modal-trigger">
                      <i class="material-icons right">delete</i>
                    </button>
                    <!-- Modal Structure -->
                    <div id="artikelPopuler{{ $artikelPopuler->id }}" class="modal">
                      <div class="modal-content">
                        <h4>Hapus?</h4>
                        <p>Artikel Ilmiah akan dihapus secara permanen</p>
                      </div>
                      <div class="modal-footer center-align">
                        <a href="/kelolaRepository/artikelPopuler/delete/{{ $artikelPopuler->id }}" 
                          class="modal-action modal-close btn-flat">Ya</a>
                        <a href="#!" class=" modal-action modal-close btn-flat">Tidak</a>
                      </div>
                    </div>
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
