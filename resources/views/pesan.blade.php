@extends('master')

<!DOCTYPE html>
<html>
<head>
  <title>PESAN</title>
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
      $(document).ready(function(){
        $("#buat-pesan").hide();

        $("#kelola").click(function(){
            $("#kelola-pesan").fadeIn(500);
            $("#buat-pesan").hide();
        });

        $("#buat").click(function(){
            $("#buat-pesan").fadeIn(500);
            $("#kelola-pesan").hide();
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
          <li id="kelola"><a href="#">Daftar Pesan</a></li>
          <li id="buat"><a href="#">Buat Pesan</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
        </ul>
      </div>
    </nav>

      <!-- CONTENT DAFTAR PESAN-->
      <div class="container">
        <div id="kelola-pesan">
          <div class="header"><h4>Daftar Pesan</h4></div>
          <div class="kelola-content">
            <table class="highlight centered">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Pesan</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>01/01/2016</td>
                  <td>MoU dengan dekan/wakil dekan</td>
                </tr>
                <tr>
                	<td>01/09/2015</td>
                	<td>Anda terpilih menjadi penerima hibah</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- END OF CONTENT DAFTAR PESAN -->

      <!-- CONTENT BUAT PESAN -->
      <div class="container">
        <div id="buat-pesan">
            <div class="header">BUAT PESAN</div>
              <div class="kelola-content">
                <div class="row">
                  <form class="col s12">
                  <div class="row">
                    <div class="input-field col s6">
                      <input placeholder="Subjek" id="subjek" type="text" class="validate">
                      <label for="subjek">Subjek</label>
                    </div>
                    <div class="input-field col s6">
                      <input placeholder="Kepada" id="kepada" type="text" class="validate">
                      <label for="kepada">Kepada</label>
                    </div>
                  </div>
                </form>
                </div>


              <div class="row">
                <form class="col s12">
                  <div class="row">
                    <div class="input-field col s12">
                      <textarea id="textarea1" placeholder="Isi Pesan" class="materialize-textarea"></textarea>
                      <label for="textarea1">Pesan</label>
                    </div>
                  </div>
                </form>
              </div>

              <form action="#">
                <div class="file-field input-field">
                  <div class="btn">
                    <span>File</span>
                    <input type="file">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Belum ada file yang dipilih">
                  </div>
                </div>
             </form>
             <button class="btn waves-effect waves-light" type="submit" name="action">SEND
                <i class="material-icons right">send</i>
             </button>
          </div>
      
        </div>
      </div>
      <!-- END OF CONTENT BUAT PESAN -->

   <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
  @stop
</body>
</html>
