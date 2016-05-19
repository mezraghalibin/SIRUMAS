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
  <title>PENGABDIAN MASYARAKAT</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/buku.css') }}">

  {{-- FOR MATERIALIZE DONT DELETE THIS --}}
  <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  {{-- FOR MATERIALIZE DONT DELETE THIS --}}

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

    {{-- CONTENT KELOLA PENGMAS --}}
    <div class="container">
      <div id="kelola-pengmas-konten">
        <div class="header"><h4>Kelola Pengabdian Masyarakat</h4></div>
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
                <th data-field="nama_hibah" style="width:30%">Nama Kegiatan</th>
                <th data-field="kategori_hibah">Ketua Tim</th>
                <th data-field="besar_dana">Penyelenggara</th>
                <th data-field="periode">Peranan</th>
                <th data-field="periode">Waktu</th>
                <th data-field="periode">Tempat</th>
              </tr>
            </thead>
            @foreach($listofpengmas as $pengmas)
              <tbody>  {{-- ISI DARI TIAP HIBAH --}}
                <tr>
                  <td>{{ $pengmas->nama_kegiatan }}</td>
                  <td>{{ $pengmas->ketua }}</td>
                  <td>{{ $pengmas->penyelenggara }}</td>
                  <td>{{ $pengmas->peranan }}</td>
                  <td>{{ $pengmas->waktu }}</td>
                  <td>{{ $pengmas->tempat }}</td>
                </tr>
              </tbody>
            @endforeach
          </table>
        </div>
      </div>
    </div>     
    {{-- END OF CONTENT KELOLA PENGMAS --}} 
    <div align="center"> 
      {!! $listofpengmas->render() !!}
    </div>
  </div>
  {{-- END OF PAGE CONTENT --}}

  <script>
    $(document).ready(function() {
      $('.modal-trigger').leanModal();
    });
  </script>
  @stop
</body>
</html>
