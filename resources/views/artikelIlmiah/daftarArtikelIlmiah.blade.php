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
  <title>ARTIKEL ILMIAH</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/artikelIlmiah.css') }}">

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
      <div id="kelola-artikel-ilmiah-konten">
        <div class="header"><h4>Artikel Ilmiah</h4></div>
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
                <th data-field="nama_hibah" style="width:25%">Judul</th>
                <th data-field="kategori_hibah">Penulis</th>
                <th data-field="besar_dana">Nama Jurnal</th>
                <th data-field="periode">Tahun Terbit</th>
                <th data-field="periode">Penerbit</th>
                <th data-field="periode">Link Artikel</th>
                <th data-field="" style="width:6%">Unduh</th>
              </tr>
            </thead>

            <tbody>  {{-- ISI DARI TIAP HIBAH --}}
              @foreach ($dataArtikelIlmiah as $artikelIlmiah) 
                <tr>
                  <td class="truncate">{{ $artikelIlmiah->judul }}</td>
                  <td>{{ $artikelIlmiah->penulis_utama }}</td>
                  <td>{{ $artikelIlmiah->nama_jurnal }}</td>
                  <td>{{ $artikelIlmiah->tahun }}</td>
                  <td>{{ $artikelIlmiah->penerbit }}</td>
                  <td><a href="{{ $artikelIlmiah->url }}">{{ $artikelIlmiah->url }}</a></td>
                  <td>
                    <a class="btn-floating" href="../../upload/artikelIlmiah/{{ $artikelIlmiah->bukti }}">
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
      {!! $dataArtikelIlmiah->render() !!}
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
