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
  <title>LAPORAN</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/hibah.css">

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
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script>
    $(document).ready(function(){
        $("#laporan-akhir").hide();

        $("#kemajuan").click(function(){
            $("#laporan-kemajuan").fadeIn(500);
            $("#laporan-akhir").hide();
        });

        $("#akhir").click(function(){
            $("#laporan-akhir").fadeIn(500);
            $("#laporan-kemajuan").hide();
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
          <li id="kemajuan"><a href="#">Laporan Kemajuan</a></li>
          <li id="akhir"><a href="#">Laporan Akhir</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#"><?php echo "Login sebagai $name | $spesifik_role"; ?></a></li>
        </ul>
      </div>
    </nav>
    {{-- END OF SECOND NAVBAR --}}

    {{-- CONTENT LAPORAN kemajuan --}}
    <div class="container">
      <div id="laporan-kemajuan">
        <div class="header"><h4>Laporan Kemajuan</h4></div>
          <div class="kemajuan-content">
           <table class="highlight centered">
              <thead>
                <tr>
                    <th data-field="id">Judul Laporan</th>
                    <th data-field="name">Pengaju</th>
                    <th data-field="price">Tanggal Submit</th>
                    <th data-field="price">File</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td>Hibah Riset 2015</td>              
                  <td>Milki</td>
                  <td>11/04/2015</td>
                  <td>
                    <a class="waves-effect waves-teal btn-flat"><i class="material-icons">system_update_alt</i></a>
                  </td>
                </tr>
                <tr>
                  <td>Hibah Riset 2015</td>
                  <td>Rangga</td>
                  <td>11/04/2015</td>
                  <td>
                    <a class="waves-effect waves-teal btn-flat"><i class="material-icons">system_update_alt</i></a>
                  </td>
                </tr>
                <tr>
                  <td>Hibah Riset 2016</td>
                  <td>Cinta</td>
                  <td>11/04/2015</td>
                  <td>
                    <a class="waves-effect waves-teal btn-flat"><i class="material-icons">system_update_alt</i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div>
      <!-- END OF CONTENT LAPORAN kemajuan -->

    <!-- CONTENT akhir HIBAH -->
    <div class="container">
      <div id="laporan-akhir">
      <div class="header"><h4>Laporan Akhir</h4></div>
          <div class="kemajuan-content">
           <table class="highlight centered">
              <thead>
                <tr>
                    <th data-field="id">Judul Laporan</th>
                    <th data-field="name">Pengaju</th>
                    <th data-field="price">Tanggal Submit</th>
                    <th data-field="price">File</th>
                </tr>
              </thead>  

              <tbody>
                <tr>
                  <td>Hibah Riset 2015</td>              
                  <td>Milki</td>
                  <td>11/04/2015</td>
                  <td>
                    <a class="waves-effect waves-teal btn-flat"><i class="material-icons">system_update_alt</i></a>
                  </td>
                </tr>
                <tr>
                  <td>Hibah Riset 2015</td>
                  <td>Rangga</td>
                  <td>11/04/2015</td>
                  <td>
                    <a class="waves-effect waves-teal btn-flat"><i class="material-icons">system_update_alt</i></a>
                  </td>
                </tr>
                <tr>
                  <td>Hibah Riset 2016</td>
                  <td>Cinta</td>
                  <td>11/04/2015</td>
                  <td>
                    <a class="waves-effect waves-teal btn-flat"><i class="material-icons">system_update_alt</i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div>
    <!-- END OF CONTENT akhir HIBAH -->
  </div>
  @stop
</body>
</html>
