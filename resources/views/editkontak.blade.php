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
          <li id="kelola-kontak"><a href="/kontak/kelolakontak">Kembali</a></li>
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
        <div class="header"><h4>Edit Kontak</h4></div>
        <div class="hibah-riset-content">
          <div class="row">
            <form method="post" action="/kontak/update/{{ $dataKontak->id }}" class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <div class="col s6 left-row">
                {{-- FIRST ROW = NAMA --}}
                <div class="row">
                  <div class="input-field col s12">
                    <input placeholder="Nama kontak" name="nama" type="text" 
                      class="validate" value="{{$dataKontak->nama}}" required>
                    <label for="nama">Nama Kontak</label>
                  </div>
                </div>

                {{-- SECOND ROW = EMAIL HP --}}
                <div class="row">
                  <div class="input-field col s6">
                    <input placeholder="E-mail" name="email" type="text" 
                      class="validate" value="{{$dataKontak->email}}" required>
                    <label for="nip/nup">E-mail</label>
                  </div>
                  <div class="input-field col s6">
                    <input placeholder="Nomor HP" name="phone" type="text" 
                      class="validate" value="{{$dataKontak->phone}}" required>
                    <label for="nohp">Nomor HP</label>
                  </div>
                </div>

                {{-- SECOND ROW = EXPERTISE --}}
                <div class="row">
                  <div class="input-field col s12">
                    <input placeholder="Institusi" name="institusi" type="text" 
                      class="validate" value="{{$dataKontak->institusi}}" required>
                    <label for="nohp">Institusi</label>
                  </div>
                </div>

                {{-- THIRD ROW = EXPERTISE --}}
                {{-- GET ALL EXPERTISE FROM SPECIFIC CONTACT --}}
                <?php 
                  $expertises = $dataKontak->getExpertise;
                  $list = ""; 
                ?>
                @foreach($expertises as $expertise)
                  <?php $list = $list . $expertise->expertise . ";" ; ?>
                @endforeach
                {{-- END OF GET ALL EXPERTISE --}}
                <div class="row">
                  <div class="input-field col s12">
                    <input placeholder="Expertise" name="expertise" type="text" 
                      class="validate" value="<?php echo substr($list, 0, -1) ?>">
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
                      <input type="file" name="foto">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" placeholder="Kosongkan Jika Tidak Mau Mengganti Foto">
                    </div>
                  </div>
                </div>

                {{-- FIFTH ROW = DESKRIPSI --}}
                <div class="row">
                  <div class="input-field col s12">
                    <textarea placeholder="Deskripsi Kontak" id="deskripsi" 
                      name="deskripsi" class="materialize-textarea" required>{{$dataKontak->deskripsi}}</textarea>
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
