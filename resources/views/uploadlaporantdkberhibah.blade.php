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
  <title>UPLOAD LAPORAN AKHIR</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/hibah.css">
    <link rel="stylesheet" href="assets/css/borang.css">

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

</head>
<body>
  @section('main_content')
  <div class="page-content">
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
         <li><a href="{{action('LaporanController@index')}}">Kembali</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>

    <!-- CONTENT BUAT BORANG -->
    <div class="container">
      <div id="kelola-hibah">
        <div class="header"><h4>Upload Laporan Akhir</h4></div>
          <div class="kelola-content">
 <select class="browser-default" style="width:300px">
                        <option disabled selected>Kategori</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                        <option>E</option>
                      </select>
                      <div class="row"></div>
          <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Masukkan nama" id="first_name" type="text" class="validate">
          <label for="first_name">Nama</label>
        </div>
        <div class="input-field col s6">
          <input placeholder="Masukkan NIP/NUP" id="first_name" type="text" class="validate">
          <label for="first_name">NIP/NUP</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="jonedoe@example.com" id="first_name" type="text" class="validate">
          <label for="first_name">Email</label>
        </div>
        <div class="input-field col s6">
          <input placeholder="0811xxxxxxx" id="first_name" type="text" class="validate">
          <label for="first_name">Nomor HP</label>
        </div>
      </div>
           
    </form>
  </div>
  <form action="#">
              <div class="file-field input-field">
                <div class="btn card-panel red darken-2">
                  <span class="white-text">File</span>
                  <input type="file" multiple>
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Upload laporan akhir">
                </div>
              </div>
            </form>
            <br>
            <div align="left">
<a class="waves-effect waves-light btn card-panel red darken-2"><span class="white-text">AJUKAN LAPORAN AKHIR</a>
<i class="material-icons right">send</i>
</div>

          </div>
      </div>
    </div>


      <!-- END OF CONTENT KELOLA HIBAH -->

  </div>
  @stop
</body>
</html>
