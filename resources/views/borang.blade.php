@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>BORANG</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/hibah.css">
    <link rel="stylesheet" href="assets/css/borang.css">
    <!--<link rel="stylesheet" href="assets/css/buatButton.css">-->

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

</head>
<body>
  @section('main_content')
  <div class="page-content">
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
          <li id="berhibah"><a href="#">Laporan Berhibah</a></li>
          <li id="tidak-hibah"><a href="#">Laporan Tidak Berhibah</a></li>
          <li id="upload-kemajuan"><a href="#">Upload Laporan Kemajuan</a></li>
          <li id="upload-akhir"><a href="#">Upload Laporan Akhir</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
        </ul>
      </div>
    </nav>

    <!-- CONTENT BUAT BORANG -->
    <div class="container">
      <div id="kelola-hibah">
        <div class="header"><h4>Buat Borang</h4></div>
          <div class="kelola-content">
            <table class="highlight centered">
              <thead>
                <tr>
                    <th data-field="komponen">Komponen</th>
                    <th data-field="name">Bobot Penilaian</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td><input type="text" id="usr" placeholder="Isi komponen">
                  </td>
                  <td>
                      <div align="center">
                     <select class="browser-default" style="width:100px">
                        <option disabled selected>Bobot</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                      </div>
                  </td>
               </tr>
               
                 <tr>
                  <td><input type="text" id="usr" placeholder="Isi komponen">
                  </td>
                  <td>
                      <div align="center">
                     <select class="browser-default" style="width:100px">
                        <option disabled selected>Bobot</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                      </div>
                  </td>
               </tr>
               
                <tr>
                  <td><input type="text" id="usr" placeholder="Isi komponen">
                  </td>
                  <td>
                      <div align="center">
                     <select class="browser-default" style="width:100px">
                        <option disabled selected>Bobot</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                      </div>
                  </td>
               </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div>
      <!-- END OF CONTENT KELOLA HIBAH -->
<div align="center">
<a class="waves-effect waves-light btn, card-panel red darken-2"><span class="white-text">SIMPAN BORANG</span></a>
</div>

  </div>

  {{-- <div class="wrapper">
    
    </div>
  </div> --}}
  @stop
</body>
</html>
