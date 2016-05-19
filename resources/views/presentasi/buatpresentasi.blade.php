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
  <title>BUAT PRESENTASI</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/publikasi.css') }}">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--FOR MATERIALIZE DONT DELETE THIS-->

    <script>
      $(document).ready(function(){
        $role = "<?php echo $spesifik_role ?>";

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
           <li id="kelola-presentasi"><a href="/presentasi/kelolapresentasi">Kelola Jadwal Presentasi</a></li> 
          <li id="buat-presentasi"><a href="/presentasi/buatpresentasi">Buat Jadwal Presentasi</a></li>  
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

    {{-- CONTENT BUAT PRESENTASI --}}
    <div id="buat-presentasi-konten">
      <div class="container">
        <div class="header"><h4>Buat Jadwal Presentasi</h4></div>
        <div class="buat-presentasi-content">
          <form method="POST" action="/presentasi/buatpresentasi" class="col s12" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="staf_riset" value="<?php echo $id ?>"> <!-- naro id staf riset -->
            <input type="hidden" name="dosen" value=""> <!-- naro nama dosen staf riset -->
            <div class="row">
              {{-- FIRST ROW = NAMA --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <select name="id_laporan">
                      <option value="" disabled selected>Judul Laporan</option>
                      @foreach($dataLaporan as $laporan)
                        <option value="{{ $laporan->id }}">{{$laporan->judul_laporan_akhir}}</option>
                      @endforeach
                  </select>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Lokasi gedung" name="gedung" type="text" class="validate">
                  <label for="gedung">Gedung</label>
                </div>
              </div>

              {{-- SECOND ROW = JUDUL PROPOSAL --}}
              <div class="row">
                <div class="input-field col s6 offset-s1">
                  <input placeholder="Nama Reviewer" name="reviewer" id="reviewer" type="text" class="validate">
                  <label for="reviewer">Reviewer</label>
                </div>
                <div class="input-field col s4">
                  <input placeholder="Ruangan" name="ruang" id="Ruang" type="text" class="validate">
                  <label for="ruangan">Ruang</label>
                </div>
              </div>

              {{-- FOURTH ROW --}}
              <div class="row">
                <div class="input-field col s1 offset-s1">
                  Waktu Awal
                </div>
                <div class="input-field col s2">
                  <input name="waktu" type="time">
                </div>
                   
                <div class="input-field col s1">
                  Waktu Akhir
                </div>
                <div class="input-field col s2 ">
                  <input name="waktu_akhir" type="time"> 
                </div>
                
                <div class="input-field col s4">
                  <input placeholder="" name="tanggal" id="Tanggal" type="text" class="validate datepicker">
                  <label for="Tanggal">Tanggal</label>
                </div>
              </div>
              <div class="row">
              <div class="input-field col s4 offset-s4">
                  <select name="status">
                    <option value="" disabled selected>Status</option>
                    <option value="0">Belum presentasi</option>
                    <option value="1">Sudah presentasi</option>
                  </select>
                </div>
              </div>
              {{-- BUTTON SUBMIT --}}
              <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit" name="action">
                  <span class="white-text">Submit</span><i class="material-icons right">send</i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- END OF CONTENT BUAT PRESENTASI --}}
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
