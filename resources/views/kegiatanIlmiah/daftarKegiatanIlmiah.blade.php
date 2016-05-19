@extends('master')
<?php 
  //CHECK USER'S ROLE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>KEGIATAN ILMIAH</title>
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

    {{-- CONTENT KELOLA KEGIATAN ILMIAH --}}
    <div class="container">
      <div id="kelola-kegiatan-ilmiah-konten">
        <div class="header"><h4>Kegiatan Ilmiah</h4></div>
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
                <th style="width:30%">Nama Kegiatan</th>
                <th>Jenis Kegiatan</th>
                <th>Pembicara</th>
                <th>Waktu</th>
                <th>Tempat</th>
              </tr>
            </thead>
            <tbody>  {{-- ISI DARI TIAP HIBAH --}}
              @foreach($kegiatanIlmiahs as $kegiatanilmiah)
                <tr>
                  <td>{{ $kegiatanilmiah->nama }}</td>
                  <td>{{ $kegiatanilmiah->jenis }}</td>
                  <td>{{ $kegiatanilmiah->pembicara }}</td>
                  <td>{{ $kegiatanilmiah->waktu }}</td>
                  <td>{{ $kegiatanilmiah->tempat }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>   
    <div align="center-align"> 
      {!! $kegiatanIlmiahs->render() !!}
    </div>
    {{-- END OF CONTENT KELOLA KEGIATAN ILMIAH --}} 
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
