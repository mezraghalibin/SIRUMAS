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
  <!--FOR MATERIALIZE DONT DELETE THIS-->

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
          <li id="kelola-pengmas"><a href="/kelolaRepository/pengmas/kelola">Kembali</a></li>   
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

    {{-- CONTENT EDIT PENGMAS --}}
    <div id="buat-pengmas-konten">
      <div class="container">
        <div class="header"><h4>Edit Pengabdian Masyarakat</h4></div>
        <div class="edit-pengmas-content">
          <div class="row">
            <form class="col s12" method="post" action="/kelolaRepository/pengmas/update/{{$pengmas->id}}"
              enctype="multipart/form-data">
              <input name="staf_riset" value="<?php echo $id ?>" type="hidden" class="validate">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">    

              {{-- FIRST ROW = NAMA KEGIATAN --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  <input placeholder="Nama kegiatan" name="nama_kegiatan" 
                    type="text" class="validate" value="{{ $pengmas->nama_kegiatan }}" required>
                  <label for="nama">Nama Kegiatan</label>
                </div>
              </div>

              {{-- SECOND ROW = PENYELENGGARA --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  <input placeholder="Penyelenggara" name="penyelenggara" type="text" 
                    class="validate" value="{{ $pengmas->penyelenggara }}" required>
                  <label for="judulproposal">Penyelenggara</label>
                </div>
              </div>

              {{-- THIRD ROW = PERANAN & BESAR DANA --}}
              <div class="row">
                <div class="input-field col s5 offset-s2">
                  <input placeholder="Peranan" name="peranan" type="text" 
                    class="validate" value="{{ $pengmas->peranan }}" required>
                  <label for="judulproposal">Peranan</label>
                </div>
                <div class="input-field col s3">
                  <input placeholder="Masukan Angka Saja" name="nominal" type="number" 
                    class="validate" value="{{ $pengmas->nominal }}" required>
                  <label for="nominal">Besar Dana</label>
                  <input placeholder="Besar dana" name="besar_dana" type="hidden" class="validate" value="">
                </div>
              </div>

              {{-- FOURTH ROW = KETUA TIM --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  <input placeholder="Ketua tim" name="ketua" type="text" 
                    class="validate" value="{{ $pengmas->ketua }}" required>
                  <label for="nip/nup">Ketua Tim</label>
                </div>
              </div>

              {{-- FIFTH ROW = ANGGOTA --}}
              <div class="row">
                <div class="input-field col s8 offset-s2">
                  <?php $list = ""; ?>

                  {{-- GET ALL ANGGOTA FROM SPECIFIC PENGMAS --}}
                  @foreach($listofanggota as $anggota)
                    <?php $list = $list . $anggota->nama_anggota . ";" ; ?>
                  @endforeach
                  {{-- END OF GET ALL ANGGOTA --}}

                  <input placeholder="Anggota A;Anggota B;Anggota C;dst.." value="<?php echo substr($list, 0, -1) ?>"
                    name="nama_anggota" type="text" class="validate" required>
                  <label for="anggota">Anggota tim</label>
                </div>
              </div>

              {{-- SIXTH ROW --}}
              <div class="row">
                <div class="input-field col s5 offset-s2">
                  <input placeholder="Tempat" name="tempat" type="text" 
                    class="validate" value="{{ $pengmas->tempat }}" required>
                  <label for="judulproposal">Tempat</label>
                </div>
                <div class="input-field col s3">
                  <input type="date" name="waktu" class="datepicker" value="{{ $pengmas->waktu }}" required>
                  <label for="nohp">Waktu</label>
                </div>
              </div>

              {{-- SEVENTH ROW --}}
              <div class="row">
                <div class="file-field input-field col s8 offset-s2">
                  <div class="btn">
                    <span class="white-text">File</span>
                    <input name="bukti" type="file" placeholder="Masukkan bukti kontrak pengmas">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Kosongkan Jika Tidak Mengganti File">
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
    {{-- END OF CONTENT EDIT PENGMAS --}}
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
