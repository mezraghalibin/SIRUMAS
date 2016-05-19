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
  <title>BUAT ARTIKEL POPULER</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/artikelPopuler.css') }}">

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
          <li id="kelola-artikel-populer"><a href="/kelolaRepository/artikelPopuler/kelola">Kelola Artikel Populer</a></li>
          <li id="buat-artikel-populer"><a href="/kelolaRepository/artikelPopuler/buat">Buat Artikel Populer</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}
      
    {{-- FLASH MESSAGE AFTER UPLOAD MOU --}}
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
    {{-- END OF FLASH MESSAGE AFTER UPLOAD MOU --}}

    {{-- CONTENT BUAT BUKU --}}
    <div id="buat-artikel-populer-konten">
      <div class="container">
        <div class="header"><h4>Buat Artikel Populer</h4></div>
        <div class="artikel-populer-content">
          <div class="row">
            <form method="POST" action="/kelolaRepository/artikelPopuler/buat" 
              class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <input type="hidden" name="staf_riset" value="<?php echo $id ?>">

              {{-- FIRST ROW = JUDUL --}}
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input placeholder="Judul Artikel Populer" id="judul" name="judul" type="text" class="validate" required>
                  <label for="judul">Judul</label>
                </div>
              </div>

              {{-- SECOND ROW = NAMA JURNAL & LEVEL --}}
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input placeholder="Dimuat Pada" id="dimuat_di" name="dimuat_di" type="text" class="validate" required>
                  <label for="dimuat_di">Dimuat Pada</label>
                </div>
              </div>
                
              {{-- THIRD ROW = PENULIS UTAMA --}}
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input placeholder="Penulis" name="penulis_utama" 
                    id="penulis" type="text" class="validate" required>
                  <label for="penulis">Penulis Utama</label>
                </div>
              </div>
              
              {{-- FOURTH ROW = PENULIS ANGGOTA --}}
              <div class="row">
                <div class="input-field col s6 offset-s3">
                 <input placeholder="Andi;Budi;Caca;Delta" name="nama_anggota" 
                    id="nama_anggota" type="text" class="validate" required>
                  <label for="nama_anggota">Anggota Penulis</label>
                </div>
              </div>

              {{-- FIFTH ROW = NO VOL HAL TAHUN--}}
              <div class="row">
                <div class="input-field col s3 offset-s3">
                  <input placeholder="Nomor" name="no" id="no" type="text" class="validate" required>
                  <label for="no">No. </label>
                </div>
                <div class="input-field col s2">
                  <input placeholder="Jumlah Halaman" name="halaman" id="halaman" type="text" class="validate" required>
                  <label for="Halaman">Jumlah Halaman</label>
                </div>
                <div class="input-field col s1">
                  <input placeholder="Tahun" name="tahun" id="tahun" type="text" class="validate" required>
                  <label for="tahun">Tahun</label>
                </div>
              </div>

              {{-- SIXT ROW = KOTA TERBIT, JUMLAH HALAMAN--}}
              <div class="row">
                <div class="input-field col s3 offset-s3">
                  <input placeholder="Penerbit" name="penerbit" id="penerbit" type="text" class="validate" required>
                  <label for="penerbit">Penerbit</label>
                </div>
                <div class="input-field col s3">
                  <input placeholder="URL" name="url" id="url" type="text" class="validate" required>
                  <label for="url">URL Artikel</label>
                </div>
              </div>

              {{-- SEVENTH ROW --}}
              <div class="row">
                <div class="file-field input-field col s6 offset-s3">
                  <div class="btn">
                    <span class="white-text">File</span>
                    <input name="bukti" type="file" placeholder="Masukkan Bukti Artikel" required>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Masukkan Bukti Artikel">
                  </div>
                </div>
              </div>

              {{-- BUTTON SUBMIT --}}
              <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit" name="action">
                  <span class="white-text">Submit</span><i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- END OF CONTENT BUAT BUKU --}}
  </div>
  {{-- END OF PAGE CONTENT --}}
  <script>
    $(document).ready(function() {
      $('select').material_select();  //FOR FORM SELECT
      $('.modal-trigger').leanModal(); //FOR MODAL
    });
  </script>
  @stop
</body>
</html>