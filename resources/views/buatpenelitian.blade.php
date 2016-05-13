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
      /*
        $("#buat-presentasi-konten").hide();

        $("#kelola-presentasi").click(function(){
            $("#kelola-presentasi-konten").fadeIn(500);
            $("#buat-presentasi-konten").hide();
        });

         $("#buat-presentasi").click(function(){
            $("#buat-presentasi-konten").fadeIn(500);
            $("#kelola-presentasi-konten").hide();
        });
        */
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
          <li id="kelola-penelitian"><a href="kelolapenelitian">Kelola Penelitian</a></li> 
          <li id="buat-penelitian"><a href="buatpenelitian">Buat Penelitian</a></li>   
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



      {{-- CONTENT--}}
       <div id="buat-penelitian-konten">
       <div class="container">
          <div class="header"><h4>Buat Penelitian</h4></div>
          <div class="hibah-riset-content">
             <div class="row">
            <form method="POST" action="tomakepenelitian" class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <input type="hidden" name="staf_riset" value="<?php echo $id ?>">
              
              {{-- FIRST ROW = JUDUL & KETUA --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Judul penelitian" id="judul" name="judul" type="text" class="validate">
                  <label for="nama">Judul Penelitian</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Ketua penelitian" id="ketua" name="ketua" type="text" class="validate">
                  <label for="ketua">Ketua Peneliti</label>
                </div>

              </div>

              {{-- SECOND ROW = SUMBER & ANGGOTA --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Sumber dana" name="sumber_dana" 
                    id="sumber_dana" type="text" class="validate">
                  <label for="sumber_dana">Sumber Dana</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Nama anggota peneliti" name="n" id="nama_anggota" type="text" class="validate">
                  <label for="nama_anggota">Anggota Peneliti</label>
                </div>
                <!-- <label><button class="add_field_button btn-floating btn-large card-panel red darken-2">
                <i class="material-icons">add</i></button></label> -->
              </div>

                {{-- THIRD ROW = BESAR & MHS TERLIBAT --}}
              <div class="row">
               <div class="input-field col s6 offset-s1">
                  <input placeholder="Besar dana" name="besar_dana" 
                    id="besar_dana" type="text" class="validate">
                  <label for="besar_dana">Besar Dana</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Nama mahasiswa yang terlibat" name="nama_mhs" id="nama_mhs" type="text" class="validate">
                  <label for="nohp">Mahasiswa yang Terlibat</label>
                </div>
                <!-- <label><button class="add_field_button btn-floating btn-large card-panel red darken-2">
                <i class="material-icons">add</i></button></label> -->
              </div>

              {{-- FOURTH ROW = FILE --}}
              <div class="row">
                <div class="file-field input-field col s6 offset-s1">
                  <div class="btn card-panel">
                    <span class="white-text">File</span>
                    <input name="file" type="file">
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
          <!-- END OF TABEL DAFTAR PROPOSAL -->
          </div>
          {{-- CONTENT BUKU --}} 
            </div>
  @stop
</body>
</html>