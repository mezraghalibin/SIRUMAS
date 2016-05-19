@extends('master')
<?php 
  //CHECK USER'S ROLE
  $id             = $_SESSION['id'];
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $role           = $_SESSION['role'];
  $spesifik_role  = $_SESSION['spesifik_role']; 
?>

<!DOCTYPE html>
<html>
<head>
  <title>PENGUMUMAN</title>
    <link rel="author" href="humans.txt">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/pengumuman.css') }}">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import jQuery before materialize.js-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!--FOR MATERIALIZE DONT DELETE THIS-->

    <script>
      $(document).ready(function(){
        //CLEAR FLASH MESSAGE
        $("#clear").click(function(){
          $("#flash-msg").fadeOut(1000);
        });

        $('select').material_select();
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
            @if($spesifik_role == 'divisi riset')
              <li id="kelola"><a href="/pengumuman/kelolapengumuman">Kelola Pengumuman</a></li>
              <li id="buat"><a href="/pengumuman/buatpengumuman">Buat Pengumuman</a></li>
            @endif
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END of SECOND NAVBAR --}}

    {{-- CONTENT BUAT PENGUMUMAN --}}
    <div class="container">
      <div id="buat-pengumuman">
          <div class="header"><h4>Buat Pengumuman</h4></div>
            <div id="flash-msg">
              @if(Session::has('flash_message'))
                <div class="card-panel teal darken-2">
                  <span class="white-text">{{ Session::get('flash_message') }}</span>
                  <a id="clear" class="collection-item" style="cursor:pointer">
                  <i class="material-icons white right">clear</i></a>
                </div>
              @endif
            </div>
            <form method="post" action="/pengumuman/buatpengumuman" class="col s12" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="staf_riset" value="<?php echo $id ?>"> <!-- naro id staf riset -->
            <input type="hidden" name="status" value=0> <!-- status di set 0 -->
            {{-- bagian atas --}}
            <div class="row">
              <div class="input-field col s4">
                <input id="judul_pengumuman"  placeholder="Judul Pengumuman" type="text" class="validate" name="judul" required>
                <label class="active" for="judul_hibah">Judul</label>
              </div>
              <div class="input-field col s4">
                <input id="nomor_pengumuman" type="text" placeholder="Nomor Pengumuman" class="validate" name="nomor" required>
                <label class="active" for="nomor_hibah">Nomor</label>
              </div>
              <div class="input-field col s2">
                <select name="kategori" required>
                <option value="" disabled selected>Kategori</option>
                <option value="Riset">Riset</option>
                <option value="Pengmas">Pengmas</option>
                </select>
                <label>Ketegori</label>
              </div>
            </div>

            {{-- bagian isi     --}}
            <div class="row">
              <div class="input-field col s10">
                <textarea id="konten_pengumuman" placeholder="Masukan Konten Pengumuman" 
                  class="materialize-textarea" name="konten" required></textarea>
                <label for="konten_pengumuman">Konten Pengumuman</label>
              </div>
            </div>
            
            {{-- INPUT FILE --}}
            <div class="row">
              <div class="file-field input-field col s6">
                <div class="btn card-panel teal darken-2">
                  <span class="white-text">File</span>
                  <input type="file" name="file">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" name="file" placeholder="Belum ada file yang dipilih">
                </div>
              </div>
            </div>

            {{-- BUTTON SUBMIT --}}
            <div class="col s6">
              <button class="btn waves-effect waves-light card-panel teal darken-2" type="submit" name="action" value="submit"><span class="white-text">Simpan</span>
              <i class="material-icons right">send</i>
              </button>
            </div>
          </form>
      </div>
    </div>
    {{-- END OF CONTENT BUAT HIBAH --}}
  </div>
  {{-- END OF PAGE CONTENT --}}
  <script>
    $(document).ready(function() {
      $('select').material_select();
      $('.modal-trigger').leanModal();
    });
  </script>

  @if ($errors->any())
    <ul class="alert alert-danger">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  @endif
  @stop
</body>
</html>