@extends('master')
<!DOCTYPE html>
<html>
<head>
  <title>UPLOAD LAPORAN AKHIR</title>
    <link rel="author" href="humans.txt">

    <!-- CSS FOR PAGE HIBAH -->
    <link rel="stylesheet" href="assets/css/hibah.css">
    <link rel="stylesheet" href="assets/css/borang.css">

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
        <li id="kemajuan"><a href="{{action('LaporanController@index')}}">Kembali</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Login Sebagai muhammad.ezra - Staf Riset</a></li>
        </ul>
      </div>
    </nav>

    <!-- CONTENT BUAT BORANG -->
    <div class="container">
      <div id="kelola-hibah">
        <div class="header"><h4>Upload Laporan Akhir</h4></div>
          <div class="kelola-content">
                   <table class="highlight centered">
              <thead>
                <tr>
                    <th data-field="id">Judul Proposal</th>
                    <th data-field="name">Kategori</th>
                    <th data-field="price">Upload Laporan Akhir</th>
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
      <!-- END OF CONTENT KELOLA HIBAH -->
<

  </div>

  {{-- <div class="wrapper">
    
    </div>
  </div> --}}
  @stop
</body>
</html>
