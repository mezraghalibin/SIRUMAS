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
  <title>KONTAK</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/kontak.css') }}">

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
          <li id="kelola-kontak"><a href="/kontak/kelolaKontak">Kelola Kontak</a></li>
          <li id="buat-kontak"><a href="/kontak/buatKontak">Buat Kontak</a></li>     
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- FLASH MESSAGE --}}
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
    {{-- END OF FLASH MESSAGE --}}

    {{-- CONTENT BUAT KONTAK --}}
    <div id="buat-kontak-konten">
      <div class="container">
        <div class="header"><h4>Buat Kontak</h4></div>
        <div class="hibah-riset-content">
          <div class="row">
            <form method="post" action="/kontak/create" class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <div class="col s6 left-row">
                {{-- FIRST ROW = NAMA --}}
                <div class="row">
                  <div class="input-field col s12">
                    <input placeholder="Nama kontak" id="nama" name="nama" type="text" class="validate" required>
                    <label for="nama">Nama Kontak</label>
                  </div>
                </div>

                {{-- SECOND ROW = EMAIL HP --}}
                <div class="row">
                  <div class="input-field col s6">
                    <input placeholder="E-mail" id="email" name="email" type="text" class="validate" required>
                    <label for="nip/nup">E-mail</label>
                  </div>
                  <div class="input-field col s6">
                    <input placeholder="Nomor HP" id="phone" name="phone" type="text" class="validate" required>
                    <label for="nohp">Nomor HP</label>
                  </div>
                </div>

                {{-- SECOND ROW = INSTITUSI--}}
                <div class="row">
                  <div class="input-field col s12">
                    <input placeholder="Institusi" name="institusi" id="institusi" type="text" class="validate" required>
                    <label for="nohp">Institusi</label>
                  </div>
                </div>

                {{-- THIRD ROW = EXPERTISE --}}
                <div class="row">
                  <div class="input-field col s12">
                    <input placeholder="Expertise" name="expertise" id="expertise" type="text" class="validate" required>
                    <label for="expertise">Expertise</label>
                  </div>
                </div>
              </div>

              <div class="col s6 right-row">
                {{-- FILE FOTO --}}
                <div class="row">
                  <div class="file-field input-field col s12">
                    <div class="btn card-panel red darken-2">
                      <span class="white-text">Foto</span>
                      <input type="file" name="foto" required>
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" placeholder="Lampirkan Foto Kontak">
                    </div>
                  </div>
                </div>

                {{-- FIFTH ROW = DESKRIPSI --}}
                <div class="row">
                  <div class="input-field col s12">
                    <textarea placeholder="Deskripsi Kontak" id="deskripsi" 
                      name="deskripsi" class="materialize-textarea" required></textarea>
                    <label for="deskripsi">Deskripsi</label>
                  </div>
                </div>
              </div>

              {{-- BUTTON SUBMIT --}}
              <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit" name="action">
                  <span class="white-text">Simpan</span><i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- END OF CONTENT BUAT KONTAK --}}
  </div>
  {{-- END OF PAGE CONTENT --}}
  @stop
</body>
</html>
