@extends('master')
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
  <div class="page-content">
    <nav class="second-navbar">
      <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down">
          <li id="kemajuan"><a href="#">Laporan Kemajuan</a></li>
          <li id="akhir"><a href="#">Laporan Akhir</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
        </ul>
      </div>
    </nav>

    <!-- CONTENT LAPORAN kemajuan -->
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
    <!-- END OF CONTENT akhir HIBAH -->
  </div>

  {{-- <div class="wrapper">

  <!-- SECOND NAVBAR -->
    <div class="page-content-wrapper">
      <nav class="navbar navbar-content">
        <div class="container-fluid border-bottom-box">
          <ul class="nav navbar-nav">
            <li id="kemajuan"><a href="#">kemajuan Hibah</a></li>
            <li id="akhir"><a href="#">akhir Hibah</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right menu">
            <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
          </ul>
        </div>
      </nav>
  <!-- END of SECOND NAVBAR -->

      <!-- CONTENT kemajuan HIBAH -->
      <div class="content container-fluid">
        <div id="laporan-kemajuan">
          <div class="header">kemajuan HIBAH</div>
          <div class="kemajuan-content">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Nama Hibah</th>
                  <th>Kategori</th>
                  <th>Pemberi</th>
                  <th>Besar Dana</th>
                  <th>Periode</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Universitas Indonesia Hibah</td>
                  <td>Hibah</td>
                  <td>Garuda Indonesia</td>
                  <td>RP. 150.000.000</td>
                  <td>11/04/2015 - 11/05/2016</td>
                  <td>
                    <button type="button" class="btn btn-default btn-sm">
                      Hapus 
                    </button>
                    <div class="divider"></div>
                    <button type="button" class="btn btn-default btn-sm">
                        Rubah
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- END OF CONTENT kemajuan HIBAH -->

      <!-- CONTENT akhir HIBAH -->
      <div class="content container-fluid">
        <div id="laporan-akhir">
            <div class="header">akhir HIBAH</div>
              <div class="akhir-content"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- END OF CONTENT akhir HIBAH -->
    </div>
  </div> --}}
  @stop
</body>
</html>
