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

    {{-- JENIS PUBLIKASI --}}
    <div class="container">
        <div class="header"><h4>DAFTAR REPOSITORY</h4></div>
          <div class="berhibah-content">
            <ul class="collection with-header">
              <li class="collection-item"><a href="publikasi">Publikasi</a></li>
              <li class="collection-item"><a href="penelitian">Penelitian</a></li>
              <li class="collection-item"><a href="#">Pengabdian Masyarakat</a></li>
              <li class="collection-item"><a href="kelolakegiatanilmiah">Kegiatan Ilmiah</a></li>
            </ul>
          </div>
    </div>
    {{-- END OF JENIS PUBLIKASI --}}

  </div>
  @stop
</body>
</html>
