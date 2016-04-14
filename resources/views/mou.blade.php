@extends('master')
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
        $("#arsip-mou").hide();

        $("#kelola").click(function(){
            $("#upload-mou").fadeIn(500);
            $("#arsip-mou").hide();
        });

        $("#buat").click(function(){
            $("#arsip-mou").fadeIn(500);
            $("#upload-mou").hide();
        });
      });
    </script>
</head>
<body>
  @section('main_content')
    <div class="page-content">
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

      <!-- CONTENT UPLOAD MOU-->
      <div class="container">
        <div id="upload-mou">
          <div class="header"><h4>Upload MoU</h4></div>
          <div class="kelola-content">
              <div class="row">
              <form class="col s12">
                <div class="row">
                  <div class="input-field col s6">
                    <input placeholder="Judul MoU" id="judul_mou" type="text" class="validate">
                    <label for="judul_mou">Judul MoU</label>
                  </div>
                  <div class="input-field col s6">
                    <input placeholder="Nama Peneliti" id="nama_peneliti" type="text" class="validate">
                    <label for="nama_peneliti">Nama Peneliti</label>
                  </div>
                </div>
              </form>
              </div>

              <form action="#">
                <div class="file-field input-field">
                  <div class="btn card-panel red darken-2">
                    <span class="white-text">File</span>
                    <input type="file">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Belum ada file yang dipilih">
                  </div>
                </div>
             </form>
             <br>
             <button href="#" class="btn waves-effect waves-light card-panel red darken-2" type="submit" name="action"><span class="white-text">SIMPAN</span>
             </button>
          </div>
        </div>
      </div>
      <!-- END OF CONTENT UPLOAD MOU-->

      <!-- CONTENT ARSIP MOU -->
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
          </div>
        </div>
      </div>

   
      <!-- END OF CONTENT ARSIP MOU -->
    </div>
  </div>
  @stop
</body>
</html>
