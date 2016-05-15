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
  <title>BUAT PENELITIAN</title>
  <link rel="author" href="humans.txt">

  <!-- CSS FOR PAGE HIBAH -->
  <link rel="stylesheet" href="{{ URL::asset('assets/css/penelitian.css') }}">

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
          <li id="kelola-penelitian"><a href="/kelolaRepository/penelitian/kelola">Kelola Penelitian</a></li>
          <li id="buat-penelitian"><a href="/kelolaRepository/penelitian/buat">Buat Penelitian</a></li>  
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

    {{-- CONTENT PENELITIAN--}}
    <div id="buat-penelitian-konten">
      <div class="container">
        <div class="header"><h4>Buat Penelitian</h4></div>
        <div class="penelitian-content">
          <div class="row">
            <form method="POST" action="/kelolaRepository/penelitian/buat" class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <input type="hidden" name="staf_riset" value="<?php echo $id ?>">
              
              {{-- FIRST ROW = JUDUL --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  <input placeholder="Judul penelitian" id="judul" name="judul" type="text" class="validate" required>
                  <label for="nama">Judul Penelitian</label>
                </div>
              </div>

              {{-- SECOND ROW = KETUA --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  <input placeholder="Ketua penelitian" id="ketua" name="ketua" type="text" class="validate" required>
                  <label for="ketua">Ketua Peneliti</label>
                </div>
              </div>

              {{-- THIRD ROW = ANGGOTA --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  <input placeholder="Andi;Budi;Caca" name="nama_anggota" 
                    id="nama_anggota" type="text" class="validate" required>
                  <label for="nama_anggota">Anggota Peneliti</label>
                </div>
              </div>

              {{-- FOURTH ROW = MAHASISWA --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  <input placeholder="Andi;Budi;Caca" name="nama_mhs" 
                    id="nama_mhs" type="text" class="validate" required>
                  <label for="nama_mhs">Mahasiswa yang Terlibat</label>
                </div>
              </div>

              {{-- FIFTH ROW = SUMBER & BESAR DANA --}}
              <div class="row">
                <div class="input-field col s5 offset-s2">
                  <input placeholder="Sumber dana" name="sumber_dana" 
                    id="sumber_dana" type="text" class="validate" required>
                  <label for="sumber_dana">Sumber Dana</label>
                </div>
                <div class="input-field col s3">
                  <input placeholder="Isi Dengan Angka" name="nominal" 
                    id="besar_dana" type="number" class="validate" min="1" required>
                  <label for="besar_dana">Besar Dana</label>
                </div>
                <div class="input-field col s3">
                  <input name="besar_dana" id="besar_dana" type="hidden" class="validate" value="">
                </div>
              </div>

              {{-- FOURTH ROW = FILE --}}
              <div class="row">
                <div class="file-field input-field col s8 offset-s2">
                  <div class="btn card-panel">
                    <span class="white-text">File</span>
                    <input name="file" type="file" required>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Masukkan bukti kontrak penelitian">
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
    </div>
    {{-- END OF CONTENT PENELITIAN --}}
  </div>
  {{-- END OF PAGE CONTENT --}} 
  @stop
</body>
</html>