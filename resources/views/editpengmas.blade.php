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
  <title>EDIT PENGABDIAN MASYARAKAT</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/publikasi.css')}}">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script>
    $(document).ready(function(){
        //DATE PICKER
        $('.datepicker').pickadate({
          selectMonths: true, // Creates a dropdown to control month
          selectYears: 15 // Creates a dropdown of 15 years to control year
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
          <li id="kelola-pengmas"><a href="/kelolapengmas">Kembali</a></li>   
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

       {{-- CONTENT DAFTAR BUKU --}}
       <div id="buat-pengmas-konten">
       <div class="container">
          <div class="header"><h4>Edit Pengabdian Masyarakat</h4></div>
          <div class="hibah-riset-content">
             <div class="row">
            <form class="col s12" method="post" action="/editpengmas/{{$pengmas->id}}" enctype="multipart/form-data">
             <input name="staf_riset" value="<?php echo $id ?>" type="hidden" class="validate">
             <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">    

              {{-- FIRST ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Nama kegiatan" name="nama_kegiatan" value="{{$pengmas->nama_kegiatan}}" type="text" class="validate">
                  <label for="nama">Nama Kegiatan</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Ketua tim" name="ketua" type="text" value="{{$pengmas->ketua}}" class="validate">
                  <label for="nip/nup">Ketua Tim</label>
                </div>

              </div>

              <?php
              $list = "";
               ?>

               {{-- GET ALL ANGGOTA FROM SPECIFIC PENGMAS --}}
                @foreach($listofanggota as $anggota)
                  <?php
                  $list = $list . $anggota->nama_anggota . ";" ;
                  ?>
                @endforeach
                {{-- END OF GET ALL ANGGOTA --}}

              {{-- SECOND ROW --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Penyelenggara" name="penyelenggara" value="{{$pengmas->penyelenggara}}" type="text" class="validate">
                  <label for="judulproposal">Penyelenggara</label>
                </div>
                <div class="input-field col s4">
                <input placeholder="Anggota tim" name="nama_anggota" value="<?php echo substr($list, 0, -1) ?>" type="text" class="validate">
                <label for="nohp">Anggota tim</label>
                </div>
              </div>

                {{-- FOURTH ROW --}}
              <div class="row">
               <div class="input-field col s6 offset-s1">
                  <input placeholder="Peranan" name="peranan" type="text" value="{{$pengmas->peranan}}" class="validate">
                  <label for="judulproposal">Peranan</label>
                </div>
                <div class="input-field col s4">
                  <input type="date" name="waktu" value="{{$pengmas->waktu}}" class="datepicker">
                  <label for="nohp">Waktu</label>
                </div>
              </div>

               {{-- FOURTH ROW --}}
              <div class="row">
               <div class="input-field col s6 offset-s1">
                  <input placeholder="Tempat" name="tempat" value="{{$pengmas->tempat}}" type="text" class="validate">
                  <label for="judulproposal">Tempat</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Besar dana" name="besar_dana" value="{{$pengmas->besar_dana}}" type="text" class="validate">
                  <label for="nohp">Besar Dana</label>
                </div>
              </div>


              {{-- FIFTH ROW --}}
              <div class="row">
                <div class="file-field input-field col s6 offset-s1">
                  <div class="btn">
                    <span class="white-text">File</span>
                    <input name="bukti" type="file" placeholder="Masukkan bukti kontrak pengmas">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Kosongkan jika tidak ingin mengganti file" value="{{$pengmas->bukti}}">
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

   <script>
  $(document).ready(function() {
      $('select').material_select();  //FOR FORM SELECT
      $('.modal-trigger').leanModal(); //FOR MODAL
  });
  </script>

  @stop
</body>
</html>
