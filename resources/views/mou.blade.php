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
    <link rel="stylesheet" href="assets/css/pesan.css">

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
    //FUNCTION CLEAR

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
          <li id="kelola"><a href="#">Upload MoU</a></li>
          <li id="buat"><a href="#">Arsip MoU</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF NAVBAR EVERY PAGE --}}

    {{-- FLASH MESSAGE AFTER UPLOAD MOU --}}
    <div id="flash-msg">
      @if(Session::has('flash_message'))
        <div class="card-panel teal">
          <span class="white-text">
            {{ Session::get('flash_message') }}
            <a id="clear" class="btn-flat vertical-align transparent right"><i class="material-icons">clear</i></a>
          </span>
        </div>
      @endif 
    </div>
    {{-- END OF FLASH MESSAGE AFTER UPLOAD MOU --}}

    {{-- CONTENT UPLOAD MOU --}}
    <div class="container">
      <div id="upload-mou">
        <div class="header"><h4>Upload MoU</h4></div>
          <div class="upload-content">
            <div class="row">
              <form method="post" action="uploadmou" class="col s12" enctype="multipart/form-data">
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
                {{-- INPUT NAME OF STAF RISET --}}
                <div class="row">
                  <div class="input-field col s6 offset-s3">
                    <input type="hidden" id="staf_riset" name="staf_riset" value="">
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

    {{-- CONTENT ARSIP MOU --}}
    <div class="container">
      <div id="arsip-mou">
        <div class="header">Arsip MoU</div>
          <table class="highlight centered">
            <thead>
              <tr>
                <th>Judul</th>
                <th>Peneliti</th>
                <th>File</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Laporan peneliti 2016</td>
                <td>Sri Mulyani</td>
                <td><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></td>
              </tr>
            </tbody>
          </table>
      </div>
    </div>
    {{-- END OF CONTENT ARSIP MOU --}}
  </div>

  <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
@stop
</body>
</html>
