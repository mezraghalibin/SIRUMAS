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
  <title>KELOLA PENELITIAN</title>
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
          <li id="kelola-penelitian"><a href="#">Kembali</a></li>   
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}


  {{-- CONTENT DAFTAR BUKU --}}
       <div id="buat-penelitian-konten">
       <div class="container">
          <div class="header"><h4>Edit Penelitian</h4></div>
          <div class="hibah-riset-content">
             <div class="row">
            <form class="col s12">

              {{-- FIRST ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Judul penelitian" id="nama" name="nama_pengaju" type="text" class="validate">
                  <label for="nama">Judul Penelitian</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Ketua penelitian" id="nip/nup" name="nip/nup" type="text" class="validate">
                  <label for="nip/nup">Ketua Peneliti</label>
                </div>

              </div>

              {{-- SECOND ROW = JUDUL PROPOSAL --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Sumber dana penelitian" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Sumber Dana</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Nama anggota peneliti" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Anggota Peneliti</label>
                </div>
                <label><button class="add_field_button btn-floating btn-large card-panel red darken-2">
                <i class="material-icons">add</i></button></label>
              </div>

                {{-- FOURTH ROW --}}
              <div class="row">
               <div class="input-field col s6 offset-s1">
                  <input placeholder="Besar dana" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Besar Dana</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Penerbit" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Mahasiswa yang Terlibat</label>
                </div>
                <label><button class="add_field_button btn-floating btn-large card-panel red darken-2">
                <i class="material-icons">add</i></button></label>
              </div>


              {{-- FIFTH ROW --}}
              <div class="row">
                <div class="file-field input-field col s6 offset-s1">
                  <div class="btn">
                    <span class="white-text">File</span>
                    <input name="file" type="file" placeholder="Masukkan bukti kontrak penelitian">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Masukkan bukti artikel">
                  </div>
                </div>
              </div>

              {{-- BUTTON SUBMIT --}}
              <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit" name="action"><span class="white-text">Submit</span><i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
          </div>
          </div>
          <!-- END OF TABEL DAFTAR PROPOSAL -->
          </div>
          {{-- CONTENT BUKU --}}
     

  </div>
  @stop
</body>
</html>
