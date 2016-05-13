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
  <title>BUAT BUKU</title>
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
          <li id="kelola-penelitian"><a href="kelolabuku">Kelola Buku</a></li> 
          <li id="buat-penelitian"><a href="buatbuku">Buat Buku</a></li>   
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



      {{-- CONTENT DAFTAR BUKU --}}
       <div id="buat-buku-konten">
       <div class="container">
          <div class="header"><h4>Buat Buku</h4></div>
          <div class="hibah-riset-content">
             <div class="row">
            <form method="POST" action="tomakebuku" class="col s12" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <input type="hidden" name="staf_riset" value="<?php echo $id ?>">

              {{-- FIRST ROW = JUDUL --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Judul buku" id="judul" name="judul" type="text" class="validate">
                  <label for="judul">Judul</label>
                </div>
              </div>

              {{-- SECOND ROW = PENULIS, PENERBIT--}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Penulis" name="penulis" 
                    id="penulis" type="text" class="validate">
                  <label for="penulis">Penulis</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Penerbit" name="penerbit" id="penerbit" type="text" class="validate">
                  <label for="penerbit">Penerbit</label>
                </div>
              </div>


              {{-- THIRD ROW = TAHUN TERBIT, ISBN--}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Tahun terbit buku" name="tahun" 
                    id="tahun" type="text" class="validate">
                  <label for="tahun">Tahun Terbit</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Nomor ISBN" name="isbn" id="isbn" type="text" class="validate">
                  <label for="isbn">ISBN</label>
                </div>
              </div>

              {{-- FOURTH ROW = KOTA TERBIT, JUMLAH HALAMAN--}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Tempat terbit buku" name="kota_terbit" 
                    id="kota_terbit" type="text" class="validate">
                  <label for="kota_terbit">Kota Terbit</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Jumlah halaman" name="jumlah_hlm" id="jumlah_hlm" type="text" class="validate">
                  <label for="jumlah_hlm">Jumlah Halaman</label>
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
                    <input class="file-path validate" type="text" placeholder="Masukkan bukti halaman cover dan ISBN">
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
          <!-- END OF TABEL DAFTAR PROPOSAL
          </div>
          {{-- CONTENT BUKU --}}
            </div>
  @stop
</body>
</html>