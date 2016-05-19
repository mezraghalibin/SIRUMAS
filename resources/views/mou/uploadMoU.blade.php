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
  <title>MoU</title>
    <meta charset="utf-8">
    <link rel="author" href="humans.txt">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/mou.css') }}">

    <!--FOR MATERIALIZE DONT DELETE THIS-->
      <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!--FOR MATERIALIZE DONT DELETE THIS-->

    <script>
    $(document).ready(function(){
      //FUNCTION CLEAR
      $("#clear").click(function(){
        $("#flash-msg").fadeOut(1000);
      });

      //INPUT NAMA STAF RISET PENGUPLOAD MOU
      var id_staf = "<?php echo $id ?>";
      document.getElementById('staf_riset').value = id_staf;
    });
    </script>
</head>
<body>
@section('main_content')
  <div class="page-content">
    {{-- NAVBAR EVERY PAGE --}}
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
          <li id="kelola"><a href="/mou/upload">Upload MoU</a></li>
          <li id="buat"><a href="/mou/arsip">Arsip MoU</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF NAVBAR EVERY PAGE --}}

    {{-- CONTENT UPLOAD MOU --}}
    <div class="container">
      <div id="upload-mou">
        <div class="header"><h4>Upload MoU</h4></div>
        <div id="flash-msg">
          @if(Session::has('flash_message'))
            <div class="card-panel teal darken-2">
              <span class="white-text">{{ Session::get('flash_message') }}</span>
              <a id="clear" class="collection-item" style="cursor:pointer">
              <i class="material-icons white right">clear</i></a>
            </div>
          @endif
        </div>
          <div class="upload-content">
            <div class="row">
              <form method="post" action="/mou/upload" class="col s12" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="id_mou" value="<?php echo $id ?>">
                {{-- INPUT JUDUL MOU --}}
                <div class="row">
                  <div class="input-field col s6 offset-s3">
                    <input placeholder="Judul MoU" id="judul_mou" name="judul" type="text" class="validate">
                    <label for="judul_mou">Judul MoU</label>
                  </div>
                </div>
                {{-- INPUT NAMA PENELITI--}}
                <div class="row">
                  <div class="input-field col s6 offset-s3">
                    <input placeholder="Nama Peneliti" id="nama_peneliti" name="peneliti" type="text" class="validate">
                    <label for="nama_peneliti">Nama Peneliti</label>
                  </div>
                </div>
                {{-- INPUT FILE MOU --}}
                <div class="row">
                  <div class="file-field input-field col s6 offset-s3">
                    <div class="btn card-panel red darken-2">
                      <span class="white-text">File</span>
                      <input type="file" name="file">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" placeholder="Belum ada file yang dipilih">
                    </div>
                  </div>
                </div>
                {{-- INPUT ID OF STAF RISET AND UPDATED BY --}}
                <div class="row">
                  <div class="input-field col s6 offset-s3">
                    <input type="hidden" id="staf_riset" name="staf_riset" value="">
                    <input type="hidden" id="updated_by" name="updated_by" value="-">
                  </div>
                </div>
                {{-- BUTTON SUBMIT FORM--}}
                <div class="center-align">
                  <button class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action" value="submit">
                    <span class="white-text">SIMPAN</span>
                  </button>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
    {{--  END OF CONTENT UPLOAD MOU --}}
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
