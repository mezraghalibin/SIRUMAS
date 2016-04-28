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
  <title>KELOLA ARTIKEL ILMIAH</title>
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
          <li id="kelola-buku"><a href="#">Kembali</a></li>   
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}


   {{-- CONTENT DAFTAR BUKU --}}
       <div id="buat-artikel-ilmiah-konten">
       <div class="container">
          <div class="header"><h4>Edit Artikel Ilmiah</h4></div>
          <div class="hibah-riset-content">
             <div class="row">
            <form class="col s12">

              {{-- FIRST ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Judul buku" id="nama" name="nama_pengaju" type="text" class="validate">
                  <label for="nama">Judul</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Penulis utama" id="nip/nup" name="nip/nup" type="text" class="validate">
                  <label for="nip/nup">Penulis Utama</label>
                </div>

              </div>

              {{-- SECOND ROW = JUDUL PROPOSAL --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Nama jurnal" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Nama Jurnal</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Penulis anggota (jika ada)" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Penulis Anggota</label>
                </div>
                <label><button class="add_field_button btn-floating btn-large card-panel red darken-2">
                <i class="material-icons">add</i></button></label>
              </div>


              {{-- THIRD ROW --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Tahun terbit buku" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Level</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Nomor ISBN" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">ISSN</label>
                </div>
              </div>

              {{-- FOURTH ROW --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Nomor" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Nomor</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Volume" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Volume</label>
                </div>
              </div>

              {{-- FIFTH ROW --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Tahun jurnal" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">Tahun</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Jumlah halaman" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Halaman</label>
                </div>
              </div>

              {{-- FOURTH ROW --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Link URL" name="judul_proposal" 
                    id="judulproposal" type="text" class="validate">
                  <label for="judulproposal">URL</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Penerbit" name="no_hp" id="nohp" type="text" class="validate">
                  <label for="nohp">Penerbit</label>
                </div>
              </div>

              {{-- FIFTH ROW --}}
              <div class="row">
                <div class="file-field input-field col s6 offset-s1">
                  <div class="btn">
                    <span class="white-text">File</span>
                    <input name="file" type="file" placeholder="Masukkan bukti halaman cover dan ISBN">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Masukkan bukti jurnal">
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
