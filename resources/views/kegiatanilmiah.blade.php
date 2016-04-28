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
  <title>PENELITIAN</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/publikasi.css">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
    <!--FOR MATERIALIZE DONT DELETE THIS-->

    <!--FOR BOOTSTRAP DONT DELETE THIS-->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Josefin+Slab:600' rel='stylesheet' type='text/css'>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!--FOR BOOTSTRAP DONT DELETE THIS-->

    <script>
    $(document).ready(function(){
      $role = "<?php echo $spesifik_role ?>";
       
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
          <li id="publikasi"><a href="#">Publikasi</a></li>
          <li id="penelitian"><a href="#">Penelitian</a></li>
          <li id="pengmas"><a href="#">Pengabdian Masyarakat</a></li>
          <li id="kegiatan-ilmiah"><a href="#">Kegiatan Ilmiah</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- CONTENT DAFTAR BUKU --}}
       <div id="daftar-penelitian">
       <div class="container">
          <div class="header"><h4>Daftar Kegiatan Ilmiah</h4></div>
          <div class="hibah-riset-content">
            <table class="highlight centered">
              <thead>
              <tr>
                <th>No.</th>
                <th>Nama Kegiatan</th>
                <th>Tema</th>
                <th>Pembicara</th>                           
                <th>Skala</th>
                <th>Waktu</th>
                <th>Tempat</th>
                <th>Dokumentasi Kegiatan</th>
              </tr>
            </thead>
            <tbody>        
              <tr>
                <td>1.</td>
                <td>Kegiatan FIA</td>
                <td>Riset Ilmu Administrasi</td>
                <td>Budi Santosa</td>
                <td>Regional</td>
                <td>Kamis, 21 April 2016</td>
                <td>UI</td>
                <td></td>
              </tr>
            </tbody>
          </table>
          </div>
          </div>
          <!-- END OF TABEL DAFTAR PROPOSAL -->
          </div>
          {{-- CONTENT BUKU --}}

  </div>
  @stop
</body>
</html>
