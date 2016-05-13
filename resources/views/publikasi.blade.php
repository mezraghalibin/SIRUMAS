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
  <title>PUBLIKASI</title>
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

        $("#daftar-buku").hide();
        $("#daftar-artikel-ilmiah").hide();
        $("#daftar-artikel-populer").hide();


        $("#buku").click(function(){
            $("#daftar-buku").fadeIn(500);
            $("#daftar-artikel-ilmiah").hide();
            $("#daftar-artikel-populer").hide();
        });

         $("#artikel-ilmiah").click(function(){
            $("#daftar-artikel-ilmiah").fadeIn(500);
            $("#daftar-buku").hide();
            $("#daftar-artikel-populer").hide();
        });

        $("#artikel-populer").click(function(){
            $("#daftar-artikel-populer").fadeIn(500);
            $("#daftar-buku").hide();
            $("#daftar-artikel-ilmiah").hide();
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

    {{-- JENIS PUBLIKASI --}}
    <div class="container">
        <div class="header"><h4>Jenis Publikasi</h4></div>
          <div class="berhibah-content">
            <ul class="collection with-header">
              <li class="collection-header"><a href="buku"><h5>Buku</h5></a></li>
              <li class="collection-item"><a href="#">Artikel Ilmiah</a></li>
              <li class="collection-item"><a href="#">Artikel Populer</a></li>
            </ul>
          </div>
      </div>
    {{-- END OF JENIS PUBLIKASI --}}

    {{-- CONTENT DAFTAR BUKU --}}
       <div id="daftar-buku">
       <div class="container">
          <div class="header"><h4>Daftar Buku</h4></div>
          <div class="hibah-riset-content">
            <table class="highlight centered">
              <thead>
              <tr>
                <th>No.</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun Terbit</th>                           
                <th>Penerbit</th>
                <th>Gambar Sampul</th>
              </tr>
            </thead>
            <tbody>        
              <tr>
                <td>1.</td>
                <td>Buku Propensi</td>
                <td>Sri Mulyani</td>
                <td>2015</td>
                <td>Gramedia</td>
                <td></td>
              </tr>
            </tbody>
          </table>
          </div>
          </div>
          <!-- END OF TABEL DAFTAR PROPOSAL -->
          </div>
          {{-- CONTENT BUKU --}}


    {{-- CONTENT DAFTAR ARTIKEL ILMIAH --}}
       <div id="daftar-artikel-ilmiah">
       <div class="container">
          <div class="header"><h4>Daftar Artikel Ilmiah</h4></div>
          <div class="hibah-riset-content">
            <table class="highlight centered">
              <thead>
              <tr>
                <th>No.</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Nama Jurnal</th>                           
                <th>Tahun Terbit</th>
                <th>Unduh Abstrak</th>
              </tr>
            </thead>
            <tbody>        
              <tr>
                <td>1.</td>
                <td>Buku Propensi</td>
                <td>Sri Mulyani</td>
                <td>ACM Transaction on Web</td>
                <td>2015</td>
                <td><i class="material-icons">system_update_alt</i></td>
              </tr>
            </tbody>
          </table>
          </div>
          </div>
          <!-- END OF TABEL DAFTAR PROPOSAL -->
          </div>
          {{-- CONTENT ARTIKEL ILMIAH --}}


    {{-- CONTENT DAFTAR ARTIKEL POPULER --}}
       <div id="daftar-artikel-populer">
       <div class="container">
          <div class="header"><h4>Daftar Artikel Populer</h4></div>
          <div class="hibah-riset-content">
            <table class="highlight centered">
              <thead>
              <tr>
                <th>No.</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Nama Media</th>                           
                <th>Tahun/Hal</th>
                <th>Unduh</th>
              </tr>
            </thead>
            <tbody>        
              <tr>
                <td>1.</td>
                <td>Artikel Propensi</td>
                <td>Bambang Sutedja</td>
                <td>ACM</td>
                <td>2015/25</td>
                <td><i class="material-icons">system_update_alt</i></td>
              </tr>
            </tbody>
          </table>
          </div>
          </div>
          <!-- END OF TABEL DAFTAR PROPOSAL -->
          </div>
          {{-- CONTENT ARTIKEL POPULER --}}

  </div>
  @stop
</body>
</html>
