@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>LAPORAN</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/hibah.css">
    <link rel="stylesheet" href="assets/css/laporan.css">

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
        $("#laporan-tidak-berhibah").hide();
         $("#upload-laporan-kemajuan").hide();
          $("#upload-laporan-akhir").hide();

        $("#berhibah").click(function(){
            $("#laporan-berhibah").fadeIn(500);
            $("#laporan-tidak-berhibah").hide();
            $("#upload-laporan-kemajuan").hide();
            $("#upload-laporan-akhir").hide();
        });

        $("#tidak-hibah").click(function(){
            $("#laporan-tidak-berhibah").fadeIn(500);
            $("#laporan-berhibah").hide();
            $("#upload-laporan-kemajuan").hide();
            $("#upload-laporan-akhir").hide();
        });

         $("#upload-kemajuan").click(function(){
            $("#upload-laporan-kemajuan").fadeIn(500);
            $("#laporan-berhibah").hide();
            $("#laporan-tidak-berhibah").hide();
            $("#upload-laporan-akhir").hide();
        });

          $("#upload-akhir").click(function(){
            $("#upload-laporan-akhir").fadeIn(500);
            $("#laporan-berhibah").hide();
            $("#upload-laporan-kemajuan").hide();
            $("#laporan-tidak-berhibah").hide();
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

    <!-- CONTENT LAPORAN BERHIBAH -->
    <div class="container">
      <div id="laporan-berhibah">
        <div class="header">PILIH HIBAH</div>
          <div class="berhibah-content">
            <table class="highlight centered">
             <tbody>
                <tr>
                  <td><a href="{{action('LaporanController@laporankemajuan')}}">Hibah Riset UI 2015</a></td>
                </tr>
                 <tr>
                  <td>Hibah Riset UI 2014</td>
                </tr>
                <tr>
                  <td>Hibah Riset UI 2014</td>
                </tr>
                <tr>
                  <td>Hibah Riset UI 2014</td>
                </tr>
                <tr>
                  <td>Hibah Riset UI 2014</td>
                </tr>
           
              </tbody>
            </table>
          </div>
      </div>
    </div>
      <!-- END OF CONTENT LAPORAN BERHIBAH -->

    <!-- CONTENT tidak-hibah HIBAH -->
    <div class="container">
      <div id="laporan-tidak-berhibah">
      <div class="header">LAPORAN AKHIR</div>
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
    <!-- END OF CONTENT tidak-hibah HIBAH -->


    <div class="container">
      <div id="upload-laporan-kemajuan">
        <div class="header">JUDUL PROPOSAL TERKAIT</div>
          <div class="kemajuan-content">
           <table class="highlight centered">
              <thead>
                <tr>
                    <th data-field="id">Judul Proposal</th>
                    <th data-field="name">Kategori</th>
                    <th data-field="price">Upload Laporan Kemajuan</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td>Hibah Riset 2015</td>              
                  <td>Milki</td>
                  <td>
                    <a href="{{action('LaporanController@uploadkemajuan')}}" class="waves-effect waves-teal btn-flat"><i class="material-icons">open_in_new</i></a>
                  </td>
                </tr>
                <tr>
                  <td>Hibah Riset 2015</td>
                  <td>Rangga</td>
                  <td>
                  <a class="waves-effect waves-teal btn-flat"><i class="material-icons">open_in_new</i></a>
                  </td>
                </tr>
                <tr>
                  <td>Hibah Riset 2016</td>
                  <td>Cinta</td>
                  <td>
                    <a class="waves-effect waves-teal btn-flat"><i class="material-icons">open_in_new</i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div>

     <div class="container">
      <div id="upload-laporan-akhir">
        <div class="header">PILIH HIBAH</div>
          <div class="berhibah-content" align="center">
            <ul>
              <li>
              <a href="{{action('LaporanController@uploadlaporanberhibah')}}"><i class="material-icons" style="font-size: 100px">receipt</a>
              </li>
              <li>  
              <a href="{{action('LaporanController@uploadlaporantdkberhibah')}}"><i class="material-icons" style="font-size: 100px">description</a>
              </li>
            </ul>
            </div>        
      </div>
    </div>

    </div>
  @stop
</body>
</html>
