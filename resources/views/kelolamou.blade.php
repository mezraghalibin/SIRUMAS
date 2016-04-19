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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="author" href="humans.txt">
  <link rel="stylesheet" href="{{ URL::asset('assets/css/mou.css') }}">

  <!--FOR MATERIALIZE DONT DELETE THIS-->
    <link href='node_modules/materialize-css/fonts/roboto/' rel='stylesheet' type='text/css'>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
      $("#arsip-mou").hide();

      $("#kelola").click(function(){
        $("#upload-mou").fadeIn(500);
        $("#arsip-mou").hide();
      });

      $("#buat").click(function(){
        $("#arsip-mou").fadeIn(500);
        $("#upload-mou").hide();
      });

      //FUNCTION CLEAR FLASH MESSAGE
      $("#clear").click(function(){
        $("#flash-msg").fadeOut(1000);
      });

      //INPUT NAMA PENGUPDATE
      var name = "<?php echo $name ?>";
      document.getElementById('updated_by').value = name;
    });
  </script>
</head>
<body>
@section('main_content')
  {{-- PAGE CONTENT --}}
  <div class="page-content">
    {{-- NAVBAR EVERY PAGE --}}
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
          <li id="kelola"><a href="{{action('MouController@index')}}">Kembali</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF NAVBAR EVERY PAGE --}}

    {{-- CONTENT UPLOAD MOU --}}
    <div class="container">
      <div id="upload-mou">
        <div class="header"><h4>Upload MoU</h4></div>
          <div class="upload-content">
            <div class="row">
              <form method="post" action="updatemou/{{ $dataMoU->id }}" class="col s12" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="id_mou" value="<?php echo $id ?>">
                {{-- INPUT JUDUL MOU --}}
                <div class="row">
                  <div class="input-field col s6 offset-s3">
                    <input placeholder="Judul MoU" name="judul" type="text" class="validate" value="{{ $dataMoU->judul }}">
                    <label for="judul_mou">Judul MoU</label>
                  </div>
                </div>
                {{-- INPUT NAMA PENELITI--}}
                <div class="row">
                  <div class="input-field col s6 offset-s3">
                    <input placeholder="Nama Peneliti" name="peneliti" type="text" 
                        class="validate" value="{{ $dataMoU->peneliti }}">
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
                      <input class="file-path validate" type="text" 
                        placeholder="Kosongkan Jika Tidak Mengubah File" value="">
                    </div>
                  </div>
                </div>
                {{-- INPUT NAME OF STAF RISET --}}
                <div class="row">
                  <div class="input-field col s6 offset-s3">
                    <input type="hidden" id="staf_riset" name="staf_riset" value="{{ $dataMoU->staf_riset }}">
                    <input type="hidden" id="updated_by" name="updated_by" value="">
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
  {{-- END OF PAGE CONTENT --}}

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
  <script>
  $(document).ready(function() {
      $('select').material_select();  //FOR FORM SELECT
      $('.modal-trigger').leanModal(); //FOR MODAL
  });
  </script>
@stop
</body>
</html>
